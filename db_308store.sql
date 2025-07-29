-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2025 at 10:02 AM
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
-- Database: `db_308store`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'T-shirt', '2025-03-02 07:06:54', '2025-03-24 07:20:09'),
(2, 'Shirt', '2025-03-02 07:07:26', '2025-03-02 07:07:26'),
(3, 'Bag', '2025-03-02 07:07:34', '2025-03-02 07:07:34'),
(4, 'Accessories', '2025-03-02 07:07:41', '2025-03-02 07:07:41'),
(5, 'Pants', '2025-03-02 07:07:48', '2025-03-02 07:07:48'),
(6, 'Jacket', '2025-03-08 09:23:55', '2025-03-08 09:23:55'),
(7, 'Sweater', '2025-03-08 09:24:08', '2025-03-08 09:24:08');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(10, '2025-02-27-084731', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1740899142, 1),
(11, '2025-02-27-085159', 'App\\Database\\Migrations\\CreateCategoriesTable', 'default', 'App', 1740899142, 1),
(12, '2025-02-27-085321', 'App\\Database\\Migrations\\CreateProductsTable', 'default', 'App', 1740899142, 1),
(13, '2025-03-02-042640', 'App\\Database\\Migrations\\CreateProductImagesTable', 'default', 'App', 1740899142, 1),
(14, '2025-03-06-054124', 'App\\Database\\Migrations\\CreateTitleTable', 'default', 'App', 1741239889, 2),
(15, '2025-03-06-070410', 'App\\Database\\Migrations\\AddImage2ToTitle', 'default', 'App', 1741244675, 3),
(16, '2025-03-09-064256', 'App\\Database\\Migrations\\AddParentIdToCategory', 'default', 'App', 1741502708, 4),
(17, '2025-03-09-070659', 'App\\Database\\Migrations\\AddParentIdToCategory', 'default', 'App', 1741504068, 5),
(18, '2025-03-11-093952', 'App\\Database\\Migrations\\AddSubCategoryIdToProduct', 'default', 'App', 1741686179, 6),
(19, '2025-03-12-073132', 'App\\Database\\Migrations\\CreateProductTable', 'default', 'App', 1741765050, 7),
(21, '2025-03-12-074756', 'App\\Database\\Migrations\\CreateTablesubCategory', 'default', 'App', 1741767055, 8),
(22, '2025-03-12-080908', 'App\\Database\\Migrations\\RemoveParentIdFromCategories', 'default', 'App', 1741767101, 9);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) UNSIGNED NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `stok` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `sub_category_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `product_name`, `stok`, `price`, `description`, `image`, `created_at`, `updated_at`, `sub_category_id`) VALUES
(2, 1, 'T-Shirt 308 Logo - Black', 0, 82000.00, 'Category : T-shirt\r\nMaterial : COTTON 30S\r\nModel : REGULER fit / Model Height 172cm Weight 65KG using size XL', '1742804866_97ccaa585e6df2e2db56.webp', '2025-03-19 07:16:40', '2025-05-16 12:52:54', 1),
(3, 7, 'ZIP HOODIE 308 PATCH - ARMY', 0, 238000.00, 'Material : COTTON FLEECE\r\nModel : REGULER fit / Model Height 175cm Weight 55 KG using size L\r\nSize : M L XL XXL', '1742799956_c033e5a62b697aa32f1d.webp', '2025-03-24 07:05:56', '2025-05-16 12:53:22', 25),
(5, 3, ' BACKPACK / TAS RANSEL BAG LAPTOP ABSOLUTE 308 COLLEGE - Black', 50, 132000.00, 'CATEGORY: BAG LAPTOP\r\n\r\nMaterial : CORDURA\r\n\r\nCOLOR: BLACK', '1745999224_661c3a8d5f36f6b2cb41.webp', '2025-04-30 07:46:45', '2025-05-23 14:04:42', 20),
(6, 1, 'T-SHIRT LS COMBINE HOOD ABSLT OVAL WORLD - DARK GREY', 50, 192000.00, 'Category : T-shirt\r\n\r\nMaterial : COTTON 30S\r\n\r\nModel : REGULER fit / Model Height 175cm Weight 60KG using size XL', '1746091129_4ab965451168d3717e5d.webp', '2025-05-01 09:18:30', '2025-05-23 14:04:23', 1),
(7, 2, 'SHIRT FLANEL 3 LINE GREY - GREY', 45, 292000.00, 'Material : COTTON FLANNEL\r\n\r\nModel : REGULER fit / Model Height 172cm Weight 75KG using size L', '1746091294_bbc463929a12e9510fb4.webp', '2025-05-01 09:21:34', '2025-07-23 12:58:58', 16),
(8, 1, 'T-SHIRT ABSLT UNSCRD SPLIT. - Black', 47, 81999.00, 'Category : T-shirt\r\n\r\nMaterial : Cotton 30s\r\n\r\nColour : Black\r\n\r\nModel : Reguler fit / Model Height 175cm Weight 70 use size XL\r\n', '1746448787_bfc47091d804122621df.webp', '2025-05-05 12:39:47', '2025-07-23 12:58:58', 1),
(9, 1, 'T-Shirt OVERSIZE ABSLT VIRUS PURPLE - BLACK', 46, 137000.00, 'Category : T-shirt\r\n\r\nMaterial : COTTON 20S\r\n\r\nModel : Oversize fit / Model Height 175cm Weight 60KG using size XL\r\n', '1746448932_33df01cdd53735b75d7a.webp', '2025-05-05 12:42:12', '2025-05-23 13:46:07', 1),
(10, 1, 'T-SHIRT ABSLT UNSCRD FIRM - BLACK - UNISEX', 45, 82000.00, 'Category : T-shirt\r\nMaterial : Cotton combed\r\nColour : Black', '1747900460_15c4bafc2f070439bb8a.webp', '2025-05-22 07:54:20', '2025-07-05 11:52:41', 1),
(11, 1, 'T-Shirt OVERSIZE MINDSET - BLACK', 25, 132000.00, 'Category : T-shirt\r\nMaterial : COTTON 20S\r\nModel : Oversize fit / Model Height 175cm Weight 60KG using size XL', '1748177603_4954cb75cc71754540e3.webp', '2025-05-25 12:53:23', '2025-07-05 11:52:41', 2),
(13, 1, '308 ABSLTUNSCRD - T-Shirt 308 Logo - Black', 20, 34000.00, 'p', '1751612549_5a0d9ba1e418612c83e0.webp', '2025-07-04 07:02:29', '2025-07-04 07:02:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Regular T-Shirt', '2025-03-15 07:34:52', '2025-03-15 08:20:29'),
(2, 1, 'Oversize T-Shirt', '2025-03-15 07:42:46', '2025-03-15 08:21:01'),
(6, 1, 'Jersey', '2025-03-15 08:22:27', '2025-03-15 08:22:27'),
(14, 2, 'Short Shirt', '2025-03-15 08:31:21', '2025-03-15 08:31:21'),
(15, 2, 'Long Shirt', '2025-03-15 08:31:33', '2025-03-15 08:31:33'),
(16, 2, 'Flanel', '2025-03-15 08:31:38', '2025-03-15 08:31:38'),
(17, 3, 'Sling Bag', '2025-03-15 08:32:07', '2025-03-15 08:32:07'),
(18, 3, 'Tote Bag', '2025-03-15 08:32:20', '2025-03-15 08:32:20'),
(20, 3, 'Pouch Bag', '2025-03-15 08:32:50', '2025-03-15 08:32:50'),
(21, 5, 'Denim Pants', '2025-03-15 08:33:16', '2025-03-15 08:33:16'),
(23, 5, 'Short Pants', '2025-03-15 08:33:41', '2025-03-15 08:33:41'),
(25, 7, 'Zip Hoodie', '2025-03-24 06:42:49', '2025-03-24 06:43:00'),
(26, 7, 'Hoodie', '2025-03-24 06:43:09', '2025-03-24 06:43:09'),
(27, 7, 'Crewneck', '2025-03-24 06:43:17', '2025-03-24 06:43:17'),
(28, 1, 'Hoodie', '2025-05-01 09:17:52', '2025-05-01 09:17:52');

-- --------------------------------------------------------

--
-- Table structure for table `title`
--

CREATE TABLE `title` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `image2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `title`
--

