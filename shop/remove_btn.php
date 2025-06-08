<?php
session_start();

if (isset($_GET['index'])) {
    $index = (int)$_GET['index'];

    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); // Đặt lại chỉ số mảng
    }
}

header("Location: cart.php"); // Quay về trang giỏ hàng
exit();

if (isset($_GET['order_id'])) {
    $order_id = (int)$_GET['order_id'];

    // Kiểm tra điều kiện hủy đơn (ví dụ: chỉ cho hủy nếu đang "Chờ xử lý")
    $stmt = $conn->prepare("SELECT status FROM orders WHERE id_order = ?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $order = $result->fetch_assoc();

    if ($order && $order['status'] === 'Chờ xử lý') {
        $stmt_cancel = $conn->prepare("UPDATE orders SET status = 'Đã hủy' WHERE id_order = ?");
        $stmt_cancel->bind_param("i", $order_id);
        $stmt_cancel->execute();
    }

    header("Location: ordered.php"); // Trang đơn hàng đã đặt
    exit();
}

?>