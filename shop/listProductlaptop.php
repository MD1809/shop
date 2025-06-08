<?php session_start(); ?>
<?php require_once('config.php') ?>

<?php require_once('header.php') ?>
    <main>
        <div class="width-page_use">
            <section class="product">
                <!-- Sản phẩm laptop -->
                <div class="product__list">
                    <?php
                        // thực hiện truy vấn lấy dữ liệu laptop
                        $sql_laptop = "SELECT id_product, name, price, image
                                        FROM products ";
                        $result_laptops = $conn->query($sql_laptop);

                        // nếu có dữ liệu
                        if ($result_laptops->num_rows > 0) {
                            while($product = $result_laptops->fetch_assoc()) {
                                // gán biến
                                $id = $product['id_product'];
                                $image = $product['image'];
                                $name = $product['name'];
                                $price = $product['price'];
                                // Bắt đầu in ra HTML
                                echo '<article class="product-card">';
                                echo '    <a href="detailProduct.php?id='.$id.'" class="product-card_link">';
                                echo '        <img src="assets/image/' . htmlspecialchars($image) . '" alt="' . htmlspecialchars($image) . '" class="product-card__image">';
                                echo '        <div class="product-card__describe">';
                                echo '            <h4 class="product-card__name">' . htmlspecialchars($name) . '</h4>';
                                echo '            <p class="product-card__price">' . number_format($price) . 'đ</p>'; 
                                echo '        </div>';
                                echo '        <div class="product-card__review">';
                                echo '            <i class="fa-solid fa-star"></i>';
                                echo '            <i class="fa-solid fa-star"></i>';
                                echo '            <i class="fa-solid fa-star"></i>';
                                echo '            <i class="fa-solid fa-star"></i>';
                                echo '            <i class="fa-solid fa-star"></i>';
                                echo '        </div>';
                                echo '    </a>';
                                echo '</article>';
                            }
                        }
                    ?>
                </div>
            </section>
        </div>
    </main>
    <?php require_once('footer.php') ?>
</body>
</html>