<?php
session_start();
require_once('../settings/config.php');


// 2. Kiểm tra có ID đơn hàng truyền vào không
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "ID đơn hàng không hợp lệ.";
    exit();
}

$id_order = intval($_GET['id']);

// 3. Kiểm tra đơn hàng có tồn tại không và không bị hủy
$sql_check = "SELECT status FROM orders WHERE id_order = ?";
$stmt = $conn->prepare($sql_check);
$stmt->bind_param("i", $id_order);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Đơn hàng không tồn tại.";
    exit();
}

$order = $result->fetch_assoc();

if ($order['status'] == 'Đã hủy') {
    echo "Không thể hoàn thành đơn hàng đã bị hủy.";
    exit();
}

if ($order['status'] == 'Hoàn thành') {
    echo "Đơn hàng đã được hoàn thành trước đó.";
    exit();
}

// 4. Cập nhật trạng thái đơn hàng thành 'Hoàn thành'
$sql_update = "UPDATE orders SET status = 'Hoàn thành' WHERE id_order = ?";
$stmt_update = $conn->prepare($sql_update);
$stmt_update->bind_param("i", $id_order);

if ($stmt_update->execute()) {
    // 5. Chuyển hướng về trang danh sách đơn hàng (ví dụ: order_list.php)
    header("Location: ../admin/Ad_order.php?success=1");
    exit();
} else {
    echo "Lỗi khi cập nhật trạng thái đơn hàng.";
    exit();
}
?>
