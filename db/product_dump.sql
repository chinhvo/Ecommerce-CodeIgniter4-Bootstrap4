-- Sample product dump — electric vehicles (Xe Chạy Điện)
-- Generated: April 2026 | abbr='vi' | 30 products

SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE products_translations;
TRUNCATE TABLE products;

-- shop_categorie column now references level-3 leaf categories (IDs 19-138)
-- Product → Category mapping:
--  1 Scooter X6          → 39 Xe Máy Điện Dưới 10 Triệu
--  2 Smart V9 Plus       → 42 Xe Máy Điện Smart
--  3 TYPE3 Pro           → 54 Xe Máy Điện Thể Thao
--  4 V1 Plus Livo        → 45 Xe Máy Điện Dành Cho Nữ
--  5 YAKA VX             → 55 Xe Máy Điện YAKA
--  6 YAKA LAVARA         → 55 Xe Máy Điện YAKA
--  7 Smart V1 Pro        → 42 Xe Máy Điện Smart
--  8 DYLEXE X1           → 56 Xe Máy Điện DYLEXE
--  9 Dior Livo           → 58 Xe Máy Điện Dior
-- 10 Vnbike X6           → 41 Xe Máy Điện Vnbike
-- 11 Vnbike i1           → 25 Xe Đạp Điện Vnbike
-- 12 Smart A9            → 42 Xe Máy Điện Smart
-- 13 Vnbike A8           → 41 Xe Máy Điện Vnbike
-- 14 Vnbike V1 18inh     → 25 Xe Đạp Điện Vnbike
-- 15 Hotgirl G1          → 19 Xe Đạp Điện Nữ
-- 16 VinFast VF3         → 61 Ô Tô Điện VinFast
-- 17 Smart M700          → 88 Xe 3 Bánh Smart M700
-- 18 Bestune Xiaoma      → 63 Ô Tô Điện Bestune
-- 19 Yadea E3            → 24 Xe Đạp Điện Yadea
-- 20 TAILG F73           → 49 Xe Máy Điện TAILG
-- 21 Bộ sạc 60V 12A     → 120 Bộ Sạc 60V
-- 22 Ắc quy Lithium 60V → 133 Pin Lithium 60V
-- 23 Trạm sạc AC 7kW    → 122 Trạm Sạc AC Gia Đình
-- 24 Xe điện trẻ em     → 32  Xe Điện Mini 3 Bánh
-- 25 Pega NewTech 2024  → 43  Xe Máy Điện Pega
-- 26 Kazuki S5 Plus     → 26  Xe Đạp Điện Kazuki
-- 27 Ắc quy GEL 48V    → 129 Ắc Quy GEL 48V
-- 28 Giant HP3 2024     → 50  Xe Máy Điện Giant
-- 29 Đèn pha LED        → 111 Đèn Pha LED Xe Máy Điện
-- 30 EV-K300            → 90  Xe 3 Bánh Resort
INSERT INTO `products` (`id`, `folder`, `image`, `time`, `time_update`, `visibility`, `shop_categorie`, `quantity`, `procurement`, `in_slider`, `url`, `virtual_products`, `brand_id`, `position`, `vendor_id`) VALUES
(1,   1, 'product_1.jpg',  1745740800, 1745740800, 1, 39,  20, 5500000,   0, 'xe-dien-scooter-x6',                NULL, NULL, 1,  0),
(2,   2, 'product_2.jpg',  1745740800, 1745740800, 1, 42,  15, 7500000,   0, 'xe-dien-smart-v9-plus',             NULL, NULL, 2,  0),
(3,   3, 'product_3.jpg',  1745740800, 1745740800, 1, 54,  10, 9800000,   0, 'xe-dien-type3-pro',                 NULL, NULL, 3,  0),
(4,   4, 'product_4.jpg',  1745740800, 1745740800, 1, 45,  18, 7700000,   0, 'xe-dien-v1-plus-livo',              NULL, NULL, 4,  0),
(5,   5, 'product_5.jpg',  1745740800, 1745740800, 1, 55,  12, 7500000,   0, 'xe-dien-yaka-vx',                  NULL, NULL, 5,  0),
(6,   6, 'product_6.jpg',  1745740800, 1745740800, 1, 55,  10, 8200000,   0, 'xe-dien-yaka-lavara',              NULL, NULL, 6,  0),
(7,   7, 'product_7.jpg',  1745740800, 1745740800, 1, 42,  25, 7200000,   0, 'xe-dien-smart-v1-pro',             NULL, NULL, 7,  0),
(8,   8, 'product_8.jpg',  1745740800, 1745740800, 1, 56,   8, 10000000,  0, 'xe-dien-hot-trend-dylexe-x1',      NULL, NULL, 8,  0),
(9,   9, 'product_9.jpg',  1745740800, 1745740800, 1, 58,  14, 9100000,   0, 'xe-dien-dior-livo',                NULL, NULL, 9,  0),
(10, 10, 'product_10.jpg', 1745740800, 1745740800, 1, 41,  20, 7800000,   0, 'xe-dien-vnbike-x6',                NULL, NULL, 10, 0),
(11, 11, 'product_11.jpg', 1745740800, 1745740800, 1, 25,  30, 6500000,   0, 'xe-dap-dien-vnbike-i1',            NULL, NULL, 11, 0),
(12, 12, 'product_12.jpg', 1745740800, 1745740800, 1, 42,  12, 8500000,   0, 'xe-dien-smart-a9',                 NULL, NULL, 12, 0),
(13, 13, 'product_13.jpg', 1745740800, 1745740800, 1, 41,  22, 5900000,   0, 'xe-dien-vnbike-a8',                NULL, NULL, 13, 0),
(14, 14, 'product_14.jpg', 1745740800, 1745740800, 1, 25,  28, 5500000,   0, 'xe-dap-dien-vnbike-v1-18inh',      NULL, NULL, 14, 0),
(15, 15, 'product_15.jpg', 1745740800, 1745740800, 1, 19,  18, 7800000,   0, 'xe-dap-dien-vnbike-hotgirl-g1',    NULL, NULL, 15, 0),
(16, 16, 'product_16.jpg', 1745740800, 1745740800, 1, 61,   3, 200000000, 1, 'o-to-dien-vinfast-vf3-thue-pin',   NULL, NULL, 16, 0),
(17, 17, 'product_17.jpg', 1745740800, 1745740800, 1, 88,   5, 18000000,  0, 'xe-3-banh-cho-hang-smart-m700',    NULL, NULL, 17, 0),
(18, 18, 'product_18.jpg', 1745740800, 1745740800, 1, 63,   2, 165000000, 1, 'o-to-dien-bestune-xiaoma',         NULL, NULL, 18, 0),
(19, 19, 'product_19.jpg', 1745740800, 1745740800, 1, 24,  35, 5200000,   0, 'xe-dap-dien-yadea-e3',             NULL, NULL, 19, 0),
(20, 20, 'product_20.jpg', 1745740800, 1745740800, 1, 49,   8, 11000000,  0, 'xe-may-dien-tailg-f73',            NULL, NULL, 20, 0),
(21, 21, 'product_21.jpg', 1745740800, 1745740800, 1, 120, 50, 210000,    0, 'bo-sac-xe-dien-60v-12a',           NULL, NULL, 21, 0),
(22, 22, 'product_22.jpg', 1745740800, 1745740800, 1, 133, 40, 1900000,   0, 'ac-quy-xe-dien-60v-20ah-lithium',  NULL, NULL, 22, 0),
(23, 23, 'product_23.jpg', 1745740800, 1745740800, 1, 122, 10, 5800000,   0, 'tram-sac-xe-dien-ac-7kw',          NULL, NULL, 23, 0),
(24, 24, 'product_24.jpg', 1745740800, 1745740800, 1,  32, 20, 1600000,   0, 'xe-dien-tre-em-mini-3-banh-36v',   NULL, NULL, 24, 0),
(25, 25, 'product_25.jpg', 1745740800, 1745740800, 1,  43,  6, 13000000,  0, 'xe-may-dien-pega-newtech-2024',    NULL, NULL, 25, 0),
(26, 26, 'product_26.jpg', 1745740800, 1745740800, 1,  26, 20, 6200000,   0, 'xe-dien-kazuki-s5-plus',           NULL, NULL, 26, 0),
(27, 27, 'product_27.jpg', 1745740800, 1745740800, 1, 129, 60, 750000,    0, 'binh-ac-quy-48v-12ah',             NULL, NULL, 27, 0),
(28, 28, 'product_28.jpg', 1745740800, 1745740800, 1,  50,  8, 9500000,   0, 'xe-may-dien-giant-hp3-2024',       NULL, NULL, 28, 0),
(29, 29, 'product_29.jpg', 1745740800, 1745740800, 1, 111, 80, 200000,    0, 'den-pha-led-xe-dien-sieu-sang',    NULL, NULL, 29, 0),
(30, 30, 'product_30.jpg', 1745740800, 1745740800, 1,  90,  4, 25000000,  0, 'xe-dien-3-banh-cho-khach-ev-k300', NULL, NULL, 30, 0);

