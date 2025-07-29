-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Mar 2025 pada 08.26
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

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
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'T-shirt', '2025-03-02 07:06:54', '2025-03-15 07:22:01'),
(2, 'Shirt', '2025-03-02 07:07:26', '2025-03-02 07:07:26'),
(3, 'Bag', '2025-03-02 07:07:34', '2025-03-02 07:07:34'),
(4, 'Accessories', '2025-03-02 07:07:41', '2025-03-02 07:07:41'),
(5, 'Pants', '2025-03-02 07:07:48', '2025-03-02 07:07:48'),
(6, 'Jacket', '2025-03-08 09:23:55', '2025-03-08 09:23:55'),
(7, 'Sweater', '2025-03-08 09:24:08', '2025-03-08 09:24:08'),
(8, 'Hat', '2025-03-08 09:24:21', '2025-03-08 09:24:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
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
-- Dumping data untuk tabel `migrations`
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
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id` int(11) UNSIGNED NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `sub_category_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sub_categories`
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
(19, 3, 'Travel Bag', '2025-03-15 08:32:31', '2025-03-15 08:32:31'),
(20, 3, 'Pouch Bag', '2025-03-15 08:32:50', '2025-03-15 08:32:50'),
(21, 5, 'Denim Pants', '2025-03-15 08:33:16', '2025-03-15 08:33:16'),
(22, 5, 'Chinos Pants', '2025-03-15 08:33:29', '2025-03-15 08:33:29'),
(23, 5, 'Short Pants', '2025-03-15 08:33:41', '2025-03-15 08:33:41'),
(24, 5, 'Cargo Pants', '2025-03-15 08:34:01', '2025-03-15 08:34:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `title`
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
-- Dumping data untuk tabel `title`
--

INSERT INTO `title` (`id`, `title`, `image`, `created_at`, `updated_at`, `image2`) VALUES
(1, '308 Absolute Unscared Store', '1741334481_53afe0b572212751303a.png', NULL, '2025-03-07 08:01:21', '1741245160_751a82a279de3da380d1.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_category_id_foreign` (`category_id`),
  ADD KEY `sub_category_id` (`sub_category_id`);

--
-- Indeks untuk tabel `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

--
-- Indeks untuk tabel `title`
--
ALTER TABLE `title`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `title`
--
ALTER TABLE `title`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`sub_category_id`) REFERENCES `categories` (`id`);

--
-- Ketidakleluasaan untuk tabel `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
