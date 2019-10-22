-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2019 at 04:40 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `property_market_nepal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_message`
--

CREATE TABLE `admin_message` (
  `message_id` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `message_date` varchar(255) NOT NULL,
  `useremail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_message`
--

INSERT INTO `admin_message` (`message_id`, `message`, `message_date`, `useremail`) VALUES
(1, 'hello there', 'Wednesday 20th of June 2018 , 01:34:15 AM', 'bibashkatel4@gmail.com'),
(2, 'hello bikash, you havent contacted us ever', 'Wednesday 20th of June 2018 , 01:35:03 AM', 'bikash123@gmail.com'),
(3, 'Hello bikash', 'Tuesday 3rd of July 2018 , 12:32:49 PM', 'bikash123@gmail.com'),
(4, 'You are a new user', 'Saturday 14th of July 2018 , 04:04:13 AM', 'ajay123@gmail.com'),
(5, 'Hello kto', 'Monday 22nd of July 2019 , 07:27:44 AM', 'manoj@gmail.com'),
(6, 'Ok nischal we will see', 'Tuesday 17th of September 2019 , 10:11:47 PM', 'nischal@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `best_selling_property`
--

CREATE TABLE `best_selling_property` (
  `property_id` varchar(255) NOT NULL,
  `property_name` varchar(255) NOT NULL,
  `property_updated_date` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `best_selling_property`
--

INSERT INTO `best_selling_property` (`property_id`, `property_name`, `property_updated_date`, `image_path`) VALUES
('P1', 'House at maitidevi', 'Thursday 21st of June 2018 , 12:33:08 PM', 'Photos/Best_selling_property_images/P1image1.jpg'),
('P16', 'House', 'Tuesday 17th of September 2019 , 10:13:39 PM', 'Photos/Best_selling_property_images/P16istockphoto-856794608-612x612.jpg'),
('P2', 'House at bhaktapur', 'Thursday 21st of June 2018 , 02:33:57 PM', 'Photos/Best_selling_property_images/P2image2.jpg'),
('P4', 'House at lokhanthali', 'Thursday 21st of June 2018 , 05:46:29 PM', 'Photos/Best_selling_property_images/P4H4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `property_id` varchar(255) NOT NULL,
  `comment` longtext,
  `comment_date` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `useremail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `property_id`, `comment`, `comment_date`, `username`, `useremail`) VALUES
(11, 'H2', 'This is a big house', 'Sunday 24th of June 2018 , 01:20:27 PM', 'BIBASH KATEL', 'bibashkatel4@gmail.com'),
(18, 'H3', 'Nice house', 'Sunday 24th of June 2018 , 01:26:15 PM', 'BIBASH KATEL', 'bibashkatel4@gmail.com'),
(20, 'H3', 'My name is bibash', 'Sunday 24th of June 2018 , 01:43:04 PM', 'BIBASH KATEL', 'bibashkatel4@gmail.com'),
(21, 'H3', 'hello', 'Sunday 24th of June 2018 , 01:44:07 PM', 'BIBASH KATEL', 'bibashkatel4@gmail.com'),
(23, 'F1', 'nice flat', 'Sunday 24th of June 2018 , 01:52:31 PM', 'BIBASH KATEL', 'bibashkatel4@gmail.com'),
(29, 'H2', 'My order has not been confirmed', 'Tuesday 26th of June 2018 , 11:32:17 AM', 'BIBASH KATEL', 'bibashkatel4@gmail.com'),
(30, 'L1', 'The land seems to be near sea', 'Tuesday 26th of June 2018 , 11:54:58 AM', 'BIBASH KATEL', 'bibashkatel4@gmail.com'),
(31, 'L3', 'what is in the filed?', 'Thursday 28th of June 2018 , 10:20:33 PM', 'Bibash Katel', 'bibashkatel4@gmail.com'),
(32, 'H2', 'Desciption is not clear', 'Saturday 7th of July 2018 , 12:48:23 AM', 'Suman Katel', 'suman.katel.7@gmail.com'),
(33, 'H2', 'house is too costly', 'Sunday 8th of July 2018 , 03:22:37 PM', 'Bibash Katel', 'bibashkatel4@gmail.com'),
(34, 'L2', 'Too far', 'Monday 22nd of July 2019 , 07:23:29 AM', 'Monaj Dangi', 'manoj@gmail.com'),
(35, 'R1', 'hello this is new user', 'Tuesday 17th of September 2019 , 10:07:24 PM', 'Nischal Rimal', 'nischal@gmail.com'),
(36, 'L1', 'hello bibash i m nishcal rimal', 'Tuesday 17th of September 2019 , 10:07:57 PM', 'Nischal Rimal', 'nischal@gmail.com'),
(37, 'H15', 'Ok new house uploaded', 'Tuesday 17th of September 2019 , 10:16:37 PM', 'Nischal Rimal', 'nischal@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `favourite_flat`
--

CREATE TABLE `favourite_flat` (
  `flat_id` varchar(255) NOT NULL,
  `useremail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favourite_flat`
--

INSERT INTO `favourite_flat` (`flat_id`, `useremail`) VALUES
('F1', 'bibashkatel4@gmail.com'),
('F1', 'bibashkatel4@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `favourite_house`
--

CREATE TABLE `favourite_house` (
  `useremail` varchar(255) NOT NULL,
  `house_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favourite_house`
--

INSERT INTO `favourite_house` (`useremail`, `house_id`) VALUES
('bibashkatel4@gmail.com', 'H3'),
('bibashkatel4@gmail.com', 'H3'),
('nischal@gmail.com', 'H3'),
('nischal@gmail.com', 'H15');

-- --------------------------------------------------------

--
-- Table structure for table `favourite_land`
--

CREATE TABLE `favourite_land` (
  `useremail` varchar(255) NOT NULL,
  `land_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favourite_land`
--

INSERT INTO `favourite_land` (`useremail`, `land_id`) VALUES
('bibashkatel4@gmail.com', 'L1'),
('bibashkatel4@gmail.com', 'L1'),
('manoj@gmail.com', 'L1'),
('nischal@gmail.com', 'L1');

-- --------------------------------------------------------

--
-- Table structure for table `favourite_room`
--

CREATE TABLE `favourite_room` (
  `useremail` varchar(255) NOT NULL,
  `room_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favourite_room`
--

INSERT INTO `favourite_room` (`useremail`, `room_id`) VALUES
('bibashkatel4@gmail.com', 'R1'),
('bibashkatel4@gmail.com', 'R1'),
('nischal@gmail.com', 'R1');

-- --------------------------------------------------------

--
-- Table structure for table `flat`
--

CREATE TABLE `flat` (
  `flat_id` varchar(255) NOT NULL,
  `flat_location` varchar(255) NOT NULL,
  `no_of_room` int(11) NOT NULL,
  `flat_price` varchar(255) NOT NULL,
  `image_path` longtext NOT NULL,
  `flat_description` longtext NOT NULL,
  `discount_amount` int(11) NOT NULL,
  `flat_updated_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `flat`
--

INSERT INTO `flat` (`flat_id`, `flat_location`, `no_of_room`, `flat_price`, `image_path`, `flat_description`, `discount_amount`, `flat_updated_date`) VALUES
('F1', 'biratnagar', 5, '16000', 'Photos/flat_photos/F1H1.jpg', 'this is flat is in 9th floor', 2, 'Tuesday 26th of June 2018 , 02:18:12 PM');

-- --------------------------------------------------------

--
-- Table structure for table `house`
--

CREATE TABLE `house` (
  `house_id` varchar(255) NOT NULL,
  `house_location` varchar(255) NOT NULL,
  `no_of_flat` int(11) NOT NULL,
  `house_price` varchar(255) NOT NULL,
  `no_of_room` int(11) NOT NULL,
  `image_path` longtext NOT NULL,
  `house_description` longtext NOT NULL,
  `discount_amount` int(11) NOT NULL,
  `house_updated_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `house`
--

INSERT INTO `house` (`house_id`, `house_location`, `no_of_flat`, `house_price`, `no_of_room`, `image_path`, `house_description`, `discount_amount`, `house_updated_date`) VALUES
('H15', 'Kathmanndu', 13, '4500000', 45, 'Photos/house_photos/H15istockphoto-856794608-612x612.jpg', '                                                                        Thhis is favourite selling house                                                                ', 13, 'Tuesday 17th of September 2019 , 10:15:06 PM'),
('H3', 'Nepalgung', 4, '7851200', 25, 'Photos/house_photos/H3H5.jpg', 'The house is at the boundary of the district', 14, 'Sunday 24th of June 2018 , 11:37:01 AM');

-- --------------------------------------------------------

--
-- Table structure for table `land`
--

CREATE TABLE `land` (
  `land_id` varchar(255) NOT NULL,
  `land_location` varchar(255) NOT NULL,
  `land_area` varchar(255) NOT NULL,
  `land_price` varchar(255) NOT NULL,
  `image_path` longtext NOT NULL,
  `land_description` longtext NOT NULL,
  `discount_amount` int(11) NOT NULL,
  `land_updated_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `land`
--

INSERT INTO `land` (`land_id`, `land_location`, `land_area`, `land_price`, `image_path`, `land_description`, `discount_amount`, `land_updated_date`) VALUES
('L1', 'biratnagar', '1500', '145120', 'Photos/land_photos/L1land1.jpg', 'The sea is near the land', 12, 'Tuesday 26th of June 2018 , 02:18:41 PM'),
('L2', 'Bhakpatur, mulpani ', '15000', '4520000', 'Photos/land_photos/L2land 5.jpg', ' and there is no any source of water', 0, 'Saturday 14th of July 2018 , 04:06:09 AM'),
('L3', 'Birjung', '1450', '45785200', 'Photos/land_photos/L3land 9.jpg', 'The land is bare ', 5, 'Saturday 14th of July 2018 , 04:05:36 AM');

-- --------------------------------------------------------

--
-- Table structure for table `ordered_flat`
--

CREATE TABLE `ordered_flat` (
  `flat_id` varchar(255) NOT NULL,
  `order_status` varchar(255) DEFAULT NULL,
  `useremail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordered_flat`
--

INSERT INTO `ordered_flat` (`flat_id`, `order_status`, `useremail`) VALUES
('F1', 'confirmed', 'nischal@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `ordered_house`
--

CREATE TABLE `ordered_house` (
  `house_id` varchar(255) NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `useremail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordered_house`
--

INSERT INTO `ordered_house` (`house_id`, `order_status`, `useremail`) VALUES
('H15', 'Not confirmed', 'nischal@gmail.com'),
('H2', 'confirmed', 'bibashkatel4@gmail.com'),
('H3', 'confirmed', 'bibashkatel4@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `ordered_land`
--

CREATE TABLE `ordered_land` (
  `land_id` varchar(255) NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `useremail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordered_land`
--

INSERT INTO `ordered_land` (`land_id`, `order_status`, `useremail`) VALUES
('L1', 'confirmed', 'bibashkatel4@gmail.com'),
('L2', 'Not confirmed', 'bibashkatel4@gmail.com'),
('L3', 'Not confirmed', 'bibashkatel4@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `ordered_room`
--

CREATE TABLE `ordered_room` (
  `room_id` varchar(255) NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `useremail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordered_room`
--

INSERT INTO `ordered_room` (`room_id`, `order_status`, `useremail`) VALUES
('R1', 'confirmed', 'bibashkatel4@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` varchar(255) NOT NULL,
  `room_location` varchar(255) NOT NULL,
  `room_area` varchar(255) NOT NULL,
  `room_price` varchar(255) NOT NULL,
  `image_path` longtext NOT NULL,
  `room_description` longtext NOT NULL,
  `discount_amount` int(11) NOT NULL,
  `room_updated_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_location`, `room_area`, `room_price`, `image_path`, `room_description`, `discount_amount`, `room_updated_date`) VALUES
('R1', 'Butwal', '15', '4500', 'Photos/room_photos/R1image2.jpg', 'The room only has 1 bed', 5, 'Tuesday 26th of June 2018 , 02:18:27 PM');

-- --------------------------------------------------------

--
-- Table structure for table `unregistered_user_message`
--

CREATE TABLE `unregistered_user_message` (
  `message_id` int(11) NOT NULL,
  `username` varchar(225) NOT NULL,
  `useremail` varchar(255) NOT NULL,
  `userphone` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `message_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unregistered_user_message`
--

INSERT INTO `unregistered_user_message` (`message_id`, `username`, `useremail`, `userphone`, `message`, `message_date`) VALUES
(2, 'Suman Katel', 'suman@gmail.com', '+97798612121', 'can i buy the property after visiting the place?', 'Tuesday 19th of June 2018 , 03:01:26 PM'),
(3, 'Manoj Dangi', 'manoj@gmail.com', '+9954545412', 'Can i add share to this place ?', 'Tuesday 19th of June 2018 , 03:02:06 PM'),
(9, 'Bibash Katel', 'Email@gmail.com', '+9775451221', 'This is a short message i m sending to u ? what do u say about it?', 'Wednesday 20th of June 2018 , 05:27:25 PM'),
(10, 'Bibash Katel', 'Email@gmail.com', '+9775451221', 'This is a short message i m sending to u ? what do u say about it?', 'Wednesday 20th of June 2018 , 05:27:26 PM'),
(11, 'Suman Katel', 'Suman@gmail.com', '+9779864321', 'I am unable to login, i got an account ', 'Saturday 7th of July 2018 , 12:42:59 AM'),
(12, 'bishes', 'rrtrtr@gmail.com', '+987456321', '42422424', 'Sunday 8th of July 2018 , 03:06:30 PM'),
(13, 'Tulasi ghimire', 'tulsighm@gmail.com', '+97798154783', 'Are there house available in nepal gunj', 'Friday 13th of July 2018 , 09:07:21 PM'),
(14, 'Sudip chaulagain', 'chaula@sudip.com', '+977984501214', 'Can i sell the house?', 'Friday 13th of July 2018 , 09:15:22 PM'),
(15, 'Bikash yadhav', 'bikash@gmail.com', '+97798451201', 'Can we sell the property or only buy?\n', 'Friday 13th of July 2018 , 09:19:29 PM'),
(16, 'Bibash', 'bibashkatel4@gmail.com', '9862078511', 'Helllo this is testing of the project', 'Tuesday 17th of September 2019 , 10:03:44 PM');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `security_code` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`email`, `name`, `phone_number`, `security_code`, `password`, `user_type`) VALUES
('admin@gmail.com', 'admin', '+9779812355506', '12345', '12345678Admin', 'admin'),
('ajay123@gmail.com', 'Ajay subedi', '+9779860507648', '1234567', 'Ajay12345', 'normal'),
('bibashkatel4@gmail.com', 'Bibash Katel', '+9779862078511', '67854123', 'KaT12345', 'normal'),
('bikash123@gmail.com', 'bikash mandal', '+9779809515420', '123456', '12345Bib', 'normal'),
('manoj@gmail.com', 'Monaj Dangi', '+97793212132', '1234567', '123456Man', 'normal'),
('nischal@gmail.com', 'Nischal Rimal', '98123456789', '12345678', 'Nischal123', 'normal'),
('suman.katel.7@gmail.com', 'Suman Katel', '+9779860073598', '12345678', 'Suman1234', 'normal'),
('Yashim@gmail.com', 'Yashim Chaulagain', '+9779741256', '4512688', '4512587Yam', 'normal');

-- --------------------------------------------------------

--
-- Table structure for table `user_message`
--

CREATE TABLE `user_message` (
  `message_id` int(11) NOT NULL,
  `message_date` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `useremail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_message`
--

INSERT INTO `user_message` (`message_id`, `message_date`, `message`, `useremail`) VALUES
(1, 'Tuesday 19th of June 2018 , 09:20:18 PM', 'the slide show is not working', 'bibashkatel4@gmail.com'),
(2, 'Tuesday 19th of June 2018 , 09:22:01 PM', 'The number of houses are small', 'bibashkatel4@gmail.com'),
(9, 'Saturday 7th of July 2018 , 12:49:37 AM', 'Where is your location', 'suman.katel.7@gmail.com'),
(10, 'Sunday 8th of July 2018 , 03:16:26 PM', 'reply my message', 'suman.katel.7@gmail.com'),
(11, 'Monday 22nd of July 2019 , 07:23:10 AM', 'whats up', 'manoj@gmail.com'),
(12, 'Tuesday 17th of September 2019 , 10:10:23 PM', 'Hello admin can yyou post some new content', 'nischal@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_message`
--
ALTER TABLE `admin_message`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `FKadmin_mess445962` (`useremail`);

--
-- Indexes for table `best_selling_property`
--
ALTER TABLE `best_selling_property`
  ADD PRIMARY KEY (`property_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `FKcomment470826` (`useremail`);

--
-- Indexes for table `favourite_flat`
--
ALTER TABLE `favourite_flat`
  ADD KEY `FKfavourite_109330` (`flat_id`),
  ADD KEY `FKfavourite_332071` (`useremail`);

--
-- Indexes for table `favourite_house`
--
ALTER TABLE `favourite_house`
  ADD KEY `FKfavourite_10621` (`useremail`),
  ADD KEY `FKfavourite_69960` (`house_id`);

--
-- Indexes for table `favourite_land`
--
ALTER TABLE `favourite_land`
  ADD KEY `FKfavourite_163509` (`useremail`),
  ADD KEY `FKfavourite_727712` (`land_id`);

--
-- Indexes for table `favourite_room`
--
ALTER TABLE `favourite_room`
  ADD KEY `FKfavourite_971268` (`useremail`),
  ADD KEY `FKfavourite_252554` (`room_id`);

--
-- Indexes for table `flat`
--
ALTER TABLE `flat`
  ADD PRIMARY KEY (`flat_id`);

--
-- Indexes for table `house`
--
ALTER TABLE `house`
  ADD PRIMARY KEY (`house_id`);

--
-- Indexes for table `land`
--
ALTER TABLE `land`
  ADD PRIMARY KEY (`land_id`);

--
-- Indexes for table `ordered_flat`
--
ALTER TABLE `ordered_flat`
  ADD PRIMARY KEY (`flat_id`),
  ADD KEY `FKordered_fl808822` (`useremail`);

--
-- Indexes for table `ordered_house`
--
ALTER TABLE `ordered_house`
  ADD PRIMARY KEY (`house_id`),
  ADD KEY `FKordered_ho769389` (`useremail`);

--
-- Indexes for table `ordered_land`
--
ALTER TABLE `ordered_land`
  ADD PRIMARY KEY (`land_id`),
  ADD KEY `FKordered_la977384` (`useremail`);

--
-- Indexes for table `ordered_room`
--
ALTER TABLE `ordered_room`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `FKordered_ro169625` (`useremail`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `unregistered_user_message`
--
ALTER TABLE `unregistered_user_message`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- Indexes for table `user_message`
--
ALTER TABLE `user_message`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `FKuser_messa321390` (`useremail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_message`
--
ALTER TABLE `admin_message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `unregistered_user_message`
--
ALTER TABLE `unregistered_user_message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_message`
--
ALTER TABLE `user_message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_message`
--
ALTER TABLE `admin_message`
  ADD CONSTRAINT `FKadmin_mess445962` FOREIGN KEY (`useremail`) REFERENCES `user` (`email`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FKcomment470826` FOREIGN KEY (`useremail`) REFERENCES `user` (`email`);

--
-- Constraints for table `favourite_flat`
--
ALTER TABLE `favourite_flat`
  ADD CONSTRAINT `FKfavourite_109330` FOREIGN KEY (`flat_id`) REFERENCES `flat` (`flat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FKfavourite_332071` FOREIGN KEY (`useremail`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `favourite_house`
--
ALTER TABLE `favourite_house`
  ADD CONSTRAINT `FKfavourite_10621` FOREIGN KEY (`useremail`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FKfavourite_69960` FOREIGN KEY (`house_id`) REFERENCES `house` (`house_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `favourite_land`
--
ALTER TABLE `favourite_land`
  ADD CONSTRAINT `FKfavourite_163509` FOREIGN KEY (`useremail`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FKfavourite_727712` FOREIGN KEY (`land_id`) REFERENCES `land` (`land_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `favourite_room`
--
ALTER TABLE `favourite_room`
  ADD CONSTRAINT `FKfavourite_252554` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FKfavourite_971268` FOREIGN KEY (`useremail`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ordered_flat`
--
ALTER TABLE `ordered_flat`
  ADD CONSTRAINT `FKordered_fl808822` FOREIGN KEY (`useremail`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ordered_house`
--
ALTER TABLE `ordered_house`
  ADD CONSTRAINT `FKordered_ho769389` FOREIGN KEY (`useremail`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ordered_land`
--
ALTER TABLE `ordered_land`
  ADD CONSTRAINT `FKordered_la977384` FOREIGN KEY (`useremail`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ordered_room`
--
ALTER TABLE `ordered_room`
  ADD CONSTRAINT `FKordered_ro169625` FOREIGN KEY (`useremail`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_message`
--
ALTER TABLE `user_message`
  ADD CONSTRAINT `FKuser_messa321390` FOREIGN KEY (`useremail`) REFERENCES `user` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
