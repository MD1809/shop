<?php session_start(); ?>
<?php require_once('../settings/config.php'); ?>

<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-select-add'])){
        header("location: index.php");
        exit();
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_button'])){
    
        if(!isset($_SESSION['id'])){
            echo "
            <script>
                if (confirm('Bạn cần đăng nhập để tiếp tục đặt hàng. Bạn có muốn đăng nhập ngay không?')) {
                    window.location.href = '../login.php';
                } else {
                    //alert('Đặt hàng bị hủy vì bạn chưa đăng nhập.');
                }
            </script>
            ";
            exit();
        }

        $cart = [];
        if (isset($_SESSION['order_items']) && !empty($_SESSION['order_items'])) {
            $cart = $_SESSION['order_items'];
        } elseif (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
        } else {
            echo "Không có sản phẩm nào để đặt hàng!";
            exit();
        }

        // Cập nhật số lượng theo product_id
        if (isset($_POST['items']) && isset($_SESSION['cart']) && $cart === $_SESSION['cart']) {
            foreach ($_POST['items'] as $product_id => $itemPost) {
                foreach ($_SESSION['cart'] as $index => $cartItem) {
                    if ($cartItem['product_id'] == $product_id) {
                        $_SESSION['cart'][$index]['quantity'] = (int)$itemPost['quantity'];
                        break;
                    }
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
        //$cart = $_SESSION['cart'];
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

        // 3. Xóa sản phẩm đã mua khỏi giỏ hàng
        if (isset($_SESSION['order_selected'])) {
            foreach ($_SESSION['order_selected'] as $product_id) {
                foreach ($_SESSION['cart'] as $index => $cartItem) {
                    if ($cartItem['product_id'] == $product_id) {
                        unset($_SESSION['cart'][$index]);
                        break;
                    }
                }
            }

            // Làm phẳng lại mảng cart
            $_SESSION['cart'] = array_values($_SESSION['cart']);

            // Nếu giỏ hàng trống thì xoá luôn
            if (empty($_SESSION['cart'])) {
                unset($_SESSION['cart']);
            }

            // Xóa session tạm
            unset($_SESSION['order_items'], $_SESSION['order_selected']);
        }
        // 4. Chuyển hướng sau khi đặt hàng thành công
        header("Location: ../order.php");
        exit();
    }
?> 