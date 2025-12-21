-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2025 at 09:16 AM
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
-- Database: `luvleen`
--

-- --------------------------------------------------------

--
-- Table structure for table `achievements`
--

CREATE TABLE `achievements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `countTxt` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `achievements`
--

INSERT INTO `achievements` (`id`, `title`, `countTxt`, `created_at`, `updated_at`) VALUES
(3, 'Happy Client', '750', '2025-07-14 23:00:16', '2025-07-14 23:00:16'),
(4, 'Our Experts', '200', '2025-07-14 23:00:29', '2025-07-14 23:00:29'),
(5, 'Project', '105', '2025-07-14 23:00:47', '2025-07-14 23:00:47'),
(6, 'Our Brances', '10', '2025-07-14 23:01:02', '2025-07-14 23:01:02');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `service_category_id` bigint(20) NOT NULL,
  `message` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `name`, `phone`, `type`, `service_category_id`, `message`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Dorothy Knowles', '+1 (491) 136-3231', '4BHK', 6, 'Sapiente consectetur', 0, '2025-07-20 08:10:39', '2025-07-20 08:10:39');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(100) NOT NULL DEFAULT 'home',
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `btn_txt` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `type`, `title`, `subtitle`, `image`, `btn_txt`, `link`, `status`, `created_at`, `updated_at`) VALUES
(3, 'home', 'PEST CONTROL SERVICES', 'Post-ironic authentic drinking vinegar chambray quinoa. VHS letterpress sriracha, tacos skateboard migas farm-to-table artisan kombucha.', 'upload/banners/2025/Jul/15/d40b9f90ba6df5e4c75b0faadfceed73.jpg', 'Read More', NULL, 'active', '2025-07-14 19:24:02', '2025-07-14 19:24:02'),
(4, 'home', 'BEST SERVICE PROVIDE', 'Post-ironic authentic drinking vinegar chambray quinoa. VHS letterpress sriracha, tacos skateboard migas farm-to-table artisan kombucha.', 'upload/banners/2025/Jul/15/6fc7edbafb0dca2cf146042824e3ecf1.jpg', 'Read More', NULL, 'active', '2025-07-14 19:25:49', '2025-07-14 19:25:49'),
(5, 'about', 'About US', NULL, 'upload/banners/2025/Jul/15/eb571e93a7c6300cac0f4644af9c2a7b.jpg', NULL, NULL, 'active', '2025-07-14 19:31:36', '2025-07-14 19:31:36'),
(6, 'services', 'Services', NULL, 'upload/banners/2025/Jul/15/fae74a8f3931a6a64782a960d41d10b6.jpg', NULL, NULL, 'active', '2025-07-14 19:32:15', '2025-07-14 19:32:15'),
(7, 'branchs', 'Our Braches', NULL, 'upload/banners/2025/Jul/15/46eba1c91bdc03ea30e04c50193f2323.jpg', NULL, NULL, 'active', '2025-07-14 19:33:11', '2025-07-14 19:33:12'),
(8, 'cobweb', 'Cobweb Cleaning', NULL, 'upload/banners/2025/Jul/15/d624d0954553bf0eee72f1540ee9aa64.jpg', NULL, NULL, 'active', '2025-07-14 19:33:55', '2025-07-14 19:33:55'),
(9, 'blogs', 'Our Blogs', NULL, 'upload/banners/2025/Jul/15/78e0a7555996a8db4ff6a30758d4b247.jpg', NULL, NULL, 'active', '2025-07-14 19:34:37', '2025-07-14 19:34:37'),
(10, 'contact', 'Contact US', NULL, 'upload/banners/2025/Jul/15/6aa5668e1cb05a05ba890561c06b162a.jpg', NULL, NULL, 'active', '2025-07-14 19:35:17', '2025-07-14 19:35:17');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `short_desc` text DEFAULT NULL,
  `long_desc` longtext DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `slug`, `cover_image`, `image`, `short_desc`, `long_desc`, `content`, `created_at`, `updated_at`) VALUES
(1, 'Expert Cleaning Services for Homes and Offices', 'expert-cleaning-services-for-homes-and-offices', 'upload/blogs/2025/Jul/20/80455d16b9d8059b0f7da78198c3e7c9.jpg', 'upload/blogs/2025/Jul/20/685c251e62e7e065f33e76464642f940.jpg', '<p><span style=\"color: rgb(108, 117, 125); font-family: Lato, sans-serif; text-align: justify; background-color: rgb(247, 248, 250);\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span></p>', '<p><span style=\"color: rgb(108, 117, 125); font-family: Lato, sans-serif; text-align: justify; background-color: rgb(247, 248, 250);\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span></p>', '<p style=\"margin-bottom: 24px; line-height: 24px; text-align: justify; color: rgb(108, 117, 125); font-family: Lato, sans-serif; background-color: rgb(247, 248, 250);\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen It has urvived not only five centuries, but also the leap into electronic typesetting.</p><blockquote style=\"margin: 40px 0px; padding: 16px 20px 16px 80px; font-size: 18px; font-style: italic; color: rgb(85, 85, 85); line-height: 30px; position: relative; background: rgb(246, 246, 246); clear: both; border-left-width: 4px; border-color: rgb(247, 148, 29); font-family: Lato, sans-serif;\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Has been the industry\'s standard text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimencenturies.</blockquote><p style=\"margin-bottom: 24px; line-height: 24px; text-align: justify; color: rgb(108, 117, 125); font-family: Lato, sans-serif; background-color: rgb(247, 248, 250);\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen It has urvived not only five centuries, but also the leap into electronic typesetting.</p><h5 style=\"margin-bottom: 10px; font-weight: 600; line-height: 22px; font-size: 16px; color: rgb(33, 37, 41); font-family: Nunito, sans-serif; background-color: rgb(247, 248, 250);\">Completely Responsive</h5><img class=\"alignleft\" width=\"300\" src=\"http://localhost:8000/assets/frontend/images/blog/grid/pic4.jpg\" alt=\"\" style=\"height: auto; max-width: 100%; float: left; margin: 5px 25px 20px 0px; color: rgb(108, 117, 125); font-family: Lato, sans-serif; background-color: rgb(247, 248, 250);\"><p style=\"margin-bottom: 24px; line-height: 24px; text-align: justify; color: rgb(108, 117, 125); font-family: Lato, sans-serif; background-color: rgb(247, 248, 250);\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the releasefive centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release</p><div class=\"divider bg-gray-dark\" style=\"background-color: rgb(211, 211, 211); height: 1px; position: relative; margin: 30px 0px; color: rgb(108, 117, 125); font-family: Lato, sans-serif;\"></div><img class=\"alignright\" width=\"300\" src=\"http://localhost:8000/assets/frontend/images/blog/grid/pic1.jpg\" alt=\"\" style=\"height: auto; max-width: 100%; float: right; margin: 5px 0px 25px 25px; color: rgb(108, 117, 125); font-family: Lato, sans-serif; background-color: rgb(247, 248, 250);\"><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; line-height: 24px; text-align: justify; color: rgb(108, 117, 125); font-family: Lato, sans-serif; background-color: rgb(247, 248, 250);\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release</p>', '2025-07-20 04:12:18', '2025-07-20 04:54:47'),
(2, 'Reliable Cleaning Solutions Tailored to Your Needs', 'reliable-cleaning-solutions-tailored-to-your-needs', 'upload/blogs/2025/Jul/20/44566baad937239c15d3d8f59ad76ad3.jpg', NULL, '<p><span style=\"color: rgb(108, 117, 125); font-family: Lato, sans-serif; text-align: justify; background-color: rgb(247, 248, 250);\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span></p>', '<p><span style=\"color: rgb(108, 117, 125); font-family: Lato, sans-serif; text-align: justify; background-color: rgb(247, 248, 250);\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span></p>', '<p style=\"margin-bottom: 24px; line-height: 24px; text-align: justify; color: rgb(108, 117, 125); font-family: Lato, sans-serif; background-color: rgb(247, 248, 250);\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen It has urvived not only five centuries, but also the leap into electronic typesetting.</p><blockquote style=\"margin: 40px 0px; padding: 16px 20px 16px 80px; font-size: 18px; font-style: italic; color: rgb(85, 85, 85); line-height: 30px; position: relative; background: rgb(246, 246, 246); clear: both; border-left-width: 4px; border-color: rgb(247, 148, 29); font-family: Lato, sans-serif;\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Has been the industry\'s standard text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimencenturies.</blockquote><p style=\"margin-bottom: 24px; line-height: 24px; text-align: justify; color: rgb(108, 117, 125); font-family: Lato, sans-serif; background-color: rgb(247, 248, 250);\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen It has urvived not only five centuries, but also the leap into electronic typesetting.</p><h5 style=\"margin-bottom: 10px; font-weight: 600; line-height: 22px; font-size: 16px; color: rgb(33, 37, 41); font-family: Nunito, sans-serif; background-color: rgb(247, 248, 250);\">Completely Responsive</h5><p><img class=\"alignleft\" width=\"300\" src=\"http://localhost:8000/assets/frontend/images/blog/grid/pic4.jpg\" alt=\"\" style=\"height: auto; max-width: 100%; float: left; margin: 5px 25px 20px 0px; color: rgb(108, 117, 125); font-family: Lato, sans-serif; background-color: rgb(247, 248, 250);\"></p><p style=\"margin-bottom: 24px; line-height: 24px; text-align: justify; color: rgb(108, 117, 125); font-family: Lato, sans-serif; background-color: rgb(247, 248, 250);\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the releasefive centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release</p><div class=\"divider bg-gray-dark\" style=\"background-color: rgb(211, 211, 211); height: 1px; position: relative; margin: 30px 0px; color: rgb(108, 117, 125); font-family: Lato, sans-serif;\"></div><p><img class=\"alignright\" width=\"300\" src=\"http://localhost:8000/assets/frontend/images/blog/grid/pic1.jpg\" alt=\"\" style=\"height: auto; max-width: 100%; float: right; margin: 5px 0px 25px 25px; color: rgb(108, 117, 125); font-family: Lato, sans-serif; background-color: rgb(247, 248, 250);\"></p><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; line-height: 24px; text-align: justify; color: rgb(108, 117, 125); font-family: Lato, sans-serif; background-color: rgb(247, 248, 250);\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release</p>', '2025-07-20 04:59:52', '2025-07-20 04:59:52'),
(3, 'Effortless Cleaning for a Healthier Environment', 'effortless-cleaning-for-a-healthier-environment', 'upload/blogs/2025/Jul/20/eafb3f341154b5e73e42b054d7aee17e.jpg', NULL, '<p><span style=\"color: rgb(108, 117, 125); font-family: Lato, sans-serif; text-align: justify; background-color: rgb(247, 248, 250);\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span></p>', '<p><span style=\"color: rgb(108, 117, 125); font-family: Lato, sans-serif; text-align: justify; background-color: rgb(247, 248, 250);\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span></p>', '<p style=\"margin-bottom: 24px; line-height: 24px; text-align: justify; color: rgb(108, 117, 125); font-family: Lato, sans-serif; background-color: rgb(247, 248, 250);\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen It has urvived not only five centuries, but also the leap into electronic typesetting.</p><blockquote style=\"margin: 40px 0px; padding: 16px 20px 16px 80px; font-size: 18px; font-style: italic; color: rgb(85, 85, 85); line-height: 30px; position: relative; background: rgb(246, 246, 246); clear: both; border-left-width: 4px; border-color: rgb(247, 148, 29); font-family: Lato, sans-serif;\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Has been the industry\'s standard text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimencenturies.</blockquote><p style=\"margin-bottom: 24px; line-height: 24px; text-align: justify; color: rgb(108, 117, 125); font-family: Lato, sans-serif; background-color: rgb(247, 248, 250);\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen It has urvived not only five centuries, but also the leap into electronic typesetting.</p><h5 style=\"margin-bottom: 10px; font-weight: 600; line-height: 22px; font-size: 16px; color: rgb(33, 37, 41); font-family: Nunito, sans-serif; background-color: rgb(247, 248, 250);\">Completely Responsive</h5><p><img class=\"alignleft\" width=\"300\" src=\"http://localhost:8000/assets/frontend/images/blog/grid/pic4.jpg\" alt=\"\" style=\"height: auto; max-width: 100%; float: left; margin: 5px 25px 20px 0px; color: rgb(108, 117, 125); font-family: Lato, sans-serif; background-color: rgb(247, 248, 250);\"></p><p style=\"margin-bottom: 24px; line-height: 24px; text-align: justify; color: rgb(108, 117, 125); font-family: Lato, sans-serif; background-color: rgb(247, 248, 250);\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the releasefive centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release</p><div class=\"divider bg-gray-dark\" style=\"background-color: rgb(211, 211, 211); height: 1px; position: relative; margin: 30px 0px; color: rgb(108, 117, 125); font-family: Lato, sans-serif;\"></div><p><img class=\"alignright\" width=\"300\" src=\"http://localhost:8000/assets/frontend/images/blog/grid/pic1.jpg\" alt=\"\" style=\"height: auto; max-width: 100%; float: right; margin: 5px 0px 25px 25px; color: rgb(108, 117, 125); font-family: Lato, sans-serif; background-color: rgb(247, 248, 250);\"></p><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; line-height: 24px; text-align: justify; color: rgb(108, 117, 125); font-family: Lato, sans-serif; background-color: rgb(247, 248, 250);\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release</p>', '2025-07-20 05:01:03', '2025-07-20 05:01:03'),
(4, 'Your Go-To Cleaning Experts for All Spaces', 'your-go-to-cleaning-experts-for-all-spaces', 'upload/blogs/2025/Jul/20/26306d9932f122010b22033e2db5bf96.jpg', NULL, '<p><span style=\"color: rgb(108, 117, 125); font-family: Lato, sans-serif; text-align: justify; background-color: rgb(247, 248, 250);\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span></p>', '<p><span style=\"color: rgb(108, 117, 125); font-family: Lato, sans-serif; text-align: justify; background-color: rgb(247, 248, 250);\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span></p>', '<p style=\"margin-bottom: 24px; line-height: 24px; text-align: justify; color: rgb(108, 117, 125); font-family: Lato, sans-serif; background-color: rgb(247, 248, 250);\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen It has urvived not only five centuries, but also the leap into electronic typesetting.</p><blockquote style=\"margin: 40px 0px; padding: 16px 20px 16px 80px; font-size: 18px; font-style: italic; color: rgb(85, 85, 85); line-height: 30px; position: relative; background: rgb(246, 246, 246); clear: both; border-left-width: 4px; border-color: rgb(247, 148, 29); font-family: Lato, sans-serif;\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Has been the industry\'s standard text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimencenturies.</blockquote><p style=\"margin-bottom: 24px; line-height: 24px; text-align: justify; color: rgb(108, 117, 125); font-family: Lato, sans-serif; background-color: rgb(247, 248, 250);\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen It has urvived not only five centuries, but also the leap into electronic typesetting.</p><h5 style=\"margin-bottom: 10px; font-weight: 600; line-height: 22px; font-size: 16px; color: rgb(33, 37, 41); font-family: Nunito, sans-serif; background-color: rgb(247, 248, 250);\">Completely Responsive</h5><p><img class=\"alignleft\" width=\"300\" src=\"http://localhost:8000/assets/frontend/images/blog/grid/pic4.jpg\" alt=\"\" style=\"height: auto; max-width: 100%; float: left; margin: 5px 25px 20px 0px; color: rgb(108, 117, 125); font-family: Lato, sans-serif; background-color: rgb(247, 248, 250);\"></p><p style=\"margin-bottom: 24px; line-height: 24px; text-align: justify; color: rgb(108, 117, 125); font-family: Lato, sans-serif; background-color: rgb(247, 248, 250);\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the releasefive centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release</p><div class=\"divider bg-gray-dark\" style=\"background-color: rgb(211, 211, 211); height: 1px; position: relative; margin: 30px 0px; color: rgb(108, 117, 125); font-family: Lato, sans-serif;\"></div><p><img class=\"alignright\" width=\"300\" src=\"http://localhost:8000/assets/frontend/images/blog/grid/pic1.jpg\" alt=\"\" style=\"height: auto; max-width: 100%; float: right; margin: 5px 0px 25px 25px; color: rgb(108, 117, 125); font-family: Lato, sans-serif; background-color: rgb(247, 248, 250);\"></p><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; line-height: 24px; text-align: justify; color: rgb(108, 117, 125); font-family: Lato, sans-serif; background-color: rgb(247, 248, 250);\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release</p>', '2025-07-20 05:02:26', '2025-07-20 05:02:26');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `note` text DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `map_link` text DEFAULT NULL,
  `is_main_office` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `note`, `address`, `phone`, `email`, `map_link`, `is_main_office`, `created_at`, `updated_at`) VALUES
(4, 'Banglore', 'If you have any questions simply use the following contact details.', '63, Sai Nilayam, 4th Cross, Ramamurthy Nagar, Bangalore 560036', '8217602376', 'enquiry@luvleen.com', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31098.827658352264!2d77.66024811124404!3d13.01314913756798!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae11a35e29b47f%3A0x50e41e923765c808!2sSri%20Sai%20nilayam!5e0!3m2!1sen!2sin!4v1751055118160!5m2!1sen!2sin', 0, '2025-07-19 05:24:53', '2025-07-19 05:24:53'),
(5, 'Hydrabad', 'If you have any questions simply use the following contact details.', '96/A, Banja Hill, 4th Cross, Ramamurthy Nagar, Hydrabad 400007', '+8217602376', 'enquiry@luvleen.com', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31098.827658352264!2d77.66024811124404!3d13.01314913756798!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae11a35e29b47f%3A0x50e41e923765c808!2sSri%20Sai%20nilayam!5e0!3m2!1sen!2sin!4v1751055118160!5m2!1sen!2sin', 1, '2025-07-19 05:26:32', '2025-07-19 05:45:25');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `image`, `link`, `created_at`, `updated_at`) VALUES
(3, 'Retro', 'upload/brands/2025/Jul/15/6c4b3264c31fee0fbff262f8f1a80965.jpg', NULL, '2025-07-14 22:20:03', '2025-07-14 22:20:03'),
(4, 'RetroLogo', 'upload/brands/2025/Jul/15/0aec9f672b82e9b2f16f40237bc9ff56.jpg', NULL, '2025-07-14 22:21:02', '2025-07-14 22:21:53'),
(5, 'Authentic', 'upload/brands/2025/Jul/15/9f1aaf4d71a01456614032a61b73a6c0.jpg', NULL, '2025-07-14 22:21:32', '2025-07-14 22:21:32'),
(6, 'Tne Retro logo', 'upload/brands/2025/Jul/15/534f58c14b66f9e4cc1ff34ac9561391.jpg', NULL, '2025-07-14 22:22:24', '2025-07-14 22:22:24');

-- --------------------------------------------------------

--
-- Table structure for table `cob_webs`
--

CREATE TABLE `cob_webs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cob_web_items`
--

CREATE TABLE `cob_web_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cobweb_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_says`
--

CREATE TABLE `customer_says` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_says`
--