INSERT INTO `products_translations` (`id`, `title`, `description`, `basic_description`, `price`, `old_price`, `abbr`, `for_id`) VALUES
(1, 'Xe điện Scooter X6',
'<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />
- Tốc độ tối đa: 45 km/h<br />
- Quãng đường đi được: 70 km/lần sạc<br />
- Công suất động cơ: 500 W<br />
- Điện áp ắc quy: 60V<br />
- Dung lượng ắc quy: 20Ah<br />
- Thời gian sạc đầy: 6 - 8 giờ<br />
- Trọng lượng xe: 45 kg<br />
- Tải trọng tối đa: 120 kg</p>
<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />
- Thiết kế thể thao, trẻ trung, phù hợp học sinh sinh viên và người đi làm<br />
- Động cơ brushless không chổi than, vận hành êm ái, bền bỉ<br />
- Tiết kiệm chi phí nhiên liệu, thân thiện với môi trường<br />
- Ắc quy GEL chất lượng cao, chu kỳ sạc dài<br />
- Hệ thống phanh đĩa phía trước, phanh cơ phía sau đảm bảo an toàn<br />
- Đèn LED chiếu sáng mạnh, tiết kiệm điện</p>
<p><strong>CHÍNH SÁCH BẢO HÀNH &amp; DỊCH VỤ:</strong><br />
- Bảo hành toàn xe: 12 tháng<br />
- Bảo hành ắc quy: 12 tháng<br />
- Bảo hành động cơ: 24 tháng<br />
- Giao hàng tận nơi, lắp ráp miễn phí trong nội thành</p>',
'Xe điện Scooter X6 thiết kế thể thao, tốc độ tối đa 45 km/h, quãng đường 70 km/lần sạc.',
'8500000', '9500000', 'vi', 1),

(2, 'Xe điện Smart V9 Plus',
'<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />
- Tốc độ tối đa: 50 km/h<br />
- Quãng đường đi được: 80 km/lần sạc<br />
- Công suất động cơ: 500 W<br />
- Điện áp ắc quy: 60V<br />
- Dung lượng ắc quy: 20Ah<br />
- Thời gian sạc đầy: 6 - 8 giờ<br />
- Trọng lượng xe: 48 kg<br />
- Tải trọng tối đa: 120 kg</p>
<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />
- Thiết kế hiện đại, sang trọng phù hợp nhiều đối tượng sử dụng<br />
- Động cơ brushless mạnh mẽ, vận hành êm ái<br />
- Tiết kiệm chi phí nhiên liệu, thân thiện với môi trường<br />
- Ắc quy Lithium chất lượng cao, chu kỳ sạc dài<br />
- Có công tắc khóa xe, chống trộm hiệu quả</p>
<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />
- Bảo hành toàn xe: 12 tháng<br />
- Bảo hành ắc quy: 12 tháng<br />
- Bảo hành động cơ: 24 tháng</p>',
'Xe điện Smart V9 Plus kiểu dáng hiện đại, động cơ 500W, phạm vi hoạt động 80 km/lần sạc.',
'11500000', '12500000', 'vi', 2),

