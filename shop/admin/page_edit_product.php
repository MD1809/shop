<?php session_start(); ?>
<?php require_once("../settings/config.php") ?>

<?php
    if (isset($_GET['id'])){
    $id = $conn->real_escape_string($_GET['id']);

    // Truy vấn bảng products
    $sqlProduct = "SELECT * FROM products WHERE id_product = '$id'";
    $resultProduct = $conn->query($sqlProduct);
    
    $product = $resultProduct->fetch_assoc();

    $sqlSpecs = "
                SELECT 
                    sg.name AS group_name,
                    sa.id AS attr_id,
                    sa.name AS attr_name,
                    ps.value AS attr_value
                FROM spec_attributes sa
                JOIN spec_groups sg ON sa.spec_group_id = sg.id
                LEFT JOIN product_specs ps 
                    ON ps.spec_attribute_id = sa.id AND ps.product_id = $id
                ORDER BY sg.id, sa.id
                ";
    $resultSpecs = $conn->query($sqlSpecs);

    $specs = [];

    while ($row = $resultSpecs->fetch_assoc()) {
        $specs[$row['attr_name']] = $row['attr_value'];
    }


    } else {
        echo "Thiếu ID sản phẩm.";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/styleAd.css">
    <style>
</style>

</head>
<body>
    <form action="../process_Ad/edit_Product.php" method="POST" class="container_form">
        <input type="hidden" name="product_id" value="<?= $id ?>">

        <h2>Thông tin sản phẩm</h2>
        <div class="edit_container">
            <div class="info_basic">
                <div class="info_item">
                    <label for="name">Tên máy tính</label>
                    <input type="text" placeholder="Nhập tên máy tính" id="name" name="product_name" value="<?php echo htmlspecialchars($product['name']); ?>" required />
                </div>

                <div class="info_item">
                    <label for="price">Giá</label>
                    <input placeholder="giá bán" type="text" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required />
                </div>

                <div class="info_item">
                    <label for="image">Ảnh sản phẩm</label>
                    <input placeholder="Ảnh mô tả sản phẩm" type="text" id="image" name="image" value="<?php echo htmlspecialchars($product['image']); ?>"  required />
                </div>

                
            </div>
            <div class="info_detail">
                <div class="info_item">
                    <label for="cpu">Bộ vi xử lý (CPU)</label>
                    <input placeholder="" type="text" id="cpu" name="cpu" value="<?php echo htmlspecialchars($specs['Bộ vi xử lý (CPU)'] ?? ''); ?>" required />
                </div>

                <div class="info_item">
                    <label for="ram">Bộ nhớ RAM</label>
                    <input placeholder="" type="text" id="ram" name="ram" value="<?php echo htmlspecialchars($specs['Bộ nhớ RAM'] ?? ''); ?>" required />
                </div>

                <div class="info_item">
                    <label for="storage">Ổ cứng</label>
                    <input placeholder="" type="text" id="storage" name="storage" value="<?php echo htmlspecialchars($specs['Ổ cứng'] ?? ''); ?>" required />
                </div>

                <div class="info_item">
                    <label for="gpu">Card đồ họa</label>
                    <input placeholder="" type="text" id="gpu" name="gpu" value="<?php echo htmlspecialchars($specs['Card đồ họa'] ?? ''); ?>" required />
                </div>
            </div>
        </div>
        <div class="info_desc">
            <label for="description">Mô tả sản phẩm</label>
            <textarea id="description" name="description" rows="4"  required><?php echo htmlspecialchars($product['description']); ?></textarea>
        </div>
        <div class="info_item">
            <button type="submit">Xác nhận</button>
        </div>
    </form>
</body>
</html>