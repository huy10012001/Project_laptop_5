-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2020 at 02:38 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laptop`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'DELL', 'dell', '2020-07-27 12:20:04', '2020-08-25 03:22:24'),
(9, 'MacBook', 'macbook', '2020-08-18 20:17:46', '2020-08-25 03:22:24'),
(11, 'ASUS', 'asus', '2020-08-18 20:18:22', '2020-08-25 03:22:24'),
(13, 'ACER', 'acer', '2020-08-18 20:18:50', '2020-08-25 03:22:24'),
(14, 'HP', 'hp', '2020-08-18 20:18:59', '2020-08-25 03:22:24'),
(15, 'MSI', 'msi', '2020-08-18 20:19:17', '2020-08-25 03:22:24'),
(16, 'LENOVO', 'lenovo', '2020-08-18 20:20:04', '2020-09-07 10:15:23');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `product_id`, `content`, `created_at`, `updated_at`) VALUES
(3, 1, 48, 'sản phẩm đẹp', '2020-09-07 12:20:33', '2020-09-07 12:20:33');

-- --------------------------------------------------------

--
-- Table structure for table `contact_user`
--

CREATE TABLE `contact_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_user`
--

INSERT INTO `contact_user` (`id`, `name`, `email`, `phone`, `address`, `message`, `created_at`, `updated_at`) VALUES
(3, 'đạt', 'kimdat1999@gmail.com', '0907961470', '71', 'shop mở cửa từ mấy giờ', '2020-09-07 12:19:55', '2020-09-07 12:19:55');

-- --------------------------------------------------------

--
-- Table structure for table `detail_product`
--

CREATE TABLE `detail_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`description`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_product`
--

INSERT INTO `detail_product` (`id`, `product_id`, `description`, `created_at`, `updated_at`) VALUES
(3, 10, '{\"1\":\"123\",\"2\":\"Intel\",\"3\":\"Core i3\",\"4\":\"1005G1\",\"5\":\"2\",\"6\":\"4\",\"7\":\"1.20 GHz\",\"8\":\"3.40 GHz\",\"9\":\"4 MB Smart Cache\",\"10\":\"16 GB\",\"11\":\"4 GB\",\"12\":\"DDR4\",\"13\":\"2666 MHz\",\"14\":\"1\",\"15\":\"aa\",\"16\":\"aa\",\"17\":\"aa\",\"18\":\"Intel\",\"19\":\"UHD Graphics\",\"20\":\"UHD\",\"21\":\"15.6\\\"\",\"22\":\"1920 x 1080 Pixel\",\"23\":\"Anti-glare LED-backlit\",\"24\":\"Kh\\u00f4ng\",\"25\":\"2\",\"26\":\"Realtek ALC3204\",\"27\":\"Kh\\u00f4ng\",\"28\":\"aa\",\"29\":\"aa\",\"30\":\"aa\",\"31\":\"aa\",\"32\":\"aa\",\"33\":\"aa\",\"34\":\"aa\",\"35\":\"aa\",\"36\":\"aa\",\"37\":\"aa\",\"38\":\"aa\",\"39\":\"aa\",\"40\":\"aa\",\"41\":\"aa\",\"42\":\"aa\",\"43\":\"aa\",\"44\":\"aa\",\"45\":\"aa\",\"46\":\"aa\",\"47\":\"aa\",\"48\":\"aa\",\"49\":\"aa\",\"50\":\"aa\",\"51\":\"aa\"}', '2020-08-18 22:03:06', '2020-08-18 22:03:06'),
(4, 12, '{\"1\":\"2334354\",\"2\":\"Intel\",\"3\":\"Core i5\",\"4\":\"10210U\",\"5\":\"1.60 GHz\",\"6\":\"6 MB Smart Cache\",\"7\":\"4.20 GHz\",\"8\":\"A\",\"9\":\"4 GT\\/s\",\"10\":\"16 GB\",\"11\":\"8 GB\",\"12\":\"DDR4\",\"13\":\"A\",\"14\":\"A\",\"15\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"16\":\"256 GB\",\"17\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"18\":\"A\",\"19\":\"A\",\"20\":\"A\",\"21\":\"14.0\\\"\",\"22\":\"1920 x 1080 Pixel\",\"23\":\"LED-backlit\",\"24\":\"Kh\\u00f4ng\",\"25\":\"A\",\"26\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"27\":\"Kh\\u00f4ng\",\"28\":\"A\",\"29\":\"A\",\"30\":\"1\",\"31\":\"LED-backlit\",\"32\":\"A\",\"33\":\"A\",\"34\":\"A\",\"35\":\"A\",\"36\":\"HD Web Camera\",\"37\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"38\":\"Windows 10\",\"39\":\"A\",\"40\":\"Lithium-Polymer\",\"41\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"42\":\"C\\u00f3\",\"43\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"44\":\"Kh\\u00f4ng\",\"45\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"46\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"47\":\"1.72\",\"48\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"49\":\"12 Th\\u00e1ng\",\"50\":\"Trung Qu\\u1ed1c\",\"51\":\"\\u0110ang c\\u1eadp nh\\u1eadt\"}', '2020-08-18 22:43:01', '2020-08-18 22:43:01'),
(5, 13, '{\"1\":\"2134\",\"2\":\"Intel\",\"3\":\"Core i5\",\"4\":\"1035G1\",\"5\":\"1.00 GHz\",\"6\":\"6 MB Smart Cache\",\"7\":\"3.60 GHz\",\"8\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"9\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"10\":\"16 GB\",\"11\":\"8 GB\",\"12\":\"DDR4\",\"13\":\"2666 MHz\",\"14\":\"1\",\"15\":\"M2. PCIe\",\"16\":\"256 GB\",\"17\":\"1\",\"18\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"19\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"20\":\"UHD Graphics\",\"21\":\"14.0\",\"22\":\"1920 x 1080 Pixel\",\"23\":\"Anti-glare LED-backlit\",\"24\":\"Kh\\u00f4ng\",\"25\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"26\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"27\":\"Kh\\u00f4ng\",\"28\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"29\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"30\":\"0\",\"31\":\"Anti-glare LED-backlit\",\"32\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"33\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"34\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"35\":\"c\\u00f3 SD-card\",\"36\":\"HD Web Camera\",\"37\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"38\":\"Windows 10\",\"39\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"40\":\"Lithium-ion\",\"41\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"42\":\"C\\u00f3\",\"43\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"44\":\"C\\u00f3\",\"45\":\"S\\u1ea1c, S\\u00e1ch HDSD\",\"46\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"47\":\"1.79\",\"48\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"49\":\"12 Th\\u00e1ng\",\"50\":\"Trung Qu\\u1ed1c\",\"51\":\"2020\"}', '2020-08-18 23:01:25', '2020-08-18 23:17:28'),
(6, 14, '{\"1\":\"1213\",\"2\":\"Intel\",\"3\":\"Core i5\",\"4\":\"8265U\",\"5\":\"1.60 GHz\",\"6\":\"6 MB Smart Cache\",\"7\":\"3.90 GHz\",\"8\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"9\":\"4 GT\\/s\",\"10\":\"32 GB\",\"11\":\"4 GB\",\"12\":\"DDR4\",\"13\":\"2400 MHz\",\"14\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"15\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"16\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"17\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"18\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"19\":\"2 GB\",\"20\":\"GDDR5\",\"21\":\"15.6\\\"\",\"22\":\"1920 x 1080 Pixel\",\"23\":\"LED-backlit\",\"24\":\"Kh\\u00f4ng\",\"25\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"26\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"27\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"28\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"29\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"30\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"31\":\"LED-backlit\",\"32\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"33\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"34\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"35\":\"C\\u00f3 (SD card 4 in 1)\",\"36\":\"HD Web Camera\",\"37\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"38\":\"Windows 10\",\"39\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"40\":\"Lithium-ion\",\"41\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"42\":\"C\\u00f3\",\"43\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"44\":\"C\\u00f3\",\"45\":\"M\\u00e1y,adater, h\\u1ed9p carton\",\"46\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"47\":\"1.95\",\"48\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"49\":\"12 Th\\u00e1ng\",\"50\":\"Trung Qu\\u1ed1c\",\"51\":\"\\u0110ang c\\u1eadp nh\\u1eadt\"}', '2020-08-18 23:16:24', '2020-08-18 23:16:24'),
(7, 15, '{\"1\":\"234\",\"2\":\"Intel\",\"3\":\"Core i7\",\"4\":\"9th-gen\",\"5\":\"2.60 GHz\",\"6\":\"12 MB Smart Cache\",\"7\":\"4.50 GHz\",\"8\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"9\":\"8 GT\\/s\",\"10\":\"64 GB\",\"11\":\"16 GB\",\"12\":\"DDR4\",\"13\":\"2666 MHz\",\"14\":\"0\",\"15\":\"C\\u00f3\",\"16\":\"512 GB\",\"17\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"18\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"19\":\"4 GB\",\"20\":\"GDDR6\",\"21\":\"16.0\\\"\",\"22\":\"3072 x 1920 Pixel\",\"23\":\"IPS LCD LED Backlit, True Tone\",\"24\":\"Kh\\u00f4ng\",\"25\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"26\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"27\":\"Kh\\u00f4ng\",\"28\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"29\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"30\":\"0\",\"31\":\"IPS LCD LED Backlit, True Tone\",\"32\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"33\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"34\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"35\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"36\":\"720p FaceTime HD camera\",\"37\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"38\":\"Mac OS\",\"39\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"40\":\"Lithium-Polymer\",\"41\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"42\":\"C\\u00f3\",\"43\":\"LED\",\"44\":\"Kh\\u00f4ng\",\"45\":\"C\\u1ee7 s\\u1ea1c USB-C 96W, d\\u00e2y s\\u1ea1c USB-C 2m, S\\u00e1ch HDSD\",\"46\":\"357.9 x 24.59 x 16.2\",\"47\":\"2.0\",\"48\":\"Nh\\u00f4m,Nh\\u1ef1a\",\"49\":\"12 Th\\u00e1ng\",\"50\":\"Trung Qu\\u1ed1c\",\"51\":\"2019\"}', '2020-08-18 23:35:08', '2020-08-18 23:35:08'),
(8, 16, '{\"1\":\"2345\",\"2\":\"Intel\",\"3\":\"Core i5\",\"4\":\"10th-gen\",\"5\":\"2.00 GHz\",\"6\":\"6 MB L3 Cache\",\"7\":\"3.80 GHz\",\"8\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"9\":\"4 GT\\/s\",\"10\":\"32 GB\",\"11\":\"16 GB\",\"12\":\"LPDDR4X\",\"13\":\"3733 MHz\",\"14\":\"0\",\"15\":\"C\\u00f3\",\"16\":\"1 TB\",\"17\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"18\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"19\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"20\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"21\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"22\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"23\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"24\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"25\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"26\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"27\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"28\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"29\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"30\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"31\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"32\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"33\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"34\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"35\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"36\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"37\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"38\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"39\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"40\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"41\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"42\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"43\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"44\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"45\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"46\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"47\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"48\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"49\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"50\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"51\":\"\\u0110ang c\\u1eadp nh\\u1eadt\"}', '2020-08-18 23:57:11', '2020-08-18 23:57:11'),
(9, 17, '{\"1\":\"23245\",\"2\":\"Intel\",\"3\":\"Core i5\",\"4\":\"8th-gen\",\"5\":\"2.40 GHz\",\"6\":\"6 MB L3 Cache\",\"7\":\"4.10 GHz\",\"8\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"9\":\"4 GT\\/s\",\"10\":\"16 GB\",\"11\":\"8 GB\",\"12\":\"LPDDR3\",\"13\":\"2133 MHz\",\"14\":\"0\",\"15\":\"C\\u00f3\",\"16\":\"512 GB\",\"17\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"18\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"19\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"20\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"21\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"22\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"23\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"24\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"25\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"26\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"27\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"28\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"29\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"30\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"31\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"32\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"33\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"34\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"35\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"36\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"37\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"38\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"39\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"40\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"41\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"42\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"43\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"44\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"45\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"46\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"47\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"48\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"49\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"50\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"51\":\"\\u0110ang c\\u1eadp nh\\u1eadt\"}', '2020-08-19 00:01:14', '2020-08-19 00:01:14'),
(10, 18, '{\"1\":\"4546\",\"2\":\"Intel\",\"3\":\"Core i5\",\"4\":\"10th-gen\",\"5\":\"1.10 GHz\",\"6\":\"6 MB L3 Cache\",\"7\":\"3.50 GHz\",\"8\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"9\":\"4 GT\\/s\",\"10\":\"16 GB\",\"11\":\"8 GB\",\"12\":\"LPDDR4\",\"13\":\"3733 MHz\",\"14\":\"0\",\"15\":\"C\\u00f3\",\"16\":\"512 GB\",\"17\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"18\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"19\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"20\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"21\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"22\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"23\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"24\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"25\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"26\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"27\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"28\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"29\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"30\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"31\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"32\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"33\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"34\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"35\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"36\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"37\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"38\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"39\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"40\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"41\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"42\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"43\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"44\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"45\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"46\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"47\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"48\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"49\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"50\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"51\":\"\\u0110ang c\\u1eadp nh\\u1eadt\"}', '2020-08-19 00:05:53', '2020-08-19 00:05:53'),
(11, 19, '{\"1\":\"6544\",\"2\":\"Intel\",\"3\":\"Core i9\",\"4\":\"9th-gen\",\"5\":\"2.30 GHz\",\"6\":\"12 MB Smart Cache\",\"7\":\"4.80 GHz\",\"8\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"9\":\"8 GT\\/s\",\"10\":\"64 GB\",\"11\":\"16 GB\",\"12\":\"DDR4\",\"13\":\"2666 MHz\",\"14\":\"0\",\"15\":\"C\\u00f3\",\"16\":\"1 TB\",\"17\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"18\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"19\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"20\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"21\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"22\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"23\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"24\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"25\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"26\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"27\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"28\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"29\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"30\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"31\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"32\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"33\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"34\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"35\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"36\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"37\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"38\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"39\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"40\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"41\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"42\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"43\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"44\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"45\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"46\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"47\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"48\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"49\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"50\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"51\":\"\\u0110ang c\\u1eadp nh\\u1eadt\"}', '2020-08-19 00:12:00', '2020-08-19 00:12:00'),
(12, 20, '{\"1\":\"768\",\"2\":\"Intel\",\"3\":\"Core i5\",\"4\":\"10th-gen\",\"5\":\"2.00 GHz\",\"6\":\"6 MB L3 Cache\",\"7\":\"3.80 GHz\",\"8\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"9\":\"4 GT\\/s\",\"10\":\"32 GB\",\"11\":\"16 GB\",\"12\":\"LPDDR4X\",\"13\":\"3733 MHz\",\"14\":\"0\",\"15\":\"C\\u00f3\",\"16\":\"512 GB\",\"17\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"18\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"19\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"20\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"21\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"22\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"23\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"24\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"25\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"26\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"27\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"28\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"29\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"30\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"31\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"32\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"33\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"34\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"35\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"36\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"37\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"38\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"39\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"40\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"41\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"42\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"43\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"44\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"45\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"46\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"47\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"48\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"49\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"50\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"51\":\"\\u0110ang c\\u1eadp nh\\u1eadt\"}', '2020-08-19 00:16:53', '2020-08-19 00:16:53'),
(13, 21, '{\"1\":\"4674\",\"2\":\"Intel\",\"3\":\"Core i5\",\"4\":\"10510U\",\"5\":\"1.80 GHz\",\"6\":\"8 MB Cache\",\"7\":\"4.90 GHz\",\"8\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"9\":\"2133 MHz\",\"10\":\"16 GB\",\"11\":\"16 GB\",\"12\":\"LPDDR3\",\"13\":\"2133 MHz\",\"14\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"15\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"16\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"17\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"18\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"19\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"20\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"21\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"22\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"23\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"24\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"25\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"26\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"27\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"28\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"29\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"30\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"31\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"32\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"33\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"34\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"35\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"36\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"37\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"38\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"39\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"40\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"41\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"42\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"43\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"44\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"45\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"46\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"47\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"48\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"49\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"50\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"51\":\"\\u0110ang c\\u1eadp nh\\u1eadt\"}', '2020-08-19 00:21:50', '2020-08-19 00:21:50'),
(14, 22, '{\"1\":\"54758\",\"2\":\"Intel\",\"3\":\"Core i5\",\"4\":\"10210U\",\"5\":\"1.60 GHz\",\"6\":\"6 MB Smart Cache\",\"7\":\"4.20 GHz\",\"8\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"9\":\"4 GT\\/s\",\"10\":\"8 GB\",\"11\":\"8 GB\",\"12\":\"LPDDR3\",\"13\":\"2133 MHz\",\"14\":\"0\",\"15\":\"M2. PCIe\",\"16\":\"512 GB\",\"17\":\"0\",\"18\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"19\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"20\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"21\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"22\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"23\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"24\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"25\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"26\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"27\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"28\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"29\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"30\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"31\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"32\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"33\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"34\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"35\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"36\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"37\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"38\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"39\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"40\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"41\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"42\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"43\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"44\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"45\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"46\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"47\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"48\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"49\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"50\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"51\":\"\\u0110ang c\\u1eadp nh\\u1eadt\"}', '2020-08-19 00:25:33', '2020-08-19 00:25:33'),
(15, 23, '{\"1\":\"8364\",\"2\":\"AMD\",\"3\":\"Ryzen 7\",\"4\":\"4800HS\",\"5\":\"2.90 GHz\",\"6\":\"8 MB L3 Cache\",\"7\":\"4.20 GHz\",\"8\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"9\":\"8 GT\\/s\",\"10\":\"32 GB\",\"11\":\"16 GB\",\"12\":\"DDR4\",\"13\":\"3200 MHz\",\"14\":\"0\",\"15\":\"M2. PCIe\",\"16\":\"1 TB\",\"17\":\"1\",\"18\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"19\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"20\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"21\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"22\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"23\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"24\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"25\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"26\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"27\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"28\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"29\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"30\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"31\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"32\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"33\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"34\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"35\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"36\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"37\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"38\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"39\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"40\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"41\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"42\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"43\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"44\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"45\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"46\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"47\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"48\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"49\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"50\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"51\":\"\\u0110ang c\\u1eadp nh\\u1eadt\"}', '2020-08-19 00:29:41', '2020-08-19 00:29:41'),
(16, 24, '{\"1\":\"69708\",\"2\":\"AMD\",\"3\":\"Ryzen 7\",\"4\":\"3750H\",\"5\":\"2.30 GHz\",\"6\":\"4 MB L3 Cache\",\"7\":\"4.00 GHz\",\"8\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"9\":\"4 GT\\/s\",\"10\":\"20 GB\",\"11\":\"8 GB\",\"12\":\"DDR4\",\"13\":\"2400 MHz\",\"14\":\"1\",\"15\":\"M2. PCIe\",\"16\":\"512 GB\",\"17\":\"1\",\"18\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"19\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"20\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"21\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"22\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"23\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"24\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"25\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"26\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"27\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"28\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"29\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"30\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"31\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"32\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"33\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"34\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"35\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"36\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"37\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"38\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"39\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"40\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"41\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"42\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"43\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"44\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"45\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"46\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"47\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"48\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"49\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"50\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"51\":\"\\u0110ang c\\u1eadp nh\\u1eadt\"}', '2020-08-19 00:35:42', '2020-08-19 00:35:42'),
(17, 25, '{\"1\":\"4654\",\"2\":\"Intel\",\"3\":\"Core i5\",\"4\":\"10210U\",\"5\":\"1.60 GHz\",\"6\":\"6 MB SmartCache\",\"7\":\"4.20 GHz\",\"8\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"9\":\"2133 MHz\",\"10\":\"8 GB\",\"11\":\"8 GB\",\"12\":\"LPDDR3\",\"13\":\"2133 MHz\",\"14\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"15\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"16\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"17\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"18\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"19\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"20\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"21\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"22\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"23\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"24\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"25\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"26\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"27\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"28\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"29\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"30\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"31\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"32\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"33\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"34\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"35\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"36\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"37\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"38\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"39\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"40\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"41\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"42\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"43\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"44\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"45\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"46\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"47\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"48\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"49\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"50\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"51\":\"\\u0110ang c\\u1eadp nh\\u1eadt\"}', '2020-08-19 00:39:35', '2020-08-19 00:39:35'),
(18, 26, '{\"1\":\"5756\",\"2\":\"Intel\",\"3\":\"Core i7\",\"4\":\"9750H\",\"5\":\"2.60 GHz\",\"6\":\"12 MB Smart Cache\",\"7\":\"4.50 GHz\",\"8\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"9\":\"8 GT\\/s\",\"10\":\"32 GB\",\"11\":\"8 GB\",\"12\":\"DDR4\",\"13\":\"2666 MHz\",\"14\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"15\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"16\":\"512 GB\",\"17\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"18\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"19\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"20\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"21\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"22\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"23\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"24\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"25\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"26\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"27\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"28\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"29\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"30\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"31\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"32\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"33\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"34\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"35\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"36\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"37\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"38\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"39\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"40\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"41\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"42\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"43\":\"\\u0110ang c\\u1eadp nh\\u1eadt\\t\\u0110ang c\\u1eadp nh\\u1eadt\",\"44\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"45\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"46\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"47\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"48\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"49\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"50\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"51\":\"\\u0110ang c\\u1eadp nh\\u1eadt\"}', '2020-08-19 00:43:37', '2020-08-19 00:43:37'),
(19, 27, '{\"1\":\"365\",\"2\":\"Intel\",\"3\":\"Core i7\",\"4\":\"10875H\",\"5\":\"2.30 GHz\",\"6\":\"16 MB Smart Cache\",\"7\":\"5.10 GHz\",\"8\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"9\":\"8 GT\\/s\",\"10\":\"32 GB\",\"11\":\"32 GB\",\"12\":\"DDR4\",\"13\":\"2666 MHz\",\"14\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"15\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"16\":\"1 TB\",\"17\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"18\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"19\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"20\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"21\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"22\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"23\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"24\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"25\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"26\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"27\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"28\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"29\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"30\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"31\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"32\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"33\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"34\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"35\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"36\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"37\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"38\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"39\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"40\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"41\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"42\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"43\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"44\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"45\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"46\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"47\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"48\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"49\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"50\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"51\":\"\\u0110ang c\\u1eadp nh\\u1eadt\"}', '2020-08-19 00:49:44', '2020-08-19 00:49:44'),
(20, 28, '{\"1\":\"756\",\"2\":\"Intel\",\"3\":\"Core i7\",\"4\":\"10875H\",\"5\":\"2.30 GHz\",\"6\":\"16 MB Smart Cache\",\"7\":\"5.10 GHz\",\"8\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"9\":\"8 GT\\/s\",\"10\":\"32 GB\",\"11\":\"32 GB\",\"12\":\"DDR4\",\"13\":\"2666 MHz\",\"14\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"15\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"16\":\"1 TB\",\"17\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"18\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"19\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"20\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"21\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"22\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"23\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"24\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"25\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"26\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"27\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"28\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"29\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"30\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"31\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"32\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"33\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"34\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"35\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"36\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"37\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"38\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"39\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"40\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"41\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"42\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"43\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"44\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"45\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"46\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"47\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"48\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"49\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"50\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"51\":\"\\u0110ang c\\u1eadp nh\\u1eadt\"}', '2020-08-19 00:54:15', '2020-08-19 00:54:15'),
(21, 29, '{\"1\":\"5687\",\"2\":\"Intel\",\"3\":\"Intel\",\"4\":\"10750H\",\"5\":\"2.60 GHz\",\"6\":\"12 MB Smart Cache\",\"7\":\"5.00 GHz\",\"8\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"9\":\"8 GT\\/s\",\"10\":\"32 GB\",\"11\":\"8 GB\",\"12\":\"DDR4\",\"13\":\"2666 MHz\",\"14\":\"3\",\"15\":\"M2. PCIe\",\"16\":\"512 GB\",\"17\":\"3\",\"18\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"19\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"20\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"21\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"22\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"23\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"24\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"25\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"26\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"27\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"28\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"29\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"30\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"31\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"32\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"33\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"34\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"35\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"36\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"37\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"38\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"39\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"40\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"41\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"42\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"43\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"44\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"45\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"46\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"47\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"48\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"49\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"50\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"51\":\"\\u0110ang c\\u1eadp nh\\u1eadt\"}', '2020-08-19 00:58:08', '2020-08-19 00:58:08'),
(22, 30, '{\"1\":\"5365\",\"2\":\"Intel\",\"3\":\"Core i7\",\"4\":\"10750H\",\"5\":\"2.60 GHz\",\"6\":\"12 MB Smart Cache\",\"7\":\"5.00 GHz\",\"8\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"9\":\"8 GT\\/s\",\"10\":\"32 GB\",\"11\":\"8 GB\",\"12\":\"DDR4\",\"13\":\"2666 MHz\",\"14\":\"3\",\"15\":\"M2. PCIe\",\"16\":\"512 GB\",\"17\":\"3\",\"18\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"19\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"20\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"21\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"22\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"23\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"24\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"25\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"26\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"27\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"28\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"29\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"30\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"31\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"32\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"33\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"34\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"35\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"36\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"37\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"38\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"39\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"40\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"41\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"42\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"43\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"44\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"45\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"46\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"47\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"48\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"49\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"50\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"51\":\"\\u0110ang c\\u1eadp nh\\u1eadt\"}', '2020-08-19 01:01:34', '2020-08-19 01:01:34'),
(23, 31, '{\"1\":\"8798\",\"2\":\"Intel\",\"3\":\"Core i7\",\"4\":\"1065G7\",\"5\":\"1.30 GHz\",\"6\":\"8 MB Smart Cache\",\"7\":\"3.90 GHz\",\"8\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"9\":\"4 GT\\/s\",\"10\":\"16 GB\",\"11\":\"16 GB\",\"12\":\"LPDDR4\",\"13\":\"3200 MHz\",\"14\":\"0\",\"15\":\"M2. PCIe\",\"16\":\"512 GB\",\"17\":\"1\",\"18\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"19\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"20\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"21\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"22\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"23\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"24\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"25\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"26\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"27\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"28\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"29\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"30\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"31\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"32\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"33\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"34\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"35\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"36\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"37\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"38\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"39\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"40\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"41\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"42\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"43\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"44\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"45\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"46\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"47\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"48\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"49\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"50\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"51\":\"\\u0110ang c\\u1eadp nh\\u1eadt\"}', '2020-08-19 01:07:39', '2020-08-19 01:07:39'),
(24, 32, '{\"1\":\"5447\",\"2\":\"Intel\",\"3\":\"Core i7\",\"4\":\"10750H\",\"5\":\"2.6 GHz\",\"6\":\"12 MB L3 Cache\",\"7\":\"5.0 GHz\",\"8\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"9\":\"8 GT\\/s DMI\",\"10\":\"32 GB\",\"11\":\"8 GB\",\"12\":\"DDR4\",\"13\":\"2933 MHz\",\"14\":\"3\",\"15\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"16\":\"512 GB\",\"17\":\"2\",\"18\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"19\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"20\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"21\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"22\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"23\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"24\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"25\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"26\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"27\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"28\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"29\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"30\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"31\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"32\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"33\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"34\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"35\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"36\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"37\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"38\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"39\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"40\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"41\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"42\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"43\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"44\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"45\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"46\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"47\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"48\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"49\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"50\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"51\":\"\\u0110ang c\\u1eadp nh\\u1eadt\"}', '2020-08-19 01:13:56', '2020-08-19 01:13:56'),
(25, 33, '{\"1\":\"355\",\"2\":\"AMD\",\"3\":\"Ryzen\\u2122 7\",\"4\":\"4700U\",\"5\":\"2.3Ghz\",\"6\":\"6 MB Cache\",\"7\":\"4Ghz\",\"8\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"9\":\"2400 MHz\",\"10\":\"Kh\\u00f4ng\",\"11\":\"8 GB\",\"12\":\"Kh\\u00f4ng\",\"13\":\"3200 MHz\",\"14\":\"0\",\"15\":\"M2. PCIe\",\"16\":\"256 GB\",\"17\":\"1\",\"18\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"19\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"20\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"21\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"22\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"23\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"24\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"25\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"26\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"27\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"28\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"29\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"30\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"31\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"32\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"33\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"34\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"35\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"36\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"37\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"38\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"39\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"40\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"41\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"42\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"43\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"44\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"45\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"46\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"47\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"48\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"49\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"50\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"51\":\"\\u0110ang c\\u1eadp nh\\u1eadt\"}', '2020-08-19 01:19:33', '2020-08-19 01:19:33'),
(26, 34, '{\"1\":\"453443\",\"2\":\"Intel\",\"3\":\"Core i7\",\"4\":\"10510U\",\"5\":\"1.80 GHz\",\"6\":\"8 MB Smart Cache\",\"7\":\"4.90 GHz\",\"8\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"9\":\"4 GT\\/s\",\"10\":\"8 GB\",\"11\":\"8 GB\",\"12\":\"DDR4\",\"13\":\"2400 MHz\",\"14\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"15\":\"M2. PCIe\",\"16\":\"512 GB\",\"17\":\"1\",\"18\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"19\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"20\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"21\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"22\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"23\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"24\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"25\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"26\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"27\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"28\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"29\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"30\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"31\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"32\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"33\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"34\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"35\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"36\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"37\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"38\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"39\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"40\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"41\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"42\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"43\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"44\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"45\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"46\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"47\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"48\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"49\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"50\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"51\":\"\\u0110ang c\\u1eadp nh\\u1eadt\"}', '2020-08-19 01:25:47', '2020-08-19 01:25:47'),
(27, 35, '{\"1\":\"21435\",\"2\":\"Intel\",\"3\":\"Core i5\",\"4\":\"8265U\",\"5\":\"1.60 GHz\",\"6\":\"6 MB Smart Cache\",\"7\":\"3.90 GHz\",\"8\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"9\":\"4 GT\\/s\",\"10\":\"8 GB\",\"11\":\"8 GB\",\"12\":\"DDR4\",\"13\":\"2400 MHz\",\"14\":\"0\",\"15\":\"M2. PCIe\",\"16\":\"256 GB\",\"17\":\"1\",\"18\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"19\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"20\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"21\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"22\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"23\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"24\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"25\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"26\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"27\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"28\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"29\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"30\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"31\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"32\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"33\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"34\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"35\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"36\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"37\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"38\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"39\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"40\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"41\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"42\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"43\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"44\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"45\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"46\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"47\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"48\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"49\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"50\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"51\":\"\\u0110ang c\\u1eadp nh\\u1eadt\"}', '2020-08-19 01:29:15', '2020-08-19 01:29:15'),
(28, 36, '{\"1\":\"3245\",\"2\":\"Intel\",\"3\":\"Core i7\",\"4\":\"10510U\",\"5\":\"1.80 GHz\",\"6\":\"8 MB Smart Cache\",\"7\":\"4.90 GHz\",\"8\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"9\":\"4 GT\\/s\",\"10\":\"8 GB\",\"11\":\"8 GB\",\"12\":\"DDR4\",\"13\":\"2400 MHz\",\"14\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"15\":\"M2. PCIe\",\"16\":\"512 GB\",\"17\":\"1\",\"18\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"19\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"20\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"21\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"22\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"23\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"24\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"25\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"26\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"27\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"28\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"29\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"30\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"31\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"32\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"33\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"34\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"35\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"36\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"37\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"38\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"39\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"40\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"41\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"42\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"43\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"44\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"45\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"46\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"47\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"48\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"49\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"50\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"51\":\"\\u0110ang c\\u1eadp nh\\u1eadt\"}', '2020-08-19 01:33:28', '2020-08-19 01:33:28'),
(29, 37, '{\"1\":\"4566\",\"2\":\"Intel\",\"3\":\"Core i5\",\"4\":\"9300H\",\"5\":\"2.40 GHz\",\"6\":\"8 MB Smart Cache\",\"7\":\"4.10 GHz\",\"8\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"9\":\"8 GT\\/s\",\"10\":\"32 GB\",\"11\":\"8 GB\",\"12\":\"DDR4\",\"13\":\"2666 MHz\",\"14\":\"3\",\"15\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"16\":\"512 GB\",\"17\":\"2\",\"18\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"19\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"20\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"21\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"22\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"23\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"24\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"25\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"26\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"27\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"28\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"29\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"30\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"31\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"32\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"33\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"34\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"35\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"36\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"37\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"38\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"39\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"40\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"41\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"42\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"43\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"44\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"45\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"46\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"47\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"48\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"49\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"50\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"51\":\"\\u0110ang c\\u1eadp nh\\u1eadt\"}', '2020-08-19 03:26:36', '2020-08-19 03:26:36');
INSERT INTO `detail_product` (`id`, `product_id`, `description`, `created_at`, `updated_at`) VALUES
(30, 38, '{\"1\":\"345657\",\"2\":\"AMD\",\"3\":\"Ryzen 7\",\"4\":\"3750H\",\"5\":\"2.30 GHz\",\"6\":\"4 MB L3 Cache\",\"7\":\"4.00 GHz\",\"8\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"9\":\"4 GT\\/s\",\"10\":\"64 GB\",\"11\":\"8 GB\",\"12\":\"DDR6\",\"13\":\"2666 MHz\",\"14\":\"1\",\"15\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"16\":\"512 GB\",\"17\":\"3\",\"18\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"19\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"20\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"21\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"22\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"23\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"24\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"25\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"26\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"27\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"28\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"29\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"30\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"31\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"32\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"33\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"34\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"35\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"36\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"37\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"38\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"39\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"40\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"41\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"42\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"43\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"44\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"45\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"46\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"47\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"48\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"49\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"50\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"51\":\"\\u0110ang c\\u1eadp nh\\u1eadt\"}', '2020-08-19 03:30:26', '2020-08-19 03:30:26'),
(31, 39, '{\"1\":\"2435465\",\"2\":\"Intel\",\"3\":\"Core i5\",\"4\":\"10210U\",\"5\":\"1.60 GHz\",\"6\":\"6 MB Smart Cache\",\"7\":\"4.20 GHz\",\"8\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"9\":\"4 GT\\/s\",\"10\":\"32 GB\",\"11\":\"8 GB\",\"12\":\"DDR4\",\"13\":\"2666 MHz\",\"14\":\"0\",\"15\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"16\":\"256 GB\",\"17\":\"1\",\"18\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"19\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"20\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"21\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"22\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"23\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"24\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"25\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"26\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"27\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"28\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"29\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"30\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"31\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"32\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"33\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"34\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"35\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"36\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"37\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"38\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"39\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"40\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"41\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"42\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"43\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"44\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"45\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"46\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"47\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"48\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"49\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"50\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"51\":\"\\u0110ang c\\u1eadp nh\\u1eadt\"}', '2020-08-19 03:35:35', '2020-08-19 03:35:35'),
(32, 40, '{\"1\":\"45647\",\"2\":\"Intel\",\"3\":\"Core i5\",\"4\":\"10300H\",\"5\":\"2.50 GHz\",\"6\":\"8 MB Smart Cache\",\"7\":\"4.50 GHz\",\"8\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"9\":\"8 GT\\/s\",\"10\":\"32 GB\",\"11\":\"8 GB\",\"12\":\"DDR4\",\"13\":\"2666 MHz\",\"14\":\"1\",\"15\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"16\":\"512 GB\",\"17\":\"3\",\"18\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"19\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"20\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"21\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"22\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"23\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"24\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"25\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"26\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"27\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"28\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"29\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"30\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"31\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"32\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"33\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"34\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"35\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"36\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"37\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"38\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"39\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"40\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"41\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"42\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"43\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"44\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"45\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"46\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"47\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"48\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"49\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"50\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"51\":\"\\u0110ang c\\u1eadp nh\\u1eadt\"}', '2020-08-19 03:39:13', '2020-08-19 03:39:13'),
(33, 41, '{\"1\":\"53225\",\"2\":\"Intel\",\"3\":\"Core i5\",\"4\":\"9300H\",\"5\":\"2.40 GHz\",\"6\":\"8 MB Smart Cache\",\"7\":\"4.10 GHz\",\"8\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"9\":\"8 GT\\/s\",\"10\":\"64 GB\",\"11\":\"8 GB\",\"12\":\"DDR4\",\"13\":\"2666 MHz\",\"14\":\"1\",\"15\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"16\":\"512 GB\",\"17\":\"3\",\"18\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"19\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"20\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"21\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"22\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"23\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"24\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"25\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"26\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"27\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"28\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"29\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"30\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"31\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"32\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"33\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"34\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"35\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"36\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"37\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"38\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"39\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"40\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"41\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"42\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"43\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"44\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"45\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"46\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"47\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"48\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"49\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"50\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"51\":\"\\u0110ang c\\u1eadp nh\\u1eadt\"}', '2020-08-19 03:43:12', '2020-08-19 03:43:12'),
(34, 42, '{\"1\":\"23646\",\"2\":\"Intel\",\"3\":\"Core i7\",\"4\":\"9750H\",\"5\":\"2.60 GHz\",\"6\":\"12 MB Smart Cache\",\"7\":\"4.50 GHz\",\"8\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"9\":\"8 GT\\/s\",\"10\":\"32 GB\",\"11\":\"8 GB\",\"12\":\"DDR4\",\"13\":\"2666 MHz\",\"14\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"15\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"16\":\"1 TB\",\"17\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"18\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"19\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"20\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"21\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"22\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"23\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"24\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"25\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"26\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"27\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"28\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"29\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"30\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"31\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"32\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"33\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"34\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"35\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"36\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"37\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"38\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"39\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"40\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"41\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"42\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"43\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"44\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"45\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"46\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"47\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"48\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"49\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"50\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"51\":\"\\u0110ang c\\u1eadp nh\\u1eadt\"}', '2020-08-19 03:48:30', '2020-08-19 03:48:30'),
(35, 43, '{\"1\":\"32446\",\"2\":\"Intel\",\"3\":\"Core i7\",\"4\":\"9750H\",\"5\":\"2.60 GHz\",\"6\":\"12 MB Smart Cache\",\"7\":\"4.50 GHz\",\"8\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"9\":\"8 GT\\/s\",\"10\":\"16 GB\",\"11\":\"8 GB\",\"12\":\"DDR4\",\"13\":\"2400 MHz\",\"14\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"15\":\"M2. PCIe\",\"16\":\"512 GB\",\"17\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"18\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"19\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"20\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"21\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"22\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"23\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"24\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"25\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"26\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"27\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"28\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"29\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"30\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"31\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"32\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"33\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"34\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"35\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"36\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"37\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"38\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"39\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"40\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"41\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"42\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"43\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"44\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"45\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"46\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"47\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"48\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"49\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"50\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"51\":\"\\u0110ang c\\u1eadp nh\\u1eadt\"}', '2020-08-19 03:51:51', '2020-08-19 03:51:51'),
(36, 44, '{\"1\":\"3548\",\"2\":\"AMD\",\"3\":\"Ryzen 7\",\"4\":\"4800H\",\"5\":\"2.90 GHz\",\"6\":\"8 MB L3 Cache\",\"7\":\"4.20 GHz\",\"8\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"9\":\"8 GT\\/s\",\"10\":\"16 GB\",\"11\":\"8 GB\",\"12\":\"DDR4\",\"13\":\"3200 MHz\",\"14\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"15\":\"M2. PCIe\",\"16\":\"512 GB\",\"17\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"18\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"19\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"20\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"21\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"22\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"23\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"24\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"25\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"26\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"27\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"28\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"29\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"30\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"31\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"32\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"33\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"34\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"35\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"36\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"37\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"38\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"39\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"40\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"41\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"42\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"43\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"44\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"45\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"46\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"47\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"48\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"49\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"50\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"51\":\"\\u0110ang c\\u1eadp nh\\u1eadt\"}', '2020-08-19 03:59:21', '2020-08-19 03:59:21'),
(37, 45, '{\"1\":\"3647\",\"2\":\"Intel\",\"3\":\"Core i5\",\"4\":\"8265U\",\"5\":\"1.60 GHz\",\"6\":\"6 MB Smart Cache\",\"7\":\"3.90 GHz\",\"8\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"9\":\"4 GT\\/s\",\"10\":\"32 GB\",\"11\":\"8 GB\",\"12\":\"DDR4\",\"13\":\"2400 MHz\",\"14\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"15\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"16\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"17\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"18\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"19\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"20\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"21\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"22\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"23\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"24\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"25\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"26\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"27\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"28\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"29\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"30\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"31\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"32\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"33\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"34\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"35\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"36\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"37\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"38\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"39\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"40\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"41\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"42\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"43\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"44\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"45\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"46\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"47\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"48\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"49\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"50\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"51\":\"\\u0110ang c\\u1eadp nh\\u1eadt\"}', '2020-08-19 04:02:50', '2020-08-19 04:02:50'),
(38, 46, '{\"1\":\"64457\",\"2\":\"Intel\",\"3\":\"Core i5\",\"4\":\"8300H\",\"5\":\"2.30 GHz\",\"6\":\"8 MB Smart Cache\",\"7\":\"4.00 GHz\",\"8\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"9\":\"8 GT\\/s\",\"10\":\"16 GB\",\"11\":\"8 GB\",\"12\":\"DDR4\",\"13\":\"2666 MHz\",\"14\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"15\":\"SATA 3\",\"16\":\"1 TB\",\"17\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"18\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"19\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"20\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"21\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"22\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"23\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"24\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"25\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"26\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"27\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"28\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"29\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"30\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"31\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"32\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"33\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"34\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"35\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"36\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"37\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"38\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"39\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"40\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"41\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"42\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"43\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"44\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"45\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"46\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"47\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"48\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"49\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"50\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"51\":\"\\u0110ang c\\u1eadp nh\\u1eadt\"}', '2020-08-19 04:07:49', '2020-08-19 04:07:49'),
(39, 47, '{\"1\":\"36752\",\"2\":\"Intel\",\"3\":\"Core i5\",\"4\":\"8th-gen\",\"5\":\"2.40 GHz\",\"6\":\"6 MB L3 Cache\",\"7\":\"4.10 GHz\",\"8\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"9\":\"4 GT\\/s\",\"10\":\"16 GB\",\"11\":\"8 GB\",\"12\":\"LPDDR3\",\"13\":\"2133 MHz\",\"14\":\"0\",\"15\":\"C\\u00f3\",\"16\":\"256 GB\",\"17\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"18\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"19\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"20\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"21\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"22\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"23\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"24\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"25\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"26\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"27\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"28\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"29\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"30\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"31\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"32\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"33\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"34\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"35\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"36\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"37\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"38\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"39\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"40\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"41\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"42\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"43\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"44\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"45\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"46\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"47\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"48\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"49\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"50\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"51\":\"\\u0110ang c\\u1eadp nh\\u1eadt\"}', '2020-08-19 04:21:32', '2020-08-19 04:21:32'),
(40, 48, '{\"1\":\"984659\",\"2\":\"Intel\",\"3\":\"Core i7\",\"4\":\"10510U\",\"5\":\"1.80 GHz\",\"6\":\"8 MB Smart Cache\",\"7\":\"4.90 GHz\",\"8\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"9\":\"4 GT\\/s\",\"10\":\"16 GB\",\"11\":\"16 GB\",\"12\":\"LPDDR3\",\"13\":\"2133 MHz\",\"14\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"15\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"16\":\"512 GB\",\"17\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"18\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"19\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"20\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"21\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"22\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"23\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"24\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"25\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"26\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"27\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"28\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"29\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"30\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"31\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"32\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"33\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"34\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"35\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"36\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"37\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"38\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"39\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"40\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"41\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"42\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"43\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"44\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"45\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"46\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"47\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"48\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"49\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"50\":\"\\u0110ang c\\u1eadp nh\\u1eadt\",\"51\":\"\\u0110ang c\\u1eadp nh\\u1eadt\"}', '2020-08-19 04:36:11', '2020-08-19 04:36:11');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2020_07_20_160530_create_user_table', 1),
(4, '2020_07_20_160806_create_role_table', 1),
(5, '2020_07_20_161106_create_category_table', 1),
(6, '2020_07_20_161137_create_contact_user_table', 1),
(7, '2020_07_20_174524_create_product_table', 1),
(8, '2020_07_21_025400_create_role_use_table', 1),
(9, '2020_07_21_075812_create_order_table', 1),
(10, '2020_07_21_083234_create_order_product_table', 1),
(11, '2020_08_15_130427_create_detail_product_table', 1),
(12, '2020_08_22_172112_create_social_accounts_table', 1),
(13, '2020_09_01_124053_create_comment_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `total` bigint(20) NOT NULL,
  `date` date DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user_id`, `status`, `total`, `date`, `name`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 3, '0', 45980000, '2020-09-07', 'precure1999', NULL, NULL, '2020-09-07 10:18:52', '2020-09-07 10:18:54'),
