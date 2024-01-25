-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 24, 2023 lúc 07:10 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `duan1`
--

DELIMITER $$
--
-- Thủ tục
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `capnhatsoluong` (IN `bienDH` INT)   BEGIN
    -- Kiểm tra xem trạng thái của đơn hàng có phải là 2 không
    DECLARE bienTT INT;

    SELECT trangthai_dh INTO bienTT
    FROM don_hang
    WHERE id_dh = bienDH;

    IF bienTT = 1 THEN
        -- Cập nhật số lượng sản phẩm dựa trên biến thể đơn hàng chi tiết
        UPDATE bien_the
        INNER JOIN don_hang_chi_tiet ON bien_the.id_bt = don_hang_chi_tiet.id_bt
        SET bien_the.soluong_bt = bien_the.soluong_bt - don_hang_chi_tiet.soluong_dhct
        WHERE don_hang_chi_tiet.id_dh = bienDH;
        
  	ELSEIF bienTT = 6 THEN
        -- Cập nhật số lượng sản phẩm dựa trên biến thể đơn hàng chi tiết
        UPDATE bien_the
        INNER JOIN don_hang_chi_tiet ON bien_the.id_bt = don_hang_chi_tiet.id_bt
        SET bien_the.soluong_bt = bien_the.soluong_bt + don_hang_chi_tiet.soluong_dhct
        WHERE don_hang_chi_tiet.id_dh = bienDH;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `capnhattrangthai2` ()   BEGIN
    UPDATE san_pham
    SET trangthai2_sp = 
        CASE 
            WHEN COALESCE((SELECT SUM(soluong_bt) FROM bien_the WHERE bien_the.id_sp = san_pham.id_sp), 0) = 0 THEN 2 
            ELSE 1 
        END;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `capnhattrangthai3` (IN `bienDH` INT)   BEGIN
    DECLARE bienTT INT;

    -- Lấy trạng thái của đơn hàng
    SELECT trangthai_dh INTO bienTT
    FROM don_hang
    WHERE id_dh = bienDH;

    IF bienTT = 1 THEN
        -- Cập nhật trạng thái của sản phẩm thành 1
        UPDATE san_pham
        SET trangthai3_sp = 1
        WHERE id_sp IN (
            SELECT bien_the.id_sp
            FROM bien_the
            INNER JOIN don_hang_chi_tiet ON bien_the.id_bt = don_hang_chi_tiet.id_bt
            WHERE don_hang_chi_tiet.id_dh = bienDH
        );
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `capnhat_trangthai_km` ()   BEGIN
        UPDATE khuyen_mai
       SET trangthai_km = 
            CASE
                 WHEN ngaybd_km <= NOW() AND ngaykt_km >= NOW() THEN 1
               ELSE 2
           END;
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banner`
--

CREATE TABLE `banner` (
  `id_banner` int(11) NOT NULL,
  `anh_banner` varchar(250) NOT NULL,
  `link_banner` varchar(250) NOT NULL,
  `mota_banner` text NOT NULL,
  `trangthai_banner` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `banner`
--

INSERT INTO `banner` (`id_banner`, `anh_banner`, `link_banner`, `mota_banner`, `trangthai_banner`) VALUES
(7, '17012735161700831464Black-Friday-Facebook-Cover-Banner-06.jpg', 'http://localhost/dashboard/da1/index.php?act=spct&id=53', '', 2),
(8, '17012735221700831690maxresdefault.jpg', 'http://localhost/dashboard/da1/index.php?act=spct&id=54', '', 1),
(9, '17012735341700926726banner01_zpsddaf983d.webp', 'http://localhost/dashboard/da1/index.php?act=spct&id=55', '', 1),
(10, '1701273546170083139118899173.jpg', 'http://localhost/dashboard/da1/index.php?act=spct&id=56', '', 1),
(11, '1701273553170083158818899181.jpg', 'http://localhost/dashboard/da1/index.php?act=spct&id=72', '', 1),
(12, '17012735591700926692MNT-DESIGN-BANNER-GIAY-03.jpg', 'ahttp://localhost/dashboard/da1/index.php?act=spct&id=70', '', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bien_the`
--

