-- phpMyAdmin SQL Dump
-- version 5.2.1deb1ubuntu0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 07, 2023 at 05:58 PM
-- Server version: 8.0.35-0ubuntu0.23.04.1
-- PHP Version: 8.1.12-1ubuntu4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Taskmgt`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `id` bigint UNSIGNED NOT NULL,
  `taskname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assign` bigint UNSIGNED DEFAULT NULL,
  `assignstaff` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`id`, `taskname`, `assign`, `assignstaff`, `created_at`, `updated_at`) VALUES
(1, 'Test456', 1, 'Staff User', '2023-10-16 02:26:34', '2023-10-16 02:26:34'),
(2, 'New Task', 5, 'staff3', '2023-10-16 04:20:21', '2023-10-16 04:20:21'),
(3, 'Task 123', 4, 'staff2', '2023-10-16 05:50:53', '2023-10-16 05:50:53'),
(4, 'latest task', NULL, 'staff4', '2023-10-16 06:57:19', '2023-10-16 06:57:19'),
(5, 'tasks4', 6, 'staff4', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_10_16_053939_add_role_to_users_table', 2),
(6, '2023_10_16_054011_create_table__manager', 2),
(7, '2023_10_16_054022_create_staff', 2),
(8, '2014_10_12_100000_create_password_resets_table', 3),
(9, '2023_10_17_133644_create_task_timestamps', 4),
(10, '2023_10_20_192151_create_notification', 5),
(11, '2023_10_21_115533_add_type_column_to_notifications_table', 6),
(12, '2023_10_21_115654_remove_type_column_from_notifications_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_id` int NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `task_id`, `read`, `created_at`, `updated_at`) VALUES
(1, 1, 'You have a new task: newwww', 31, 1, '2023-10-27 10:31:51', '2023-10-27 13:51:12'),
(3, 1, 'You have a new task: n1111', 33, 1, '2023-10-27 12:21:34', '2023-10-27 13:51:12'),
(4, 4, 'You have a new task: 12233', 34, 1, '2023-10-27 12:52:28', '2023-10-27 14:08:17'),
(5, 4, 'You have a new task: 13444', 35, 1, '2023-10-27 12:52:36', '2023-10-27 14:04:58'),
(6, 1, 'You have a new task: todaytask', 36, 1, '2023-10-28 04:52:28', '2023-10-28 04:53:51');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` bigint UNSIGNED NOT NULL,
  `task_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `date` date NOT NULL,
  `starttime` time NOT NULL,
  `endtime` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `task_id`, `user_id`, `status`, `date`, `starttime`, `endtime`, `created_at`, `updated_at`) VALUES
(1, '3', 0, 'In Process', '2023-10-17', '17:04:33', '56:05:33', NULL, NULL),
(2, '3', 0, 'Complete', '2023-10-16', '17:34:00', '20:31:00', '2023-10-16 06:31:58', '2023-10-16 06:31:58'),
(3, 'latest task', 5, 'Complete', '2023-10-18', '17:00:00', '15:00:00', '2023-10-16 07:04:18', '2023-10-17 02:00:38'),
(4, '[\"latest task\",\"tasks4\"]', 0, 'Pending', '2023-10-13', '20:24:00', '21:24:00', '2023-10-16 07:24:47', '2023-10-16 07:24:47'),
(5, '[\"latest task\",\"tasks4\"]', 6, 'Complete', '2023-10-13', '21:41:00', '21:41:00', '2023-10-16 07:41:18', '2023-10-16 07:41:18');

-- --------------------------------------------------------

--
-- Table structure for table `Task`
--