(3, 'Xe điện TYPE3 Pro',
'<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />
- Tốc độ tối đa: 55 km/h<br />
- Quãng đường đi được: 90 km/lần sạc<br />
- Công suất động cơ: 800 W<br />
- Điện áp ắc quy: 72V<br />
- Dung lượng ắc quy: 20Ah<br />
- Thời gian sạc đầy: 7 - 9 giờ<br />
- Trọng lượng xe: 55 kg<br />
- Tải trọng tối đa: 150 kg</p>
<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />
- Khung thép cường lực, chắc chắn, bền bỉ theo thời gian<br />
- Động cơ 800W mạnh mẽ, leo dốc tốt<br />
- Màn hình LCD hiển thị tốc độ, quãng đường, mức pin<br />
- Phanh đĩa cả 2 bánh, an toàn tuyệt đối<br />
- Hệ thống đèn LED đầy đủ, tầm nhìn tốt ban đêm</p>
<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />
- Bảo hành toàn xe: 12 tháng<br />
- Bảo hành ắc quy: 12 tháng<br />
- Bảo hành động cơ: 24 tháng<br />
- Hỗ trợ bảo dưỡng miễn phí lần đầu tại cửa hàng</p>',
'Xe điện TYPE3 Pro cao cấp, khung thép cường lực, tốc độ 55 km/h, phạm vi 90 km.',
'14990000', '16990000', 'vi', 3),

(4, 'Xe điện V1 Plus Livo',
'<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />
- Tốc độ tối đa: 45 km/h<br />
- Quãng đường đi được: 75 km/lần sạc<br />
- Công suất động cơ: 500 W<br />
- Điện áp ắc quy: 60V<br />
- Dung lượng ắc quy: 20Ah<br />
- Thời gian sạc đầy: 6 - 8 giờ</p>
<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />
- Thiết kế thanh lịch, màu sắc pastel nhẹ nhàng dành cho nữ<br />
- Khung xe nhỏ gọn, dễ điều khiển<br />
- Yên xe êm ái, có thể điều chỉnh độ cao<br />
- Giỏ xe phía trước tiện lợi<br />
- Hệ thống chống trộm tích hợp</p>
<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />
- Bảo hành toàn xe: 12 tháng<br />
- Bảo hành ắc quy: 12 tháng<br />
- Bảo hành động cơ: 24 tháng</p>',
'Xe điện V1 Plus Livo dành cho nữ, thiết kế thanh lịch, tốc độ 45 km/h, quãng đường 75 km.',
'11800000', '13000000', 'vi', 4),

(5, 'Xe điện YAKA VX',
'<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />
- Tốc độ tối đa: 50 km/h<br />
- Quãng đường đi được: 80 km/lần sạc<br />
- Công suất động cơ: 500 W<br />
- Điện áp ắc quy: 60V<br />
- Dung lượng ắc quy: 20Ah<br />
- Thời gian sạc đầy: 6 - 8 giờ</p>
<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />
- Thiết kế mạnh mẽ, cứng cáp, phù hợp cho nam giới<br />
- Khung hợp kim nhôm siêu nhẹ<br />
- Hệ thống phanh đĩa thủy lực cả 2 bánh<br />
- Đèn pha LED projector chiếu xa<br />
- Có cổng sạc USB tích hợp trên xe</p>
<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />
- Bảo hành toàn xe: 12 tháng<br />
- Bảo hành ắc quy: 12 tháng<br />
- Bảo hành động cơ: 24 tháng</p>',
'Xe điện YAKA VX thiết kế mạnh mẽ, cứng cáp, phù hợp cho nam giới.',
'11500000', '11500000', 'vi', 5),

(6, 'Xe điện YAKA LAVARA',
'<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />
- Tốc độ tối đa: 50 km/h<br />
- Quãng đường đi được: 80 km/lần sạc<br />
- Công suất động cơ: 500 W<br />
- Điện áp ắc quy: 60V<br />
- Dung lượng ắc quy: 20Ah<br />
- Thời gian sạc đầy: 6 - 8 giờ</p>
<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />
- Phong cách châu Âu, màu sắc thời trang đa dạng<br />
- Khung xe hiện đại, đường nét mượt mà<br />
- Cụm đồng hồ kỹ thuật số hiển thị đầy đủ thông tin<br />
- Phanh đĩa phía trước, phanh tang trống phía sau<br />
- Yên da cao cấp, chịu nước</p>
<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />
- Bảo hành toàn xe: 12 tháng<br />
- Bảo hành ắc quy: 12 tháng</p>',
'Xe điện YAKA LAVARA phong cách châu Âu, màu sắc thời trang, tốc độ 50 km/h.',
'12500000', '12500000', 'vi', 6),

(7, 'Xe điện Smart V1 Pro',
'<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />
- Tốc độ tối đa: 45 km/h<br />
- Quãng đường đi được: 70 km/lần sạc<br />
- Công suất động cơ: 500 W<br />
- Điện áp ắc quy: 48V<br />
- Dung lượng ắc quy: 12Ah<br />
- Thời gian sạc đầy: 6 - 8 giờ<br />
- Trọng lượng xe: 38 kg</p>
<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />
- Nhỏ gọn, tiết kiệm, phù hợp di chuyển nội đô<br />
- Dễ điều khiển, phù hợp người mới<br />
- Chi phí vận hành cực thấp, chỉ ~4.000đ/100km<br />
- Ắc quy GEL bền, không cần bảo dưỡng thường xuyên</p>
<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />
- Bảo hành toàn xe: 12 tháng<br />
- Bảo hành ắc quy: 12 tháng<br />
- Bảo hành động cơ: 24 tháng</p>',
'Xe điện Smart V1 Pro nhỏ gọn, tiết kiệm, phù hợp di chuyển nội đô.',
'10990000', '11990000', 'vi', 7),

