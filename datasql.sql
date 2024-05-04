-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2024 at 07:05 PM
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
-- Database: `travel_agency`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `trip_id` int(11) DEFAULT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `user_id`, `trip_id`, `booking_date`) VALUES
(18, 3, 2, '2024-01-14 18:04:05');

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `trip_id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `photo_url` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `details` text DEFAULT NULL,
  `tickets_left` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`trip_id`, `location`, `photo_url`, `price`, `details`, `tickets_left`, `start_date`, `end_date`) VALUES
(1, 'Paris', 'https://cdn.pixabay.com/photo/2022/02/27/19/46/tourist-attraction-7037967_1280.jpg', '250.00', NULL, 37, '2024-01-20', '2024-02-01'),
(2, 'London', 'https://media.licdn.com/dms/image/C5612AQEbECVj8Aqf-g/article-cover_image-shrink_600_2000/0/1652367561301?e=2147483647&v=beta&t=U0yLc6wX3iHGZRDoeX7CIgSQPMVcEj7d6DCm5Kh6SD8', '986.00', NULL, 21, '2024-01-24', '2024-02-01'),
(3, 'Rome', 'https://cdn.mos.cms.futurecdn.net/BiNbcY5fXy9Lra47jqHKGK-650-80.jpg.webp', '856.00', NULL, 55, '2024-01-01', '2024-02-01'),
(6, 'Rio de Janeiro', 'https://wallpapercave.com/wp/wp4961434.jpg', '1200.00', NULL, 56, '2024-01-31', '2024-02-10'),
(7, 'Barcelona', 'https://w0.peakpx.com/wallpaper/687/900/HD-wallpaper-sagrada-familia-aerial-view-evening-barcelona-roman-catholic-basilica-barcelona-cityscape-barcelona-aerial-view-barcelona-panorama-catalonia-spain.jpg', '120.00', NULL, 74, '2024-01-30', '2024-02-05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_nr` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `phone_nr`, `password`, `email`, `role`) VALUES
(2, 'admin', '44567895134', '$2y$10$6/ZKXAXaMWzv4B7XoQOyvuRSfQZtXFBLRFenSAMoSX4iVCu4OWTDC', 'admin@test.com', 'admin'),
(3, 'Stiljano', '3558745216', '$2y$10$XP8CBHzAFHXn9aSvc2rxC.ddKAYWJjdnHrvt11cSVtMpINx07CEfW', 'stiljano@gmail.com', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `trip_id` (`trip_id`);

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`trip_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `trip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`trip_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
