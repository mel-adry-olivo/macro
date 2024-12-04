-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2024 at 05:20 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `macro`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `author` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `stock` int(11) NOT NULL,
  `stock_threshold` int(11) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `image`, `author`, `name`, `category`, `stock`, `stock_threshold`, `price`) VALUES
(6, '/macro/assets/to-kill-a-mockingbird.jpg', 'Harper Lee', 'To Kill a Mockingbird', 'Fiction', 50, 10, 425.00),
(7, '/macro/assets/1984.jpg', 'George Orwell', '1984', 'Dystopian', 80, 15, 220.00),
(8, '/macro/assets/the-great-gatsby.jpg', 'F. Scott Fitzgerald', 'The Great Gatsby', 'Classic', 3, 5, 295.00),
(9, '/macro/assets/pride-and-prejudice.png', 'Jane Austen', 'Pride and Prejudice', 'Romance', 40, 8, 950.00),
(10, '/macro/assets/the-hobbit.jpg', 'J.R.R. Tolkien', 'The Hobbit', 'Fantasy', 18, 12, 630.00),
(11, '/macro/assets/1984.jpg', 'George Orwell', '1984', 'Dystopian', 80, 15, 220.00);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `message`, `type`, `created_at`) VALUES
(6, 'The Great Gatsby', 'low_stock', '2024-11-28 04:42:33');

-- --------------------------------------------------------

--
-- Table structure for table `racks`
--

CREATE TABLE `racks` (
  `id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `max_unit_capacity` int(11) NOT NULL,
  `last_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `racks`
--

INSERT INTO `racks` (`id`, `warehouse_id`, `name`, `max_unit_capacity`, `last_updated`) VALUES
(4, 3, 'Rack 4', 250, '2024-11-29 02:52:18'),
(104, 1, 'Rack 341', 120, '2024-12-04 01:40:15'),
(106, 1, 'Rack 921', 5000, '2024-12-04 01:40:20'),
(138, 2, 'Rack 2', 240, '2024-12-04 01:40:35'),
(139, 5, 'Rack 999', 120, '2024-12-04 01:40:30');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `name`, `address`) VALUES
(1, 'Main Warehouse', '123 Jaro St, Iloilo City, Iloilo'),
(2, 'South Depot', '456 Molo St, Iloilo City, Iloilo'),
(3, 'North East Storage', '789 La Paz St, Iloilo City, Iloilo'),
(4, 'West Hub', '101 Arevalo St, Iloilo City, Iloilo'),
(5, 'Central Warehouse', '12 Delgado St, Iloilo City, Iloilo');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_book`
--

CREATE TABLE `warehouse_book` (
  `book_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `rack_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warehouse_book`
--

INSERT INTO `warehouse_book` (`book_id`, `warehouse_id`, `rack_id`, `quantity`) VALUES
(6, 1, 104, 0),
(6, 2, 138, 0),
(7, 1, 104, 0),
(7, 2, 138, 0),
(8, 1, 104, 0),
(8, 2, 138, 0),
(9, 1, 104, 0),
(10, 1, 106, 0),
(11, 1, 106, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_notification` (`message`,`type`);

--
-- Indexes for table `racks`
--
ALTER TABLE `racks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_name` (`name`),
  ADD KEY `warehouse_id` (`warehouse_id`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse_book`
--
ALTER TABLE `warehouse_book`
  ADD PRIMARY KEY (`book_id`,`warehouse_id`),
  ADD KEY `warehouse_id` (`warehouse_id`),
  ADD KEY `rack_id` (`rack_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `racks`
--
ALTER TABLE `racks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `racks`
--
ALTER TABLE `racks`
  ADD CONSTRAINT `racks_ibfk_1` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `warehouse_book`
--
ALTER TABLE `warehouse_book`
  ADD CONSTRAINT `warehouse_book_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `warehouse_book_ibfk_2` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `warehouse_book_ibfk_3` FOREIGN KEY (`rack_id`) REFERENCES `racks` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