(8, 'Xe điện Hot Trend DYLEXE X1',
'<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />
- Tốc độ tối đa: 55 km/h<br />
- Quãng đường đi được: 90 km/lần sạc<br />
- Công suất động cơ: 800 W<br />
- Điện áp ắc quy: 72V<br />
- Dung lượng ắc quy: 20Ah<br />
- Thời gian sạc đầy: 7 - 9 giờ</p>
<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />
- Xu hướng mới 2024, thiết kế độc đáo, thu hút mọi ánh nhìn<br />
- Hệ thống đèn LED dải viền theo thân xe thời trang<br />
- Lốp xe rộng, khả năng bám đường tốt<br />
- Trang bị cổng USB sạc thiết bị di động<br />
- Hệ thống khóa chống trộm thông minh</p>
<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />
- Bảo hành toàn xe: 12 tháng<br />
- Bảo hành động cơ: 24 tháng</p>',
'Xe điện DYLEXE X1 xu hướng mới, thiết kế độc đáo, tốc độ cao 55 km/h.',
'15500000', '17000000', 'vi', 8),

(9, 'Xe điện Dior Livo',
'<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />
- Tốc độ tối đa: 45 km/h<br />
- Quãng đường đi được: 80 km/lần sạc<br />
- Công suất động cơ: 500 W<br />
- Điện áp ắc quy: 60V<br />
- Dung lượng ắc quy: 20Ah<br />
- Thời gian sạc đầy: 6 - 8 giờ</p>
<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />
- Thiết kế sang trọng, lấy cảm hứng từ thời trang cao cấp<br />
- Dành riêng cho phái đẹp, màu sắc tinh tế<br />
- Yên xe bọc da mềm mại, thoải mái khi ngồi lâu<br />
- Giỏ xe phía trước thiết kế sang trọng<br />
- Cụm đèn pha bo tròn thời trang</p>
<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />
- Bảo hành toàn xe: 12 tháng<br />
- Bảo hành ắc quy: 12 tháng<br />
- Bảo hành động cơ: 24 tháng</p>',
'Xe điện Dior Livo sang trọng, thiết kế dành cho phái đẹp, quãng đường 80 km.',
'13990000', '14990000', 'vi', 9),

(10, 'Xe điện Vnbike X6',
'<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />
- Tốc độ tối đa: 50 km/h<br />
- Quãng đường đi được: 75 km/lần sạc<br />
- Công suất động cơ: 500 W<br />
- Điện áp ắc quy: 60V<br />
- Dung lượng ắc quy: 20Ah<br />
- Thời gian sạc đầy: 6 - 8 giờ</p>
<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />
- Sản xuất tại Việt Nam, chất lượng cao, giá cạnh tranh<br />
- Linh kiện dễ tìm, chi phí bảo dưỡng thấp<br />
- Khung xe bền chắc, chịu được điều kiện đường Việt Nam<br />
- Hệ thống điện ổn định, ít hỏng vặt</p>
<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />
- Bảo hành toàn xe: 12 tháng<br />
- Bảo hành ắc quy: 12 tháng<br />
- Bảo hành động cơ: 24 tháng</p>',
'Xe điện Vnbike X6 sản xuất trong nước, chất lượng cao, giá cạnh tranh.',
'11990000', '11990000', 'vi', 10),

(11, 'Xe đạp điện Vnbike i1',
'<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />
- Tốc độ tối đa: 35 km/h<br />
- Quãng đường đi được: 60 km/lần sạc<br />
- Công suất động cơ: 250 W<br />
- Điện áp ắc quy: 48V<br />
- Dung lượng ắc quy: 12Ah<br />
- Thời gian sạc đầy: 5 - 7 giờ<br />
- Trọng lượng xe: 30 kg</p>
<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />
- Nhỏ gọn, dễ đi, phù hợp học sinh sinh viên<br />
- Có thể đạp như xe đạp thường khi hết pin<br />
- Cốp xe rộng đựng được mũ bảo hiểm<br />
- Hệ thống đèn đầy đủ, đảm bảo an toàn ban đêm</p>
<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />
- Bảo hành toàn xe: 12 tháng<br />
- Bảo hành ắc quy: 12 tháng<br />
- Bảo hành động cơ: 24 tháng</p>',
'Xe đạp điện Vnbike i1 gọn nhẹ, tiết kiệm, phù hợp học sinh sinh viên.',
'9990000', '10500000', 'vi', 11),

(12, 'Xe điện Smart A9',
'<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />
- Tốc độ tối đa: 50 km/h<br />
- Quãng đường đi được: 85 km/lần sạc<br />
- Công suất động cơ: 500 W<br />
- Điện áp ắc quy: 60V<br />
- Dung lượng ắc quy: 20Ah<br />
- Thời gian sạc đầy: 6 - 8 giờ</p>
<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />
- Cao cấp, trang bị đầy đủ, phù hợp đi làm hàng ngày<br />
- Màn hình kỹ thuật số thế hệ mới<br />
- Hệ thống thu hồi năng lượng khi phanh (regenerative braking)<br />
- Ắc quy Lithium tách rời, dễ sạc trong nhà<br />
- Khóa từ thông minh, bảo mật cao</p>
<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />
- Bảo hành toàn xe: 12 tháng<br />
- Bảo hành ắc quy: 12 tháng<br />
- Bảo hành động cơ: 24 tháng</p>',
'Xe điện Smart A9 cao cấp, trang bị đầy đủ, phù hợp đi làm hàng ngày.',
'12990000', '13990000', 'vi', 12),

(13, 'Xe điện Vnbike A8',
'<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />
- Tốc độ tối đa: 40 km/h<br />
- Quãng đường đi được: 65 km/lần sạc<br />
- Công suất động cơ: 350 W<br />
- Điện áp ắc quy: 48V<br />
- Dung lượng ắc quy: 12Ah<br />
- Thời gian sạc đầy: 5 - 7 giờ</p>
<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />
- Giá tốt, chất lượng đảm bảo, thích hợp nội thành<br />
- Thiết kế cổ điển, không lỗi mốt<br />
- Chi phí bảo dưỡng thấp, linh kiện sẵn có<br />
- Phù hợp người cao tuổi và người mới sử dụng xe điện</p>
<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />
- Bảo hành toàn xe: 12 tháng<br />
- Bảo hành ắc quy: 12 tháng</p>',
'Xe điện Vnbike A8 giá tốt, chất lượng đảm bảo, thích hợp nội thành.',
'8990000', '10000000', 'vi', 13),

