<?php
session_start();
require_once("../settings/config.php");

if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);

    $conn->query("DELETE FROM product_specs WHERE product_id = '$id'");
    $conn->query("DELETE FROM orderdetails WHERE product_id  = '$id'");

    $sql = "DELETE FROM products WHERE id_product = '$id'";

    if ($conn->query($sql) === TRUE) {
        header("location: ../Admin/Ad_products.php");
        exit();
    } else {
        echo "Lỗi xoá sản phẩm: " . $conn->error;
    }
} else {
    echo "Không tìm thấy ID sản phẩm.";
}
$conn->close();
?>