CREATE TABLE `bien_the` (
  `id_bt` int(11) NOT NULL,
  `id_sp` int(11) NOT NULL,
  `size_bt` int(11) NOT NULL,
  `soluong_bt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `bien_the`
--

INSERT INTO `bien_the` (`id_bt`, `id_sp`, `size_bt`, `soluong_bt`) VALUES
(22, 53, 38, 34),
(23, 53, 40, 12),
(24, 54, 38, 30),
(25, 54, 39, 20),
(26, 54, 40, 27),
(27, 55, 38, 40),
(28, 55, 39, 20),
(29, 55, 40, 30),
(30, 56, 38, 40),
(31, 56, 39, 20),
(32, 56, 40, 30),
(33, 57, 38, 40),
(34, 57, 39, 20),
(35, 57, 40, 30),
(36, 58, 38, 40),
(37, 58, 39, 20),
(38, 58, 40, 30),
(39, 59, 38, 40),
(40, 59, 39, 20),
(41, 59, 40, 30),
(42, 60, 38, 40),
(43, 60, 39, 20),
(44, 60, 40, 30),
(45, 61, 38, 40),
(46, 61, 39, 20),
(47, 61, 40, 30),
(48, 62, 38, 40),
(49, 62, 39, 20),
(50, 62, 40, 30),
(51, 63, 38, 40),
(52, 63, 39, 20),
(53, 63, 40, 30),
(54, 64, 38, 40),
(55, 64, 39, 20),
(56, 64, 40, 30),
(57, 65, 38, 40),
(58, 65, 39, 20),
(59, 65, 40, 30),
(60, 66, 38, 40),
(61, 66, 39, 20),
(62, 66, 40, 30),
(63, 67, 38, 35),
(64, 67, 39, 20),
(65, 67, 40, 30),
(66, 68, 38, 33),
(67, 68, 39, 20),
(68, 68, 40, 30),
(72, 70, 38, 33),
(73, 70, 39, 20),
(74, 70, 40, 25),
(75, 71, 38, 40),
(76, 71, 39, 20),
(77, 71, 40, 30),
(78, 72, 38, 40),
(79, 72, 39, 20),
(80, 72, 40, 30),
(81, 73, 38, 40),
(82, 73, 39, 20),
(83, 73, 40, 30),
(84, 53, 37, 4),
(87, 73, 38, 0),
(88, 73, 39, 2),
(89, 74, 38, 0),
(90, 74, 39, 2),
(91, 75, 38, 0),
(92, 75, 39, 2),
(93, 76, 38, 0),
(94, 76, 39, 2),
(95, 77, 38, 0),
(96, 77, 39, 2),
(97, 78, 38, 0),
(98, 78, 39, 2),
(99, 79, 38, 0),
(100, 79, 39, 2),
(101, 80, 38, 0),
(102, 80, 39, 2),
(103, 81, 38, 0),
(104, 81, 39, 2),
(105, 82, 38, 0),
(106, 82, 39, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `binh_luan`
--

CREATE TABLE `binh_luan` (
  `id_bl` int(11) NOT NULL,
  `id_nd` int(11) NOT NULL,
  `id_sp` int(11) NOT NULL,
  `noidung_bl` text NOT NULL,
  `ngay_bl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chuc_vu`
--

CREATE TABLE `chuc_vu` (
  `id_cv` int(11) NOT NULL,
  `ten_cv` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chuc_vu`
--

INSERT INTO `chuc_vu` (`id_cv`, `ten_cv`) VALUES
(1, 'Admin'),
(2, 'Nhân viên'),
(3, 'Khách hàng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danh_muc`
--

CREATE TABLE `danh_muc` (
  `id_dm` int(11) NOT NULL,
  `ten_dm` varchar(50) NOT NULL,
  `anh_dm` varchar(250) NOT NULL,
  `trangthai_dm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `danh_muc`
--

INSERT INTO `danh_muc` (`id_dm`, `ten_dm`, `anh_dm`, `trangthai_dm`) VALUES
(14, 'Giày Thể Thao', '17012733221700838718giay-the-thao-nu-dsw066800kem-kem-tqkz5-color-kem_acf396cf750148b4ac8b4ef40b0dbcdb.jpg', 1),
(15, 'Giày Sneaker', '17012734331700838450hp7870-02-1663497778174.webp', 1),
(16, 'Giày Adidas', '1701273457170083958669da360071f02f5b5a4f7bce43fef250.png', 1),
(17, 'Giày Vans', '17012734701701096035cac-loai-giay-vans-kinh-dien-2.jpg', 1),
(18, 'Giày Converse', '17012734801700839370giay-mlb-chunky-liner-new-york-yankees-white-green-5-scaled.jpg', 1),
(19, 'Giày MLB', '17012734961700840122367516-01-1.webp', 1);

--
-- Bẫy `danh_muc`
--
DELIMITER $$
CREATE TRIGGER `capnhat_trangthai1_sp` AFTER UPDATE ON `danh_muc` FOR EACH ROW BEGIN
    UPDATE san_pham
    SET trangthai1_sp = NEW.trangthai_dm
    WHERE san_pham.id_dm = NEW.id_dm;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `don_hang`
--

CREATE TABLE `don_hang` (
  `id_dh` int(11) NOT NULL,
  `id_nd` int(11) NOT NULL,
  `nguoinhan_dh` varchar(250) NOT NULL,
  `sdt_dh` varchar(20) NOT NULL,
  `diachi_dh` text NOT NULL,
  `ghichu_dh` text NOT NULL,
  `ngaydat_dh` date NOT NULL,
  `giagoc_dh` float NOT NULL,
  `giakm_dh` float NOT NULL,
  `km_dh` float NOT NULL,
  `trangthai_dh` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `don_hang_chi_tiet`
--

CREATE TABLE `don_hang_chi_tiet` (
  `id_dhct` int(11) NOT NULL,
  `id_dh` int(11) NOT NULL,
  `id_bt` int(11) NOT NULL,
  `soluong_dhct` int(11) NOT NULL,
  `gia_bt` float NOT NULL,
  `gia_dhct` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hinh_anh`
--

CREATE TABLE `hinh_anh` (
  `id_ha` int(11) NOT NULL,
  `id_sp` int(11) NOT NULL,
  `anh_ha` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `hinh_anh`
--

INSERT INTO `hinh_anh` (`id_ha`, `id_sp`, `anh_ha`) VALUES
(154, 53, '17014063771700839310Giày-Converse-Run-Legacy-Black-2.jpg'),
(155, 53, '17014065341700838718giay-the-thao-nu-dsw066800kem-kem-tqkz5-color-kem_acf396cf750148b4ac8b4ef40b0dbcdb.jpg'),
(156, 53, '17014066011700838946giay-adidas-treziod-moss-green-gy0045.jpeg'),
(157, 54, '17014066511700839147z1986721919486_37f392f292e2b4a8775dbda1788fe89c.jpg'),
(158, 54, '17014066591700839310Giày-Converse-Run-Legacy-Black-2.jpg'),
(159, 54, '17014066701700839370giay-mlb-chunky-liner-new-york-yankees-white-green-5-scaled.jpg'),
(160, 55, '17014067291700840376hsw002900hog__2__9ab53305f6e448e69e9c5cb63269bc1f_1024x1024.webp'),
(161, 55, '17014067381700840607giay-sneaker-nu-basic-de-banh-mi-phoi-mau-tim-size-37-63b8d09c75c5b-07012023085332.jpg'),
(162, 55, '17014067471701096035cac-loai-giay-vans-kinh-dien-2.jpg'),
(163, 56, '17014068941700841113Giay-the-thao-Louis-Vuitton-hang-hieu.jpg'),
(164, 56, '17014069021700876855yeezy-350v2-beige-black-1.jpg'),
(165, 56, '17014069111700840859img20190921112927_6a7bdab2a0b144e1ad4c6c82f1d873ea_grande.jpg'),
(166, 57, '17019632751700838450hp7870-02-1663497778174.webp'),
(167, 57, '17019632901700839310Giày-Converse-Run-Legacy-Black-2.jpg'),
(168, 57, '17019632981700876855yeezy-350v2-beige-black-1.jpg'),
(169, 58, '17019633201700839147z1986721919486_37f392f292e2b4a8775dbda1788fe89c.jpg'),
(170, 58, '17019633291701096035cac-loai-giay-vans-kinh-dien-2.jpg'),
(171, 58, '170196333917008410029ccd56dd445dd4e9d5c3708501fc90fc.jpeg'),
(172, 59, '17019634431700876855yeezy-350v2-beige-black-1.jpg'),
(173, 59, '1701963451170083958669da360071f02f5b5a4f7bce43fef250.png'),
(174, 59, '170196345917010967202ccd185033e4a83b494d4414587dbede.jpeg'),
(175, 60, '17019636171700838946giay-adidas-treziod-moss-green-gy0045.jpeg'),
(176, 60, '17019636231701096035cac-loai-giay-vans-kinh-dien-2.jpg'),
(177, 60, '17019636311700877098Giay-Adidas-Classic-Originals-Shell-Head-Flower-Wear-White-Violet-Gx2172-trang-tim-got-hoa-rep-11-gia-re-ha-noi.jpg'),
(178, 61, '17019637321700838946giay-adidas-treziod-moss-green-gy0045.jpeg'),
(179, 61, '17019637401700876567adidas-ultra-boost-6-0-cloud-white.jpg'),
(180, 61, '17019637481700874264than-giay-duoc-gia-cong-tu-chat-lieu-cao-cap_600x600.webp'),
(181, 62, '17020990481700838450hp7870-02-1663497778174.webp'),
(182, 62, '17020990561700838946giay-adidas-treziod-moss-green-gy0045.jpeg'),
(183, 62, '17020990651700840376hsw002900hog__2__9ab53305f6e448e69e9c5cb63269bc1f_1024x1024.webp'),
(184, 63, '17020990781701096882giay-converse-cao-co.webp'),
(185, 63, '17020990871700838946giay-adidas-treziod-moss-green-gy0045.jpeg'),
(186, 63, '17020990991700877013giay-the-thao-adidas-nmd-r1-grey-three-by8762-mau-xam-6459bafb72d02-09052023101611.jpg'),
(187, 64, '17020991111701096079cac-loai-giay-vans-kinh-dien-3.jpg'),
(188, 64, '17020991201700877098Giay-Adidas-Classic-Originals-Shell-Head-Flower-Wear-White-Violet-Gx2172-trang-tim-got-hoa-rep-11-gia-re-ha-noi.jpg'),
(189, 64, '17020991301700876567adidas-ultra-boost-6-0-cloud-white.jpg'),
(190, 65, '17020991421700840122367516-01-1.webp'),
(191, 65, '1702099152170083958669da360071f02f5b5a4f7bce43fef250.png'),
(192, 65, '170209916117008410029ccd56dd445dd4e9d5c3708501fc90fc.jpeg'),
(193, 66, '1702099215170109729350nyd_3asxcdn3n_2_8438f7bd9e8a49b0a85e1b9897b253c5_cd13c39249da4b58a6abf75a5639e698_master.webp'),
(194, 66, '1702099223170109740407bls_3asxccv3n_2_d92d262810dd41238cda102d0654bc9e_d2dab1d8faaa4c679d488adf3a984452_master.jpg'),
(195, 66, '1702099232170109746743bgs_3ashbcw3n_2_7ae2d2ee4929436f9fd608a0e06dd297_236103482dcb49699f768120441b74cf_master.webp'),
(196, 67, '1702099282170083974720230619_g56PqYH9vP.jpeg'),
(197, 67, '17020992941700839981940d803f-91b0-4cc9-8976-477835cf3778.webp'),
(198, 67, '17020993041701097705166800v4.webp'),
(199, 68, '17020994101700839310Giày-Converse-Run-Legacy-Black-2.jpg'),
(200, 68, '17020994181700839147z1986721919486_37f392f292e2b4a8775dbda1788fe89c.jpg'),
(201, 68, '17020994261700840122367516-01-1.webp'),
(205, 70, '17020994581700839370giay-mlb-chunky-liner-new-york-yankees-white-green-5-scaled.jpg'),
(206, 70, '17020994661701096882giay-converse-cao-co.webp'),
(207, 70, '17020994751700876855yeezy-350v2-beige-black-1.jpg'),
(208, 71, '17020994861700876567adidas-ultra-boost-6-0-cloud-white.jpg'),
(209, 71, '17020994951700877098Giay-Adidas-Classic-Originals-Shell-Head-Flower-Wear-White-Violet-Gx2172-trang-tim-got-hoa-rep-11-gia-re-ha-noi.jpg'),
(210, 71, '17020995041701096035cac-loai-giay-vans-kinh-dien-2.jpg'),
(211, 72, '17020995211700841113Giay-the-thao-Louis-Vuitton-hang-hieu.jpg'),
(212, 72, '17020995301701096035cac-loai-giay-vans-kinh-dien-2.jpg'),
(213, 72, '17021004731700841113Giay-the-thao-Louis-Vuitton-hang-hieu.jpg'),
(214, 73, '17021005461701096079cac-loai-giay-vans-kinh-dien-3.jpg'),
(215, 73, '17021005541700876567adidas-ultra-boost-6-0-cloud-white.jpg'),
(216, 73, '170210058517010962135f12395bbfbb67e53eaa8-2048x2048.webp'),
(217, 74, '17021006181700877098Giay-Adidas-Classic-Originals-Shell-Head-Flower-Wear-White-Violet-Gx2172-trang-tim-got-hoa-rep-11-gia-re-ha-noi.jpg'),
(218, 74, '17021006421700874264than-giay-duoc-gia-cong-tu-chat-lieu-cao-cap_600x600.webp'),
(219, 74, '17021006511700876855yeezy-350v2-beige-black-1.jpg'),
(220, 75, '17021006621700877013giay-the-thao-adidas-nmd-r1-grey-three-by8762-mau-xam-6459bafb72d02-09052023101611.jpg'),
(221, 75, '17021009441701096882giay-converse-cao-co.webp'),
(222, 75, '17021009521701095950centennial-85-low-clear-green-core-white-easy-yellow_phpdT7z1x.jpg'),
(223, 76, '17021009641700839370giay-mlb-chunky-liner-new-york-yankees-white-green-5-scaled.jpg'),
(224, 76, '17021009731700840376hsw002900hog__2__9ab53305f6e448e69e9c5cb63269bc1f_1024x1024.webp'),
(225, 76, '17021009811700876855yeezy-350v2-beige-black-1.jpg'),
(226, 77, '17021009931700838946giay-adidas-treziod-moss-green-gy0045.jpeg'),
(227, 77, '170210100117010967202ccd185033e4a83b494d4414587dbede.jpeg'),
(228, 77, '17021010081700840607giay-sneaker-nu-basic-de-banh-mi-phoi-mau-tim-size-37-63b8d09c75c5b-07012023085332.jpg'),
(229, 78, '17021010201700839370giay-mlb-chunky-liner-new-york-yankees-white-green-5-scaled.jpg'),
(230, 78, '17021010281701096035cac-loai-giay-vans-kinh-dien-2.jpg'),
(231, 78, '17021010361700838450hp7870-02-1663497778174.webp'),
(232, 79, '17021010491700840607giay-sneaker-nu-basic-de-banh-mi-phoi-mau-tim-size-37-63b8d09c75c5b-07012023085332.jpg'),
(233, 79, '17021010571700876567adidas-ultra-boost-6-0-cloud-white.jpg'),
(234, 79, '17021010661701096079cac-loai-giay-vans-kinh-dien-3.jpg'),
(235, 80, '17021010801700841113Giay-the-thao-Louis-Vuitton-hang-hieu.jpg'),
(236, 80, '17021010871700876855yeezy-350v2-beige-black-1.jpg'),
(237, 80, '17021010951701097656ee91226a75d42218da21784686f59a24.jpg_960x960q80.jpg_.webp'),
(238, 81, '17021011071700838946giay-adidas-treziod-moss-green-gy0045.jpeg'),
(239, 81, '17021011141700840607giay-sneaker-nu-basic-de-banh-mi-phoi-mau-tim-size-37-63b8d09c75c5b-07012023085332.jpg'),
(240, 81, '17021011211700877098Giay-Adidas-Classic-Originals-Shell-Head-Flower-Wear-White-Violet-Gx2172-trang-tim-got-hoa-rep-11-gia-re-ha-noi.jpg'),
(241, 82, '17021011321700876855yeezy-350v2-beige-black-1.jpg'),
(242, 82, '17021011401700839147z1986721919486_37f392f292e2b4a8775dbda1788fe89c.jpg'),
(243, 82, '17021011491701096079cac-loai-giay-vans-kinh-dien-3.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyen_mai`
--

CREATE TABLE `khuyen_mai` (
  `id_km` int(11) NOT NULL,
  `ma_km` varchar(250) NOT NULL,
  `phantram_km` int(11) NOT NULL,
  `ngaybd_km` date NOT NULL,
  `ngaykt_km` date NOT NULL,
  `trangthai_km` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `khuyen_mai`
--

INSERT INTO `khuyen_mai` (`id_km`, `ma_km`, `phantram_km`, `ngaybd_km`, `ngaykt_km`, `trangthai_km`) VALUES
(8, 'SALEKHAITRUONG', 30, '2023-12-11', '2023-12-13', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lien_he`
--

CREATE TABLE `lien_he` (
  `id_lh` int(11) NOT NULL,
  `email_lh` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoi_dung`
--

CREATE TABLE `nguoi_dung` (
  `id_nd` int(11) NOT NULL,
  `ten_nd` varchar(50) NOT NULL,
  `anh_nd` varchar(250) NOT NULL,
  `sdt_nd` varchar(50) NOT NULL,
  `ngaysinh_nd` date NOT NULL,
  `diachi_nd` text NOT NULL,
  `email_nd` varchar(250) NOT NULL,
  `mk_nd` varchar(50) NOT NULL,
  `id_cv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nguoi_dung`
--

INSERT INTO `nguoi_dung` (`id_nd`, `ten_nd`, `anh_nd`, `sdt_nd`, `ngaysinh_nd`, `diachi_nd`, `email_nd`, `mk_nd`, `id_cv`) VALUES
(1, 'ADMIN', '1701273684tải xuống.png', '0962201514', '1995-11-16', 'QUOC OAI - HA NOI', 'admin@gmail.com', '12345678', 1),
(3, 'nhanvien', '1701273737images.png', '123456789', '2000-02-02', 'asdasdaaaaaa', 'nhanvien@gmail.com', '12345678', 2),
(5, 'khachhang', '1701273825lovepik-customer-service-personnel-icons-png-image_400960942_wh1200.png', '12346786456', '2023-09-16', 'aaaa', 'khachhang@gmail.com', '12345678', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `san_pham`
--

CREATE TABLE `san_pham` (
  `id_sp` int(11) NOT NULL,
  `id_dm` int(11) NOT NULL,
  `ten_sp` longtext NOT NULL,
  `mota_sp` longtext NOT NULL,
  `ngaynhap_sp` date NOT NULL,
  `anh_sp` varchar(250) NOT NULL,
  `gia_sp` float NOT NULL,
  `luotxem_sp` int(11) NOT NULL DEFAULT 0,
  `trangthai1_sp` int(11) NOT NULL,
  `trangthai2_sp` int(11) NOT NULL,
  `trangthai3_sp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `san_pham`
--

INSERT INTO `san_pham` (`id_sp`, `id_dm`, `ten_sp`, `mota_sp`, `ngaynhap_sp`, `anh_sp`, `gia_sp`, `luotxem_sp`, `trangthai1_sp`, `trangthai2_sp`, `trangthai3_sp`) VALUES
(53, 14, 'Giày Thể Thao GEMI', 'Giày Thể Thao Nam GEMI - Giày Sneaker Giày Thể Thao Chạy Bộ, Thể Dục, Đi Chơi - G5296', '2023-11-24', '170083958669da360071f02f5b5a4f7bce43fef250.png', 490000, 178, 1, 1, 1),
(54, 14, 'Giày Thể Thao H136', 'Mã sản phẩm: H136\n\nChất liệu: PU Cao Cấp\n\nChiều cao: 5 cm\n\nGiày thể thao H136 có chất liệu mềm mịn và thoáng khí. Chất liệu này giúp giày có độ bền cao và đồng thời tạo cảm giác thoải mái cho người mang. Với chất liệu, kiểu dáng, màu sắc đa dạng và tiện ích tối ưu, Giày Thể Thao - H136 là lựa chọn lý tưởng cho những người yêu thích hoạt động thể thao và đang tìm kiếm một đôi giày đẹp mắt và tiện dụng.', '2023-11-24', '170083974720230619_g56PqYH9vP.jpeg', 429000, 76, 1, 1, 1),
(55, 14, 'Nike Air Max 90 Futura', 'Màu sắc hiển thị: Stardust đỏ/Trắng đỉnh núi/Cam lửa trại/Cam chắc chắn\r\nPhong cách: FQ8881-618', '2023-11-24', '1700839981940d803f-91b0-4cc9-8976-477835cf3778.webp', 4290000, 3, 1, 1, 2),
(56, 14, 'Giày Puma Thunder Spectra Trainers OG', 'Giày Puma ThunderspectraTrainers OG được làm từ chất liệu da và vải cao cấp tạo cảm giác thoải mái khi mang. Nổi bật với tông màu đen chủ đạo huyền bí kết hợp với 3 màu đỏ-vàng-xanh dương đầy ấn tượng, độc đáo. Thiết kế logo “Puma” đặc trưng của thương hiệu mang phong cách cổ điển, sang trọng nhưng cũng không kém phần trẻ trung, năng động.', '2023-11-24', '1700840122367516-01-1.webp', 1699000, 4, 1, 1, 2),
(57, 14, 'Giày Thể Thao Thời Trang Cho Nữ', 'Giày thể thao là “người bạn đồng hành” quan trọng của mọi người trong mọi chuyển động hàng ngày, nhất là luyện tập thể dục thể thao rèn luyện sức khỏe. Nếu bạn cần tìm một sản phẩm vừa đẹp mắt, vừa chất lượng thì hãy tham khảo ngay mẫu Giày Thể Thao Nữ Biti’s Hunter HSW002900. Đôi giày chắc chắn sẽ khiến mọi chị em hài lòng ngay từ cái nhìn đầu tiên.', '2023-11-24', '1700840376hsw002900hog__2__9ab53305f6e448e69e9c5cb63269bc1f_1024x1024.webp', 459000, 2, 1, 1, 2),
(58, 15, 'Giày Sneaker Nữ Basic', 'Giày Sneaker Nữ Basic Đế Bánh Mì Phối Màu Tím là mẫu giày thể thao dành cho các cô nàng theo đuổi phong cách thể thao, năng động mà vẫn nữ tính. Với thiết kế đẹp mắt, trẻ trung và khỏe khoắn đôi Giày Sneaker Nữ sẽ là một sự lựa chọn hoàn hảo cho bộ sưu tập giày của các quý cô hiện đại.', '0000-00-00', '1700840607giay-sneaker-nu-basic-de-banh-mi-phoi-mau-tim-size-37-63b8d09c75c5b-07012023085332.jpg', 790000, 2, 1, 1, 2),
(59, 15, 'Giày Sneaker Nam Cao Cấp', 'Giày Sneaker Nam Cao Cấp - PG88803\r\n- Chất liệu : Da mềm kết hợp với các lỗ thoáng khỉ khử mùi - đế cao su đúc nguyên khối, giúp tăng 5cm chiều cao', '2023-11-24', '1700840859img20190921112927_6a7bdab2a0b144e1ad4c6c82f1d873ea_grande.jpg', 550000, 0, 1, 1, 2),
(60, 15, 'Giày Sneaker Nữ Trắng Rufine G80', 'Kiểu dáng thể thao, mạnh mẽ,phù hợp với các bạn trong độ tuổi 12-30\r\n- Đế cao su bền chắc, có độ bám cao.\r\n- Thích hợp khi tham gia các hoạt động thể thao, đạp xe, du lịch, đi chơi theo nhóm, .....\r\n- Dễ dàng kết hợp với hầu hết các phong cách thời trang như: Giày đôi, giày nhóm....', '2023-11-24', '17008410029ccd56dd445dd4e9d5c3708501fc90fc.jpeg', 620000, 0, 1, 1, 2),
(61, 15, 'Giày Sneaker nam Louis Vuitton- bản siêu cấp', 'Chào bạn nhé  , có phải bạn đang muốn tìm mẫu Giày  thể thao thời trang hàng đầu thế giới LOUIS VUITTON  cao cấp  không đụng hàng , nhưng giá cả hợp lý , đủ size , chất liệu da thật  và đặc biệt giúp bạn sành điệu và hợp mốt nhất.', '2023-11-24', '1700841113Giay-the-thao-Louis-Vuitton-hang-hieu.jpg', 2490000, 0, 1, 1, 2),
(62, 15, 'Giày Fila Ray Tracer', 'Fila Ray Tracer hiện đang là một trong những đôi giày sneaker gây sốt thị trường trong thời gian gần đây. Thân giày được gia công từ chất liệu da/vải cao cấp với độ ôm chân vừa phải. Giúp đôi giày cố định và nâng đỡ tốt bàn chân trong quá trình di chuyển.', '2023-11-25', '1700874264than-giay-duoc-gia-cong-tu-chat-lieu-cao-cap_600x600.webp', 1700000, 0, 1, 1, 2),
(63, 16, 'Giày Adidas Ultra Boost Light', 'Nổi tiếng với đệm Boost và thiết kế thoải mái.', '2023-11-25', '1700876567adidas-ultra-boost-6-0-cloud-white.jpg', 5200000, 0, 1, 1, 2),
(64, 16, 'Giày Adidas Yeezy Boost 350 V2', 'Cam kết chỉ bán giày chuẩn chất lượng từ Rep 1:1 - Like Auth - Best Quality từ các xưởng Best Trung Quốc\r\nHàng có sẵn tại Shop. Không qua bên thứ 3 ---> Chất lượng giày qua kiểm định kỹ càng.', '2023-11-25', '1700876855yeezy-350v2-beige-black-1.jpg', 1990000, 2, 1, 1, 2),
(65, 16, 'Giày Thể Thao Adidas NMD R1 Grey Three', 'Có thiết kế đẹp mắt , là sản phẩm mới nhất của thương hiệu nổi tiếng Adidas', '2023-11-25', '1700877013giay-the-thao-adidas-nmd-r1-grey-three-by8762-mau-xam-6459bafb72d02-09052023101611.jpg', 2200000, 0, 1, 1, 2),
(66, 16, 'Giày Adidas Classic Originals Superstar', 'Adidas Superstar hoàn toàn là một biểu tượng cổ điển được yêu thích bởi nhiều người hâm mộ giày thể thao và người tiêu dùng bình thường ở mọi lứa tuổi. Là phiên bản được phát hành song song với Adidas Originals Superstar W Sand Beige, nó được yêu thích vì thiết kế vượt thời gian phù hợp với mọi trang phục. Sự thoải mái và giá cả phải chăng của nó là một ưu điểm vượt trội.', '2023-11-25', '1700877098Giay-Adidas-Classic-Originals-Shell-Head-Flower-Wear-White-Violet-Gx2172-trang-tim-got-hoa-rep-11-gia-re-ha-noi.jpg', 950000, 1, 1, 1, 2),
(67, 16, 'Giày Adidas Centennial 85', 'Cú bắt tuyệt vời! Sản phẩm độc quyền này chỉ có tại adidas và không thể tìm thấy ở bất kỳ nơi nào khác. Sản phẩm này được loại trừ khỏi tất cả các chương trình giảm giá và ưu đãi khuyến mại.', '2023-11-27', '1701095950centennial-85-low-clear-green-core-white-easy-yellow_phpdT7z1x.jpg', 3299000, 18, 1, 1, 1),
(68, 17, 'Vans Classics Authentic', 'Vans Classics Authentic được tích hợp giữa Vans Classic Authentic và Sneaker. Loại giày này được ra mắt năm 1966, được trang bị đế cao su với độ bám tốt cho những môn thể thao mạo hiểm như trượt ván, BMX… Thân giày là vải canvas cao cấp, phong cách cổ điển cho cả nam và nữ.', '2023-11-27', '1701096035cac-loai-giay-vans-kinh-dien-2.jpg', 1290000, 22, 1, 1, 1),
(70, 17, 'Giày Vans Fear Of God Slip On Black', 'Mang vẻ ngoài cổ điển – Vans Fear Of God Slip On Đen thỏa mãn những tín đồ của Vans. Nếu bạn đang tìm kiếm một đôi giày có thể mang lại sự thoải mái ngay cả khi sử dụng trong thời gian dài Vans classic có thể phù hợp với chi phí của bạn.', '2023-11-27', '17010962135f12395bbfbb67e53eaa8-2048x2048.webp', 1520000, 3, 1, 1, 1),
(71, 17, 'Giày Vans Off The Wall', 'Vans Off The Wall đã trở thành biểu tượng của thương hiệu Vans sau 10 năm thành lập. Từ khi có mặt trên thị trường Vans Off The Wall đã trở thành biểu tượng của Vans, được các bạn trẻ vô cùng yêu thích, đặc biệt là các tín đồ skateboard và rock', '2023-11-27', '1701096335giay-vans-co-may-loai-4-png-1650262210-18042022131010.png', 3499000, 1, 1, 1, 1),
(72, 18, 'Giày Converse Run Legacy Black', 'Giày Converse Run Legacy Black là một sản phẩm giày thể thao đang được ưa chuộng của thương hiệu Converse. Với thiết kế đơn giản và màu sắc trang nhã, đây là sản phẩm rất dễ phối đồ và phù hợp với nhiều phong cách thời trang. Trong bài viết này, chúng ta sẽ tìm hiểu về giày Converse Run Legacy Black và những đặc điểm nổi bật của sản phẩm này.', '0000-00-00', '1701097656ee91226a75d42218da21784686f59a24.jpg_960x960q80.jpg_.webp', 1800000, 0, 1, 1, 2),
(73, 18, 'Giày Converse Run Star Hike Twisted', 'Upper canvas và đế Run Star zig-zag. Đế giày Giày Converse Run Star Hike được thiết kế với dạng răng cưa to bản, giúp tăng độ bám một cách hiệu quả vừa tạo được điểm nhấn về phong cách và ấn tượng về thời trang.', '0000-00-00', '1701097705166800v4.webp', 2600000, 0, 1, 1, 2),
(74, 18, 'Giày Converse classic đen cổ thấp', 'Run Star Hike được thiết kế với dạng răng cưa to bản, giúp tăng độ bám một cách hiệu quả vừa tạo được điểm nhấn về phong cách và ấn tượng về thời trang.', '2023-11-27', '17010967202ccd185033e4a83b494d4414587dbede.jpeg', 1400000, 0, 1, 1, 2),
(75, 18, 'Giày Converse classic đỏ', 'Giày Converse classic đỏ  canvas và đế Run Star zig-zag. Đế giày Giày Converse Run Star Hike được thiết kế với dạng răng cưa to bản, giúp tăng độ bám một cách hiệu quả vừa tạo được điểm nhấn về phong cách và ấn tượng về thời trang.', '2023-11-27', '17010967801017118_974280802637097_2366022993711360289_n.jpg', 1540000, 1, 1, 1, 2),
(76, 18, 'Giày Converse  cao cổ', 'Thiết kế xuyên suốt của thương hiệu Converse: Không bao giờ lỗi thời\r\n- Chất liệu: Canvas (vải bạt)\r\n- Lớp lót trong: Textlie\r\n- Chất liệu đế: Đế bằng cao su tổng hợp, xẻ rãnh chống trơn trượt.\r\n- Khoen tròn giúp thoáng khí.\r\n- Biểu tượng logo ở lưỡi và gót chân.', '0000-00-00', '1701096882giay-converse-cao-co.webp', 1420000, 0, 1, 1, 2),
(77, 18, 'Giày Converse  bassic hồng', 'Thiết kế xuyên suốt của thương hiệu Converse: Không bao giờ lỗi thời\r\n- Chất liệu: Canvas (vải bạt)\r\n- Lớp lót trong: Textlie\r\n- Chất liệu đế: Đế bằng cao su tổng hợp, xẻ rãnh chống trơn trượt.\r\n- Khoen tròn giúp thoáng khí.\r\n- Biểu tượng logo ở lưỡi và gót chân.', '2023-11-27', '1701097067giay-converse-cao-co-3.webp', 1200000, 0, 1, 1, 2),
(78, 19, 'MLB - Giày sneakers unisex cổ thấp', 'Đôi giày sneakers Chunky Runner Basic mang trong mình sự kết hợp tuyệt vời giữa phong cách năng động và thời thượng đầy phá cách. Với thiết kế gam màu kem tinh tế trên nền chất liệu da Synthetic đã tạo nên một bề mặt cực kỳ thu hút cùng điểm nhấn là logo nổi bật, đây chắc chắn sẽ là món phụ kiện lí tưởng giúp bạn thể hiện sự đẳng cấp của riêng mình.', '2023-11-27', '170109721907ivs_3ashcrb3n_2_cdd0159830884f5590d97bc2a7778723_ed84d38c392041348646bcbc78af879d_master.webp', 3590000, 1, 1, 1, 2),
(79, 19, 'MLB - Giày sneaker Chunky Liner Mid Denim', 'Với thiết kế phom dáng chunky vừa cổ điển vừa trẻ trung, đôi giày sneakers Chunky Liner Mid Denim chính là người bạn đồng hành hoàn hảo để cùng bạn thể hiện phong cách đầy năng động của mình. Nổi bật với họa tiết monogram kết hợp cùng logo độc quyền của thương hiệu MLB, không chỉ tạo nên một tổng thể thời thượng mà còn đem đến sự sang trọng đầy cá tính mà các MLB-crew đã luôn kiếm tìm bấy lâu.', '2023-11-27', '170109729350nyd_3asxcdn3n_2_8438f7bd9e8a49b0a85e1b9897b253c5_cd13c39249da4b58a6abf75a5639e698_master.webp', 4290000, 0, 1, 1, 2),
(80, 19, 'MLB - Giày sneakers Chunky Liner Mid', 'Sở hữu một đôi giày sneakers Chunky sẽ luôn giúp các MLB-crew tăng thêm phần nổi bật và cuốn hút giữa đám đông. Với thiết kế phom dáng chunky cùng logo nổi bật trên thân giày, không chỉ giúp tôn lên đôi chân của bạn mà còn hứa hẹn sẽ là điểm nhấn đặc biệt cho mọi outfits. Chính vì thế, đôi giày sneakers Chunky Liner Mid chính là sự lựa chọn sáng giá để bạn bổ sung ngay vào bộ sưu tập của mình!', '2023-11-27', '170109735043brd_3asxclp3n_2_60da55faa8f449c8b02ca68bc4b6691f_d2d191632db0460db8ae167753aa2942_master.jpg', 3790000, 0, 1, 1, 2),
(81, 19, 'MLB - Giày sneakers Chunky Classic Varsity', 'Đôi giày sneakers Chunky Classic Varsity chưa bao giờ hạ nhiệt với thiết kế vô cùng trendy và tinh tế, lại cực kỳ dễ dàng phối đồ. Nếu bạn đang tìm kiếm một chiếc item vừa năng động vừa mang đậm tinh thần MLB, thì Chunky Classic Varsity với thiết kế siêu hack dáng, chắc chắn sẽ là item sáng giá để bạn bổ sung vào bộ sưu tập sneakers thời thượng của mình.', '2023-11-27', '170109740407bls_3asxccv3n_2_d92d262810dd41238cda102d0654bc9e_d2dab1d8faaa4c679d488adf3a984452_master.jpg', 3590000, 10, 1, 1, 2),
(82, 19, 'MLB - Giày sneakers  Big Ball Chunky Window', 'Bùng nổ phong cách thời thượng qua từng bước chân năng động với đôi giày sneakers Big Ball Chunky Window. Được hoàn thiện với phom dáng chunky độc đáo đã góp phần làm nên tên tuổi của MLB cùng chi tiết logo nổi bật trên thân giày, không chỉ tạo nên một tổng thể táo bạo và cá tính mà còn hứa hẹn sẽ giúp tôn tên đôi chân thon dài và chiều cao vượt bậc của bạn.', '2023-11-27', '170109746743bgs_3ashbcw3n_2_7ae2d2ee4929436f9fd608a0e06dd297_236103482dcb49699f768120441b74cf_master.webp', 3290000, 0, 1, 1, 2);

--
-- Bẫy `san_pham`
--
DELIMITER $$
CREATE TRIGGER `them_hinh_anh` AFTER INSERT ON `san_pham` FOR EACH ROW BEGIN
        INSERT INTO hinh_anh (id_sp, anh_ha) VALUES (NEW.id_sp, 'anhmacdinh.jpg');
        INSERT INTO hinh_anh (id_sp, anh_ha) VALUES (NEW.id_sp, 'anhmacdinh.jpg');
        INSERT INTO hinh_anh (id_sp, anh_ha) VALUES (NEW.id_sp, 'anhmacdinh.jpg');
     END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shop`
--

CREATE TABLE `shop` (
  `id_shop` int(11) NOT NULL,
  `sdt_shop` varchar(50) NOT NULL,
  `email_shop` varchar(250) NOT NULL,
  `diachi_shop` text NOT NULL,
  `anh_shop` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `shop`
--

INSERT INTO `shop` (`id_shop`, `sdt_shop`, `email_shop`, `diachi_shop`, `anh_shop`) VALUES
(1, '0962201514', 'admin@gmail.com', 'FPT Polytechnic Building, Trinh Van Bo Street, Nam Tu Liem, Hanoi', 'logo_2.png');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id_banner`);

--
-- Chỉ mục cho bảng `bien_the`
--
ALTER TABLE `bien_the`
  ADD PRIMARY KEY (`id_bt`);

--
-- Chỉ mục cho bảng `binh_luan`
--
ALTER TABLE `binh_luan`
  ADD PRIMARY KEY (`id_bl`);

--
-- Chỉ mục cho bảng `chuc_vu`
--
ALTER TABLE `chuc_vu`
  ADD PRIMARY KEY (`id_cv`);

--
-- Chỉ mục cho bảng `danh_muc`
--
ALTER TABLE `danh_muc`
  ADD PRIMARY KEY (`id_dm`);

--
-- Chỉ mục cho bảng `don_hang`
--
ALTER TABLE `don_hang`
  ADD PRIMARY KEY (`id_dh`);

--
-- Chỉ mục cho bảng `don_hang_chi_tiet`
--
ALTER TABLE `don_hang_chi_tiet`
  ADD PRIMARY KEY (`id_dhct`);

--
-- Chỉ mục cho bảng `hinh_anh`
--
ALTER TABLE `hinh_anh`
  ADD PRIMARY KEY (`id_ha`);

--
-- Chỉ mục cho bảng `khuyen_mai`
--
ALTER TABLE `khuyen_mai`
  ADD PRIMARY KEY (`id_km`);

--
-- Chỉ mục cho bảng `lien_he`
--
ALTER TABLE `lien_he`
  ADD PRIMARY KEY (`id_lh`);

--
-- Chỉ mục cho bảng `nguoi_dung`
--
ALTER TABLE `nguoi_dung`
  ADD PRIMARY KEY (`id_nd`);

--
-- Chỉ mục cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  ADD PRIMARY KEY (`id_sp`);

--
-- Chỉ mục cho bảng `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id_shop`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `banner`
--
ALTER TABLE `banner`
  MODIFY `id_banner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `bien_the`
--
ALTER TABLE `bien_the`
  MODIFY `id_bt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT cho bảng `binh_luan`
--
ALTER TABLE `binh_luan`
  MODIFY `id_bl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT cho bảng `chuc_vu`
--
ALTER TABLE `chuc_vu`
  MODIFY `id_cv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `danh_muc`
--
ALTER TABLE `danh_muc`
  MODIFY `id_dm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `don_hang`
--
ALTER TABLE `don_hang`
  MODIFY `id_dh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT cho bảng `don_hang_chi_tiet`
--
ALTER TABLE `don_hang_chi_tiet`
  MODIFY `id_dhct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT cho bảng `hinh_anh`
--
ALTER TABLE `hinh_anh`
  MODIFY `id_ha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT cho bảng `khuyen_mai`
--
ALTER TABLE `khuyen_mai`
  MODIFY `id_km` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `lien_he`
--
ALTER TABLE `lien_he`
  MODIFY `id_lh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `nguoi_dung`
--
ALTER TABLE `nguoi_dung`
  MODIFY `id_nd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  MODIFY `id_sp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT cho bảng `shop`
--
ALTER TABLE `shop`
  MODIFY `id_shop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
