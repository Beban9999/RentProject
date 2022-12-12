-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2022 at 09:20 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `renta`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `purge` (IN `del` INT)   BEGIN
DELETE FROM pictures WHERE deleted = 1;
DELETE FROM post_pictures WHERE deleted = 1;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `id_curr` int(10) UNSIGNED NOT NULL,
  `currency` varchar(10) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id_curr`, `currency`, `name`) VALUES
(1, 'Euro', 'EUR');

-- --------------------------------------------------------

--
-- Table structure for table `kategorije`
--

CREATE TABLE `kategorije` (
  `id_type` int(10) UNSIGNED NOT NULL,
  `type_name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategorije`
--

INSERT INTO `kategorije` (`id_type`, `type_name`) VALUES
(1, 'Stan'),
(2, 'Kuca'),
(3, 'Soba'),
(4, 'Garsonjera');

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id_usr` int(10) UNSIGNED NOT NULL,
  `ime` varchar(80) NOT NULL,
  `prezime` varchar(80) NOT NULL,
  `status` enum('Administrator','Korisnik','','') NOT NULL,
  `lozinka` varchar(80) NOT NULL,
  `korime` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id_usr`, `ime`, `prezime`, `status`, `lozinka`, `korime`) VALUES
(1, 'Aleksa', 'Aleksic', 'Administrator', '123456', 'beban');

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE `pictures` (
  `id_pic` int(10) UNSIGNED NOT NULL,
  `name` varchar(80) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`id_pic`, `name`, `user_id`, `deleted`) VALUES
(15, 'uploads/56844screenshot_2.png', 1, 1),
(16, 'uploads/266259931716.png', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(10) UNSIGNED NOT NULL,
  `address_name` varchar(80) NOT NULL,
  `address_number` varchar(40) NOT NULL,
  `county` varchar(80) NOT NULL,
  `city` varchar(80) NOT NULL,
  `type` int(10) UNSIGNED NOT NULL,
  `comment` text DEFAULT NULL,
  `deposit` int(11) DEFAULT NULL,
  `rent` int(11) NOT NULL,
  `currency` int(10) UNSIGNED NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `details` int(11) NOT NULL,
  `user` int(10) UNSIGNED NOT NULL,
  `created_date` date DEFAULT current_timestamp(),
  `deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `address_name`, `address_number`, `county`, `city`, `type`, `comment`, `deposit`, `rent`, `currency`, `start_date`, `end_date`, `details`, `user`, `created_date`, `deleted`) VALUES
(4, 'Mestroviceva', '23', 'Vozdovac', 'Beograd', 4, 'Nesina garsonjera', 1000, 500, 1, '2022-12-15', '2022-12-25', 14, 1, '2022-12-12', 0);

--
-- Triggers `post`
--
DELIMITER $$
CREATE TRIGGER `delete_pictures` AFTER DELETE ON `post` FOR EACH ROW BEGIN
UPDATE post_pictures SET post_pictures.deleted = 1 WHERE post_pictures.post_id = old.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `post_pictures`
--

CREATE TABLE `post_pictures` (
  `id_picture` int(10) UNSIGNED NOT NULL,
  `pic_name` varchar(80) NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_pictures`
--

INSERT INTO `post_pictures` (`id_picture`, `pic_name`, `post_id`, `deleted`) VALUES
(1, 'uploads/4376732502860.jpg', 2, 0),
(2, 'uploads/421673screenshot_4.png', 2, 0),
(3, 'uploads/438915screenshot_5.png', 2, 0),
(4, 'uploads/274574screenshot_2.png', 3, 0),
(5, 'uploads/99548screenshot_5.png', 3, 0),
(6, 'uploads/450846screenshot_5.png', 4, 0),
(7, 'uploads/333530931716.png', 4, 0),
(10, 'uploads/56844screenshot_2.png', 6, 1),
(11, 'uploads/266259931716.png', 6, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id_curr`);

--
-- Indexes for table `kategorije`
--
ALTER TABLE `kategorije`
  ADD PRIMARY KEY (`id_type`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id_usr`);

--
-- Indexes for table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id_pic`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test` (`currency`),
  ADD KEY `user` (`user`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `post_pictures`
--
ALTER TABLE `post_pictures`
  ADD PRIMARY KEY (`id_picture`),
  ADD KEY `post_pictures_ibfk_1` (`post_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id_curr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kategorije`
--
ALTER TABLE `kategorije`
  MODIFY `id_type` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id_usr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id_pic` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `post_pictures`
--
ALTER TABLE `post_pictures`
  MODIFY `id_picture` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pictures`
--
ALTER TABLE `pictures`
  ADD CONSTRAINT `pictures_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `korisnici` (`id_usr`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user`) REFERENCES `korisnici` (`id_usr`),
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`type`) REFERENCES `kategorije` (`id_type`),
  ADD CONSTRAINT `test` FOREIGN KEY (`currency`) REFERENCES `currency` (`id_curr`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
