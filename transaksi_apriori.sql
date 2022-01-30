-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Jan 2022 pada 16.10
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `transaksi_apriori`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` varchar(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `nama`, `harga`, `created_at`, `updated_at`) VALUES
('ELK-040', 'Bor', 150000, '2022-01-28 03:03:04', '2022-01-30 09:57:28'),
('ELKA-002', 'AC', 3000000, '2022-01-28 02:58:04', '2022-01-30 09:56:09'),
('ELKA-030', 'Aki', 160000, '2022-01-28 02:58:04', '2022-01-30 09:58:45'),
('ELKAT-036', 'Antena TV', 80000, '2022-01-28 02:58:04', '2022-01-30 09:58:10'),
('ELKB-003', 'Blender', 150000, '2022-01-28 02:58:04', '2022-01-30 09:58:53'),
('ELKB-019', 'Lampu Bohlam 5watt', 25000, '2022-01-28 02:58:04', '2022-01-30 10:00:39'),
('ELKBA-013', 'Batre ABC', 15000, '2022-01-28 02:58:04', '2022-01-30 09:59:23'),
('ELKBA-014', 'Batre Alkaline', 15000, '2022-01-28 02:58:04', '2022-01-30 09:59:30'),
('ELKC-009', 'Colokan Kaki 3', 15000, '2022-01-28 02:58:04', '2022-01-30 09:59:46'),
('ELKC-010', 'Colokan 5 Lubang', 25000, '2022-01-28 02:58:04', '2022-01-30 09:59:41'),
('ELKC-015', 'CCTV', 300000, '2022-01-28 02:58:04', '2022-01-30 09:59:34'),
('ELKD-020', 'DVD Player', 50000, '2022-01-28 02:58:04', '2022-01-28 02:58:04'),
('ELKJ-029', 'Jam Dinding', 45000, '2022-01-28 02:58:04', '2022-01-30 09:59:54'),
('ELKK-004', 'Kulkas', 2500000, '2022-01-28 02:58:04', '2022-01-28 02:58:04'),
('ELKK-005', 'Kipas', 120000, '2022-01-28 02:58:04', '2022-01-28 02:58:04'),
('ELKK-031', 'Kabel Roll 4m', 75000, '2022-01-28 02:58:04', '2022-01-30 10:00:08'),
('ELKKL-008', 'Kabel listrik', 10000, '2022-01-28 02:58:04', '2022-01-28 02:58:04'),
('ELKKR-018', 'Kabel Roll 5m', 12000, '2022-01-28 02:58:04', '2022-01-30 10:00:28'),
('ELKL-006', 'Lampu Led', 40000, '2022-01-28 02:58:04', '2022-01-28 02:58:04'),
('ELKLP-022', 'Lampu Tidur', 20000, '2022-01-28 02:58:04', '2022-01-30 10:01:10'),
('ELKLP-023', 'Lampu Philips 14watt', 60000, '2022-01-28 02:58:04', '2022-01-30 10:00:49'),
('ELKLP-024', 'Lampu Philips 35 watt', 125000, '2022-01-28 02:58:04', '2022-01-30 10:01:02'),
('ELKM-035', 'Mikrofon', 150000, '2022-01-28 02:58:04', '2022-01-30 10:01:16'),
('ELKMC-007', 'Mesin Cuci', 3000000, '2022-01-28 02:58:04', '2022-01-28 02:58:04'),
('ELKO-016', 'Obeng Min', 20000, '2022-01-28 02:58:04', '2022-01-30 10:01:22'),
('ELKO-017', 'Obeng Plus', 20000, '2022-01-28 02:58:04', '2022-01-30 10:01:28'),
('ELKPA-038', 'Pompa Air', 350000, '2022-01-28 02:58:04', '2022-01-30 10:01:35'),
('ELKR-039', 'Resistor', 2000, '2022-01-28 02:58:04', '2022-01-28 02:58:04'),
('ELKRA-032', 'Remote AC', 40000, '2022-01-28 02:58:04', '2022-01-30 10:01:41'),
('ELKRT-012', 'Remote TV', 20000, '2022-01-28 02:58:04', '2022-01-30 10:01:46'),
('ELKS-034', 'Speaker', 50000, '2022-01-28 02:58:04', '2022-01-30 10:02:20'),
('ELKS-037', 'Sekring', 5000, '2022-01-28 02:58:04', '2022-01-30 10:02:07'),
('ELKSA-028', 'Selang AC', 75000, '2022-01-28 02:58:04', '2022-01-30 10:02:14'),
('ELKSL-021', 'Saklar Lampu', 15000, '2022-01-28 02:58:04', '2022-01-30 10:01:53'),
('ELKSS-033', 'Saklar Switch', 3000, '2022-01-28 02:58:04', '2022-01-30 10:02:02'),
('ELKT-025', 'Tang Jepit', 23000, '2022-01-28 02:58:04', '2022-01-30 10:02:32'),
('ELKT-026', 'Tang Kepiting', 35000, '2022-01-28 02:58:04', '2022-01-30 10:02:38'),
('ELKTB-027', 'Tangga Besi', 200000, '2022-01-28 02:58:04', '2022-01-30 10:02:45'),
('ELKTF-011', 'Tabung Freon AC', 50000, '2022-01-28 02:58:04', '2022-01-30 10:02:26'),
('ELKTV-001', 'Televisi', 2000000, '2022-01-28 02:58:04', '2022-01-28 02:58:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` varchar(10) NOT NULL,
  `periode` date NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `periode`, `total`, `created_at`, `updated_at`) VALUES
