<?php session_start(); ?>
<?php require_once('../settings/config.php'); ?>

<?php

// Kiểm tra nếu gửi form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = ($_POST['product_id']);
    $name = $_POST['product_name'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $description = $_POST['description'];

    // Cập nhật bảng products
    $stmt = $conn->prepare("UPDATE products SET name=?, description=?, price=?, image=? WHERE id_product=?");
    $stmt->bind_param("ssdsi", $name, $description, $price, $image, $id);
    $stmt->execute();
    $stmt->close();

    // Thông số kỹ thuật
    $specs = [
        'Bộ vi xử lý (CPU)' => $_POST['cpu'],
        'Bộ nhớ RAM'        => $_POST['ram'],
        'Ổ cứng'            => $_POST['storage'],
        'Card đồ họa'       => $_POST['gpu']
    ];

    foreach ($specs as $attribute_name => $value) {
        // Lấy ID của thuộc tính
        $stmt_attr = $conn->prepare("SELECT id FROM spec_attributes WHERE name = ?");
        $stmt_attr->bind_param("s", $attribute_name);
        $stmt_attr->execute();
        $result = $stmt_attr->get_result();
        if ($row = $result->fetch_assoc()) {
            $attr_id = $row['id'];

            // Kiểm tra nếu đã có thì UPDATE, chưa có thì INSERT
            $check_stmt = $conn->prepare("SELECT id FROM product_specs WHERE product_id=? AND spec_attribute_id=?");
            $check_stmt->bind_param("ii", $id, $attr_id);
            $check_stmt->execute();
            $check_result = $check_stmt->get_result();

            if ($check_result->num_rows > 0) {
                // UPDATE
                $update_stmt = $conn->prepare("UPDATE product_specs SET value=? WHERE product_id=? AND spec_attribute_id=?");
                $update_stmt->bind_param("sii", $value, $id, $attr_id);
                $update_stmt->execute();
                $update_stmt->close();
            }

            $check_stmt->close();
        }

        $stmt_attr->close();
    }

    header("location: ../Admin/Ad_Products.php");
    exit();
}

$conn->close();
?>