(14, 'Xe đạp điện Vnbike V1 18inh',
'<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />
- Kích thước bánh: 18 inch<br />
- Tốc độ tối đa: 35 km/h<br />
- Quãng đường đi được: 60 km/lần sạc<br />
- Công suất động cơ: 250 W<br />
- Điện áp ắc quy: 48V<br />
- Dung lượng ắc quy: 12Ah<br />
- Trọng lượng xe: 28 kg</p>
<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />
- Bánh 18 inch nhỏ gọn, linh hoạt trong đô thị<br />
- Nhẹ nhàng, dễ điều khiển<br />
- Phù hợp người thấp hơn, học sinh cấp 2 cấp 3<br />
- Có thể xếp gọn, để trong cốp ô tô</p>
<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />
- Bảo hành toàn xe: 12 tháng<br />
- Bảo hành ắc quy: 12 tháng</p>',
'Xe đạp điện Vnbike V1 bánh 18 inch, nhẹ nhàng, dễ điều khiển.',
'8490000', '8990000', 'vi', 14),

(15, 'Xe đạp điện Vnbike Hotgirl G1',
'<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />
- Tốc độ tối đa: 40 km/h<br />
- Quãng đường đi được: 70 km/lần sạc<br />
- Công suất động cơ: 350 W<br />
- Điện áp ắc quy: 48V<br />
- Dung lượng ắc quy: 12Ah<br />
- Thời gian sạc đầy: 5 - 7 giờ</p>
<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />
- Thiết kế dành riêng cho nữ, màu sắc trẻ trung, nữ tính<br />
- Giỏ xe trước, kệ xe sau đa năng<br />
- Yên xe bọc da màu sắc phối hợp với màu xe<br />
- Cụm đèn hình nước mắt thời trang<br />
- Có gương chiếu hậu 2 bên</p>
<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />
- Bảo hành toàn xe: 12 tháng<br />
- Bảo hành ắc quy: 12 tháng<br />
- Bảo hành động cơ: 24 tháng</p>',
'Xe đạp điện Vnbike Hotgirl G1 thiết kế dành riêng cho nữ, màu sắc trẻ trung.',
'11990000', '11990000', 'vi', 15),

(16, 'Ô tô điện VinFast VF3 thuê pin',
'<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />
- Số chỗ ngồi: 4 người<br />
- Phạm vi hoạt động: 210 km (WLTP)<br />
- Công suất động cơ: 42 kW (57 mã lực)<br />
- Mô-men xoắn: 135 Nm<br />
- Tốc độ tối đa: 140 km/h<br />
- Tăng tốc 0-100 km/h: 11,5 giây<br />
- Dung lượng pin: 19,86 kWh<br />
- Thời gian sạc nhanh DC: 30 phút (10%-70%)<br />
- Thời gian sạc AC 7,4 kW: 4 giờ<br />
- Kích thước (D x R x C): 3.983 x 1.720 x 1.595 mm</p>
<p><strong>TRANG BỊ TIÊU CHUẨN:</strong><br />
- Màn hình giải trí cảm ứng 10 inch<br />
- Camera lùi và cảm biến đỗ xe<br />
- Điều hòa tự động<br />
- Hệ thống kết nối Apple CarPlay / Android Auto<br />
- Túi khí an toàn 6 túi<br />
- Phanh ABS + EBD + BA<br />
- Cảnh báo lệch làn đường</p>
<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />
- Bảo hành xe: 5 năm hoặc 150.000 km<br />
- Bảo hành pin thuê: không giới hạn km trong thời gian thuê<br />
- Hỗ trợ cứu hộ 24/7 toàn quốc</p>',
'Ô tô điện VinFast VF3 chính hãng, 4 chỗ ngồi, phạm vi 210 km, thuê pin tiết kiệm chi phí.',
'240000000', '240000000', 'vi', 16),

(17, 'Xe 3 bánh chở hàng Smart M700',
'<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />
- Tải trọng tối đa: 500 kg<br />
- Tốc độ tối đa: 30 km/h<br />
- Công suất động cơ: 1.200 W<br />
- Điện áp ắc quy: 60V<br />
- Dung lượng ắc quy: 40Ah<br />
- Quãng đường: 80 - 100 km/lần sạc<br />
- Thời gian sạc: 8 - 10 giờ<br />
- Kích thước thùng hàng: 120 x 80 x 50 cm</p>
<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />
- Khung xe chắc chắn bằng thép cường lực<br />
- Thùng hàng rộng rãi, có mui che mưa nắng tùy chọn<br />
- Hệ thống giảm xóc tốt, phù hợp mọi địa hình<br />
- Dễ vận hành, không cần bằng lái xe máy<br />
- Chi phí vận hành thấp so với xe xăng tương đương</p>
<p><strong>ỨNG DỤNG THỰC TẾ:</strong><br />
- Bán hàng rong, bán thức ăn lưu động<br />
- Vận chuyển hàng hóa trong khu công nghiệp, kho bãi<br />
- Giao hàng nội khu, nội bộ trong khu đô thị</p>
<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />
- Bảo hành khung xe: 24 tháng<br />
- Bảo hành động cơ: 12 tháng<br />
- Bảo hành ắc quy: 12 tháng</p>',
'Xe 3 bánh điện chở hàng Smart M700, tải trọng 500 kg, phù hợp kinh doanh buôn bán.',
'25000000', '25000000', 'vi', 17),

(18, 'Ô tô điện Bestune Xiaoma',
'<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />
- Số chỗ ngồi: 4 người<br />
- Phạm vi hoạt động: 300 km (CLTC)<br />
- Công suất động cơ: 70 kW<br />
- Mô-men xoắn: 150 Nm<br />
- Tốc độ tối đa: 150 km/h<br />
- Tăng tốc 0-100 km/h: 9,8 giây<br />
- Dung lượng pin: 32,9 kWh<br />
- Sạc nhanh DC (20%-80%): 45 phút</p>
<p><strong>TRANG BỊ TIÊU CHUẨN:</strong><br />
- Màn hình giải trí cảm ứng 12,3 inch<br />
- Điều hòa tự động 2 vùng<br />
- Camera 360 độ toàn cảnh<br />
- Hỗ trợ đỗ xe tự động<br />
- Hệ thống cảnh báo điểm mù<br />
- Ghế lái chỉnh điện 6 hướng</p>
<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />
- Bảo hành xe: 5 năm hoặc 100.000 km<br />
- Bảo hành pin: 8 năm hoặc 120.000 km<br />
- Hỗ trợ cứu hộ 24/7</p>',
'Ô tô điện Bestune Xiaoma 4 chỗ, thiết kế trẻ trung, phạm vi 300 km, phù hợp đô thị.',
'199000000', '199000000', 'vi', 18),