(2, 1, '2', 2023120000, '2020-09-07', 'Kim Đạt Trần', '0907121212', 'đạt', '2020-09-07 10:19:04', '2020-09-07 12:12:35'),
(3, 4, '0', 15590000, '2020-09-07', 'đạt', '0909090911', '71', '2020-09-07 12:02:03', '2020-09-07 12:02:03'),
(4, 1, '1', 54990000, '2020-09-07', 'Kim Đạt Trần', '0999999123', '71', '2020-09-07 12:24:50', '2020-09-07 12:25:03');

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `amount` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`order_id`, `product_id`, `price`, `qty`, `amount`, `created_at`, `updated_at`) VALUES
(1, 46, 22990000, 2, 45980000, '2020-09-07 10:18:52', '2020-09-07 10:18:54'),
(2, 46, 22990000, 88, 2023120000, '2020-09-07 10:19:04', '2020-09-07 10:20:12'),
(3, 13, 15590000, 1, 15590000, '2020-09-07 12:00:39', '2020-09-07 12:02:03'),
(4, 48, 54990000, 1, 54990000, '2020-09-07 12:24:50', '2020-09-07 12:24:50');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `name`, `slug`, `price`, `status`, `image`, `created_at`, `updated_at`) VALUES
(10, 1, 'Dell        Inspiron N3593C i3 1005G1/4GB/256GB/15.6\"FHD//Win10', 'dell-inspiron-n3593c-i3-1005g1-4gb-256gb-15-6-fhd-win10', 1115000, '0', 'dell1.png', '2020-08-18 21:45:44', '2020-08-25 21:23:04'),
(12, 1, 'Dell Vostro V3490 i5 10210U/8Gb/256Gb/14\"FHD/Win 10', 'dell-vostro-v3490-i5-10210u-8gb-256gb-14-fhd-win-10', 15790000, '1', '637202275159473754_dell-vostro-v3490-den-dd.jpg', '2020-08-18 22:27:53', '2020-08-25 21:23:04'),
(13, 1, 'Dell Inspiron N3493 i5 1035G1/8Gb/256Gb/14FHD/Win 10', 'dell-inspiron-n3493-i5-1035g1-8gb-256gb-14fhd-win-10', 15590000, '1', '637105381512813186_dell-inspiron-n3493-bac-1.png', '2020-08-18 22:46:21', '2020-08-25 21:23:04'),
(14, 1, 'Dell Inspiron N5584/Core i5-8265U/4GB/N5I5384W', 'dell-inspiron-n5584-core-i5-8265u-4gb-n5i5384w', 17990000, '1', '636958490178802763_dell-inspiron-5584-1.png', '2020-08-18 23:05:43', '2020-08-25 21:23:04'),
(15, 9, 'MacBook Pro 16\" 2019 Touch Bar 2.6GHz Core i7 512GB', 'macbook-pro-16-2019-touch-bar-2-6ghz-core-i7-512gb', 59990000, '1', '637096945075833818_MBP-16-touch-xam-1.jpg', '2020-08-18 23:23:08', '2020-08-25 21:23:04'),
(16, 9, 'MacBook Pro 13\" 2020 Touch Bar 2.0GHz Core i5 1TB', 'macbook-pro-13-2020-touch-bar-2-0ghz-core-i5-1tb', 54990000, '1', '637269501976805113_mb-pro-13-2020-bac-1.png', '2020-08-18 23:54:04', '2020-08-25 21:23:04'),
(17, 9, 'MacBook Pro 13\" 2019 Touch Bar 2.4GHz Core i5 512GB', 'macbook-pro-13-2019-touch-bar-2-4ghz-core-i5-512gb', 48990000, '1', '636948950247111627_macbook-pro-13-touch-bar-2019-xam-1.png', '2020-08-18 23:58:34', '2020-08-25 21:23:04'),
(18, 9, 'MacBook Air 13\" 2020 1.1GHz Core i5 512GB', 'macbook-air-13-2020-1-1ghz-core-i5-512gb', 34990000, '1', '637207316420298149_macbook-air-2020-grey-1.png', '2020-08-19 00:02:09', '2020-08-25 21:23:04'),
(19, 9, 'MacBook Pro 16\" 2019 Touch Bar 2.3GHz Core i9 1TB', 'macbook-pro-16-2019-touch-bar-2-3ghz-core-i9-1tb', 69990000, '1', '637096970411885432_MBP-16-touch-bac-1.png', '2020-08-19 00:08:50', '2020-08-25 21:23:04'),
(20, 9, 'MacBook Pro 13\" 2020 Touch Bar 2.0GHz Core i5', 'macbook-pro-13-2020-touch-bar-2-0ghz-core-i5', 47990000, '1', '637281626465124878_macbook-pro-13-2020-1.jpg', '2020-08-19 00:14:05', '2020-08-25 21:23:04'),
(21, 11, 'ASUS Expertbook B9450FA-BM0616R i7 10510U/16GB /1TB SSD/14.0FHD/Win10', 'asus-expertbook-b9450fa-bm0616r-i7-10510u-16gb-1tb-ssd-14-0fhd-win10', 49990000, '1', '637329382449322991_ASUS-Expertbook-B9450FA-i7-slide-3.jpg', '2020-08-19 00:18:57', '2020-08-25 21:23:04'),
(22, 11, 'Asus ZenBook Duo UX481FL-BM048T i5 10210U/8GB/512GB SSD/MX250 2GB/WIN10', 'asus-zenbook-duo-ux481fl-bm048t-i5-10210u-8gb-512gb-ssd-mx250-2gb-win10', 30990000, '1', '637079670577323750_asus-zenbook-duo-7.jpg', '2020-08-19 00:22:41', '2020-08-25 21:23:04'),
(23, 11, 'Asus Zephyrus GA502IU-HN083T R7 4800HS/16GB/1TB SSD/GTX 1660Ti_6GB/Win10', 'asus-zephyrus-ga502iu-hn083t-r7-4800hs-16gb-1tb-ssd-gtx-1660ti-6gb-win10', 31990000, '1', '637257578736746180_Asus-Zephyrus-GA502IU-2.jpg', '2020-08-19 00:26:59', '2020-08-25 21:23:04'),
(24, 11, 'Asus Zephyrus GA502DU-AL038T/R7-3750H', 'asus-zephyrus-ga502du-al038t-r7-3750h', 29990000, '1', '637009655133838411_asus-zephyrus-ga502-1.png', '2020-08-19 00:31:11', '2020-08-25 21:23:04'),
(25, 11, 'ASUS Expertbook B9450FA-BM0324T i5 10210U/8GB/512GB SSD/Win10', 'asus-expertbook-b9450fa-bm0324t-i5-10210u-8gb-512gb-ssd-win10', 37990000, '1', '637287859743352847_asus-expertbook-b9450fa-den-4.png', '2020-08-19 00:37:01', '2020-08-25 21:23:04'),
(26, 13, 'Acer Nitro 5 AN515 54 779S i7 9750H/8GB/512GB/15.6\"FHD/GTX1660Ti 6GB/Win 10', 'acer-nitro-5-an515-54-779s-i7-9750h-8gb-512gb-15-6-fhd-gtx1660ti-6gb-win-10', 31990000, '1', '636994883263763784_acer-nitro-5-2019-den-1.png', '2020-08-19 00:40:53', '2020-08-25 21:23:04'),
(27, 13, 'Acer Triton PT515 52 72U2 i7 10875H/32GB/1T SSD/15.6 FHD IPS/RTX2080 8GB/Win 10', 'acer-triton-pt515-52-72u2-i7-10875h-32gb-1t-ssd-15-6-fhd-ips-rtx2080-8gb-win-10', 79990000, '1', '637279045555684230_acer-triton-pt515-52-den-2020-1.png', '2020-08-19 00:45:56', '2020-08-25 21:23:04'),
(28, 13, 'Acer Triton PT515 52 78PN i7 10875H/32GB/1T SSD/15.6 FHD IPS/RTX2070 8GB/Win 10', 'acer-triton-pt515-52-78pn-i7-10875h-32gb-1t-ssd-15-6-fhd-ips-rtx2070-8gb-win-10', 69990000, '1', '637297339099695860_acer-predator-triton-500-12.jpg', '2020-08-19 00:51:31', '2020-08-25 21:23:04'),
(29, 13, 'Acer Nitro AN515 55 70AX i7 10750H/8GB/512GB/15.6FHD/GTX1650Ti 4GB/Win 10', 'acer-nitro-an515-55-70ax-i7-10750h-8gb-512gb-15-6fhd-gtx1650ti-4gb-win-10', 29290000, '1', '637269534397957090_acer-nitro-5-an515-55-3.jpg', '2020-08-19 00:55:23', '2020-08-25 21:23:04'),
(30, 13, 'Acer Nitro AN515 55 73VQ i7 10750H/8GB/512GB/15.6\"FHD/GTX1650 4GB/Win 10', 'acer-nitro-an515-55-73vq-i7-10750h-8gb-512gb-15-6-fhd-gtx1650-4gb-win-10', 27790000, '1', '637249620078409073_acer-nitro-an515-55-den-1.png', '2020-08-19 00:59:10', '2020-08-25 21:23:04'),
(31, 14, 'HP Spectre x360 13 i7 1065G7/16GB/512GB SSD/13.3\" UHD/Intel UHD/W10', 'hp-spectre-x360-13-i7-1065g7-16gb-512gb-ssd-13-3-uhd-intel-uhd-w10', 47990000, '1', '637166887850659379_hp-spectre-x360-9.jpg', '2020-08-19 01:02:50', '2020-08-25 21:23:04'),
(32, 14, 'HP Pavilion Gaming 15 dk1075TX i7 10750H/8GB/512GB/15.6FHD/GTX1650Ti 4GB/15.6FHD/Win10', 'hp-pavilion-gaming-15-dk1075tx-i7-10750h-8gb-512gb-15-6fhd-gtx1650ti-4gb-15-6fhd-win10', 29990000, '1', '637322132736709615_hp-pavilion-gaming-15-dk-den-1.png', '2020-08-19 01:09:12', '2020-08-25 21:23:04'),
(33, 14, 'HP Envy x360 13 ay0069AU R7 4700U/8GB/256GB/13.3FHDTouch/Win 10+Office Home&Student', 'hp-envy-x360-13-ay0069au-r7-4700u-8gb-256gb-13-3fhdtouch-win-10-office-home-student', 27190000, '1', '637322161811322732_hp-envy-x360-13-ay-den-1.png', '2020-08-19 01:16:24', '2020-08-25 21:23:04'),
(34, 14, 'HP Envy 13-aq1023TU i7-10510U/8GB/512GB SSD/WIN10', 'hp-envy-13-aq1023tu-i7-10510u-8gb-512gb-ssd-win10', 27690000, '1', '637237709010992989_hp-envy-13-aq1021tu-vang-1.png', '2020-08-19 01:23:29', '2020-08-25 21:23:04'),
(35, 14, 'HP ENVY 13-aq0026TU/Core i5-8265U/8GB/256GB SSD/WIN10', 'hp-envy-13-aq0026tu-core-i5-8265u-8gb-256gb-ssd-win10', 21990000, '1', '636993834983120088_hp-envy-13-aq0026tu-1.png', '2020-08-19 01:26:36', '2020-08-25 21:23:04'),
(36, 14, 'HP Envy 13-aq1047TU i7 10510U/8G/512GSSD/WIN10', 'hp-envy-13-aq1047tu-i7-10510u-8g-512gssd-win10', 28490000, '1', '637237706063293364_HP-envy-13-go-2.jpg', '2020-08-19 01:30:17', '2020-08-25 21:23:04'),
(37, 15, 'MSI GS65 9SD i5 9300H/8GB/512GB/NV GTX 1660Ti 6GB/15.6\"FHD/Win 10', 'msi-gs65-9sd-i5-9300h-8gb-512gb-nv-gtx-1660ti-6gb-15-6-fhd-win-10', 34990000, '1', '637266257846492581_msi-gs65-9sd-6.jpg', '2020-08-19 03:23:16', '2020-08-25 21:23:04'),
(38, 15, 'MSI Alpha 15 A3DDK R7 3750H/8Gb/512Gb/RX 5500M 4Gb/15.6\"FHD/Win10', 'msi-alpha-15-a3ddk-r7-3750h-8gb-512gb-rx-5500m-4gb-15-6-fhd-win10', 25490000, '1', '637104680819384636_msi-alpha-15-den-1.png', '2020-08-19 03:27:33', '2020-08-25 21:23:04'),
(39, 15, 'MSI Modern 14 A10M i5-10210U/8Gb/256Gb/14\"FHD/Win10', 'msi-modern-14-a10m-i5-10210u-8gb-256gb-14-fhd-win10', 18490000, '1', '637109029683871886_msi-modern-14-7.jpg', '2020-08-19 03:33:13', '2020-08-25 21:23:04'),
(40, 15, 'MSI GF63 Thin 10SCXR-427VN i5 10300H/8Gb/512GB/GTX1650 MaxQ 4Gb/Win10', 'msi-gf63-thin-10scxr-427vn-i5-10300h-8gb-512gb-gtx1650-maxq-4gb-win10', 21990000, '1', '637263590299307533_msi-gf63-10scxr-11.jpg', '2020-08-19 03:36:49', '2020-08-25 21:23:04'),
(41, 15, 'MSI GF63 9SCXR i5 9300H/8GB/512GB/Intel HM370/NVA GTX1650 4GB/15.6\"FHD/Win 10', 'msi-gf63-9scxr-i5-9300h-8gb-512gb-intel-hm370-nva-gtx1650-4gb-15-6-fhd-win-10', 20990000, '1', '637000093289504897_msi-gf63-9rcx-1.png', '2020-08-19 03:40:31', '2020-08-25 21:23:04'),
(42, 16, 'Lenovo Legion Y540-15IRH i7 9750H/8GB/1TB SSD/Nvidia GTX1650 4G/Win10', 'lenovo-legion-y540-15irh-i7-9750h-8gb-1tb-ssd-nvidia-gtx1650-4g-win10', 25990000, '1', '637148686729968160_lenovo-legion-y540-den-1.png', '2020-08-19 03:45:37', '2020-08-25 21:23:04'),
(43, 16, 'Lenovo Ideapad L340-15IRH i7 9750H/8GB/512GB SSD/3GB GTX1050/WIN10', 'lenovo-ideapad-l340-15irh-i7-9750h-8gb-512gb-ssd-3gb-gtx1050-win10', 20990000, '1', '637252197636441857_lenovo-ideapad-l340-15irh-xanh-1.png', '2020-08-19 03:49:28', '2020-08-25 21:23:04'),
(44, 16, 'Lenovo Legion 5-15ARH05 R7 4800H/8GB/512GB SSD/4GB GTX1650/WIN10', 'lenovo-legion-5-15arh05-r7-4800h-8gb-512gb-ssd-4gb-gtx1650-win10', 24990000, '1', '637278451918991951_Lenovo-Legion-5-15ARH05-14.jpg', '2020-08-19 03:53:43', '2020-08-25 21:23:04'),
(45, 16, 'Lenovo Thinkpad E590/Core i5-8265U/8GB/512GB SSD/15.6FHD/VGA 2GB/WIN10', 'lenovo-thinkpad-e590-core-i5-8265u-8gb-512gb-ssd-15-6fhd-vga-2gb-win10', 19990000, '1', '637043147391240267_lenovo-thinkpad-e590-den-1.png', '2020-08-19 04:00:29', '2020-08-25 21:23:04'),
(46, 16, 'Lenovo Legion Y530-15ICH i5-8300H/8Gb/1Tb+ 128Gb SSD/GTX 1050 4Gb', 'lenovo-legion-y530-15ich-i5-8300h-8gb-1tb-128gb-ssd-gtx-1050-4gb', 22990000, '1', '636767772273353770_lenovo-legion-y530-2.jpg', '2020-08-19 04:04:03', '2020-08-25 21:23:04'),
(47, 9, 'MacBook Pro 13\" 2019 Touch Bar 2.4GHz Core i5 256GB', 'macbook-pro-13-2019-touch-bar-2-4ghz-core-i5-256gb', 41990000, '1', '636955228494210061_macbook-pro-13-touchbar-2019-7.jpg', '2020-08-19 04:18:15', '2020-08-25 21:23:04'),
(48, 1, 'Dell XPS13 7390 i7-10510U/16Gb/512Gb/13.3\"UHDT/Win 10/Office 365', 'dell-xps13-7390-i7-10510u-16gb-512gb-13-3-uhdt-win-10-office-365', 54990000, '1', '637193611443679358_dell-xps13-7390-bac-1.png', '2020-08-19 04:28:04', '2020-08-25 21:23:04');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, NULL),
(2, 'nhân viên', '2020-09-07 10:19:26', '2020-09-07 10:19:26');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL),
(2, 2, '2020-09-07 10:19:31', '2020-09-07 10:19:31');

