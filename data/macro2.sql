SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `inbound_transactions` (
  `id` int(11) NOT NULL,
  `warehouse` varchar(255) NOT NULL,
  `operation` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `products` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `inbound_transactions` (`id`, `warehouse`, `operation`, `quantity`, `products`, `timestamp`) VALUES
(17, 'Default Warehouse', 'Stock Receive', 12, '1984', '2024-12-05 16:02:51'),
(18, 'Backup Warehouse', 'Stock Transfer In', 4, '1984', '2024-12-05 16:03:53'),
(19, 'Ware ware', 'Stock Transfer In', 2, '1984', '2024-12-05 16:04:48'),
(20, 'Ware ware', 'Stock Transfer In', 1, '1984', '2024-12-05 16:05:27'),
(21, 'Ware ware', 'Stock Transfer In', 1, '1984', '2024-12-05 16:05:58'),
(22, 'Ware ware', 'Stock Transfer In', 1, '1984', '2024-12-05 16:06:16'),
(23, 'Default Warehouse', 'Stock Transfer In', 2, '1984', '2024-12-05 16:07:27'),
(24, 'Backup Warehouse', 'Stock Transfer In', 1, '1984', '2024-12-05 16:07:59'),
(25, 'Backup Warehouse', 'Stock Transfer In', 1, '1984', '2024-12-05 16:08:22'),
(26, 'Default Warehouse', 'Stock Transfer In', 2, '1984', '2024-12-05 16:08:55'),
(27, 'Backup Warehouse', 'Stock Transfer In', 4, '1984', '2024-12-05 17:00:26'),
(30, 'Default Warehouse', 'Stock Adjustment', 1, '1984', '2024-12-05 17:15:04'),
(31, 'Default Warehouse', 'Stock Adjustment', 2, '1984', '2024-12-05 17:16:20'),
(32, 'Default Warehouse', 'Stock Adjustment', 4, '1984', '2024-12-05 17:28:19'),
(33, 'Default Warehouse', 'Stock Adjustment', 1, '1984', '2024-12-05 17:35:09'),
(34, 'Default Warehouse', 'Stock Adjustment', 3, '1984', '2024-12-05 17:36:05'),
(35, 'Default Warehouse', 'Stock Adjustment', 4, '1984', '2024-12-05 17:41:29'),
(36, 'Default Warehouse', 'Stock Adjustment', 2, '1984', '2024-12-05 17:43:45'),
(37, 'Default Warehouse', 'Stock Adjustment', 60, '1984 ', '2024-12-05 17:54:09');


CREATE TABLE `outbound_transactions` (
  `id` int(11) NOT NULL,
  `warehouse` varchar(255) NOT NULL,
  `operation` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `products` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `outbound_transactions` (`id`, `warehouse`, `operation`, `quantity`, `products`, `timestamp`) VALUES
(10, 'Default Warehouse', 'Sales Order', 2, '1984', '2024-12-05 16:03:09'),
(11, 'Default Warehouse', 'Stock Transfer Out', 4, '1984', '2024-12-05 16:03:53'),
(12, 'Default Warehouse', 'Stock Transfer Out', 2, '1984', '2024-12-05 16:04:48'),
(13, 'Default Warehouse', 'Stock Transfer Out', 1, '1984', '2024-12-05 16:05:27'),
(14, 'Default Warehouse', 'Stock Transfer Out', 1, '1984', '2024-12-05 16:05:58'),
(15, 'Default Warehouse', 'Stock Transfer Out', 1, '1984', '2024-12-05 16:06:16'),
(16, 'Backup Warehouse', 'Stock Transfer Out', 2, '1984', '2024-12-05 16:07:27'),
(17, 'Default Warehouse', 'Stock Transfer Out', 1, '1984', '2024-12-05 16:07:59'),
(18, 'Default Warehouse', 'Stock Transfer Out', 1, '1984', '2024-12-05 16:08:22'),
(19, 'Backup Warehouse', 'Stock Transfer Out', 2, '1984', '2024-12-05 16:08:55'),
(20, 'Default Warehouse', 'Stock Transfer Out', 4, '1984', '2024-12-05 17:00:26'),
(22, 'Default Warehouse', 'Stock Adjustment', 4, '1984', '2024-12-05 17:22:38'),
(23, 'Default Warehouse', 'Stock Adjustment', 1, '1984', '2024-12-05 17:33:21'),
(24, 'Default Warehouse', 'Stock Adjustment', 2, '1984', '2024-12-05 17:34:11'),
(25, 'Default Warehouse', 'Stock Adjustment', 2, '1984', '2024-12-05 17:35:41'),
(26, 'Default Warehouse', 'Stock Adjustment', 1, '1984', '2024-12-05 17:38:43'),
(27, 'Default Warehouse', 'Stock Adjustment', 2, '1984', '2024-12-05 17:40:47'),
(28, 'Default Warehouse', 'Stock Adjustment', 2, '1984', '2024-12-05 17:42:17'),
(29, 'Default Warehouse', 'Stock Adjustment', 1, '1984', '2024-12-05 17:43:04'),
(30, 'Default Warehouse', 'Stock Adjustment', 50, '1984 ', '2024-12-05 17:53:51'),
(31, 'Default Warehouse', 'Stock Adjustment', 30, '1984 ', '2024-12-05 17:55:16'),
(32, 'Default Warehouse', 'Stock Adjustment', 5, '1984 ', '2024-12-05 17:55:32');


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


INSERT INTO `products` (`id`, `image`, `name`, `category`, `stock`, `reorder_level`, `price`, `supplier_name`, `supplier_address`) VALUES
(1, '/macro/assets/to-kill-a-mockingbird.jpg', 'To Kill a Mockingbird', 'Fiction', 50, 10, 599.00, 'Default Supplier', '123 Default St, City, Country'),
(2, '/macro/assets/1984.jpg', '1984', 'Dystopian', 80, 15, 499.99, 'Default Supplier', '123 Default St, City, Country'),
(3, '/macro/assets/the-great-gatsby.jpg', 'The Great Gatsby', 'Classic', 30, 5, 799.49, 'Default Supplier', '123 Default St, City, Country'),
(4, '/macro/assets/pride-and-prejudice.png', 'Pride and Prejudice', 'Romance', 40, 8, 249.00, 'Default Supplier', '123 Default St, City, Country'),
(5, '/macro/assets/the-hobbit.jpg', 'The Hobbit', 'Fantasy', 60, 12, 1299.29, 'Default Supplier', '123 Default St, City, Country'),
(6, '/macro/assets/to-kill-a-mockingbird.jpg', 'To Kill a Mockingbird', 'Fiction', 50, 10, 18.99, 'Default Supplier', '123 Default St'),
(7, '/macro/assets/1984.jpg', '1984', 'Dystopian', 80, 15, 15.99, 'Default Supplier', '123 Default St'),
(8, '/macro/assets/the-great-gatsby.jpg', 'The Great Gatsby', 'Classic', 30, 5, 10.99, 'Default Supplier', '123 Default St'),
(9, '/macro/assets/pride-and-prejudice.png', 'Pride and Prejudice', 'Romance', 40, 8, 12.99, 'Default Supplier', '123 Default St'),
(10, '/macro/assets/the-hobbit.jpg', 'The Hobbit', 'Fantasy', 60, 12, 25.99, 'Default Supplier', '123 Default St'),
(11, '/macro/assets/war-and-peace.jpg', 'War and Peace', 'Historical', 20, 5, 29.99, 'Classic Books Inc.', '456 History Ave'),
(12, '/macro/assets/moby-dick.jpg', 'Moby-Dick', 'Adventure', 35, 7, 17.49, 'Ocean Press', '789 Ocean Rd'),
(13, '/macro/assets/the-catcher-in-the-rye.jpg', 'The Catcher in the Rye', 'Fiction', 45, 10, 14.99, 'Classic Books Inc.', '456 History Ave'),
(14, '/macro/assets/brave-new-world.jpg', 'Brave New World', 'Dystopian', 90, 20, 19.99, 'Future Press', '111 Future Rd'),
(15, '/macro/assets/lord-of-the-rings.jpg', 'The Lord of the Rings', 'Fantasy', 60, 12, 25.99, 'Epic Reads', '567 Tolkien St'),
(16, '/macro/assets/the-shining.jpg', 'The Shining', 'Horror', 25, 5, 18.49, 'Spooky Books', '987 Creepy St'),
(17, '/macro/assets/dune.jpg', 'Dune', 'Science Fiction', 40, 10, 27.99, 'Sci-Fi World', '654 Desert Ave'),
(18, '/macro/assets/the-alchemist.jpg', 'The Alchemist', 'Adventure', 60, 15, 15.99, 'Dream Publishing', '321 Dream St'),
(19, '/macro/assets/chronicles-of-narnia.jpg', 'The Chronicles of Narnia', 'Fantasy', 70, 14, 16.49, 'Fantasy World', '888 Lion Rd'),
(20, '/macro/assets/frankenstein.jpg', 'Frankenstein', 'Horror', 28, 6, 12.99, 'Horror Publications', '101 Horror Ave'),
(21, '/macro/assets/sherlock-holmes.jpg', 'Sherlock Holmes', 'Mystery', 85, 17, 14.99, 'Mystery Press', '555 Baker St'),
(22, '/macro/assets/alice-in-wonderland.jpg', 'Alice in Wonderland', 'Fantasy', 100, 20, 12.49, 'Wonderland Books', '321 Wonderland St');



CREATE TABLE `racks` (
  `id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `max_unit_capacity` int(11) NOT NULL,
  `last_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `sales_orders` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `warehouse` varchar(255) NOT NULL,
  `product_names` text NOT NULL,
  `quantities` text NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `sales_orders` (`id`, `customer_name`, `warehouse`, `product_names`, `quantities`, `order_date`) VALUES
(3, '', '', '', '', '2024-12-05 14:11:19'),
(4, 'Mel Adry', '', '1984 ', '12', '2024-12-05 14:12:05'),
(5, 'Bean', '', '1984 ', '45', '2024-12-05 14:12:35'),
(6, 'Ad', '', '1984 ', '12', '2024-12-05 14:13:28'),
(8, 'Ahah', '', 'The Great Gatsby ', '45', '2024-12-05 14:14:47'),
(10, 'Ace', '', 'Pride and Prejudice ', '24', '2024-12-05 14:16:20'),
(11, 'Mel Adry', '', 'The Great Gatsby ', '21', '2024-12-05 14:24:27'),
(12, 'fff', '', 'The Great Gatsby ', '1', '2024-12-05 14:26:05'),
(13, 'ff', '', 'The Great Gatsby ', '211', '2024-12-05 14:26:42'),
(14, 'Mel Adry', '', 'The Great Gatsby ', '1', '2024-12-05 14:27:44'),
(15, 'Mel Adry', '', 'The Great Gatsby ', '2', '2024-12-05 14:32:05'),
(16, 'Mel Adry', '', '1984 ', '1', '2024-12-05 14:33:26'),
(17, 'Mel Adry', '', 'The Great Gatsby ', '2', '2024-12-05 14:34:03'),
(18, 'Mel Adry', '', 'The Great Gatsby ', '11', '2024-12-05 14:34:42'),
(19, 'Mel Adry', '', '1984 ', '2', '2024-12-05 15:58:37'),
(20, 'Mel Adry', '', '1984 ', '2', '2024-12-05 16:03:09');


CREATE TABLE `warehouses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `max_unit_capacity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `warehouses` (`id`, `name`, `address`, `max_unit_capacity`) VALUES
(1, 'Default Warehouse', '123 Jaro St, Iloilo City, Iloilo', 9000),
(14, 'Backup Warehouse', '456 La Paz St, Iloilo City, Iloilo', 5000),
(16, 'Ware ware', 'ware ', 121);



CREATE TABLE `warehouse_product` (
  `product_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `rack_id` int(11) DEFAULT NULL,
  `stock_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `warehouse_product` (`product_id`, `warehouse_id`, `rack_id`, `stock_quantity`) VALUES
(2, 1, NULL, 25),
(2, 14, NULL, 6),
(2, 16, NULL, 5);


ALTER TABLE `inbound_transactions`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `outbound_transactions`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `racks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_name` (`name`),
  ADD KEY `warehouse_id` (`warehouse_id`);


ALTER TABLE `sales_orders`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `warehouse_product`
  ADD PRIMARY KEY (`product_id`,`warehouse_id`),
  ADD KEY `warehouse_id` (`warehouse_id`),
  ADD KEY `rack_id` (`rack_id`);


ALTER TABLE `inbound_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

ALTER TABLE `outbound_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;


ALTER TABLE `racks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

ALTER TABLE `sales_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

ALTER TABLE `warehouses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

ALTER TABLE `racks`
  ADD CONSTRAINT `racks_ibfk_1` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON UPDATE CASCADE;

ALTER TABLE `warehouse_product`
  ADD CONSTRAINT `warehouse_product_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `warehouse_product_ibfk_2` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `warehouse_product_ibfk_3` FOREIGN KEY (`rack_id`) REFERENCES `racks` (`id`) ON UPDATE CASCADE;
COMMIT;
