-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2024 at 12:39 PM
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
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `role`, `token`, `email`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$12$tsR7LthjlG.0dIBO4g.oOeGq5xm3N84dncjx8GNio.A9A3LD.zNkK', 'admin', 'lWEsXX5AYhC3TlWhB4LoaLeyrwGiwskh', 'prinsajoshi5@gmail.com', NULL, '2024-10-29 21:47:02'),
(3, 'prinsa', '$2y$12$prBOY.r57h8lcHuMZdVQQ.WyXLFAO/gK2ZTWZd7y2Jpfog7dlDpmq', 'User', 'r1SCATMMQUIVaytg3rrMKUjBDvwBeMD0', 'prinsajosh5@gmail.com', '2024-10-29 21:51:08', '2024-10-30 01:15:17'),
(4, 'prinsa1', '$2y$12$8Rdoz4AxXxGvHtGbgvlG/uKteOQOGhxGGf7G22S/pBQ8ejDbjp.fa', 'User', 'nTisWMXlPA9PQMqDjUAwdvu0mkwMP61T', 'prinsajosh1@gmail.com', '2024-10-29 21:53:10', '2024-10-29 21:53:10'),
(6, 'ram', '$2y$12$GhLHlhzN82hy6LMChs2c/O1Z41RidcQ.uesVQJcf5wBu5A8L13pwO', 'librarian', 'B6Oxi6jqWXIAw2Tafxm82NtzONqBh5nz', 'ram@gmail.com', '2024-10-30 01:12:13', '2024-10-30 01:30:29'),
(7, 'prinsa2', '$2y$12$FPcD6/EUSKJ4J9swaoKICuFLJ2fiXMgOPBHvjyTq3HUAi6dOTT.Zi', 'User', 'JqJeJyAZ72cPB3R5bGiGIFrASWVyTRrO', 'prinsajosh2@gmail.com', '2024-10-30 01:30:40', '2024-10-30 01:30:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_username_unique` (`username`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_token_unique` (`token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