(19, 'Xe đạp điện Yadea E3',
'<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />
- Tốc độ tối đa: 35 km/h<br />
- Quãng đường đi được: 60 km/lần sạc<br />
- Công suất động cơ: 250 W<br />
- Điện áp ắc quy: 48V<br />
- Dung lượng ắc quy: 12Ah<br />
- Thời gian sạc đầy: 5 - 7 giờ<br />
- Trọng lượng xe: 32 kg</p>
<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />
- Nhập khẩu chính hãng từ Yadea - thương hiệu xe điện số 1 thế giới<br />
- Thiết kế nhỏ gọn, tinh tế, phù hợp thị trường Việt Nam<br />
- Ắc quy GEL chất lượng cao, bảo hành chính hãng<br />
- Dễ bảo dưỡng, linh kiện chính hãng sẵn có toàn quốc</p>
<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />
- Bảo hành toàn xe: 24 tháng (chính hãng Yadea)<br />
- Bảo hành ắc quy: 12 tháng<br />
- Bảo hành động cơ: 24 tháng</p>',
'Xe đạp điện Yadea E3 nhập khẩu chính hãng, nhỏ gọn, tiết kiệm, bảo hành 24 tháng.',
'7990000', '8990000', 'vi', 19),

(20, 'Xe máy điện TAILG F73',
'<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />
- Tốc độ tối đa: 60 km/h<br />
- Quãng đường đi được: 100 km/lần sạc<br />
- Công suất động cơ: 1.000 W<br />
- Điện áp ắc quy: 72V<br />
- Dung lượng ắc quy: 20Ah<br />
- Thời gian sạc đầy: 8 - 10 giờ<br />
- Trọng lượng xe: 70 kg<br />
- Tải trọng tối đa: 150 kg</p>
<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />
- Kiểu dáng mô tô thể thao cao cấp<br />
- Động cơ 1000W mạnh mẽ, leo dốc xuất sắc<br />
- Khung xe nhôm cao cấp, trọng lượng tối ưu<br />
- Phanh đĩa thủy lực cả 2 bánh<br />
- Giảm xóc ngược thể thao phía trước<br />
- Màn hình LCD full thông tin</p>
<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />
- Bảo hành toàn xe: 12 tháng<br />
- Bảo hành ắc quy: 12 tháng<br />
- Bảo hành động cơ: 24 tháng</p>',
'Xe máy điện TAILG F73 cao cấp, kiểu dáng mô tô thể thao, tốc độ 60 km/h.',
'16500000', '18000000', 'vi', 20),

(21, 'Bộ sạc xe điện 60V 12A',
'<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />
- Điện áp ngõ vào: 220V AC / 50Hz<br />
- Điện áp ngõ ra: 60V DC<br />
- Dòng sạc: 12A<br />
- Công suất: 720W<br />
- Hiệu suất: &gt;88%<br />
- Nhiệt độ hoạt động: -10°C đến 50°C<br />
- Kích thước: 22 x 12 x 7 cm<br />
- Trọng lượng: 1,2 kg</p>
<p><strong>TÍNH NĂNG AN TOÀN:</strong><br />
- Đèn báo đầy tự động chuyển màu xanh<br />
- Tự ngắt khi ắc quy đầy, không sạc tràn<br />
- Chống chập điện, chống quá nhiệt (OTP)<br />
- Chống ngắn mạch (SCP)<br />
- Chống quá áp ngõ ra (OVP)<br />
- Vỏ nhựa ABS chịu nhiệt cao</p>
<p><strong>TƯƠNG THÍCH:</strong><br />
- Phù hợp ắc quy GEL và AGM 60V<br />
- Dùng được cho xe điện 60V phổ biến trên thị trường</p>
<p><strong>BẢO HÀNH:</strong><br />
- Bảo hành sản phẩm: 6 tháng<br />
- Đổi trả trong 7 ngày nếu lỗi nhà sản xuất</p>',
'Bộ sạc xe điện 60V 12A, sạc nhanh, tương thích nhiều dòng xe điện, an toàn chống cháy nổ.',
'350000', '450000', 'vi', 21),

(22, 'Ắc quy xe điện 60V 20Ah Lithium',
'<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />
- Điện áp định mức: 60V<br />
- Dung lượng: 20Ah (1200Wh)<br />
- Công nghệ: Lithium Ion (NMC)<br />
- Chu kỳ sạc: 800 - 1.200 lần<br />
- Khối lượng: 4,5 kg<br />
- Kích thước: 32 x 12 x 10 cm<br />
- BMS tích hợp bảo vệ đa tầng<br />
- Nhiệt độ hoạt động: -20°C đến 60°C</p>
<p><strong>ƯU ĐIỂM VƯỢT TRỘI:</strong><br />
- Nhẹ hơn ắc quy chì cùng dung lượng 60%<br />
- Tuổi thọ dài gấp 5 - 8 lần ắc quy GEL thông thường<br />
- Sạc nhanh hơn, chỉ cần 4 - 5 giờ<br />
- Không có hiệu ứng nhớ pin, sạc khi nào cũng được<br />
- BMS tích hợp: chống quá sạc, quá xả, quá nhiệt, ngắn mạch</p>
<p><strong>BẢO HÀNH:</strong><br />
- Bảo hành: 12 tháng<br />
- Hỗ trợ kỹ thuật miễn phí tại cửa hàng</p>',
'Ắc quy Lithium 60V 20Ah cho xe điện, tuổi thọ cao hơn ắc quy chì 5-8 lần, nhẹ hơn 60%.',
'2800000', '3200000', 'vi', 22),

