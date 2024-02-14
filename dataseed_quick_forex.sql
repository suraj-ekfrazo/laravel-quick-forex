-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 06, 2024 at 04:55 PM
-- Server version: 8.0.32-cll-lve
-- PHP Version: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dataseed_quick_forex`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `name`, `email`, `mobile_no`, `user_name`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'adminqfx@gmail.com', '89555525551', 'adminqfx', '$2y$10$GCbebprr3aLkC1dwmt29suqZpjDZYM9ec.nW5DQ/0rYndTFzHx/Na', 1, NULL, '2023-10-10 07:09:20'),
(3, 'Super Admin', 'superadmin@gmail.com', '989898555', 'superadmin', '$2y$10$bF3YwdrRSdg7pUZs6gRNT.dPdTFtmtyf2eqg/0DNgvDW/9CsZzUa6', 1, '2023-04-24 05:27:08', '2023-04-24 05:27:13'),
(4, 'shiv', 'skmadrasi@gmail.com', '9856545021', 'adminshiv', '$2y$10$abz96FwUzYEUWw2wkEREy.LABSM9eQZQ383CMfea3gnuOQJpNFLOe', 1, '2023-04-24 05:27:36', '2023-12-01 07:53:29');

-- --------------------------------------------------------

--
-- Table structure for table `agent_users`
--

CREATE TABLE `agent_users` (
  `id` int UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `password` text NOT NULL,
  `branch_name` varchar(255) DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `agent_users`
--

INSERT INTO `agent_users` (`id`, `first_name`, `last_name`, `email`, `mobile`, `profile_pic`, `password`, `branch_name`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'avani11', 'desai07', 'avanidesai@yopmail.com', '8000500155', NULL, '$2y$10$AaZljpgaf6vVtLsVgMfXl.EVp9INcLkt5bHfMrHAg1/sbfNlLjSxu', 'test11', 0, '2023-03-29 05:46:34', '2023-12-01 09:02:20', NULL),
(6, 'Gaurang', 'Patel', 'gaurang5416@gmail.com', '7777444444', NULL, '$2y$10$elq.Nhkej4LVbAiKuZzQHuVmdqe10ExHk33ZohxjaHDrKJzD8RGx6', 'test', 1, '2023-03-29 05:48:08', '2023-12-07 04:41:32', NULL),
(7, 'Harshit', 'Lal', 'Harshit@gmail.com', '8989896545', NULL, '$2y$10$QNv1cn2V6Hg70NZBbxqvieY0XrTkmiQJ/tt39mfm14wZ28PpYUHIe', 'test1', 1, '2023-03-29 05:53:36', '2023-03-29 05:53:36', NULL),
(11, 'shiv', 'Kow', 'shiv.m@matrixapl.net', '78959898989', NULL, '$2y$10$y6W3X9gOODgosz4ZacUTgOnx/S6zjHTd.sPVxQd8hpCPzu8eWAGCq', 'test shiv', 1, '2023-03-29 06:02:57', '2023-03-29 06:02:57', NULL),
(13, 'Harshit', 'Patel', 'Harshit111@gmail.com', '88844422222', NULL, '$2y$10$UA0TsiEnoDPSPZ0OqaQFyOeeuBMdbdZHrhs6TNJW8DDQxo4xdKVau', 'test harshit', 1, '2023-03-29 06:08:27', '2023-03-29 06:08:27', NULL),
(15, 'Gaurang', 'Patel', 'asddW@gmail.com', '9956221215444', NULL, '$2y$10$BISEd48Cxb1Blza9KpOXW.3HunRxZfMqLiVBu0zcBI4LGMShKXrKq', 'asddW', 1, '2023-03-29 06:27:19', '2023-05-29 06:31:47', NULL),
(19, 'Shiv', 'Madrasi', 'skmadrasi@gmail.com', '9099583095', NULL, '$2y$10$rBnOAzeu8TpEyvNG9YNpt.TBRVp2IRDD/mWk.3rRZLdIgf/xGyS4a', 'test111111', 1, '2023-03-29 23:40:28', '2023-04-12 03:05:51', NULL),
(20, 'Jay', 'Kumar', 'jaykumar@gmail.com', '9085512011', NULL, '$2y$10$0ybns1/I2YbC0U5pp7vD.OQ6aOqaau1iMtxjJsiLuGZweHXnH0qaS', 'Jay', 1, '2023-03-30 03:47:18', '2023-03-30 03:47:18', NULL),
(21, 'Chintubhai', 'Lal', 'chintulal@gmail.com', '855541414101', NULL, '$2y$10$a5e6V3iKY0yBNhaXEFa3VOWxzsVFfLHbAOLmc4lAyfsflGkipCGEm', 'Chintu15', 1, '2023-03-30 03:49:55', '2023-03-30 07:12:29', NULL),
(23, 'Jigar', 'Patel', 'jigar@yopmail.com', '7895989898', NULL, '$2y$10$1LwYfK/1QM9opxivoIR0TuSEmNaT4JKFjGxzUmAW/XwtNcFNDj6CW', 'Jigar', 1, '2023-04-07 05:01:32', '2023-04-07 06:48:45', NULL),
(24, 'Bandra', 'Branch', 'bandraqfx@qfx.com', '9874563210', NULL, '$2y$10$rAa8mednVgMLa/TMVXYV9Oyz3IMhTbnKXcnlxKw2JIosfdhdFLbhe', 'Bandra', 1, '2023-04-07 12:44:27', '2023-04-07 12:45:00', NULL),
(25, 'Nishant', 'Lad', 'nishant@yopmail.com', '9876543210', NULL, '$2y$10$bbT85mITEILcIZp8PoYA0.yE8XUGJQM.c4.ApHc9WpnaJ6S0lYLj2', 'Surat Branch', 1, '2023-05-02 04:09:59', '2023-05-02 04:15:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `is_otp` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `mobile`, `is_otp`, `created_at`, `updated_at`, `created_by`, `deleted_at`) VALUES
(1, 'test', '7788787878787878', 0, '2023-04-04 01:10:03', '2023-04-04 03:41:34', NULL, '2023-04-04 03:41:34'),
(2, 'test', '98989555444', 0, '2023-04-04 01:11:00', '2023-04-04 03:41:31', NULL, '2023-04-04 03:41:31'),
(3, 'shiv', '8989896545', 0, '2023-04-04 01:11:34', '2023-04-04 01:11:34', NULL, NULL),
(4, 'test', '7474740111', 0, '2023-04-04 01:13:39', '2023-04-04 03:41:03', NULL, '2023-04-04 03:41:03'),
(5, 'hitesh', '8000500120', 0, '2023-04-04 01:13:50', '2023-04-04 03:41:09', NULL, '2023-04-04 03:41:09'),
(6, 'shiv test', '74747401111', 0, '2023-04-04 01:14:22', '2023-04-04 03:41:24', NULL, '2023-04-04 03:41:24'),
(7, 'test', '800050012000', 0, '2023-04-04 01:14:38', '2023-04-04 03:41:27', NULL, '2023-04-04 03:41:27'),
(8, 'hitesh', '898989654566', 0, '2023-04-04 03:32:04', '2023-04-04 04:43:40', NULL, '2023-04-04 04:43:40'),
(9, 'test1', '98989555488', 0, '2023-04-04 03:38:25', '2023-04-04 03:41:40', NULL, '2023-04-04 03:41:40'),
(10, 'JACK & JONE', '876565645446', 0, '2023-04-04 03:42:18', '2023-04-04 03:42:18', NULL, NULL),
(11, 'Vicky', '80005001200', 0, '2023-04-04 04:19:05', '2023-04-04 04:19:05', NULL, NULL),
(12, 'Tilak', '800050012001', 0, '2023-04-04 04:44:28', '2023-04-04 04:44:28', NULL, NULL),
(13, 'Jay', '787545454544', 0, '2023-04-06 03:35:56', '2023-04-06 03:35:56', NULL, NULL),
(14, 'Nishant', '9865320147', 0, '2023-04-07 05:08:31', '2023-04-07 05:08:31', NULL, NULL),
(15, 'Amit', '74747401115', 0, '2023-04-07 05:28:08', '2023-04-07 05:28:08', NULL, NULL),
(16, 'sadik', '8754369210', 0, '2023-04-07 06:49:54', '2023-04-07 06:49:54', NULL, NULL),
(17, 'Test shiv', '7895989898', 0, '2023-04-12 06:59:28', '2023-04-12 06:59:28', NULL, NULL),
(18, 'Test OTP', '789598989855', 1, '2023-04-12 10:55:19', '2023-04-21 07:04:20', 19, '2023-04-21 07:04:20'),
(19, 'Neel Kumar', '98989564545111', 0, '2023-04-21 07:04:34', '2023-04-21 07:04:45', NULL, NULL),
(20, 'KANAN VADO', '9904406690', 0, '2023-06-12 05:12:16', '2023-06-12 05:12:16', NULL, NULL),
(21, '0812zebaaaniya@gmail.com', '9825363189', 0, '2023-06-13 04:20:20', '2023-06-13 04:20:20', NULL, NULL),
(22, 'BIREN.DARJI423@GMAIL.COM', '9601703576', 0, '2023-06-13 05:11:24', '2023-06-13 05:11:24', NULL, NULL),
(23, 'DAN SINGH', '8525653145', 0, '2023-06-27 07:15:02', '2023-06-27 07:15:02', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `manage_purposes`
--

CREATE TABLE `manage_purposes` (
  `id` int UNSIGNED NOT NULL,
  `purpose_name` varchar(255) NOT NULL,
  `purpose_code` varchar(255) NOT NULL,
  `documents` text,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `manage_purposes`
--

INSERT INTO `manage_purposes` (`id`, `purpose_name`, `purpose_code`, `documents`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'Travel', 'TS0001', '1,2,3,7', 1, '2023-04-02 23:08:56', '2023-04-21 07:36:55', NULL),
(4, 'Tour Payment', 'T001', '1,4,5,9,10,11,12,13,14,15', 1, '2023-04-02 23:09:44', '2023-05-30 08:09:14', NULL),
(6, 'Education Fees', 'S0305', '1,2,3,4,5,6,7', 1, '2023-04-03 00:28:26', '2023-05-26 06:41:05', NULL),
(8, 'GIC Education', 'GIC01', '1,2,3,4,5,6,8', 1, '2023-05-09 06:27:57', '2023-05-30 06:52:52', NULL),
(9, 'Immigration/VISA fees', 'IV01', '1,2,3,5,17', 1, '2023-05-09 06:28:26', '2023-05-30 08:11:37', NULL),
(10, 'Business Visits/ MICE PAYMENTS', 'BV01', '1,2,3,4,5,9,12,15,18,19,20,21', 1, '2023-05-09 06:28:59', '2023-07-03 10:51:44', NULL),
(11, 'Private visit - individual LRS', 'LRS', '1,2,3,4,5,11,12,13,15', 1, '2023-05-09 06:29:26', '2023-05-30 08:17:22', NULL),
(12, 'Medical treatment', 'Med', '1,2,3,22', 1, '2023-05-09 06:29:52', '2023-05-30 08:18:54', NULL),
(13, 'Film shooting', 'Film', '1,4,11,12,15,23,24,25,27,28,29,30,31', 1, '2023-05-09 06:30:43', '2023-05-30 08:22:06', NULL),
(14, 'Employment processing fees', 'EP', '1,2,3,17', 1, '2023-05-09 06:31:08', '2023-05-30 08:23:02', NULL),
(15, 'Consultancy fees', 'CONS', '1,2,3,32', 1, '2023-05-09 06:31:48', '2023-05-30 08:24:07', NULL),
(16, 'Skills / credential assessment fees', 'SKLfee', '1,2,3,32', 1, '2023-05-09 06:32:13', '2023-05-30 08:25:48', NULL),
(17, 'Document processing fees', 'DPF', '1,2,3,32', 1, '2023-05-09 06:32:33', '2023-05-30 08:30:28', NULL),
(18, 'Subscription fees', 'SF', '1,2,3,32,33', 1, '2023-05-09 06:32:56', '2023-05-30 08:31:31', NULL),
(19, 'Emigration Fees', 'EF', '1,2,3,5,17', 1, '2023-05-09 06:34:35', '2023-05-30 08:33:47', NULL),
(20, 'Travel Operator', 'S0306', '1,2,7,10,11,12,15', 1, '2023-07-26 03:08:30', '2023-07-26 03:08:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `manage_sources`
--

CREATE TABLE `manage_sources` (
  `id` int UNSIGNED NOT NULL,
  `source_name` varchar(255) NOT NULL,
  `tcs_rate` varchar(255) NOT NULL,
  `exempt` bigint NOT NULL,
  `documents` text,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `manage_sources`
--

INSERT INTO `manage_sources` (`id`, `source_name`, `tcs_rate`, `exempt`, `documents`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Relative', '2.5', 700000, '5,6', 1, '2023-04-03 22:53:09', '2023-04-04 00:11:27', NULL),
(4, 'Self', '5', 70000, NULL, 1, '2023-04-03 23:12:07', '2023-04-03 23:12:07', NULL),
(5, 'Loan', '0.55', 50000, NULL, 1, '2023-04-03 23:12:29', '2023-04-21 07:05:00', NULL),
(7, 'Home Loan', '6.50', 500000, NULL, 1, '2023-04-21 07:05:55', '2023-05-02 07:44:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2023_03_31_113806_add_required_documents', 3),
(4, '2023_03_31_102431_add_manage_purposes', 4),
(6, '2023_04_03_040540_add_tcs_manage_purposes', 5),
(7, '2023_04_03_124657_add_manage_sources', 6),
(9, '2023_04_04_052935_add_customer_table', 7),
(16, '2023_04_06_050517_add_transaction_currency_into_add_remit_fees', 10),
(17, '2023_04_05_094534_add_transactions_table', 11),
(19, '2023_04_05_102154_add_transaction_currency_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('062fb8c5-2c4b-48aa-941f-086102473eb2', 'App\\Notifications\\Transection', 'App\\Models\\User', 1, '{\"message\":\"New Rate #REF000027 Block Added\"}', '2023-08-10 22:00:00', '2023-08-11 02:42:52', '2023-08-11 02:43:02'),
('078b4d24-ec50-4218-8b07-ca7cbd2ffd65', 'App\\Notifications\\Transection', 'App\\Models\\User', 3, '{\"message\":\"New Rate #REF000028 Block Added\"}', NULL, '2023-08-11 02:45:30', '2023-08-11 02:45:30'),
('095bc917-501b-443e-92f9-e3121bcd9132', 'App\\Notifications\\Transection', 'App\\Models\\User', 4, '{\"message\":\"New Rate #REF000029 Block Added\"}', NULL, '2023-08-25 03:03:19', '2023-08-25 03:03:19'),
('0976e8c4-ed10-4033-b784-e3ad0f0c4b09', 'App\\Notifications\\Transection', 'App\\Models\\User', 3, '{\"message\":\"New Rate #REF000030 Block Added\"}', NULL, '2023-08-25 03:31:27', '2023-08-25 03:31:27'),
('0c3e6d12-b483-4414-93ea-cfd0c336f2a6', 'App\\Notifications\\Transection', 'App\\Models\\User', 3, '{\"message\":\"New Rate #REF000024 Block Added\"}', NULL, '2023-08-10 10:55:49', '2023-08-10 10:55:49'),
('112eb6b1-56c0-443b-9508-680bba44a8a5', 'App\\Notifications\\Transection', 'App\\Models\\User', 4, '{\"message\":\"New Rate #REF000001 Block Added\"}', NULL, '2023-08-25 04:03:56', '2023-08-25 04:03:56'),
('12c7e5ef-3f0e-4ace-b711-e708156b6b0b', 'App\\Notifications\\Transection', 'App\\Models\\User', 3, '{\"message\":\"New Rate #REF000002 Block Added\"}', NULL, '2023-08-25 04:12:06', '2023-08-25 04:12:06'),
('1388666e-9dc3-462a-9e1b-2248f633100d', 'App\\Notifications\\Transection', 'App\\Models\\User', 3, '{\"message\":\"New Rate #REF000007 Block Added\"}', NULL, '2023-08-31 05:19:44', '2023-08-31 05:19:44'),
('15fdfc6b-3868-4637-98c8-2562a29900e4', 'App\\Notifications\\Transection', 'App\\Models\\User', 4, '{\"message\":\"New Rate #REF000009 Block Added\"}', NULL, '2023-09-04 03:43:28', '2023-09-04 03:43:28'),
('1c947657-94fc-4ea5-866d-1306ea43ef27', 'App\\Notifications\\Transection', 'App\\Models\\User', 3, '{\"message\":\"New Rate #REF000010 Block Added\"}', NULL, '2023-09-22 07:18:15', '2023-09-22 07:18:15'),
('1f7d240c-fa42-484c-85c6-b9c5054d5ab7', 'App\\Notifications\\Transection', 'App\\Models\\AgentUsers', 25, '{\"message\":\"Rate #REF000014 Block Updated\"}', '2024-01-28 16:00:00', '2024-01-29 00:41:57', '2024-01-29 00:41:57'),
('20fe0522-a344-416e-a127-b08cb3fcb80f', 'App\\Notifications\\Transection', 'App\\Models\\User', 4, '{\"message\":\"New Rate #REF000003 Block Added\"}', NULL, '2023-08-25 04:43:21', '2023-08-25 04:43:21'),
('24eb0661-323b-4262-b57d-2663749d750f', 'App\\Notifications\\Transection', 'App\\Models\\AgentUsers', 25, '{\"message\":\"Rate #REF000012 Block Updated\"}', '2024-01-28 16:00:00', '2023-10-11 08:49:44', '2023-10-11 08:49:44'),
('26fdfd3c-0ab2-4c12-9502-775a68379936', 'App\\Notifications\\Transection', 'App\\Models\\User', 1, '{\"message\":\"New Rate #REF000026 Block Added\"}', '2023-08-09 22:00:00', '2023-08-10 10:57:58', '2023-08-10 10:57:58'),
('27332c19-89fc-49a0-8d3b-64de43e2d4cc', 'App\\Notifications\\Transection', 'App\\Models\\User', 3, '{\"message\":\"New Rate #REF000001 Block Added\"}', NULL, '2023-08-25 04:03:56', '2023-08-25 04:03:56'),
('27dcd209-1610-4b35-9588-5521a0e95b5a', 'App\\Notifications\\Transection', 'App\\Models\\AgentUsers', 25, '{\"message\":\"Rate #REF000006 Block Updated\"}', '2024-01-28 16:00:00', '2023-08-31 06:23:41', '2023-08-31 06:23:41'),
('281caf25-db5d-4182-a4ae-1bc4d1e14011', 'App\\Notifications\\Transection', 'App\\Models\\AgentUsers', 25, '{\"message\":\"Rate #REF000029 Block Updated\"}', '2024-01-28 16:00:00', '2023-08-25 03:04:13', '2023-08-25 03:04:13'),
('2979723c-a04c-424a-99dc-a6dc8b594b8c', 'App\\Notifications\\Transection', 'App\\Models\\User', 1, '{\"message\":\"New Rate #REF000006 Block Added\"}', '2023-08-30 22:00:00', '2023-08-31 05:18:42', '2023-08-31 05:18:49'),
('2c0b1f11-778b-43c6-9a66-d3206dbcdd0b', 'App\\Notifications\\Transection', 'App\\Models\\User', 3, '{\"message\":\"New Rate #REF000014 Block Added\"}', NULL, '2024-01-29 00:40:52', '2024-01-29 00:40:52'),
('311360cc-d591-4028-ac11-c665e78e5181', 'App\\Notifications\\Transection', 'App\\Models\\User', 1, '{\"message\":\"New Rate #REF000014 Block Added\"}', '2024-01-28 16:00:00', '2024-01-29 00:40:52', '2024-01-29 00:40:59'),
('31b24fc3-95e7-4888-8ad3-42e9c81f708c', 'App\\Notifications\\Transection', 'App\\Models\\User', 3, '{\"message\":\"New Rate #REF000027 Block Added\"}', NULL, '2023-08-11 02:42:53', '2023-08-11 02:42:53'),
('348b3b4e-a276-452e-b7ee-6facdba17c03', 'App\\Notifications\\Transection', 'App\\Models\\User', 4, '{\"message\":\"New Rate #REF000025 Block Added\"}', NULL, '2023-08-10 10:56:25', '2023-08-10 10:56:25'),
('395e76b2-d5a9-4fef-ba93-24ff658820fb', 'App\\Notifications\\Transection', 'App\\Models\\User', 4, '{\"message\":\"New Rate #REF000004 Block Added\"}', NULL, '2023-08-25 07:22:59', '2023-08-25 07:22:59'),
('3cd3c4e4-905f-49c4-9b6a-ca7afd50539a', 'App\\Notifications\\Transection', 'App\\Models\\User', 4, '{\"message\":\"New Rate #REF000008 Block Added\"}', NULL, '2023-09-04 03:41:46', '2023-09-04 03:41:46'),
('3fc3c303-ef1c-4238-8a8d-e0f64bf3dbdd', 'App\\Notifications\\Transection', 'App\\Models\\User', 3, '{\"message\":\"New Rate #REF000013 Block Added\"}', NULL, '2024-01-16 02:10:06', '2024-01-16 02:10:06'),
('41cceabc-e226-49cf-b91d-4d7630f0f612', 'App\\Notifications\\Transection', 'App\\Models\\User', 1, '{\"message\":\"New Rate #REF000003 Block Added\"}', '2023-08-24 22:00:00', '2023-08-25 04:43:21', '2023-08-25 04:43:23'),
('44345355-2ccf-4e7a-be32-2afc753a55b2', 'App\\Notifications\\Transection', 'App\\Models\\User', 4, '{\"message\":\"New Rate #REF000005 Block Added\"}', NULL, '2023-08-31 02:49:12', '2023-08-31 02:49:12'),
('4899b028-de38-4c7e-8b50-1208e6abee00', 'App\\Notifications\\Transection', 'App\\Models\\AgentUsers', 23, '{\"message\":\"Rate #REF000010 Block Updated\"}', '2023-09-21 22:00:00', '2023-09-22 07:19:28', '2023-09-22 07:19:28'),
('4f790db2-3447-4cf3-be43-7ea8e9c262e6', 'App\\Notifications\\Transection', 'App\\Models\\AgentUsers', 25, '{\"message\":\"Rate #REF000019 Block Updated\"}', '2024-01-28 16:00:00', '2023-08-08 15:00:44', '2023-08-08 15:00:44'),
('5491ed76-bc4e-4044-9c55-06c4913bd994', 'App\\Notifications\\Transection', 'App\\Models\\User', 1, '{\"message\":\"New Rate #REF000007 Block Added\"}', '2023-08-30 22:00:00', '2023-08-31 05:19:43', '2023-08-31 05:19:50'),
('5e39bf5d-d406-4ea5-8717-88bea71dd946', 'App\\Notifications\\Transection', 'App\\Models\\AgentUsers', 25, '{\"message\":\"Rate #REF000003 Block Updated\"}', '2024-01-28 16:00:00', '2023-08-25 04:43:33', '2023-08-25 04:43:33'),
('6c0f02ea-3aad-4354-aa49-db69864eacae', 'App\\Notifications\\Transection', 'App\\Models\\User', 1, '{\"message\":\"New Rate #REF000029 Block Added\"}', '2023-08-24 22:00:00', '2023-08-25 03:03:19', '2023-08-25 03:03:59'),
('6cee11e8-46ae-4507-9cc7-211800818e9d', 'App\\Notifications\\Transection', 'App\\Models\\User', 4, '{\"message\":\"New Rate #REF000002 Block Added\"}', NULL, '2023-08-25 04:12:06', '2023-08-25 04:12:06'),
('6ded583b-7a1f-47cc-999c-56e4f9670f58', 'App\\Notifications\\Transection', 'App\\Models\\User', 3, '{\"message\":\"New Rate #REF000005 Block Added\"}', NULL, '2023-08-31 02:49:12', '2023-08-31 02:49:12'),
('6e1a1425-d83d-4203-a505-0e36f3cd5dc2', 'App\\Notifications\\Transection', 'App\\Models\\User', 3, '{\"message\":\"New Rate #REF000008 Block Added\"}', NULL, '2023-09-04 03:41:46', '2023-09-04 03:41:46'),
('6f89df88-0eb5-4f0e-99ac-69cec62ee96a', 'App\\Notifications\\Transection', 'App\\Models\\User', 3, '{\"message\":\"New Rate #REF000006 Block Added\"}', NULL, '2023-08-31 05:18:42', '2023-08-31 05:18:42'),
('7111b237-ad3c-4967-be5c-7fd1005112f6', 'App\\Notifications\\Transection', 'App\\Models\\User', 1, '{\"message\":\"New Rate #REF000028 Block Added\"}', '2023-08-10 22:00:00', '2023-08-11 02:45:30', '2023-08-11 02:45:32'),
('721d7959-498a-4acc-9286-e0aff94961a1', 'App\\Notifications\\Transection', 'App\\Models\\AgentUsers', 25, '{\"message\":\"Rate #REF000009 Block Updated\"}', '2024-01-28 16:00:00', '2023-09-04 03:43:58', '2023-09-04 03:43:58'),
('735aeef2-bc29-47a7-a143-53103dee8895', 'App\\Notifications\\Transection', 'App\\Models\\User', 1, '{\"message\":\"New Rate #REF000004 Block Added\"}', '2023-08-24 22:00:00', '2023-08-25 07:22:59', '2023-08-25 07:23:06'),
('73ab810c-5e35-4a78-bea9-04a28cbaa092', 'App\\Notifications\\Transection', 'App\\Models\\User', 4, '{\"message\":\"New Rate #REF000013 Block Added\"}', NULL, '2024-01-16 02:10:06', '2024-01-16 02:10:06'),
('76f5c08a-ea55-4fc0-b794-d9c9aeee4d69', 'App\\Notifications\\Transection', 'App\\Models\\User', 4, '{\"message\":\"New Rate #REF000011 Block Added\"}', NULL, '2023-10-03 08:15:07', '2023-10-03 08:15:07'),
('79d6c49b-9304-4537-affe-98bea7157169', 'App\\Notifications\\Transection', 'App\\Models\\User', 4, '{\"message\":\"New Rate #REF000030 Block Added\"}', NULL, '2023-08-25 03:31:27', '2023-08-25 03:31:27'),
('7a2e2f94-6985-44b8-9071-590f9e88faa1', 'App\\Notifications\\Transection', 'App\\Models\\AgentUsers', 25, '{\"message\":\"Rate #REF000005 Block Updated\"}', '2024-01-28 16:00:00', '2023-08-31 02:50:54', '2023-08-31 02:50:54'),
('7c4e5d96-1b3b-4a15-95ed-c36ff894a2b9', 'App\\Notifications\\Transection', 'App\\Models\\AgentUsers', 25, '{\"message\":\"Rate #REF000028 Block Updated\"}', '2024-01-28 16:00:00', '2023-08-11 02:47:32', '2023-08-11 02:47:32'),
('7dcd283b-bbee-4192-9295-7fcbd045d7ce', 'App\\Notifications\\Transection', 'App\\Models\\User', 1, '{\"message\":\"New Rate #REF000002 Block Added\"}', '2023-08-24 22:00:00', '2023-08-25 04:12:06', '2023-08-25 04:12:13'),
('7ea380d5-ae43-46b3-9f3b-58a2696f218f', 'App\\Notifications\\Transection', 'App\\Models\\User', 1, '{\"message\":\"New Rate #REF000001 Block Added\"}', '2023-08-24 22:00:00', '2023-08-25 04:03:56', '2023-08-25 04:04:00'),
('850a7b1c-fcae-4247-bb92-16aa4c310d22', 'App\\Notifications\\Transection', 'App\\Models\\AgentUsers', 25, '{\"message\":\"Rate #REF000001 Block Updated\"}', '2024-01-28 16:00:00', '2023-08-25 04:04:23', '2023-08-25 04:04:23'),
('8552daa1-bf84-4ad1-837d-0e9f3f9abe5c', 'App\\Notifications\\Transection', 'App\\Models\\AgentUsers', 25, '{\"message\":\"Rate #REF000007 Block Updated\"}', '2024-01-28 16:00:00', '2023-08-31 06:24:15', '2023-08-31 06:24:15'),
('885028b4-7b66-4aad-a1fa-6bae3d1013bd', 'App\\Notifications\\Transection', 'App\\Models\\User', 4, '{\"message\":\"New Rate #REF000023 Block Added\"}', NULL, '2023-08-10 06:18:30', '2023-08-10 06:18:30'),
('9056d135-cc2d-4a0f-8f19-1f1578d0f5db', 'App\\Notifications\\Transection', 'App\\Models\\AgentUsers', 25, '{\"message\":\"Rate #REF000007 Block Updated\"}', '2024-01-28 16:00:00', '2023-08-31 06:23:24', '2023-08-31 06:23:24'),
('90b25b60-d4f5-4499-b3aa-0b378be67a41', 'App\\Notifications\\Transection', 'App\\Models\\AgentUsers', 25, '{\"message\":\"Rate #REF000002 Block Updated\"}', '2024-01-28 16:00:00', '2023-08-25 04:29:27', '2023-08-25 04:29:27'),
('93a01f37-7daa-4978-b595-8ccf6c179a23', 'App\\Notifications\\Transection', 'App\\Models\\User', 4, '{\"message\":\"New Rate #REF000028 Block Added\"}', NULL, '2023-08-11 02:45:30', '2023-08-11 02:45:30'),
('93d78240-ea57-4a9a-bc4f-c4149d6dac3c', 'App\\Notifications\\Transection', 'App\\Models\\User', 4, '{\"message\":\"New Rate #REF000012 Block Added\"}', NULL, '2023-10-11 08:49:05', '2023-10-11 08:49:05'),
('95acc958-6bf0-434b-a9f0-2091e70f694e', 'App\\Notifications\\Transection', 'App\\Models\\User', 4, '{\"message\":\"New Rate #REF000014 Block Added\"}', NULL, '2024-01-29 00:40:52', '2024-01-29 00:40:52'),
('99b38ddb-4642-4bf6-8f97-29de61654b04', 'App\\Notifications\\Transection', 'App\\Models\\User', 1, '{\"message\":\"New Rate #REF000024 Block Added\"}', '2023-08-09 22:00:00', '2023-08-10 10:55:49', '2023-08-10 10:55:50'),
('a64277ea-2a09-4200-835a-0e4cdea5af45', 'App\\Notifications\\Transection', 'App\\Models\\User', 1, '{\"message\":\"New Rate #REF000011 Block Added\"}', '2023-10-04 22:00:00', '2023-10-03 08:15:07', '2023-10-05 05:44:14'),
('a8a6b69f-0faf-478d-a5a2-37cd16ae349e', 'App\\Notifications\\Transection', 'App\\Models\\User', 1, '{\"message\":\"New Rate #REF000005 Block Added\"}', '2023-08-30 22:00:00', '2023-08-31 02:49:12', '2023-08-31 02:49:47'),
('ac4ec182-6ae6-40df-9a6d-2bbf8da2c79f', 'App\\Notifications\\Transection', 'App\\Models\\User', 3, '{\"message\":\"New Rate #REF000025 Block Added\"}', NULL, '2023-08-10 10:56:25', '2023-08-10 10:56:25'),
('ad2847de-2654-4ae0-958f-a6cec3ba9679', 'App\\Notifications\\Transection', 'App\\Models\\AgentUsers', 25, '{\"message\":\"Rate #REF000011 Block Updated\"}', '2024-01-28 16:00:00', '2023-10-05 05:45:26', '2023-10-05 05:45:26'),
('af596c9a-5926-472d-8609-1bdcf54e1c83', 'App\\Notifications\\Transection', 'App\\Models\\User', 1, '{\"message\":\"New Rate #REF000012 Block Added\"}', '2023-10-10 22:00:00', '2023-10-11 08:49:05', '2023-10-11 08:49:07'),
('bb6faae9-1809-46fc-a5fd-89a0944485f7', 'App\\Notifications\\Transection', 'App\\Models\\User', 1, '{\"message\":\"New Rate #REF000030 Block Added\"}', '2023-08-24 22:00:00', '2023-08-25 03:31:27', '2023-08-25 03:31:31'),
('bca05fbf-95b0-4cff-96d7-bc1c90f38e45', 'App\\Notifications\\Transection', 'App\\Models\\User', 3, '{\"message\":\"New Rate #REF000026 Block Added\"}', NULL, '2023-08-10 10:57:58', '2023-08-10 10:57:58'),
('becf7eaa-a170-4b0b-91e0-dcb0a0f9d261', 'App\\Notifications\\Transection', 'App\\Models\\User', 3, '{\"message\":\"New Rate #REF000029 Block Added\"}', NULL, '2023-08-25 03:03:19', '2023-08-25 03:03:19'),
('bfcff00c-bf21-4851-aeac-e244525ce96f', 'App\\Notifications\\Transection', 'App\\Models\\User', 3, '{\"message\":\"New Rate #REF000011 Block Added\"}', NULL, '2023-10-03 08:15:07', '2023-10-03 08:15:07'),
('c1b453b9-86bd-4471-8a52-ae4708d0b2a9', 'App\\Notifications\\Transection', 'App\\Models\\User', 3, '{\"message\":\"New Rate #REF000004 Block Added\"}', NULL, '2023-08-25 07:22:59', '2023-08-25 07:22:59'),
('c3e21cbd-4ac3-4540-9d8b-ce716cc96fe1', 'App\\Notifications\\Transection', 'App\\Models\\User', 4, '{\"message\":\"New Rate #REF000010 Block Added\"}', NULL, '2023-09-22 07:18:15', '2023-09-22 07:18:15'),
('cbc59ae2-4aec-408a-8479-5d5757385f2b', 'App\\Notifications\\Transection', 'App\\Models\\User', 4, '{\"message\":\"New Rate #REF000007 Block Added\"}', NULL, '2023-08-31 05:19:44', '2023-08-31 05:19:44'),
('cc97fca9-402c-49a9-ad65-d4853f3ef8e4', 'App\\Notifications\\Transection', 'App\\Models\\User', 3, '{\"message\":\"New Rate #REF000009 Block Added\"}', NULL, '2023-09-04 03:43:28', '2023-09-04 03:43:28'),
('ced1278c-41d4-4a5e-9fa5-b275c1013d4f', 'App\\Notifications\\Transection', 'App\\Models\\User', 1, '{\"message\":\"New Rate #REF000013 Block Added\"}', '2024-01-15 16:00:00', '2024-01-16 02:10:06', '2024-01-16 02:10:55'),
('d0ed0fde-9259-4c16-a24e-5bce631fc26a', 'App\\Notifications\\Transection', 'App\\Models\\User', 1, '{\"message\":\"New Rate #REF000010 Block Added\"}', '2023-09-21 22:00:00', '2023-09-22 07:18:15', '2023-09-22 07:18:48'),
('d2363a90-bc62-4514-9fff-784707bc7802', 'App\\Notifications\\Transection', 'App\\Models\\AgentUsers', 25, '{\"message\":\"Rate #REF000030 Block Updated\"}', '2024-01-28 16:00:00', '2023-08-25 03:33:41', '2023-08-25 03:33:41'),
('d25615eb-9018-445f-85a2-6e7ea698672c', 'App\\Notifications\\Transection', 'App\\Models\\User', 3, '{\"message\":\"New Rate #REF000023 Block Added\"}', NULL, '2023-08-10 06:18:30', '2023-08-10 06:18:30'),
('d7ffcadf-b4e0-4a08-b60e-58650c3323d0', 'App\\Notifications\\Transection', 'App\\Models\\User', 4, '{\"message\":\"New Rate #REF000024 Block Added\"}', NULL, '2023-08-10 10:55:49', '2023-08-10 10:55:49'),
('dd8eff40-915d-4c5d-9c15-2c1ff5251208', 'App\\Notifications\\Transection', 'App\\Models\\User', 1, '{\"message\":\"New Rate #REF000025 Block Added\"}', '2023-08-09 22:00:00', '2023-08-10 10:56:25', '2023-08-10 10:56:28'),
('e11c7771-e3df-48f4-9313-fe408a7cd83c', 'App\\Notifications\\Transection', 'App\\Models\\User', 4, '{\"message\":\"New Rate #REF000027 Block Added\"}', NULL, '2023-08-11 02:42:53', '2023-08-11 02:42:53'),
('e5606835-1f1e-419c-b1f5-9cff73177f60', 'App\\Notifications\\Transection', 'App\\Models\\AgentUsers', 25, '{\"message\":\"Rate #REF000004 Block Updated\"}', '2024-01-28 16:00:00', '2023-08-25 07:23:50', '2023-08-25 07:23:50'),
('e61b61b8-c430-4bf7-9ed5-f35012fafaec', 'App\\Notifications\\Transection', 'App\\Models\\User', 1, '{\"message\":\"New Rate #REF000023 Block Added\"}', '2023-08-09 22:00:00', '2023-08-10 06:18:30', '2023-08-10 06:18:36'),
('e8866aca-e1a4-49d0-bedc-5f4626176445', 'App\\Notifications\\Transection', 'App\\Models\\User', 1, '{\"message\":\"New Rate #REF000008 Block Added\"}', '2023-09-03 22:00:00', '2023-09-04 03:41:46', '2023-09-04 03:42:33'),
('f2b5a30f-f998-4dc5-97e0-4dd24eba72d6', 'App\\Notifications\\Transection', 'App\\Models\\User', 3, '{\"message\":\"New Rate #REF000003 Block Added\"}', NULL, '2023-08-25 04:43:21', '2023-08-25 04:43:21'),
('f41109cc-2fa9-4197-919a-c41356cebb68', 'App\\Notifications\\Transection', 'App\\Models\\User', 4, '{\"message\":\"New Rate #REF000026 Block Added\"}', NULL, '2023-08-10 10:57:58', '2023-08-10 10:57:58'),
('f8cc52c9-cb91-4b43-a3bb-d490bdd2c033', 'App\\Notifications\\Transection', 'App\\Models\\User', 4, '{\"message\":\"New Rate #REF000006 Block Added\"}', NULL, '2023-08-31 05:18:42', '2023-08-31 05:18:42'),
('feb946c4-4446-472e-bd3f-c2f465c6ce76', 'App\\Notifications\\Transection', 'App\\Models\\User', 3, '{\"message\":\"New Rate #REF000012 Block Added\"}', NULL, '2023-10-11 08:49:05', '2023-10-11 08:49:05'),
('fec2559f-9a7d-4520-9105-afe60a88cc6c', 'App\\Notifications\\Transection', 'App\\Models\\User', 1, '{\"message\":\"New Rate #REF000009 Block Added\"}', '2023-09-03 22:00:00', '2023-09-04 03:43:28', '2023-09-04 03:43:32');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int NOT NULL,
  `user_id` int NOT NULL DEFAULT '0',
  `transaction_id` text,
  `r_payment_id` text,
  `method` text,
  `currency` double(9,2) NOT NULL DEFAULT '0.00',
  `user_email` text,
  `amount` double(9,2) NOT NULL DEFAULT '0.00',
  `json_response` longtext,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `rate_blocks`
--

CREATE TABLE `rate_blocks` (
  `id` int UNSIGNED NOT NULL,
  `reference_number` text,
  `branch_id` int NOT NULL DEFAULT '0',
  `fx_currency` varchar(255) DEFAULT NULL,
  `fx_value` varchar(255) DEFAULT NULL,
  `purpose_id` int NOT NULL DEFAULT '0',
  `transaction_type` int NOT NULL DEFAULT '0',
  `fx_rate` varchar(255) DEFAULT NULL,
  `deal_id` varchar(255) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `is_used` tinyint NOT NULL DEFAULT '0' COMMENT '0-unused,1-used',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `rate_blocks`
--

INSERT INTO `rate_blocks` (`id`, `reference_number`, `branch_id`, `fx_currency`, `fx_value`, `purpose_id`, `transaction_type`, `fx_rate`, `deal_id`, `expiry_date`, `is_used`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'REF000001', 25, 'USD/INR', '1000', 3, 1, '1000', '00', '2023-08-29', 1, '2023-08-25 04:03:56', '2023-08-25 04:05:34', NULL),
(2, 'REF000002', 25, 'USD/INR', '100', 3, 1, '94', 'ASD001', '2023-08-29', 1, '2023-08-25 04:12:06', '2023-08-25 04:32:40', NULL),
(3, 'REF000003', 25, 'USD/INR', '1000', 3, 1, '1000', '00', '2023-08-29', 1, '2023-08-25 04:43:21', '2023-08-25 04:44:39', NULL),
(4, 'REF000004', 25, 'USD/INR', '1', 3, 1, '90', 'ASD010', '2023-08-29', 1, '2023-08-25 07:22:59', '2023-08-25 07:26:50', NULL),
(5, 'REF000005', 25, 'USD/INR', '1', 3, 1, '90', 'ASRL012', '2023-09-04', 1, '2023-08-31 02:49:12', '2023-08-31 03:56:34', NULL),
(6, 'REF000006', 25, 'USD/INR', '1', 3, 1, '90', 'USD014274', '2023-09-04', 1, '2023-08-31 05:18:42', '2023-08-31 06:31:14', NULL),
(7, 'REF000007', 25, 'USD/INR', '1', 3, 1, '90', 'USD0014', '2023-09-04', 1, '2023-08-31 05:19:43', '2023-08-31 10:08:50', NULL),
(8, 'REF000007', 25, 'CAD/INR', '1', 3, 1, '86', 'CAD01258', '2023-09-04', 1, '2023-08-31 05:19:43', '2023-08-31 06:31:14', NULL),
(9, 'REF000008', 25, 'USD/INR', '1', 3, 1, NULL, NULL, NULL, 0, '2023-09-04 03:41:46', '2023-09-04 03:41:46', NULL),
(10, 'REF000009', 25, 'USD/INR', '5000', 3, 1, '90', 'ASf001', '2023-09-08', 1, '2023-09-04 03:43:28', '2023-09-04 03:44:43', NULL),
(11, 'REF000010', 23, 'USD/INR', '1', 3, 1, '100', 'ASD001', '2023-09-26', 1, '2023-09-22 07:18:15', '2023-09-22 07:22:35', NULL),
(12, 'REF000011', 25, 'USD/INR', '1500', 6, 1, NULL, NULL, NULL, 0, '2023-10-03 08:15:07', '2023-10-03 08:15:07', NULL),
(13, 'REF000011', 25, 'EUR/INR', '1000', 9, 1, '110', 'ABC122', '2023-10-09', 0, '2023-10-03 08:15:07', '2023-10-05 05:45:26', NULL),
(14, 'REF000012', 25, 'USD/INR', '5000', 3, 1, '81.30', 'ABC123', '2023-10-15', 1, '2023-10-11 08:49:05', '2023-10-11 09:01:30', NULL),
(15, 'REF000013', 25, 'USD/INR', '5000', 3, 1, NULL, NULL, NULL, 0, '2024-01-16 02:10:06', '2024-01-16 02:10:06', NULL),
(16, 'REF000014', 25, 'USD/INR', '5000', 6, 1, '82.14', 'ABC00345', '2024-02-02', 1, '2024-01-29 00:40:52', '2024-01-29 00:46:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `required_documents`
--

CREATE TABLE `required_documents` (
  `id` int UNSIGNED NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `document_value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `required_documents`
