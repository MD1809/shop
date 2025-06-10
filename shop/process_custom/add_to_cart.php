<?php
session_start();
require_once('../settings/config.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['btn'] == "order") {
        if(!isset($_SESSION['id'])){
            // Lấy URL trả về sau khi từ chối đăng nhập (hoặc sau khi login xong quay lại)
            $return_url = isset($_POST['return_url']) ? $_POST['return_url'] : 'index.php';
    
            echo "
            <script>
                if (confirm('Bạn cần đăng nhập để tiếp tục mua hàng. Bạn có muốn đăng nhập không?')) {
                    // Chuyển đến trang login và truyền return_url để quay lại sau
                    window.location.href = '../login.php?return=" . $return_url . "';
                } else {
                    // Quay về lại trang chi tiết sản phẩm
                    window.location.href = '$return_url';
                }
            </script>";
            exit();
        }
    }
}


if (isset($_POST['product_id'], $_POST['product_name'], $_POST['price'])) {
    $product_id = (int) $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $img = $_POST['img'];
    $price = (float) $_POST['price'];
    $quantity = 1;

    if($_POST['btn'] == "order"){
        $_SESSION['order_items'] = [
            [
                'product_id' => $product_id,
                'name' => $product_name,
                'price' => $price,
                'image' => $img,
                'quantity' => 1
            ]
        ];
        $_SESSION['order_selected'] = [0]; // Chỉ có 1 sản phẩm
        if ($_POST['btn'] == "order") {
            header("Location: ../order.php");
            exit();
        }

    }else{
        // Nếu giỏ hàng chưa tồn tại → khởi tạo và thêm sản phẩm đầu tiên
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            $_SESSION['cart'][] = [
                'product_id' => $product_id,
                'name' => $product_name,
                'price' => $price,
                'image' => $img,
                'quantity' => 1
            ];
        } else {
            // Nếu giỏ đã có, kiểm tra xem sản phẩm đã tồn tại chưa
            $found = false;
            foreach ($_SESSION['cart'] as &$item) {
                if ($item['product_id'] == $product_id) {
                    $found = true;
                    break;
                }
            }
            unset($item); // giải tham chiếu
    
            // Nếu chưa có sản phẩm trong giỏ, thêm mới
            if (!$found) {
                $_SESSION['cart'][] = [
                    'product_id' => $product_id,
                    'name' => $product_name,
                    'price' => $price,
                    'image' => $img,
                    'quantity' => 1
                ];
            }
        }
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if($_POST['btn'] == "addcart") {
                if (isset($_POST['return_url'])) {
                    $returnUrl = $_POST['return_url'];
                    header("Location: " . $returnUrl);
                    exit();
                }
            }
        }
    }
} else {
    echo "Thiếu dữ liệu sản phẩm!";
}
?>
