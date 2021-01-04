-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jul 04, 2020 at 05:24 PM
-- Server version: 5.7.29
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `task` text NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `username`, `task`, `email`, `status`) VALUES
(3, 'Quia qui sint sed ut', 'sdfsdffsdfsdfsdfsdfsdfsdfsd', 'asda@dadas.dsfds', 1),
(4, 'Voluptate enim labor', 'sssssssssssssssssssssss', 'sdsad@fsfdfs.fg', 0),
(5, 'Nulla aut enim non l', 'Esse consequatur al', 'Ad nulla rerum paria', 0),
(6, 'Nulla aut enim non l', 'Esse consequatur al', 'Ad nulla rerum paria', 0),
(7, 'xezyku', 'zexyhagil', 'poti@mailinator.com', 0),
(8, 'asdasdasd', 'saddsaddasdas', 'davron211@gmail.com', 0),
(9, 'achilov21@yandex.com', 'rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr', 'xaryfoguwi@mailinator.com', 0),
(10, 'fsdfsdf', 'sdfsdfsdf', 'davron211@gmail.com', 0),
(11, 'asdasdas', 'jewegacoc', 'davron211@gmail.com', 0),
(12, 'fumul', '555555555555555555', 'nazyq@mailinator.com', 0),
(13, 'xikavove', 'Qui delectus nobis ', 'najytevat@mailinator.com', 0),
(14, 'cepotufud', 'Ut perferendis sed r', 'hutoc@mailinator.com', 0),
(15, 'witik', 'Ut quaerat aut qui q', 'noxoxymailinator.com', 0),
(16, 'dasdasd', 'asdasdasd', 'asdasdad', 0),
(17, 'sdfsdfsdf', 'sdfsdfsdf', NULL, 0),
(18, 'asdadasd', 'asdasdasdas', NULL, 0),
(19, 'dffdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfd', '777777777777777777777777777777777777777', NULL, 0),
(20, 'rrr', 'rrr', NULL, 0),
(21, 'ASASs', 'SAASASAS', 'sASASA@df.ff', 0),
(22, 'dasdasdasd', 'dfdfdfdf', 'asdasd@dsadsa.ff', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(3, 'admin', '202cb962ac59075b964b07152d234b70');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;