-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3307
-- Thời gian đã tạo: Th6 10, 2025 lúc 06:20 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shop_laptop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orderdetails`
--

CREATE TABLE `orderdetails` (
  `id_orderdetail` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1,
  `priceEach` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orderdetails`
--

INSERT INTO `orderdetails` (`id_orderdetail`, `order_id`, `product_id`, `quantity`, `priceEach`) VALUES
(86, 71, 1, 1, 18500000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `province` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `ward` varchar(100) NOT NULL,
  `address_detail` text DEFAULT NULL,
  `note` text DEFAULT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `status` enum('Chờ xử lý','Hủy','Hoàn thành') NOT NULL DEFAULT 'Chờ xử lý',
  `total` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id_order`, `user_id`, `full_name`, `phone`, `email`, `province`, `district`, `ward`, `address_detail`, `note`, `order_date`, `status`, `total`, `payment_method`) VALUES
(71, 5, 'Lê Mạnh Dũng', '0395230327', 'lemot500@gmail.com', 'Hà Nội', 'HaDong', 'Văn Phú', '', '', '2025-06-10 23:18:10', 'Hủy', 18500000.00, 'COD');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id_product`, `name`, `description`, `price`, `image`) VALUES
(1, 'Dell Inspiron 15', '- Dell Inspiron 15 là một chiếc laptop đa năng, được thiết kế để đáp ứng nhu cầu của người dùng hiện đại.\r\n- Với màn hình 15.6 inch Full HD, bạn sẽ được trải nghiệm hình ảnh sắc nét và màu sắc sống động, rất phù hợp cho việc xem phim, chơi game hay thực hiện các tác vụ văn phòng.\r\n- Laptop được trang bị bộ vi xử lý Intel Core i5 thế hệ mới, đảm bảo hiệu suất mượt mà trong mọi tác vụ từ lướt web đến xử lý đồ họa. \r\n- Bên cạnh đó, thời lượng pin lâu dài giúp bạn làm việc suốt cả ngày mà không lo gián đoạn. \r\n- Với thiết kế thanh lịch và trọng lượng nhẹ, Dell Inspiron 15 là lựa chọn lý tưởng cho cả công việc và giải trí.', 18500000.00, 'dell_inspiron_15.jpg'),
(2, 'HP Envy x360', '- HP Envy x360 là một chiếc laptop 2 trong 1 tuyệt vời, cho phép bạn dễ dàng chuyển đổi giữa chế độ laptop và tablet chỉ với một cú xoay gập nhẹ nhàng. \r\n- Màn hình cảm ứng 15.6 inch với độ phân giải Full HD mang lại trải nghiệm tương tác mượt mà và trực quan.\r\n- Được trang bị bộ vi xử lý AMD Ryzen 5, HP Envy x360 không chỉ mạnh mẽ mà còn tiết kiệm năng lượng, giúp bạn thực hiện nhiều công việc cùng lúc mà không gặp trở ngại. \r\n- Ngoài ra, thiết kế sang trọng với khung kim loại và bàn phím có đèn nền cũng là điểm cộng lớn, khiến sản phẩm này trở thành một lựa chọn hoàn hảo cho những ai yêu thích sự linh hoạt và phong cách.', 22000000.00, 'hp_envy_x360.jpg'),
(3, 'Acer Aspire 5', '- Acer Aspire 5 là chiếc laptop lý tưởng cho học sinh sinh viên và người làm việc văn phòng.\r\n- Với thiết kế mỏng nhẹ nhưng chắc chắn, màn hình 15.6 inch Full HD mang đến hình ảnh rõ nét và chân thực.\r\n- Được trang bị bộ vi xử lý Intel Core i5 và bộ nhớ RAM 8GB, Aspire 5 có khả năng xử lý đa nhiệm mượt mà, cho phép bạn chạy cùng lúc nhiều ứng dụng mà không bị lag.\r\n- Thời lượng pin lâu dài giúp bạn yên tâm làm việc cả ngày mà không cần sạc. \r\n- Laptop cũng có nhiều cổng kết nối, bao gồm USB-C, HDMI, và khe thẻ SD, đáp ứng nhu cầu kết nối của bạn trong công việc hàng ngày.', 15000000.00, 'acer_aspire_5.jpg'),
(4, 'Lenovo IdeaPad 3', '- Lenovo IdeaPad 3 là lựa chọn tuyệt vời cho những ai cần một chiếc laptop đáng tin cậy với mức giá hợp lý.\r\n- Với màn hình 15.6 inch và bộ vi xử lý AMD Ryzen 5, sản phẩm này có thể xử lý tốt các tác vụ cơ bản như lướt web, xem phim, và làm việc văn phòng.\r\n- Thiết kế đơn giản nhưng hiện đại, cùng với bàn phím êm ái, giúp bạn dễ dàng làm việc trong thời gian dài mà không cảm thấy mệt mỏi.\r\n- Ngoài ra, Lenovo cũng trang bị cho IdeaPad 3 công nghệ âm thanh Dolby Audio, mang lại trải nghiệm nghe nhạc và xem phim tuyệt vời.\r\n- Đây thực sự là một sản phẩm lý tưởng cho người dùng tìm kiếm sự tiện lợi và hiệu suất cao.', 14000000.00, 'lenovo_ideapad_3.jpg'),
(5, 'ASUS ZenBook 14', '- ASUS ZenBook 14 là một trong những mẫu laptop mỏng nhẹ nhất trên thị trường hiện nay, với thiết kế siêu thanh lịch và trọng lượng chỉ khoảng 1.3 kg.\r\n- Màn hình 14 inch Full HD với viền mỏng giúp tối ưu hóa không gian hiển thị, mang đến trải nghiệm hình ảnh sống động.\r\n- Được trang bị bộ vi xử lý Intel Core i7 mới nhất cùng với RAM 16GB, ZenBook 14 có hiệu suất vượt trội, đáp ứng tốt mọi nhu cầu từ làm việc đến giải trí.\r\n- Thời lượng pin lên tới 12 giờ giúp bạn tự tin sử dụng cả ngày mà không cần sạc.\r\n- Ngoài ra, laptop còn đi kèm với bàn phím có đèn nền và cảm biến vân tay, tăng cường tính bảo mật và tiện lợi cho người dùng.', 21000000.00, 'asus_zenbook_14.jpg'),
(6, 'MacBook Pro M2', '- MacBook Pro M2 là một sản phẩm đỉnh cao từ Apple, được trang bị vi xử lý M2 mạnh mẽ, cho hiệu suất vượt trội trong mọi tác vụ, từ chỉnh sửa video đến lập trình.\r\n- Màn hình Retina 13.3 inch với độ phân giải cao mang đến hình ảnh sắc nét, màu sắc chân thực, rất lý tưởng cho các nhà thiết kế đồ họa và nhiếp ảnh gia.\r\n- Thời gian sử dụng pin lên tới 20 giờ là một điểm cộng lớn, giúp bạn làm việc liên tục mà không cần lo lắng về việc sạc.\r\n- Thiết kế nhôm nguyên khối sang trọng và bền bỉ cùng với hệ điều hành macOS mượt mà, MacBook Pro M2 chắc chắn sẽ mang đến cho bạn những trải nghiệm tốt nhất.', 36000000.00, 'macbook_pro_m2.jpg'),
(7, 'MSI GF63 Thin', '- MSI GF63 Thin là laptop gaming lý tưởng cho những game thủ yêu thích sự mỏng nhẹ nhưng vẫn mạnh mẽ.\r\n- Với màn hình 15.6 inch Full HD và tần số quét 144Hz, bạn sẽ có những trải nghiệm chơi game mượt mà, sống động.\r\n- Được trang bị bộ vi xử lý Intel Core i5 và card đồ họa NVIDIA GeForce GTX 1650, GF63 Thin có khả năng xử lý tốt các tựa game mới nhất.\r\n- Thiết kế tinh tế với đèn nền bàn phím RGB tạo cảm hứng cho người sử dụng.\r\n- Thời lượng pin hợp lý và khả năng tản nhiệt hiệu quả giúp bạn chơi game trong thời gian dài mà không lo bị nóng máy.', 19000000.00, 'msi_gf63_thin.jpg'),
(8, 'Gigabyte G5', '- Gigabyte G5 là laptop gaming mạnh mẽ với thiết kế hầm hố và hiệu năng vượt trội.\r\n- Màn hình 15.6 inch Full HD với tần số quét 144Hz mang đến những trải nghiệm hình ảnh chân thực và mượt mà.\r\n- Sản phẩm được trang bị bộ vi xử lý Intel Core i7 và card đồ họa NVIDIA GeForce RTX 3050, đảm bảo khả năng xử lý tốt các tựa game đồ họa nặng.\r\n- Hệ thống tản nhiệt hiệu quả giúp máy luôn mát mẻ trong suốt quá trình sử dụng.\r\n- Bàn phím cơ với đèn nền RGB không chỉ đẹp mắt mà còn tối ưu hóa trải nghiệm chơi game của bạn.', 20500000.00, 'gigabyte_g5.jpg'),
(9, 'Surface Laptop 5', '- Surface Laptop 5 là một trong những sản phẩm nổi bật nhất của Microsoft, với thiết kế tinh tế, mỏng nhẹ và màn hình 13.5 inch PixelSense sắc nét.\r\n- Được trang bị bộ vi xử lý Intel Core i5, Surface Laptop 5 mang lại hiệu suất mạnh mẽ cho mọi tác vụ, từ làm việc văn phòng đến giải trí.\r\n- Thời gian sử dụng pin lên tới 15 giờ giúp bạn làm việc cả ngày mà không cần sạc.\r\n- Bàn phím có độ nảy tốt và cảm giác thoải mái khi gõ, cùng với khả năng cảm ứng mượt mà, tạo nên trải nghiệm người dùng tuyệt vời.', 29500000.00, 'surface_laptop_5.jpg'),
(10, 'Huawei MateBook D15', '- Huawei MateBook D15 là một chiếc laptop lý tưởng cho người dùng cần sự cân bằng giữa hiệu suất và giá cả.\r\n- Với màn hình 15.6 inch Full HD, hình ảnh sắc nét và màu sắc trung thực, sản phẩm này rất phù hợp cho việc học tập và giải trí.\r\n- Được trang bị bộ vi xử lý AMD Ryzen 5 và RAM 8GB, MateBook D15 có thể xử lý tốt nhiều tác vụ cùng lúc.\r\n- Thiết kế mỏng nhẹ và thời lượng pin ấn tượng giúp bạn dễ dàng mang theo bên mình.\r\n- Ngoài ra, laptop còn được trang bị công nghệ âm thanh Dolby Atmos, mang đến trải nghiệm nghe nhạc và xem phim tuyệt vời.', 17900000.00, 'huawei_matebook_d15.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_specs`
--

CREATE TABLE `product_specs` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `spec_attribute_id` int(11) NOT NULL,
  `value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_specs`
--

INSERT INTO `product_specs` (`id`, `product_id`, `spec_attribute_id`, `value`) VALUES
(133, 1, 1, 'Intel Core i5-1135G7'),
(134, 1, 2, '8GB DDR4'),
(135, 1, 3, '256GB SSD'),
(136, 1, 4, 'Intel Iris Xe Graphics'),
(137, 2, 1, 'AMD Ryzen 5 4500U'),
(138, 2, 2, '16GB DDR4'),
(139, 2, 3, '512GB SSD'),
(140, 2, 4, 'AMD Radeon Graphics'),
(141, 3, 1, 'Intel Core i5-1035G1'),
(142, 3, 2, '8GB DDR4'),
(143, 3, 3, '512GB SSD'),
(144, 3, 4, 'Intel UHD Graphics'),
(145, 4, 1, 'AMD Ryzen 5 5500U'),
(146, 4, 2, '8GB DDR4'),
(147, 4, 3, '256GB SSD'),
(148, 4, 4, 'AMD Radeon Graphics'),
(149, 5, 1, 'Intel Core i7-1165G7'),
(150, 5, 2, '16GB DDR4'),
(151, 5, 3, '512GB SSD'),
(152, 5, 4, 'Intel Iris Xe Graphics'),
(153, 6, 1, 'Apple M1 Pro'),
(154, 6, 2, '16GB Unified Memory'),
(155, 6, 3, '1TB SSD'),
(156, 6, 4, 'Apple Integrated Graphics'),
(157, 7, 1, 'Intel Core i5-9300H'),
(158, 7, 2, '8GB DDR4'),
(159, 7, 3, '512GB SSD'),
(160, 7, 4, 'NVIDIA GeForce GTX 1650'),
(161, 8, 1, 'Intel Core i7-12700H'),
(162, 8, 2, '16GB DDR4'),
(163, 8, 3, '1TB SSD'),
(164, 8, 4, 'NVIDIA GeForce RTX 3050'),
(165, 9, 1, 'Intel Core i5-1235U'),
(166, 9, 2, '16GB LPDDR5'),
(167, 9, 3, '512GB SSD'),
(168, 9, 4, 'Intel Iris Xe Graphics'),
(169, 10, 1, 'AMD Ryzen 5 5500U'),
(170, 10, 2, '8GB DDR4'),
(171, 10, 3, '512GB SSD'),
(172, 10, 4, 'AMD Radeon Graphics');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `saved_carts`
--

CREATE TABLE `saved_carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL,
  `saved_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `spec_attributes`
--

CREATE TABLE `spec_attributes` (
  `id` int(11) NOT NULL,
  `spec_group_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `spec_attributes`
--

INSERT INTO `spec_attributes` (`id`, `spec_group_id`, `name`) VALUES
(1, 1, 'Bộ vi xử lý (CPU)'),
(2, 1, 'Bộ nhớ RAM'),
(3, 1, 'Ổ cứng'),
(4, 1, 'Card đồ họa');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `spec_groups`
--

CREATE TABLE `spec_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `spec_groups`
--

INSERT INTO `spec_groups` (`id`, `name`) VALUES
(1, 'Thông số kĩ thuật');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `role` enum('Admin','Khách hàng') NOT NULL DEFAULT 'Khách hàng',
  `name` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id_user`, `role`, `name`, `phone`, `Password`, `created_at`, `is_active`) VALUES
(1, 'Admin', 'Nguyễn Văn A', '0399999999', '111111', '2025-06-08 18:59:13', 1),
(2, 'Khách hàng', 'Trần Thị B', '0902223344', '222222', '2025-06-08 18:59:13', 1),
(3, 'Khách hàng', 'Lê Minh C', '0903334455', '333333', '2025-06-08 18:59:13', 1),
(4, 'Khách hàng', 'Phạm Thu D', '0904445566', '444444', '2025-06-08 18:59:13', 1),
(5, 'Khách hàng', 'Lê Mạnh Dũng', '0395230327', '123456', '2025-06-08 20:53:00', 1),
(6, 'Khách hàng', 'Lê Mạnh Dũng', '0398888888', '123456', '2025-06-09 19:03:21', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`id_orderdetail`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`);

--
-- Chỉ mục cho bảng `product_specs`
--
ALTER TABLE `product_specs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_id` (`product_id`,`spec_attribute_id`),
  ADD KEY `spec_attribute_id` (`spec_attribute_id`);

--
-- Chỉ mục cho bảng `saved_carts`
--
ALTER TABLE `saved_carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `spec_attributes`
--
ALTER TABLE `spec_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `spec_group_id` (`spec_group_id`);

--
-- Chỉ mục cho bảng `spec_groups`
--
ALTER TABLE `spec_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `id_orderdetail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `product_specs`
--
ALTER TABLE `product_specs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT cho bảng `saved_carts`
--
ALTER TABLE `saved_carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `spec_attributes`
--
ALTER TABLE `spec_attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `spec_groups`
--
ALTER TABLE `spec_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id_order`),
  ADD CONSTRAINT `orderdetails_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id_product`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`);

--
-- Các ràng buộc cho bảng `product_specs`
--
ALTER TABLE `product_specs`
  ADD CONSTRAINT `product_specs_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id_product`),
  ADD CONSTRAINT `product_specs_ibfk_2` FOREIGN KEY (`spec_attribute_id`) REFERENCES `spec_attributes` (`id`);

--
-- Các ràng buộc cho bảng `saved_carts`
--
ALTER TABLE `saved_carts`
  ADD CONSTRAINT `saved_carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `saved_carts_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id_product`);

--
-- Các ràng buộc cho bảng `spec_attributes`
--
ALTER TABLE `spec_attributes`
  ADD CONSTRAINT `spec_attributes_ibfk_1` FOREIGN KEY (`spec_group_id`) REFERENCES `spec_groups` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
