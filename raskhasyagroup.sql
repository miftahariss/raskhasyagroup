-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 26 Agu 2016 pada 14.59
-- Versi Server: 10.1.10-MariaDB
-- PHP Version: 5.5.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `raskhasyagroup`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `short_desc` tinytext NOT NULL,
  `body` text,
  `filename` varchar(125) NOT NULL,
  `permalink` varchar(120) NOT NULL,
  `created_date` int(11) NOT NULL,
  `modified_date` int(11) DEFAULT NULL,
  `created_by` tinyint(2) DEFAULT NULL,
  `modified_by` tinyint(2) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1' COMMENT '0=inactive; 1=active; 2=draft; default=1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`id`, `title`, `short_desc`, `body`, `filename`, `permalink`, `created_date`, `modified_date`, `created_by`, `modified_by`, `status`) VALUES
(1, 'category1', 'category1', '<p>category1</p>\n', '1472114609.jpg', 'category1', 1472114280, 1472114609, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `short_desc` tinytext NOT NULL,
  `body` text,
  `filename` varchar(125) NOT NULL,
  `permalink` varchar(120) NOT NULL,
  `created_date` int(11) NOT NULL,
  `modified_date` int(11) DEFAULT NULL,
  `created_by` tinyint(2) DEFAULT NULL,
  `modified_by` tinyint(2) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1' COMMENT '0=inactive; 1=active; 2=draft; default=1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id`, `id_category`, `title`, `short_desc`, `body`, `filename`, `permalink`, `created_date`, `modified_date`, `created_by`, `modified_by`, `status`) VALUES
(1, 1, 'product1', 'product1', '<p>product1</p>\n', '1472116590.jpg', 'product1', 1472115903, 1472116590, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `created_date` int(11) DEFAULT NULL,
  `modified_date` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `role` tinyint(1) DEFAULT NULL COMMENT '1: administrator; 2: editor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `created_date`, `modified_date`, `status`, `role`) VALUES
(1, 'autobacs', 'admin@autobacs.co.id', 'cfe31d9429703a311e592789acec8b0da1e4ab90', 0, 1447055705, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
