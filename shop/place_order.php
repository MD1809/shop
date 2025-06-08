<?php
session_start();
require 'config.php'; 


if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-select-add'])){
    header("location: index.php");
    exit();
}
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_button'])){
    
    if(!isset($_SESSION['id'])){
        header("location: login.php");
        exit();
    }
    
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        echo "Giỏ hàng trống!";
        exit();
    }

    if (isset($_POST['items'])) {
        foreach ($_POST['items'] as $index => $itemPost) {
            if (isset($_SESSION['cart'][$index])) {
                $_SESSION['cart'][$index]['quantity'] = (int)$itemPost['quantity'];
            }
        }
    }

    // Lấy dữ liệu người nhận từ form
    $full_name = $_POST['fullname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $province = $_POST['province'];
    $district = $_POST['district'];
    $ward = $_POST['ward'];
    $address_detail = $_POST['address_detail'];
    $note = $_POST['note'];
    $payment_method = $_POST['payment'];
    
    $user_id = $_SESSION['id'];
    $cart = $_SESSION['cart'];
    $total = 0;
    
    // Tính tổng đơn hàng
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    $total = floatval($total);
    
    // 1. Tạo đơn hàng mới
    $status = 'Chờ xử lý';
    $sql_order = "INSERT INTO orders (user_id, full_name, phone, email,
                                      province, district, ward, address_detail, note, status, total, payment_method) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_order);
    $stmt->bind_param("isssssssssds", $user_id, $full_name, $phone, $email, $province, $district, $ward, 
                                        $address_detail, $note, $status , $total, $payment_method);
    $stmt->execute();
    $order_id = $conn->insert_id; 
    
    // 2. Lưu chi tiết đơn hàng
    $sql_detail = "INSERT INTO orderdetails (order_id, product_id, quantity, priceEach) VALUES (?, ?, ?, ?)";
    $stmt_detail = $conn->prepare($sql_detail);
    
    foreach ($cart as $item) {
        $stmt_detail->bind_param("iiid", $order_id, $item['product_id'], $item['quantity'], $item['price']);
        $stmt_detail->execute();
    }
    
    // 3. Xóa giỏ hàng
    unset($_SESSION['cart']);
    
    header("Location: order.php");
    exit();
}

?>
