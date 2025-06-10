<?php session_start(); ?>
<?php require_once('../settings/config.php'); ?>

<?php

// Kiểm tra nếu gửi form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $name = $_POST['product_name'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $description = $_POST['description'];

    // Thêm sản phẩm vào bảng products
    $stmt = $conn->prepare("INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $name, $description, $price, $image);

    if ($stmt->execute()) {
        $product_id = $stmt->insert_id;

        // Tạo mảng thông số từ form
        $specs = [
            'Bộ vi xử lý (CPU)' => $_POST['cpu'],
            'Bộ nhớ RAM'        => $_POST['ram'],
            'Ổ cứng'            => $_POST['storage'],
            'Card đồ họa'       => $_POST['gpu']
        ];

        foreach ($specs as $attribute_name => $value) {
            // Lấy spec_attribute_id từ tên thuộc tính
            $query = "SELECT id FROM spec_attributes WHERE name = ?";
            $stmt_attr = $conn->prepare($query);
            $stmt_attr->bind_param("s", $attribute_name);
            $stmt_attr->execute();
            $result = $stmt_attr->get_result();

            if ($row = $result->fetch_assoc()) {
                $spec_attribute_id = $row['id'];

                // Chèn vào product_specs
                $stmt_spec = $conn->prepare("INSERT INTO product_specs (product_id, spec_attribute_id, value) VALUES (?, ?, ?)");
                $stmt_spec->bind_param("iis", $product_id, $spec_attribute_id, $value);
                $stmt_spec->execute();
                $stmt_spec->close();
            }

            $stmt_attr->close();
        }

        header(("location: ../Admin/Ad_Products.php"));
        exit();
    } else {
        echo "Lỗi khi thêm sản phẩm: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
