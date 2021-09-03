-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2021 at 08:38 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hfitteam4_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bundle_tickets`
--

CREATE TABLE `bundle_tickets` (
  `ID` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `event_id` int(11) NOT NULL,
  `description` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bundle_tickets`
--

INSERT INTO `bundle_tickets` (`ID`, `title`, `event_id`, `description`) VALUES
(1, '3 Day Pass', 42, 'Access to all jazz events'),
(2, '1 Day Pass', 43, 'Access to all jazz events for one day'),
(3, 'Monday Pass', 46, 'All-pass ticket for any dance event Monday'),
(4, 'Tuesday Pass', 47, 'pass ticket for any dance event Tuesday'),
(5, 'Wednesday pass', 48, 'pass ticket for any dance event Wednesday'),
(6, '3 day All-Pass ticket', 49, 'All-pass ticket for any dance event from Monday to Wednesday');

-- --------------------------------------------------------

--
-- Table structure for table `dance_ticket`
--

CREATE TABLE `dance_ticket` (
  `ID` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `session` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dance_ticket`
--

INSERT INTO `dance_ticket` (`ID`, `event_id`, `session`) VALUES
(1, 29, 'Back2Back'),
(2, 30, 'Club '),
(3, 31, 'Club '),
(4, 32, 'Club '),
(5, 33, 'Club '),
(6, 34, 'Back2Back'),
(7, 35, 'Club '),
(8, 36, 'TiëstoWorld** '),
(9, 37, 'Club '),
(10, 38, 'Back2Back'),
(11, 39, 'Club '),
(12, 40, 'Club '),
(13, 41, 'Club ');

-- --------------------------------------------------------

--
-- Table structure for table `dj`
--

CREATE TABLE `dj` (
  `ID` int(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `style` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dj`
--

INSERT INTO `dj` (`ID`, `name`, `style`) VALUES
(1, 'Hardwell', 'dance and house'),
(2, 'Armin van Buuren', 'trance and techno'),
(3, 'Martin Garrix', 'dance / electronic'),
(4, 'Tiësto', 'trance,  techno, minimal, house en electro'),
(5, 'Nicky Romero', 'electrohouse/ progressive house'),
(6, 'Afrojack', 'house');

-- --------------------------------------------------------

--
-- Table structure for table `dj_dance`
--

CREATE TABLE `dj_dance` (
  `dance_id` int(11) NOT NULL,
  `DJ_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dj_dance`
--

INSERT INTO `dj_dance` (`dance_id`, `DJ_id`) VALUES
(29, 5),
(29, 6),
(30, 4),
(31, 1),
(32, 2),
(33, 3),
(34, 1),
(34, 2),
(34, 3),
(35, 6),
(36, 4),
(37, 5),
(38, 4),
(38, 5),
(38, 6),
(39, 2),
(40, 1),
(41, 3);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `ID` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `start` time DEFAULT NULL,
  `end` time DEFAULT NULL,
  `price` decimal(10,0) NOT NULL,
  `seats` int(11) DEFAULT NULL,
  `venue_id` varchar(70) DEFAULT NULL,
  `event_type` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`ID`, `date`, `start`, `end`, `price`, `seats`, `venue_id`, `event_type`) VALUES
(5, '2020-07-26', '18:00:00', '19:00:00', '15', 284, 'Patronaat Main Hall', 'Jazz'),
(6, '2020-07-26', '19:30:00', '20:30:00', '15', 300, 'Patronaat Main Hall', 'Jazz'),
(7, '2020-07-26', '21:00:00', '22:00:00', '15', 300, 'Patronaat Main Hall', 'Jazz'),
(8, '2020-07-26', '18:00:00', '19:00:00', '10', 142, 'Patronaat Second Hall', 'Jazz'),
(9, '2020-07-26', '19:30:00', '20:30:00', '10', 200, 'Patronaat Second Hall', 'Jazz'),
(10, '2020-07-26', '21:00:00', '22:00:00', '10', 200, 'Patronaat Second Hall', 'Jazz'),
(11, '2020-07-27', '18:00:00', '19:00:00', '15', 298, 'Patronaat Main Hall', 'Jazz'),
(12, '2020-07-27', '19:30:00', '20:30:00', '15', 300, 'Patronaat Main Hall', 'Jazz'),
(13, '2020-07-27', '21:00:00', '22:00:00', '10', 200, 'Patronaat Main Hall', 'Jazz'),
(14, '2020-07-27', '19:30:00', '20:30:00', '10', 200, 'Patronaat Second Hall', 'Jazz'),
(15, '2020-07-27', '21:00:00', '22:00:00', '10', 200, 'Patronaat Second Hall', 'Jazz'),
(16, '2020-07-28', '18:00:00', '19:00:00', '15', 300, 'Patronaat Main Hall', 'Jazz'),
(17, '2020-07-28', '19:30:00', '20:30:00', '15', 300, 'Patronaat Main Hall', 'Jazz'),
(18, '2020-07-28', '21:00:00', '22:00:00', '15', 300, 'Patronaat Main Hall', 'Jazz'),
(19, '2020-07-28', '18:00:00', '19:00:00', '10', 150, 'Patronaat Third Hall', 'Jazz'),
(20, '2020-07-28', '19:30:00', '20:30:00', '10', 150, 'Patronaat Third Hall', 'Jazz'),
(21, '2020-07-28', '21:00:00', '22:00:00', '10', 149, 'Patronaat Third Hall', 'Jazz'),
(22, '2020-07-29', '15:00:00', '16:00:00', '0', 0, 'Grote Markt', 'Jazz'),
(23, '2020-07-29', '19:00:00', '20:00:00', '0', 0, 'Grote Markt', 'Jazz'),
(24, '2020-07-29', '16:00:00', '17:00:00', '0', 0, 'Grote Markt', 'Jazz'),
(25, '2020-07-29', '17:00:00', '18:00:00', '0', 0, 'Grote Markt', 'Jazz'),
(26, '2020-07-29', '18:00:00', '19:00:00', '0', 0, 'Grote Markt', 'Jazz'),
(27, '2020-07-29', '20:00:00', '21:00:00', '0', 0, 'Grote Markt', 'Jazz'),
(28, '2020-07-27', '18:00:00', '19:00:00', '15', 293, 'Patronaat Second Hall', 'Jazz'),
(29, '2020-07-27', '20:00:00', '02:00:00', '70', 1498, 'Lichtfabriek', 'Dance'),
(30, '2020-07-27', '22:00:00', '23:30:00', '60', 200, 'Club Stalker', 'Dance'),
(31, '2020-07-27', '23:00:00', '00:30:00', '60', 300, 'Jopenkerk', 'Dance'),
(32, '2020-07-27', '22:00:00', '23:30:00', '60', 200, 'XO the Club', 'Dance'),
(33, '2020-07-27', '22:00:00', '23:30:00', '60', 200, 'Club Ruis', 'Dance'),
(34, '2020-07-28', '14:00:00', '23:00:00', '110', 1999, 'Caprera Openluchttheater', 'Dance'),
(35, '2020-07-28', '22:00:00', '23:30:00', '60', 300, 'Jopenkerk', 'Dance'),
(36, '2020-07-28', '21:00:00', '01:00:00', '75', 1500, 'Lichtfabriek', 'Dance'),
(37, '2020-07-28', '23:00:00', '00:30:00', '60', 200, 'Club Stalker', 'Dance'),
(38, '2020-07-29', '14:00:00', '23:00:00', '110', 2000, 'Caprera Openluchttheater', 'Dance'),
(39, '2020-07-29', '19:00:00', '20:30:00', '60', 300, 'Jopenkerk', 'Dance'),
(40, '2020-07-29', '21:00:00', '22:30:00', '90', 1500, 'XO the Club', 'Dance'),
(41, '2020-07-29', '18:00:00', '19:30:00', '60', 199, 'Club Stalker', 'Dance'),
(42, NULL, NULL, NULL, '85', 200, NULL, 'Jazz'),
(43, NULL, NULL, NULL, '35', 150, NULL, 'Jazz'),
(46, NULL, NULL, NULL, '125', NULL, NULL, 'Dance'),
(47, NULL, NULL, NULL, '150', NULL, NULL, 'Dance'),
(48, NULL, NULL, NULL, '150', NULL, NULL, 'Dance'),
(49, NULL, NULL, NULL, '250', NULL, NULL, 'Dance');

-- --------------------------------------------------------

--
-- Table structure for table `jazz_ticket`
--

CREATE TABLE `jazz_ticket` (
  `ID` int(11) NOT NULL,
  `artist` varchar(30) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jazz_ticket`
--

INSERT INTO `jazz_ticket` (`ID`, `artist`, `event_id`) VALUES
(1, 'Gumbo Kings', 5),
(2, 'Evolve', 6),
(3, 'Ntjam Rosie', 7),
(4, 'Wicked Jazz Sounds', 8),
(5, 'Tom Thompson', 9),
(6, 'Jonna Frazzer', 10),
(7, 'Fox & The Mayors', 11),
(8, 'Uncle Sue', 12),
(9, 'Chris Allen', 13),
(10, 'Ruis Soundsytem', 14),
(11, 'The Family XL', 15),
(12, 'Gare du Nord', 16),
(13, 'The Bombadiers', 17),
(14, 'Soul Six', 18),
(15, 'Han Bennik', 19),
(16, 'The Nordanians', 20),
(17, 'Lilith Merlot', 21),
(18, 'Ruis Soundsytem', 22),
(19, 'Gumbo Kings', 23),
(20, 'Wicked Jazz Sounds', 24),
(21, 'Evolve', 25),
(22, 'The Nordanians', 26),
(23, 'Gare du Nord', 27),
(24, 'Myles Sanko', 28);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `ID` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`ID`, `order_id`, `event_id`, `description`, `quantity`, `price`) VALUES
(117, 1623601341, 5, 'Gumbo Kings Sun 26 Jul 2020 |  18:00 - 19:00 Patronaat Main Hall', 1, '15'),
(118, 1623601599, 5, 'Gumbo Kings Sun 26 Jul 2020 |  18:00 - 19:00 Patronaat Main Hall', 1, '15'),
(119, 1623602379, 5, 'Gumbo Kings Sun 26 Jul 2020 |  18:00 - 19:00 Patronaat Main Hall', 1, '15'),
(120, 1623602867, 5, 'Gumbo Kings Sun 26 Jul 2020 |  18:00 - 19:00 Patronaat Main Hall', 1, '15');

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE `order_table` (
  `ID` int(15) NOT NULL,
  `status` varchar(15) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_table`
--

INSERT INTO `order_table` (`ID`, `status`, `date`) VALUES
(1623601341, 'paid', '2021-06-13 18:22:21'),
(1623601599, 'paid', '2021-06-13 18:26:40'),
(1623602379, 'paid', '2021-06-13 18:39:39'),
(1623602867, 'paid', '2021-06-13 18:47:47');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `email` varchar(40) NOT NULL,
  `token` varchar(255) NOT NULL,
  `selector` varchar(255) NOT NULL,
  `expiry_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `password_reset`
--

INSERT INTO `password_reset` (`email`, `token`, `selector`, `expiry_date`) VALUES
('munatsimike@gmail.com', '$2y$10$FtSZjML//.xHd4znodBNouJ2If2YIH59Q9gjr5YIMncJc1IgYwKwC', 'f83947669ac0a771', '2021-04-07 15:29:45'),
('yekederoy@gmail.com', '$2y$10$Eq1limXOemfw37IW/CHfb.oDsfULnDPyNBhog/dats06ai9246ur6', '3e0ea53aeb6f1aa3', '2021-04-07 15:31:55');

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE `venue` (
  `venue` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`venue`, `address`) VALUES
('Caprera Openluchttheater ', 'Hoge Duin en Daalseweg 2, 2061 AG Bloemendaal'),
('Club Ruis', 'Smedestraat 31, 2011 RE Haarlem'),
('Club Stalker', 'Kromme Elleboogsteeg 20, 2011 TS Haarlem'),
('Grote Markt', 'Grote Markt, 2011 RD,  Haarlem\r\n'),
('Jopenkerk', 'Gedempte Voldersgracht 2, 2011 WD Haarlem'),
('Lichtfabriek', 'Minckelersweg 2, 2031 EM Haarlem'),
('Patronaat Main Hall', 'Patronage Zijlsingel 2, Postal code 2013 DN, Haarlem'),
('Patronaat Second Hall', 'Patronage Zijlsingel 2, Postal code 2013 DN, Haarlem'),
('Patronaat Third Hall', 'Patronage Zijlsingel 2, Postal code 2013 DN, Haarlem'),
('XO the Club', 'Grote Markt 8, 2011 RD Haarlem');

-- --------------------------------------------------------

--
-- Table structure for table `volunteer`
--

CREATE TABLE `volunteer` (
  `email` varchar(40) NOT NULL,
  `password` longtext NOT NULL,
  `employee_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `volunteer`
--

INSERT INTO `volunteer` (`email`, `password`, `employee_type`) VALUES
('hfestival21@gmail.com', '$2y$10$BtVm2hmEFnuNWL1yeAbJKue53YWnUN9ltZgomTTnNipMVfTUijOSS', 'admin'),
('yekederoy@gmail.com', '$2y$10$Ru58FWWPOwB9hCQWhVj9CuSyRk3kYxztMbxZKfWId94sdK6yN1gYC', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bundle_tickets`
--
ALTER TABLE `bundle_tickets`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `dance_ticket`
--
ALTER TABLE `dance_ticket`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `dj`
--
ALTER TABLE `dj`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `dj_dance`
--
ALTER TABLE `dj_dance`
  ADD PRIMARY KEY (`dance_id`,`DJ_id`),
  ADD KEY `DJ_id` (`DJ_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `venue_id` (`venue_id`);

--
-- Indexes for table `jazz_ticket`
--
ALTER TABLE `jazz_ticket`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `artist` (`artist`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `customer_id` (`order_id`);

--
-- Indexes for table `order_table`
--
ALTER TABLE `order_table`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `venue`
--
ALTER TABLE `venue`
  ADD PRIMARY KEY (`venue`);

--
-- Indexes for table `volunteer`
--
ALTER TABLE `volunteer`
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bundle_tickets`
--
ALTER TABLE `bundle_tickets`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `dance_ticket`
--
ALTER TABLE `dance_ticket`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `dj`
--
ALTER TABLE `dj`
  MODIFY `ID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `jazz_ticket`
--
ALTER TABLE `jazz_ticket`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bundle_tickets`
--
ALTER TABLE `bundle_tickets`
  ADD CONSTRAINT `bundle_id` FOREIGN KEY (`event_id`) REFERENCES `event` (`ID`);

--
-- Constraints for table `dance_ticket`
--
ALTER TABLE `dance_ticket`
  ADD CONSTRAINT `event_id` FOREIGN KEY (`event_id`) REFERENCES `event` (`ID`);

--
-- Constraints for table `dj_dance`
--
ALTER TABLE `dj_dance`
  ADD CONSTRAINT `DJ_Dance_ibfk_1` FOREIGN KEY (`dance_id`) REFERENCES `event` (`ID`),
  ADD CONSTRAINT `DJ_Dance_ibfk_2` FOREIGN KEY (`DJ_id`) REFERENCES `dj` (`ID`);

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `venue_id` FOREIGN KEY (`venue_id`) REFERENCES `venue` (`venue`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `jazz_ticket`
--
ALTER TABLE `jazz_ticket`
  ADD CONSTRAINT `jazz_ticket_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`ID`);

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_id` FOREIGN KEY (`order_id`) REFERENCES `order_table` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