CREATE TABLE `Task` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT 'Pending',
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Task`
--

INSERT INTO `Task` (`id`, `title`, `status`, `start_time`, `end_time`, `user_id`, `date`, `created_at`, `updated_at`) VALUES
(1, 'New Task5', 'Complete', '2023-10-18 12:17:04', '2023-10-18 12:58:00', 7, '2023-10-18', '2023-10-17 06:05:13', '2023-10-19 11:54:46'),
(2, 'Task213', 'pending', '2023-10-18 10:49:00', '2023-10-18 12:49:00', 6, '2023-10-18', '2023-10-17 06:05:13', '2023-10-19 11:48:59'),
(7, 'Task13', 'In Progress', '2023-10-18 17:41:56', '2023-10-18 23:41:56', 5, '2023-10-17', '2023-10-17 09:42:24', '2023-10-20 06:47:53'),
(8, 'task566', 'Complete', '2023-10-17 18:42:27', '2023-10-18 16:42:27', 7, '2023-10-17', '2023-10-17 09:42:55', '2023-10-19 11:52:34'),
(9, 'tasknew23', 'Complete', '2023-10-17 12:43:24', '2023-10-18 03:43:24', 1, '2023-10-17', '2023-10-17 09:43:46', '2023-10-27 11:55:09'),
(10, 'pendtask', 'In Progress', '2023-10-18 13:44:22', '2023-10-19 06:44:22', 6, '2023-10-17', '2023-10-17 09:44:46', '2023-10-19 11:45:55'),
(14, 'task5', 'Complete', NULL, NULL, 8, '2023-10-20', '2023-10-19 13:17:33', '2023-10-20 11:54:17'),
(15, 'rererere', 'Pending', NULL, NULL, 5, NULL, '2023-10-21 06:00:24', '2023-10-21 06:00:24'),
(16, 'newwtass', 'Pending', NULL, NULL, 5, NULL, '2023-10-21 06:08:16', '2023-10-21 06:08:16'),
(17, 'fgfdgdgd', 'Pending', NULL, NULL, 1, NULL, '2023-10-21 06:13:28', '2023-10-21 06:13:28'),
(18, 'nnnnnneeeee', 'Pending', NULL, NULL, 1, NULL, '2023-10-21 06:13:59', '2023-10-21 06:13:59'),
(19, 'nnnnnneeeee', 'Pending', NULL, NULL, 1, NULL, '2023-10-21 06:20:40', '2023-10-21 06:20:40'),
(20, 'taskname', 'Pending', NULL, NULL, 1, NULL, '2023-10-21 06:22:17', '2023-10-21 06:22:17'),
(21, 'taskname', 'Pending', NULL, NULL, 1, NULL, '2023-10-21 06:22:24', '2023-10-21 06:22:24'),
(23, 'nnnn', 'Pending', NULL, NULL, 1, NULL, '2023-10-21 06:27:52', '2023-10-21 06:27:52'),
(24, 'df', 'Pending', NULL, NULL, 5, NULL, '2023-10-21 06:28:36', '2023-10-21 06:28:36'),
(25, 'trtr', 'Pending', NULL, NULL, 5, NULL, '2023-10-25 05:05:26', '2023-10-25 05:05:26'),
(31, 'newwww', 'Complete', NULL, NULL, 1, NULL, '2023-10-27 10:31:51', '2023-10-27 13:45:51'),
(33, 'n1111', 'In Progress', NULL, NULL, 1, NULL, '2023-10-27 12:21:34', '2023-10-27 12:51:31'),
(34, '12233', 'Complete', NULL, NULL, 4, NULL, '2023-10-27 12:52:28', '2023-10-27 14:10:12'),
(35, '13444', 'In Progress', NULL, NULL, 4, NULL, '2023-10-27 12:52:36', '2023-10-27 13:40:37'),
(36, 'todaytask', 'Complete', NULL, NULL, 1, NULL, '2023-10-28 04:52:28', '2023-10-28 04:54:18');

-- --------------------------------------------------------

--
-- Table structure for table `task_timestamps`
--

CREATE TABLE `task_timestamps` (
  `id` bigint UNSIGNED NOT NULL,
  `task_id` int NOT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `time_taken` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task_timestamps`
--

