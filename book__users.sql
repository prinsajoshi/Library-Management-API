-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2024 at 12:40 PM
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
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `book__users`
--

CREATE TABLE `book__users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `taken_date` date NOT NULL,
  `submission_date` date NOT NULL,
  `reminder_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book__users`
--

INSERT INTO `book__users` (`id`, `user_id`, `book_id`, `taken_date`, `submission_date`, `reminder_date`, `created_at`, `updated_at`) VALUES
(2, 1, 1, '2024-10-30', '2024-11-06', '2024-11-05', '2024-10-29 23:41:20', '2024-10-29 23:41:20'),
(3, 1, 2, '2024-10-30', '2024-11-06', '2024-11-05', '2024-10-29 23:45:38', '2024-10-29 23:45:38'),
(5, 3, 3, '2024-10-30', '2024-11-06', '2024-11-05', '2024-10-30 05:44:01', '2024-10-30 05:44:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book__users`
--
ALTER TABLE `book__users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book__users_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book__users`
--
ALTER TABLE `book__users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book__users`
--
ALTER TABLE `book__users`
  ADD CONSTRAINT `book__users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