--

INSERT INTO `required_documents` (`id`, `document_name`, `document_value`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'a2form', 'A2 Form', NULL, NULL, NULL),
(2, 'pan_card', 'PAN', NULL, NULL, NULL),
(3, 'passport', 'Passport', NULL, NULL, NULL),
(4, 'visa', 'Visa', NULL, NULL, NULL),
(5, 'fema_declaration', 'FEMA Declaration', NULL, NULL, NULL),
(6, 'offer_letter', 'Offer Letter', NULL, NULL, NULL),
(7, 'other', 'Other', NULL, NULL, NULL),
(8, 'valid_gic_letter', 'Valid GIC Letter', NULL, NULL, NULL),
(9, 'gst_of_remitter', 'GST of Remitter', NULL, NULL, NULL),
(10, 'participant_list_of_passengers', 'Participant list of passengers', NULL, NULL, NULL),
(11, 'passenger_pan', 'Passenger PAN', NULL, NULL, NULL),
(12, 'passenger_passport', 'Passenger Passport', NULL, NULL, NULL),
(13, 'beneficiary_invoice', 'Beneficiary Invoice', NULL, NULL, NULL),
(14, 'tcs_declaration', 'TCS Declaration', NULL, NULL, NULL),
(15, 'ticket_copy', 'Ticket Copy', NULL, NULL, NULL),
(16, 'certificate_of_registration_of_haj_group', 'Certificate  of Registration of Haj Group', NULL, NULL, NULL),
(17, 'employemnt_letter_or_visa_confirmation_letter', 'Employemnt letter or Visa confirmation letter', NULL, NULL, NULL),
(18, 'sponsor_letter_from_corporate', 'Sponsor Letter From Corporate', NULL, NULL, NULL),
(19, 'sponsorship_company_gst', 'Sponsorship Company GST', NULL, NULL, NULL),
(20, 'sponsorship_company_pan', 'Sponsorship Company PAN', NULL, NULL, NULL),
(21, 'beneficiary_invoice', 'Beneficiary Invoice', NULL, NULL, NULL),
(22, 'letter_from_overseas_hospital', 'Letter from Overseas Hospital', NULL, NULL, NULL),
(23, 'agreement_of_overseas_parties', 'Agreement Of Overseas Parties', NULL, NULL, NULL),
(24, 'invoices_relating_expenses', 'Invoices Relating Expenses', NULL, NULL, NULL),
(25, 'form_15ca', 'Form 15CA', NULL, NULL, NULL),
(27, 'form_15cb', 'Form 15CB', NULL, NULL, NULL),
(28, 'producer_pan', 'Producer PAN', NULL, NULL, NULL),
(29, 'producer_passport_aadhar', 'Producer Passport Aadhar', NULL, NULL, NULL),
(30, 'itr', 'ITR', NULL, NULL, NULL),
(31, 'beneficiary_passport', 'Beneficiary Passport', NULL, NULL, NULL),
(32, 'invoice', 'Invoice', NULL, NULL, NULL),
(33, 'corporate_kyc', 'Corporate KYC', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int UNSIGNED NOT NULL,
  `txn_number` varchar(255) NOT NULL,
  `customer_id` int NOT NULL,
  `txn_type` varchar(255) NOT NULL,
  `booking_purpose_id` int NOT NULL,
  `fund_source_id` int NOT NULL,
  `pancard_no` varchar(255) NOT NULL,
  `pancard_name` varchar(255) NOT NULL,
  `pancard_relation` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_mobile` varchar(255) DEFAULT NULL,
  `agent_code` varchar(255) DEFAULT NULL,
  `agent_name` varchar(255) DEFAULT NULL,
  `is_otp` tinyint NOT NULL DEFAULT '0',
  `payment_type` int NOT NULL DEFAULT '0',
  `remit_fees` int NOT NULL DEFAULT '0',
  `nostro_charge` double(9,2) NOT NULL DEFAULT '0.00',
  `swift_charges` double(9,2) NOT NULL DEFAULT '0.00',
  `is_active` tinyint NOT NULL DEFAULT '1',
  `payment_status` int NOT NULL DEFAULT '0',
  `tcs` double DEFAULT NULL,
  `amount_for_tcs` double DEFAULT NULL,
  `gst` double DEFAULT NULL,
  `net_amount` double NOT NULL,
  `gross_payable` double NOT NULL,
  `transaction_status` tinyint NOT NULL DEFAULT '0' COMMENT '0-pending, 1-approved, 2-rejected, 3-refunded, 4-expired	',
  `expired_date` date DEFAULT NULL,
  `document_upload_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 - show upload button, 1 - Hide upload button',
  `kyc_status` tinyint NOT NULL DEFAULT '0' COMMENT '0 = pending, 1 = completed, 2 = rejected',
  `kyc_comment` text,
  `payment_upload_document` text,
  `payment_comment` text,
  `customer_reference` text,
  `dd_number` text,
  `forward_booking_ref` text,
  `remitter_address` text,
  `remitter_city` text,
  `remitter_country` text,
  `remitter_email` text,
  `remitter_mobile` varchar(20) DEFAULT NULL,
  `beneficiary_name` text,
  `beneficiary_address` text,
  `beneficiary_city` text,
  `beneficiary_country` text,
  `beneficiary_ac_number` text,
  `beneficiary_bank_name` text,
  `beneficiary_bank_address` text,
  `beneficiary_bank_sort` text,
  `beneficiary_swift_code` text,
  `sub_purpose_code` text,
  `additional_detail` text,
  `fb_charges` text,
  `interm_bank_name` text,
  `interm_address` text,
  `interm_bic_code` text,
  `interm_bank_sort` text,
  `individual_entity_corporate` text,
  `razorpay_paymentid` text,
  `razorpay_orderid` text,
  `razorpay_signature` longtext,
  `status` int NOT NULL DEFAULT '0',
  `p_status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `txn_number`, `customer_id`, `txn_type`, `booking_purpose_id`, `fund_source_id`, `pancard_no`, `pancard_name`, `pancard_relation`, `customer_name`, `customer_mobile`, `agent_code`, `agent_name`, `is_otp`, `payment_type`, `remit_fees`, `nostro_charge`, `swift_charges`, `is_active`, `payment_status`, `tcs`, `amount_for_tcs`, `gst`, `net_amount`, `gross_payable`, `transaction_status`, `expired_date`, `document_upload_status`, `kyc_status`, `kyc_comment`, `payment_upload_document`, `payment_comment`, `customer_reference`, `dd_number`, `forward_booking_ref`, `remitter_address`, `remitter_city`, `remitter_country`, `remitter_email`, `remitter_mobile`, `beneficiary_name`, `beneficiary_address`, `beneficiary_city`, `beneficiary_country`, `beneficiary_ac_number`, `beneficiary_bank_name`, `beneficiary_bank_address`, `beneficiary_bank_sort`, `beneficiary_swift_code`, `sub_purpose_code`, `additional_detail`, `fb_charges`, `interm_bank_name`, `interm_address`, `interm_bic_code`, `interm_bank_sort`, `individual_entity_corporate`, `razorpay_paymentid`, `razorpay_orderid`, `razorpay_signature`, `status`, `p_status`, `created_at`, `updated_at`, `created_by`, `deleted_at`) VALUES
(1, 'A000001', 3, '1', 3, 2, 'CTFPD7745F', 'RAVI', 'GYG', 'shiv', NULL, '8888', NULL, 0, 1, 0, 1250.00, 250.00, 1, 2, NULL, 0, 270, 117600, 119370, 0, '2023-08-31', 1, 1, NULL, '1692961515582_A000001_payment.png', 'ujjjjjjjjjjj', NULL, NULL, NULL, '8, VISHNU VIHAR, ARJUN NAGAR DURGAPURA', 'JAIPUR', 'india', 'uhuhuhuhu@mailinator.com', '09549629172', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'individual', NULL, NULL, NULL, 1, 1, '2023-08-25 04:05:34', '2023-08-25 14:35:15', 25, NULL),
(2, 'A000002', 12, '1', 3, 4, 'ASDL0123A', 'TILAK', 'SELF', 'Tilak', NULL, NULL, NULL, 0, 1, 100, 1260.00, 250.00, 1, 1, NULL, 0, 272, 34400, 36282, 1, '2023-08-31', 1, 1, NULL, '1692961765913_A000002_payment.png', 'uhhhhhhijijijijijiijijiji', '1111', '123', 'REF102', 'VESU', 'SURAT', 'india', 'tilak@yopmail.com', '8965320147', 'TILAK', 'SURAT', 'SURAT', 'india', 'DBI0142122245', 'BOB', 'VESU', 'TERST', '1101', 'A001', 'EDUCATION', '1500', 'HDFC', 'VESU', 'HDFC001', 'HDFC101D12', 'individual', NULL, NULL, NULL, 1, 2, '2023-08-25 04:32:40', '2023-08-25 09:24:48', 25, NULL),
(3, 'A000003', 3, '1', 3, 2, '99999999', 'RAVI', '99', 'shiv', NULL, NULL, '9', 0, 0, 0, 1250.00, 250.00, 1, 0, NULL, 0, 270, 119800, 121570, 0, '2023-08-31', 1, 0, NULL, NULL, NULL, 'UUU', '9', NULL, '8, VISHNU VIHAR, ARJUN NAGAR DURGAPURA', 'JAIPUR', 'iceland', 'uhuhuhuhu@mailinator.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'individual', NULL, NULL, NULL, 1, 0, '2023-08-25 04:44:39', '2023-08-25 10:17:44', 25, NULL),
(4, 'A000004', 13, '1', 3, 2, 'ASDL0123SA', 'SELF', 'SELF', 'Jay', NULL, '101', NULL, 0, 1, 500, 1500.00, 250.00, 1, 1, NULL, 0, 315, 2790, 5355, 1, '2023-08-31', 1, 1, 'Test transaction', '1692961829831_A000004_payment.webp', NULL, '1111', '123', 'REF102', 'SURAT', 'SURAT', 'india', 'jay@yopmail.com', '8965320147', 'VICKY', 'SURAT', 'SURAT', 'india', 'DBI0142122245', 'BOB', 'VESU', '0124563', '1101', 'A001', 'EDUCATION', '1500', 'HDFC', 'SURAT', 'HDFC001', 'HDFC101D12', 'individual', NULL, NULL, NULL, 1, 1, '2023-08-25 07:26:50', '2023-08-25 09:11:22', 25, NULL),
(5, 'A000005', 14, '1', 3, 2, 'ASDL1020P', 'SELF', 'SELF', 'Nishant', NULL, NULL, NULL, 0, 0, 1500, 1560.00, 250.00, 1, 1, NULL, 0, 326, 360, 3996, 1, '2023-09-06', 1, 1, 'Test transaction', NULL, NULL, NULL, NULL, NULL, 'VESU', 'SURAT', 'india', 'nishant@yopmail.com', '8596320147', 'NISHANT', 'VESU', 'SURAT', 'united states', 'ASD0124', 'BANK OF BARODA', 'US', 'BOBSK0015', 'SWFT085241', '1410AS', 'EDUCATION', '1500', 'STATE BANK OF INDIA', 'US', 'BOB0143AS', 'ASDL9802', 'individual', 'pay_MfLYVlRREC7A3k', 'order_MfLYC51Jnnrz1h', 'ec3087ff1efe862d5b04cd0049f0f67df728ad30435c579a19668c464f8a843d', 1, 1, '2023-08-31 03:56:34', '2023-09-22 08:22:54', 25, NULL),
(6, 'A000006', 11, '1', 3, 2, 'ASWS01245A', 'VICKY', 'SELF', 'Vicky', NULL, 'ASAS0012', NULL, 0, 1, 1200, 1560.00, 250.00, 1, 1, NULL, 0, 326, 456, 3792, 1, '2023-09-06', 1, 1, 'Test transaction', '1693471207862_A000006_payment.webp', 'Test incident', NULL, NULL, NULL, 'VESU', 'SURAT', 'india', 'nishant@yopmail.com', '8596320147', 'NISHANT', 'VESU', 'SURAT', 'india', 'ASD0012', 'BOB', 'VESU', 'BSAD01', 'ASDL011424', 'PURPOS1452', 'EDUCATION', '1200', 'STATE BANK OF INDIA', 'US', 'BOB0143AS', 'ASDL9802', 'individual', NULL, NULL, NULL, 1, 2, '2023-08-31 06:31:14', '2023-08-31 06:41:33', 25, NULL),
(7, 'A000007', 12, '1', 3, 2, 'ASDL1025L', 'SELF', 'SELF', 'Tilak', NULL, '101', NULL, 0, 1, 500, 1800.00, 250.00, 1, 0, NULL, 0, 369, 100, 3019, 0, '2023-09-06', 1, 1, 'Test transaction', '1693484353259_A000007_payment.pdf', 'test inciden', '1111', '123', NULL, 'VESU', 'SURAT', 'india', 'tilak@yopmail.com', '8965320147', 'TILAK', 'SURAT', 'SURAT', 'india', 'DBI0142122245', 'BOB', 'VESU', 'TERST', 'SD999', 'A001', 'EDUCATION', '1500', 'BOB', 'SURAT', 'HDFC001', 'HDFC101D12', 'individual', NULL, NULL, NULL, 1, 1, '2023-08-31 10:08:50', '2023-08-31 15:49:13', 25, NULL),
(8, 'A000008', 3, '1', 3, 4, 'AJFPD1234D', 'SHIV', 'SELF', 'shiv', NULL, NULL, NULL, 0, 0, 250, 1250.00, 250.00, 1, 0, NULL, 19025, 270, 450500, 471545, 0, '2023-09-08', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'ABC', 'DELHI', 'india', 'a@gmail.com', '9833445522', 'DEF', 'DEFG', 'TORONTO', 'canada', '123456', 'CANADA BANK', 'TORONTO', 'AQS123', 'ADFGGH', 'QWER', NULL, NULL, NULL, NULL, NULL, NULL, 'individual', NULL, NULL, NULL, 0, 0, '2023-09-04 03:44:43', '2023-09-04 03:44:43', 25, NULL),
(9, 'A000009', 3, '1', 3, 2, 'ASDLK123E', 'VICKY', 'SELF', 'shiv', NULL, '101', 'AGENT1', 0, 0, 100, 1500.00, 250.00, 1, 1, NULL, 0, 315, 100, 2265, 1, '2023-09-28', 1, 1, 'Test transaction', NULL, NULL, '1111', '123', 'REF102', 'VESU', 'SURAT', 'india', 'vicky@yopmail.com', '8965320147', 'VICKY', 'SURAT', 'SURAT', 'india', 'DBI0142122245', 'BOB', 'VESU', 'TERST', '1101', 'A001', 'EDUCATION', '1500', 'HDFC', 'SURAT', 'HDFC001', 'HDFC101D12', 'individual', 'pay_MfKidkxe5ADbXg', 'order_MfKhHmLGvklRfU', '103aee2c0eb75e017a0f95a0febe02a869ee2fa178026837dd9696a63701b13e', 1, 1, '2023-09-22 07:22:35', '2023-09-22 07:33:47', 23, NULL),
(10, 'A000010', 3, '1', 3, 2, 'AJFPQ0987R', 'JACK JAMES', 'SPOUSE', 'shiv', NULL, NULL, NULL, 0, 0, 500, 1250.00, 250.00, 1, 0, NULL, 0, 270, 408500, 410770, 0, '2023-10-17', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'DELHI', 'india', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'corporate', NULL, NULL, NULL, 0, 0, '2023-10-11 09:01:30', '2023-10-11 09:01:30', 25, NULL),
(11, 'A000011', 10, '1', 6, 4, 'AJFPD0197D', 'BILAL DHUNNA', 'FATHER', 'JACK & JONE', NULL, NULL, NULL, 0, 1, 100, 1250.00, 250.00, 1, 0, NULL, 17085, 270, 411700, 430655, 0, '2024-02-02', 1, 1, NULL, '1706518240631_A000011_payment.jpg', NULL, NULL, NULL, NULL, 'ABC BENGALURU', 'BENGALURU', 'india', 'bilal@dataseedtech.com', '9833559822', 'HARVARD UNIVERSITY', 'USA', 'DALLAS', 'united states', '12345', 'CANADA BANK', 'TORONTO', 'AQS123', 'ADFGGH', 'QWER', NULL, NULL, NULL, NULL, NULL, NULL, 'individual', NULL, NULL, NULL, 1, 1, '2024-01-29 00:46:38', '2024-01-29 06:20:40', 25, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_currency`
--

CREATE TABLE `transaction_currency` (
  `id` int UNSIGNED NOT NULL,
  `txn_id` varchar(255) NOT NULL,
  `txn_currency_type` varchar(255) NOT NULL,
  `txn_frgn_curr_amount` int NOT NULL,
  `txn_inr_amount` int NOT NULL,
  `txn_booking_rate` double(8,2) NOT NULL,
  `txn_branch_margin` double NOT NULL,
  `txn_agent_commission` text,
  `txn_rate_block_id` int NOT NULL,
  `branch_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `transaction_currency`
--

INSERT INTO `transaction_currency` (`id`, `txn_id`, `txn_currency_type`, `txn_frgn_curr_amount`, `txn_inr_amount`, `txn_booking_rate`, `txn_branch_margin`, `txn_agent_commission`, `txn_rate_block_id`, `branch_id`) VALUES
(1, 'A000001', 'USD/INR', 100, 117600, 1176.00, 88, '88', 1, 25),
(2, 'A000002', 'USD/INR', 100, 34400, 344.00, 100, '150', 2, 25),
(3, 'A000003', 'USD/INR', 100, 119800, 1198.00, 99, '99', 3, 25),
(4, 'A000004', 'USD/INR', 1, 2790, 2790.00, 1200, '1500', 4, 25),
(5, 'A000005', 'USD/INR', 1, 360, 360.00, 150, '120', 5, 25),
(6, 'A000006', 'USD/INR', 1, 230, 230.00, 20, '120', 6, 25),
(7, 'A000006', 'CAD/INR', 1, 226, 226.00, 20, '120', 8, 25),
(8, 'A000007', 'USD/INR', 1, 100, 100.40, 0.2, '10.20', 7, 25),
(9, 'A000008', 'USD/INR', 5000, 450500, 90.10, 0.1, 'null', 10, 25),
(10, 'A000009', 'USD/INR', 1, 100, 100.30, 0.1, '0.20', 11, 23),
(11, 'A000010', 'USD/INR', 5000, 408500, 81.70, 0.3, '0.10', 14, 25),
(12, 'A000011', 'USD/INR', 5000, 411700, 82.34, 0.1, '0.10', 16, 25);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_kycs`
--

CREATE TABLE `transaction_kycs` (
  `id` int UNSIGNED NOT NULL,
  `txn_link_no` varchar(255) NOT NULL,
  `passport` varchar(255) DEFAULT NULL,
  `passport_status` enum('0','1','2') NOT NULL DEFAULT '0',
  `passport_comment` varchar(255) DEFAULT NULL,
  `visa` varchar(255) DEFAULT NULL,
  `visa_status` varchar(255) DEFAULT NULL,
  `visa_comment` varchar(255) DEFAULT NULL,
  `ticket` varchar(255) DEFAULT NULL,
  `ticket_status` varchar(255) DEFAULT NULL,
  `ticket_comment` varchar(255) DEFAULT NULL,
  `pan_card` varchar(255) DEFAULT NULL,
  `pan_card_status` varchar(255) DEFAULT NULL,
  `pan_card_comment` varchar(255) DEFAULT NULL,
  `university_letter` varchar(255) DEFAULT NULL,
  `university_letter_status` varchar(255) DEFAULT NULL,
  `university_letter_comment` varchar(255) DEFAULT NULL,
  `employment_letter` varchar(255) DEFAULT NULL,
  `emp_letter_status` varchar(255) DEFAULT NULL,
  `emp_letter_comment` varchar(255) DEFAULT NULL,
  `offer_letter` varchar(255) DEFAULT NULL,
  `offer_letter_status` varchar(255) DEFAULT NULL,
  `offer_letter_comment` varchar(255) DEFAULT NULL,
  `medical_letter` varchar(255) DEFAULT NULL,
  `medical_letter_status` varchar(255) DEFAULT NULL,
  `medical_letter_comment` varchar(255) DEFAULT NULL,
  `other` varchar(255) DEFAULT NULL,
  `other_status` varchar(255) DEFAULT NULL,
  `other_comment` varchar(255) DEFAULT NULL,
  `a2form` varchar(255) DEFAULT NULL,
  `a2form_status` varchar(255) DEFAULT NULL,
  `a2form_comment` varchar(255) DEFAULT NULL,
  `fema_declaration` varchar(255) DEFAULT NULL,
  `fema_declaration_status` varchar(255) DEFAULT NULL,
  `fema_declaration_comment` varchar(255) DEFAULT NULL,
  `valid_gic_letter` text,
  `valid_gic_letter_status` varchar(50) DEFAULT NULL,
  `valid_gic_letter_comment` text,
  `gst_of_remitter` text,
  `gst_of_remitter_status` varchar(50) DEFAULT NULL,
  `gst_of_remitter_comment` text,
  `participant_list_of_passengers` text,
  `participant_list_of_passengers_status` varchar(50) DEFAULT NULL,
  `participant_list_of_passengers_comment` text,
  `passenger_pan` text,
  `passenger_pan_status` varchar(50) DEFAULT NULL,
  `passenger_pan_comment` text,
  `passenger_passport` text,
  `passenger_passport_status` varchar(50) DEFAULT NULL,
  `passenger_passport_comment` text,
  `beneficiary_invoice` text,
  `beneficiary_invoice_status` varchar(50) DEFAULT NULL,
  `beneficiary_invoice_comment` text,
  `tcs_declaration` text,
  `tcs_declaration_status` varchar(50) DEFAULT NULL,
  `tcs_declaration_comment` text,
  `ticket_copy` text,
  `ticket_copy_status` varchar(50) DEFAULT NULL,
  `ticket_copy_comment` text,
  `certificate_of_registration_of_haj_group` text,
  `certificate_of_registration_of_haj_group_status` varchar(50) DEFAULT NULL,
  `certificate_of_registration_of_haj_group_comment` text,
  `employemnt_letter_or_visa_confirmation_letter` text,
  `employemnt_letter_or_visa_confirmation_letter_status` varchar(50) DEFAULT NULL,
  `employemnt_letter_or_visa_confirmation_letter_comment` text,
  `sponsor_letter_from_corporate` text,
  `sponsor_letter_from_corporate_status` varchar(50) DEFAULT NULL,
  `sponsor_letter_from_corporate_comment` text,
  `Sponsorship_company_gst` text,
  `Sponsorship_company_gst_status` varchar(50) DEFAULT NULL,
  `Sponsorship_company_gst_comment` text,
  `sponsorship_company_pan` text,
  `sponsorship_company_pan_status` varchar(50) DEFAULT NULL,
  `sponsorship_company_pan_comment` text,
  `letter_from_overseas_hospital` text,
  `Letter_from_overseas_hospital_status` varchar(50) DEFAULT NULL,
  `Letter_from_overseas_hospital_comment` text,
  `agreement_of_overseas_parties` text,
  `agreement_of_overseas_parties_status` varchar(50) DEFAULT NULL,
  `agreement_of_overseas_parties_comment` text,
  `invoices_relating_expenses` text,
  `invoices_relating_expenses_status` varchar(50) DEFAULT NULL,
  `invoices_relating_expenses_comment` text,
  `form_15ca` text,
  `form_15ca_status` varchar(50) DEFAULT NULL,
  `form_15ca_comment` text,
  `form_15cb` text,
  `form_15cb_status` varchar(50) DEFAULT NULL,
  `form_15cb_comment` text,
  `producer_pan` text,
  `producer_pan_status` varchar(50) DEFAULT NULL,
  `producer_pan_comment` text,
  `producer_passport_aadhar` text,
  `producer_passport_aadhar_status` varchar(50) DEFAULT NULL,
  `producer_passport_aadhar_comment` text,
  `itr` text,
  `itr_status` varchar(50) DEFAULT NULL,
  `itr_comment` text,
  `beneficiary_passport` text,
  `beneficiary_passport_status` varchar(50) DEFAULT NULL,
  `beneficiary_passport_comment` text,
  `invoice` text,
  `invoice_status` varchar(50) DEFAULT NULL,
  `invoice_comment` text,
  `corporate_kyc` text,
  `corporate_kyc_status` varchar(50) DEFAULT NULL,
  `corporate_kyc_comment` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `transaction_kycs`
--

INSERT INTO `transaction_kycs` (`id`, `txn_link_no`, `passport`, `passport_status`, `passport_comment`, `visa`, `visa_status`, `visa_comment`, `ticket`, `ticket_status`, `ticket_comment`, `pan_card`, `pan_card_status`, `pan_card_comment`, `university_letter`, `university_letter_status`, `university_letter_comment`, `employment_letter`, `emp_letter_status`, `emp_letter_comment`, `offer_letter`, `offer_letter_status`, `offer_letter_comment`, `medical_letter`, `medical_letter_status`, `medical_letter_comment`, `other`, `other_status`, `other_comment`, `a2form`, `a2form_status`, `a2form_comment`, `fema_declaration`, `fema_declaration_status`, `fema_declaration_comment`, `valid_gic_letter`, `valid_gic_letter_status`, `valid_gic_letter_comment`, `gst_of_remitter`, `gst_of_remitter_status`, `gst_of_remitter_comment`, `participant_list_of_passengers`, `participant_list_of_passengers_status`, `participant_list_of_passengers_comment`, `passenger_pan`, `passenger_pan_status`, `passenger_pan_comment`, `passenger_passport`, `passenger_passport_status`, `passenger_passport_comment`, `beneficiary_invoice`, `beneficiary_invoice_status`, `beneficiary_invoice_comment`, `tcs_declaration`, `tcs_declaration_status`, `tcs_declaration_comment`, `ticket_copy`, `ticket_copy_status`, `ticket_copy_comment`, `certificate_of_registration_of_haj_group`, `certificate_of_registration_of_haj_group_status`, `certificate_of_registration_of_haj_group_comment`, `employemnt_letter_or_visa_confirmation_letter`, `employemnt_letter_or_visa_confirmation_letter_status`, `employemnt_letter_or_visa_confirmation_letter_comment`, `sponsor_letter_from_corporate`, `sponsor_letter_from_corporate_status`, `sponsor_letter_from_corporate_comment`, `Sponsorship_company_gst`, `Sponsorship_company_gst_status`, `Sponsorship_company_gst_comment`, `sponsorship_company_pan`, `sponsorship_company_pan_status`, `sponsorship_company_pan_comment`, `letter_from_overseas_hospital`, `Letter_from_overseas_hospital_status`, `Letter_from_overseas_hospital_comment`, `agreement_of_overseas_parties`, `agreement_of_overseas_parties_status`, `agreement_of_overseas_parties_comment`, `invoices_relating_expenses`, `invoices_relating_expenses_status`, `invoices_relating_expenses_comment`, `form_15ca`, `form_15ca_status`, `form_15ca_comment`, `form_15cb`, `form_15cb_status`, `form_15cb_comment`, `producer_pan`, `producer_pan_status`, `producer_pan_comment`, `producer_passport_aadhar`, `producer_passport_aadhar_status`, `producer_passport_aadhar_comment`, `itr`, `itr_status`, `itr_comment`, `beneficiary_passport`, `beneficiary_passport_status`, `beneficiary_passport_comment`, `invoice`, `invoice_status`, `invoice_comment`, `corporate_kyc`, `corporate_kyc_status`, `corporate_kyc_comment`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'A000001', '1692943659934_A000001_passport.png', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, '1692943659934_A000001_pan_card.png', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1692957971731_A000001_other.jpeg', '1', '', '1692943659934_A000001_a2form.png', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-25 09:37:39', '2023-08-25 08:06:45', NULL),
(2, 'A000002', '1692959881949_A000002_passport.png', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, '1692959881949_A000002_pan_card.png', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1692959881949_A000002_other.png', '1', '', '1692959881949_A000002_a2form.png', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-25 10:05:30', '2023-08-25 08:38:33', NULL),
(3, 'A000003', '1692946064503_A000003_passport.png', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1692946064503_A000003_pan_card.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1692946064503_A000003_other.jpg', NULL, NULL, '1692946064503_A000003_a2form.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-25 10:17:44', '2023-08-25 10:17:44', NULL),
(4, 'A000004', '1692956269994_A000004_passport.pdf', '1', 'Passport not readable', NULL, NULL, NULL, NULL, NULL, NULL, '1692955856910_A000004_pan_card.pdf', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1692956269994_A000004_other.pdf', '1', 'Other not found', '1692955856910_A000004_a2form.pdf', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-25 13:00:56', '2023-08-25 07:41:53', NULL),
(5, 'A000005', '1693465806785_A000005_passport.pdf', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, '1693465806785_A000005_pan_card.pdf', '1', 'Not readable', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1693465806785_A000005_other.pdf', '1', 'Not readable', '1693465806785_A000005_a2form.pdf', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-31 10:40:06', '2023-08-31 05:16:07', NULL),
(6, 'A000006', '1693470826005_A000006_passport.pdf', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, '1693470826005_A000006_pan_card.pdf', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1693470826005_A000006_other.pdf', '1', '', '1693470826005_A000006_a2form.pdf', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-31 12:03:46', '2023-08-31 06:35:57', NULL),
(7, 'A000007', '1693483932201_A000007_passport.pdf', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, '1693483932201_A000007_pan_card.pdf', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1693483932201_A000007_other.pdf', '1', '', '1693483932201_A000007_a2form.pdf', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-31 15:42:12', '2023-08-31 10:13:31', NULL),
(8, 'A000009', '1695375039361_A000009_passport.pdf', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, '1695375039361_A000009_pan_card.pdf', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1695375039361_A000009_other.pdf', '1', '', '1695375039361_A000009_a2form.pdf', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-22 13:00:39', '2023-09-22 07:31:33', NULL),
(9, 'A000011', '1706518112929_A000011_passport.jpg', '1', '', '1706518112929_A000011_visa.jpg', '1', '', NULL, NULL, NULL, '1706518112929_A000011_pan_card.png', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, '1706518112929_A000011_offer_letter.jpg', '1', '', NULL, NULL, NULL, '1706518112929_A000011_other.jpg', '1', '', '1706518112929_A000011_a2form.png', '1', '', '1706518112929_A000011_fema_declaration.jpg', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-29 06:18:32', '2024-01-29 00:49:36', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_users_email_unique` (`email`),
  ADD UNIQUE KEY `admin_users_user_name_unique` (`user_name`);

--
-- Indexes for table `agent_users`
--
ALTER TABLE `agent_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `agent_users_email_unique` (`email`),
  ADD UNIQUE KEY `agent_users_mobile_unique` (`mobile`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_purposes`
--
ALTER TABLE `manage_purposes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_sources`
--
ALTER TABLE `manage_sources`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rate_blocks`
--
ALTER TABLE `rate_blocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `required_documents`
--
ALTER TABLE `required_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_currency`
--
ALTER TABLE `transaction_currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_kycs`
--
ALTER TABLE `transaction_kycs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `agent_users`
--
ALTER TABLE `agent_users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `manage_purposes`
--
ALTER TABLE `manage_purposes`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `manage_sources`
--
ALTER TABLE `manage_sources`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rate_blocks`
--
ALTER TABLE `rate_blocks`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `required_documents`
--
ALTER TABLE `required_documents`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transaction_currency`
--
ALTER TABLE `transaction_currency`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transaction_kycs`
--
ALTER TABLE `transaction_kycs`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