INSERT INTO `title` (`id`, `title`, `image`, `created_at`, `updated_at`, `image2`) VALUES
(1, '308 ABSLT UNSCRD', '1747714645_02bad58d45a9b332dc92.png', NULL, '2025-05-25 13:13:55', '1741245160_751a82a279de3da380d1.png');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `transaction_code` varchar(100) DEFAULT NULL,
  `recipient_name` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `payment_proof` varchar(255) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `status` enum('pending','paid','cancelled') DEFAULT 'pending',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `transaction_code`, `recipient_name`, `address`, `contact`, `payment_proof`, `total_price`, `status`, `created_at`, `updated_at`) VALUES
(11, 3, 'TXN1747379209', 'Avila Difa Adhiguna', 'asd', '+6289679583095', '1747379209_86b99d3b1e025949623f.webp', 164000.00, 'pending', '2025-05-16 07:06:49', '2025-05-16 07:06:49'),
(12, 3, 'TXN1747399007', 'Avila Difa Adhiguna', 'asdaasd', '+6289679583095', '1747399007_8160fb9c9213b15d70a2.png', 164000.00, 'pending', '2025-05-16 12:36:47', '2025-05-16 12:36:47'),
(13, 3, 'TXN1747399536', 'Avila Difa Adhiguna', 'asd', '+6289679583095', '1747399536_25d85e19cd02e67261c2.webp', 296000.00, 'paid', '2025-05-16 12:45:36', '2025-05-20 07:28:29'),
(14, 3, 'TXN1748006714', 'Avila Difa Adhiguna', 'Yogya', '089679583095', '1748006714_16da90d9bc0353c653cb.png', 246000.00, 'cancelled', '2025-05-23 13:25:14', '2025-07-04 04:42:51'),
(15, 5, 'TXN1748007863', 'Adhiguna', 'Yogya', '089679583095', '1748007863_9d206e473bb8566655c5.png', 1424000.00, 'pending', '2025-05-23 13:44:23', '2025-07-04 04:42:26'),
(16, 3, 'TXN1748316491', 'Alfie', 'Yogya', '08746438772', '1748316491_b2bf391e24db1eb70e18.webp', 396000.00, 'pending', '2025-05-27 03:28:11', '2025-07-04 04:42:19'),
(17, 3, 'TXN1751081340', 'Avila Difa Adhiguna', 'sdas', 'dasda', '1751081340_23483cc896c1c8cff5ec.jpg', 214000.00, 'paid', '2025-06-28 03:29:00', '2025-07-05 11:52:41'),
(18, 3, 'TXN1751612408', 'Avila Difa Adhiguna', 'yogya', '089679583095', '1751612408_281f8ea44c185aef9644.png', 132000.00, 'pending', '2025-07-04 07:00:08', '2025-07-04 07:00:08'),
(19, 3, 'TXN1753274539', 'Avila Difa Adhiguna', 'Yogyakarta', '08973645323', '1753274539_738877b428d14c3332f8.png', 528000.00, 'pending', '2025-07-23 12:42:19', '2025-07-23 12:42:19'),
(20, 7, 'TXN1753274927', 'Fadi', 'Tangerang Selatan', '084329234932', '1753274927_8bf8cf1db6fa151b958e.png', 829997.00, 'paid', '2025-07-23 12:48:47', '2025-07-23 12:58:58');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_items`
--

CREATE TABLE `transaction_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `transaction_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_items`
--

