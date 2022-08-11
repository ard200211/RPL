-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2022 at 04:10 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rpl`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` varchar(20) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
('ADM-090', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` varchar(20) NOT NULL,
  `nisn` varchar(30) NOT NULL,
  `matematika` varchar(5) DEFAULT NULL,
  `IPA` varchar(5) DEFAULT NULL,
  `b_inggris` varchar(5) DEFAULT NULL,
  `b_indonesia` varchar(5) DEFAULT NULL,
  `rata_nilai` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `nisn`, `matematika`, `IPA`, `b_inggris`, `b_indonesia`, `rata_nilai`) VALUES
('nl-62f4ffe2c6c24', '10120211', '70', '90', '90', '90', '85');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftar`
--

CREATE TABLE `pendaftar` (
  `nisn` varchar(10) NOT NULL,
  `no_pendaftar` varchar(20) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `ttl` varchar(30) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') DEFAULT NULL,
  `agama` varchar(20) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `asal_sekolah` varchar(50) DEFAULT NULL,
  `nama_orangtua` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pendaftar`
--

INSERT INTO `pendaftar` (`nisn`, `no_pendaftar`, `nama_lengkap`, `ttl`, `jenis_kelamin`, `agama`, `alamat`, `no_telp`, `email`, `password`, `asal_sekolah`, `nama_orangtua`) VALUES
('10120211', 'pn-62f4ffe2c5b32', 'Aiwjwijw', 'Bandung, 15 Agustus 2002', 'Laki-Laki', 'Islam', 'Jl. Bojong ', '0812131293801', 'jiajai@gmail.com', '123', 'SMPN 2 Talegong', 'Pak Haji');

-- --------------------------------------------------------

--
-- Table structure for table `skhun`
--

CREATE TABLE `skhun` (
  `nisn` varchar(20) NOT NULL,
  `no_skhun` varchar(30) NOT NULL,
  `foto_skhun` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skhun`
--

INSERT INTO `skhun` (`nisn`, `no_skhun`, `foto_skhun`) VALUES
('10120211', '1020010203030', '62f500081437c.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD UNIQUE KEY `no_pendaftar_3` (`nisn`),
  ADD KEY `no_pendaftar` (`nisn`),
  ADD KEY `no_pendaftar_2` (`nisn`);

--
-- Indexes for table `pendaftar`
--
ALTER TABLE `pendaftar`
  ADD PRIMARY KEY (`nisn`),
  ADD UNIQUE KEY `no_pendaftar` (`no_pendaftar`);

--
-- Indexes for table `skhun`
--
ALTER TABLE `skhun`
  ADD PRIMARY KEY (`no_skhun`),
  ADD UNIQUE KEY `no_pendaftar` (`nisn`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`nisn`) REFERENCES `pendaftar` (`nisn`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `skhun`
--
ALTER TABLE `skhun`
  ADD CONSTRAINT `skhun_ibfk_1` FOREIGN KEY (`nisn`) REFERENCES `pendaftar` (`nisn`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
