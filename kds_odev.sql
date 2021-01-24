-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 24 Oca 2021, 18:32:16
-- Sunucu sürümü: 5.5.68-MariaDB
-- PHP Sürümü: 7.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `kds_odev`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayarlar`
--

CREATE TABLE `ayarlar` (
  `id` int(11) NOT NULL,
  `site_title` text NOT NULL,
  `site_favicon` varchar(255) NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `ayarlar`
--

INSERT INTO `ayarlar` (`id`, `site_title`, `site_favicon`, `updatedAt`) VALUES
(1, 'Prim KDS', 'favicon.png', '2018-07-28 07:45:48');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `reprezant`
--

CREATE TABLE `reprezant` (
  `id` int(11) NOT NULL,
  `repad` text CHARACTER SET utf8 NOT NULL,
  `repsoyad` text CHARACTER SET utf8 NOT NULL,
  `sube_id` int(11) NOT NULL,
  `primorani` int(11) NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ekleyen` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `reprezant`
--

INSERT INTO `reprezant` (`id`, `repad`, `repsoyad`, `sube_id`, `primorani`, `tarih`, `ekleyen`) VALUES
(13, 'Ahmet', 'Altun', 1, 11, '2021-01-19 19:41:00', 'Mehmet'),
(14, 'Selma', 'Uzun', 1, 15, '2021-01-19 19:41:10', 'Mehmet'),
(15, 'Zeynep', 'Kısa', 7, 19, '2021-01-19 19:41:21', 'Mehmet'),
(16, 'Mehmet', 'Kaya', 7, 14, '2021-01-19 19:41:55', 'Mehmet'),
(17, 'Selçuk', 'Atsız', 5, 14, '2021-01-19 19:42:25', 'Mehmet'),
(18, 'Melis', 'Sarp', 5, 10, '2021-01-19 19:42:31', 'Mehmet'),
(19, 'Kader', 'Tutkun', 13, 16, '2021-01-19 19:42:42', 'Mehmet'),
(20, 'Mert', 'Okur', 13, 12, '2021-01-19 19:43:08', 'Mehmet'),
(21, 'Resul', 'Akkaya', 14, 10, '2021-01-19 19:43:19', 'Mehmet'),
(22, 'Betül', 'Çelik', 14, 11, '2021-01-19 19:43:36', 'Mehmet'),
(23, 'Burak', 'Güçlü', 3, 13, '2021-01-19 19:43:56', 'Mehmet'),
(24, 'Esra', 'Dilsiz', 3, 12, '2021-01-19 19:44:14', 'Mehmet'),
(25, 'Çağrı', 'Karadeniz', 15, 14, '2021-01-19 19:44:34', 'Mehmet'),
(26, 'Nur', 'Sözer', 15, 18, '2021-01-19 19:44:43', 'Mehmet'),
(27, 'Ulaş', 'Yılmaz', 12, 17, '2021-01-19 19:44:59', 'Mehmet'),
(28, 'Nevin', 'Kaplan', 12, 14, '2021-01-19 19:45:11', 'Mehmet'),
(29, 'Rabia', 'Uzak', 17, 15, '2021-01-19 19:45:41', 'Mehmet'),
(30, 'Berkay', 'Çınar', 17, 14, '2021-01-19 19:45:55', 'Mehmet'),
(31, 'Enes', 'Köken', 18, 10, '2021-01-19 19:46:02', 'Mehmet'),
(32, 'Edanur', 'Budak', 18, 19, '2021-01-19 19:46:22', 'Mehmet'),
(33, 'Ali', 'Gökdemir', 19, 12, '2021-01-19 19:47:07', 'Mehmet'),
(34, 'Yıldız', 'Şahin', 19, 13, '2021-01-19 19:47:28', 'Mehmet'),
(35, 'Yaren', 'Gerekli', 11, 15, '2021-01-19 19:47:53', 'Mehmet'),
(36, 'Faruk', 'Satar', 11, 16, '2021-01-19 19:48:03', 'Mehmet'),
(37, 'Kerem', 'Kaygılı', 16, 14, '2021-01-19 19:48:35', 'Mehmet'),
(38, 'Tuğba', 'Şener', 16, 17, '2021-01-19 19:48:45', 'Mehmet'),
(39, 'Şükrü', 'Porsuk', 8, 13, '2021-01-19 19:49:08', 'Mehmet'),
(40, 'Tuğçe', 'Tutmaz', 8, 19, '2021-01-19 19:49:34', 'Mehmet'),
(41, 'Rümeysa', 'Şenel', 9, 13, '2021-01-19 19:49:50', 'Mehmet'),
(42, 'Hasan', 'Basri', 9, 19, '2021-01-19 19:49:57', 'Mehmet'),
(43, 'Basri', 'Uygan', 10, 15, '2021-01-19 19:50:08', 'Mehmet'),
(44, 'Kaya', 'Oktay', 10, 11, '2021-01-19 19:50:43', 'Mehmet');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `satislar`
--

