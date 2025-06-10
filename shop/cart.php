<?php session_start(); ?>
<?php require_once('../shop/settings/config.php'); ?>

<?php require_once('header.php') ?>

  <main class="mainincart">
    <form action="../shop/process_custom/prepare_order.php" method="post">
      <div class="cart-container">
        <div class="cart_title">
          <h1>Giỏ hàng của bạn</h1>
          
          <div class="ordered">
            <ul class="ordered_list">
                <li class="ordered_list-item"><a href="cart.php" class="ordered_item-link selected"><span>Giỏ hàng</span></a></li>
                <li class="ordered_list-item"><a href="ordered.php" class="ordered_item-link"><span>Đã đặt</span></a></li>
            </ul>
          </div>

          <div class="login__close">
              <i class="fa-solid fa-xmark login__close--icon"></i>
          </div>
        </div>
        <?php
          if(empty($_SESSION['cart'])){
            echo '<div class="empty-cart"> Giỏ hàng trống! </div>';
            echo'
            <div class="addincart">
              <button type="submit" class="add-btn" name="add-button" value="addbutton">Thêm sản phẩm</button>  
            </div>';
            exit();
          } else {
            $index = 0;
            $total = 0;
            foreach ($_SESSION['cart'] as $item) {
              $product_id = (int)$item['product_id']; 
              $name = htmlspecialchars($item['name']);
              $price = (int)$item['price'];
              $quantity = (int)$item['quantity'];
              $image = htmlspecialchars($item['image']);

              $formattedPrice = number_format($price, 0, ',', '.') . '₫';
              $totalPrice = number_format($price, 0, ',', '.') . '₫';

              echo '
              <div class="cart-item">
                <div class="check">
                  <input type="checkbox" name="selected[]" value="' . $product_id . '" class="checkselect" checked>
                </div>
                <img src="assets/image/' . $image . '" alt="' . $name . '">
                <div class="item-details">
                  <h2>' . $name . '</h2>
                  <p>Giá: <span class="price">' . $formattedPrice . '</span></p>
                  <input type="hidden" name="items['  . $product_id .  '][quantity]" value="' . $quantity . '" min="1">
                  <input type="hidden" name="items['  . $product_id .  '][name]" value="' . $name . '">
                  <input type="hidden" name="items['  . $product_id .  '][price]" value="' . $price . '">
                  <input type="hidden" name="items['  . $product_id .  '][image]" value="' . $image . '">

                </div>
                <div class="item-total">
                  <p>Tổng: <strong>' . $totalPrice . '</strong></p>
                  <a href="../shop/process_custom/remove_product-cart.php?index=' . $index . '" class="remove-btn" onclick="return confirm(\'Bạn có chắc muốn xoá sản phẩm này?\')">Xoá</a>
                </div>

              </div>';
              $index++;
              $total = $total + $price;
            }
            echo'
            <div class="cart-summary">
              <h3>Tổng thanh toán: <span class="grand-total">'.number_format($total, 0, ',', '.') . '₫'.'</span></h3>
              <button type="submit" class="checkout-btn" name="orders-btn">Mua ngay</button>
            </div>';
          }
        ?>
      </div>
    </form>
  </main>
  <script>
    document.querySelector('.login__close').addEventListener('click', function() {
        // Quay lại trang trước
        window.location.href = 'index.php';
    });
  </script>


</body>
</html>
