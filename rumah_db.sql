-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2025 at 08:22 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rumah_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `beli_rumah`
--

CREATE TABLE `beli_rumah` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama_rumah` varchar(100) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `nomor_kontak` varchar(20) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kamar_tidur` int(11) NOT NULL,
  `kamar_mandi` int(11) NOT NULL,
  `luas_rumah` decimal(5,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `properti_baru`
--

CREATE TABLE `properti_baru` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama_rumah` varchar(100) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `nomor_kontak` varchar(20) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kamar_tidur` int(11) NOT NULL,
  `kamar_mandi` int(11) NOT NULL,
  `luas_rumah` decimal(5,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rumah_kos`
--

CREATE TABLE `rumah_kos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama_rumah` varchar(100) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `nomor_kontak` varchar(20) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kamar_tidur` int(11) NOT NULL,
  `kamar_mandi` int(11) NOT NULL,
  `luas_rumah` decimal(5,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rumah_sewa`
--

CREATE TABLE `rumah_sewa` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama_rumah` varchar(100) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `nomor_kontak` varchar(20) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kamar_tidur` int(11) NOT NULL,
  `kamar_mandi` int(11) NOT NULL,
  `luas_rumah` decimal(5,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(6, 'user', '$2y$10$zU/aUG5bv0cY00WA4z/sq.FpcS.dUOEYBiT.h/No04F7ElUOU.VIy', '2025-02-24 07:13:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beli_rumah`
--
ALTER TABLE `beli_rumah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `properti_baru`
--
ALTER TABLE `properti_baru`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rumah_kos`
--
ALTER TABLE `rumah_kos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rumah_sewa`
--
ALTER TABLE `rumah_sewa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beli_rumah`
--
ALTER TABLE `beli_rumah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `properti_baru`
--
ALTER TABLE `properti_baru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rumah_kos`
--
ALTER TABLE `rumah_kos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rumah_sewa`
--
ALTER TABLE `rumah_sewa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `beli_rumah`
--
ALTER TABLE `beli_rumah`
  ADD CONSTRAINT `beli_rumah_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `properti_baru`
--
ALTER TABLE `properti_baru`
  ADD CONSTRAINT `properti_baru_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rumah_kos`
--
ALTER TABLE `rumah_kos`
  ADD CONSTRAINT `rumah_kos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rumah_sewa`
--
ALTER TABLE `rumah_sewa`
  ADD CONSTRAINT `rumah_sewa_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
