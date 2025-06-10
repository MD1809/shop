<?php session_start(); ?>
<?php require_once("../settings/config.php") ?>


<?php
    if (!isset($_GET['id'])) {
        die("Không có đơn hàng.");
    }

    $id = intval($_GET['id']);

    // Lấy thông tin đơn hàng
    $sql = "SELECT * FROM orders WHERE id_order = $id";
    $order = $conn->query($sql)->fetch_assoc();

    // Lấy danh sách sản phẩm trong đơn
    $sql_items = "SELECT p.name, p.image, od.quantity, od.priceEach
                FROM orderdetails od 
                JOIN products p ON od.product_id = p.id_product
                WHERE od.order_id = $id";
    $items = $conn->query($sql_items);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/styleAd.css">
    <title>Quản Lý Shop</title>
</head>
<body>
    <div id="container-Order">
        <div class="detailorder__close">
            <a href="../admin/Ad_order.php"><i class="fa-solid fa-xmark login__close--icon"></i></a>
        </div>
        <form action="" class="container-order">
            <div class="shipping-info">
                <h2>THÔNG TIN GIAO HÀNG</h2>
                <div class="input-group">
                    <div class="card_item">
                        <label for="fullname">Họ và tên: </label>
                        <span><?= htmlspecialchars($order['full_name']) ?></span>
                    </div>
                    <div class="card_item">
                        <label for="phone">Số điện thoại: </label>
                        <span><?= htmlspecialchars($order['phone']) ?></span>
                    </div>
                    <div class="card_item">
                        <label for="email">email: </label>
                        <span><?= htmlspecialchars($order['email']) ?></span>
                    </div>
                    <div class="card_item">
                        <label for="Address">Địa chỉ: </label>
                        <span><?= $order['province'] . ' - ' . $order['district'] .' - '. $order['ward']?></span>
                    </div>
                    <div class="card_item">
                        <label for="Addressdetail">Địa chỉ chi tiết: </label>
                        <span><?= htmlspecialchars($order['address_detail']) ?></span>
                    </div>
                    <div class="card_item">
                        <label>Xác nhận thanh toán: </label>
                        <span><?= htmlspecialchars($order['payment_method']) ?></span>
                    </div>
                    <div class="card_item">
                        <label for="Addressdetail">Địa chỉ chi tiết: </label>
                        <textarea readonly name="note" placeholder="Ghi chú"><?= htmlspecialchars($order['note']) ?></textarea>
                    </div>
                </div>
            </div>
            <div class="order-summary">
                <h2>ĐƠN HÀNG</h2>
                <div class="order-items">
                    <?php while ($item = $items->fetch_assoc()): ?>
                        <div class="order-item">
                            <img src="../assets/images/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                            <div class="item-details">
                                <p><?= htmlspecialchars($item['name']) ?></p>
                                <span class="item-price"><?= number_format($item['priceEach'], 0, ',', '.') ?>₫</span>
                            </div>
                            <div class="quantity-control">
                                <label>SL:</label>
                                <span><?= $item['quantity'] ?></span>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