('INV0424', '2022-01-30', 2515000, '2022-01-30 11:28:50', '2022-01-30 11:28:50'),
('INV2870', '2022-01-30', 155000, '2022-01-30 11:28:18', '2022-01-30 11:28:18'),
('INV3467', '2022-01-30', 2125000, '2022-01-30 11:27:34', '2022-01-30 11:27:34'),
('INV4099', '2022-01-30', 150000, '2022-01-30 11:27:44', '2022-01-30 11:27:44'),
('INV4262', '2022-01-30', 85000, '2022-01-30 11:27:59', '2022-01-30 11:27:59'),
('INV5065', '2022-01-30', 2080000, '2022-01-30 11:27:11', '2022-01-30 11:27:11'),
('INV7446', '2022-01-30', 120000, '2022-01-30 11:28:30', '2022-01-30 11:28:30'),
('INV9841', '2022-01-30', 105000, '2022-01-30 11:28:40', '2022-01-30 11:28:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_produk`
--

CREATE TABLE `transaksi_produk` (
  `id` bigint(20) NOT NULL,
  `periode` date NOT NULL,
  `invoice` varchar(10) NOT NULL,
  `id_produk` varchar(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi_produk`
--

INSERT INTO `transaksi_produk` (`id`, `periode`, `invoice`, `id_produk`, `nama`, `harga`, `jumlah`, `total`, `created_at`, `updated_at`) VALUES
(114, '2022-01-30', 'INV5065', 'ELKTV-001', 'Televisi', 2000000, 1, 2000000, '2022-01-30 11:27:11', '2022-01-30 11:27:11'),
(115, '2022-01-30', 'INV5065', 'ELKAT-036', 'Antena TV', 80000, 1, 80000, '2022-01-30 11:27:11', '2022-01-30 11:27:11'),
(116, '2022-01-30', 'INV3467', 'ELKTV-001', 'Televisi', 2000000, 1, 2000000, '2022-01-30 11:27:34', '2022-01-30 11:27:34'),
(117, '2022-01-30', 'INV3467', 'ELKAT-036', 'Antena TV', 80000, 1, 80000, '2022-01-30 11:27:34', '2022-01-30 11:27:34'),
(118, '2022-01-30', 'INV3467', 'ELKBA-013', 'Batre ABC', 15000, 3, 45000, '2022-01-30 11:27:34', '2022-01-30 11:27:34'),
(119, '2022-01-30', 'INV4099', 'ELKBA-013', 'Batre ABC', 15000, 5, 75000, '2022-01-30 11:27:44', '2022-01-30 11:27:44'),
(120, '2022-01-30', 'INV4099', 'ELKBA-014', 'Batre Alkaline', 15000, 5, 75000, '2022-01-30 11:27:44', '2022-01-30 11:27:44'),
(121, '2022-01-30', 'INV4262', 'ELKB-019', 'Lampu Bohlam 5watt', 25000, 1, 25000, '2022-01-30 11:27:59', '2022-01-30 11:27:59'),
(122, '2022-01-30', 'INV4262', 'ELKBA-013', 'Batre ABC', 15000, 2, 30000, '2022-01-30 11:27:59', '2022-01-30 11:27:59'),
(123, '2022-01-30', 'INV4262', 'ELKBA-014', 'Batre Alkaline', 15000, 2, 30000, '2022-01-30 11:27:59', '2022-01-30 11:27:59'),
(124, '2022-01-30', 'INV2870', 'ELKB-019', 'Lampu Bohlam 5watt', 25000, 3, 75000, '2022-01-30 11:28:18', '2022-01-30 11:28:18'),
(125, '2022-01-30', 'INV2870', 'ELKC-009', 'Colokan Kaki 3', 15000, 2, 30000, '2022-01-30 11:28:18', '2022-01-30 11:28:18'),
(126, '2022-01-30', 'INV2870', 'ELKC-010', 'Colokan 5 Lubang', 25000, 2, 50000, '2022-01-30 11:28:18', '2022-01-30 11:28:18'),
(127, '2022-01-30', 'INV7446', 'ELKJ-029', 'Jam Dinding', 45000, 2, 90000, '2022-01-30 11:28:30', '2022-01-30 11:28:30'),
(128, '2022-01-30', 'INV7446', 'ELKBA-014', 'Batre Alkaline', 15000, 2, 30000, '2022-01-30 11:28:30', '2022-01-30 11:28:30'),
(129, '2022-01-30', 'INV9841', 'ELKJ-029', 'Jam Dinding', 45000, 1, 45000, '2022-01-30 11:28:40', '2022-01-30 11:28:40'),
(130, '2022-01-30', 'INV9841', 'ELKBA-013', 'Batre ABC', 15000, 2, 30000, '2022-01-30 11:28:40', '2022-01-30 11:28:40'),
(131, '2022-01-30', 'INV9841', 'ELKBA-014', 'Batre Alkaline', 15000, 2, 30000, '2022-01-30 11:28:40', '2022-01-30 11:28:40'),
(132, '2022-01-30', 'INV0424', 'ELKK-004', 'Kulkas', 2500000, 1, 2500000, '2022-01-30 11:28:50', '2022-01-30 11:28:50'),
(133, '2022-01-30', 'INV0424', 'ELKC-009', 'Colokan Kaki 3', 15000, 1, 15000, '2022-01-30 11:28:50', '2022-01-30 11:28:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', NULL, '$2y$10$f29B.udejauHtgT/l8LG2.ldDE9dmEaCZCLIuaKcEd7bUyVYMHfiG', NULL, '2022-01-28 02:36:11', '2022-01-28 02:36:11');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi_produk`
--
ALTER TABLE `transaksi_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `transaksi_produk`
--
ALTER TABLE `transaksi_produk`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
