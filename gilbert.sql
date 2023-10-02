-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 02, 2023 at 01:06 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gilbert`
--

-- --------------------------------------------------------

--
-- Table structure for table `sidebar`
--

CREATE TABLE `sidebar` (
  `id_sidebar` int(11) NOT NULL,
  `name` varchar(15) NOT NULL DEFAULT '{sidebar.name}',
  `redirect` varchar(25) NOT NULL DEFAULT '#',
  `icon` varchar(15) NOT NULL DEFAULT '#'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sidebar`
--

INSERT INTO `sidebar` (`id_sidebar`, `name`, `redirect`, `icon`) VALUES
(1, 'Menu', '/', 'home'),
(2, 'Playlist', 'playlist.php', 'disc'),
(3, 'Music', 'music.php', 'music');

-- --------------------------------------------------------

--
-- Table structure for table `sub_sidebar`
--

CREATE TABLE `sub_sidebar` (
  `id_sub` int(11) NOT NULL,
  `id_sidebar` int(11) DEFAULT NULL,
  `name` varchar(25) NOT NULL DEFAULT 'sub_sidebar.name',
  `redirect` varchar(25) NOT NULL DEFAULT '#',
  `ispublic` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_sidebar`
--

INSERT INTO `sub_sidebar` (`id_sub`, `id_sidebar`, `name`, `redirect`, `ispublic`) VALUES
(1, 2, 'New playlist +', 'playlist.php?np=1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(15) NOT NULL DEFAULT 'client2555',
  `pwd` varchar(15) NOT NULL DEFAULT '0000',
  `pp` varchar(255) NOT NULL DEFAULT '/Img/void.jpg',
  `discord_id` int(11) NOT NULL DEFAULT '0',
  `secure` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `pwd`, `pp`, `discord_id`, `secure`) VALUES
(1, 'Hugo', 'Sianhu95', '/Img/void.jpg', 0, 'BcUC08xwRtqlsiG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sidebar`
--
ALTER TABLE `sidebar`
  ADD PRIMARY KEY (`id_sidebar`);

--
-- Indexes for table `sub_sidebar`
--
ALTER TABLE `sub_sidebar`
  ADD PRIMARY KEY (`id_sub`),
  ADD KEY `id_sidebar` (`id_sidebar`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sidebar`
--
ALTER TABLE `sidebar`
  MODIFY `id_sidebar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sub_sidebar`
--
ALTER TABLE `sub_sidebar`
  MODIFY `id_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
