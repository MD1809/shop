<?php
session_start();
require_once('../settings/config.php');

// XÓA SẢN PHẨM KHỎI GIỎ
if (isset($_GET['index'])) {
    $index = (int)$_GET['index'];

    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); // Đặt lại chỉ số mảng
    }

    header("Location: ../cart.php");
    exit();
}