-- --------------------------------------------------------

--
-- Table structure for table `social_accounts`
--

CREATE TABLE `social_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_accounts`
--

INSERT INTO `social_accounts` (`id`, `provider_id`, `provider`, `name`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '108254808577099211452', 'google', NULL, 1, '2020-09-07 10:14:21', '2020-09-07 10:14:21'),
(2, '68258223', 'github', NULL, 3, '2020-09-07 10:18:42', '2020-09-07 10:18:42');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `phone`, `address`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Kim Đạt Trần', 'kimdat1999@gmail.com', NULL, NULL, 'nghiahiep', '2020-09-07 10:14:21', '2020-09-07 10:14:21'),
(2, 'thanh A', 'kimdat2304@gmail.com', '0909090909', '71', 'NGHIAHIEP', '2020-09-07 10:18:21', '2020-09-07 10:18:21'),
(3, 'precure1999', 'kimdat1307@gmail.com', NULL, NULL, NULL, '2020-09-07 10:18:42', '2020-09-07 10:18:42'),
(4, 'đạt', 'kimdat19991@gmail.com', '0909090911', '71', 'nghiahiep', '2020-09-07 12:02:03', '2020-09-07 12:02:03'),
(5, 'đa', 'kimdat1991239@gmail.com', '0909090971', '71', 'nghiahiep', '2020-09-07 12:33:34', '2020-09-07 12:33:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_user_id_foreign` (`user_id`),
  ADD KEY `comment_product_id_foreign` (`product_id`);

--
-- Indexes for table `contact_user`
--
ALTER TABLE `contact_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_product`
--
ALTER TABLE `detail_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_product_product_id_foreign` (`product_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_user_id_index` (`user_id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `order_product_product_id_foreign` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_category_id_index` (`category_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `social_accounts`
--
ALTER TABLE `social_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `social_accounts_user_id_foreign` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email_unique` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_user`
--
ALTER TABLE `contact_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detail_product`
--
ALTER TABLE `detail_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `social_accounts`
--
ALTER TABLE `social_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `detail_product`
--
ALTER TABLE `detail_product`
  ADD CONSTRAINT `detail_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_product_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `social_accounts`
--
ALTER TABLE `social_accounts`
  ADD CONSTRAINT `social_accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