(23, 'Trạm sạc xe điện AC 7kW loại nhỏ',
'<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />
- Công suất: 7,4 kW<br />
- Điện áp ngõ vào: 220V AC / 1 pha / 50Hz<br />
- Dòng tối đa: 32A<br />
- Chuẩn kết nối: Type 2 (IEC 62196-2)<br />
- Chiều dài cáp: 5 m<br />
- Cấp bảo vệ: IP54 (chống bụi và nước)<br />
- Kích thước: 24 x 15 x 10 cm<br />
- Trọng lượng: 2,5 kg</p>
<p><strong>TÍNH NĂNG THÔNG MINH:</strong><br />
- Màn hình LCD hiển thị thông tin sạc<br />
- Kết nối WiFi, quản lý từ xa qua App điện thoại<br />
- Hẹn giờ sạc, kiểm soát chi phí điện<br />
- Tự động phát hiện xe và bắt đầu sạc<br />
- Bảo vệ chống sét lan truyền</p>
<p><strong>PHÙ HỢP CHO:</strong><br />
- Hộ gia đình có ô tô điện hoặc xe máy điện cao cấp<br />
- Văn phòng, tòa nhà chung cư<br />
- Bãi đỗ xe thương mại quy mô nhỏ</p>
<p><strong>BẢO HÀNH:</strong><br />
- Bảo hành thiết bị: 24 tháng<br />
- Hỗ trợ lắp đặt và kỹ thuật</p>',
'Trạm sạc xe điện AC 7kW dùng cho hộ gia đình và văn phòng, chuẩn Type 2, lắp đặt dễ dàng.',
'8500000', '10000000', 'vi', 23),

(24, 'Xe điện trẻ em mini 3 bánh 36V',
'<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />
- Độ tuổi phù hợp: 3 - 8 tuổi<br />
- Tốc độ tối đa: 6 km/h (có thể điều chỉnh 3 mức)<br />
- Công suất động cơ: 100 W<br />
- Điện áp ắc quy: 36V<br />
- Thời gian sử dụng: 1 - 2 giờ/lần sạc<br />
- Tải trọng tối đa: 30 kg<br />
- Kích thước: 90 x 50 x 55 cm</p>
<p><strong>TÍNH NĂNG AN TOÀN:</strong><br />
- Điều khiển từ xa cho bố mẹ giám sát<br />
- Dây đai an toàn 3 điểm như xe ô tô<br />
- Bánh xe silicon mềm, không trầy sàn nhà<br />
- Tốc độ giới hạn an toàn, không thể vượt quá 6 km/h<br />
- Nhựa ABS an toàn, không chứa BPA, không kim loại nặng<br />
- Tự động dừng khi phát hiện vật cản</p>
<p><strong>TÍNH NĂNG GIẢI TRÍ:</strong><br />
- Âm nhạc MP3, kết nối USB và thẻ TF<br />
- Đèn LED nhiều màu sắc<br />
- Còi điện<br />
- Màu sắc đa dạng: Đỏ, Hồng, Xanh, Vàng</p>
<p><strong>BẢO HÀNH:</strong><br />
- Bảo hành: 12 tháng<br />
- Đổi trả trong 7 ngày nếu lỗi nhà sản xuất</p>',
'Xe điện mini dành cho trẻ em 3-8 tuổi, an toàn, tốc độ giới hạn 6 km/h, điều khiển từ xa.',
'2500000', '3000000', 'vi', 24),

(25, 'Xe máy điện Pega NewTech 2024',
'<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />
- Tốc độ tối đa: 55 km/h<br />
- Quãng đường đi được: 120 km/lần sạc<br />
- Công suất động cơ: 800 W<br />
- Điện áp ắc quy: 72V<br />
- Dung lượng ắc quy: 20Ah (Lithium)<br />
- Thời gian sạc đầy: 4 - 6 giờ<br />
- Trọng lượng xe: 65 kg</p>
<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />
- Pega NewTech 2024 thế hệ mới nhất với pin Lithium thay thế ắc quy chì<br />
- Phạm vi 120 km — tăng 50% so với thế hệ trước<br />
- Sạc nhanh chỉ 4 giờ đầy bình<br />
- Kết nối Bluetooth với ứng dụng Pega App trên điện thoại<br />
- Theo dõi vị trí GPS, lịch sử hành trình<br />
- Khóa xe từ xa qua điện thoại</p>
<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />
- Bảo hành toàn xe: 12 tháng<br />
- Bảo hành pin Lithium: 24 tháng<br />
- Bảo hành động cơ: 24 tháng<br />
- Hỗ trợ cập nhật phần mềm miễn phí</p>',
'Xe máy điện Pega NewTech 2024 thế hệ mới, pin Lithium, phạm vi 120 km, sạc nhanh 4 giờ.',
'19900000', '21900000', 'vi', 25),

(26, 'Xe điện Kazuki S5 Plus',
'<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />
- Tốc độ tối đa: 45 km/h<br />
- Quãng đường đi được: 70 km/lần sạc<br />
- Công suất động cơ: 350 W<br />
- Điện áp ắc quy: 48V<br />
- Dung lượng ắc quy: 12Ah<br />
- Thời gian sạc đầy: 5 - 7 giờ</p>
<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />
- Thiết kế lấy cảm hứng từ Nhật Bản, gọn gàng tinh tế<br />
- Khung nhôm cao cấp, trọng lượng chỉ 35 kg<br />
- Giảm xóc trước dạng ống lồng<br />
- Hệ thống phanh kết hợp CBS an toàn<br />
- Màu sắc đa dạng: Trắng, Xanh, Đen, Bạc</p>
<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />
- Bảo hành toàn xe: 12 tháng<br />
- Bảo hành ắc quy: 12 tháng<br />
- Bảo hành động cơ: 24 tháng</p>',
'Xe điện Kazuki S5 Plus thiết kế Nhật, khung nhôm cao cấp, tốc độ 45 km/h.',
'9500000', '10500000', 'vi', 26),

