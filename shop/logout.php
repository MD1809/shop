<?php session_start(); ?>
<?php require_once('../shop/settings/config.php'); ?>

<?php


if (isset($_SESSION['id']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $user_id = $_SESSION['id'];
    $cart = $_SESSION['cart'];

    // Xoá giỏ hàng cũ của user này nếu đã lưu trước đó
    $conn->query("DELETE FROM saved_carts WHERE user_id = $user_id");

    // Lưu từng sản phẩm vào bảng saved_carts
    $stmt = $conn->prepare("INSERT INTO saved_carts (user_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
    foreach ($cart as $item) {
        $stmt->bind_param("iiii", $user_id, $item['product_id'], $item['quantity'], $item['price']);
        $stmt->execute();
    }
    $stmt->close();
}

// Xoá session
unset($_SESSION['user_id']);
unset($_SESSION['cart']);
session_destroy();

header("Location: index.php");
exit();
?>