INSERT INTO `customer_says` (`id`, `name`, `location`, `message`, `image`, `created_at`, `updated_at`) VALUES
(3, 'Sony Matin', 'Banglore', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the when an printer took a galley of type and scrambled it to make', 'upload/customersay/2025/Jul/15/5027b31ac5f423510351ad0b21254595.jpg', '2025-07-14 22:53:39', '2025-07-14 22:53:39'),
(4, 'David Singh', 'Banglore', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the when an printer took a galley of type and scrambled it to make', 'upload/customersay/2025/Jul/15/d250cd231ea835bc6702d40ae77881b4.jpg', '2025-07-14 22:54:41', '2025-07-14 22:54:41');

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enquiries`
--

INSERT INTO `enquiries` (`id`, `name`, `email`, `phone`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Imelda Alexander', 'defejyr@mailinator.com', '+1 (808) 782-5959', NULL, '2025-07-19 07:16:40', '2025-07-19 07:16:40'),
(2, 'Ifeoma Garrison', 'cozilecyza@mailinator.com', '+1 (458) 593-7298', 'Quis nihil ullamco c', '2025-07-19 07:19:35', '2025-07-19 07:19:35'),
(3, 'James Keith', 'nuwy@mailinator.com', '+1 (759) 385-9155', 'Rem aut quo ipsam ne', '2025-07-19 07:20:15', '2025-07-19 07:20:15');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'site_phone', '+91-8217602376', '2025-07-03 10:50:22', '2025-07-17 10:38:13'),
(2, 'site_email', 'enquiry@luvleen.com', '2025-07-03 10:50:22', '2025-07-17 10:38:13'),
(3, 'site_ofc_time', '(24/7 Support Line)', '2025-07-03 10:50:22', '2025-07-17 10:38:13'),
(4, 'site_facebook', 'https://cyberchimp.in/c_demo/luvleen2/index.html', '2025-07-03 10:50:22', '2025-07-03 10:50:22'),
(5, 'site_twitter', 'https://cyberchimp.in/c_demo/luvleen2/index.html', '2025-07-03 10:50:22', '2025-07-03 10:50:22'),
(6, 'site_linkedin', 'https://cyberchimp.in/c_demo/luvleen2/index.html', '2025-07-03 10:50:22', '2025-07-03 10:50:22'),
(7, 'site_gplus', 'https://cyberchimp.in/c_demo/luvleen2/index.html', '2025-07-03 10:50:22', '2025-07-03 10:50:22'),
(8, 'testimonials_heading', 'Satisfaction Guaranteed', '2025-07-04 10:34:15', '2025-07-04 10:34:51'),
(9, 'testimonials_description', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry has been the industry\'s standard dummy text ever since the been when an unknown printer.', '2025-07-04 10:34:15', '2025-07-04 10:34:51'),
(10, 'whychooseus_heading', 'Why CHose US', '2025-07-04 11:16:00', '2025-07-14 22:26:58'),
(11, 'whychooseus_description', 'Luvleen Services is a pioneer brand in providing pest control in all over India serving proficiently for decades', '2025-07-04 11:16:00', '2025-07-14 22:26:58'),
(12, 'achievements_heading', 'Our Achievement', '2025-07-07 09:11:04', '2025-07-07 09:11:04'),
(13, 'achievements_description', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry has been the industry\'s standard dummy text ever since the been when an unknown printer.', '2025-07-07 09:11:04', '2025-07-07 09:11:04'),
(14, 'about_title', 'About Us', '2025-07-07 10:01:00', '2025-07-07 10:01:00'),
(15, 'about_sort_description', '<b>Luvleen Services</b> has been a trusted name in pest control across India for decades. Known for our professionalism and expertise, we have built a strong reputation and a loyal customer base.', '2025-07-07 10:01:00', '2025-07-07 10:07:21'),
(16, 'about_description', '<h2 class=\"text-uppercase font-35 p-r50\">\r\n                                    Flick Out the Waste, Keep the Workspace Clean</h2>\r\n                                <p>Luvleen Services has been a trusted name in pest control across India for decades. Known\r\n                                    for our professionalism and expertise, we have built a strong reputation and a loyal\r\n                                    customer base. Our services span residential and industrial sectors, including\r\n                                    commercial spaces, hotels and restaurants, healthcare facilities, hospitality, food and\r\n                                    beverage industries, and more. With years of dedicated service, we continue to protect\r\n                                    homes and businesses with reliable, effective pest control solutions.</p>\r\n                                <h2 class=\"text-uppercase font-35 p-r50\">Our Vission</h2>\r\n                                <p>Our vision is to become the number one pest control service provider in India and spark\r\n                                    vivaciousness in the Industry with our high-quality services and utmost professionalism.\r\n                                </p>\r\n                                <h2 class=\"text-uppercase font-35 p-r50\">Our Mission</h2>\r\n                                <p>To Provide high quality of Services to all our clients and make continuous improvement.\r\n                                    maintain customer satisfaction is the prime goal.</p>\r\n                                <h2 class=\"text-uppercase font-35 p-r50\"> Our Value</h2>\r\n                                <ul class=\"list-check-circle primary\">\r\n                                    <li>1. We maintain a high level of Professionalism</li>\r\n                                    <li>2. We understand your needs</li>\r\n                                    <li>3. We provide the best class quality</li>\r\n                                    <li>4. We are committed to achieving the goal</li>\r\n                                    <li>5. We value money</li>\r\n                                </ul>', '2025-07-07 10:01:00', '2025-07-19 08:43:23'),
(17, 'about_image', 'upload/setting_images/2025/Jul/19/9dbbf424544ce82fe7cb27d32c720428.png', '2025-07-07 10:01:00', '2025-07-19 08:41:26'),
(18, 'service_heading', 'Our Service', '2025-07-08 12:15:11', '2025-07-08 12:15:11'),
(19, 'service_description', 'We help you to free your house from creepy-crawlies.', '2025-07-08 12:15:11', '2025-07-19 11:14:52'),
(20, 'book_appoinment_txt', '“ EXPERIENCE THE BEST QUALITY SERVICE ”', '2025-07-20 03:28:49', '2025-07-20 03:28:49'),
(21, 'book_appoinment_btn_txt', 'Book An Appoinment', '2025-07-20 03:28:49', '2025-07-20 03:28:49');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(10, '2023_08_21_131702_create_permission_tables', 1),
(11, '2024_07_20_141211_create_blogs_table', 1),
(12, '2024_07_21_045420_create_enquiries_table', 1),
(13, '2024_07_21_063821_create_payments_table', 1),
(14, '2024_02_01_083447_create_general_settings_table', 2),
(15, '2025_07_04_045957_create_service_categories_table', 3),
(16, '2025_07_04_071441_create_banners_table', 4),
(17, '2025_07_04_072746_create_why_choose_us_table', 4),
(18, '2025_07_04_073724_create_customer_says_table', 5),
(19, '2025_07_04_074355_create_achievements_table', 6),
(20, '2025_07_04_074847_create_brands_table', 7),
(21, '2025_07_04_075452_create_satisfaction_guaranteeds_table', 8),
(22, '2025_07_04_080649_create_branches_table', 8),
(23, '2025_07_04_081728_create_social_links_table', 8),
(24, '2025_07_04_091413_create_services_table', 9),
(25, '2025_07_04_091642_create_service_items_table', 9),
(26, '2025_07_20_090310_create_appointments_table', 10),
(27, '2025_07_20_111326_create_cob_webs_table', 11),
(28, '2025_07_20_111343_create_cob_web_items_table', 11),
(29, '2025_07_20_111543_create_galleries_table', 11),
(30, '2025_07_20_183820_create_tracking_scripts_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('128999db411c4ed2175fbc8e8c5901ce6cca3533ab3f73ac04abf3f1871a915d52ee9b2119dc6db5', 1, '9f4d9410-5a03-4661-852c-27a64f8e86c2', 'MyApp', '[]', 1, '2025-07-03 09:43:52', '2025-07-03 09:53:06', '2026-07-03 15:13:52'),
('37bc0091f3421ef300e9cfc5f9ba94c30f2349535ef5e317810ed6a89a2bcb6929cab42aaea0461f', 1, '9f4d9410-5a03-4661-852c-27a64f8e86c2', 'MyApp', '[]', 0, '2025-07-03 09:41:02', '2025-07-03 09:41:02', '2026-07-03 15:11:02'),
('5df5555eef58372457444f1df01c68ab6d0aa02f7b070eab5e9bf2434e98fc57a61e0506ffe2ce1e', 1, '9f4d9410-5a03-4661-852c-27a64f8e86c2', 'MyApp', '[]', 0, '2025-07-03 09:53:18', '2025-07-03 09:53:18', '2026-07-03 15:23:18'),
('69b3c659089e70234ef2962352f6ded372f68bb4d09263f3590a2fbec0428ddbefee8606f89b9d21', 1, '9f4d9410-5a03-4661-852c-27a64f8e86c2', 'MyApp', '[]', 0, '2025-07-04 00:43:56', '2025-07-04 00:43:56', '2026-07-04 06:13:56'),
('beea8db791fdc852d3e20b61e657bccad1ace0de618ffd5349b882fb11c06bdd9253db67788e1865', 1, '9f4d9410-5a03-4661-852c-27a64f8e86c2', 'MyApp', '[]', 1, '2025-07-03 09:41:21', '2025-07-03 09:43:48', '2026-07-03 15:11:21');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` char(36) NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` char(36) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
('9f4d9410-5a03-4661-852c-27a64f8e86c2', NULL, 'Luvleen Personal Access Client', 'tAVKRrvU06TzgXBIfSCDjpKXEMam7bSXXYGQgk50', NULL, 'http://localhost', 1, 0, 0, '2025-07-03 09:40:53', '2025-07-03 09:40:53'),
('9f4d9410-5f11-4788-96f2-c378cf494fb4', NULL, 'Luvleen Password Grant Client', 'uwNbUCBajIk6jdgmlFjstN2dpWG7lvSRnHv41MvQ', 'users', 'http://localhost', 0, 1, 0, '2025-07-03 09:40:53', '2025-07-03 09:40:53');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, '9f4d9410-5a03-4661-852c-27a64f8e86c2', '2025-07-03 09:40:53', '2025-07-03 09:40:53');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `amount` decimal(8,2) DEFAULT NULL,
  `status` enum('pending','process','success','failed') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `satisfaction_guaranteeds`
--

CREATE TABLE `satisfaction_guaranteeds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `satisfaction_guaranteeds`
--

INSERT INTO `satisfaction_guaranteeds` (`id`, `title`, `description`, `icon`, `link`, `created_at`, `updated_at`) VALUES
(3, 'Team and Expertise', 'Our team consists of highly trained and certified pest control professionals who are dedicated to staying updated on the latest industry trends and technologies.', 'fa fa-users', NULL, '2025-07-14 22:30:23', '2025-07-14 22:30:23'),
(4, 'Customer Satisfaction', 'At Pest control HS, customer satisfaction is our top priority. We pride ourselves on transparent communication, prompt service, and effective results.', 'fa fa-smile', NULL, '2025-07-14 22:31:17', '2025-07-14 22:31:17'),
(5, 'Environmentally Friendly', 'Pest control HS is committed to using eco-friendly and low-toxicity products  whenever possible.', 'fa fa-tree', NULL, '2025-07-14 22:32:00', '2025-07-14 22:32:00'),
(6, 'Post-Treatment Inspection', 'After the treatment, we conduct a post-treatment inspection to ensure the complete elimination of pests.', 'fa fa-thumbs-up', NULL, '2025-07-14 22:32:56', '2025-07-14 22:32:56'),
(7, 'No Subcontract', 'Professional in-house Pest control Experts', 'fa fa-user-check', NULL, '2025-07-14 22:34:23', '2025-07-14 22:34:23'),
(8, 'Happy Clients', '50K+ Happy Customers in Bangalore', 'fa fa-handshake', NULL, '2025-07-14 22:35:04', '2025-07-14 22:35:04');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` enum('service','cobweb') NOT NULL DEFAULT 'service',
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `category_id`, `type`, `name`, `slug`, `description`, `cover_image`, `image`, `created_at`, `updated_at`) VALUES
(1, 6, 'service', 'Cockroach Pest Control', 'cockroach-pest-control', 'Cockroaches are among the most common household pests, and effective pest control is essential to manage them. Despite their small size, they pose a serious threat to public health by spreading harmful bacteria and allergens.', 'upload/services/2025/Jul/19/7b012a169bee6d0193f39cf0e31e5a89.jpg', 'upload/services/2025/Jul/19/567bc8e73c9ddbe09904dd3c77f1320a.png', '2025-07-19 12:52:11', '2025-07-19 13:49:47'),
(2, 6, 'service', 'Termite Control', 'termite-control', 'We provide top-notch Termite Control services across India at affordable rates. Enjoy a free inspection with no hidden charges at all! Get exclusive discounts along with a 10-year warranty on our effective Anti-Termite Treatment.', 'upload/services/2025/Jul/19/5877d9872fdfb07ba8567166ca5262f9.jpg', 'upload/services/2025/Jul/19/092b1b0e7fd8a27c9f597fbad71d1a92.png', '2025-07-19 13:28:42', '2025-07-19 13:48:45'),
(3, 6, 'service', 'Mosquito Control', 'mosquito-control', 'Mosquitoes are widely known for causing red, itchy bites resulting from an allergic reaction to their saliva. However, their impact goes far beyond irritation. These tiny pests are capable of transmitting life-threatening diseases.', 'upload/services/2025/Jul/19/a871722abba6c37ecd2b30ef0f7703f5.jpg', 'upload/services/2025/Jul/19/6758dee5e3f25611967e9a8b109fdb74.png', '2025-07-19 13:31:36', '2025-07-19 13:48:02'),
(4, 6, 'service', 'Bed Bug Control', 'bed-bug-control', 'Bed bugs are blood-feeding pests that can survive for up to a year without a meal in cooler conditions, making them particularly resilient. Their presence can disrupt comfort and hygiene at home or in hospitality spaces.', 'upload/services/2025/Jul/19/d53e1d18a9fb7d10a37dbe36f378a6d9.jpg', 'upload/services/2025/Jul/19/4e4193bcaa157612b34a87fb7128adea.png', '2025-07-19 13:33:55', '2025-07-19 13:47:03'),
(5, NULL, 'cobweb', 'Expert Cleaning Services for Homes and Offices', 'expert-cleaning-services-for-homes-and-offices', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'upload/services/2025/Jul/20/251dcbd3c83bfc50b560b95664eb7217.jpg', 'upload/services/2025/Jul/20/31600a701b666f9163a904702427c8dd.jpg', '2025-07-20 06:44:13', '2025-07-20 06:46:15'),
(6, NULL, 'cobweb', 'Effortless Cleaning for a Healthier Environment', 'effortless-cleaning-for-a-healthier-environment', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'upload/services/2025/Jul/20/2ad5397ad7cbebfcee5efcc7ef8ab32d.png', 'upload/services/2025/Jul/20/f6bf53418680d53ad98ae178ddaf90bf.jpg', '2025-07-20 06:47:52', '2025-07-20 07:09:26'),
(7, NULL, 'service', 'Stacy Conway', 'stacy-conway', 'Eum rerum dolor eu u', NULL, 'upload/services/2025/Jul/20/a330dcdd3f6ff5e39962a314bbee8466.jpg', '2025-07-20 06:49:16', '2025-07-20 06:49:16'),
(10, NULL, 'cobweb', 'Your Go-To Cleaning Experts for All Spaces', 'your-go-to-cleaning-experts-for-all-spaces', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'upload/services/2025/Jul/20/4e621a7c94d8696bba89440023792081.jpg', 'upload/services/2025/Jul/20/504998320d2b80f428062fdedd672959.jpg', '2025-07-20 06:53:46', '2025-07-20 06:53:46');

-- --------------------------------------------------------

--
-- Table structure for table `service_categories`
--

CREATE TABLE `service_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_categories`
--

INSERT INTO `service_categories` (`id`, `title`, `slug`, `image`, `created_at`, `updated_at`) VALUES
(6, 'Pest Control', 'pest-control', 'upload/service_categories/2025/Jul/15/674b02f8287ef32fb612fec58ceda349.jpg', '2025-07-14 19:41:37', '2025-07-14 19:41:37'),
(7, 'General Pest Control', 'general-pest-control', 'upload/service_categories/2025/Jul/15/9b5207639306d6846c24b960b672b97e.jpg', '2025-07-14 19:42:16', '2025-07-14 19:42:16'),
(8, 'Sanitization Control', 'sanitization-control', 'upload/service_categories/2025/Jul/15/2da1a373184995318c15372509b24a1c.jpg', '2025-07-14 19:42:52', '2025-07-14 19:42:52'),
(9, 'AMC', 'amc', 'upload/service_categories/2025/Jul/15/2bfc1f6c39935d9ebe6d762971ce1916.jpg', '2025-07-14 19:43:20', '2025-07-14 19:43:20');

-- --------------------------------------------------------

--
-- Table structure for table `service_items`
--

CREATE TABLE `service_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_items`
--

INSERT INTO `service_items` (`id`, `service_id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(26, 4, 'cockroach pest control', '<p style=\"margin-bottom: 24px; line-height: 24px; text-align: justify; color: rgb(108, 117, 125); font-family: Lato, sans-serif;\">Cockroaches are one of the most common and persistent household pests that invade homes and kitchens. They carry diseases, contaminate food, and create an unhealthy living environment. If you are dealing with a cockroach infestation, you need the best cockroach pest control services to eliminate them effectively. At Luvleen Services, we specialize in professional cockroach pest control services using advanced treatment methods, including spray and gel applications.</p><p style=\"margin-bottom: 24px; line-height: 24px; text-align: justify; color: rgb(108, 117, 125); font-family: Lato, sans-serif;\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', '2025-07-19 13:47:03', '2025-07-19 13:47:03'),
(27, 3, 'cockroach pest control', '<p style=\"margin-bottom: 24px; line-height: 24px; text-align: justify; color: rgb(108, 117, 125); font-family: Lato, sans-serif;\">Cockroaches are one of the most common and persistent household pests that invade homes and kitchens. They carry diseases, contaminate food, and create an unhealthy living environment. If you are dealing with a cockroach infestation, you need the best cockroach pest control services to eliminate them effectively. At Luvleen Services, we specialize in professional cockroach pest control services using advanced treatment methods, including spray and gel applications.</p><p style=\"margin-bottom: 24px; line-height: 24px; text-align: justify; color: rgb(108, 117, 125); font-family: Lato, sans-serif;\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', '2025-07-19 13:48:02', '2025-07-19 13:48:02'),
(28, 2, 'cockroach pest control', '<p style=\"margin-bottom: 24px; line-height: 24px; text-align: justify; color: rgb(108, 117, 125); font-family: Lato, sans-serif;\">Cockroaches are one of the most common and persistent household pests that invade homes and kitchens. They carry diseases, contaminate food, and create an unhealthy living environment. If you are dealing with a cockroach infestation, you need the best cockroach pest control services to eliminate them effectively. At Luvleen Services, we specialize in professional cockroach pest control services using advanced treatment methods, including spray and gel applications.</p><p style=\"margin-bottom: 24px; line-height: 24px; text-align: justify; color: rgb(108, 117, 125); font-family: Lato, sans-serif;\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', '2025-07-19 13:48:45', '2025-07-19 13:48:45'),
(29, 2, 'How Do Cockroaches Enter Your Home?', '<p><span style=\"color: rgb(108, 117, 125); font-family: Lato, sans-serif; text-align: justify;\">Cockroaches are highly adaptable creatures that can find their way into homes through various means. Here are some common ways they can enter your home:</span></p>', '2025-07-19 13:48:45', '2025-07-19 13:48:45'),
(30, 2, 'How Do Cockroaches Enter Your Home?', '<p style=\"margin-bottom: 24px; line-height: 24px; text-align: justify; padding-top: 10px; color: rgb(73, 73, 73); font-family: Lato, sans-serif;\">Cockroaches are highly adaptable creatures that can find their way into homes through various means. Here are some common ways they can enter your home:</p><li style=\"color: rgb(108, 117, 125); font-family: Lato, sans-serif;\"><span style=\"font-weight: bolder;\">Health Hazards:</span>&nbsp;Cockroaches carry bacteria and viruses that can cause diseases like food poisoning, diarrhea, and allergies.</li><li style=\"color: rgb(108, 117, 125); font-family: Lato, sans-serif;\"><span style=\"font-weight: bolder;\">Food Contamination:</span>&nbsp;They contaminate food and cooking surfaces, making them unsafe for consumption.</li><li style=\"color: rgb(108, 117, 125); font-family: Lato, sans-serif;\"><span style=\"font-weight: bolder;\">Unpleasant Odor:</span>&nbsp;A large infestation can produce a strong, musty odor in your home.</li>', '2025-07-19 13:48:45', '2025-07-19 13:48:45'),
(31, 1, 'cockroach pest control', '<p style=\"margin-bottom: 24px; line-height: 24px; text-align: justify; color: rgb(108, 117, 125); font-family: Lato, sans-serif;\">Cockroaches are one of the most common and persistent household pests that invade homes and kitchens. They carry diseases, contaminate food, and create an unhealthy living environment. If you are dealing with a cockroach infestation, you need the best cockroach pest control services to eliminate them effectively. At Luvleen Services, we specialize in professional cockroach pest control services using advanced treatment methods, including spray and gel applications.</p><p style=\"margin-bottom: 24px; line-height: 24px; text-align: justify; color: rgb(108, 117, 125); font-family: Lato, sans-serif;\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', '2025-07-19 13:49:47', '2025-07-19 13:49:47'),
(32, 1, 'How Do Cockroaches Enter Your Home?', '<p><span style=\"color: rgb(108, 117, 125); font-family: Lato, sans-serif; text-align: justify;\">Cockroaches are highly adaptable creatures that can find their way into homes through various means. Here are some common ways they can enter your home:</span></p>', '2025-07-19 13:49:47', '2025-07-19 13:49:47'),
(33, 1, 'How Do Cockroaches Enter Your Home?', '<p style=\"margin-bottom: 24px; line-height: 24px; text-align: justify; padding-top: 10px; color: rgb(73, 73, 73); font-family: Lato, sans-serif;\">Cockroaches are highly adaptable creatures that can find their way into homes through various means. Here are some common ways they can enter your home:</p><li style=\"color: rgb(108, 117, 125); font-family: Lato, sans-serif;\"><span style=\"font-weight: bolder;\">Health Hazards:</span>&nbsp;Cockroaches carry bacteria and viruses that can cause diseases like food poisoning, diarrhea, and allergies.</li><li style=\"color: rgb(108, 117, 125); font-family: Lato, sans-serif;\"><span style=\"font-weight: bolder;\">Food Contamination:</span>&nbsp;They contaminate food and cooking surfaces, making them unsafe for consumption.</li><li style=\"color: rgb(108, 117, 125); font-family: Lato, sans-serif;\"><span style=\"font-weight: bolder;\">Unpleasant Odor:</span>&nbsp;A large infestation can produce a strong, musty odor in your home.</li>', '2025-07-19 13:49:47', '2025-07-19 13:49:47'),
(37, 5, 'cockroach pest control', '<p style=\"margin-bottom: 24px; line-height: 24px; text-align: justify; color: rgb(108, 117, 125); font-family: Lato, sans-serif;\">Cockroaches are one of the most common and persistent household pests that invade homes and kitchens. They carry diseases, contaminate food, and create an unhealthy living environment. If you are dealing with a cockroach infestation, you need the best cockroach pest control services to eliminate them effectively. At Luvleen Services, we specialize in professional cockroach pest control services using advanced treatment methods, including spray and gel applications.</p><p style=\"margin-bottom: 24px; line-height: 24px; text-align: justify; color: rgb(108, 117, 125); font-family: Lato, sans-serif;\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', '2025-07-20 06:46:15', '2025-07-20 06:46:15'),
(38, 5, 'How Do Cockroaches Enter Your Home?', '<p><span style=\"color: rgb(108, 117, 125); font-family: Lato, sans-serif; text-align: justify;\">Cockroaches are highly adaptable creatures that can find their way into homes through various means. Here are some common ways they can enter your home:</span></p>', '2025-07-20 06:46:15', '2025-07-20 06:46:15'),
(39, 5, 'How Do Cockroaches Enter Your Home?', '<p style=\"margin-bottom: 24px; line-height: 24px; text-align: justify; padding-top: 10px; color: rgb(73, 73, 73); font-family: Lato, sans-serif;\">Cockroaches are highly adaptable creatures that can find their way into homes through various means. Here are some common ways they can enter your home:</p><li style=\"color: rgb(108, 117, 125); font-family: Lato, sans-serif;\"><span style=\"font-weight: bolder;\">Health Hazards:</span>&nbsp;Cockroaches carry bacteria and viruses that can cause diseases like food poisoning, diarrhea, and allergies.</li><li style=\"color: rgb(108, 117, 125); font-family: Lato, sans-serif;\"><span style=\"font-weight: bolder;\">Food Contamination:</span>&nbsp;They contaminate food and cooking surfaces, making them unsafe for consumption.</li><li style=\"color: rgb(108, 117, 125); font-family: Lato, sans-serif;\"><span style=\"font-weight: bolder;\">Unpleasant Odor:</span>&nbsp;A large infestation can produce a strong, musty odor in your home.</li>', '2025-07-20 06:46:15', '2025-07-20 06:46:15'),
(41, 7, 'Minim aliquip esse', 'Ducimus, rerum dolor.', NULL, NULL),
(43, 10, 'How Do Cockroaches Enter Your Home?', '<p style=\"margin-bottom: 24px; line-height: 24px; text-align: justify; padding-top: 10px; color: rgb(73, 73, 73); font-family: Lato, sans-serif;\">Cockroaches are highly adaptable creatures that can find their way into homes through various means. Here are some common ways they can enter your home:</p><li style=\"color: rgb(108, 117, 125); font-family: Lato, sans-serif;\"><span style=\"font-weight: bolder;\">Health Hazards:</span>&nbsp;Cockroaches carry bacteria and viruses that can cause diseases like food poisoning, diarrhea, and allergies.</li><li style=\"color: rgb(108, 117, 125); font-family: Lato, sans-serif;\"><span style=\"font-weight: bolder;\">Food Contamination:</span>&nbsp;They contaminate food and cooking surfaces, making them unsafe for consumption.</li><li style=\"color: rgb(108, 117, 125); font-family: Lato, sans-serif;\"><span style=\"font-weight: bolder;\">Unpleasant Odor:</span>&nbsp;A large infestation can produce a strong, musty odor in your home.</li>', NULL, NULL),
(44, 6, 'How Do Cockroaches Enter Your Home?', '<p><span style=\"color: rgb(108, 117, 125); font-family: Lato, sans-serif; text-align: justify; background-color: rgb(247, 248, 250);\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span></p>', '2025-07-20 07:09:26', '2025-07-20 07:09:26');

-- --------------------------------------------------------

--
-- Table structure for table `social_links`
--

CREATE TABLE `social_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_links`
--

INSERT INTO `social_links` (`id`, `branch_id`, `name`, `icon`, `link`, `created_at`, `updated_at`) VALUES
(1, 4, 'facebook', 'fab fa-facebook', 'https://facebook.com', '2025-07-07 09:30:14', '2025-07-19 10:50:04'),
(5, 4, 'twitter', 'fab fa-twitter', 'https://www.twitter.com', '2025-07-19 10:51:35', '2025-07-19 10:51:35'),
(6, 4, 'linkedin', 'fab fa-linkedin', 'https://www.linkedin.com', '2025-07-19 10:52:19', '2025-07-19 10:52:19'),
(8, 4, 'google plus', 'fab fa-google-plus-g', 'https://cyberchimp.in/c_demo/luvleen2/index.html', '2025-07-19 10:53:24', '2025-07-19 10:53:24');

-- --------------------------------------------------------

--
-- Table structure for table `tracking_scripts`
--

CREATE TABLE `tracking_scripts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page` varchar(255) NOT NULL,
  `script` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tracking_scripts`
--

INSERT INTO `tracking_scripts` (`id`, `page`, `script`, `created_at`, `updated_at`) VALUES
(3, 'home', '&lt;script&gt;\r\nalert(&#039;hello&#039;)\r\n\r\n&lt;/script&gt;', '2025-07-20 14:07:42', '2025-07-20 14:17:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `image` varchar(250) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `image`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@yopmail.com', '0123456789', '/uploads/profile_images/6867e2b73edc5_Screenshot 2025-07-03 140429.png', NULL, '$2y$10$GrTVz5A2N4nBIv9MpKMxX.eJRjId0ESyKZe.wf9BP8pg/1Nqk89QO', NULL, NULL, '2025-07-04 08:48:31');

-- --------------------------------------------------------

--
-- Table structure for table `why_choose_us`
--

CREATE TABLE `why_choose_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `why_choose_us`
--

INSERT INTO `why_choose_us` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(3, 'Skilled & Certified Professionals', 'Our experienced pest control specialists are fully certified and consistently trained to stay updated with the latest technologies and methods.', '2025-07-14 22:23:07', '2025-07-14 22:23:07'),
(4, 'Guaranteed Customer Delight', 'ustomer satisfaction is our top priority. We ensure transparent communication, timely service, and results that truly make a difference.', '2025-07-14 22:23:29', '2025-07-14 22:23:29'),
(5, 'Safe & Green Methods', 'We use eco-friendly, low-toxicity products to ensure the safety of your family and the environment.', '2025-07-14 22:23:49', '2025-07-14 22:23:49'),
(6, 'Thorough Follow-Up Checks', 'After every treatment, we perform a detailed post-service inspection to confirm complete pest elimination.', '2025-07-14 22:24:11', '2025-07-14 22:24:11'),
(7, 'In-House Experts Only', 'All our services are delivered by our dedicated in-house team—no outsourcing, no compromises.', '2025-07-14 22:24:34', '2025-07-14 22:24:34'),
(8, 'Trusted by Thousands', 'With over 50,000 satisfied customers in Bangalore, we’re a name you can rely on for effective pest control', '2025-07-14 22:24:54', '2025-07-14 22:24:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achievements`
--
ALTER TABLE `achievements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `achievements_title_unique` (`title`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `branches_name_unique` (`name`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_name_unique` (`name`);

--
-- Indexes for table `cob_webs`
--
ALTER TABLE `cob_webs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cob_webs_name_unique` (`name`),
  ADD UNIQUE KEY `cob_webs_slug_unique` (`slug`);

--
-- Indexes for table `cob_web_items`
--
ALTER TABLE `cob_web_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cob_web_items_title_unique` (`title`);

--
-- Indexes for table `customer_says`
--
ALTER TABLE `customer_says`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `galleries_title_unique` (`title`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `satisfaction_guaranteeds`
--
ALTER TABLE `satisfaction_guaranteeds`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `satisfaction_guaranteeds_title_unique` (`title`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `services_name_unique` (`name`),
  ADD UNIQUE KEY `services_slug_unique` (`slug`);

--
-- Indexes for table `service_categories`
--
ALTER TABLE `service_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `service_categories_title_unique` (`title`),
  ADD UNIQUE KEY `service_categories_slug_unique` (`slug`);

--
-- Indexes for table `service_items`
--
ALTER TABLE `service_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_links`
--
ALTER TABLE `social_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tracking_scripts`
--
ALTER TABLE `tracking_scripts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- Indexes for table `why_choose_us`
--
ALTER TABLE `why_choose_us`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achievements`
--
ALTER TABLE `achievements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cob_webs`
--
ALTER TABLE `cob_webs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cob_web_items`
--
ALTER TABLE `cob_web_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_says`
--
ALTER TABLE `customer_says`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `satisfaction_guaranteeds`
--
ALTER TABLE `satisfaction_guaranteeds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `service_categories`
--
ALTER TABLE `service_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `service_items`
--
ALTER TABLE `service_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `social_links`
--
ALTER TABLE `social_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tracking_scripts`
--
ALTER TABLE `tracking_scripts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `why_choose_us`
--
ALTER TABLE `why_choose_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