CREATE TABLE `satislar` (
  `id` int(11) NOT NULL,
  `satistutari` int(11) NOT NULL,
  `rep_id` int(11) NOT NULL,
  `urun_id` int(11) NOT NULL,
  `yil` int(11) NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ekleyen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `satislar`
--

INSERT INTO `satislar` (`id`, `satistutari`, `rep_id`, `urun_id`, `yil`, `tarih`, `ekleyen`) VALUES
(13, 440, 13, 5, 2018, '2021-01-19 19:54:21', 'Mehmet'),
(14, 1850, 13, 8, 2018, '2021-01-19 19:54:33', 'Mehmet'),
(15, 960, 14, 11, 2018, '2021-01-19 19:54:49', 'Mehmet'),
(16, 1450, 14, 8, 2018, '2021-01-19 19:55:12', 'Mehmet'),
(17, 730, 15, 3, 2018, '2021-01-19 19:55:28', 'Mehmet'),
(18, 660, 15, 5, 2018, '2021-01-19 19:55:42', 'Mehmet'),
(19, 910, 16, 11, 2018, '2021-01-19 19:55:54', 'Mehmet'),
(20, 2350, 16, 12, 2018, '2021-01-19 19:56:15', 'Mehmet'),
(21, 3100, 17, 5, 2018, '2021-01-19 19:56:46', 'Mehmet'),
(22, 1560, 17, 9, 2018, '2021-01-19 19:56:59', 'Mehmet'),
(23, 820, 18, 1, 2018, '2021-01-19 19:57:13', 'Mehmet'),
(24, 4830, 18, 9, 2018, '2021-01-19 19:57:26', 'Mehmet'),
(25, 2530, 19, 3, 2018, '2021-01-19 19:57:40', 'Mehmet'),
(26, 670, 19, 11, 2018, '2021-01-19 19:57:55', 'Mehmet'),
(27, 3700, 20, 1, 2018, '2021-01-19 19:58:07', 'Mehmet'),
(28, 910, 20, 8, 2018, '2021-01-19 19:58:21', 'Mehmet'),
(29, 3450, 21, 4, 2018, '2021-01-19 19:58:36', 'Mehmet'),
(30, 3840, 21, 5, 2018, '2021-01-19 19:58:52', 'Mehmet'),
(31, 1600, 22, 10, 2018, '2021-01-19 19:59:14', 'Mehmet'),
(32, 4660, 22, 12, 2018, '2021-01-19 19:59:32', 'Mehmet'),
(33, 230, 23, 4, 2018, '2021-01-19 19:59:49', 'Mehmet'),
(34, 380, 23, 3, 2018, '2021-01-19 20:00:02', 'Mehmet'),
(35, 790, 24, 1, 2018, '2021-01-19 20:00:13', 'Mehmet'),
(36, 460, 24, 5, 2018, '2021-01-19 20:00:24', 'Mehmet'),
(37, 720, 25, 9, 2018, '2021-01-19 20:00:37', 'Mehmet'),
(38, 840, 25, 11, 2018, '2021-01-19 20:00:50', 'Mehmet'),
(39, 1920, 26, 4, 2018, '2021-01-19 20:01:05', 'Mehmet'),
(40, 2860, 26, 9, 2018, '2021-01-19 20:01:19', 'Mehmet'),
(41, 410, 27, 3, 2018, '2021-01-19 20:01:33', 'Mehmet'),
(42, 3890, 27, 10, 2018, '2021-01-19 20:01:56', 'Mehmet'),
(43, 4180, 28, 2, 2018, '2021-01-19 20:02:11', 'Mehmet'),
(44, 6430, 28, 9, 2018, '2021-01-19 20:02:28', 'Mehmet'),
(45, 6380, 29, 10, 2018, '2021-01-19 20:02:43', 'Mehmet'),
(46, 7410, 29, 4, 2018, '2021-01-19 20:03:03', 'Mehmet'),
(47, 6730, 30, 1, 2018, '2021-01-19 20:03:25', 'Mehmet'),
(48, 1960, 30, 8, 2018, '2021-01-19 20:03:43', 'Mehmet'),
(49, 4580, 31, 11, 2018, '2021-01-19 20:03:56', 'Mehmet'),
(50, 760, 31, 4, 2018, '2021-01-19 20:04:09', 'Mehmet'),
(51, 5300, 32, 10, 2018, '2021-01-19 20:04:23', 'Mehmet'),
(52, 1950, 32, 4, 2018, '2021-01-19 20:04:45', 'Mehmet'),
(53, 4860, 33, 3, 2018, '2021-01-19 20:05:08', 'Mehmet'),
(54, 5740, 33, 10, 2018, '2021-01-19 20:05:22', 'Mehmet'),
(55, 950, 34, 9, 2018, '2021-01-19 20:05:40', 'Mehmet'),
(56, 890, 34, 5, 2018, '2021-01-19 20:06:06', 'Mehmet'),
(57, 2690, 35, 1, 2018, '2021-01-19 20:06:25', 'Mehmet'),
(58, 6180, 35, 4, 2018, '2021-01-19 20:06:43', 'Mehmet'),
(59, 1540, 36, 10, 2018, '2021-01-19 20:07:02', 'Mehmet'),
(60, 7480, 36, 11, 2018, '2021-01-19 20:07:16', 'Mehmet'),
(61, 1940, 37, 3, 2018, '2021-01-19 20:07:32', 'Mehmet'),
(62, 4940, 37, 5, 2018, '2021-01-19 20:07:44', 'Mehmet'),
(63, 6940, 38, 10, 2018, '2021-01-19 20:07:58', 'Mehmet'),
(64, 4850, 38, 3, 2018, '2021-01-19 20:08:12', 'Mehmet'),
(65, 5860, 39, 9, 2018, '2021-01-19 20:08:27', 'Mehmet'),
(66, 6490, 39, 8, 2018, '2021-01-19 20:08:40', 'Mehmet'),
(67, 9450, 40, 9, 2018, '2021-01-19 20:08:54', 'Mehmet'),
(68, 8420, 40, 1, 2018, '2021-01-19 20:09:08', 'Mehmet'),
(69, 6470, 41, 1, 2018, '2021-01-19 20:09:17', 'Mehmet'),
(70, 880, 41, 8, 2018, '2021-01-19 20:09:33', 'Mehmet'),
(71, 1890, 42, 4, 2018, '2021-01-19 20:09:55', 'Mehmet'),
(72, 8480, 42, 8, 2018, '2021-01-19 20:10:07', 'Mehmet'),
(73, 470, 43, 5, 2018, '2021-01-19 20:10:24', 'Mehmet'),
(74, 9250, 43, 2, 2018, '2021-01-19 20:10:36', 'Mehmet'),
(75, 1640, 44, 3, 2018, '2021-01-19 20:10:47', 'Mehmet'),
(76, 7560, 44, 9, 2018, '2021-01-19 20:10:57', 'Mehmet'),
(77, 8940, 13, 2, 2019, '2021-01-19 20:12:39', 'Mehmet'),
(78, 7940, 13, 11, 2019, '2021-01-19 20:13:01', 'Mehmet'),
(79, 7510, 14, 3, 2019, '2021-01-19 20:13:14', 'Mehmet'),
(80, 4450, 14, 10, 2019, '2021-01-19 20:13:47', 'Mehmet'),
(81, 460, 15, 4, 2019, '2021-01-19 20:15:30', 'Mehmet'),
(82, 4870, 15, 3, 2019, '2021-01-19 20:15:40', 'Mehmet'),
(83, 6450, 16, 11, 2019, '2021-01-19 20:15:59', 'Mehmet'),
(84, 8740, 16, 8, 2019, '2021-01-19 20:16:08', 'Mehmet'),
(85, 9740, 17, 10, 2019, '2021-01-19 20:16:25', 'Mehmet'),
(86, 5520, 17, 4, 2019, '2021-01-19 20:16:38', 'Mehmet'),
(87, 7140, 18, 8, 2019, '2021-01-19 20:16:51', 'Mehmet'),
(88, 1740, 18, 9, 2019, '2021-01-19 20:17:01', 'Mehmet'),
(89, 7750, 19, 1, 2019, '2021-01-19 20:17:16', 'Mehmet'),
(90, 4100, 19, 11, 2019, '2021-01-19 20:17:30', 'Mehmet'),
(91, 7710, 20, 3, 2019, '2021-01-19 20:17:42', 'Mehmet'),
(92, 5280, 20, 8, 2019, '2021-01-19 20:17:50', 'Mehmet'),
(93, 1140, 21, 10, 2019, '2021-01-19 20:18:04', 'Mehmet'),
(94, 1460, 21, 4, 2019, '2021-01-19 20:18:18', 'Mehmet'),
(95, 4650, 22, 9, 2019, '2021-01-19 20:18:30', 'Mehmet'),
(96, 4420, 22, 10, 2019, '2021-01-19 20:18:43', 'Mehmet'),
(97, 4580, 23, 12, 2019, '2021-01-19 20:18:55', 'Mehmet'),
(98, 5470, 23, 4, 2019, '2021-01-19 20:19:04', 'Mehmet'),
(99, 6270, 24, 10, 2019, '2021-01-19 20:19:15', 'Mehmet'),
(100, 7400, 24, 8, 2019, '2021-01-19 20:19:28', 'Mehmet'),
(101, 740, 25, 8, 2019, '2021-01-19 20:19:42', 'Mehmet'),
(102, 8140, 25, 2, 2019, '2021-01-19 20:19:55', 'Mehmet'),
(103, 7820, 26, 4, 2019, '2021-01-19 20:20:04', 'Mehmet'),
(104, 7420, 26, 9, 2019, '2021-01-19 20:20:18', 'Mehmet'),
(105, 4630, 27, 1, 2019, '2021-01-19 20:20:33', 'Mehmet'),
(106, 4550, 27, 10, 2019, '2021-01-19 20:20:43', 'Mehmet'),
(107, 280, 28, 3, 2019, '2021-01-19 20:20:55', 'Mehmet'),
(108, 4350, 28, 11, 2019, '2021-01-19 20:21:07', 'Mehmet'),
(109, 4510, 29, 9, 2019, '2021-01-19 20:21:20', 'Mehmet'),
(110, 4160, 29, 2, 2019, '2021-01-19 20:21:37', 'Mehmet'),
(111, 8410, 30, 8, 2019, '2021-01-19 20:21:47', 'Mehmet'),
(112, 4780, 30, 3, 2019, '2021-01-19 20:22:00', 'Mehmet'),
(113, 7430, 31, 5, 2019, '2021-01-19 20:22:29', 'Mehmet'),
(114, 860, 31, 10, 2019, '2021-01-19 20:22:41', 'Mehmet'),
(115, 5460, 32, 4, 2019, '2021-01-19 20:22:58', 'Mehmet'),
(116, 4630, 32, 3, 2019, '2021-01-19 20:23:11', 'Mehmet'),
(117, 640, 33, 11, 2019, '2021-01-19 20:23:32', 'Mehmet'),
(118, 9410, 33, 1, 2019, '2021-01-19 20:23:51', 'Mehmet'),
(119, 1660, 34, 5, 2019, '2021-01-19 20:24:03', 'Mehmet'),
(120, 9210, 34, 10, 2019, '2021-01-19 20:24:24', 'Mehmet'),
(121, 730, 35, 2, 2019, '2021-01-19 20:24:36', 'Mehmet'),
(122, 3720, 35, 4, 2019, '2021-01-19 20:24:48', 'Mehmet'),
(123, 8950, 36, 8, 2019, '2021-01-19 20:25:01', 'Mehmet'),
(124, 410, 36, 11, 2019, '2021-01-19 20:25:14', 'Mehmet'),
(125, 4230, 37, 3, 2019, '2021-01-19 20:25:33', 'Mehmet'),
(126, 2740, 37, 5, 2019, '2021-01-19 20:25:44', 'Mehmet'),
(127, 1440, 38, 9, 2019, '2021-01-19 20:25:57', 'Mehmet'),
(128, 6410, 38, 4, 2019, '2021-01-19 20:26:15', 'Mehmet'),
(129, 370, 39, 1, 2019, '2021-01-19 20:26:31', 'Mehmet'),
(130, 650, 39, 4, 2019, '2021-01-19 20:26:50', 'Mehmet'),
(131, 8470, 40, 10, 2019, '2021-01-19 20:27:01', 'Mehmet'),
(132, 720, 40, 5, 2019, '2021-01-19 20:27:24', 'Mehmet'),
(133, 1430, 41, 12, 2019, '2021-01-19 20:27:43', 'Mehmet'),
(134, 7530, 41, 8, 2019, '2021-01-19 20:27:56', 'Mehmet'),
(135, 640, 42, 4, 2019, '2021-01-19 20:28:07', 'Mehmet'),
(136, 5830, 42, 9, 2019, '2021-01-19 20:28:24', 'Mehmet'),
(137, 3670, 43, 8, 2019, '2021-01-19 20:28:36', 'Mehmet'),
(138, 590, 43, 4, 2019, '2021-01-19 20:28:53', 'Mehmet'),
(139, 310, 44, 12, 2019, '2021-01-19 20:29:14', 'Mehmet'),
(140, 4930, 44, 1, 2019, '2021-01-19 20:29:31', 'Mehmet'),
(141, 8530, 13, 2, 2020, '2021-01-19 20:30:49', 'Mehmet'),
(142, 2820, 13, 5, 2020, '2021-01-19 20:31:06', 'Mehmet'),
(143, 480, 14, 9, 2020, '2021-01-19 20:31:27', 'Mehmet'),
(144, 1750, 14, 11, 2020, '2021-01-19 20:31:39', 'Mehmet'),
(145, 3720, 15, 1, 2020, '2021-01-19 20:31:50', 'Mehmet'),
(146, 9540, 15, 10, 2020, '2021-01-19 20:32:07', 'Mehmet'),
(147, 2710, 16, 1, 2020, '2021-01-19 20:32:18', 'Mehmet'),
(148, 5830, 16, 5, 2020, '2021-01-19 20:32:30', 'Mehmet'),
(149, 4720, 17, 4, 2020, '2021-01-19 20:33:12', 'Mehmet'),
(150, 1210, 17, 9, 2020, '2021-01-19 20:33:25', 'Mehmet'),
(151, 640, 18, 10, 2020, '2021-01-19 20:34:05', 'Mehmet'),
(152, 2140, 18, 8, 2020, '2021-01-19 20:34:16', 'Mehmet'),
(153, 7310, 19, 1, 2020, '2021-01-19 20:34:27', 'Mehmet'),
(154, 6740, 19, 11, 2020, '2021-01-19 20:34:37', 'Mehmet'),
(155, 3640, 20, 2, 2020, '2021-01-19 20:34:54', 'Mehmet'),
(156, 480, 20, 1, 2020, '2021-01-19 20:35:10', 'Mehmet'),
(157, 9430, 21, 5, 2020, '2021-01-19 20:35:24', 'Mehmet'),
(158, 3260, 21, 9, 2020, '2021-01-19 20:35:39', 'Mehmet'),
(159, 2510, 22, 3, 2020, '2021-01-19 20:35:51', 'Mehmet'),
(160, 700, 22, 11, 2020, '2021-01-19 20:36:07', 'Mehmet'),
(161, 2470, 23, 8, 2020, '2021-01-19 20:36:20', 'Mehmet'),
(162, 720, 23, 2, 2020, '2021-01-19 20:36:44', 'Mehmet'),
(163, 580, 24, 11, 2020, '2021-01-19 20:36:54', 'Mehmet'),
(164, 6470, 24, 9, 2020, '2021-01-19 20:37:10', 'Mehmet'),
(165, 9460, 25, 12, 2019, '2021-01-19 20:37:37', 'Mehmet'),
(166, 780, 25, 3, 2020, '2021-01-19 20:37:50', 'Mehmet'),
(167, 5720, 26, 10, 2020, '2021-01-19 20:38:04', 'Mehmet'),
(168, 1720, 26, 5, 2020, '2021-01-19 20:38:15', 'Mehmet'),
(169, 4710, 27, 9, 2020, '2021-01-19 20:38:38', 'Mehmet'),
(170, 860, 27, 3, 2020, '2021-01-19 20:38:53', 'Mehmet'),
(171, 4910, 28, 8, 2020, '2021-01-19 20:39:09', 'Mehmet'),
(172, 4070, 28, 2, 2020, '2021-01-19 20:39:26', 'Mehmet'),
(173, 920, 29, 9, 2019, '2021-01-19 20:41:18', 'Mehmet'),
(174, 7460, 29, 11, 2020, '2021-01-19 20:41:57', 'Mehmet'),
(175, 9810, 29, 4, 2020, '2021-01-19 20:42:28', 'Mehmet'),
(176, 760, 30, 2, 2020, '2021-01-19 20:42:46', 'Mehmet'),
(177, 6320, 30, 11, 2020, '2021-01-19 20:43:04', 'Mehmet'),
(178, 5750, 31, 8, 2020, '2021-01-19 20:43:18', 'Mehmet'),
(179, 630, 31, 2, 2020, '2021-01-19 20:43:35', 'Mehmet'),
(180, 7980, 32, 4, 2020, '2021-01-19 20:43:49', 'Mehmet'),
(181, 450, 32, 8, 2020, '2021-01-19 20:44:13', 'Mehmet'),
(182, 7150, 33, 4, 2020, '2021-01-19 20:44:23', 'Mehmet'),
(183, 2400, 33, 9, 2020, '2021-01-19 20:44:42', 'Mehmet'),
(184, 5840, 34, 10, 2020, '2021-01-19 20:45:00', 'Mehmet'),
(185, 8520, 34, 3, 2020, '2021-01-19 20:45:13', 'Mehmet'),
(186, 4270, 35, 12, 2020, '2021-01-19 20:45:28', 'Mehmet'),
(187, 4970, 35, 4, 2020, '2021-01-19 20:45:41', 'Mehmet'),
(188, 490, 36, 5, 2020, '2021-01-19 20:46:03', 'Mehmet'),
(189, 9460, 36, 9, 2020, '2021-01-19 20:46:19', 'Mehmet'),
(190, 6100, 37, 2, 2020, '2021-01-19 20:46:41', 'Mehmet'),
(191, 830, 37, 11, 2020, '2021-01-19 20:46:57', 'Mehmet'),
(192, 6720, 38, 10, 2020, '2021-01-19 20:47:11', 'Mehmet'),
(193, 1470, 38, 8, 2020, '2021-01-19 20:47:23', 'Mehmet'),
(194, 7180, 39, 4, 2020, '2021-01-19 20:47:42', 'Mehmet'),
(195, 400, 39, 2, 2020, '2021-01-19 20:48:00', 'Mehmet'),
(196, 7560, 40, 4, 2020, '2021-01-19 20:48:13', 'Mehmet'),
(197, 560, 40, 3, 2020, '2021-01-19 20:48:36', 'Mehmet'),
(198, 1790, 41, 3, 2020, '2021-01-19 20:48:48', 'Mehmet'),
(199, 4850, 41, 8, 2020, '2021-01-19 20:49:25', 'Mehmet'),
(200, 7960, 42, 11, 2020, '2021-01-19 20:49:40', 'Mehmet'),
(201, 470, 42, 5, 2020, '2021-01-19 20:50:01', 'Mehmet'),
(202, 7850, 43, 10, 2020, '2021-01-19 20:50:12', 'Mehmet'),
(203, 460, 43, 1, 2020, '2021-01-19 20:50:31', 'Mehmet'),
(204, 4850, 43, 8, 2020, '2021-01-19 20:51:05', 'Mehmet'),
(205, 7810, 44, 2, 2020, '2021-01-19 20:51:24', 'Mehmet'),
(206, 4170, 44, 4, 2020, '2021-01-19 20:51:37', 'Mehmet');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sehirler`
--

CREATE TABLE `sehirler` (
  `id` int(11) NOT NULL,
  `sehirisim` text NOT NULL,
  `sehirplaka` int(11) NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ekleyen` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `sehirler`
--

INSERT INTO `sehirler` (`id`, `sehirisim`, `sehirplaka`, `tarih`, `ekleyen`) VALUES
(1, 'Afyonkarahisar', 3, '2021-01-16 01:40:01', 'Mehmet'),
(3, 'Ankara', 6, '2021-01-16 01:54:17', 'Mehmet'),
(4, 'Antalya', 7, '2021-01-16 02:24:40', 'Mehmet'),
(5, 'İstanbul', 34, '2021-01-16 11:28:55', 'Mehmet'),
(6, 'Malatya', 44, '2021-01-17 20:22:29', 'Mehmet'),
(8, 'İzmir', 35, '2021-01-18 17:50:55', 'Mehmet');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `subeler`
--

CREATE TABLE `subeler` (
  `id` int(11) NOT NULL,
  `subeisim` text NOT NULL,
  `sehir_id` int(11) NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ekleyen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `subeler`
--

INSERT INTO `subeler` (`id`, `subeisim`, `sehir_id`, `tarih`, `ekleyen`) VALUES
(1, 'Park Afyon', 1, '2021-01-16 02:05:31', 'Mehmet'),
(3, 'Muratpaşa', 4, '2021-01-16 02:27:27', 'Mehmet'),
(5, 'Keçiören', 3, '2021-01-17 21:56:35', 'Mehmet'),
(7, 'Dervişpaşa', 1, '2021-01-18 17:50:17', 'Mehmet'),
(8, 'Buca', 8, '2021-01-18 17:51:07', 'Mehmet'),
(9, 'Karşıyaka', 8, '2021-01-18 17:51:18', 'Mehmet'),
(10, 'Bornova', 8, '2021-01-18 17:51:24', 'Mehmet'),
(11, 'Battalgazi', 6, '2021-01-19 14:10:31', 'Mehmet'),
(12, 'Ataşehir', 5, '2021-01-19 15:07:39', 'Mehmet'),
(13, 'Kızılay', 3, '2021-01-19 19:37:57', 'Mehmet'),
(14, 'Mamak', 3, '2021-01-19 19:38:03', 'Mehmet'),
(15, 'Konyaaltı', 4, '2021-01-19 19:38:16', 'Mehmet'),
(16, 'Hekimhan', 6, '2021-01-19 19:38:51', 'Mehmet'),
(17, 'Fatih', 5, '2021-01-19 19:39:38', 'Mehmet'),
(18, 'Şişli', 5, '2021-01-19 19:39:44', 'Mehmet'),
(19, 'Beylikdüzü', 5, '2021-01-19 19:39:55', 'Mehmet');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

CREATE TABLE `urunler` (
  `id` int(11) NOT NULL,
  `urunbaslik` text NOT NULL,
  `urunfiyat` int(11) NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ekleyen` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Tablo döküm verisi `urunler`
--

INSERT INTO `urunler` (`id`, `urunbaslik`, `urunfiyat`, `tarih`, `ekleyen`) VALUES
(1, '0.1 mm İmplant', 100, '2019-04-05 17:39:56', 'Mehmet'),
(2, '0.2 mm İmplant', 120, '2019-04-10 09:04:05', 'Mehmet'),
(3, '0.3 mm İmplant', 140, '2019-04-06 10:36:40', 'Mehmet'),
(4, '0.4 mm İmplant', 160, '2019-04-06 10:56:47', 'Mehmet'),
(5, '0.5 mm İmplant', 180, '2019-04-06 10:56:47', 'Mehmet'),
(8, '0.6 mm İmplant', 200, '2021-01-19 12:18:59', 'Mehmet'),
(9, '0.7 mm İmplant', 220, '2021-01-19 12:19:04', 'Mehmet'),
(10, '0.8 mm İmplant', 240, '2021-01-19 12:19:10', 'Mehmet'),
(11, '0.9 mm İmplant', 260, '2021-01-19 12:19:15', 'Mehmet'),
(12, '1.0 mm İmplant', 280, '2021-01-19 12:19:24', 'Mehmet');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yoneticiler`
--

CREATE TABLE `yoneticiler` (
  `id` int(11) NOT NULL,
  `alanid` text NOT NULL,
  `kullaniciadi` text NOT NULL,
  `email` text,
  `password` text,
  `adiniz` text NOT NULL,
  `telefon` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `yoneticiler`
--

INSERT INTO `yoneticiler` (`id`, `alanid`, `kullaniciadi`, `email`, `password`, `adiniz`, `telefon`) VALUES
(1, '', 'mehmet', 'mehmet@altunkaya.xyz', 'm125346798', 'Mehmet', '0850 304 3513');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ayarlar`
--
ALTER TABLE `ayarlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `reprezant`
--
ALTER TABLE `reprezant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sube_reprezant_baglanti` (`sube_id`);

--
-- Tablo için indeksler `satislar`
--
ALTER TABLE `satislar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `satis_rep_baglanti` (`rep_id`),
  ADD KEY `satis_urun_baglanti` (`urun_id`);

--
-- Tablo için indeksler `sehirler`
--
ALTER TABLE `sehirler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `subeler`
--
ALTER TABLE `subeler`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sube_sehir_baglanti` (`sehir_id`);

--
-- Tablo için indeksler `urunler`
--
ALTER TABLE `urunler`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `yoneticiler`
--
ALTER TABLE `yoneticiler`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `ayarlar`
--
ALTER TABLE `ayarlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `reprezant`
--
ALTER TABLE `reprezant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Tablo için AUTO_INCREMENT değeri `satislar`
--
ALTER TABLE `satislar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- Tablo için AUTO_INCREMENT değeri `sehirler`
--
ALTER TABLE `sehirler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `subeler`
--
ALTER TABLE `subeler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Tablo için AUTO_INCREMENT değeri `urunler`
--
ALTER TABLE `urunler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `yoneticiler`
--
ALTER TABLE `yoneticiler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `reprezant`
--
ALTER TABLE `reprezant`
  ADD CONSTRAINT `sube_reprezant_baglanti` FOREIGN KEY (`sube_id`) REFERENCES `subeler` (`id`);

--
-- Tablo kısıtlamaları `satislar`
--
ALTER TABLE `satislar`
  ADD CONSTRAINT `satis_urun_baglanti` FOREIGN KEY (`urun_id`) REFERENCES `urunler` (`id`),
  ADD CONSTRAINT `satis_rep_baglanti` FOREIGN KEY (`rep_id`) REFERENCES `reprezant` (`id`);

--
-- Tablo kısıtlamaları `subeler`
--
ALTER TABLE `subeler`
  ADD CONSTRAINT `sube_sehir_baglanti` FOREIGN KEY (`sehir_id`) REFERENCES `sehirler` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
