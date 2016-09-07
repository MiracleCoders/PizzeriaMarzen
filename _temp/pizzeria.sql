-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2016 at 09:20 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizzeria`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id_client` int(11) NOT NULL,
  `login` int(11) NOT NULL,
  `password` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `name` int(11) NOT NULL,
  `lastName` int(11) NOT NULL,
  `email` int(11) NOT NULL,
  `mobilePhone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL,
  `name` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  `description` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `price` float NOT NULL,
  `ingredients` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_product`, `name`, `description`, `price`, `ingredients`) VALUES
(1, 'dfbfbdfb', '', 0, 0),
(2, 'Super Pizzeeełaaaa', '', 0, 0),
(13, '0', '', 0, 0),
(14, '0', '', 0, 0),
(15, '0', '', 0, 0),
(16, '0', '', 0, 0),
(17, '0', '', 0, 0),
(18, '0', '', 0, 0),
(19, '0', '', 0, 0),
(20, 'rrrbbr', '', 0, 0),
(21, 'rrrbbr', '', 0, 0),
(22, 'rrrbbr', '', 0, 0),
(23, 'rrrbbr', '', 0, 0),
(24, 'rrrbbr', '', 0, 0),
(25, 'rrrbbr', '', 0, 0),
(26, 'rrrbbr', '', 0, 0),
(27, 'rrrbbr', '', 0, 0),
(28, 'rrrbbr', '', 0, 0),
(29, 'rttfb', '', 0, 0),
(30, 'rttfb', '', 0, 0),
(31, 'rttfb', '', 0, 0),
(32, 'rttfb', '', 0, 0),
(33, 'BARTEŁ PIZZA', '', 0, 0),
(34, 'Nowy produkt', '', 0, 0),
(35, 'Super fajny produkt', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `login` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `password` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `name` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `lastName` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `privileges` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `login`, `email`, `password`, `name`, `lastName`, `privileges`) VALUES
(3, 'test2', 'a@b.com', 'test2', 'test2', 'test2', 0),
(4, '0', NULL, '0', '', '', 0),
(22, 'test3', NULL, 'pass3', '', '', 0),
(23, 'test4', NULL, 'pass4', '', '', 0),
(26, 'test21', '', 'test2', '', '', 0),
(31, 'BartekBrozek', NULL, 'test666', '', '', 0),
(32, 'BartekBrozek1', NULL, 'test666', '', '', 0),
(33, 'BartekBrozek14', NULL, 'test666', '', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id_client`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
