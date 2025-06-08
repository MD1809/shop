<?php session_start(); ?>
<?php require_once('config.php') ?>
<!-- lấy dữ liệu sản pẩm -->
<?php
    $product_id = isset($_GET['id']) ? $_GET['id'] : null;
    if($product_id){
        if($product_id == null){
            exit();
        }
        $sql = "SELECT * FROM products WHERE id_product = $product_id";
        $result = $conn -> query($sql);
        if($product = $result->fetch_assoc()){
            $_SESSION['product_id'] = $product['id_product'];
            $product_name = $product['name'];
            $price = $product['price'];
            $img = $product['image'];
            $description = $product['description'];
        }else{
            echo 'lỗi';
            exit();
        }
    }
?>
<!-- lấy các thông số kỹ thuật của sản phẩm -->
<?php
    function getProductSpecsByGroup($conn, $productId, $groupName) {
        $sql = "SELECT pg.name AS group_name, pa.name AS attribute_name, ps.value AS attribute_value
                FROM
                    product_specs ps
                JOIN
                    spec_attributes pa ON ps.spec_attribute_id = pa.id
                JOIN
                    spec_groups pg ON pa.spec_group_id = pg.id
                WHERE
                    ps.product_id = $productId
                    AND pg.name = '$groupName'";
        $result = $conn->query($sql);
        $datas = [];
        while($row = $result->fetch_assoc()){
            $datas[] = [
                'attribute_name' => htmlspecialchars($row['attribute_name']),
                'attribute_value' => $row['attribute_value']
            ];
        }
        return $datas;
    }
?>

<?php require_once('header.php') ?>
    <main>
        <div class="container width-page_use">
            <div class="detailProduct">
                <div class="detailProduct_image">
                    <?php
                    echo '<img class="detailProduct_image--item" src= "assets/image/' . $img .'" alt="#1">'
                    ?>
                </div>
                <div class="detailProduct_info">
                    <div class="detailProduct_name"><?php echo $product_name ?></div>
                    <div class="detailProduct_price"><?php echo number_format($price, 0, ',', '.') . '₫' ?></div>
                </div>
            </div>

            <div class="detailProduct_specs">
                <div class="content">
                    <h2>Thông số kỹ thuật</h2>
                    <div class="spec-group">
                        <?php
                            $productId =  $product_id;
                            $groupName = 'Hiệu Năng';
                            $performanceSpecs = getProductSpecsByGroup($conn, $productId, $groupName);

                            echo'<h3>'.$groupName.'</h3>';
                            echo'<table class="spec-table">';
                                if(!empty($performanceSpecs)){
                                    foreach($performanceSpecs as $data){
                                        echo'<tr>';
                                        echo'    <th>'.$data['attribute_name'].'</th>';
                                        echo'    <td>'.$data['attribute_value'].'</td>';
                                        echo'</tr>';
                                    }
                                }                       
                            echo'</table>';
                        ?>
                    </div>
    
                    <div class="spec-group">
                        <?php
                            $productId =  $product_id;
                            $groupName = 'Màn hình';
                            $performanceSpecs = getProductSpecsByGroup($conn, $productId, $groupName);

                            echo'<h3>'.$groupName.'</h3>';
                            echo'<table class="spec-table">';
                                if(!empty($performanceSpecs)){
                                    foreach($performanceSpecs as $data){
                                        echo'<tr>';
                                        echo'    <th>'.$data['attribute_name'].'</th>';
                                        echo'    <td>'.$data['attribute_value'].'</td>';
                                        echo'</tr>';
                                    }
                                }                       
                            echo'</table>';
                        ?>
                    </div>
    
                    <div class="spec-group">
                        <?php
                            $productId =  $product_id;
                            $groupName = 'Thiết kế & Cổng kết nối';
                            $performanceSpecs = getProductSpecsByGroup($conn, $productId, $groupName);

                            echo'<h3>'.$groupName.'</h3>';
                            echo'<table class="spec-table">';
                                if(!empty($performanceSpecs)){
                                    foreach($performanceSpecs as $data){
                                        echo'<tr>';
                                        echo'    <th>'.$data['attribute_name'].'</th>';
                                        echo'    <td>'.$data['attribute_value'].'</td>';
                                        echo'</tr>';
                                    }
                                }                       
                            echo'</table>';
                        ?>
                    </div>
    
                    <div class="spec-group">
                        <?php
                            $productId =  $product_id;
                            $groupName = 'Các tính năng khác';
                            $performanceSpecs = getProductSpecsByGroup($conn, $productId, $groupName);

                            echo'<h3>'.$groupName.'</h3>';
                            echo'<table class="spec-table">';
                                if(!empty($performanceSpecs)){
                                    foreach($performanceSpecs as $data){
                                        echo'<tr>';
                                        echo'    <th>'.$data['attribute_name'].'</th>';
                                        echo'    <td>'.$data['attribute_value'].'</td>';
                                        echo'</tr>';
                                    }
                                }                       
                            echo'</table>';
                        ?>
                    </div>

                </div>
                <div class="detailProduct_describe">
                    <div class="detailProduct_title">
                        <h2>Mô tả sản phẩm</h2>
                    </div>
                    <div class="detailProduct_content">
                        <?php
                            echo '<p>'. $description .'</p>';
                        ?>
                    </div>
                </div>
                <form action="add_to_cart.php" method="post" class="btn__action">
                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $product_name; ?>">
                    <input type="hidden" name="price" value="<?php echo $price; ?>">
                    <input type="hidden" name="img" value="<?php echo $img; ?>">
                    <input type="hidden" name="return_url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                    <button type="submit" name="btn" value="addcart">Thêm vào giỏ hàng</button>
                    <button type="submit" name="btn" value="order">Mua ngay</button>
                </form>
            </div>
        </div>
    </main>
    <?php require_once('footer.php') ?>
</body>
</html>