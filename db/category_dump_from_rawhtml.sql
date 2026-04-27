-- 3-Level Category Structure — Xe Chạy Điện Shop
-- Level 1: 6 main categories
-- Level 2: 2 sub-categories per main  (12 total)
-- Level 3: 10 leaf categories per L2  (120 total)
-- Grand total: 138 categories
-- abbr='vi' | Generated: April 2026

SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE shop_categories_translations;
TRUNCATE TABLE shop_categories;

-- ============================================================
-- LEVEL 1 — 6 main categories
-- ============================================================
INSERT INTO `shop_categories` (`id`, `sub_for`, `position`, `icon`) VALUES
(1, 0, 1, 'fa fa-bicycle'),
(2, 0, 2, 'fa fa-motorcycle'),
(3, 0, 3, 'fa fa-car'),
(4, 0, 4, 'fa fa-truck'),
(5, 0, 5, 'fa fa-wrench'),
(6, 0, 6, 'fa fa-battery-full');

-- ============================================================
-- LEVEL 2 — 12 sub-categories (2 per main)
-- ============================================================
INSERT INTO `shop_categories` (`id`, `sub_for`, `position`, `icon`) VALUES
(7,  1, 1, 'fa fa-bicycle'),
(8,  1, 2, 'fa fa-child'),
(9,  2, 1, 'fa fa-motorcycle'),
(10, 2, 2, 'fa fa-star'),
(11, 3, 1, 'fa fa-car'),
(12, 3, 2, 'fa fa-car'),
(13, 4, 1, 'fa fa-truck'),
(14, 4, 2, 'fa fa-bus'),
(15, 5, 1, 'fa fa-cog'),
(16, 5, 2, 'fa fa-gear'),
(17, 6, 1, 'fa fa-plug'),
(18, 6, 2, 'fa fa-battery-half');

-- ============================================================
-- LEVEL 3 — 120 leaf categories (10 per L2)
-- ============================================================
INSERT INTO `shop_categories` (`id`, `sub_for`, `position`, `icon`) VALUES
-- Children of 7 (Xe Đạp Điện Người Lớn)
(19, 7, 1, NULL),(20, 7, 2, NULL),(21, 7, 3, NULL),(22, 7, 4, NULL),(23, 7, 5, NULL),
(24, 7, 6, NULL),(25, 7, 7, NULL),(26, 7, 8, NULL),(27, 7, 9, NULL),(28, 7, 10, NULL),
-- Children of 8 (Xe Đạp Điện Trẻ Em)
(29, 8, 1, NULL),(30, 8, 2, NULL),(31, 8, 3, NULL),(32, 8, 4, NULL),(33, 8, 5, NULL),
(34, 8, 6, NULL),(35, 8, 7, NULL),(36, 8, 8, NULL),(37, 8, 9, NULL),(38, 8, 10, NULL),
-- Children of 9 (Xe Máy Điện Phổ Thông)
(39, 9, 1, NULL),(40, 9, 2, NULL),(41, 9, 3, NULL),(42, 9, 4, NULL),(43, 9, 5, NULL),
(44, 9, 6, NULL),(45, 9, 7, NULL),(46, 9, 8, NULL),(47, 9, 9, NULL),(48, 9, 10, NULL),
-- Children of 10 (Xe Máy Điện Cao Cấp)
(49, 10, 1, NULL),(50, 10, 2, NULL),(51, 10, 3, NULL),(52, 10, 4, NULL),(53, 10, 5, NULL),
(54, 10, 6, NULL),(55, 10, 7, NULL),(56, 10, 8, NULL),(57, 10, 9, NULL),(58, 10, 10, NULL),
-- Children of 11 (Ô Tô Điện Mini)
(59, 11, 1, NULL),(60, 11, 2, NULL),(61, 11, 3, NULL),(62, 11, 4, NULL),(63, 11, 5, NULL),
(64, 11, 6, NULL),(65, 11, 7, NULL),(66, 11, 8, NULL),(67, 11, 9, NULL),(68, 11, 10, NULL),
-- Children of 12 (Ô Tô Điện SUV)
(69, 12, 1, NULL),(70, 12, 2, NULL),(71, 12, 3, NULL),(72, 12, 4, NULL),(73, 12, 5, NULL),
(74, 12, 6, NULL),(75, 12, 7, NULL),(76, 12, 8, NULL),(77, 12, 9, NULL),(78, 12, 10, NULL),
-- Children of 13 (Xe 3 Bánh Chở Hàng)
(79, 13, 1, NULL),(80, 13, 2, NULL),(81, 13, 3, NULL),(82, 13, 4, NULL),(83, 13, 5, NULL),
(84, 13, 6, NULL),(85, 13, 7, NULL),(86, 13, 8, NULL),(87, 13, 9, NULL),(88, 13, 10, NULL),
-- Children of 14 (Xe 3 Bánh Chở Khách)
(89, 14, 1, NULL),(90, 14, 2, NULL),(91, 14, 3, NULL),(92, 14, 4, NULL),(93, 14, 5, NULL),
(94, 14, 6, NULL),(95, 14, 7, NULL),(96, 14, 8, NULL),(97, 14, 9, NULL),(98, 14, 10, NULL),
-- Children of 15 (Phụ Kiện Xe Đạp Điện)
(99, 15, 1, NULL),(100, 15, 2, NULL),(101, 15, 3, NULL),(102, 15, 4, NULL),(103, 15, 5, NULL),
(104, 15, 6, NULL),(105, 15, 7, NULL),(106, 15, 8, NULL),(107, 15, 9, NULL),(108, 15, 10, NULL),
-- Children of 16 (Phụ Kiện Xe Máy Điện)
(109, 16, 1, NULL),(110, 16, 2, NULL),(111, 16, 3, NULL),(112, 16, 4, NULL),(113, 16, 5, NULL),
(114, 16, 6, NULL),(115, 16, 7, NULL),(116, 16, 8, NULL),(117, 16, 9, NULL),(118, 16, 10, NULL),
-- Children of 17 (Bộ Sạc & Trạm Sạc)
(119, 17, 1, NULL),(120, 17, 2, NULL),(121, 17, 3, NULL),(122, 17, 4, NULL),(123, 17, 5, NULL),
(124, 17, 6, NULL),(125, 17, 7, NULL),(126, 17, 8, NULL),(127, 17, 9, NULL),(128, 17, 10, NULL),
-- Children of 18 (Ắc Quy & Pin Lithium)
(129, 18, 1, NULL),(130, 18, 2, NULL),(131, 18, 3, NULL),(132, 18, 4, NULL),(133, 18, 5, NULL),
(134, 18, 6, NULL),(135, 18, 7, NULL),(136, 18, 8, NULL),(137, 18, 9, NULL),(138, 18, 10, NULL);

