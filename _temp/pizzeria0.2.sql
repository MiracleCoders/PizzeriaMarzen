-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2016 at 07:48 PM
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
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

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
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `id_ingredient` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`id_ingredient`, `name`, `price`) VALUES
(1, 'Pieczarki', 3),
(2, 'Salami', 2),
(3, 'Kapusta', 11),
(4, 'Sos pomidorowy', 3),
(5, 'Kurczak', 3.5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date` date NOT NULL,
  `id_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_order`, `id_user`, `date`, `id_status`) VALUES
(1, 35, '2016-09-21', 1),
(2, 35, '2016-09-23', 5),
(3, 35, '2016-09-23', 2),
(4, 35, '2016-09-27', 1),
(5, 36, '2016-09-27', 1),
(6, 36, '2016-09-27', 1),
(7, 36, '2016-09-27', 1),
(8, 36, '2016-09-27', 1),
(9, 36, '2016-09-27', 1),
(10, 36, '2016-09-27', 1),
(11, 36, '2016-09-27', 1),
(12, 36, '2016-09-27', 1),
(13, 36, '2016-09-27', 1),
(14, 36, '2016-09-27', 1),
(15, 36, '2016-09-27', 1),
(16, 36, '2016-09-27', 1),
(17, 36, '2016-09-27', 1),
(18, 36, '2016-09-27', 1),
(19, 36, '2016-09-27', 1),
(20, 36, '2016-09-27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `id_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`id_order`, `id_product`, `price`) VALUES
(1, 67, 12.99),
(1, 68, 666),
(2, 69, 665),
(3, 69, 665),
(4, 67, 12.99),
(5, 69, 665),
(6, 69, 665),
(7, 69, 665),
(8, 69, 665),
(9, 69, 665),
(10, 69, 665),
(11, 69, 665),
(12, 69, 665),
(13, 69, 665),
(14, 69, 665),
(15, 69, 665),
(16, 69, 665),
(17, 69, 665),
(18, 69, 665),
(19, 69, 665),
(20, 69, 665);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL,
  `name` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  `description` varchar(150) COLLATE utf8_polish_ci NOT NULL,
  `price` float NOT NULL,
  `ingredients` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_product`, `name`, `description`, `price`, `ingredients`) VALUES
(67, 'Pizza margherita', 'Genialna pizza o smaku żółtych kartonów mordujących małe dzieci', 12.99, 0),
(68, 'Pomidorro', 'Genialna turbo pizza o smaku ludzi ugotowanych w oleju.', 666, 0),
(69, 'Martełollo', 'Najlepsza pizza miziowatego Marteła <3', 665, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id_category` int(11) NOT NULL,
  `id_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_ingredient`
--

CREATE TABLE `product_ingredient` (
  `id_product` int(11) NOT NULL,
  `id_ingredient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `product_ingredient`
--

INSERT INTO `product_ingredient` (`id_product`, `id_ingredient`) VALUES
(67, 1),
(67, 2),
(68, 2),
(68, 4),
(69, 1),
(69, 4),
(69, 5);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `color` varchar(25) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id_status`, `name`, `color`) VALUES
(1, 'Złożono zamówienie', 'rgba(0, 255, 123, 0.66);'),
(2, 'Przyjęte do realizacji', 'rgba(77, 255, 0, 0.66);'),
(3, 'W trakcie produkcji', 'rgba(219, 255, 0, 0.66);'),
(4, 'W trakcie pieczenia', 'rgba(255, 209, 0, 0.66);'),
(5, 'Dowóz', 'rgba(255, 79, 0, 0.66);'),
(6, 'Zrealizowano', 'rgba(0, 164, 255, 0.66);');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `login` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `password` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `privileges` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `login`, `email`, `password`, `privileges`) VALUES
(3, 'test2', 'a@b.com', 'test2', 0),
(4, '0', NULL, '0', 0),
(22, 'test3', NULL, 'pass3', 0),
(23, 'test4', NULL, 'pass4', 0),
(26, 'test21', '', 'test2', 0),
(31, 'BartekBrozek', NULL, 'test666', 0),
(32, 'BartekBrozek1', NULL, 'test666', 0),
(33, 'BartekBrozek14', NULL, 'test666', 0),
(34, 'Marteł', NULL, 'Marteł', 0),
(35, 'test', NULL, 'test', 0),
(36, 'test666', NULL, 'test', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id_user` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `lastName` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `phoneNumber` int(11) NOT NULL,
  `city` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `postalCode` varchar(10) COLLATE utf8_polish_ci NOT NULL,
  `street` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `flatNumber` varchar(15) COLLATE utf8_polish_ci NOT NULL,
  `houseNumber` varchar(15) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id_user`, `name`, `lastName`, `phoneNumber`, `city`, `postalCode`, `street`, `flatNumber`, `houseNumber`) VALUES
(36, 'Bartosz', 'Brożek', 0, '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id_client`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id_ingredient`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD KEY `id_category` (`id_category`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `product_ingredient`
--
ALTER TABLE `product_ingredient`
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_ingredient` (`id_ingredient`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD UNIQUE KEY `id_user_2` (`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id_ingredient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_product_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`),
  ADD CONSTRAINT `order_product_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`);

--
-- Constraints for table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `product_category_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`),
  ADD CONSTRAINT `product_category_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`);

--
-- Constraints for table `product_ingredient`
--
ALTER TABLE `product_ingredient`
  ADD CONSTRAINT `product_ingredient_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`),
  ADD CONSTRAINT `product_ingredient_ibfk_2` FOREIGN KEY (`id_ingredient`) REFERENCES `ingredients` (`id_ingredient`);

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