INSERT INTO `transaction_items` (`id`, `transaction_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(8, 11, 2, 2, 82000.00, '2025-05-16', '2025-05-16'),
(9, 12, 2, 2, 82000.00, '2025-05-16', '2025-05-16'),
(10, 13, 2, 2, 82000.00, '2025-05-16', '2025-05-16'),
(11, 13, 5, 1, 132000.00, '2025-05-16', '2025-05-16'),
(12, 14, 10, 3, 82000.00, '2025-05-23', '2025-05-23'),
(13, 15, 9, 4, 137000.00, '2025-05-23', '2025-05-23'),
(14, 15, 7, 3, 292000.00, '2025-05-23', '2025-05-23'),
(15, 16, 11, 3, 132000.00, '2025-05-27', '2025-05-27'),
(16, 17, 11, 1, 132000.00, '2025-06-28', '2025-06-28'),
(17, 17, 10, 1, 82000.00, '2025-06-28', '2025-06-28'),
(18, 18, 11, 1, 132000.00, '2025-07-04', '2025-07-04'),
(19, 19, 11, 4, 132000.00, '2025-07-23', '2025-07-23'),
(20, 20, 8, 3, 81999.00, '2025-07-23', '2025-07-23'),
(21, 20, 7, 2, 292000.00, '2025-07-23', '2025-07-23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` enum('admin','customer') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$Mxx0xgZWSvEFZytB.JKcCObfv02vAnP5ynU8Qq9unRAMDXgfpr7wW', NULL, 'admin', '2025-05-16 12:51:30', '2025-05-19 13:07:58'),
(2, 'avila', '12345678', NULL, 'customer', NULL, NULL),
(3, 'vil', '$2y$10$hMCU6ajH1S5mmcWGYqakBOWoAhXn5SQ0AYb9oAlclZFYrS.ZgdZ26', 'aviladifa@gmail.com', 'customer', '2025-05-14 07:42:31', '2025-05-21 07:43:10'),
(5, 'vilaif', '$2y$10$wSXYqK1eSI/fP0hj4xUxYuH40mUE1d8YnwqlPbfHZIr.3A5yej3S.', 'aviladifa@students.amikom.ac.id', 'customer', '2025-05-21 12:19:52', '2025-05-21 12:19:52'),
(6, 'Anton', '$2y$10$F.4ghvI79K4hj2.ocdlaTOc91elRkRGyrlL4SmC4yLFadypWYTdJ.', 'anton@gmail.com', 'customer', '2025-07-04 04:13:24', '2025-07-04 04:13:24'),
(7, 'fadi', '$2y$10$wPkOcgoMjOAc7l5kg9L8eulkiEg30qviO0cLmDwd6V8gow79uaSny', 'fadi12@yahoo.co.id', 'customer', '2025-07-23 12:44:47', '2025-07-23 12:44:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category` (`category_id`),
  ADD KEY `fk_sub_categories` (`sub_category_id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `title`
--
ALTER TABLE `title`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `title`
--
ALTER TABLE `title`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `transaction_items`
--
ALTER TABLE `transaction_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sub_categories` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`);

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD CONSTRAINT `transaction_items_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