INSERT INTO `task_timestamps` (`id`, `task_id`, `start_time`, `end_time`, `time_taken`, `created_at`, `updated_at`) VALUES
(1, 2, '2023-10-19 11:37:02', NULL, NULL, '2023-10-19 11:37:02', '2023-10-19 11:37:02'),
(2, 2, NULL, '2023-10-19 11:37:04', NULL, '2023-10-19 11:37:04', '2023-10-19 11:37:04'),
(3, 2, '2023-10-19 11:38:49', NULL, NULL, '2023-10-19 11:38:49', '2023-10-19 11:38:49'),
(4, 2, NULL, '2023-10-19 11:38:51', NULL, '2023-10-19 11:38:51', '2023-10-19 11:38:51'),
(6, 10, '2023-10-19 11:39:00', NULL, NULL, '2023-10-19 11:39:00', '2023-10-19 11:39:00'),
(7, 2, '2023-10-19 11:39:04', NULL, NULL, '2023-10-19 11:39:04', '2023-10-19 11:39:04'),
(8, 2, NULL, '2023-10-19 11:39:07', NULL, '2023-10-19 11:39:07', '2023-10-19 11:39:07'),
(9, 2, '2023-10-19 11:39:36', NULL, NULL, '2023-10-19 11:39:36', '2023-10-19 11:39:36'),
(11, 10, '2023-10-19 11:39:38', NULL, NULL, '2023-10-19 11:39:38', '2023-10-19 11:39:38'),
(13, 2, NULL, '2023-10-19 11:40:19', NULL, '2023-10-19 11:40:19', '2023-10-19 11:40:19'),
(15, 2, '2023-10-19 11:40:22', NULL, NULL, '2023-10-19 11:40:22', '2023-10-19 11:40:22'),
(17, 2, NULL, '2023-10-19 11:41:59', NULL, '2023-10-19 11:41:59', '2023-10-19 11:41:59'),
(18, 2, '2023-10-19 11:42:04', NULL, NULL, '2023-10-19 11:42:04', '2023-10-19 11:42:04'),
(19, 2, NULL, '2023-10-19 11:42:05', '00:02:27', '2023-10-19 11:42:05', '2023-10-19 11:42:05'),
(23, 10, NULL, '2023-10-19 11:42:25', NULL, '2023-10-19 11:42:25', '2023-10-19 11:42:25'),
(24, 10, NULL, '2023-10-19 11:42:28', '00:02:47', '2023-10-19 11:42:28', '2023-10-19 11:42:28'),
(25, 2, '2023-10-19 11:45:54', NULL, NULL, '2023-10-19 11:45:54', '2023-10-19 11:45:54'),
(27, 10, '2023-10-19 11:45:55', NULL, NULL, '2023-10-19 11:45:55', '2023-10-19 11:45:55'),
(28, 2, NULL, '2023-10-19 11:48:54', NULL, '2023-10-19 11:48:54', '2023-10-19 11:48:54'),
(30, 10, NULL, '2023-10-19 11:48:56', NULL, '2023-10-19 11:48:56', '2023-10-19 11:48:56'),
(31, 2, NULL, '2023-10-19 11:48:59', '00:05:28', '2023-10-19 11:48:59', '2023-10-19 11:48:59'),
(32, 1, '2023-10-19 11:50:11', NULL, NULL, '2023-10-19 11:50:11', '2023-10-19 11:50:11'),
(33, 8, '2023-10-19 11:50:14', NULL, NULL, '2023-10-19 11:50:14', '2023-10-19 11:50:14'),
(34, 1, NULL, '2023-10-19 11:51:57', '00:03:47', '2023-10-19 11:51:57', '2023-10-19 11:51:57'),
(35, 8, NULL, '2023-10-19 11:51:58', NULL, '2023-10-19 11:51:58', '2023-10-19 11:51:58'),
(36, 8, '2023-10-19 11:52:00', NULL, NULL, '2023-10-19 11:52:00', '2023-10-19 11:52:00'),
(37, 8, NULL, '2023-10-19 11:52:31', NULL, '2023-10-19 11:52:31', '2023-10-19 11:52:31'),
(38, 8, NULL, '2023-10-19 11:52:34', '00:02:15', '2023-10-19 11:52:34', '2023-10-19 11:52:34'),
(39, 1, '2023-10-19 11:54:44', NULL, NULL, '2023-10-19 11:54:44', '2023-10-19 11:54:44'),
(40, 1, NULL, '2023-10-19 11:54:45', NULL, '2023-10-19 11:54:45', '2023-10-19 11:54:45'),
(41, 1, NULL, '2023-10-19 11:54:46', '00:01:47', '2023-10-19 11:54:46', '2023-10-19 11:54:46'),
(49, 9, '2023-10-19 12:03:26', NULL, NULL, '2023-10-19 12:03:26', '2023-10-19 12:03:26'),
(50, 9, NULL, '2023-10-19 12:04:23', NULL, '2023-10-19 12:04:23', '2023-10-19 12:04:23'),
(51, 9, NULL, '2023-10-19 12:04:27', '00:00:57', '2023-10-19 12:04:27', '2023-10-19 12:04:27'),
(66, 7, '2023-10-20 04:56:35', NULL, NULL, '2023-10-20 04:56:35', '2023-10-20 04:56:35'),
(67, 7, NULL, '2023-10-20 05:27:22', NULL, '2023-10-20 05:27:22', '2023-10-20 05:27:22'),
(68, 7, '2023-10-20 05:27:25', NULL, NULL, '2023-10-20 05:27:25', '2023-10-20 05:27:25'),
(69, 7, NULL, '2023-10-20 05:27:27', NULL, '2023-10-20 05:27:27', '2023-10-20 05:27:27'),
(70, 7, NULL, '2023-10-20 05:27:28', '00:30:49', '2023-10-20 05:27:28', '2023-10-20 05:27:28'),
(71, 7, '2023-10-20 06:07:35', NULL, NULL, '2023-10-20 06:07:35', '2023-10-20 06:07:35'),
(72, 7, NULL, '2023-10-20 06:07:37', NULL, '2023-10-20 06:07:37', '2023-10-20 06:07:37'),
(73, 7, '2023-10-20 06:08:27', NULL, NULL, '2023-10-20 06:08:27', '2023-10-20 06:08:27'),
(74, 7, NULL, '2023-10-20 06:08:29', NULL, '2023-10-20 06:08:29', '2023-10-20 06:08:29'),
(75, 7, '2023-10-20 06:08:30', NULL, NULL, '2023-10-20 06:08:30', '2023-10-20 06:08:30'),
(76, 7, NULL, '2023-10-20 06:08:31', NULL, '2023-10-20 06:08:31', '2023-10-20 06:08:31'),
(77, 7, '2023-10-20 06:17:58', NULL, NULL, '2023-10-20 06:17:58', '2023-10-20 06:17:58'),
(78, 7, '2023-10-20 06:18:49', NULL, NULL, '2023-10-20 06:18:49', '2023-10-20 06:18:49'),
(79, 7, NULL, '2023-10-20 06:18:50', NULL, '2023-10-20 06:18:50', '2023-10-20 06:18:50'),
(80, 7, NULL, '2023-10-20 06:18:51', '00:30:55', '2023-10-20 06:18:51', '2023-10-20 06:18:51'),
(81, 7, '2023-10-20 06:20:53', NULL, NULL, '2023-10-20 06:20:53', '2023-10-20 06:20:53'),
(82, 7, NULL, '2023-10-20 06:20:54', NULL, '2023-10-20 06:20:54', '2023-10-20 06:20:54'),
(83, 7, '2023-10-20 06:22:34', NULL, NULL, '2023-10-20 06:22:34', '2023-10-20 06:22:34'),
(84, 7, NULL, '2023-10-20 06:22:35', NULL, '2023-10-20 06:22:35', '2023-10-20 06:22:35'),
(85, 7, NULL, '2023-10-20 06:22:37', '00:30:57', '2023-10-20 06:22:37', '2023-10-20 06:22:37'),
(86, 7, '2023-10-20 06:24:51', NULL, NULL, '2023-10-20 06:24:51', '2023-10-20 06:24:51'),
(87, 7, '2023-10-20 06:26:00', NULL, NULL, '2023-10-20 06:26:00', '2023-10-20 06:26:00'),
(88, 7, NULL, '2023-10-20 06:26:01', '00:30:57', '2023-10-20 06:26:01', '2023-10-20 06:26:01'),
(91, 7, '2023-10-20 06:47:53', NULL, NULL, '2023-10-20 06:47:53', '2023-10-20 06:47:53'),
(92, 7, NULL, '2023-10-20 06:47:54', NULL, '2023-10-20 06:47:54', '2023-10-20 06:47:54'),
(93, 7, '2023-10-20 07:06:18', NULL, NULL, '2023-10-20 07:06:18', '2023-10-20 07:06:18'),
(94, 7, NULL, '2023-10-20 07:06:19', NULL, '2023-10-20 07:06:19', '2023-10-20 07:06:19'),
(95, 7, '2023-10-20 07:57:22', NULL, NULL, '2023-10-20 07:57:22', '2023-10-20 07:57:22'),
(96, 7, NULL, '2023-10-20 07:57:23', '00:31:00', '2023-10-20 07:57:23', '2023-10-20 07:57:23'),
(97, 7, NULL, '2023-10-20 07:57:24', '00:31:01', '2023-10-20 07:57:24', '2023-10-20 07:57:24'),
(98, 7, NULL, '2023-10-20 07:57:25', '00:31:01', '2023-10-20 07:57:25', '2023-10-20 07:57:25'),
(99, 7, '2023-10-20 07:58:08', NULL, NULL, '2023-10-20 07:58:08', '2023-10-20 07:58:08'),
(100, 7, NULL, '2023-10-20 07:58:09', '00:31:01', '2023-10-20 07:58:09', '2023-10-20 07:58:09'),
(106, 7, '2023-10-20 08:01:22', NULL, NULL, '2023-10-20 08:01:22', '2023-10-20 08:01:22'),
(107, 7, NULL, '2023-10-20 08:01:24', '00:31:02', '2023-10-20 08:01:24', '2023-10-20 08:01:24'),
(329, 14, '2023-10-20 11:52:44', NULL, NULL, '2023-10-20 11:52:44', '2023-10-20 11:52:44'),
(330, 14, NULL, '2023-10-20 11:52:46', '00:00:00', '2023-10-20 11:52:46', '2023-10-20 11:52:46'),
(331, 14, '2023-10-20 11:52:47', NULL, NULL, '2023-10-20 11:52:47', '2023-10-20 11:52:47'),
(332, 14, NULL, '2023-10-20 11:54:04', '00:01:27', '2023-10-20 11:54:04', '2023-10-20 11:54:04'),
(333, 14, '2023-10-20 11:54:14', NULL, NULL, '2023-10-20 11:54:14', '2023-10-20 11:54:14'),
(334, 14, NULL, '2023-10-20 11:54:15', '00:00:00', '2023-10-20 11:54:15', '2023-10-20 11:54:15'),
(335, 14, NULL, '2023-10-20 11:54:17', '00:01:17', '2023-10-20 11:54:17', '2023-10-20 11:54:17'),
(341, 9, '2023-10-27 11:55:07', NULL, NULL, '2023-10-27 11:55:07', '2023-10-27 11:55:07'),
(342, 9, NULL, '2023-10-27 11:55:08', '00:00:00', '2023-10-27 11:55:08', '2023-10-27 11:55:08'),
(343, 9, NULL, '2023-10-27 11:55:09', '00:00:00', '2023-10-27 11:55:09', '2023-10-27 11:55:09'),
(344, 33, '2023-10-27 12:51:31', NULL, NULL, '2023-10-27 12:51:31', '2023-10-27 12:51:31'),
(345, 33, NULL, '2023-10-27 12:51:33', '00:00:00', '2023-10-27 12:51:33', '2023-10-27 12:51:33'),
(346, 34, '2023-10-27 13:40:30', NULL, NULL, '2023-10-27 13:40:30', '2023-10-27 13:40:30'),
(347, 34, NULL, '2023-10-27 13:40:32', '00:00:00', '2023-10-27 13:40:32', '2023-10-27 13:40:32'),
(348, 34, NULL, '2023-10-27 13:40:33', '00:00:00', '2023-10-27 13:40:33', '2023-10-27 13:40:33'),
(349, 35, '2023-10-27 13:40:37', NULL, NULL, '2023-10-27 13:40:37', '2023-10-27 13:40:37'),
(350, 31, '2023-10-27 13:45:51', NULL, NULL, '2023-10-27 13:45:51', '2023-10-27 13:45:51'),
(351, 31, NULL, '2023-10-27 13:45:51', '00:00:00', '2023-10-27 13:45:51', '2023-10-27 13:45:51'),
(352, 34, '2023-10-27 13:59:31', NULL, NULL, '2023-10-27 13:59:31', '2023-10-27 13:59:31'),
(353, 34, NULL, '2023-10-27 13:59:33', '00:00:00', '2023-10-27 13:59:33', '2023-10-27 13:59:33'),
(354, 34, NULL, '2023-10-27 13:59:33', '00:00:00', '2023-10-27 13:59:33', '2023-10-27 13:59:33'),
(355, 34, '2023-10-27 14:05:07', NULL, NULL, '2023-10-27 14:05:07', '2023-10-27 14:05:07'),
(356, 34, NULL, '2023-10-27 14:05:08', '00:00:00', '2023-10-27 14:05:08', '2023-10-27 14:05:08'),
(357, 34, NULL, '2023-10-27 14:05:09', '00:00:00', '2023-10-27 14:05:09', '2023-10-27 14:05:09'),
(358, 34, '2023-10-27 14:09:16', NULL, NULL, '2023-10-27 14:09:16', '2023-10-27 14:09:16'),
(359, 34, NULL, '2023-10-27 14:09:19', '00:00:00', '2023-10-27 14:09:19', '2023-10-27 14:09:19'),
(360, 34, '2023-10-27 14:09:21', NULL, NULL, '2023-10-27 14:09:21', '2023-10-27 14:09:21'),
(361, 34, NULL, '2023-10-27 14:09:58', '00:00:00', '2023-10-27 14:09:58', '2023-10-27 14:09:58'),
(362, 34, '2023-10-27 14:09:59', NULL, NULL, '2023-10-27 14:10:00', '2023-10-27 14:10:00'),
(363, 34, NULL, '2023-10-27 14:10:11', '00:00:00', '2023-10-27 14:10:11', '2023-10-27 14:10:11'),
(364, 34, NULL, '2023-10-27 14:10:12', '00:00:00', '2023-10-27 14:10:12', '2023-10-27 14:10:12'),
(365, 36, '2023-10-28 04:54:15', NULL, NULL, '2023-10-28 04:54:15', '2023-10-28 04:54:15'),
(366, 36, NULL, '2023-10-28 04:54:17', '00:00:00', '2023-10-28 04:54:17', '2023-10-28 04:54:17'),
(367, 36, NULL, '2023-10-28 04:54:18', '00:00:00', '2023-10-28 04:54:18', '2023-10-28 04:54:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` tinyint NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Staff User', 'staff@gmail.com', 2, NULL, '$2y$10$JVcL.XjXPQ5Vanhwu0byG.JTe4WONKfIhpURe3.nBdpZ2yOPtEljy', NULL, '2023-10-16 01:02:29', '2023-10-16 01:02:29'),
(2, 'Manager User', 'manager@gmail.com', 1, NULL, '$2y$10$Sfg8sa/Y97.trRw/hngnd.7/bbf.qnujBUDR0MbWYPemvQL86XXSC', NULL, '2023-10-16 01:02:29', '2023-10-16 01:02:29'),
(3, 'Admin', 'admin@gmail.com', 0, NULL, '$2y$10$gQZ8zLgFrm2IzNWDBkJnye63jXjGtfzW8CX4vZZ8pawk5xSsBun4K', NULL, '2023-10-16 01:02:29', '2023-10-16 01:02:29'),
(4, 'staff2', 'staff2@gmail.com', 2, NULL, '$2y$10$JVcL.XjXPQ5Vanhwu0byG.JTe4WONKfIhpURe3.nBdpZ2yOPtEljy', NULL, NULL, NULL),
(5, 'staff3', 'staff3@gmail.com', 2, NULL, '$2y$10$JVcL.XjXPQ5Vanhwu0byG.JTe4WONKfIhpURe3.nBdpZ2yOPtEljy', NULL, NULL, NULL),
(6, 'staff4', 'staff4@gmail.com', 2, NULL, '$2y$10$JVcL.XjXPQ5Vanhwu0byG.JTe4WONKfIhpURe3.nBdpZ2yOPtEljy', NULL, NULL, NULL),
(7, 'staff5', 'staff5@gmail.com', 2, NULL, '$2y$10$JVcL.XjXPQ5Vanhwu0byG.JTe4WONKfIhpURe3.nBdpZ2yOPtEljy', NULL, NULL, NULL),
(8, 'staff8', 'staff8@gmail.com', 2, NULL, '$2y$10$pqkGDFCFGQA3XDHCELuNsO4NDNAFbOfK4uj/whO/kyLtP0DCDirCe', NULL, '2023-10-20 04:45:14', '2023-10-20 04:45:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_assign` (`assign`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_uidd` (`user_id`),
  ADD KEY `fk_tidd` (`task_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_userrid` (`user_id`);

--
-- Indexes for table `Task`
--
ALTER TABLE `Task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_uid` (`user_id`);

--
-- Indexes for table `task_timestamps`
--
ALTER TABLE `task_timestamps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_taskid` (`task_id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Task`
--
ALTER TABLE `Task`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `task_timestamps`
--
ALTER TABLE `task_timestamps`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=368;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `manager`
--
ALTER TABLE `manager`
  ADD CONSTRAINT `fk_assign` FOREIGN KEY (`assign`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `fk_tidd` FOREIGN KEY (`task_id`) REFERENCES `Task` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_uidd` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `fk_userrid` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Task`
--
ALTER TABLE `Task`
  ADD CONSTRAINT `fk_uid` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `task_timestamps`
--
ALTER TABLE `task_timestamps`
  ADD CONSTRAINT `fk_taskid` FOREIGN KEY (`task_id`) REFERENCES `Task` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
