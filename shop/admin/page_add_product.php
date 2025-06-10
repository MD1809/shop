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
    <form action="../process_Ad/add_Product.php" method="POST" class="container_form">
        <h2>Thông tin sản phẩm</h2>
        <div class="edit_container">
            <div class="info_basic">
                <div class="info_item">
                    <label for="name">Tên máy tính</label>
                    <input type="text" placeholder="Nhập tên máy tính" id="name" name="product_name" required />
                </div>

                <div class="info_item">
                    <label for="price">Giá</label>
                    <input placeholder="giá bán" type="text" id="price" name="price" required />
                </div>

                <div class="info_item">
                    <label for="image">Ảnh sản phẩm</label>
                    <input placeholder="Ảnh mô tả sản phẩm" type="text" id="image" name="image"  required />
                </div>

                
            </div>
            <div class="info_detail">
                <div class="info_item">
                    <label for="cpu">Bộ vi xử lý (CPU)</label>
                    <input placeholder="" type="text" id="cpu" name="cpu" required />
                </div>

                <div class="info_item">
                    <label for="ram">Bộ nhớ RAM</label>
                    <input placeholder="" type="text" id="ram" name="ram" required />
                </div>

                <div class="info_item">
                    <label for="storage">Ổ cứng</label>
                    <input placeholder="" type="text" id="storage" name="storage" required />
                </div>

                <div class="info_item">
                    <label for="gpu">Card đồ họa</label>
                    <input placeholder="" type="text" id="gpu" name="gpu" required />
                </div>
            </div>
        </div>
        <div class="info_desc">
            <label for="description">Mô tả sản phẩm</label>
            <textarea id="description" name="description" rows="4" required></textarea>
        </div>
        <div class="info_item">
            <button type="submit">Thêm sản phẩm</button>
        </div>
    </form>
</body>
</html>