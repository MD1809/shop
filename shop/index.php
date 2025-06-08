<?php session_start(); ?>
<?php require_once('config.php') ?>


<?php require_once('header.php') ?>
    <main style="height: 100vh";>
        <div class="width-page_use">
            
            <?php
                // Nếu có từ khóa tìm kiếm
                if (isset($_GET['keyword']) && !empty(trim($_GET['keyword']))) {
                    $keyword = "%" . trim($_GET['keyword']) . "%";

                    $stmt = $conn->prepare("SELECT id_product, name, price, image FROM products WHERE name LIKE ?");
                    $stmt->bind_param("s", $keyword);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    echo '<h2 class="product__title" style="margin: 40px 0 30px 0";>Kết quả tìm kiếm</h2>';
                    echo '<div class="product__list">';

                    if ($result->num_rows > 0) {
                        while($product = $result->fetch_assoc()) {
                            $id = $product['id_product'];
                            $image = $product['image'];
                            $name = $product['name'];
                            $price = $product['price'];

                            echo '<article class="product-card">
                                    <a href="detailProduct.php?id=' . $id . '" class="product-card_link">
                                        <img src="assets/image/' . htmlspecialchars($image) . '" alt="' . htmlspecialchars($name) . '" class="product-card__image">
                                        <div class="product-card__describe">
                                            <h4 class="product-card__name">' . htmlspecialchars($name) . '</h4>
                                            <p class="product-card__price">' . number_format($price) . 'đ</p>
                                        </div>
                                        <div class="product-card__review">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                    </a>
                                </article>';
                        }
                    } else {
                        echo '<p>Không tìm thấy sản phẩm phù hợp.</p>';
                    }
                    echo '</div>';
                } else {
                    // Hiển thị laptop mặc định
                    echo '<div class="product__list">';
                    $sql_laptop = "SELECT id_product, name, price, image
                                    FROM products 
                                    LIMIT 10";
                    $result_laptops = $conn->query($sql_laptop);
                    if ($result_laptops->num_rows > 0) {
                        while($product = $result_laptops->fetch_assoc()) {
                            $id = $product['id_product'];
                            $image = $product['image'];
                            $name = $product['name'];
                            $price = $product['price'];

                            echo '<article class="product-card">
                                    <a href="detailProduct.php?id='.$id.'" class="product-card_link">
                                        <img src="assets/image/' . htmlspecialchars($image) . '" alt="' . htmlspecialchars($name) . '" class="product-card__image">
                                        <div class="product-card__describe">
                                            <h4 class="product-card__name">' . htmlspecialchars($name) . '</h4>
                                            <p class="product-card__price">' . number_format($price) . 'đ</p>
                                        </div>
                                        <div class="product-card__review">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                    </a>
                                </article>';
                        }
                    }
                    echo '</div>';
                }
            ?> 
        </div>
    </main>
    <?php require_once('footer.php') ?>
</body>
</html>