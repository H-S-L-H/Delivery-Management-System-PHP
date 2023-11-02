-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2023 at 06:19 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `delivery_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `id` int(255) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `contact_phone` varchar(255) NOT NULL,
  `contact_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`id`, `contact_name`, `contact_phone`, `contact_description`) VALUES
(7, 'Hla Hla', '09876543212', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It h'),
(8, 'Kay Kay', '09876543212', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'),
(10, 'Zaw Zaw', '09876543212', 'Lorem Ipsum'),
(11, 'Julia', '09876543212', 'Hello'),
(12, 'TaiYan', '09876543212', 'ddfdf');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(255) NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `sender_name` varchar(255) NOT NULL,
  `sender_phone` varchar(25) NOT NULL,
  `pickup_address` varchar(500) NOT NULL,
  `pickup_date` date NOT NULL,
  `pickup_vehicle` varchar(25) NOT NULL,
  `receiver_name` varchar(255) NOT NULL,
  `receiver_phone` varchar(25) NOT NULL,
  `receiver_address` varchar(500) NOT NULL,
  `estimate_arrival_date` date DEFAULT NULL,
  `deliver_method` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `parcel_price` int(255) DEFAULT NULL,
  `delivery_fee` int(255) NOT NULL,
  `parcel_weight` int(255) NOT NULL,
  `sender_note` varchar(500) DEFAULT NULL,
  `order_status` varchar(255) DEFAULT NULL,
  `user_id` int(255) NOT NULL,
  `current_timestamp` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `sender_name`, `sender_phone`, `pickup_address`, `pickup_date`, `pickup_vehicle`, `receiver_name`, `receiver_phone`, `receiver_address`, `estimate_arrival_date`, `deliver_method`, `payment_method`, `parcel_price`, `delivery_fee`, `parcel_weight`, `sender_note`, `order_status`, `user_id`, `current_timestamp`) VALUES
(18, '#69786417', 'Hla Hla', '09853167893', 'dsad', '2023-03-01', 'ကား', 'Aye Aye', '09875432576', 'sdasd', '0000-00-00', 'အောင်မင်္ဂလာအဝေးပြေးဂိတ်', 'ပို့သူရှင်း', 0, 0, 0, '', 'ပစ္စည်းလာယူနေဆဲ', 10, '2023-02-28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `roles` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_phone`, `user_email`, `user_password`, `roles`) VALUES
(9, 'Admin', '09979668783', 'admin@gmail.com', '$2y$10$XhDwo8EdQZoILVfRdR0Gl.18/ksba5Rlzkiua5.yQ3wJ45RozIEaq', 1),
(10, 'KgKg', '09876543212', 'kg@gmail.com', '$2y$10$XmObhvf44lMB5ZJ4ZjHw8.9w/F0lgCpZuC.jXOEEfI8u9pmw5CzGe', 0),
(13, 'Hello', '09979668782', 'd@gmail.com', '$2y$10$pgWyHW7ldQ8kEP1TivfUS.pDQJ/eNDxE1huz8odYVHCPJB5RLAvI6', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
