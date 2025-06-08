<?php
session_start();

if(isset($_POST['add-button'])) {
    header("Location: index.php");
    exit();
}
if (isset($_POST['items']) && isset($_POST['selected'])) {
    $_SESSION['order_items'] = $_POST['items'];
    $_SESSION['order_selected'] = $_POST['selected'];
    header("Location: order.php");
    exit();
} else {
    echo "Bạn chưa chọn sản phẩm nào!";
}
