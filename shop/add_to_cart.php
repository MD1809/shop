<?php
session_start();
require_once('config.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['btn'] == "order") {
        if(!isset( $_SESSION["id"])){
            header("Location: login.php");
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
        if ($_POST['btn'] == "order") {
            header("Location: cart.php");
            exit();
        }
        if($_POST['btn'] == "addcart") {
            if (isset($_POST['return_url'])) {
                $returnUrl = $_POST['return_url'];
                header("Location: " . $returnUrl);
                exit();
            }
        }
    }
} else {
    echo "Thiếu dữ liệu sản phẩm!";
}
?>
