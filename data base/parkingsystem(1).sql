-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2015 at 09:19 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parkingsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `car_info`
--

CREATE TABLE `car_info` (

  `c_number` varchar(20) NOT NULL,
  `u_id` int(11) DEFAULT NULL,
  `c_model` varchar(50) DEFAULT NULL,
  `c_type` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `car_info`
--

INSERT INTO `car_info` (`c_number`, `u_id`, `c_model`, `c_type`) VALUES
('N-1234', 1, 'm_2323', 'private'),
('N-32455', 4, 'M-34523', ''),
('N-332', 1, 'M-1122', 'privet car'),
('N-3333', 1, 'M-321', 'privet ');

-- --------------------------------------------------------

--
-- Table structure for table `park_info`
--

CREATE TABLE `park_info` (
  `p_id` int(11) NOT NULL,
  `c_number` varchar(50) DEFAULT NULL,
  `a_id` int(11) DEFAULT NULL,
  `p_in_time` datetime DEFAULT NULL,
  `p_out_time` datetime DEFAULT NULL,
  `p_status` varchar(10) DEFAULT NULL,
  `p_space` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `park_info`
--

INSERT INTO `park_info` (`p_id`, `c_number`, `a_id`, `p_in_time`, `p_out_time`, `p_status`, `p_space`) VALUES
(1, 'N-332', 1, '2020-03-28 10:25:00', '2020-03-29 06:35:00', 'in', '3,2'),
(2, 'N-3333', 1, '2015-06-02 08:27:26', '2015-06-10 07:13:27', 'in', '1,2'),
(3, 'N-1234', 1, '2015-07-02 17:38:21', '2015-06-03 08:26:30', 'in', '4,4'),
(4, 'N-32455', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'in', '1,4');

-- --------------------------------------------------------

--
-- Table structure for table `park_owner_info`
--

CREATE TABLE `park_owner_info` (
  `o_id` int(11) NOT NULL,
  `o_name` varchar(50) DEFAULT NULL,
  `o_phone` varchar(14) DEFAULT NULL,
  `o_email` varchar(250) DEFAULT NULL,
  `o_address` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `park_owner_info`
--

INSERT INTO `park_owner_info` (`o_id`, `o_name`, `o_phone`, `o_email`, `o_address`) VALUES
(1, 'AB', '015xxxxxxxx', 'example@gmail.com', 'Uttra');

-- --------------------------------------------------------

--
-- Table structure for table `park_zone`
--

CREATE TABLE `park_zone` (
  `a_id` int(11) NOT NULL,
  `o_id` int(11) DEFAULT NULL,
  `a_name` varchar(250) DEFAULT NULL,
  `a_address` varchar(250) DEFAULT NULL,
  `car_space` int(11) DEFAULT NULL,
  `row` int(11) DEFAULT NULL,
  `col` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `park_zone`
--

INSERT INTO `park_zone` (`a_id`, `o_id`, `a_name`, `a_address`, `car_space`, `row`, `col`) VALUES
(1, 1, 'Uttara', 'Uttara,sector 6,road 15', 16, 4, 4),
(2, 1, 'Bonani', 'Bonani,Dhaka,Bangladesh', 10, 3, 3),
(3, 1, 'Dhanmondy', 'Dhanmondy,Dhaka,Bangladesh.', 25, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `u_id` int(11) NOT NULL,
  `u_name` varchar(250) NOT NULL,
  `u_phone` varchar(14) DEFAULT NULL,
  `u_email` varchar(250) DEFAULT NULL,
  `u_address` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`u_id`, `u_name`, `u_phone`, `u_email`, `u_address`) VALUES
(1, 'A', '017xxxxxxxx', 'example@mail.com', 'Dhaka'),
(2, 'A', '012777777', 'xyz@gmail.com', 'uttara,dhaka,bangladesh '),
(3, 'A', '012777777', 'xyz@gmail.com', 'uttara,dhaka'),
(4, 'A', '012777777', 'xyz@gmail.com', 'uttara');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car_info`
--
ALTER TABLE `car_info`
  ADD PRIMARY KEY (`c_number`,`u_id`),
  ADD KEY `car_info_fk1` (`u_id`);

--
-- Indexes for table `park_info`
--
ALTER TABLE `park_info`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `park_info_fk1` (`c_number`),
  ADD KEY `park_info_fk2` (`a_id`);

--
-- Indexes for table `park_owner_info`
--
ALTER TABLE `park_owner_info`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `park_zone`
--
ALTER TABLE `park_zone`
  ADD PRIMARY KEY (`a_id`),
  ADD KEY `park_zone_fk` (`o_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `park_info`
--
ALTER TABLE `park_info`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `park_owner_info`
--
ALTER TABLE `park_owner_info`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `park_zone`
--
ALTER TABLE `park_zone`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `car_info`
--
ALTER TABLE `car_info`
  ADD CONSTRAINT `car_info_fk1` FOREIGN KEY (`u_id`) REFERENCES `user_info` (`u_id`);

--
-- Constraints for table `park_info`
--
ALTER TABLE `park_info`
  ADD CONSTRAINT `park_info_fk1` FOREIGN KEY (`c_number`) REFERENCES `car_info` (`c_number`),
  ADD CONSTRAINT `park_info_fk2` FOREIGN KEY (`a_id`) REFERENCES `park_zone` (`a_id`);

--
-- Constraints for table `park_zone`
--
ALTER TABLE `park_zone`
  ADD CONSTRAINT `park_zone_fk` FOREIGN KEY (`o_id`) REFERENCES `park_owner_info` (`o_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
