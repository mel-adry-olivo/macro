-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2024 at 04:06 PM
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
-- Table structure for table `inbound_transactions`
--

CREATE TABLE `inbound_transactions` (
  `id` int(11) NOT NULL,
  `warehouse` varchar(255) NOT NULL,
  `operation` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `products` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inbound_transactions`
--

INSERT INTO `inbound_transactions` (`id`, `warehouse`, `operation`, `quantity`, `products`, `timestamp`) VALUES
(1, 'Default Warehouse', 'Stock Receive', 12, '1984', '2024-12-05 16:02:51'),
(2, 'Backup Warehouse', 'Stock Transfer In', 4, '1984', '2024-12-05 16:03:53');

-- --------------------------------------------------------

--
-- Table structure for table `outbound_transactions`
--

CREATE TABLE `outbound_transactions` (
  `id` int(11) NOT NULL,
  `warehouse` varchar(255) NOT NULL,
  `operation` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `products` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `stock` int(11) NOT NULL,
  `reorder_level` int(11) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `supplier_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `image`, `name`, `category`, `stock`, `reorder_level`, `price`, `supplier_name`, `supplier_address`) VALUES
(1, '/macro/assets/to-kill-a-mockingbird.jpg', 'To Kill a Mockingbird', 'Fiction', 50, 10, 599.00, 'Default Supplier', '123 Default St, City, Country'),
(2, '/macro/assets/1984.jpg', '1984', 'Dystopian', 80, 15, 499.99, 'Default Supplier', '123 Default St, City, Country'),
(3, '/macro/assets/the-great-gatsby.jpg', 'The Great Gatsby', 'Classic', 30, 5, 799.49, 'Default Supplier', '123 Default St, City, Country'),
(4, '/macro/assets/pride-and-prejudice.png', 'Pride and Prejudice', 'Romance', 40, 8, 249.00, 'Default Supplier', '123 Default St, City, Country'),
(5, '/macro/assets/the-hobbit.jpg', 'The Hobbit', 'Fantasy', 60, 12, 1299.29, 'Default Supplier', '123 Default St, City, Country');

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

-- --------------------------------------------------------

--
-- Table structure for table `sales_orders`
--

CREATE TABLE `sales_orders` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `warehouse` varchar(255) NOT NULL,
  `product_names` text NOT NULL,
  `quantities` text NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `max_unit_capacity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `name`, `address`, `max_unit_capacity`) VALUES
(1, 'Default Warehouse', '123 Jaro St, Iloilo City, Iloilo', 9000),
(14, 'Backup Warehouse', '456 La Paz St, Iloilo City, Iloilo', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_product`
--

CREATE TABLE `warehouse_product` (
  `product_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `rack_id` int(11) DEFAULT NULL,
  `stock_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--
-- Indexes for table `inbound_transactions`
--
ALTER TABLE `inbound_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outbound_transactions`
--
ALTER TABLE `outbound_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `racks`
--
ALTER TABLE `racks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_name` (`name`),
  ADD KEY `warehouse_id` (`warehouse_id`);

--
-- Indexes for table `sales_orders`
--
ALTER TABLE `sales_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse_product`
--
ALTER TABLE `warehouse_product`
  ADD PRIMARY KEY (`product_id`,`warehouse_id`),
  ADD KEY `warehouse_id` (`warehouse_id`),
  ADD KEY `rack_id` (`rack_id`);


--
-- AUTO_INCREMENT for table `inbound_transactions`
--
ALTER TABLE `inbound_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `outbound_transactions`
--
ALTER TABLE `outbound_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `racks`
--
ALTER TABLE `racks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `sales_orders`
--
ALTER TABLE `sales_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;


--
-- Constraints for table `racks`
--
ALTER TABLE `racks`
  ADD CONSTRAINT `racks_ibfk_1` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `warehouse_product`
--
ALTER TABLE `warehouse_product`
  ADD CONSTRAINT `warehouse_product_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `warehouse_product_ibfk_2` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `warehouse_product_ibfk_3` FOREIGN KEY (`rack_id`) REFERENCES `racks` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
