-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2026 at 06:17 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `usfetyhp_wovegreendb`
--

-- --------------------------------------------------------

--
-- Table structure for table `active_pages`
--

CREATE TABLE `active_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `enabled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `active_pages`
--

INSERT INTO `active_pages` (`id`, `name`, `enabled`) VALUES
(1, 'blog', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `iban` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `bic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `name`, `iban`, `bank`, `bic`) VALUES
(1, 'wovegreen', 'aaa', 'aaaxzxz', 'aa');

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `time` int(10) UNSIGNED NOT NULL,
  `blog_type` tinyint(1) NOT NULL DEFAULT 4
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `image`, `url`, `time`, `blog_type`) VALUES
(1, 'tgxcd-dong-hanh-cung-tphcm-khoi-cong-cau-di-bo-sai-gon908.jpg', 'tgxcd-dong-hanh-cung-tphcm-khoi-cong-cau-di-bo-sai-gon', 1777297554, 4),
(2, 'hop-tac-kinh-doanh-cung-the-gioi-xe-chay-dien285.jpg', 'hop-tac-kinh-doanh-cung-the-gioi-xe-chay-dien', 1777297554, 4),
(3, 'chay-thu-xe-dap-dien-xe-may-dien-mien-phi-tai-nha282.jpg', 'chay-thu-xe-dap-dien-xe-may-dien-mien-phi-tai-nha', 1777297554, 4),
(4, 'xe-dap-dien-xe-may-dien-tot-nhat-hien-nay552.jpg', 'xe-dap-dien-xe-may-dien-tot-nhat-hien-nay', 1777297554, 4),
(5, 'bao-ve-vang-xe-dap-dien-xe-may-dien580.jpg', 'bao-ve-vang-xe-dap-dien-xe-may-dien', 1777297554, 4),
(6, 'san-xuat-xe-3-banh-tu-che-cho-hang-theo-yeu-cau246.jpg', 'san-xuat-xe-3-banh-tu-che-cho-hang-theo-yeu-cau', 1777297554, 4),
(7, 'xe-ban-hang-luu-dong-chay-dien-trao-luu-duoc-ua-chuong-nhat-hien-nay785.jpg', 'xe-ban-hang-luu-dong-chay-dien-trao-luu-duoc-ua-chuong-nhat-hien-nay', 1777297554, 4),
(8, '1777523592_31214f90dabe1faf8dbf.png', 'mua-xe-may-đien-xe-đap-đien-tra-gop', 1777523592, 4);

-- --------------------------------------------------------

--
-- Table structure for table `blog_translations`
--

CREATE TABLE `blog_translations` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `for_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `blog_translations`
--

INSERT INTO `blog_translations` (`id`, `title`, `description`, `abbr`, `for_id`) VALUES
(1, 'TGXCD dong hanh cung TpHCM khoi cong cau di bo Sai Gon', '<p>TGXCD dong hanh cung TpHCM khoi cong cau di bo Sai Gon.</p>', 'vi', 1),
(2, 'Hop tac kinh doanh cung The Gioi Xe Chay Dien', '<p>Hop tac kinh doanh cung The Gioi Xe Chay Dien.</p>', 'vi', 2),
(3, 'Chay thu xe dap dien, xe may dien mien phi tai nha', '<p>Chay thu xe dap dien, xe may dien mien phi tai nha.</p>', 'vi', 3),
(4, 'Xe dap dien, xe may dien tot nhat hien nay', '<p>Xe dap dien, xe may dien tot nhat hien nay.</p>', 'vi', 4),
(5, 'Bao ve vang xe dap dien, xe may dien', '<p>Bao ve vang xe dap dien, xe may dien.</p>', 'vi', 5),
(6, 'San xuat xe 3 banh tu che cho hang theo yeu cau', '<p>San xuat xe 3 banh tu che cho hang theo yeu cau.</p>', 'vi', 6),
(7, 'Xe ban hang luu dong chay dien: trao luu duoc ua chuong nhat hien nay', '<p>Xe ban hang luu dong chay dien: trao luu duoc ua chuong nhat hien nay.</p>', 'vi', 7),
(8, 'Mua xe máy điện, xe đạp điện trả góp', '<p>Hiện nay&nbsp;<strong><a href=\"https://thegioixechaydien.com.vn/xe-dap-dien/\">xe đạp điện</a>&nbsp;</strong>và<strong>&nbsp;<a href=\"https://thegioixechaydien.com.vn/xe-may-dien/\">xe máy điện</a></strong>&nbsp;đang trở thành phương tiện di chuyển cho rất nhiều người. Theo đó thì rất nhiều tiệm bán xe đạp điện, xe máy điện ra đời nhưng trong số đó có rất ít cửa hàng có thể đáp ứng và mang đến khách hàng những dich vụ tốt nhất. Vì lý do đó Thế giới xe chạy điện chúng tôi quyết tâm là đơn vị tiên phong về dịch vụ trong lĩnh vực&nbsp;mua bán, sửa chữa xe đạp điện&nbsp;và&nbsp;xe máy điện trên&nbsp;khắp cả nước. Và dưới đây là một trong những dịch vụ hàng đầu của chúng tôi hiện nay dịch vụ&nbsp;mua xe máy điện,<strong>&nbsp;<a href=\"https://thegioixechaydien.com.vn/dich-vu-mua-xe-dap-dien-tra-gop.html\">xe đạp điện trả góp</a></strong>.</p>\r\n\r\n<p><strong>CÁC NỘI DUNG KHI MUA XE MÁY ĐIỆN, XE ĐẠP ĐIỆN TRẢ GÓP:</strong></p>\r\n\r\n<p><strong><img alt=\"\" src=\"https://thegioixechaydien.com.vn/uploads/file/mua%20xe%20dap%20dien%20tra%20gop.png\" /></strong></p>\r\n\r\n<p><em>mua xe máy điện, xe đạp điện trả góp</em></p>\r\n\r\n<p><strong>Hồ sơ xét duyệt:</strong></p>\r\n\r\n<p>- Chứng minh nhân dân và bằng lái xe (photo không cần sao y) kèm theo bản chính để đối chiếu.</p>\r\n\r\n<p>- Chứng minh nhân dân sổ hộ khẩu (photo không cần sao y)&nbsp;kèm theo bán chính để đối chiếu.</p>\r\n\r\n<p>- 01 số điện thoại cố định hoặc 2 số điện thoại di động của người thân.</p>\r\n\r\n<p><strong>Thủ tục và các quy định:</strong></p>\r\n\r\n<p>- Xét duyệt nhanh, Thủ tục đơn giản hoàn thành trong vòng 30 phút tính từ thời điểm nhận hồ sơ.</p>\r\n\r\n<p>- Không cần thế chấp bất kỳ tài sản hay giấy tờ gì.</p>\r\n\r\n<p>- Kỳ hạn thanh toán tối thiểu từ 6 tháng tối đa đến 24 tháng.</p>\r\n\r\n<p>- Được áp dụng cho toàn bộ sản phẩm của thế giới xe chạy điện.</p>\r\n\r\n<p><strong>Phương thanh toán:</strong></p>\r\n\r\n<p>- Thanh toán qua các hệ thống ngân hàng: HDBank, Agribank, SeABank, Thế Giới Xe Chạy Điện và Bưu điện...</p>\r\n\r\n<p><strong>Quyền lợi của khách hàng:</strong></p>\r\n\r\n<p>- Khách hàng sẽ &nbsp;được bảo hiểm khoản vay MIỄN PHÍ trong suốt thời gian vay.</p>\r\n\r\n<p>- Với bảo hiểm khoản vay, khách hàng sẽ không phải trả số tiền vay (bao gồm tiền lãi) trong trường hợp rủi ro xẩy ra.</p>\r\n\r\n<p>- Bảo hiểm cho các khoản vay tiêu dùng lên đến 300 triệu đồng.</p>\r\n\r\n<p><strong>Lãi suất và số tiền phải trả ban đầu:</strong></p>\r\n\r\n<p>- Số tiền khách hàng phải thanh toán khi mua hàng tối thiểu là 10% - 20% giá trị đơn hàng.</p>\r\n\r\n<p>- Số lãi khách hàng phải thanh toán cho khoản vay là 1,4% - 2,94% trên 1 tháng.</p>\r\n\r\n<p><strong>Đơn vị hợp tác với thế giới xe chạy điện là:</strong></p>\r\n\r\n<p>- HD SAISON thuộc cổ phần của ngân hàng HDBank một trong những công ty tài chính hàng đầu Việt Nam hiện nay.Với bề dày kinh nghiệm trong lĩnh vực cho vay tiêu dùng từ nhưng năm 2007 đến nay.Tính đến năm 2014 HD SON đã có mặt trên khắp 64 tỉnh thành và phục vụ trên 700.000 lượt khách hàng.</p>\r\n\r\n<p>- ACS&nbsp;Công ty TNHH TM ACS Việt Nam là Công ty có 100% vốn đầu tư từ Nhật Bản thuộc tập đoàn AEON. AEON Group hiện là một trong những tập đoàn thương mại bán lẻ lớn nhất trên thế giới với 179 liên doanh trong và ngoài nước Nhật.</p>\r\n\r\n<p>- Vp Bank phát triển từ Khối Tín Dụng Tiêu Dùng trực thuộc Ngân hàng TMCP Việt Nam Thịnh Vượng (VPBank), sau gần 5 năm hoạt động, FE Credit đã hoàn tất việc chuyển đổi hoạt động Tín dụng Tiêu dùng sang một pháp nhân độc lập mới – Công ty Tài Chính TNHH MTV Ngân Hàng Việt Nam Thịnh Vượng, viết tắt là VPB FC (Thương hiệu FE Credit) vào tháng 02/2015.&nbsp;<br />\r\n&nbsp;</p>\r\n\r\n<table border=\"0\">\r\n	<tbody>\r\n		<tr>\r\n			<td><img alt=\"bán trả góp hdsaison\" src=\"https://thegioixechaydien.com.vn/uploads/files/bai%20viet%20huong%20nguoi%20dung/ban-tra-gop/tr-gop-hdsaison.jpg\" title=\"bán trả góp hdsaison\" /></td>\r\n			<td><img alt=\"bán trả góp acs\" src=\"https://thegioixechaydien.com.vn/uploads/files/bai%20viet%20huong%20nguoi%20dung/ban-tra-gop/tra-gop-acs.jpg\" title=\"bán trả góp acs\" /></td>\r\n			<td><img alt=\"bán trả góp vpbank\" src=\"https://thegioixechaydien.com.vn/uploads/files/bai%20viet%20huong%20nguoi%20dung/ban-tra-gop/tra-gop-fecredit.jpg\" title=\"bán trả góp vpbank\" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Làm thủ tục qua điện thoại:&nbsp;<strong><a href=\"tel:0938906886\">1800 6726</a></strong>&nbsp;-&nbsp;<strong><a href=\"tel:0938906886\">093 890 6886</a></strong></p>\r\n\r\n<p>Email:&nbsp;thegioixechaydien@gmail.com<br />\r\nwebsite:&nbsp;<a href=\"https://thegioixechaydien.com.vn/\">www.thegioixechaydien.com.vn</a></p>\r\n\r\n<p>- Thế giới xe chạy điện đã có mặt khắp 64 tình thành trong cả nước và áp dụng chương trình mua xe mấy điện trả góp, xe đạp điện trả góp trên tất cả các chi nhánh tại các tỉnh và thành phố sau: tphcm, sài gòn, cần thơ, cà mau, bình dương, long an, vĩnh long, sóc trăng, biên hòa, đông nai, ...</p>\r\n\r\n<p><strong>Xem các bài liên quan:</strong></p>\r\n\r\n<p><strong>-&nbsp;</strong><strong>Bán&nbsp;</strong><strong><a href=\"https://thegioixechaydien.com.vn/xe-dap-dien-giant/\">xe đạp điện Giant</a>&nbsp;trả góp</strong></p>\r\n\r\n<p><strong>- Bán&nbsp;<a href=\"https://thegioixechaydien.com.vn/xe-dap-dien-hkbike/\">Xe đạp điện Hkbike</a>&nbsp;</strong><strong>trả góp</strong></p>\r\n\r\n<p><strong>- Bán&nbsp;<a href=\"https://thegioixechaydien.com.vn/xe-dap-dien-honda/\">xe đạp điện Honda</a>&nbsp;trả góp</strong></p>\r\n', 'vi', 8),
(9, 'Mua xe máy điện, xe đạp điện trả góp', '<p>Hiện nay&nbsp;<strong><a href=\"https://thegioixechaydien.com.vn/xe-dap-dien/\">xe đạp điện</a>&nbsp;</strong>và<strong>&nbsp;<a href=\"https://thegioixechaydien.com.vn/xe-may-dien/\">xe máy điện</a></strong>&nbsp;đang trở thành phương tiện di chuyển cho rất nhiều người. Theo đó thì rất nhiều tiệm bán xe đạp điện, xe máy điện ra đời nhưng trong số đó có rất ít cửa hàng có thể đáp ứng và mang đến khách hàng những dich vụ tốt nhất. Vì lý do đó Thế giới xe chạy điện chúng tôi quyết tâm là đơn vị tiên phong về dịch vụ trong lĩnh vực&nbsp;mua bán, sửa chữa xe đạp điện&nbsp;và&nbsp;xe máy điện trên&nbsp;khắp cả nước. Và dưới đây là một trong những dịch vụ hàng đầu của chúng tôi hiện nay dịch vụ&nbsp;mua xe máy điện,<strong>&nbsp;<a href=\"https://thegioixechaydien.com.vn/dich-vu-mua-xe-dap-dien-tra-gop.html\">xe đạp điện trả góp</a></strong>.</p>\r\n\r\n<p><strong>CÁC NỘI DUNG KHI MUA XE MÁY ĐIỆN, XE ĐẠP ĐIỆN TRẢ GÓP:</strong></p>\r\n\r\n<p><strong><img alt=\"\" src=\"https://thegioixechaydien.com.vn/uploads/file/mua%20xe%20dap%20dien%20tra%20gop.png\" /></strong></p>\r\n\r\n<p><em>mua xe máy điện, xe đạp điện trả góp</em></p>\r\n\r\n<p><strong>Hồ sơ xét duyệt:</strong></p>\r\n\r\n<p>- Chứng minh nhân dân và bằng lái xe (photo không cần sao y) kèm theo bản chính để đối chiếu.</p>\r\n\r\n<p>- Chứng minh nhân dân sổ hộ khẩu (photo không cần sao y)&nbsp;kèm theo bán chính để đối chiếu.</p>\r\n\r\n<p>- 01 số điện thoại cố định hoặc 2 số điện thoại di động của người thân.</p>\r\n\r\n<p><strong>Thủ tục và các quy định:</strong></p>\r\n\r\n<p>- Xét duyệt nhanh, Thủ tục đơn giản hoàn thành trong vòng 30 phút tính từ thời điểm nhận hồ sơ.</p>\r\n\r\n<p>- Không cần thế chấp bất kỳ tài sản hay giấy tờ gì.</p>\r\n\r\n<p>- Kỳ hạn thanh toán tối thiểu từ 6 tháng tối đa đến 24 tháng.</p>\r\n\r\n<p>- Được áp dụng cho toàn bộ sản phẩm của thế giới xe chạy điện.</p>\r\n\r\n<p><strong>Phương thanh toán:</strong></p>\r\n\r\n<p>- Thanh toán qua các hệ thống ngân hàng: HDBank, Agribank, SeABank, Thế Giới Xe Chạy Điện và Bưu điện...</p>\r\n\r\n<p><strong>Quyền lợi của khách hàng:</strong></p>\r\n\r\n<p>- Khách hàng sẽ &nbsp;được bảo hiểm khoản vay MIỄN PHÍ trong suốt thời gian vay.</p>\r\n\r\n<p>- Với bảo hiểm khoản vay, khách hàng sẽ không phải trả số tiền vay (bao gồm tiền lãi) trong trường hợp rủi ro xẩy ra.</p>\r\n\r\n<p>- Bảo hiểm cho các khoản vay tiêu dùng lên đến 300 triệu đồng.</p>\r\n\r\n<p><strong>Lãi suất và số tiền phải trả ban đầu:</strong></p>\r\n\r\n<p>- Số tiền khách hàng phải thanh toán khi mua hàng tối thiểu là 10% - 20% giá trị đơn hàng.</p>\r\n\r\n<p>- Số lãi khách hàng phải thanh toán cho khoản vay là 1,4% - 2,94% trên 1 tháng.</p>\r\n\r\n<p><strong>Đơn vị hợp tác với thế giới xe chạy điện là:</strong></p>\r\n\r\n<p>- HD SAISON thuộc cổ phần của ngân hàng HDBank một trong những công ty tài chính hàng đầu Việt Nam hiện nay.Với bề dày kinh nghiệm trong lĩnh vực cho vay tiêu dùng từ nhưng năm 2007 đến nay.Tính đến năm 2014 HD SON đã có mặt trên khắp 64 tỉnh thành và phục vụ trên 700.000 lượt khách hàng.</p>\r\n\r\n<p>- ACS&nbsp;Công ty TNHH TM ACS Việt Nam là Công ty có 100% vốn đầu tư từ Nhật Bản thuộc tập đoàn AEON. AEON Group hiện là một trong những tập đoàn thương mại bán lẻ lớn nhất trên thế giới với 179 liên doanh trong và ngoài nước Nhật.</p>\r\n\r\n<p>- Vp Bank phát triển từ Khối Tín Dụng Tiêu Dùng trực thuộc Ngân hàng TMCP Việt Nam Thịnh Vượng (VPBank), sau gần 5 năm hoạt động, FE Credit đã hoàn tất việc chuyển đổi hoạt động Tín dụng Tiêu dùng sang một pháp nhân độc lập mới – Công ty Tài Chính TNHH MTV Ngân Hàng Việt Nam Thịnh Vượng, viết tắt là VPB FC (Thương hiệu FE Credit) vào tháng 02/2015.&nbsp;<br />\r\n&nbsp;</p>\r\n\r\n<table border=\"0\">\r\n	<tbody>\r\n		<tr>\r\n			<td><img alt=\"bán trả góp hdsaison\" src=\"https://thegioixechaydien.com.vn/uploads/files/bai%20viet%20huong%20nguoi%20dung/ban-tra-gop/tr-gop-hdsaison.jpg\" title=\"bán trả góp hdsaison\" /></td>\r\n			<td><img alt=\"bán trả góp acs\" src=\"https://thegioixechaydien.com.vn/uploads/files/bai%20viet%20huong%20nguoi%20dung/ban-tra-gop/tra-gop-acs.jpg\" title=\"bán trả góp acs\" /></td>\r\n			<td><img alt=\"bán trả góp vpbank\" src=\"https://thegioixechaydien.com.vn/uploads/files/bai%20viet%20huong%20nguoi%20dung/ban-tra-gop/tra-gop-fecredit.jpg\" title=\"bán trả góp vpbank\" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Làm thủ tục qua điện thoại:&nbsp;<strong><a href=\"tel:0938906886\">1800 6726</a></strong>&nbsp;-&nbsp;<strong><a href=\"tel:0938906886\">093 890 6886</a></strong></p>\r\n\r\n<p>Email:&nbsp;thegioixechaydien@gmail.com<br />\r\nwebsite:&nbsp;<a href=\"https://thegioixechaydien.com.vn/\">www.thegioixechaydien.com.vn</a></p>\r\n\r\n<p>- Thế giới xe chạy điện đã có mặt khắp 64 tình thành trong cả nước và áp dụng chương trình mua xe mấy điện trả góp, xe đạp điện trả góp trên tất cả các chi nhánh tại các tỉnh và thành phố sau: tphcm, sài gòn, cần thơ, cà mau, bình dương, long an, vĩnh long, sóc trăng, biên hòa, đông nai, ...</p>\r\n\r\n<p><strong>Xem các bài liên quan:</strong></p>\r\n\r\n<p><strong>-&nbsp;</strong><strong>Bán&nbsp;</strong><strong><a href=\"https://thegioixechaydien.com.vn/xe-dap-dien-giant/\">xe đạp điện Giant</a>&nbsp;trả góp</strong></p>\r\n\r\n<p><strong>- Bán&nbsp;<a href=\"https://thegioixechaydien.com.vn/xe-dap-dien-hkbike/\">Xe đạp điện Hkbike</a>&nbsp;</strong><strong>trả góp</strong></p>\r\n\r\n<p><strong>- Bán&nbsp;<a href=\"https://thegioixechaydien.com.vn/xe-dap-dien-honda/\">xe đạp điện Honda</a>&nbsp;trả góp</strong></p>\r\n', 'en', 8);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `confirm_links`
--

CREATE TABLE `confirm_links` (
  `id` int(11) NOT NULL,
  `link` char(32) NOT NULL,
  `for_order` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `confirm_links`
--

INSERT INTO `confirm_links` (`id`, `link`, `for_order`) VALUES
(1, '00cf371da2808f6df74ca8bdc377aa68', 1234);

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(190) NOT NULL,
  `email` varchar(190) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `subject`, `message`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
(1, 'Nguyen Dinh', 'chinhvowili@gmail.com', 'test', 'test', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', '2026-05-01 04:10:17', '2026-05-01 04:10:17');

-- --------------------------------------------------------

--
-- Table structure for table `cookie_law`
--

CREATE TABLE `cookie_law` (
  `id` int(10) UNSIGNED NOT NULL,
  `link` varchar(255) NOT NULL,
  `theme` varchar(20) NOT NULL,
  `visibility` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cookie_law`
--

INSERT INTO `cookie_law` (`id`, `link`, `theme`, `visibility`) VALUES
(1, '', 'light-top', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cookie_law_translations`
--

CREATE TABLE `cookie_law_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `message` varchar(255) NOT NULL,
  `button_text` varchar(50) NOT NULL,
  `learn_more` varchar(50) NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `for_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cookie_law_translations`
--

INSERT INTO `cookie_law_translations` (`id`, `message`, `button_text`, `learn_more`, `abbr`, `for_id`) VALUES
(1, '', '', '', 'vi', 1),
(2, '', '', '', 'en', 1);

-- --------------------------------------------------------

--
-- Table structure for table `discount_codes`
--

CREATE TABLE `discount_codes` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(10) NOT NULL,
  `code` varchar(10) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `valid_from_date` int(10) UNSIGNED NOT NULL,
  `valid_to_date` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1-enabled, 0-disabled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `discount_codes`
--

INSERT INTO `discount_codes` (`id`, `type`, `code`, `amount`, `valid_from_date`, `valid_to_date`, `status`) VALUES
(1, 'percent', '3XJ4Z5', '1229', 1755734400, 1755648000, 0),
(2, 'percent', 'DJ9XJO', '1234', 1755648000, 1757116800, 0);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(10) UNSIGNED NOT NULL,
  `activity` varchar(255) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `time` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `activity`, `username`, `time`) VALUES
(1, 'Go to History', 'admin', 1768102794),
(2, 'Go to History', 'admin', 1768102801),
(3, 'Go to History', 'admin', 1768102804),
(4, 'Go to History', 'admin', 1768102806),
(5, 'Go to History', 'admin', 1768102809);

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `currencyKey` varchar(5) NOT NULL,
  `flag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `abbr`, `name`, `currency`, `currencyKey`, `flag`) VALUES
(1, 'vi', 'vietnamese', 'đ', 'VND', 'vi.jpg'),
(5, 'en', 'english', '€', 'EUR', 'en.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2026-04-27-000001', 'App\\Database\\Migrations\\AddIconToShopCategories', 'default', 'App', 1777263034, 1),
(2, '2026-04-27-000002', 'App\\Database\\Migrations\\AddHighlightedToProducts', 'default', 'App', 1777292896, 2),
(3, '2026-04-30-000003', 'App\\Database\\Migrations\\AddBlogTypeToBlogPosts', 'default', 'App', 1777523224, 3),
(4, '2026-04-30-000004', 'App\\Database\\Migrations\\AddUrlToShopCategoryTranslations', 'default', 'App', 1777545224, 4),
(5, '2026-05-01-000005', 'App\\Database\\Migrations\\CreateSlidersTable', 'default', 'App', 1777604088, 5),
(6, '2026-05-01-000006', 'App\\Database\\Migrations\\CreateShowroomsTable', 'default', 'App', 1777604088, 5),
(7, '2026-05-01-000007', 'App\\Database\\Migrations\\CreateContactMessagesTable', 'default', 'App', 1777608601, 6);

-- --------------------------------------------------------

--
-- Table structure for table `mytable`
--

CREATE TABLE `mytable` (
  `id` bigint(20) DEFAULT NULL,
  `name` varchar(1024) DEFAULT NULL,
  `short_name` varchar(1024) DEFAULT NULL,
  `short_name2` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mytable`
--

INSERT INTO `mytable` (`id`, `name`, `short_name`, `short_name2`) VALUES
(24701755323, '[Túi Lớn 1Kg]Hạt Giống Rau Mầm Củ Cải Đỏ Dễ Trồng, Tốt Cho Sức Khỏe nhãn Tâm Nông', '[Túi Lớn 1Kg]Hạt Giống Rau Mầm Củ Cải Đỏ Dễ Trồng, Tốt Cho Sức Khỏe nhãn', NULL),
(9100056988, '[Sỉ] Khung/Giá/Kệ Treo Ban Công Hình Chữ Nhật Sắt Bọc Nhựa Không Rỉ Kích 45-60cm Độ Bền Cao Giá Rẻ', '[Sỉ] Khung/Giá/Kệ Treo Ban Công Hình Chữ Nhật Sắt Bọc Nhựa Không Rỉ Kích 45-60cm Độ Bền Cao Giá Rẻ', NULL),
(5939095133, '[Túi Lớn 1Kg] Hạt Giống Cải Ngọt Tâm Nông Dễ Trồng, Giảm Ho, Tăng Đề Kháng, Dễ Tiêu, Ngừa Ung Thư', '[Túi Lớn 1Kg] Hạt Giống Cải Ngọt Dễ Trồng, Giảm Ho, Tăng Đề Kháng, Dễ Tiêu, Ngừa Ung Thư', NULL),
(5140050327, '[Túi Lớn 1Kg] Hạt Giống Tâm Nông - Rau Mầm Bông Cải Xanh Italia Dễ Trồng, Rau Sạch tốt cho sức khỏe', '[Túi Lớn 1Kg] Hạt Giống - Rau Mầm Bông Cải Xanh Italia Dễ Trồng, Rau Sạch tốt cho sức khỏe', NULL),
(6027653994, 'Hạt Giống Rau Mầm Bông Cải Xanh Italia nhãn Tâm Nông - Gói 20G', 'Hạt Giống Rau Mầm Bông Cải Xanh Italia nhãn - Gói 20G', NULL),
(8875324725, 'Hạt Giống Ớt Xiêm Xanh Tâm Nông - Gói 5gr, gói lớn', 'Hạt Giống Ớt Xiêm Xanh - Gói 5gr, gói lớn', NULL),
(6041177625, 'Phân Trùn Quế Hữu Cơ Hapi Green - túi 2Kg', 'Phân Trùn Quế Hữu Cơ Hapi Green - túi 2Kg', NULL),
(4646706646, 'Giá Thể Mùn Dừa Hapigreen 2Kg (Trồng Rau Mầm, Thủy Canh)', 'Giá Thể Mùn Dừa Hapigreen 2Kg (Trồng Rau Mầm, Thủy Canh)', NULL),
(6440072544, '[Túi Lớn 1Kg] Hạt Giống Rau Mầm Hướng Dương Dễ Trồng, Rau Sạch, Giàu Vitamin, Đẹp Da, Tốt Cho Tim Mạch', '[Túi Lớn 1Kg] Hạt Giống Rau Mầm Hướng Dương Dễ Trồng, Rau Sạch, Giàu Vitamin, Đẹp Da, Tốt Cho Tim Mạch', NULL),
(3921943541, 'Kéo Cắt Tỉa Cành Cầm Tay Lưỡi Cong Cán Đúc Asaki 8651 + tặng kèm dao rọc giấy mini', 'Kéo Cắt Tỉa Cành Cầm Tay Lưỡi Cong Cán Đúc Asaki 8651 + tặng kèm dao rọc giấy mini', NULL),
(4628464327, 'Hạt Giống Hoa Sao Nhái Vàng Kép Lùn  Tâm Nông - Gói 20H', 'Hạt Giống Hoa Sao Nhái Vàng Kép Lùn - Gói 20H', NULL),
(7227555459, 'Hạt Giống Ớt Xiêm Xanh Tâm Nông - Gói 200Mg', 'Hạt Giống Ớt Xiêm Xanh - Gói 200Mg', NULL),
(3946805481, 'Kéo Cắt Tỉa Cành Cầm Tay Lưỡi Thẳng Asaki 8638 + tặng kèm dao rọc giấy mini', 'Kéo Cắt Tỉa Cành Cầm Tay Lưỡi Thẳng Asaki 8638 + tặng kèm dao rọc giấy mini', NULL),
(7330154413, 'Phân Hữu Cơ Vi Sinh (Phân Đầu Trâu Hcmk7 Trichoderma) 1Kg', 'Phân Hữu Cơ Vi Sinh (Phân Đầu Trâu Hcmk7 Trichoderma) 1Kg', NULL),
(5721434017, 'Phân Hữu Cơ Tan Chậm 30 Túi Bounce Back (Phân Bón Chuyên Phong Lan) 180G', 'Phân Hữu Cơ Tan Chậm 30 Túi Bounce Back (Phân Bón Chuyên Phong Lan) 180G', NULL),
(3546803751, 'Phân Hữu Cơ Tan Chậm 15 Túi Bounce Back (Phân Bón Chuyên Phong Lan) 90G', 'Phân Hữu Cơ Tan Chậm 15 Túi Bounce Back (Phân Bón Chuyên Phong Lan) 90G', NULL),
(6721435933, 'Phân Hữu Cơ Chuyên Rau Màu (Phân Cá Fish Emulsion) 250Ml', 'Phân Hữu Cơ Chuyên Rau Màu (Phân Cá Fish Emulsion) 250Ml', NULL),
(3221583469, 'Phân Bò Đã Xử Lí, Phân Hữu Cơ Hapi Green -  Bao 10Dm3 (gói nhỏ ~1Kg)', 'Phân Bò Đã Xử Lí, Phân Hữu Cơ Hapi Green - Bao 10Dm3 (gói nhỏ ~1Kg)', NULL),
(4022074480, 'Lưới Giàn Dây Leo Rosa 2X3M', 'Lưới Giàn Dây Leo Rosa 2X3M', NULL),
(5022074197, 'Lưới Che Nắng Mimosa Thái Lan 2X5M', 'Lưới Che Nắng Mimosa Thái Lan 2X5M', NULL),
(7722056067, 'Khay Nhựa Trồng Rau Chữ Nhật TM-65, Chậu Trồng Cây Thông Minh', 'Khay Nhựa Trồng Rau Chữ Nhật TM-65, Chậu Trồng Cây Thông Minh', NULL),
(6083776240, 'Khay Nhỏ Vuông Trồng Cây Rau Mầm Ban Công 42x38x11cm', 'Khay Nhỏ Vuông Trồng Cây Rau Mầm Ban Công 42x38x11cm', NULL),
(6846678111, 'Kéo Cắt Tỉa Cành Cầm Tay Lưỡi Cong Asaki 8639  + tặng kèm dao rọc giấy mini', 'Kéo Cắt Tỉa Cành Cầm Tay Lưỡi Cong Asaki 8639 + tặng kèm dao rọc giấy mini', NULL),
(5328948458, 'Hạt Giống Ớt Sừng Vàng  Tâm Nông - Gói 100Mg', 'Hạt Giống Ớt Sừng Vàng - Gói 100Mg', NULL),
(4329116359, 'Hạt Giống Ớt Chuông (Ớt Ngọt)  Tâm Nông - Gói 100Mg', 'Hạt Giống Ớt Chuông (Ớt Ngọt) - Gói 100Mg', NULL),
(5527669818, 'Hạt Giống Ớt Chỉ Thiên F1 (Ớt Hiểm Đỏ)  Tâm Nông - Gói 100Mg', 'Hạt Giống Ớt Chỉ Thiên F1 (Ớt Hiểm Đỏ) - Gói 100Mg', NULL),
(3626132117, 'Hạt Giống Xà Lách Xoăn Cao Sản Tâm Nông', 'Hạt Giống Xà Lách Xoăn Cao Sản', NULL),
(4446713390, 'Hạt Giống Xà Lách Vàng Cao Sản Tâm Nông', 'Hạt Giống Xà Lách Vàng Cao Sản', NULL),
(5025713873, 'Hạt Giống Xà Lách Tím Lollo Rossa Tâm Nông - Gói 2G', 'Hạt Giống Xà Lách Tím Lollo Rossa - Gói 2G', NULL),
(5926034531, 'Hạt Giống Xà Lách Minetto Tâm Nông - Gói 2G', 'Hạt Giống Xà Lách Minetto - Gói 2G', NULL),
(7426034769, 'Hạt Giống Xà Lách Búp High Land Tâm Nông 2G', 'Hạt Giống Xà Lách Búp High Land 2G', NULL),
(5025333280, 'Hạt Giống Xà Lách Ăn Non Châu Âu Baby Tâm Nông 10G Dễ Trồng, Chịu Nhiệt', 'Hạt Giống Xà Lách Ăn Non Châu Âu Baby 10G Dễ Trồng, Chịu Nhiệt', NULL),
(4026035144, 'Hạt Giống Tỏi Tây Tâm Nông 2G', 'Hạt Giống Tỏi Tây 2G', NULL),
(5125710574, 'Hạt Giống Thì Là Bốn Mùa Tâm Nông 5G', 'Hạt Giống Thì Là Bốn Mùa 5G', NULL),
(6526006025, 'Hạt Giống Đu Đủ Ruột Đỏ, Ruột Vàng Tâm Nông 10H', 'Hạt Giống Đu Đủ Ruột Đỏ, Ruột Vàng 10H', NULL),
(5821744168, 'Dung Dịch Thủy Canh Rau Ăn Lá, ăn quả, cây cảnh Hydro Umat V (Bộ 1, 2 Chai)', 'Dung Dịch Thủy Canh Rau Ăn Lá, ăn quả, cây cảnh Hydro Umat V (Bộ 1, 2 Chai)', NULL),
(3725784700, 'Hạt Giống Đậu Rồng 10G Tâm Nông', 'Hạt Giống Đậu Rồng 10G', NULL),
(4125829528, 'Hạt Giống Đậu Đũa Hạt Đen 10G Tâm Nông', 'Hạt Giống Đậu Đũa Hạt Đen 10G', NULL),
(5746707258, 'Hạt Giống Đậu Cove Trắng Leo 10G Tâm Nông', 'Hạt Giống Đậu Cove Trắng Leo 10G', NULL),
(3860246224, 'Hạt Giống Đậu Bắp Đỏ Tím 5G Tâm Nông', 'Hạt Giống Đậu Bắp Đỏ Tím 5G', NULL),
(3528959055, 'Hạt Giống Đậu Bắp 10G Tâm Nông', 'Hạt Giống Đậu Bắp 10G', NULL),
(7125335121, 'Hạt Giống Su Hào 2G Tâm Nông', 'Hạt Giống Su Hào 2G', NULL),
(7746652766, 'Hạt Giống Rau Tía Tô 2G Tâm Nông', 'Hạt Giống Rau Tía Tô 2G', NULL),
(5629111062, 'Hạt Giống Rau Thơm Sả (Hạt É Trắng) 1G Tâm Nông', 'Hạt Giống Rau Thơm Sả (Hạt É Trắng) 1G', NULL),
(5725705124, 'Hạt Giống Rau Tần Ô (Cúc Tẻ, Cúc Nếp) Tâm Nông', 'Hạt Giống Rau Tần Ô (Cúc Tẻ, Cúc Nếp)', NULL),
(3425800501, 'Hạt Giống Rau Sam 2G Tâm Nông', 'Hạt Giống Rau Sam 2G', NULL),
(3827823615, 'Hạt Giống Rau Quế 5G Tâm Nông', 'Hạt Giống Rau Quế 5G', NULL),
(4546704009, 'Hạt Giống Rau Mồng Tơi Hạt To Trồng Ngắn Ngày Tâm Nông', 'Hạt Giống Rau Mồng Tơi Hạt To Trồng Ngắn Ngày', NULL),
(6228857904, 'Hạt Giống Rau Mầm Thảo Dược 20G Tâm Nông', 'Hạt Giống Rau Mầm Thảo Dược 20G', NULL),
(4527553686, 'Hạt Giống Rau Mầm Giá Đậu Xanh 100G Tâm Nông', 'Hạt Giống Rau Mầm Giá Đậu Xanh 100G', NULL),
(4226042095, 'Hạt Giống Rau Mầm Đậu Hà Lan 50G Tâm Nông', 'Hạt Giống Rau Mầm Đậu Hà Lan 50G', NULL),
(6925700301, 'Hạt Giống Rau Mầm Củ Cải Đỏ 30G Tâm Nông', 'Hạt Giống Rau Mầm Củ Cải Đỏ 30G', NULL),
(7126032953, 'Hạt Giống Rau Má Lá Nhỏ 1G Tâm Nông', 'Hạt Giống Rau Má Lá Nhỏ 1G', NULL),
(3425146812, 'Hạt Giống Rau Kinh Giới 2G Tâm Nông', 'Hạt Giống Rau Kinh Giới 2G', NULL),
(6625690887, 'Hạt Giống Rau Đay Đỏ 20G Tâm Nông', 'Hạt Giống Rau Đay Đỏ 20G', NULL),
(5846684677, 'Hạt Giống Rau Muống Cao Sản Tâm Nông', 'Hạt Giống Rau Muống Cao Sản', NULL),
(5825815437, 'Hạt Giống Rau Dền Xanh Lá Tròn Tâm Nông', 'Hạt Giống Rau Dền Xanh Lá Tròn', NULL),
(3143218488, 'Hạt Giống Ngò Hạt Lớn Pháp 20G Tâm Nông', 'Hạt Giống Ngò Hạt Lớn Pháp 20G', NULL),
(3527740036, 'Hạt Giống Rau Dền Tiều Tâm Nông Tâm Nông', 'Hạt Giống Rau Dền Tiều', NULL),
(6326015242, 'Hạt Giống Khổ Qua Rừng (Mướp Đắng) 1G Tâm Nông', 'Hạt Giống Khổ Qua Rừng (Mướp Đắng) 1G', NULL),
(5525829314, 'Hạt Giống Rau Dền Đỏ Tâm Nông', 'Hạt Giống Rau Dền Đỏ', NULL),
(3625435689, 'Hạt Giống Rau Dền Cơm 10G Tâm Nông', 'Hạt Giống Rau Dền Cơm 10G', NULL),
(5046706609, 'Hạt Giống Rau Dền 3 Màu Tâm Nông', 'Hạt Giống Rau Dền 3 Màu', NULL),
(4525687672, 'Hạt Giống Rau Càng Cua 500Mg Tâm Nông', 'Hạt Giống Rau Càng Cua 500Mg', NULL),
(6426032471, 'Hạt Giống Ngò Gai (Mùi Tàu) 5G Tâm Nông', 'Hạt Giống Ngò Gai (Mùi Tàu) 5G', NULL),
(4726021567, 'Hạt Giống Mướp Khía 1G Tâm Nông', 'Hạt Giống Mướp Khía 1G', NULL),
(4126032206, 'Hạt Giống Ngò Bạc Liêu (Ngò Rí) 20G Tâm Nông', 'Hạt Giống Ngò Bạc Liêu (Ngò Rí) 20G', NULL),
(4527668128, 'Hạt Giống Mướp Rắn (Lặc Lè, Khổ Qua Tây) 2G Tâm Nông', 'Hạt Giống Mướp Rắn (Lặc Lè, Khổ Qua Tây) 2G', NULL),
(7327661245, 'Hạt Giống Mướp Hương Trái Ngắn 1G Tâm Nông', 'Hạt Giống Mướp Hương Trái Ngắn 1G', NULL),
(6926018415, 'Hạt Giống Mướp Hương Trái Dài 1G Tâm Nông', 'Hạt Giống Mướp Hương Trái Dài 1G', NULL),
(5429114055, 'Hạt Giống Măng Tây 2G Tâm Nông', 'Hạt Giống Măng Tây 2G', NULL),
(7028948401, 'Hạt Giống Mầm Rau Muống 100G Tâm Nông', 'Hạt Giống Mầm Rau Muống 100G', NULL),
(7825732393, 'Hạt Giống Mầm Lúa Mạch, lúa mì 100G Tâm Nông', 'Hạt Giống Mầm Lúa Mạch, lúa mì 100G', NULL),
(6926013320, 'Hạt Giống Khổ Qua Trái Xanh F1 (Mướp Đắng) 3G Tâm Nông', 'Hạt Giống Khổ Qua Trái Xanh F1 (Mướp Đắng) 3G', NULL),
(3626110706, 'Hạt Giống Khổ Qua F1 (Mướp Đắng) 2G Tâm Nông', 'Hạt Giống Khổ Qua F1 (Mướp Đắng) 2G', NULL),
(5526009501, 'Hạt Giống Hẹ Cao Sản 2G Tâm Nông', 'Hạt Giống Hẹ Cao Sản 2G', NULL),
(6526007927, 'Hạt Giống Hành Lá Gốc Trắng 2G Tâm Nông', 'Hạt Giống Hành Lá Gốc Trắng 2G', NULL),
(5228488886, 'Hạt Giống Hoa Xác Pháo Red 300Mg Tâm Nông', 'Hạt Giống Hoa Xác Pháo Red 300Mg', NULL),
(4928488540, 'Hạt Giống Hoa Vạn Thọ Pháp 1G Tâm Nông', 'Hạt Giống Hoa Vạn Thọ Pháp 1G', NULL),
(3628237208, 'Hạt Giống Hoa Thược Dược Mix Gói 0.5g Tâm Nông', 'Hạt Giống Hoa Thược Dược Mix Gói 0.5g', NULL),
(3529039597, 'Hạt Giống Hoa Sao Nhái Kép Mix 20H Tâm Nông', 'Hạt Giống Hoa Sao Nhái Kép Mix 20H', NULL),
(6528131280, 'Hạt Giống Hoa Sao Nhái Đơn Mix 10H Tâm Nông', 'Hạt Giống Hoa Sao Nhái Đơn Mix 10H', NULL),
(7646711947, '[Tâm Nông] Hạt Giống Cải Mầm New Zealand (hạt lớn)', 'Hạt Giống Cải Mầm New Zealand (hạt lớn)', NULL),
(3644834888, 'Bộ 3 Phân Bón Lá Đầu Trâu 501, 701, 901 (Nảy Chồi, Ra Lá, Kích Hoa, Nhiều Hoa, Đậu Trái)', 'Bộ 3 Phân Bón Lá Đầu Trâu 501, 701, 901 (Nảy Chồi, Ra Lá, Kích Hoa, Nhiều Hoa, Đậu Trái)', NULL),
(6840072841, '[Túi Lớn 1Kg] Hạt Giống Mầm Lúa Mạch Tâm Nông, lúa mì Dễ Trồng', '[Túi Lớn 1Kg] Hạt Giống Mầm Lúa Mạch , lúa mì Dễ Trồng', NULL),
(7627547362, '[Tâm Nông] Hạt Giống Cà Tím F1 (Cà Nâu Cơm Xanh) 200Mg', 'Hạt Giống Cà Tím F1 (Cà Nâu Cơm Xanh) 200Mg', NULL),
(6425313688, '[Tâm Nông] Hạt Giống Cà Pháo Trắng Cao Sản 500Mg', 'Hạt Giống Cà Pháo Trắng Cao Sản 500Mg', NULL),
(5527559305, 'Hạt Giống Bí Đao Chanh F1 200Mg', 'Hạt Giống Bí Đao Chanh F1 200Mg', NULL),
(5325715823, 'Hạt Giống Bầu Lai (Bầu Láng) F1 1G', 'Hạt Giống Bầu Lai (Bầu Láng) F1 1G', NULL),
(5226006686, '[Tâm Nông] Hạt Giống Dưa Leo F1 Taka 1G', 'Hạt Giống Dưa Leo F1 Taka 1G', NULL),
(6528484291, '[Tâm Nông] Hạt Giống Hoa Mào Gà Lửa Kimono Mix 20 Hạt', 'Hạt Giống Hoa Mào Gà Lửa Kimono Mix 20 Hạt', NULL),
(4946468447, '[Tâm Nông] Hạt Giống Cải Thảo Yellow Head 1G', 'Hạt Giống Cải Thảo Yellow Head 1G', NULL),
(7825736073, 'Hạt Giống Bí Đỏ Hạt Đậu F1 2G', 'Hạt Giống Bí Đỏ Hạt Đậu F1 2G', NULL),
(6425739272, 'Hạt Giống Bí Đỏ F1, Bí Sáp (Trái Tròn) 2G', 'Hạt Giống Bí Đỏ F1, Bí Sáp (Trái Tròn) 2G', NULL),
(5644768173, 'Bộ 3 Phân Bón Lá Đầu Trâu Spray 1, 2, 3 (Nảy Chồi, Ra Lá, Kích Hoa, Nhiều Hoa, Đậu Trái)', 'Bộ 3 Phân Bón Lá Đầu Trâu Spray 1, 2, 3 (Nảy Chồi, Ra Lá, Kích Hoa, Nhiều Hoa, Đậu Trái)', NULL),
(7028130156, '[Tâm Nông] Hạt Giống Hoa Sao Nhái Cam Kép Lùn 20H', 'Hạt Giống Hoa Sao Nhái Cam Kép Lùn 20H', NULL),
(5028144439, '[Tâm Nông] Hạt Giống Hoa Mười Giờ Mix 500Mg', 'Hạt Giống Hoa Mười Giờ Mix 500Mg', NULL),
(6528126770, '[Tâm Nông] Hạt Giống Hoa Mười Giờ Kép Mix 30H', 'Hạt Giống Hoa Mười Giờ Kép Mix 30H', NULL),
(6028485149, '[Tâm Nông] Hạt Giống Hoa Mõm Sói Mix 500Mg', 'Hạt Giống Hoa Mõm Sói Mix 500Mg', NULL),
(7828462248, '[Tâm Nông] Hạt Giống Hoa Mắt Nai Mix 10H', 'Hạt Giống Hoa Mắt Nai Mix 10H', NULL),
(4528149065, '[Tâm Nông] Hạt Giống Hoa Mào Gà Lửa Scarlet 500Mg', 'Hạt Giống Hoa Mào Gà Lửa Scarlet 500Mg', NULL),
(3728248190, '[Tâm Nông] Hạt Giống Hoa Mào Gà Búa Lở 20H', 'Hạt Giống Hoa Mào Gà Búa Lở 20H', NULL),
(6828128666, '[Tâm Nông] Hạt Giống Hoa Mai Địa Thảo Hồng 10H', 'Hạt Giống Hoa Mai Địa Thảo Hồng 10H', NULL),
(4928460084, '[Tâm Nông] Hạt Giống Hoa Mai Địa Thảo Đỏ 10H', 'Hạt Giống Hoa Mai Địa Thảo Đỏ 10H', NULL),
(5928456434, '[Tâm Nông] Hạt Giống Hoa Mai Địa Thảo Cherry 10H', 'Hạt Giống Hoa Mai Địa Thảo Cherry 10H', NULL),
(3828562427, '[Tâm Nông] Hạt Giống Hoa Hướng Dương Xù 0.5G', 'Hạt Giống Hoa Hướng Dương Xù 0.5G', NULL),
(6828464714, '[Tâm Nông] Hạt Giống Hoa Hướng Dương Valentino 10H', 'Hạt Giống Hoa Hướng Dương Valentino 10H', NULL),
(7628856716, '[Tâm Nông] Hạt Giống Hoa Dừa Cạn Rũ Hồng 10H', 'Hạt Giống Hoa Dừa Cạn Rũ Hồng 10H', NULL),
(3930437567, 'Phân Bón Dưỡng Hoa Chuyên Hoa Kiểng (Phân ĐầU Trâu 901) 100G', 'Phân Bón Dưỡng Hoa Chuyên Hoa Kiểng (Phân ĐầU Trâu 901) 100G', NULL),
(3628547659, '[Tâm Nông] Hạt Giống Hoa Dạ Yên Thảo Kép Mix 15H', 'Hạt Giống Hoa Dạ Yên Thảo Kép Mix 15H', NULL),
(7528454518, '[Tâm Nông] Hạt Giống Hoa Dạ Yên Thảo F1 Viền Mix 15H', 'Hạt Giống Hoa Dạ Yên Thảo F1 Viền Mix 15H', NULL),
(4228452942, '[Tâm Nông] Hạt Giống Hoa Dạ Yên Thảo F1 Trơn Tím 15H', 'Hạt Giống Hoa Dạ Yên Thảo F1 Trơn Tím 15H', NULL),
(6328446869, '[Tâm Nông] Hạt Giống Hoa Dạ Yên Thảo F1 Trơn Hồng 15H', 'Hạt Giống Hoa Dạ Yên Thảo F1 Trơn Hồng 15H', NULL),
(4428933248, '[Tâm Nông] Hạt Giống Hoa Dạ Yên Thảo F1 Rũ Hồng 5H', 'Hạt Giống Hoa Dạ Yên Thảo F1 Rũ Hồng 5H', NULL),
(7328446366, '[Tâm Nông] Hạt Giống Hoa Dạ Yên Thảo F1 Có Gân Mix 15H', 'Hạt Giống Hoa Dạ Yên Thảo F1 Có Gân Mix 15H', NULL),
(5328138007, '[Tâm Nông] Hạt Giống Hoa Cúc Đà Lạt 5G', 'Hạt Giống Hoa Cúc Đà Lạt 5G', NULL),
(3228607890, '[Tâm Nông] Hạt Giống Hoa Cẩm Chướng Đơn Telstar Mix 10H', 'Hạt Giống Hoa Cẩm Chướng Đơn Telstar Mix 10H', NULL),
(6128944018, '[Tâm Nông] Hạt Giống Hoa Cúc Sao Băng 100Mg', 'Hạt Giống Hoa Cúc Sao Băng 100Mg', NULL),
(6728137722, '[Tâm Nông] Hạt Giống Hoa Cúc Nút Áo Mix 500Mg', 'Hạt Giống Hoa Cúc Nút Áo Mix 500Mg', NULL),
(3528580569, '[Tâm Nông] Hạt Giống Hoa Cúc Lá Nhám Mix 1G', 'Hạt Giống Hoa Cúc Lá Nhám Mix 1G', NULL),
(7128460441, '[Tâm Nông] Hạt Giống Hoa Cúc Lá Nhám Dreamland Mix 5H', 'Hạt Giống Hoa Cúc Lá Nhám Dreamland Mix 5H', NULL),
(5225700381, '[Tâm Nông] Hạt Giống Dưa Lưới Gói 10 Hạt Độ Đường Cao, Đặc', 'Hạt Giống Dưa Lưới Gói 10 Hạt Độ Đường Cao, Đặc', NULL),
(5827650621, '[Tâm Nông] Hạt Giống Dưa Lê 10 hạt', 'Hạt Giống Dưa Lê 10 hạt', NULL),
(4926007397, '[Tâm Nông] Hạt Giống Dưa Hấu Nụ 3G', 'Hạt Giống Dưa Hấu Nụ 3G', NULL),
(3625795367, '[Tâm Nông] Hạt Giống Dưa Hấu F1 1G', 'Hạt Giống Dưa Hấu F1 1G', NULL),
(7128859919, '[Tâm Nông] Hạt Giống Dâu Tây Gói 10 Hạt', 'Hạt Giống Dâu Tây Gói 10 Hạt', NULL),
(4529117597, '[Tâm Nông] Hạt Giống Củ Cải Đỏ Tròn 5G', 'Hạt Giống Củ Cải Đỏ Tròn 5G', NULL),
(6825818182, '[Tâm Nông] Hạt Giống Củ Cải Trắng 55 Ngày', 'Hạt Giống Củ Cải Trắng 55 Ngày', NULL),
(4646472435, '[Tâm Nông] Hạt Giống Cần Cọng Xanh 5G', 'Hạt Giống Cần Cọng Xanh 5G', NULL),
(5728943396, '[Tâm Nông] Hạt Giống Cải Xoong Mỹ 1G', 'Hạt Giống Cải Xoong Mỹ 1G', NULL),
(4225818949, '[Tâm Nông] Hạt Giống Cải Thìa Cao Sản (Cải Chíp)', 'Hạt Giống Cải Thìa Cao Sản (Cải Chíp)', NULL),
(5625820368, '[Tâm Nông] Hạt Giống Cải Rổ 10G', 'Hạt Giống Cải Rổ 10G', NULL),
(5546710933, '[Tâm Nông] Hạt Giống Cải Ngọt', 'Hạt Giống Cải Ngọt', NULL),
(7327567940, '[Tâm Nông] Hạt Giống Cải Ngồng (Cải Ngọt Ăn Bông)', 'Hạt Giống Cải Ngồng (Cải Ngọt Ăn Bông)', NULL),
(6725818456, '[Tâm Nông] Hạt Giống Cải Đuôi Phụng', 'Hạt Giống Cải Đuôi Phụng', NULL),
(4125390440, '[Tâm Nông] Hạt Giống Cải Cầu Vồng 10G', 'Hạt Giống Cải Cầu Vồng 10G', NULL),
(3325450781, '[Tâm Nông] Hạt Giống Cải Bẹ Xanh Non Baby 20G', 'Hạt Giống Cải Bẹ Xanh Non Baby 20G', NULL),
(4925375405, '[Tâm Nông] Hạt Giống Cải Bông Trắng F1 (Súp Lơ Trắng) 500Mg', 'Hạt Giống Cải Bông Trắng F1 (Súp Lơ Trắng) 500Mg', NULL),
(6825383075, '[Tâm Nông] Hạt Giống Cải Bó Xôi (Rau Bina) Chịu Nhiệt', 'Hạt Giống Cải Bó Xôi (Rau Bina) Chịu Nhiệt', NULL),
(6548764450, 'Hạt Giống Cải Bẹ Xanh Dễ Trồng, Cải Ăn Non, gói zip 5g', 'Hạt Giống Cải Bẹ Xanh Dễ Trồng, Cải Ăn Non, gói zip 5g', NULL),
(7846651453, '[Tâm Nông] Hạt Giống Cải Bẹ Xanh (Cải Xanh Mỡ)', 'Hạt Giống Cải Bẹ Xanh (Cải Xanh Mỡ)', NULL),
(5327573309, '[Tâm Nông] Hạt Giống Cải Bẹ Trắng', 'Hạt Giống Cải Bẹ Trắng', NULL),
(4227614424, '[Tâm Nông] Hạt Giống Cải Bẹ Mào Gà 20G', 'Hạt Giống Cải Bẹ Mào Gà 20G', NULL),
(3825498214, '[Tâm Nông] Hạt Giống Cải Bẹ Dún', 'Hạt Giống Cải Bẹ Dún', NULL),
(5029991486, '[Combo 2 Gói Hạt Giống] Rau Má + Cải Bẹ Dún', '[Combo 2 Gói Hạt Giống] Rau Má + Cải Bẹ Dún', NULL),
(5830077758, '[Combo 3 Gói Hạt Giống] Rau Đay Đỏ + Mướp Hương + Cải Bẹ Dưa', '[Combo 3 Gói Hạt Giống] Rau Đay Đỏ + Mướp Hương + Cải Bẹ Dưa', NULL),
(4527575701, '[Tâm Nông] Hạt Giống Cải Bẹ Dưa', 'Hạt Giống Cải Bẹ Dưa', NULL),
(6527641799, '[Tâm Nông] Hạt Giống Cà Xanh 200Mg', 'Hạt Giống Cà Xanh 200Mg', NULL),
(5446617067, '[Tâm Nông] Hạt Giống Chùm Ngây 2G', 'Hạt Giống Chùm Ngây 2G', NULL),
(4127617398, '[Tâm Nông] Hạt Giống Cà Rốt 2G', 'Hạt Giống Cà Rốt 2G', NULL),
(7025824001, '[Tâm Nông] Hạt Giống Cà Pháo Tím 500Mg', 'Hạt Giống Cà Pháo Tím 500Mg', NULL),
(5225353024, '[Tâm Nông] Hạt Giống Cà Dĩa Cao Sản 500Mg', 'Hạt Giống Cà Dĩa Cao Sản 500Mg', NULL),
(5125350135, 'Hạt Giống Cà Chua F1 Tigon 100Mg', 'Hạt Giống Cà Chua F1 Tigon 100Mg', NULL),
(6928959993, 'Hạt Giống Cà Chua F1 Chịu Nhiệt Dễ Trồng 100Mg', 'Hạt Giống Cà Chua F1 Chịu Nhiệt Dễ Trồng 100Mg', NULL),
(5525339628, 'Hạt Giống Cà Chua Bi 100Mg', 'Hạt Giống Cà Chua Bi 100Mg', NULL),
(7225734282, 'Hạt Giống Bầu Sao F1 1G', 'Hạt Giống Bầu Sao F1 1G', NULL),
(7625344428, 'Hạt Giống Bắp Cải F1 (Bắp Sú, Cải Nồi) 1G', 'Hạt Giống Bắp Cải F1 (Bắp Sú, Cải Nồi) 1G', NULL),
(3652610222, 'Hạt Giông Hoa Đậu Biếc Kép Dễ Trồng 20H', 'Hạt Giông Hoa Đậu Biếc Kép Dễ Trồng 20H', NULL),
(9705884756, 'Hạt Giống Bông Cải Xanh F1 (Súp Lơ Xanh) 500Mg', 'Hạt Giống Bông Cải Xanh F1 (Súp Lơ Xanh) 500Mg', NULL),
(5727564238, 'Hạt Giống Bí Sặt 500Mg', 'Hạt Giống Bí Sặt 500Mg', NULL),
(7925336802, 'Hạt Giống Bí Ngồi Hàn Quốc Vàng 2G', 'Hạt Giống Bí Ngồi Hàn Quốc Vàng 2G', NULL),
(3925136519, 'Hạt Giống Bí Ăn Ngọn 20G', 'Hạt Giống Bí Ăn Ngọn 20G', NULL),
(5325346946, 'Hạt Giống Bầu Hồ Lô 1G', 'Hạt Giống Bầu Hồ Lô 1G', NULL),
(5325345544, 'Hạt Giống Bạc Hà Âu 200Mg', 'Hạt Giống Bạc Hà Âu 200Mg', NULL),
(4927115350, 'Giá Thể Trồng Lan Cây Hoa Kiểng Vỏ Thông, Đá Bọt 2Dm3', 'Giá Thể Trồng Lan Cây Hoa Kiểng Vỏ Thông, Đá Bọt 2Dm3', NULL),
(6330130860, 'Giá Thể Đất Sét Nung Trồng Lan, Rau Mầm, Hoa Kiểng 1Md3', 'Giá Thể Đất Sét Nung Trồng Lan, Rau Mầm, Hoa Kiểng 1Md3', NULL),
(3346800194, 'Giá Thể Mùn Dừa Đất H1 Hapigreen 800G (Trồng Rau Mầm, Thủy Canh)', 'Giá Thể Mùn Dừa Đất H1 Hapigreen 800G (Trồng Rau Mầm, Thủy Canh)', NULL),
(6530340844, 'Phân Bón Thúc Nhiều Hoa Chuyên Hoa Cây Kiểng (Phân Đầu Trâu 701) 100G', 'Phân Bón Thúc Nhiều Hoa Chuyên Hoa Cây Kiểng (Phân Đầu Trâu 701) 100G', NULL),
(6622053313, 'Khung treo ban công + chậu, trồng hoa, trồng rau 63cm, 45cm', 'Khung treo ban công + chậu, trồng hoa, trồng rau 63cm, 45cm', NULL),
(3530437486, 'Phân Bón Nảy Chồi Ra Lá Chuyên Hoa Kiểng (Phân ĐầU Trâu 501) 100G', 'Phân Bón Nảy Chồi Ra Lá Chuyên Hoa Kiểng (Phân ĐầU Trâu 501) 100G', NULL),
(7930341232, 'Phân Bón Lá Kích Nảy Mầm (Phân Đầu Trâu 30-10-5) 10G', 'Phân Bón Lá Kích Nảy Mầm (Phân Đầu Trâu 30-10-5) 10G', NULL),
(5630342270, 'Phân Bón Kích Thích Ra Hoa Nhiều Hoa (Phân Đầu Trâu 5-45-10) 10G', 'Phân Bón Kích Thích Ra Hoa Nhiều Hoa (Phân Đầu Trâu 5-45-10) 10G', NULL),
(7046628312, 'Phân Bón Npk 3 Màu 15-12-17 200G', 'Phân Bón Npk 3 Màu 15-12-17 200G', NULL),
(5630342375, 'Phân Bón Nảy Chồi Ra Lá (Phân Đầu Trâu Spray 1) 500Ml', 'Phân Bón Nảy Chồi Ra Lá (Phân Đầu Trâu Spray 1) 500Ml', NULL),
(5930341202, 'Phân Bón Lá Vitamin B1 (Phân Đầu Trâu Amica) 100 Ml', 'Phân Bón Lá Vitamin B1 (Phân Đầu Trâu Amica) 100 Ml', NULL),
(7021740683, 'Phân Bón Lá Ra Hoa Kết Trái Chống Chịu Sâu Bệnh (Phân Bud Booster) 20G', 'Phân Bón Lá Ra Hoa Kết Trái Chống Chịu Sâu Bệnh (Phân Bud Booster) 20G', NULL),
(6630339636, 'Phân Bón Lá ĐầU Trâu Đa Năng 17-12-17+Te Cao Cấp 200G', 'Phân Bón Lá ĐầU Trâu Đa Năng 17-12-17+Te Cao Cấp 200G', NULL),
(4030342046, 'Phân Bón Lá Đầu Trâu Đa Năng 17-12-17+Te Cao Cấp 1Kg', 'Phân Bón Lá Đầu Trâu Đa Năng 17-12-17+Te Cao Cấp 1Kg', NULL),
(7630157655, 'Phân Bón Kích Thích Ra Hoa Nhiều Hoa (Phân Đầu Trâu Spray 2) 500Ml', 'Phân Bón Kích Thích Ra Hoa Nhiều Hoa (Phân Đầu Trâu Spray 2) 500Ml', NULL),
(7621437315, 'Phân Bón Kích Thích Ra Hoa Đậu Trái Tập Trung (Phân Multi K Gold 13-46) 200G', 'Phân Bón Kích Thích Ra Hoa Đậu Trái Tập Trung (Phân Multi K Gold 13-46) 200G', NULL),
(5830153674, 'Phân Bón Hữu Cơ Agrimartin 1Kg', 'Phân Bón Hữu Cơ Agrimartin 1Kg', NULL),
(7130342481, 'Phân Bón Dưỡng Hoa (Phân Đầu Trâu Spray 3) 500Ml', 'Phân Bón Dưỡng Hoa (Phân Đầu Trâu Spray 3) 500Ml', NULL),
(4030161582, 'Phân Bón Đầu Trâu Đa Năng 20-20-15 1Kg', 'Phân Bón Đầu Trâu Đa Năng 20-20-15 1Kg', NULL),
(6321424303, 'Phân Bò Đã Xử Lí, Phân Hữu Cơ 3Dm3', 'Phân Bò Đã Xử Lí, Phân Hữu Cơ 3Dm3', NULL),
(3921511262, 'Xơ Dừa Trồng Lan, Cây Kiểng Hapi Green 200G', 'Xơ Dừa Trồng Lan, Cây Kiểng Hapi Green 200G', NULL),
(5221757660, 'Xẻng Xới Đất Làm Vườn Cao Cấp Thép Không Rỉ, Xẻng Cầm Tay Làm Vườn Trồng Cây', 'Xẻng Xới Đất Làm Vườn Cao Cấp Thép Không Rỉ, Xẻng Cầm Tay Làm Vườn Trồng Cây', NULL),
(4846702284, 'Vòi Phun Tưới Cây, Xịt Rửa Xe Nhựa Cao Cấp 6 Tia Asaki', 'Vòi Phun Tưới Cây, Xịt Rửa Xe Nhựa Cao Cấp 6 Tia Asaki', NULL),
(5739081990, '[Túi Lớn 1Kg] Hạt Giống Rau Mầm New Zealand Hạt To Dễ Trồng, Rau Sạch, Tốt Cho Sức Khỏe, Đẹp Da, Chống Lão Hóa', '[Túi Lớn 1Kg] Hạt Giống Rau Mầm New Zealand Hạt To Dễ Trồng, Rau Sạch, Tốt Cho Sức Khỏe, Đẹp Da, Chống Lão Hóa', NULL),
(7140069573, '[Túi Lớn 1Kg] Hạt Giống Mầm Rau Muống - Tâm Nông, Dễ Trồng, Rau Sạch Ban Công, Giảm Say Nắng, Tăng Đề Kháng, Nhuận Tràng', '[Túi Lớn 1Kg] Hạt Giống Mầm Rau Muống - , Dễ Trồng, Rau Sạch Ban Công, Giảm Say Nắng, Tăng Đề Kháng, Nhuận Tràng', NULL),
(7230144960, 'Ủ Phân Hữu Cơ Chế Phẩm Vi Sinh Vật Tks-M2 100G', 'Ủ Phân Hữu Cơ Chế Phẩm Vi Sinh Vật Tks-M2 100G', NULL),
(7537352646, 'Bộ 3 Dụng Cụ Làm Vườn Lớn, chăm sóc cây cảnh Giá Rẻ', 'Bộ 3 Dụng Cụ Làm Vườn Lớn, chăm sóc cây cảnh Giá Rẻ', NULL),
(7122068881, 'Bình Tưới Cây Xịt Phun Sương Dudaco 1 đến 2 Lít', 'Bình Tưới Cây Xịt Phun Sương Dudaco 1 đến 2 Lít', NULL),
(5229986567, '[Combo 2 Gói Hạt Giống] Rau Mồng Tơi + Dền Cơm', '[Combo 2 Gói Hạt Giống] Rau Mồng Tơi + Dền Cơm', NULL),
(3821842999, 'Dung Dịch Thủy Canh Rau Ăn Quả Hydro Umat F (Bộ 2 Chai)', 'Dung Dịch Thủy Canh Rau Ăn Quả Hydro Umat F (Bộ 2 Chai)', NULL),
(4140030281, '[Túi Lớn 1Kg] Hạt Giống Rau Mầm Đậu Hà Lan Dễ Trồng, Rau Sạch, Dưỡng Da, Tăng Sức Đề Kháng, Tốt Cho Sức Khỏe', '[Túi Lớn 1Kg] Hạt Giống Rau Mầm Đậu Hà Lan Dễ Trồng, Rau Sạch, Dưỡng Da, Tăng Sức Đề Kháng, Tốt Cho Sức Khỏe', NULL),
(5129995629, '[Combo 2 Gói Hạt Giống] Rau Tía Tô + Bạc Hà Âu', '[Combo 2 Gói Hạt Giống] Rau Tía Tô + Bạc Hà Âu', NULL),
(8931241527, 'Đất Trồng Cây Chuyên Dụng Cho Sen Đá Xương Rồng Trộn Sẵn Phân, Sơ Dừa, Đá Bọt, Vermi, Perlite, Giàu Dinh Dưỡng 2dm3 1kg', 'Đất Trồng Cây Chuyên Dụng Cho Sen Đá Xương Rồng Trộn Sẵn Phân, Sơ Dừa, Đá Bọt, Vermi, Perlite, Giàu Dinh Dưỡng 2dm3 1kg', NULL),
(6781182169, 'Bộ Giỏ Sắt Tròn Kèm Chậu Trồng Hoa Treo Hàng Rào Ban Công Bọc Nhựa Dày, Siêu Bền, Không Rỉ, Hàng Đẹp', 'Bộ Giỏ Sắt Tròn Kèm Chậu Trồng Hoa Treo Hàng Rào Ban Công Bọc Nhựa Dày, Siêu Bền, Không Rỉ, Hàng Đẹp', NULL),
(4165069141, 'Bộ Giỏ/Khung/Giá Sắt + chậu lẻ TALOPA Trồng Cây Ban Công, Hàng Rào, Sắt Sơn Tĩnh Điện, Hàng Đẹp', 'Bộ Giỏ/Khung/Giá Sắt + chậu lẻ TALOPA Trồng Cây Ban Công, Hàng Rào, Sắt Sơn Tĩnh Điện, Hàng Đẹp', NULL),
(3646559035, 'Cưa Cắt Cành Cầm Tay Asaki Có Vỏ Bọc Ak 8802', 'Cưa Cắt Cành Cầm Tay Asaki Có Vỏ Bọc Ak 8802', NULL),
(7821768353, 'Cưa Cắt Cành Cầm Tay Minni Asaki Ak-8800', 'Cưa Cắt Cành Cầm Tay Minni Asaki Ak-8800', NULL),
(7644760373, 'Dung Dịch Thủy Canh Cây Cảnh Hydro Umat L (Gồm 1 Chai)', 'Dung Dịch Thủy Canh Cây Cảnh Hydro Umat L (Gồm 1 Chai)', NULL),
(5330136599, 'Đất Sạch Dinh Dưỡng Hữu Cơ H6 Trồng Cây 5Dm3(2Kg)', 'Đất Sạch Dinh Dưỡng Hữu Cơ H6 Trồng Cây 5Dm3(2Kg)', NULL),
(3221600008, 'Bột Dưỡng Hoa Cắt Cành, Chất/Thuốc Dưỡng Cắm Hoa Tươi Lâu Tàn Israel Longlife 1 Hộp 50G (10 Gói 5G)', 'Bột Dưỡng Hoa Cắt Cành, Chất/Thuốc Dưỡng Cắm Hoa Tươi Lâu Tàn Israel Longlife 1 Hộp 50G (10 Gói 5G)', NULL),
(6022056475, 'Bộ 5 khay Ươm, Vỉ Ươm Hạt Cây Con 104 Lỗ', 'Bộ 5 khay Ươm, Vỉ Ươm Hạt Cây Con 104 Lỗ', NULL),
(7921763242, 'Bộ 5 Chậu Nhựa Mềm Trồng Cây 23X16Cm', 'Bộ 5 Chậu Nhựa Mềm Trồng Cây 23X16Cm', NULL),
(7621760759, 'Bộ 5 Chậu Nhựa Mềm Trồng Cây 20X15Cm', 'Bộ 5 Chậu Nhựa Mềm Trồng Cây 20X15Cm', NULL),
(5746704076, 'Bình Xịt Tưới Cây Hàn Quốc 1.5 Lít', 'Bình Xịt Tưới Cây Hàn Quốc 1.5 Lít', NULL),
(7630148535, 'Bình Xịt Cồn Khử Khuẩn,Tưới Cây,Xịt Tóc 750Ml (Bình Phun Sương)', 'Bình Xịt Cồn Khử Khuẩn,Tưới Cây,Xịt Tóc 750Ml (Bình Phun Sương)', NULL),
(6240016247, '[Túi Lớn 1Kg] Hạt Giống Rau Mầm Giá Đậu Xanh Dễ Trồng, Giàu Dinh Dưỡng, Giảm Cân, Tăng Trao Đổi Chất', '[Túi Lớn 1Kg] Hạt Giống Rau Mầm Giá Đậu Xanh Dễ Trồng, Giàu Dinh Dưỡng, Giảm Cân, Tăng Trao Đổi Chất', NULL),
(7240040115, '[Túi Lớn 1Kg] Hạt Giống Mồng Tơi Dễ Trồng, Rau Sạch Ban Công, Dưỡng Da, Nhuận Tràng, Lưu Thông Khí Huyết', '[Túi Lớn 1Kg] Hạt Giống Mồng Tơi Dễ Trồng, Rau Sạch Ban Công, Dưỡng Da, Nhuận Tràng, Lưu Thông Khí Huyết', NULL),
(5349591438, '[Combo Ship Siêu Rẻ] Bộ 5 Khung + Chậu Nhựa Dài Hình Chữ Nhật Trồng Cây Treo Ban Công 63Cm', '[Combo Ship Siêu Rẻ] Bộ 5 Khung + Chậu Nhựa Dài Hình Chữ Nhật Trồng Cây Treo Ban Công 63Cm', NULL),
(3984018528, 'Kệ sắt đế vuông lót chậu bọc nhựa trang trí nhà cửa sân vườn', 'Kệ sắt đế vuông lót chậu bọc nhựa trang trí nhà cửa sân vườn', NULL),
(5686131566, 'Vỉ Nhựa Lót Sàn 5 Nan Hàng VNXK - Giả Gỗ Trang Trí Nhà Cửa Ban Công Nhà Tắm Hồ Bơi Tiện Lợi Tự Lắp Ráp-30x30cmx2cm', 'Vỉ Nhựa Lót Sàn 5 Nan Hàng VNXK - Giả Gỗ Trang Trí Nhà Cửa Ban Công Nhà Tắm Hồ Bơi Tiện Lợi Tự Lắp Ráp-30x30cmx2cm', NULL),
(23949117169, 'Dao rọc giấy mini cute', 'Dao rọc giấy mini cute', NULL),
(6930018154, '[Combo 3 Gói Hạt Giống] Bầu + Bí Ăn Ngọn + Cà Pháo', '[Combo 3 Gói Hạt Giống] Bầu + Bí Ăn Ngọn + Cà Pháo', NULL),
(9240743188, 'Chậu Bonsai Gốm Cổ Tráng Men Kiểu Dáng Độc Đáo Trồng Cây Cảnh Mini Trang Trí Nhà Cửa Sân Vườn - Kim 813 - 13x14x17cm', 'Chậu Bonsai Gốm Cổ Tráng Men Kiểu Dáng Độc Đáo Trồng Cây Cảnh Mini Trang Trí Nhà Cửa Sân Vườn - Kim 813 - 13x14x17cm', NULL),
(9231139814, 'Chậu Đất Nung Gốm Trồng Cây Cảnh Sen Đá Xương Rồng Dễ Thương Trang Trí Bàn Làm Việc Nhà Cửa Phong Cách Vintage', 'Chậu Đất Nung Gốm Trồng Cây Cảnh Sen Đá Xương Rồng Dễ Thương Trang Trí Bàn Làm Việc Nhà Cửa Phong Cách Vintage', NULL),
(8029901398, 'chậu dài trồng cây treo ban công 48cm', 'chậu dài trồng cây treo ban công 48cm', NULL),
(7630159476, 'Phân Bón Vi Khoáng Chuyên Rau Màu (Phân Đầu Trâu Vi Khoáng) 500G', 'Phân Bón Vi Khoáng Chuyên Rau Màu (Phân Đầu Trâu Vi Khoáng) 500G', NULL),
(7460276235, 'bộ kit trồng cỏ mèo tiện lợi dễ trồng có hướng dẫn hạt giống mầm lúa mạch', 'bộ kit trồng cỏ mèo tiện lợi dễ trồng có hướng dẫn hạt giống mầm lúa mạch', NULL),
(4129984907, '[Combo 2 Gói Hạt Giống] Rau Mầm Giá Đậu Xanh 100G', '[Combo 2 Gói Hạt Giống] Rau Mầm Giá Đậu Xanh 100G', NULL),
(4527720087, 'Hạt Giống Ớt Kiểng Vàng 200Mg', 'Hạt Giống Ớt Kiểng Vàng 200Mg', NULL),
(4625818179, 'Hạt Giống Cà Chua Đen 5H', 'Hạt Giống Cà Chua Đen 5H', NULL),
(5527638073, 'Hạt Giống Cà Trứng 200Mg', 'Hạt Giống Cà Trứng 200Mg', NULL),
(4030027126, '[Combo 3 Gói Hạt Giống] Cà Pháo + Cà Tím + Cà Chua', '[Combo 3 Gói Hạt Giống] Cà Pháo + Cà Tím + Cà Chua', NULL),
(4125818524, 'Hạt Giống Cà Chua Bi Trồng Chậu 100Mg', 'Hạt Giống Cà Chua Bi Trồng Chậu 100Mg', NULL),
(4530017182, '[Combo 3 Gói Hạt Giống] Bầu + Bí + Đậu Đũa', '[Combo 3 Gói Hạt Giống] Bầu + Bí + Đậu Đũa', NULL),
(5232516497, '[Combo 2] 2 Chậu Nhựa Trồng Cây Khay Nhựa Chữ Nhật Tm-65', '[Combo 2] 2 Chậu Nhựa Trồng Cây Khay Nhựa Chữ Nhật Tm-65', NULL),
(6029994254, '[Combo 2 Gói Hạt Giống] Rau Muống', '[Combo 2 Gói Hạt Giống] Rau Muống', NULL),
(5825702053, 'Hạt Giống Ớt Kiểng Mix 200Mg', 'Hạt Giống Ớt Kiểng Mix 200Mg', NULL),
(5746597100, 'Phân Hữu Cơ Vi Sinh Gà Good Life 1Kg', 'Phân Hữu Cơ Vi Sinh Gà Good Life 1Kg', NULL),
(5528124436, 'Hạt Giống Hoa Mãn Đình Hồng Kép Carnival 200Mg', 'Hạt Giống Hoa Mãn Đình Hồng Kép Carnival 200Mg', NULL),
(6530074580, '[Combo 3 Gói Hạt Giống] Đậu Cove + Cà Chua + Dưa Leo', '[Combo 3 Gói Hạt Giống] Đậu Cove + Cà Chua + Dưa Leo', NULL),
(6846614926, '[Combo 3 Gói Hạt Giống] Rau Dền Đỏ + Dền Xanh + Mồng Tơi', '[Combo 3 Gói Hạt Giống] Rau Dền Đỏ + Dền Xanh + Mồng Tơi', NULL),
(7628938694, 'Hạt Giống Hoa Dừa Cạn F1 Đứng Vitesse 10 Hạt', 'Hạt Giống Hoa Dừa Cạn F1 Đứng Vitesse 10 Hạt', NULL),
(3144884339, '[Combo 2 Gói Hạt Giống] Rau Mầm Mix Nhiều Loại', '[Combo 2 Gói Hạt Giống] Rau Mầm Mix Nhiều Loại', NULL),
(7421764977, 'Bộ 5 Chậu Nhựa Trồng Cây Hoa Kiểng Sen Đá Xương Rồng Cắm Hoa Để Bàn Trang Nhà Cửa Tròn Xếp Nhỏ Nhiều Màu Dễ Thương 12Cm', 'Bộ 5 Chậu Nhựa Trồng Cây Hoa Kiểng Sen Đá Xương Rồng Cắm Hoa Để Bàn Trang Nhà Cửa Tròn Xếp Nhỏ Nhiều Màu Dễ Thương 12Cm', NULL),
(4059224700, 'Bao/Găng Tay Làm Vườn Trồng Cây Có Móng Vuốt Nhựa Tiện Lợi Đào Đất', 'Bao/Găng Tay Làm Vườn Trồng Cây Có Móng Vuốt Nhựa Tiện Lợi Đào Đất', NULL),
(3760400708, 'Bình Tưới Nước Sen Đá Vòi Cong Bóp Tay Mini Nhỏ Gọn Tiện Lợi Dễ Sử Dụng 250ml', 'Bình Tưới Nước Sen Đá Vòi Cong Bóp Tay Mini Nhỏ Gọn Tiện Lợi Dễ Sử Dụng 250ml', NULL),
(5540648719, 'Bộ Sản Phẩm Trồng Cây', 'Bộ Sản Phẩm Trồng Cây', NULL),
(7122066172, 'Bình Xịt Tưới Cây Dudaco 1 Lít', 'Bình Xịt Tưới Cây Dudaco 1 Lít', NULL),
(7429979609, '[Combo 2 Gói Hạt Giống] Khổ Qua + Ớt', '[Combo 2 Gói Hạt Giống] Khổ Qua + Ớt', NULL),
(5730028543, '[Combo 3 Gói Hạt Giống] Cà Pháo Tím + Cà Chua Bi + Ớt Sừng', '[Combo 3 Gói Hạt Giống] Cà Pháo Tím + Cà Chua Bi + Ớt Sừng', NULL),
(5430085604, '[Combo 3 Gói Hạt Giống] Hành Lá + Ngò + Ớt', '[Combo 3 Gói Hạt Giống] Hành Lá + Ngò + Ớt', NULL),
(7029983182, '[Combo 2 Gói Hạt Giống] Mầm Lúa Mạch', '[Combo 2 Gói Hạt Giống] Mầm Lúa Mạch', NULL),
(6146705723, '[Combo 2 Gói Hạt Giống] Xà Lách + Rau Muống', '[Combo 2 Gói Hạt Giống] Xà Lách + Rau Muống', NULL),
(3330176928, '[Combo 3 Gói Hạt Giống] Cải Ngọt + Cải Bẹ Xanh + Rau Muống', '[Combo 3 Gói Hạt Giống] Cải Ngọt + Cải Bẹ Xanh + Rau Muống', NULL),
(7730102017, '[Combo 3 Gói Hạt Giống] Xà Lách Mix Nhiều Loại', '[Combo 3 Gói Hạt Giống] Xà Lách Mix Nhiều Loại', NULL),
(7730071459, '[Combo 3 Gói Hạt Giống] Cải Mix Nhiều Loại', '[Combo 3 Gói Hạt Giống] Cải Mix Nhiều Loại', NULL),
(5630021095, '[Combo 3 Gói Hạt Giống] Bầu + Cải Xanh + Ớt Xiêm', '[Combo 3 Gói Hạt Giống] Bầu + Cải Xanh + Ớt Xiêm', NULL),
(7429988879, '[Combo 2 Gói Hạt Giống] Mướp Hương + Cà Chua Bi', '[Combo 2 Gói Hạt Giống] Mướp Hương + Cà Chua Bi', NULL),
(4032522609, '[Combo 2] Bình Tưới Cây Hàn Quốc + Phân Bón Hữu Cơ Agrimartin', '[Combo 2] Bình Tưới Cây Hàn Quốc + Phân Bón Hữu Cơ Agrimartin', NULL),
(5532519888, '[Combo 2] Lưới Giàn Dây Leo + Phân Hữu Cơ Bounce Back 500G', '[Combo 2] Lưới Giàn Dây Leo + Phân Hữu Cơ Bounce Back 500G', NULL),
(9833664292, 'Chậu Sơn Dây Treo 💚Trồng Cây Cảnh Hoa Kiểng💚 Để Bàn Làm Việc Tự Dưỡng, Tự Tưới Trang Trí Nội Thất Văn Phòng Nhựa CATLEZA', 'Chậu Sơn Dây Treo 💚Trồng Cây Cảnh Hoa Kiểng💚 Để Bàn Làm Việc Tự Dưỡng, Tự Tưới Trang Trí Nội Thất Văn Phòng Nhựa CATLEZA', NULL),
(4983769908, 'Chậu Sơn Tròn Cầu 💚Trồng Cây Cảnh Hoa Kiểng💚 Để Bàn Làm Việc Tự Dưỡng, Tự Tưới Trang Trí Nội Thất Văn Phòng Nhựa CATLEZA', 'Chậu Sơn Tròn Cầu 💚Trồng Cây Cảnh Hoa Kiểng💚 Để Bàn Làm Việc Tự Dưỡng, Tự Tưới Trang Trí Nội Thất Văn Phòng Nhựa CATLEZA', NULL),
(5146471221, '[Combo 2 Gói Hạt Giống] Cải Bẹ Xanh 50G + Cải Ngọt 50G', '[Combo 2 Gói Hạt Giống] Cải Bẹ Xanh 50G + Cải Ngọt 50G', NULL),
(5783759661, 'Chậu Sơn Lục Giác 💚Trồng Cây Cảnh Hoa Kiểng💚 Để Bàn Làm Việc Tự Dưỡng, Tự Tưới Trang Trí Nội Thất Văn Phòng Nhựa CATLEZA', 'Chậu Sơn Lục Giác 💚Trồng Cây Cảnh Hoa Kiểng💚 Để Bàn Làm Việc Tự Dưỡng, Tự Tưới Trang Trí Nội Thất Văn Phòng Nhựa CATLEZA', NULL),
(8433685388, 'Chậu Sơn Vuông Bầu💚Trồng Cây Cảnh Hoa Kiểng💚 Để Bàn Làm Việc Tự Dưỡng, Tự Tưới Trang Trí Nội Thất Văn Phòng Nhựa CATLEZA', 'Chậu Sơn Vuông Bầu💚Trồng Cây Cảnh Hoa Kiểng💚 Để Bàn Làm Việc Tự Dưỡng, Tự Tưới Trang Trí Nội Thất Văn Phòng Nhựa CATLEZA', NULL),
(8533682062, 'Chậu Sơn Trụ Tròn 💚Trồng Cây Cảnh Hoa Kiểng💚 Để Bàn Làm Việc Tự Dưỡng, Tự Tưới Trang Trí Nội Thất Văn Phòng Nhựa CATLEZA', 'Chậu Sơn Trụ Tròn 💚Trồng Cây Cảnh Hoa Kiểng💚 Để Bàn Làm Việc Tự Dưỡng, Tự Tưới Trang Trí Nội Thất Văn Phòng Nhựa CATLEZA', NULL),
(7830031788, '[Combo 3 Gói Hạt Giống] Cà Rốt + Củ Cải Trắng + Củ Cải Đỏ Tròn', '[Combo 3 Gói Hạt Giống] Cà Rốt + Củ Cải Trắng + Củ Cải Đỏ Tròn', NULL),
(9633654211, 'Chậu Sơn Tròn Bầu 💚Trồng Cây Cảnh Hoa Kiểng💚 Để Bàn Làm Việc Tự Dưỡng, Tự Tưới Trang Trí Nội Thất Văn Phòng Nhựa CATLEZA', 'Chậu Sơn Tròn Bầu 💚Trồng Cây Cảnh Hoa Kiểng💚 Để Bàn Làm Việc Tự Dưỡng, Tự Tưới Trang Trí Nội Thất Văn Phòng Nhựa CATLEZA', NULL),
(6529772342, '[Combo 2 Gói Hạt Giống] Dưa Lưới + Cà Chua Bi', '[Combo 2 Gói Hạt Giống] Dưa Lưới + Cà Chua Bi', NULL),
(4832519574, '[Combo 5] Bình Xịt Tưới Cây + Gía Thể Mùn Dừa + 3 Gói Hạt Giống', '[Combo 5] Bình Xịt Tưới Cây + Gía Thể Mùn Dừa + 3 Gói Hạt Giống', NULL),
(6030094657, '[Combo 3 Gói Hạt Giống] É Trắng (Rau Thơm Xả) + Tía Tô + Rau Quế', '[Combo 3 Gói Hạt Giống] É Trắng (Rau Thơm Xả) + Tía Tô + Rau Quế', NULL),
(6440041752, '[Túi Lớn 500g] Hạt Giống Rau Tần Ô Lá Tròn, Cúc Tẻ, Cúc Nếp Dễ Trồng, Rau Sạch Ban Công, Giảm Mất Ngủ, Cải Thiện Trí Nhớ', '[Túi Lớn 500g] Hạt Giống Rau Tần Ô Lá Tròn, Cúc Tẻ, Cúc Nếp Dễ Trồng, Rau Sạch Ban Công, Giảm Mất Ngủ, Cải Thiện Trí Nhớ', NULL),
(3539182174, '[Túi Lớn 1Kg] Hạt Giống Cải Bẹ Xanh/Cải Xanh Mỡ Dễ Trồng, Tốt Cho Tim Mạch, Chống Lão Hóa, Ngừa Ung Thư', '[Túi Lớn 1Kg] Hạt Giống Cải Bẹ Xanh/Cải Xanh Mỡ Dễ Trồng, Tốt Cho Tim Mạch, Chống Lão Hóa, Ngừa Ung Thư', NULL),
(23549871509, 'Kệ Góc Nhà Tắm, Để Đồ Phòng Tắm Dán Tường Giá Treo Thép Sơn Tĩnh Điện Kèm Miếng dán Không Khoan Tường', 'Kệ Góc Nhà Tắm, Để Đồ Phòng Tắm Dán Tường Giá Treo Thép Sơn Tĩnh Điện Kèm Miếng dán Không Khoan Tường', NULL),
(18082175384, 'Bộ dụng cụ làm vườn, chăm sóc cây cảnh mini', 'Bộ dụng cụ làm vườn, chăm sóc cây cảnh mini', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'point to public_users ID',
  `products` text NOT NULL,
  `date` int(10) UNSIGNED NOT NULL,
  `referrer` varchar(255) NOT NULL,
  `clean_referrer` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `paypal_status` varchar(10) DEFAULT NULL,
  `processed` tinyint(1) NOT NULL DEFAULT 0,
  `viewed` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'viewed status is change when change processed status',
  `confirmed` tinyint(1) NOT NULL DEFAULT 0,
  `discount_code` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders_clients`
--

CREATE TABLE `orders_clients` (
  `id` int(11) NOT NULL,
  `first_name` varchar(500) NOT NULL,
  `last_name` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `phone` varchar(500) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(500) NOT NULL,
  `post_code` varchar(500) NOT NULL,
  `notes` text NOT NULL,
  `for_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `folder` int(10) UNSIGNED DEFAULT NULL COMMENT 'folder with images',
  `image` varchar(255) NOT NULL,
  `time` int(10) UNSIGNED NOT NULL COMMENT 'time created',
  `time_update` int(10) UNSIGNED NOT NULL COMMENT 'time updated',
  `visibility` tinyint(1) NOT NULL DEFAULT 1,
  `shop_categorie` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `procurement` int(10) UNSIGNED NOT NULL,
  `in_slider` tinyint(1) NOT NULL DEFAULT 0,
  `highlighted` tinyint(1) NOT NULL DEFAULT 0,
  `url` varchar(255) NOT NULL,
  `virtual_products` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `brand_id` int(5) DEFAULT NULL,
  `position` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `folder`, `image`, `time`, `time_update`, `visibility`, `shop_categorie`, `quantity`, `procurement`, `in_slider`, `highlighted`, `url`, `virtual_products`, `brand_id`, `position`, `vendor_id`) VALUES
(1, 1, 'product_1.jpg', 1745740800, 1745740800, 1, 39, 20, 5500000, 0, 1, 'xe-dien-scooter-x6', NULL, NULL, 1, 0),
(2, 2, 'product_2.jpg', 1745740800, 1745740800, 1, 42, 15, 7500000, 0, 1, 'xe-dien-smart-v9-plus', NULL, NULL, 2, 0),
(3, 3, 'product_3.jpg', 1745740800, 1745740800, 1, 54, 10, 9800000, 0, 1, 'xe-dien-type3-pro', NULL, NULL, 3, 0),
(4, 4, 'product_4.jpg', 1745740800, 1745740800, 1, 45, 18, 7700000, 0, 1, 'xe-dien-v1-plus-livo', NULL, NULL, 4, 0),
(5, 5, 'product_5.jpg', 1745740800, 1745740800, 1, 55, 12, 7500000, 0, 1, 'xe-dien-yaka-vx', NULL, NULL, 5, 0),
(6, 6, 'product_6.jpg', 1745740800, 1745740800, 1, 55, 10, 8200000, 0, 1, 'xe-dien-yaka-lavara', NULL, NULL, 6, 0),
(7, 7, 'product_7.jpg', 1745740800, 1745740800, 1, 42, 25, 7200000, 0, 1, 'xe-dien-smart-v1-pro', NULL, NULL, 7, 0),
(8, 8, 'product_8.jpg', 1745740800, 1745740800, 1, 56, 8, 10000000, 0, 1, 'xe-dien-hot-trend-dylexe-x1', NULL, NULL, 8, 0),
(9, 9, 'product_9.jpg', 1745740800, 1745740800, 1, 58, 14, 9100000, 0, 0, 'xe-dien-dior-livo', NULL, NULL, 9, 0),
(10, 10, 'product_10.jpg', 1745740800, 1745740800, 1, 41, 20, 7800000, 0, 0, 'xe-dien-vnbike-x6', NULL, NULL, 10, 0),
(11, 11, 'product_11.jpg', 1745740800, 1745740800, 1, 25, 30, 6500000, 0, 0, 'xe-dap-dien-vnbike-i1', NULL, NULL, 11, 0),
(12, 12, 'product_12.jpg', 1745740800, 1745740800, 1, 42, 12, 8500000, 0, 0, 'xe-dien-smart-a9', NULL, NULL, 12, 0),
(13, 13, 'product_13.jpg', 1745740800, 1745740800, 1, 41, 22, 5900000, 0, 0, 'xe-dien-vnbike-a8', NULL, NULL, 13, 0),
(14, 14, 'product_14.jpg', 1745740800, 1745740800, 1, 25, 28, 5500000, 0, 0, 'xe-dap-dien-vnbike-v1-18inh', NULL, NULL, 14, 0),
(15, 15, 'product_15.jpg', 1745740800, 1745740800, 1, 19, 18, 7800000, 0, 0, 'xe-dap-dien-vnbike-hotgirl-g1', NULL, NULL, 15, 0),
(16, 16, 'product_16.jpg', 1745740800, 1745740800, 1, 61, 3, 200000000, 1, 0, 'o-to-dien-vinfast-vf3-thue-pin', NULL, NULL, 16, 0),
(17, 17, 'product_17.jpg', 1745740800, 1745740800, 1, 88, 5, 18000000, 0, 0, 'xe-3-banh-cho-hang-smart-m700', NULL, NULL, 17, 0),
(18, 18, 'product_18.jpg', 1745740800, 1745740800, 1, 63, 2, 165000000, 1, 0, 'o-to-dien-bestune-xiaoma', NULL, NULL, 18, 0),
(19, 19, 'product_19.jpg', 1745740800, 1745740800, 1, 24, 35, 5200000, 0, 0, 'xe-dap-dien-yadea-e3', NULL, NULL, 19, 0),
(20, 20, 'product_20.jpg', 1745740800, 1745740800, 1, 49, 8, 11000000, 0, 0, 'xe-may-dien-tailg-f73', NULL, NULL, 20, 0),
(21, 21, 'product_21.jpg', 1745740800, 1745740800, 1, 120, 50, 210000, 0, 0, 'bo-sac-xe-dien-60v-12a', NULL, NULL, 21, 0),
(22, 22, 'product_22.jpg', 1745740800, 1745740800, 1, 133, 40, 1900000, 0, 0, 'ac-quy-xe-dien-60v-20ah-lithium', NULL, NULL, 22, 0),
(23, 23, 'product_23.jpg', 1745740800, 1745740800, 1, 122, 10, 5800000, 0, 0, 'tram-sac-xe-dien-ac-7kw', NULL, NULL, 23, 0),
(24, 24, 'product_24.jpg', 1745740800, 1745740800, 1, 32, 20, 1600000, 0, 0, 'xe-dien-tre-em-mini-3-banh-36v', NULL, NULL, 24, 0),
(25, 25, 'product_25.jpg', 1745740800, 1745740800, 1, 43, 6, 13000000, 0, 0, 'xe-may-dien-pega-newtech-2024', NULL, NULL, 25, 0),
(26, 26, 'product_26.jpg', 1745740800, 1745740800, 1, 26, 20, 6200000, 0, 0, 'xe-dien-kazuki-s5-plus', NULL, NULL, 26, 0),
(27, 27, 'product_27.jpg', 1745740800, 1745740800, 1, 129, 60, 750000, 0, 0, 'binh-ac-quy-48v-12ah', NULL, NULL, 27, 0),
(28, 28, 'product_28.jpg', 1745740800, 1745740800, 1, 50, 8, 9500000, 0, 0, 'xe-may-dien-giant-hp3-2024', NULL, NULL, 28, 0),
(29, 29, 'product_29.jpg', 1745740800, 1745740800, 1, 111, 80, 200000, 0, 0, 'den-pha-led-xe-dien-sieu-sang', NULL, NULL, 29, 0),
(30, 30, 'product_30.jpg', 1745740800, 1745740800, 1, 90, 4, 25000000, 0, 0, 'xe-dien-3-banh-cho-khach-ev-k300', NULL, NULL, 30, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products_translations`
--

CREATE TABLE `products_translations` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `basic_description` text NOT NULL,
  `price` varchar(20) NOT NULL,
  `old_price` varchar(20) NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `for_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products_translations`
--

INSERT INTO `products_translations` (`id`, `title`, `description`, `basic_description`, `price`, `old_price`, `abbr`, `for_id`) VALUES
(1, 'Xe điện Scooter X6', '<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />\r\n- Tốc độ tối đa: 45 km/h<br />\r\n- Quãng đường đi được: 70 km/lần sạc<br />\r\n- Công suất động cơ: 500 W<br />\r\n- Điện áp ắc quy: 60V<br />\r\n- Dung lượng ắc quy: 20Ah<br />\r\n- Thời gian sạc đầy: 6 - 8 giờ<br />\r\n- Trọng lượng xe: 45 kg<br />\r\n- Tải trọng tối đa: 120 kg</p>\r\n<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />\r\n- Thiết kế thể thao, trẻ trung, phù hợp học sinh sinh viên và người đi làm<br />\r\n- Động cơ brushless không chổi than, vận hành êm ái, bền bỉ<br />\r\n- Tiết kiệm chi phí nhiên liệu, thân thiện với môi trường<br />\r\n- Ắc quy GEL chất lượng cao, chu kỳ sạc dài<br />\r\n- Hệ thống phanh đĩa phía trước, phanh cơ phía sau đảm bảo an toàn<br />\r\n- Đèn LED chiếu sáng mạnh, tiết kiệm điện</p>\r\n<p><strong>CHÍNH SÁCH BẢO HÀNH &amp; DỊCH VỤ:</strong><br />\r\n- Bảo hành toàn xe: 12 tháng<br />\r\n- Bảo hành ắc quy: 12 tháng<br />\r\n- Bảo hành động cơ: 24 tháng<br />\r\n- Giao hàng tận nơi, lắp ráp miễn phí trong nội thành</p>', 'Xe điện Scooter X6 thiết kế thể thao, tốc độ tối đa 45 km/h, quãng đường 70 km/lần sạc.', '8500000', '9500000', 'vi', 1),
(2, 'Xe điện Smart V9 Plus', '<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />\r\n- Tốc độ tối đa: 50 km/h<br />\r\n- Quãng đường đi được: 80 km/lần sạc<br />\r\n- Công suất động cơ: 500 W<br />\r\n- Điện áp ắc quy: 60V<br />\r\n- Dung lượng ắc quy: 20Ah<br />\r\n- Thời gian sạc đầy: 6 - 8 giờ<br />\r\n- Trọng lượng xe: 48 kg<br />\r\n- Tải trọng tối đa: 120 kg</p>\r\n<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />\r\n- Thiết kế hiện đại, sang trọng phù hợp nhiều đối tượng sử dụng<br />\r\n- Động cơ brushless mạnh mẽ, vận hành êm ái<br />\r\n- Tiết kiệm chi phí nhiên liệu, thân thiện với môi trường<br />\r\n- Ắc quy Lithium chất lượng cao, chu kỳ sạc dài<br />\r\n- Có công tắc khóa xe, chống trộm hiệu quả</p>\r\n<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />\r\n- Bảo hành toàn xe: 12 tháng<br />\r\n- Bảo hành ắc quy: 12 tháng<br />\r\n- Bảo hành động cơ: 24 tháng</p>', 'Xe điện Smart V9 Plus kiểu dáng hiện đại, động cơ 500W, phạm vi hoạt động 80 km/lần sạc.', '11500000', '12500000', 'vi', 2),
(3, 'Xe điện TYPE3 Pro', '<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />\r\n- Tốc độ tối đa: 55 km/h<br />\r\n- Quãng đường đi được: 90 km/lần sạc<br />\r\n- Công suất động cơ: 800 W<br />\r\n- Điện áp ắc quy: 72V<br />\r\n- Dung lượng ắc quy: 20Ah<br />\r\n- Thời gian sạc đầy: 7 - 9 giờ<br />\r\n- Trọng lượng xe: 55 kg<br />\r\n- Tải trọng tối đa: 150 kg</p>\r\n<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />\r\n- Khung thép cường lực, chắc chắn, bền bỉ theo thời gian<br />\r\n- Động cơ 800W mạnh mẽ, leo dốc tốt<br />\r\n- Màn hình LCD hiển thị tốc độ, quãng đường, mức pin<br />\r\n- Phanh đĩa cả 2 bánh, an toàn tuyệt đối<br />\r\n- Hệ thống đèn LED đầy đủ, tầm nhìn tốt ban đêm</p>\r\n<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />\r\n- Bảo hành toàn xe: 12 tháng<br />\r\n- Bảo hành ắc quy: 12 tháng<br />\r\n- Bảo hành động cơ: 24 tháng<br />\r\n- Hỗ trợ bảo dưỡng miễn phí lần đầu tại cửa hàng</p>', 'Xe điện TYPE3 Pro cao cấp, khung thép cường lực, tốc độ 55 km/h, phạm vi 90 km.', '14990000', '16990000', 'vi', 3),
(4, 'Xe điện V1 Plus Livo', '<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />\r\n- Tốc độ tối đa: 45 km/h<br />\r\n- Quãng đường đi được: 75 km/lần sạc<br />\r\n- Công suất động cơ: 500 W<br />\r\n- Điện áp ắc quy: 60V<br />\r\n- Dung lượng ắc quy: 20Ah<br />\r\n- Thời gian sạc đầy: 6 - 8 giờ</p>\r\n<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />\r\n- Thiết kế thanh lịch, màu sắc pastel nhẹ nhàng dành cho nữ<br />\r\n- Khung xe nhỏ gọn, dễ điều khiển<br />\r\n- Yên xe êm ái, có thể điều chỉnh độ cao<br />\r\n- Giỏ xe phía trước tiện lợi<br />\r\n- Hệ thống chống trộm tích hợp</p>\r\n<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />\r\n- Bảo hành toàn xe: 12 tháng<br />\r\n- Bảo hành ắc quy: 12 tháng<br />\r\n- Bảo hành động cơ: 24 tháng</p>', 'Xe điện V1 Plus Livo dành cho nữ, thiết kế thanh lịch, tốc độ 45 km/h, quãng đường 75 km.', '11800000', '13000000', 'vi', 4),
(5, 'Xe điện YAKA VX', '<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />\r\n- Tốc độ tối đa: 50 km/h<br />\r\n- Quãng đường đi được: 80 km/lần sạc<br />\r\n- Công suất động cơ: 500 W<br />\r\n- Điện áp ắc quy: 60V<br />\r\n- Dung lượng ắc quy: 20Ah<br />\r\n- Thời gian sạc đầy: 6 - 8 giờ</p>\r\n<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />\r\n- Thiết kế mạnh mẽ, cứng cáp, phù hợp cho nam giới<br />\r\n- Khung hợp kim nhôm siêu nhẹ<br />\r\n- Hệ thống phanh đĩa thủy lực cả 2 bánh<br />\r\n- Đèn pha LED projector chiếu xa<br />\r\n- Có cổng sạc USB tích hợp trên xe</p>\r\n<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />\r\n- Bảo hành toàn xe: 12 tháng<br />\r\n- Bảo hành ắc quy: 12 tháng<br />\r\n- Bảo hành động cơ: 24 tháng</p>', 'Xe điện YAKA VX thiết kế mạnh mẽ, cứng cáp, phù hợp cho nam giới.', '11500000', '11500000', 'vi', 5),
(6, 'Xe điện YAKA LAVARA', '<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />\r\n- Tốc độ tối đa: 50 km/h<br />\r\n- Quãng đường đi được: 80 km/lần sạc<br />\r\n- Công suất động cơ: 500 W<br />\r\n- Điện áp ắc quy: 60V<br />\r\n- Dung lượng ắc quy: 20Ah<br />\r\n- Thời gian sạc đầy: 6 - 8 giờ</p>\r\n<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />\r\n- Phong cách châu Âu, màu sắc thời trang đa dạng<br />\r\n- Khung xe hiện đại, đường nét mượt mà<br />\r\n- Cụm đồng hồ kỹ thuật số hiển thị đầy đủ thông tin<br />\r\n- Phanh đĩa phía trước, phanh tang trống phía sau<br />\r\n- Yên da cao cấp, chịu nước</p>\r\n<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />\r\n- Bảo hành toàn xe: 12 tháng<br />\r\n- Bảo hành ắc quy: 12 tháng</p>', 'Xe điện YAKA LAVARA phong cách châu Âu, màu sắc thời trang, tốc độ 50 km/h.', '12500000', '12500000', 'vi', 6),
(7, 'Xe điện Smart V1 Pro', '<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />\r\n- Tốc độ tối đa: 45 km/h<br />\r\n- Quãng đường đi được: 70 km/lần sạc<br />\r\n- Công suất động cơ: 500 W<br />\r\n- Điện áp ắc quy: 48V<br />\r\n- Dung lượng ắc quy: 12Ah<br />\r\n- Thời gian sạc đầy: 6 - 8 giờ<br />\r\n- Trọng lượng xe: 38 kg</p>\r\n<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />\r\n- Nhỏ gọn, tiết kiệm, phù hợp di chuyển nội đô<br />\r\n- Dễ điều khiển, phù hợp người mới<br />\r\n- Chi phí vận hành cực thấp, chỉ ~4.000đ/100km<br />\r\n- Ắc quy GEL bền, không cần bảo dưỡng thường xuyên</p>\r\n<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />\r\n- Bảo hành toàn xe: 12 tháng<br />\r\n- Bảo hành ắc quy: 12 tháng<br />\r\n- Bảo hành động cơ: 24 tháng</p>', 'Xe điện Smart V1 Pro nhỏ gọn, tiết kiệm, phù hợp di chuyển nội đô.', '10990000', '11990000', 'vi', 7),
(8, 'Xe điện Hot Trend DYLEXE X1', '<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />\r\n- Tốc độ tối đa: 55 km/h<br />\r\n- Quãng đường đi được: 90 km/lần sạc<br />\r\n- Công suất động cơ: 800 W<br />\r\n- Điện áp ắc quy: 72V<br />\r\n- Dung lượng ắc quy: 20Ah<br />\r\n- Thời gian sạc đầy: 7 - 9 giờ</p>\r\n<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />\r\n- Xu hướng mới 2024, thiết kế độc đáo, thu hút mọi ánh nhìn<br />\r\n- Hệ thống đèn LED dải viền theo thân xe thời trang<br />\r\n- Lốp xe rộng, khả năng bám đường tốt<br />\r\n- Trang bị cổng USB sạc thiết bị di động<br />\r\n- Hệ thống khóa chống trộm thông minh</p>\r\n<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />\r\n- Bảo hành toàn xe: 12 tháng<br />\r\n- Bảo hành động cơ: 24 tháng</p>', 'Xe điện DYLEXE X1 xu hướng mới, thiết kế độc đáo, tốc độ cao 55 km/h.', '15500000', '17000000', 'vi', 8),
(9, 'Xe điện Dior Livo', '<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />\r\n- Tốc độ tối đa: 45 km/h<br />\r\n- Quãng đường đi được: 80 km/lần sạc<br />\r\n- Công suất động cơ: 500 W<br />\r\n- Điện áp ắc quy: 60V<br />\r\n- Dung lượng ắc quy: 20Ah<br />\r\n- Thời gian sạc đầy: 6 - 8 giờ</p>\r\n<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />\r\n- Thiết kế sang trọng, lấy cảm hứng từ thời trang cao cấp<br />\r\n- Dành riêng cho phái đẹp, màu sắc tinh tế<br />\r\n- Yên xe bọc da mềm mại, thoải mái khi ngồi lâu<br />\r\n- Giỏ xe phía trước thiết kế sang trọng<br />\r\n- Cụm đèn pha bo tròn thời trang</p>\r\n<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />\r\n- Bảo hành toàn xe: 12 tháng<br />\r\n- Bảo hành ắc quy: 12 tháng<br />\r\n- Bảo hành động cơ: 24 tháng</p>', 'Xe điện Dior Livo sang trọng, thiết kế dành cho phái đẹp, quãng đường 80 km.', '13990000', '14990000', 'vi', 9),
(10, 'Xe điện Vnbike X6', '<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />\r\n- Tốc độ tối đa: 50 km/h<br />\r\n- Quãng đường đi được: 75 km/lần sạc<br />\r\n- Công suất động cơ: 500 W<br />\r\n- Điện áp ắc quy: 60V<br />\r\n- Dung lượng ắc quy: 20Ah<br />\r\n- Thời gian sạc đầy: 6 - 8 giờ</p>\r\n<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />\r\n- Sản xuất tại Việt Nam, chất lượng cao, giá cạnh tranh<br />\r\n- Linh kiện dễ tìm, chi phí bảo dưỡng thấp<br />\r\n- Khung xe bền chắc, chịu được điều kiện đường Việt Nam<br />\r\n- Hệ thống điện ổn định, ít hỏng vặt</p>\r\n<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />\r\n- Bảo hành toàn xe: 12 tháng<br />\r\n- Bảo hành ắc quy: 12 tháng<br />\r\n- Bảo hành động cơ: 24 tháng</p>', 'Xe điện Vnbike X6 sản xuất trong nước, chất lượng cao, giá cạnh tranh.', '11990000', '11990000', 'vi', 10),
(11, 'Xe đạp điện Vnbike i1', '<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />\r\n- Tốc độ tối đa: 35 km/h<br />\r\n- Quãng đường đi được: 60 km/lần sạc<br />\r\n- Công suất động cơ: 250 W<br />\r\n- Điện áp ắc quy: 48V<br />\r\n- Dung lượng ắc quy: 12Ah<br />\r\n- Thời gian sạc đầy: 5 - 7 giờ<br />\r\n- Trọng lượng xe: 30 kg</p>\r\n<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />\r\n- Nhỏ gọn, dễ đi, phù hợp học sinh sinh viên<br />\r\n- Có thể đạp như xe đạp thường khi hết pin<br />\r\n- Cốp xe rộng đựng được mũ bảo hiểm<br />\r\n- Hệ thống đèn đầy đủ, đảm bảo an toàn ban đêm</p>\r\n<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />\r\n- Bảo hành toàn xe: 12 tháng<br />\r\n- Bảo hành ắc quy: 12 tháng<br />\r\n- Bảo hành động cơ: 24 tháng</p>', 'Xe đạp điện Vnbike i1 gọn nhẹ, tiết kiệm, phù hợp học sinh sinh viên.', '9990000', '10500000', 'vi', 11),
(12, 'Xe điện Smart A9', '<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />\r\n- Tốc độ tối đa: 50 km/h<br />\r\n- Quãng đường đi được: 85 km/lần sạc<br />\r\n- Công suất động cơ: 500 W<br />\r\n- Điện áp ắc quy: 60V<br />\r\n- Dung lượng ắc quy: 20Ah<br />\r\n- Thời gian sạc đầy: 6 - 8 giờ</p>\r\n<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />\r\n- Cao cấp, trang bị đầy đủ, phù hợp đi làm hàng ngày<br />\r\n- Màn hình kỹ thuật số thế hệ mới<br />\r\n- Hệ thống thu hồi năng lượng khi phanh (regenerative braking)<br />\r\n- Ắc quy Lithium tách rời, dễ sạc trong nhà<br />\r\n- Khóa từ thông minh, bảo mật cao</p>\r\n<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />\r\n- Bảo hành toàn xe: 12 tháng<br />\r\n- Bảo hành ắc quy: 12 tháng<br />\r\n- Bảo hành động cơ: 24 tháng</p>', 'Xe điện Smart A9 cao cấp, trang bị đầy đủ, phù hợp đi làm hàng ngày.', '12990000', '13990000', 'vi', 12),
(13, 'Xe điện Vnbike A8', '<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />\r\n- Tốc độ tối đa: 40 km/h<br />\r\n- Quãng đường đi được: 65 km/lần sạc<br />\r\n- Công suất động cơ: 350 W<br />\r\n- Điện áp ắc quy: 48V<br />\r\n- Dung lượng ắc quy: 12Ah<br />\r\n- Thời gian sạc đầy: 5 - 7 giờ</p>\r\n<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />\r\n- Giá tốt, chất lượng đảm bảo, thích hợp nội thành<br />\r\n- Thiết kế cổ điển, không lỗi mốt<br />\r\n- Chi phí bảo dưỡng thấp, linh kiện sẵn có<br />\r\n- Phù hợp người cao tuổi và người mới sử dụng xe điện</p>\r\n<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />\r\n- Bảo hành toàn xe: 12 tháng<br />\r\n- Bảo hành ắc quy: 12 tháng</p>', 'Xe điện Vnbike A8 giá tốt, chất lượng đảm bảo, thích hợp nội thành.', '8990000', '10000000', 'vi', 13),
(14, 'Xe đạp điện Vnbike V1 18inh', '<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />\r\n- Kích thước bánh: 18 inch<br />\r\n- Tốc độ tối đa: 35 km/h<br />\r\n- Quãng đường đi được: 60 km/lần sạc<br />\r\n- Công suất động cơ: 250 W<br />\r\n- Điện áp ắc quy: 48V<br />\r\n- Dung lượng ắc quy: 12Ah<br />\r\n- Trọng lượng xe: 28 kg</p>\r\n<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />\r\n- Bánh 18 inch nhỏ gọn, linh hoạt trong đô thị<br />\r\n- Nhẹ nhàng, dễ điều khiển<br />\r\n- Phù hợp người thấp hơn, học sinh cấp 2 cấp 3<br />\r\n- Có thể xếp gọn, để trong cốp ô tô</p>\r\n<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />\r\n- Bảo hành toàn xe: 12 tháng<br />\r\n- Bảo hành ắc quy: 12 tháng</p>', 'Xe đạp điện Vnbike V1 bánh 18 inch, nhẹ nhàng, dễ điều khiển.', '8490000', '8990000', 'vi', 14),
(15, 'Xe đạp điện Vnbike Hotgirl G1', '<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />\r\n- Tốc độ tối đa: 40 km/h<br />\r\n- Quãng đường đi được: 70 km/lần sạc<br />\r\n- Công suất động cơ: 350 W<br />\r\n- Điện áp ắc quy: 48V<br />\r\n- Dung lượng ắc quy: 12Ah<br />\r\n- Thời gian sạc đầy: 5 - 7 giờ</p>\r\n<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />\r\n- Thiết kế dành riêng cho nữ, màu sắc trẻ trung, nữ tính<br />\r\n- Giỏ xe trước, kệ xe sau đa năng<br />\r\n- Yên xe bọc da màu sắc phối hợp với màu xe<br />\r\n- Cụm đèn hình nước mắt thời trang<br />\r\n- Có gương chiếu hậu 2 bên</p>\r\n<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />\r\n- Bảo hành toàn xe: 12 tháng<br />\r\n- Bảo hành ắc quy: 12 tháng<br />\r\n- Bảo hành động cơ: 24 tháng</p>', 'Xe đạp điện Vnbike Hotgirl G1 thiết kế dành riêng cho nữ, màu sắc trẻ trung.', '11990000', '11990000', 'vi', 15),
(16, 'Ô tô điện VinFast VF3 thuê pin', '<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />\r\n- Số chỗ ngồi: 4 người<br />\r\n- Phạm vi hoạt động: 210 km (WLTP)<br />\r\n- Công suất động cơ: 42 kW (57 mã lực)<br />\r\n- Mô-men xoắn: 135 Nm<br />\r\n- Tốc độ tối đa: 140 km/h<br />\r\n- Tăng tốc 0-100 km/h: 11,5 giây<br />\r\n- Dung lượng pin: 19,86 kWh<br />\r\n- Thời gian sạc nhanh DC: 30 phút (10%-70%)<br />\r\n- Thời gian sạc AC 7,4 kW: 4 giờ<br />\r\n- Kích thước (D x R x C): 3.983 x 1.720 x 1.595 mm</p>\r\n<p><strong>TRANG BỊ TIÊU CHUẨN:</strong><br />\r\n- Màn hình giải trí cảm ứng 10 inch<br />\r\n- Camera lùi và cảm biến đỗ xe<br />\r\n- Điều hòa tự động<br />\r\n- Hệ thống kết nối Apple CarPlay / Android Auto<br />\r\n- Túi khí an toàn 6 túi<br />\r\n- Phanh ABS + EBD + BA<br />\r\n- Cảnh báo lệch làn đường</p>\r\n<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />\r\n- Bảo hành xe: 5 năm hoặc 150.000 km<br />\r\n- Bảo hành pin thuê: không giới hạn km trong thời gian thuê<br />\r\n- Hỗ trợ cứu hộ 24/7 toàn quốc</p>', 'Ô tô điện VinFast VF3 chính hãng, 4 chỗ ngồi, phạm vi 210 km, thuê pin tiết kiệm chi phí.', '240000000', '240000000', 'vi', 16),
(17, 'Xe 3 bánh chở hàng Smart M700', '<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />\r\n- Tải trọng tối đa: 500 kg<br />\r\n- Tốc độ tối đa: 30 km/h<br />\r\n- Công suất động cơ: 1.200 W<br />\r\n- Điện áp ắc quy: 60V<br />\r\n- Dung lượng ắc quy: 40Ah<br />\r\n- Quãng đường: 80 - 100 km/lần sạc<br />\r\n- Thời gian sạc: 8 - 10 giờ<br />\r\n- Kích thước thùng hàng: 120 x 80 x 50 cm</p>\r\n<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />\r\n- Khung xe chắc chắn bằng thép cường lực<br />\r\n- Thùng hàng rộng rãi, có mui che mưa nắng tùy chọn<br />\r\n- Hệ thống giảm xóc tốt, phù hợp mọi địa hình<br />\r\n- Dễ vận hành, không cần bằng lái xe máy<br />\r\n- Chi phí vận hành thấp so với xe xăng tương đương</p>\r\n<p><strong>ỨNG DỤNG THỰC TẾ:</strong><br />\r\n- Bán hàng rong, bán thức ăn lưu động<br />\r\n- Vận chuyển hàng hóa trong khu công nghiệp, kho bãi<br />\r\n- Giao hàng nội khu, nội bộ trong khu đô thị</p>\r\n<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />\r\n- Bảo hành khung xe: 24 tháng<br />\r\n- Bảo hành động cơ: 12 tháng<br />\r\n- Bảo hành ắc quy: 12 tháng</p>', 'Xe 3 bánh điện chở hàng Smart M700, tải trọng 500 kg, phù hợp kinh doanh buôn bán.', '25000000', '25000000', 'vi', 17),
(18, 'Ô tô điện Bestune Xiaoma', '<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />\r\n- Số chỗ ngồi: 4 người<br />\r\n- Phạm vi hoạt động: 300 km (CLTC)<br />\r\n- Công suất động cơ: 70 kW<br />\r\n- Mô-men xoắn: 150 Nm<br />\r\n- Tốc độ tối đa: 150 km/h<br />\r\n- Tăng tốc 0-100 km/h: 9,8 giây<br />\r\n- Dung lượng pin: 32,9 kWh<br />\r\n- Sạc nhanh DC (20%-80%): 45 phút</p>\r\n<p><strong>TRANG BỊ TIÊU CHUẨN:</strong><br />\r\n- Màn hình giải trí cảm ứng 12,3 inch<br />\r\n- Điều hòa tự động 2 vùng<br />\r\n- Camera 360 độ toàn cảnh<br />\r\n- Hỗ trợ đỗ xe tự động<br />\r\n- Hệ thống cảnh báo điểm mù<br />\r\n- Ghế lái chỉnh điện 6 hướng</p>\r\n<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />\r\n- Bảo hành xe: 5 năm hoặc 100.000 km<br />\r\n- Bảo hành pin: 8 năm hoặc 120.000 km<br />\r\n- Hỗ trợ cứu hộ 24/7</p>', 'Ô tô điện Bestune Xiaoma 4 chỗ, thiết kế trẻ trung, phạm vi 300 km, phù hợp đô thị.', '199000000', '199000000', 'vi', 18),
(19, 'Xe đạp điện Yadea E3', '<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />\r\n- Tốc độ tối đa: 35 km/h<br />\r\n- Quãng đường đi được: 60 km/lần sạc<br />\r\n- Công suất động cơ: 250 W<br />\r\n- Điện áp ắc quy: 48V<br />\r\n- Dung lượng ắc quy: 12Ah<br />\r\n- Thời gian sạc đầy: 5 - 7 giờ<br />\r\n- Trọng lượng xe: 32 kg</p>\r\n<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />\r\n- Nhập khẩu chính hãng từ Yadea - thương hiệu xe điện số 1 thế giới<br />\r\n- Thiết kế nhỏ gọn, tinh tế, phù hợp thị trường Việt Nam<br />\r\n- Ắc quy GEL chất lượng cao, bảo hành chính hãng<br />\r\n- Dễ bảo dưỡng, linh kiện chính hãng sẵn có toàn quốc</p>\r\n<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />\r\n- Bảo hành toàn xe: 24 tháng (chính hãng Yadea)<br />\r\n- Bảo hành ắc quy: 12 tháng<br />\r\n- Bảo hành động cơ: 24 tháng</p>', 'Xe đạp điện Yadea E3 nhập khẩu chính hãng, nhỏ gọn, tiết kiệm, bảo hành 24 tháng.', '7990000', '8990000', 'vi', 19),
(20, 'Xe máy điện TAILG F73', '<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />\r\n- Tốc độ tối đa: 60 km/h<br />\r\n- Quãng đường đi được: 100 km/lần sạc<br />\r\n- Công suất động cơ: 1.000 W<br />\r\n- Điện áp ắc quy: 72V<br />\r\n- Dung lượng ắc quy: 20Ah<br />\r\n- Thời gian sạc đầy: 8 - 10 giờ<br />\r\n- Trọng lượng xe: 70 kg<br />\r\n- Tải trọng tối đa: 150 kg</p>\r\n<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />\r\n- Kiểu dáng mô tô thể thao cao cấp<br />\r\n- Động cơ 1000W mạnh mẽ, leo dốc xuất sắc<br />\r\n- Khung xe nhôm cao cấp, trọng lượng tối ưu<br />\r\n- Phanh đĩa thủy lực cả 2 bánh<br />\r\n- Giảm xóc ngược thể thao phía trước<br />\r\n- Màn hình LCD full thông tin</p>\r\n<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />\r\n- Bảo hành toàn xe: 12 tháng<br />\r\n- Bảo hành ắc quy: 12 tháng<br />\r\n- Bảo hành động cơ: 24 tháng</p>', 'Xe máy điện TAILG F73 cao cấp, kiểu dáng mô tô thể thao, tốc độ 60 km/h.', '16500000', '18000000', 'vi', 20),
(21, 'Bộ sạc xe điện 60V 12A', '<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />\r\n- Điện áp ngõ vào: 220V AC / 50Hz<br />\r\n- Điện áp ngõ ra: 60V DC<br />\r\n- Dòng sạc: 12A<br />\r\n- Công suất: 720W<br />\r\n- Hiệu suất: &gt;88%<br />\r\n- Nhiệt độ hoạt động: -10°C đến 50°C<br />\r\n- Kích thước: 22 x 12 x 7 cm<br />\r\n- Trọng lượng: 1,2 kg</p>\r\n<p><strong>TÍNH NĂNG AN TOÀN:</strong><br />\r\n- Đèn báo đầy tự động chuyển màu xanh<br />\r\n- Tự ngắt khi ắc quy đầy, không sạc tràn<br />\r\n- Chống chập điện, chống quá nhiệt (OTP)<br />\r\n- Chống ngắn mạch (SCP)<br />\r\n- Chống quá áp ngõ ra (OVP)<br />\r\n- Vỏ nhựa ABS chịu nhiệt cao</p>\r\n<p><strong>TƯƠNG THÍCH:</strong><br />\r\n- Phù hợp ắc quy GEL và AGM 60V<br />\r\n- Dùng được cho xe điện 60V phổ biến trên thị trường</p>\r\n<p><strong>BẢO HÀNH:</strong><br />\r\n- Bảo hành sản phẩm: 6 tháng<br />\r\n- Đổi trả trong 7 ngày nếu lỗi nhà sản xuất</p>', 'Bộ sạc xe điện 60V 12A, sạc nhanh, tương thích nhiều dòng xe điện, an toàn chống cháy nổ.', '350000', '450000', 'vi', 21),
(22, 'Ắc quy xe điện 60V 20Ah Lithium', '<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />\r\n- Điện áp định mức: 60V<br />\r\n- Dung lượng: 20Ah (1200Wh)<br />\r\n- Công nghệ: Lithium Ion (NMC)<br />\r\n- Chu kỳ sạc: 800 - 1.200 lần<br />\r\n- Khối lượng: 4,5 kg<br />\r\n- Kích thước: 32 x 12 x 10 cm<br />\r\n- BMS tích hợp bảo vệ đa tầng<br />\r\n- Nhiệt độ hoạt động: -20°C đến 60°C</p>\r\n<p><strong>ƯU ĐIỂM VƯỢT TRỘI:</strong><br />\r\n- Nhẹ hơn ắc quy chì cùng dung lượng 60%<br />\r\n- Tuổi thọ dài gấp 5 - 8 lần ắc quy GEL thông thường<br />\r\n- Sạc nhanh hơn, chỉ cần 4 - 5 giờ<br />\r\n- Không có hiệu ứng nhớ pin, sạc khi nào cũng được<br />\r\n- BMS tích hợp: chống quá sạc, quá xả, quá nhiệt, ngắn mạch</p>\r\n<p><strong>BẢO HÀNH:</strong><br />\r\n- Bảo hành: 12 tháng<br />\r\n- Hỗ trợ kỹ thuật miễn phí tại cửa hàng</p>', 'Ắc quy Lithium 60V 20Ah cho xe điện, tuổi thọ cao hơn ắc quy chì 5-8 lần, nhẹ hơn 60%.', '2800000', '3200000', 'vi', 22),
(23, 'Trạm sạc xe điện AC 7kW loại nhỏ', '<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />\r\n- Công suất: 7,4 kW<br />\r\n- Điện áp ngõ vào: 220V AC / 1 pha / 50Hz<br />\r\n- Dòng tối đa: 32A<br />\r\n- Chuẩn kết nối: Type 2 (IEC 62196-2)<br />\r\n- Chiều dài cáp: 5 m<br />\r\n- Cấp bảo vệ: IP54 (chống bụi và nước)<br />\r\n- Kích thước: 24 x 15 x 10 cm<br />\r\n- Trọng lượng: 2,5 kg</p>\r\n<p><strong>TÍNH NĂNG THÔNG MINH:</strong><br />\r\n- Màn hình LCD hiển thị thông tin sạc<br />\r\n- Kết nối WiFi, quản lý từ xa qua App điện thoại<br />\r\n- Hẹn giờ sạc, kiểm soát chi phí điện<br />\r\n- Tự động phát hiện xe và bắt đầu sạc<br />\r\n- Bảo vệ chống sét lan truyền</p>\r\n<p><strong>PHÙ HỢP CHO:</strong><br />\r\n- Hộ gia đình có ô tô điện hoặc xe máy điện cao cấp<br />\r\n- Văn phòng, tòa nhà chung cư<br />\r\n- Bãi đỗ xe thương mại quy mô nhỏ</p>\r\n<p><strong>BẢO HÀNH:</strong><br />\r\n- Bảo hành thiết bị: 24 tháng<br />\r\n- Hỗ trợ lắp đặt và kỹ thuật</p>', 'Trạm sạc xe điện AC 7kW dùng cho hộ gia đình và văn phòng, chuẩn Type 2, lắp đặt dễ dàng.', '8500000', '10000000', 'vi', 23),
(24, 'Xe điện trẻ em mini 3 bánh 36V', '<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />\r\n- Độ tuổi phù hợp: 3 - 8 tuổi<br />\r\n- Tốc độ tối đa: 6 km/h (có thể điều chỉnh 3 mức)<br />\r\n- Công suất động cơ: 100 W<br />\r\n- Điện áp ắc quy: 36V<br />\r\n- Thời gian sử dụng: 1 - 2 giờ/lần sạc<br />\r\n- Tải trọng tối đa: 30 kg<br />\r\n- Kích thước: 90 x 50 x 55 cm</p>\r\n<p><strong>TÍNH NĂNG AN TOÀN:</strong><br />\r\n- Điều khiển từ xa cho bố mẹ giám sát<br />\r\n- Dây đai an toàn 3 điểm như xe ô tô<br />\r\n- Bánh xe silicon mềm, không trầy sàn nhà<br />\r\n- Tốc độ giới hạn an toàn, không thể vượt quá 6 km/h<br />\r\n- Nhựa ABS an toàn, không chứa BPA, không kim loại nặng<br />\r\n- Tự động dừng khi phát hiện vật cản</p>\r\n<p><strong>TÍNH NĂNG GIẢI TRÍ:</strong><br />\r\n- Âm nhạc MP3, kết nối USB và thẻ TF<br />\r\n- Đèn LED nhiều màu sắc<br />\r\n- Còi điện<br />\r\n- Màu sắc đa dạng: Đỏ, Hồng, Xanh, Vàng</p>\r\n<p><strong>BẢO HÀNH:</strong><br />\r\n- Bảo hành: 12 tháng<br />\r\n- Đổi trả trong 7 ngày nếu lỗi nhà sản xuất</p>', 'Xe điện mini dành cho trẻ em 3-8 tuổi, an toàn, tốc độ giới hạn 6 km/h, điều khiển từ xa.', '2500000', '3000000', 'vi', 24),
(25, 'Xe máy điện Pega NewTech 2024', '<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />\r\n- Tốc độ tối đa: 55 km/h<br />\r\n- Quãng đường đi được: 120 km/lần sạc<br />\r\n- Công suất động cơ: 800 W<br />\r\n- Điện áp ắc quy: 72V<br />\r\n- Dung lượng ắc quy: 20Ah (Lithium)<br />\r\n- Thời gian sạc đầy: 4 - 6 giờ<br />\r\n- Trọng lượng xe: 65 kg</p>\r\n<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />\r\n- Pega NewTech 2024 thế hệ mới nhất với pin Lithium thay thế ắc quy chì<br />\r\n- Phạm vi 120 km — tăng 50% so với thế hệ trước<br />\r\n- Sạc nhanh chỉ 4 giờ đầy bình<br />\r\n- Kết nối Bluetooth với ứng dụng Pega App trên điện thoại<br />\r\n- Theo dõi vị trí GPS, lịch sử hành trình<br />\r\n- Khóa xe từ xa qua điện thoại</p>\r\n<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />\r\n- Bảo hành toàn xe: 12 tháng<br />\r\n- Bảo hành pin Lithium: 24 tháng<br />\r\n- Bảo hành động cơ: 24 tháng<br />\r\n- Hỗ trợ cập nhật phần mềm miễn phí</p>', 'Xe máy điện Pega NewTech 2024 thế hệ mới, pin Lithium, phạm vi 120 km, sạc nhanh 4 giờ.', '19900000', '21900000', 'vi', 25),
(26, 'Xe điện Kazuki S5 Plus', '<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />\r\n- Tốc độ tối đa: 45 km/h<br />\r\n- Quãng đường đi được: 70 km/lần sạc<br />\r\n- Công suất động cơ: 350 W<br />\r\n- Điện áp ắc quy: 48V<br />\r\n- Dung lượng ắc quy: 12Ah<br />\r\n- Thời gian sạc đầy: 5 - 7 giờ</p>\r\n<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />\r\n- Thiết kế lấy cảm hứng từ Nhật Bản, gọn gàng tinh tế<br />\r\n- Khung nhôm cao cấp, trọng lượng chỉ 35 kg<br />\r\n- Giảm xóc trước dạng ống lồng<br />\r\n- Hệ thống phanh kết hợp CBS an toàn<br />\r\n- Màu sắc đa dạng: Trắng, Xanh, Đen, Bạc</p>\r\n<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />\r\n- Bảo hành toàn xe: 12 tháng<br />\r\n- Bảo hành ắc quy: 12 tháng<br />\r\n- Bảo hành động cơ: 24 tháng</p>', 'Xe điện Kazuki S5 Plus thiết kế Nhật, khung nhôm cao cấp, tốc độ 45 km/h.', '9500000', '10500000', 'vi', 26),
(27, 'Bình ắc quy 48V 12Ah cho xe điện', '<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />\r\n- Điện áp: 48V (4 bình 12V ghép nối tiếp)<br />\r\n- Dung lượng: 12Ah<br />\r\n- Loại: GEL (không tràn acid, không cần bảo dưỡng)<br />\r\n- Kích thước mỗi bình: 15 x 6,5 x 10 cm<br />\r\n- Trọng lượng bộ 4 bình: 16 kg<br />\r\n- Nhiệt độ hoạt động: -15°C đến 50°C</p>\r\n<p><strong>ĐẶC ĐIỂM:</strong><br />\r\n- Công nghệ GEL, không tràn acid ngay cả khi nghiêng hay lật<br />\r\n- Chịu phóng điện sâu tốt hơn ắc quy thường<br />\r\n- Tự xả thấp, bảo quản được lâu<br />\r\n- Phù hợp thay thế cho hầu hết xe đạp điện, xe máy điện 48V phổ biến</p>\r\n<p><strong>TƯƠNG THÍCH:</strong><br />\r\n- Vnbike, Smart, Kazuki, Yadea, Pega và hầu hết xe điện 48V<br />\r\n- Có thể dùng cho xe điện, đèn năng lượng mặt trời, UPS</p>\r\n<p><strong>BẢO HÀNH:</strong><br />\r\n- Bảo hành: 6 tháng<br />\r\n- Hỗ trợ lắp đặt tại cửa hàng</p>', 'Bình ắc quy GEL 48V 12Ah thay thế cho xe đạp điện, xe máy điện. Bảo hành 6 tháng.', '1200000', '1500000', 'vi', 27),
(28, 'Xe máy điện Giant HP3 2024', '<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />\r\n- Tốc độ tối đa: 60 km/h<br />\r\n- Quãng đường đi được: 90 km/lần sạc<br />\r\n- Công suất động cơ: 800 W BLDC<br />\r\n- Điện áp ắc quy: 60V<br />\r\n- Dung lượng ắc quy: 20Ah<br />\r\n- Thời gian sạc đầy: 6 - 8 giờ<br />\r\n- Trọng lượng xe: 68 kg</p>\r\n<p><strong>ĐẶC ĐIỂM NỔI BẬT:</strong><br />\r\n- Phiên bản 2024 nâng cấp toàn diện từ HP2<br />\r\n- Động cơ BLDC thế hệ mới hiệu suất cao hơn 15%<br />\r\n- Phanh đĩa thủy lực cả 2 bánh, hành trình phanh ngắn<br />\r\n- Giảm xóc thủy lực trước sau<br />\r\n- Đồng hồ kỹ thuật số toàn bộ<br />\r\n- Cổng sạc USB trên xe</p>\r\n<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />\r\n- Bảo hành toàn xe: 12 tháng<br />\r\n- Bảo hành ắc quy: 12 tháng<br />\r\n- Bảo hành động cơ: 24 tháng</p>', 'Xe máy điện Giant HP3 phiên bản 2024, động cơ BLDC 800W, phanh đĩa, tốc độ 60 km/h.', '14500000', '15500000', 'vi', 28),
(29, 'Đèn pha LED xe điện siêu sáng 15W', '<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />\r\n- Điện áp: 48V - 72V DC (phổ rộng)<br />\r\n- Công suất: 15 W<br />\r\n- Độ sáng: 1.500 Lumen<br />\r\n- Nhiệt độ màu: 6.000K (ánh sáng trắng ban ngày)<br />\r\n- Chuẩn chống nước: IP67 (nhúng nước 30 phút)<br />\r\n- Tuổi thọ: 30.000 giờ<br />\r\n- Góc chiếu: 60°<br />\r\n- Kích thước: 12 x 8 cm<br />\r\n- Trọng lượng: 180 g</p>\r\n<p><strong>ĐẶC ĐIỂM:</strong><br />\r\n- Chip LED Cree nhập khẩu, độ sáng ổn định suốt tuổi thọ<br />\r\n- Vỏ hợp kim nhôm tản nhiệt tốt<br />\r\n- Chống nước IP67, phù hợp đi mưa<br />\r\n- Tương thích điện áp rộng 48V - 72V, không cần chỉnh áp<br />\r\n- Lắp đặt chuẩn, thay thế trực tiếp đèn nguyên bản</p>\r\n<p><strong>TƯƠNG THÍCH:</strong><br />\r\n- Phù hợp hầu hết xe đạp điện, xe máy điện 48V - 72V</p>\r\n<p><strong>BẢO HÀNH:</strong><br />\r\n- Bảo hành: 6 tháng<br />\r\n- Đổi sản phẩm mới nếu lỗi trong vòng 30 ngày</p>', 'Đèn pha LED xe điện 48V-72V, siêu sáng 1500Lm, tuổi thọ 30.000 giờ, chống nước IP67.', '350000', '450000', 'vi', 29),
(30, 'Xe điện 3 bánh chở khách EV-K300', '<p><strong>THÔNG SỐ KỸ THUẬT:</strong><br />\r\n- Số chỗ ngồi: 4 người (1 lái + 3 khách)<br />\r\n- Tốc độ tối đa: 40 km/h<br />\r\n- Công suất động cơ: 3.000 W<br />\r\n- Điện áp ắc quy: 72V<br />\r\n- Dung lượng ắc quy: 80Ah<br />\r\n- Quãng đường: 80 km/lần sạc<br />\r\n- Thời gian sạc: 8 giờ<br />\r\n- Khả năng leo dốc: 25°<br />\r\n- Tải trọng tối đa: 400 kg (bao gồm lái xe)</p>\r\n<p><strong>ĐẶC ĐIỂM:</strong><br />\r\n- Mái che mưa nắng, khung nhôm nhẹ<br />\r\n- Ghế ngồi đệm bọc simili êm ái<br />\r\n- Hệ thống đèn chiếu sáng đầy đủ trước sau<br />\r\n- Đồng hồ hiển thị tốc độ và mức pin<br />\r\n- Cửa lên xuống mở rộng, tiện lợi cho người cao tuổi</p>\r\n<p><strong>ỨNG DỤNG:</strong><br />\r\n- Resort, khu du lịch, khu nghỉ dưỡng<br />\r\n- Sân golf, công viên, khu đô thị<br />\r\n- Bệnh viện, trường học, khu công nghiệp</p>\r\n<p><strong>CHÍNH SÁCH BẢO HÀNH:</strong><br />\r\n- Bảo hành khung xe: 24 tháng<br />\r\n- Bảo hành động cơ: 12 tháng<br />\r\n- Bảo hành ắc quy: 12 tháng<br />\r\n- Hỗ trợ kỹ thuật lắp đặt tại chỗ</p>', 'Xe điện 3 bánh chở khách EV-K300, chở được 4 người, tốc độ 40 km/h, thích hợp resort, khu nghỉ dưỡng.', '35000000', '38000000', 'vi', 30);

-- --------------------------------------------------------

--
-- Table structure for table `seo_pages`
--

CREATE TABLE `seo_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `seo_pages`
--

INSERT INTO `seo_pages` (`id`, `name`) VALUES
(1, 'home'),
(2, 'checkout'),
(3, 'contacts'),
(4, 'blog');

-- --------------------------------------------------------

--
-- Table structure for table `seo_pages_translations`
--

CREATE TABLE `seo_pages_translations` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `page_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `seo_pages_translations`
--

INSERT INTO `seo_pages_translations` (`id`, `title`, `description`, `abbr`, `page_type`) VALUES
(1, '', '', 'vi', 'home'),
(2, '', '', 'en', 'home'),
(3, '', '', 'vi', 'checkout'),
(4, '', '', 'en', 'checkout'),
(5, '', '', 'vi', 'contacts'),
(6, '', '', 'en', 'contacts'),
(7, '', '', 'vi', 'blog'),
(8, '', '', 'en', 'blog');

-- --------------------------------------------------------

--
-- Table structure for table `shop_categories`
--

CREATE TABLE `shop_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `sub_for` int(11) NOT NULL,
  `position` int(10) UNSIGNED NOT NULL,
  `icon` varchar(120) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `shop_categories`
--

INSERT INTO `shop_categories` (`id`, `sub_for`, `position`, `icon`) VALUES
(1, 0, 1, 'fa fa-bicycle'),
(2, 0, 2, 'fa fa-motorcycle'),
(3, 0, 3, 'fa fa-car'),
(4, 0, 4, 'fa fa-truck'),
(5, 0, 5, 'fa fa-wrench'),
(6, 0, 6, 'fa fa-battery-full'),
(7, 1, 1, 'fa fa-bicycle'),
(8, 1, 2, 'fa fa-child'),
(9, 2, 1, 'fa fa-motorcycle'),
(10, 2, 2, 'fa fa-star'),
(11, 3, 1, 'fa fa-car'),
(12, 3, 2, 'fa fa-car'),
(13, 4, 1, 'fa fa-truck'),
(14, 4, 2, 'fa fa-bus'),
(15, 5, 1, 'fa fa-cog'),
(16, 5, 2, 'fa fa-gear'),
(17, 6, 1, 'fa fa-plug'),
(18, 6, 2, 'fa fa-battery-half'),
(19, 7, 1, NULL),
(20, 7, 2, NULL),
(21, 7, 3, NULL),
(22, 7, 4, NULL),
(23, 7, 5, NULL),
(24, 7, 6, NULL),
(25, 7, 7, NULL),
(26, 7, 8, NULL),
(27, 7, 9, NULL),
(28, 7, 10, NULL),
(29, 8, 1, NULL),
(30, 8, 2, NULL),
(31, 8, 3, NULL),
(32, 8, 4, NULL),
(33, 8, 5, NULL),
(34, 8, 6, NULL),
(35, 8, 7, NULL),
(36, 8, 8, NULL),
(37, 8, 9, NULL),
(38, 8, 10, NULL),
(39, 9, 1, NULL),
(40, 9, 2, NULL),
(41, 9, 3, NULL),
(42, 9, 4, NULL),
(43, 9, 5, NULL),
(44, 9, 6, NULL),
(45, 9, 7, NULL),
(46, 9, 8, NULL),
(47, 9, 9, NULL),
(48, 9, 10, NULL),
(49, 10, 1, NULL),
(50, 10, 2, NULL),
(51, 10, 3, NULL),
(52, 10, 4, NULL),
(53, 10, 5, NULL),
(54, 10, 6, NULL),
(55, 10, 7, NULL),
(56, 10, 8, NULL),
(57, 10, 9, NULL),
(58, 10, 10, NULL),
(59, 11, 1, NULL),
(60, 11, 2, NULL),
(61, 11, 3, NULL),
(62, 11, 4, NULL),
(63, 11, 5, NULL),
(64, 11, 6, NULL),
(65, 11, 7, NULL),
(66, 11, 8, NULL),
(67, 11, 9, NULL),
(68, 11, 10, NULL),
(69, 12, 1, NULL),
(70, 12, 2, NULL),
(71, 12, 3, NULL),
(72, 12, 4, NULL),
(73, 12, 5, NULL),
(74, 12, 6, NULL),
(75, 12, 7, NULL),
(76, 12, 8, NULL),
(77, 12, 9, NULL),
(78, 12, 10, NULL),
(79, 13, 1, NULL),
(80, 13, 2, NULL),
(81, 13, 3, NULL),
(82, 13, 4, NULL),
(83, 13, 5, NULL),
(84, 13, 6, NULL),
(85, 13, 7, NULL),
(86, 13, 8, NULL),
(87, 13, 9, NULL),
(88, 13, 10, NULL),
(89, 14, 1, NULL),
(90, 14, 2, NULL),
(91, 14, 3, NULL),
(92, 14, 4, NULL),
(93, 14, 5, NULL),
(94, 14, 6, NULL),
(95, 14, 7, NULL),
(96, 14, 8, NULL),
(97, 14, 9, NULL),
(98, 14, 10, NULL),
(99, 15, 1, NULL),
(100, 15, 2, NULL),
(101, 15, 3, NULL),
(102, 15, 4, NULL),
(103, 15, 5, NULL),
(104, 15, 6, NULL),
(105, 15, 7, NULL),
(106, 15, 8, NULL),
(107, 15, 9, NULL),
(108, 15, 10, NULL),
(109, 16, 1, NULL),
(110, 16, 2, NULL),
(111, 16, 3, NULL),
(112, 16, 4, NULL),
(113, 16, 5, NULL),
(114, 16, 6, NULL),
(115, 16, 7, NULL),
(116, 16, 8, NULL),
(117, 16, 9, NULL),
(118, 16, 10, NULL),
(119, 17, 1, NULL),
(120, 17, 2, NULL),
(121, 17, 3, NULL),
(122, 17, 4, NULL),
(123, 17, 5, NULL),
(124, 17, 6, NULL),
(125, 17, 7, NULL),
(126, 17, 8, NULL),
(127, 17, 9, NULL),
(128, 17, 10, NULL),
(129, 18, 1, NULL),
(130, 18, 2, NULL),
(131, 18, 3, NULL),
(132, 18, 4, NULL),
(133, 18, 5, NULL),
(134, 18, 6, NULL),
(135, 18, 7, NULL),
(136, 18, 8, NULL),
(137, 18, 9, NULL),
(138, 18, 10, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_categories_translations`
--

CREATE TABLE `shop_categories_translations` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `url` varchar(191) DEFAULT NULL,
  `abbr` varchar(5) NOT NULL,
  `for_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `shop_categories_translations`
--

INSERT INTO `shop_categories_translations` (`id`, `name`, `url`, `abbr`, `for_id`) VALUES
(1, 'Xe Đạp Điện', 'xe-dp-din-1', 'vi', 1),
(2, 'Xe Máy Điện', 'xe-m-ay-din-2', 'vi', 2),
(3, 'Ô Tô Điện', 'o-t-o-din-3', 'vi', 3),
(4, 'Xe 3 Bánh Điện', 'xe-3-b-anh-din-4', 'vi', 4),
(5, 'Phụ Kiện & Linh Kiện', 'ph-kin-linh-kin-5', 'vi', 5),
(6, 'Trạm Sạc & Ắc Quy', 'trm-sc-c-quy-6', 'vi', 6),
(7, 'Xe Đạp Điện Người Lớn', 'xe-dp-din-ngi-ln-7', 'vi', 7),
(8, 'Xe Đạp Điện Trẻ Em', 'xe-dp-din-tr-em-8', 'vi', 8),
(9, 'Xe Máy Điện Phổ Thông', 'xe-m-ay-din-ph-th-ong-9', 'vi', 9),
(10, 'Xe Máy Điện Cao Cấp', 'xe-m-ay-din-cao-cp-10', 'vi', 10),
(11, 'Ô Tô Điện Mini', 'o-t-o-din-mini-11', 'vi', 11),
(12, 'Ô Tô Điện SUV', 'o-t-o-din-suv-12', 'vi', 12),
(13, 'Xe 3 Bánh Chở Hàng', 'xe-3-b-anh-ch-h-ang-13', 'vi', 13),
(14, 'Xe 3 Bánh Chở Khách', 'xe-3-b-anh-ch-kh-ach-14', 'vi', 14),
(15, 'Phụ Kiện Xe Đạp Điện', 'ph-kin-xe-dp-din-15', 'vi', 15),
(16, 'Phụ Kiện Xe Máy Điện', 'ph-kin-xe-m-ay-din-16', 'vi', 16),
(17, 'Bộ Sạc & Trạm Sạc', 'b-sc-trm-sc-17', 'vi', 17),
(18, 'Ắc Quy & Pin Lithium', 'c-quy-pin-lithium-18', 'vi', 18),
(19, 'Xe Đạp Điện Nữ', 'xe-dp-din-n-19', 'vi', 19),
(20, 'Xe Đạp Điện Nam', 'xe-dp-din-nam-20', 'vi', 20),
(21, 'Xe Đạp Điện Thể Thao', 'xe-dp-din-th-thao-21', 'vi', 21),
(22, 'Xe Đạp Điện Gấp', 'xe-dp-din-gp-22', 'vi', 22),
(23, 'Xe Đạp Điện Giant', 'xe-dp-din-giant-23', 'vi', 23),
(24, 'Xe Đạp Điện Yadea', 'xe-dp-din-yadea-24', 'vi', 24),
(25, 'Xe Đạp Điện Vnbike', 'xe-dp-din-vnbike-25', 'vi', 25),
(26, 'Xe Đạp Điện Kazuki', 'xe-dp-din-kazuki-26', 'vi', 26),
(27, 'Xe Đạp Điện Smart', 'xe-dp-din-smart-27', 'vi', 27),
(28, 'Xe Đạp Điện Pega', 'xe-dp-din-pega-28', 'vi', 28),
(29, 'Xe Điện Trẻ Em 3-5 Tuổi', 'xe-din-tr-em-3-5-tui-29', 'vi', 29),
(30, 'Xe Điện Trẻ Em 5-8 Tuổi', 'xe-din-tr-em-5-8-tui-30', 'vi', 30),
(31, 'Xe Điện Trẻ Em 8-12 Tuổi', 'xe-din-tr-em-8-12-tui-31', 'vi', 31),
(32, 'Xe Điện Mini 3 Bánh', 'xe-din-mini-3-b-anh-32', 'vi', 32),
(33, 'Xe Điện Mini 4 Bánh', 'xe-din-mini-4-b-anh-33', 'vi', 33),
(34, 'Xe Đạp Điện Trẻ Em Nữ', 'xe-dp-din-tr-em-n-34', 'vi', 34),
(35, 'Xe Đạp Điện Trẻ Em Nam', 'xe-dp-din-tr-em-nam-35', 'vi', 35),
(36, 'Xe Điện Địa Hình Trẻ Em', 'xe-din-da-h-inh-tr-em-36', 'vi', 36),
(37, 'Xe Cân Bằng Điện Trẻ Em', 'xe-c-an-bng-din-tr-em-37', 'vi', 37),
(38, 'Xe Scooter Trẻ Em Điện', 'xe-scooter-tr-em-din-38', 'vi', 38),
(39, 'Xe Máy Điện Dưới 10 Triệu', 'xe-m-ay-din-di-10-triu-39', 'vi', 39),
(40, 'Xe Máy Điện 10-15 Triệu', 'xe-m-ay-din-10-15-triu-40', 'vi', 40),
(41, 'Xe Máy Điện Vnbike', 'xe-m-ay-din-vnbike-41', 'vi', 41),
(42, 'Xe Máy Điện Smart', 'xe-m-ay-din-smart-42', 'vi', 42),
(43, 'Xe Máy Điện Pega', 'xe-m-ay-din-pega-43', 'vi', 43),
(44, 'Xe Máy Điện Yadea', 'xe-m-ay-din-yadea-44', 'vi', 44),
(45, 'Xe Máy Điện Dành Cho Nữ', 'xe-m-ay-din-d-anh-cho-n-45', 'vi', 45),
(46, 'Xe Máy Điện Dành Cho Nam', 'xe-m-ay-din-d-anh-cho-nam-46', 'vi', 46),
(47, 'Xe Máy Điện Học Sinh', 'xe-m-ay-din-hc-sinh-47', 'vi', 47),
(48, 'Xe Máy Điện Đi Làm', 'xe-m-ay-din-di-l-am-48', 'vi', 48),
(49, 'Xe Máy Điện TAILG', 'xe-m-ay-din-tailg-49', 'vi', 49),
(50, 'Xe Máy Điện Giant', 'xe-m-ay-din-giant-50', 'vi', 50),
(51, 'Xe Máy Điện Vinfast', 'xe-m-ay-din-vinfast-51', 'vi', 51),
(52, 'Xe Máy Điện Trên 15 Triệu', 'xe-m-ay-din-tr-en-15-triu-52', 'vi', 52),
(53, 'Xe Máy Điện Nhập Khẩu', 'xe-m-ay-din-nhp-khu-53', 'vi', 53),
(54, 'Xe Máy Điện Thể Thao', 'xe-m-ay-din-th-thao-54', 'vi', 54),
(55, 'Xe Máy Điện YAKA', 'xe-m-ay-din-yaka-55', 'vi', 55),
(56, 'Xe Máy Điện DYLEXE', 'xe-m-ay-din-dylexe-56', 'vi', 56),
(57, 'Xe Máy Điện Pinky', 'xe-m-ay-din-pinky-57', 'vi', 57),
(58, 'Xe Máy Điện Dior', 'xe-m-ay-din-dior-58', 'vi', 58),
(59, 'Ô Tô Điện 2 Chỗ', 'o-t-o-din-2-ch-59', 'vi', 59),
(60, 'Ô Tô Điện 4 Chỗ Mini', 'o-t-o-din-4-ch-mini-60', 'vi', 60),
(61, 'Ô Tô Điện VinFast', 'o-t-o-din-vinfast-61', 'vi', 61),
(62, 'Ô Tô Điện Wuling', 'o-t-o-din-wuling-62', 'vi', 62),
(63, 'Ô Tô Điện Bestune', 'o-t-o-din-bestune-63', 'vi', 63),
(64, 'Ô Tô Điện BYD Mini', 'o-t-o-din-byd-mini-64', 'vi', 64),
(65, 'Ô Tô Điện Dưới 300 Triệu', 'o-t-o-din-di-300-triu-65', 'vi', 65),
(66, 'Ô Tô Điện 300-500 Triệu', 'o-t-o-din-300-500-triu-66', 'vi', 66),
(67, 'Ô Tô Điện Thuê Pin', 'o-t-o-din-thu-e-pin-67', 'vi', 67),
(68, 'Ô Tô Điện Tự Lái', 'o-t-o-din-t-l-ai-68', 'vi', 68),
(69, 'SUV Điện Trên 500 Triệu', 'suv-din-tr-en-500-triu-69', 'vi', 69),
(70, 'SUV Điện 5 Chỗ', 'suv-din-5-ch-70', 'vi', 70),
(71, 'SUV Điện 7 Chỗ', 'suv-din-7-ch-71', 'vi', 71),
(72, 'Ô Tô Điện Tesla', 'o-t-o-din-tesla-72', 'vi', 72),
(73, 'Ô Tô Điện BYD', 'o-t-o-din-byd-73', 'vi', 73),
(74, 'Ô Tô Điện Mercedes EQ', 'o-t-o-din-mercedes-eq-74', 'vi', 74),
(75, 'Ô Tô Điện BMW i', 'o-t-o-din-bmw-i-75', 'vi', 75),
(76, 'Ô Tô Điện Hyundai IONIQ', 'o-t-o-din-hyundai-ioniq-76', 'vi', 76),
(77, 'Ô Tô Điện Kia EV', 'o-t-o-din-kia-ev-77', 'vi', 77),
(78, 'Ô Tô Điện Audi e-tron', 'o-t-o-din-audi-e-tron-78', 'vi', 78),
(79, 'Xe 3 Bánh Tải 200kg', 'xe-3-b-anh-ti-200kg-79', 'vi', 79),
(80, 'Xe 3 Bánh Tải 500kg', 'xe-3-b-anh-ti-500kg-80', 'vi', 80),
(81, 'Xe 3 Bánh Tải 1 Tấn', 'xe-3-b-anh-ti-1-tn-81', 'vi', 81),
(82, 'Xe 3 Bánh Có Mái Che', 'xe-3-b-anh-c-o-m-ai-che-82', 'vi', 82),
(83, 'Xe 3 Bánh Thùng Đông Lạnh', 'xe-3-b-anh-th-ung-d-ong-lnh-83', 'vi', 83),
(84, 'Xe 3 Bánh Bán Hàng Rong', 'xe-3-b-anh-b-an-h-ang-rong-84', 'vi', 84),
(85, 'Xe 3 Bánh Giao Hàng', 'xe-3-b-anh-giao-h-ang-85', 'vi', 85),
(86, 'Xe 3 Bánh Vận Chuyển Kho', 'xe-3-b-anh-vn-chuyn-kho-86', 'vi', 86),
(87, 'Xe 3 Bánh Nông Nghiệp', 'xe-3-b-anh-n-ong-nghip-87', 'vi', 87),
(88, 'Xe 3 Bánh Smart M700', 'xe-3-b-anh-smart-m700-88', 'vi', 88),
(89, 'Xe 3 Bánh Du Lịch', 'xe-3-b-anh-du-lch-89', 'vi', 89),
(90, 'Xe 3 Bánh Resort', 'xe-3-b-anh-resort-90', 'vi', 90),
(91, 'Xe 3 Bánh Sân Golf', 'xe-3-b-anh-s-an-golf-91', 'vi', 91),
(92, 'Xe 3 Bánh Bệnh Viện', 'xe-3-b-anh-bnh-vin-92', 'vi', 92),
(93, 'Xe 3 Bánh Khu Đô Thị', 'xe-3-b-anh-khu-d-o-th-93', 'vi', 93),
(94, 'Xe 3 Bánh 4 Chỗ Ngồi', 'xe-3-b-anh-4-ch-ngi-94', 'vi', 94),
(95, 'Xe 3 Bánh 6 Chỗ Ngồi', 'xe-3-b-anh-6-ch-ngi-95', 'vi', 95),
(96, 'Xe 3 Bánh Có Điều Hòa', 'xe-3-b-anh-c-o-diu-h-oa-96', 'vi', 96),
(97, 'Xe 3 Bánh Mini Bus', 'xe-3-b-anh-mini-bus-97', 'vi', 97),
(98, 'Xe Điện Chở Học Sinh', 'xe-din-ch-hc-sinh-98', 'vi', 98),
(99, 'Ắc Quy Xe Đạp Điện 48V', 'c-quy-xe-dp-din-48v-99', 'vi', 99),
(100, 'Đèn Pha Xe Đạp Điện', 'd-en-pha-xe-dp-din-100', 'vi', 100),
(101, 'Lốp Xe Đạp Điện', 'lp-xe-dp-din-101', 'vi', 101),
(102, 'Phanh Xe Đạp Điện', 'phanh-xe-dp-din-102', 'vi', 102),
(103, 'Đồng Hồ Xe Đạp Điện', 'dng-h-xe-dp-din-103', 'vi', 103),
(104, 'Khóa Xe Đạp Điện', 'kh-oa-xe-dp-din-104', 'vi', 104),
(105, 'Yên Xe Đạp Điện', 'y-en-xe-dp-din-105', 'vi', 105),
(106, 'Giỏ Xe Đạp Điện', 'gi-xe-dp-din-106', 'vi', 106),
(107, 'Gương Xe Đạp Điện', 'gng-xe-dp-din-107', 'vi', 107),
(108, 'Chân Chống Xe Đạp Điện', 'ch-an-chng-xe-dp-din-108', 'vi', 108),
(109, 'Ắc Quy Xe Máy Điện 60V', 'c-quy-xe-m-ay-din-60v-109', 'vi', 109),
(110, 'Ắc Quy Xe Máy Điện 72V', 'c-quy-xe-m-ay-din-72v-110', 'vi', 110),
(111, 'Đèn Pha LED Xe Máy Điện', 'd-en-pha-led-xe-m-ay-din-111', 'vi', 111),
(112, 'Lốp Xe Máy Điện', 'lp-xe-m-ay-din-112', 'vi', 112),
(113, 'Phanh Đĩa Xe Máy Điện', 'phanh-d-ia-xe-m-ay-din-113', 'vi', 113),
(114, 'Đồng Hồ Kỹ Thuật Số', 'dng-h-k-thut-s-114', 'vi', 114),
(115, 'Phụ Tùng Thân Xe', 'ph-t-ung-th-an-xe-115', 'vi', 115),
(116, 'Bộ Điều Khiển Xe Điện', 'b-diu-khin-xe-din-116', 'vi', 116),
(117, 'Motor Xe Máy Điện', 'motor-xe-m-ay-din-117', 'vi', 117),
(118, 'Bộ Cáp Điện Xe', 'b-c-ap-din-xe-118', 'vi', 118),
(119, 'Bộ Sạc 48V', 'b-sc-48v-119', 'vi', 119),
(120, 'Bộ Sạc 60V', 'b-sc-60v-120', 'vi', 120),
(121, 'Bộ Sạc 72V', 'b-sc-72v-121', 'vi', 121),
(122, 'Trạm Sạc AC Gia Đình', 'trm-sc-ac-gia-d-inh-122', 'vi', 122),
(123, 'Trạm Sạc DC Nhanh', 'trm-sc-dc-nhanh-123', 'vi', 123),
(124, 'Trạm Sạc Công Cộng', 'trm-sc-c-ong-cng-124', 'vi', 124),
(125, 'Sạc Không Dây', 'sc-kh-ong-d-ay-125', 'vi', 125),
(126, 'Bộ Chuyển Đổi Sạc', 'b-chuyn-di-sc-126', 'vi', 126),
(127, 'Phần Mềm Quản Lý Sạc', 'phn-mm-qun-l-y-sc-127', 'vi', 127),
(128, 'Trụ Sạc Di Động', 'tr-sc-di-dng-128', 'vi', 128),
(129, 'Ắc Quy GEL 48V', 'c-quy-gel-48v-129', 'vi', 129),
(130, 'Ắc Quy GEL 60V', 'c-quy-gel-60v-130', 'vi', 130),
(131, 'Ắc Quy GEL 72V', 'c-quy-gel-72v-131', 'vi', 131),
(132, 'Pin Lithium 48V', 'pin-lithium-48v-132', 'vi', 132),
(133, 'Pin Lithium 60V', 'pin-lithium-60v-133', 'vi', 133),
(134, 'Pin Lithium 72V', 'pin-lithium-72v-134', 'vi', 134),
(135, 'BMS Bảo Vệ Pin', 'bms-bo-v-pin-135', 'vi', 135),
(136, 'Hộp Pin Tích Hợp', 'hp-pin-t-ich-hp-136', 'vi', 136),
(137, 'Pin Năng Lượng Mặt Trời', 'pin-nang-lng-mt-tri-137', 'vi', 137),
(138, 'Bộ Lưu Điện Dự Phòng', 'b-lu-din-d-ph-ong-138', 'vi', 138);

-- --------------------------------------------------------

--
-- Table structure for table `showrooms`
--

CREATE TABLE `showrooms` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` varchar(500) NOT NULL,
  `google_map_location` varchar(1000) DEFAULT NULL,
  `contact_phone` varchar(120) DEFAULT NULL,
  `email` varchar(190) DEFAULT NULL,
  `representative_person` varchar(190) DEFAULT NULL,
  `main_image` varchar(300) DEFAULT NULL,
  `additional_information` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `position` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `link` varchar(500) DEFAULT NULL,
  `image` varchar(300) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `active_from` date DEFAULT NULL,
  `active_to` date DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribed`
--

CREATE TABLE `subscribed` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `browser` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `subscribed`
--

INSERT INTO `subscribed` (`id`, `email`, `browser`, `ip`, `time`) VALUES
(4, 'qQfp_generic_41a31d7d_lovegreenplant.com@data-backup-store.com', 'curl/7.54.0', '128.70.195.90', '1676288176'),
(5, 'QJTU_generic_41a31d7d_lovegreenplant.com@data-backup-store.com', 'curl/7.54.0', '24.188.4.21', '1680372418');

-- --------------------------------------------------------

--
-- Table structure for table `textual_pages_tanslations`
--

CREATE TABLE `textual_pages_tanslations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `for_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(100) NOT NULL,
  `notify` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'notifications by email',
  `last_login` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `notify`, `last_login`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'your@email.com', 0, 1777604060);

-- --------------------------------------------------------

--
-- Table structure for table `users_public`
--

CREATE TABLE `users_public` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `value_store`
--

CREATE TABLE `value_store` (
  `id` int(10) UNSIGNED NOT NULL,
  `thekey` varchar(50) NOT NULL,
  `value` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `value_store`
--

INSERT INTO `value_store` (`id`, `thekey`, `value`) VALUES
(1, 'sitelogo', 'NewLogo.jpg'),
(2, 'navitext', 'aaa'),
(3, 'footercopyright', 'Powered by AiKode © All right reserved. '),
(4, 'contactspage', '<p style=\"text-align: justify;\"><strong><em>&nbsp; &nbsp;Chúng tôi rất lấy làm cảm kích trước sự quan tâm của các quý khách hàng đối với sản phẩm của chúng tôi thông qua website này. Nếu có bất cứ thắc mắc nào cần giải đáp, vui lòng liên hệ với chúng tôi theo địa chỉ theo form có sẵn bên cạnh và sđt hotline 0966440990. Cảm ơn và chúc quý khách một ngày tràn đầy năng lượng.</em></strong></p>\r\n'),
(5, 'footerContactAddr', 'Địa chỉ : 124 Quang Trung, Phường Gò Vấp, TP Hồ Chí Minh '),
(6, 'footerContactEmail', 'thegioixechaydien.com.vn@gmail.com'),
(7, 'footerContactPhone', '0966440990'),
(8, 'googleMaps', '10.832744, 106.666672'),
(9, 'footerAboutUs', '<p><span style=\"color:#FF0000;\">@2015-2024 Bản quyền thuộc về thegioixechaydien.com.vn CÔNG TY CỔ PHẦN THẾ GIỚI XE CHẠY ĐIỆN Địa chỉ : 124 Quang Trung, Phường Gò Vấp, TP Hồ Chí Minh GPĐKKD Số 0313440464 do Sở KH &amp; ĐT TP Hồ Chí Minh cấp ngày 14/09/2015 sửa đổi 01 tháng 01 năm 2024 Số điện thoại liện hệ: 1800 6726 - 093 890 6886 Email: thegioixechaydien@gmail.com</span></p>\r\n'),
(10, 'footerSocialFacebook', 'https://www.facebook.com/tamnonggarden'),
(11, 'footerSocialTwitter', ''),
(12, 'footerSocialGooglePlus', ''),
(13, 'footerSocialPinterest', ''),
(14, 'footerSocialYoutube', 'https://www.youtube.com/thegioixechaydien'),
(16, 'contactsEmailTo', 'chinhvowili@gmail.com'),
(17, 'shippingOrder', '1'),
(18, 'addJs', '.\r\n'),
(19, 'publicQuantity', '0'),
(20, 'paypal_email', 'test@test.com'),
(21, 'paypal_sandbox', '0'),
(22, 'publicDateAdded', '0'),
(23, 'googleApi', ''),
(24, 'template', 'clothesshop'),
(25, 'cashondelivery_visibility', '1'),
(26, 'showBrands', '0'),
(27, 'showInSlider', '0'),
(28, 'codeDiscounts', '0'),
(29, 'virtualProducts', '1'),
(30, 'multiVendor', '0'),
(31, 'outOfStock', '0'),
(32, 'hideBuyButtonsOfOutOfStock', '0'),
(33, 'moreInfoBtn', ''),
(34, 'refreshAfterAddToCart', '0'),
(35, 'shippingAmount', '34'),
(36, 'lastBlogsLimit', '6'),
(37, 'newProductsLimit', '6'),
(38, 'footerSocialZalo', 'https://zalo.me/859572689369390173');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `url` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendors_orders`
--

CREATE TABLE `vendors_orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `products` text NOT NULL,
  `date` int(10) UNSIGNED NOT NULL,
  `referrer` varchar(255) NOT NULL,
  `clean_referrer` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `paypal_status` varchar(10) DEFAULT NULL,
  `processed` tinyint(1) NOT NULL DEFAULT 0,
  `viewed` tinyint(1) NOT NULL DEFAULT 0,
  `confirmed` tinyint(1) NOT NULL DEFAULT 0,
  `discount_code` varchar(20) NOT NULL,
  `vendor_id` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendors_orders_clients`
--

CREATE TABLE `vendors_orders_clients` (
  `id` int(11) NOT NULL,
  `first_name` varchar(500) NOT NULL,
  `last_name` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `phone` varchar(500) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(500) NOT NULL,
  `post_code` varchar(500) NOT NULL,
  `notes` text NOT NULL,
  `for_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_pages`
--
ALTER TABLE `active_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `blog_translations`
--
ALTER TABLE `blog_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `confirm_links`
--
ALTER TABLE `confirm_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `cookie_law`
--
ALTER TABLE `cookie_law`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cookie_law_translations`
--
ALTER TABLE `cookie_law_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE` (`abbr`,`for_id`) USING BTREE;

--
-- Indexes for table `discount_codes`
--
ALTER TABLE `discount_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_clients`
--
ALTER TABLE `orders_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_translations`
--
ALTER TABLE `products_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seo_pages`
--
ALTER TABLE `seo_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seo_pages_translations`
--
ALTER TABLE `seo_pages_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_categories`
--
ALTER TABLE `shop_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_categories_translations`
--
ALTER TABLE `shop_categories_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_shop_categories_translations_url` (`url`);

--
-- Indexes for table `showrooms`
--
ALTER TABLE `showrooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribed`
--
ALTER TABLE `subscribed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `textual_pages_tanslations`
--
ALTER TABLE `textual_pages_tanslations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_public`
--
ALTER TABLE `users_public`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `value_store`
--
ALTER TABLE `value_store`
  ADD PRIMARY KEY (`id`),
  ADD KEY `key` (`thekey`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique` (`email`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `vendors_orders`
--
ALTER TABLE `vendors_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors_orders_clients`
--
ALTER TABLE `vendors_orders_clients`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `active_pages`
--
ALTER TABLE `active_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `blog_translations`
--
ALTER TABLE `blog_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `confirm_links`
--
ALTER TABLE `confirm_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cookie_law`
--
ALTER TABLE `cookie_law`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cookie_law_translations`
--
ALTER TABLE `cookie_law_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `discount_codes`
--
ALTER TABLE `discount_codes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders_clients`
--
ALTER TABLE `orders_clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `products_translations`
--
ALTER TABLE `products_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `seo_pages`
--
ALTER TABLE `seo_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `seo_pages_translations`
--
ALTER TABLE `seo_pages_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `shop_categories`
--
ALTER TABLE `shop_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `shop_categories_translations`
--
ALTER TABLE `shop_categories_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `showrooms`
--
ALTER TABLE `showrooms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribed`
--
ALTER TABLE `subscribed`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `textual_pages_tanslations`
--
ALTER TABLE `textual_pages_tanslations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users_public`
--
ALTER TABLE `users_public`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `value_store`
--
ALTER TABLE `value_store`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendors_orders`
--
ALTER TABLE `vendors_orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendors_orders_clients`
--
ALTER TABLE `vendors_orders_clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