-- ============================================================
-- TRANSLATIONS (138 rows, abbr='vi')
-- ============================================================
INSERT INTO `shop_categories_translations` (`id`, `name`, `abbr`, `for_id`) VALUES
-- Level 1
(1,  'Xe Đạp Điện',           'vi', 1),
(2,  'Xe Máy Điện',           'vi', 2),
(3,  'Ô Tô Điện',             'vi', 3),
(4,  'Xe 3 Bánh Điện',        'vi', 4),
(5,  'Phụ Kiện & Linh Kiện',  'vi', 5),
(6,  'Trạm Sạc & Ắc Quy',    'vi', 6),
-- Level 2
(7,  'Xe Đạp Điện Người Lớn', 'vi', 7),
(8,  'Xe Đạp Điện Trẻ Em',   'vi', 8),
(9,  'Xe Máy Điện Phổ Thông', 'vi', 9),
(10, 'Xe Máy Điện Cao Cấp',   'vi', 10),
(11, 'Ô Tô Điện Mini',        'vi', 11),
(12, 'Ô Tô Điện SUV',         'vi', 12),
(13, 'Xe 3 Bánh Chở Hàng',   'vi', 13),
(14, 'Xe 3 Bánh Chở Khách',  'vi', 14),
(15, 'Phụ Kiện Xe Đạp Điện', 'vi', 15),
(16, 'Phụ Kiện Xe Máy Điện', 'vi', 16),
(17, 'Bộ Sạc & Trạm Sạc',    'vi', 17),
(18, 'Ắc Quy & Pin Lithium',  'vi', 18),
-- Level 3 — children of 7 (Xe Đạp Điện Người Lớn)
(19, 'Xe Đạp Điện Nữ',        'vi', 19),
(20, 'Xe Đạp Điện Nam',       'vi', 20),
(21, 'Xe Đạp Điện Thể Thao',  'vi', 21),
(22, 'Xe Đạp Điện Gấp',       'vi', 22),
(23, 'Xe Đạp Điện Giant',     'vi', 23),
(24, 'Xe Đạp Điện Yadea',     'vi', 24),
(25, 'Xe Đạp Điện Vnbike',    'vi', 25),
(26, 'Xe Đạp Điện Kazuki',    'vi', 26),
(27, 'Xe Đạp Điện Smart',     'vi', 27),
(28, 'Xe Đạp Điện Pega',      'vi', 28),
-- Level 3 — children of 8 (Xe Đạp Điện Trẻ Em)
(29, 'Xe Điện Trẻ Em 3-5 Tuổi',     'vi', 29),
(30, 'Xe Điện Trẻ Em 5-8 Tuổi',     'vi', 30),
(31, 'Xe Điện Trẻ Em 8-12 Tuổi',    'vi', 31),
(32, 'Xe Điện Mini 3 Bánh',          'vi', 32),
(33, 'Xe Điện Mini 4 Bánh',          'vi', 33),
(34, 'Xe Đạp Điện Trẻ Em Nữ',       'vi', 34),
(35, 'Xe Đạp Điện Trẻ Em Nam',      'vi', 35),
(36, 'Xe Điện Địa Hình Trẻ Em',     'vi', 36),
(37, 'Xe Cân Bằng Điện Trẻ Em',     'vi', 37),
(38, 'Xe Scooter Trẻ Em Điện',      'vi', 38),
-- Level 3 — children of 9 (Xe Máy Điện Phổ Thông)
(39, 'Xe Máy Điện Dưới 10 Triệu',   'vi', 39),
(40, 'Xe Máy Điện 10-15 Triệu',     'vi', 40),
(41, 'Xe Máy Điện Vnbike',           'vi', 41),
(42, 'Xe Máy Điện Smart',            'vi', 42),
(43, 'Xe Máy Điện Pega',             'vi', 43),
(44, 'Xe Máy Điện Yadea',            'vi', 44),
(45, 'Xe Máy Điện Dành Cho Nữ',     'vi', 45),
(46, 'Xe Máy Điện Dành Cho Nam',    'vi', 46),
(47, 'Xe Máy Điện Học Sinh',         'vi', 47),
(48, 'Xe Máy Điện Đi Làm',          'vi', 48),
-- Level 3 — children of 10 (Xe Máy Điện Cao Cấp)
(49, 'Xe Máy Điện TAILG',            'vi', 49),
(50, 'Xe Máy Điện Giant',            'vi', 50),
(51, 'Xe Máy Điện Vinfast',          'vi', 51),
(52, 'Xe Máy Điện Trên 15 Triệu',   'vi', 52),
(53, 'Xe Máy Điện Nhập Khẩu',       'vi', 53),
(54, 'Xe Máy Điện Thể Thao',         'vi', 54),
(55, 'Xe Máy Điện YAKA',             'vi', 55),
(56, 'Xe Máy Điện DYLEXE',           'vi', 56),
(57, 'Xe Máy Điện Pinky',            'vi', 57),
(58, 'Xe Máy Điện Dior',             'vi', 58),
-- Level 3 — children of 11 (Ô Tô Điện Mini)
(59, 'Ô Tô Điện 2 Chỗ',             'vi', 59),
(60, 'Ô Tô Điện 4 Chỗ Mini',        'vi', 60),
(61, 'Ô Tô Điện VinFast',            'vi', 61),
(62, 'Ô Tô Điện Wuling',             'vi', 62),
(63, 'Ô Tô Điện Bestune',            'vi', 63),
(64, 'Ô Tô Điện BYD Mini',           'vi', 64),
(65, 'Ô Tô Điện Dưới 300 Triệu',    'vi', 65),
(66, 'Ô Tô Điện 300-500 Triệu',     'vi', 66),
(67, 'Ô Tô Điện Thuê Pin',           'vi', 67),
(68, 'Ô Tô Điện Tự Lái',            'vi', 68),
-- Level 3 — children of 12 (Ô Tô Điện SUV)
(69, 'SUV Điện Trên 500 Triệu',     'vi', 69),
(70, 'SUV Điện 5 Chỗ',              'vi', 70),
(71, 'SUV Điện 7 Chỗ',              'vi', 71),
(72, 'Ô Tô Điện Tesla',              'vi', 72),
(73, 'Ô Tô Điện BYD',               'vi', 73),
(74, 'Ô Tô Điện Mercedes EQ',       'vi', 74),
(75, 'Ô Tô Điện BMW i',              'vi', 75),
(76, 'Ô Tô Điện Hyundai IONIQ',     'vi', 76),
(77, 'Ô Tô Điện Kia EV',            'vi', 77),
(78, 'Ô Tô Điện Audi e-tron',       'vi', 78),
-- Level 3 — children of 13 (Xe 3 Bánh Chở Hàng)
(79, 'Xe 3 Bánh Tải 200kg',         'vi', 79),
(80, 'Xe 3 Bánh Tải 500kg',         'vi', 80),
(81, 'Xe 3 Bánh Tải 1 Tấn',         'vi', 81),
(82, 'Xe 3 Bánh Có Mái Che',        'vi', 82),
(83, 'Xe 3 Bánh Thùng Đông Lạnh',  'vi', 83),
(84, 'Xe 3 Bánh Bán Hàng Rong',    'vi', 84),
(85, 'Xe 3 Bánh Giao Hàng',         'vi', 85),
(86, 'Xe 3 Bánh Vận Chuyển Kho',   'vi', 86),
(87, 'Xe 3 Bánh Nông Nghiệp',       'vi', 87),
(88, 'Xe 3 Bánh Smart M700',         'vi', 88),
-- Level 3 — children of 14 (Xe 3 Bánh Chở Khách)
(89, 'Xe 3 Bánh Du Lịch',           'vi', 89),
(90, 'Xe 3 Bánh Resort',             'vi', 90),
(91, 'Xe 3 Bánh Sân Golf',          'vi', 91),
(92, 'Xe 3 Bánh Bệnh Viện',         'vi', 92),
(93, 'Xe 3 Bánh Khu Đô Thị',       'vi', 93),
(94, 'Xe 3 Bánh 4 Chỗ Ngồi',       'vi', 94),
(95, 'Xe 3 Bánh 6 Chỗ Ngồi',       'vi', 95),
(96, 'Xe 3 Bánh Có Điều Hòa',      'vi', 96),
(97, 'Xe 3 Bánh Mini Bus',           'vi', 97),
(98, 'Xe Điện Chở Học Sinh',        'vi', 98),
-- Level 3 — children of 15 (Phụ Kiện Xe Đạp Điện)
(99,  'Ắc Quy Xe Đạp Điện 48V',    'vi', 99),
(100, 'Đèn Pha Xe Đạp Điện',        'vi', 100),
(101, 'Lốp Xe Đạp Điện',            'vi', 101),
(102, 'Phanh Xe Đạp Điện',          'vi', 102),
(103, 'Đồng Hồ Xe Đạp Điện',       'vi', 103),
(104, 'Khóa Xe Đạp Điện',           'vi', 104),
(105, 'Yên Xe Đạp Điện',            'vi', 105),
(106, 'Giỏ Xe Đạp Điện',            'vi', 106),
(107, 'Gương Xe Đạp Điện',          'vi', 107),
(108, 'Chân Chống Xe Đạp Điện',    'vi', 108),
-- Level 3 — children of 16 (Phụ Kiện Xe Máy Điện)
(109, 'Ắc Quy Xe Máy Điện 60V',    'vi', 109),
(110, 'Ắc Quy Xe Máy Điện 72V',    'vi', 110),
(111, 'Đèn Pha LED Xe Máy Điện',   'vi', 111),
(112, 'Lốp Xe Máy Điện',            'vi', 112),
(113, 'Phanh Đĩa Xe Máy Điện',     'vi', 113),
(114, 'Đồng Hồ Kỹ Thuật Số',       'vi', 114),
(115, 'Phụ Tùng Thân Xe',           'vi', 115),
(116, 'Bộ Điều Khiển Xe Điện',     'vi', 116),
(117, 'Motor Xe Máy Điện',           'vi', 117),
(118, 'Bộ Cáp Điện Xe',             'vi', 118),
-- Level 3 — children of 17 (Bộ Sạc & Trạm Sạc)
(119, 'Bộ Sạc 48V',                 'vi', 119),
(120, 'Bộ Sạc 60V',                 'vi', 120),
(121, 'Bộ Sạc 72V',                 'vi', 121),
(122, 'Trạm Sạc AC Gia Đình',       'vi', 122),
(123, 'Trạm Sạc DC Nhanh',          'vi', 123),
(124, 'Trạm Sạc Công Cộng',         'vi', 124),
(125, 'Sạc Không Dây',              'vi', 125),
(126, 'Bộ Chuyển Đổi Sạc',         'vi', 126),
(127, 'Phần Mềm Quản Lý Sạc',      'vi', 127),
(128, 'Trụ Sạc Di Động',            'vi', 128),
-- Level 3 — children of 18 (Ắc Quy & Pin Lithium)
(129, 'Ắc Quy GEL 48V',             'vi', 129),
(130, 'Ắc Quy GEL 60V',             'vi', 130),
(131, 'Ắc Quy GEL 72V',             'vi', 131),
(132, 'Pin Lithium 48V',             'vi', 132),
(133, 'Pin Lithium 60V',             'vi', 133),
(134, 'Pin Lithium 72V',             'vi', 134),
(135, 'BMS Bảo Vệ Pin',             'vi', 135),
(136, 'Hộp Pin Tích Hợp',           'vi', 136),
(137, 'Pin Năng Lượng Mặt Trời',    'vi', 137),
(138, 'Bộ Lưu Điện Dự Phòng',      'vi', 138);

SET FOREIGN_KEY_CHECKS = 1;