(27, 'Bình ắc quy 48V 12Ah cho xe điện',
'<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />
- Điện áp: 48V (4 bình 12V ghép nối tiếp)<br />
- Dung lượng: 12Ah<br />
- Loại: GEL (không tràn acid, không cần bảo dưỡng)<br />
- Kích thước mỗi bình: 15 x 6,5 x 10 cm<br />
- Trọng lượng bộ 4 bình: 16 kg<br />
- Nhiệt độ hoạt động: -15°C đến 50°C</p>
<p><strong>ĐẶC ĐIỂM:</strong><br />
- Công nghệ GEL, không tràn acid ngay cả khi nghiêng hay lật<br />
- Chịu phóng điện sâu tốt hơn ắc quy thường<br />
- Tự xả thấp, bảo quản được lâu<br />
- Phù hợp thay thế cho hầu hết xe đạp điện, xe máy điện 48V phổ biến</p>
<p><strong>TƯƠNG THÍCH:</strong><br />
- Vnbike, Smart, Kazuki, Yadea, Pega và hầu hết xe điện 48V<br />
- Có thể dùng cho xe điện, đèn năng lượng mặt trời, UPS</p>
<p><strong>BẢO HÀNH:</strong><br />
- Bảo hành: 6 tháng<br />
- Hỗ trợ lắp đặt tại cửa hàng</p>',
'Bình ắc quy GEL 48V 12Ah thay thế cho xe đạp điện, xe máy điện. Bảo hành 6 tháng.',
'1200000', '1500000', 'vi', 27),

(28, 'Xe máy điện Giant HP3 2024',
'<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />
- Tốc độ tối đa: 60 km/h<br />
- Quãng đường đi được: 90 km/lần sạc<br />
- Công suất động cơ: 800 W BLDC<br />
- Điện áp ắc quy: 60V<br />
- Dung lượng ắc quy: 20Ah<br />
- Thời gian sạc đầy: 6 - 8 giờ<br />
- Trọng lượng xe: 68 kg</p>
<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />
- Phiên bản 2024 nâng cấp toàn diện từ HP2<br />
- Động cơ BLDC thế hệ mới hiệu suất cao hơn 15%<br />
- Phanh đĩa thủy lực cả 2 bánh, hành trình phanh ngắn<br />
- Giảm xóc thủy lực trước sau<br />
- Đồng hồ kỹ thuật số toàn bộ<br />
- Cổng sạc USB trên xe</p>
<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />
- Bảo hành toàn xe: 12 tháng<br />
- Bảo hành ắc quy: 12 tháng<br />
- Bảo hành động cơ: 24 tháng</p>',
'Xe máy điện Giant HP3 phiên bản 2024, động cơ BLDC 800W, phanh đĩa, tốc độ 60 km/h.',
'14500000', '15500000', 'vi', 28),

(29, 'Đèn pha LED xe điện siêu sáng 15W',
'<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />
- Điện áp: 48V - 72V DC (phổ rộng)<br />
- Công suất: 15 W<br />
- Độ sáng: 1.500 Lumen<br />
- Nhiệt độ màu: 6.000K (ánh sáng trắng ban ngày)<br />
- Chuẩn chống nước: IP67 (nhúng nước 30 phút)<br />
- Tuổi thọ: 30.000 giờ<br />
- Góc chiếu: 60°<br />
- Kích thước: 12 x 8 cm<br />
- Trọng lượng: 180 g</p>
<p><strong>ĐẶC ĐIỂM:</strong><br />
- Chip LED Cree nhập khẩu, độ sáng ổn định suốt tuổi thọ<br />
- Vỏ hợp kim nhôm tản nhiệt tốt<br />
- Chống nước IP67, phù hợp đi mưa<br />
- Tương thích điện áp rộng 48V - 72V, không cần chỉnh áp<br />
- Lắp đặt chuẩn, thay thế trực tiếp đèn nguyên bản</p>
<p><strong>TƯƠNG THÍCH:</strong><br />
- Phù hợp hầu hết xe đạp điện, xe máy điện 48V - 72V</p>
<p><strong>BẢO HÀNH:</strong><br />
- Bảo hành: 6 tháng<br />
- Đổi sản phẩm mới nếu lỗi trong vòng 30 ngày</p>',
'Đèn pha LED xe điện 48V-72V, siêu sáng 1500Lm, tuổi thọ 30.000 giờ, chống nước IP67.',
'350000', '450000', 'vi', 29),

(30, 'Xe điện 3 bánh chở khách EV-K300',
'<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />
- Số chỗ ngồi: 4 người (1 lái + 3 khách)<br />
- Tốc độ tối đa: 40 km/h<br />
- Công suất động cơ: 3.000 W<br />
- Điện áp ắc quy: 72V<br />
- Dung lượng ắc quy: 80Ah<br />
- Quãng đường: 80 km/lần sạc<br />
- Thời gian sạc: 8 giờ<br />
- Khả năng leo dốc: 25°<br />
- Tải trọng tối đa: 400 kg (bao gồm lái xe)</p>
<p><strong>ĐẶC ĐIỂM:</strong><br />
- Mái che mưa nắng, khung nhôm nhẹ<br />
- Ghế ngồi đệm bọc simili êm ái<br />
- Hệ thống đèn chiếu sáng đầy đủ trước sau<br />
- Đồng hồ hiển thị tốc độ và mức pin<br />
- Cửa lên xuống mở rộng, tiện lợi cho người cao tuổi</p>
<p><strong>ỨNG DỤNG:</strong><br />
- Resort, khu du lịch, khu nghỉ dưỡng<br />
- Sân golf, công viên, khu đô thị<br />
- Bệnh viện, trường học, khu công nghiệp</p>
<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />
- Bảo hành khung xe: 24 tháng<br />
- Bảo hành động cơ: 12 tháng<br />
- Bảo hành ắc quy: 12 tháng<br />
- Hỗ trợ kỹ thuật lắp đặt tại chỗ</p>',
'Xe điện 3 bánh chở khách EV-K300, chở được 4 người, tốc độ 40 km/h, thích hợp resort, khu nghỉ dưỡng.',
'35000000', '38000000', 'vi', 30);

SET FOREIGN_KEY_CHECKS = 1;
