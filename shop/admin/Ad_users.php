<?php session_start(); ?>
<?php require_once("../settings/config.php") ?>

<?php
    $sql = "SELECT id_user, name, phone, created_at, is_active FROM users ORDER BY created_at DESC";
    $result = $conn->query($sql);
    if(($result->num_rows > 0)):
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

    <header>
        <h1>Quản trị Laptop Store</h1>
    </header>

    <div class="container">
        <nav class="sidebar">
            <h2>Menu Admin</h2>
            <a href="Ad_index.php">Trang chủ</a>
            <a href="Ad_Products.php">Quản lý sản phẩm</a>
            <a href="Ad_order.php">Quản lý đơn hàng</a>
            <a href="Ad_users.php">Quản lý người dùng</a>
            <a href="../logout.php" class="logout" onclick="return confirm('Bạn có chắc muốn Đăng xuất tài khoản?')">Đăng xuất</a>
        </nav>

        <main class="main-content">
            <div class="card">
                <h2>Quản lý người dùng</h2>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên người dùng</th>
                        <th>Số điện thoại</th>
                        <th>Ngày tạo</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($row = $result->fetch_assoc()){
                            $formatted_date = date("d/m/Y H:i", strtotime($row['created_at']));
                            $is_active = $row['is_active'];
                            echo'
                            <tr>
                                <td>'.$row['id_user'].'</td>
                                <td>'.$row['name'].'</td>
                                <td>'.$row['phone'].'</td>
                                <td>'. $formatted_date . '</td>
                                <td>
                                    <select class="btn btn_select" onchange="confirmChange(this, '.$row['id_user'].')" data-current="'.$is_active.'">
                                        <option value="1" '.($is_active == 1 ? 'selected' : '').'>Hoạt động</option>
                                        <option value="0" '.($is_active == 0 ? 'selected' : '').'>Vô hiệu hóa</option>
                                    </select>
                                </td>
                            </tr>';
                        }
                    endif;
                    ?>
                </tbody>
            </table>
        </main>
    </div>
    <script>
        function confirmChange(selectElement, userId) {
            const statusText = selectElement.value === '1' ? 'Hoạt động' : 'Vô hiệu hóa';

            if (confirm(`Bạn có chắc chắn muốn thay đổi quyền sang "${statusText}" không?`)) {
                const newValue = selectElement.value;

                // Đổi màu sau khi xác nhận
                selectElement.style.backgroundColor = newValue === '1' ? '#02a502' : '#e74c3c';

                // Gửi request thay đổi
                window.location.href = `../process_Ad/change_isaction.php?id=${userId}&isactive=${newValue}`;
            } else {
                const currentValue = selectElement.getAttribute('data-current');
                selectElement.value = currentValue;

                // Khôi phục màu nền theo trạng thái ban đầu
                selectElement.style.backgroundColor = currentValue === '1' ? '#02a502' : '#e74c3c';
            }
        }

        // Tự đổi màu ngay khi trang load
        window.addEventListener('DOMContentLoaded', () => {
            const selects = document.querySelectorAll('.btn_select');
            selects.forEach(select => {
                const value = select.value;
                select.style.backgroundColor = value === '1' ? '#02a502' : '#e74c3c';
            });
        });
    </script>

</body>
</html>
