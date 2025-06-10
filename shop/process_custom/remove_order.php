<?php
session_start();
require_once('../settings/config.php');


// Kiểm tra có order_id không
if (isset($_GET['order_id'])) {
    $order_id = intval($_GET['order_id']);
    $user_id = $_SESSION['id'];

    // Kiểm tra đơn hàng có thuộc về người dùng này không
    $sql_check = "SELECT * FROM orders WHERE id_order = ? AND user_id = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("ii", $order_id, $user_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // Cập nhật trạng thái đơn hàng thành "Hủy"
        $sql_cancel = "UPDATE orders SET status = 'Hủy' WHERE id_order = ?";
        $stmt_cancel = $conn->prepare($sql_cancel);
        $stmt_cancel->bind_param("i", $order_id);
        if ($stmt_cancel->execute()) {
            // Quay lại trang đơn hàng
            header('Location: ../ordered.php');
            exit();
        } else {
            echo "Lỗi khi hủy đơn hàng.";
        }
    } else {
        echo "Không tìm thấy đơn hàng hoặc bạn không có quyền.";
    }
} else {
    echo "Thiếu mã đơn hàng.";
}
?>
