-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jul 2020 pada 16.15
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sppd_2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgllahir` date DEFAULT NULL,
  `golongan` enum('Juru Muda (I/a)','Juru Muda Tingkat I (I/b)','Juru (I/c)','Juru Tingkat I (I/d)','Pengatur Muda (II/a)','Pengatur Muda Tingkat I (II/b)','Pengatur (II/c)','Pengatur Tingkat I (II/d)','Penata Muda (III/a)','Penata Muda Tingkat I (III/b)','Penata (III/c)','Penata Tingkat I (III/d)','Pembina (IV/a)','Pembina Tingkat I (IV/b)','Pembina Utama Muda (IV/c)','Pembina Utama Madya (IV/d)','Pembina Utama (IV/e)') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `role` enum('Admin','Kepala Bidang','Pegawai','') COLLATE utf8mb4_unicode_ci NOT NULL,
  `cek` tinyint(5) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `nip`, `alamat`, `password`, `tgllahir`, `golongan`, `jabatan`, `created_at`, `updated_at`, `role`, `cek`) VALUES
(22, 'Admin', '1000000000', NULL, '$2y$10$u7jViXgX48NWMPdnbzCHjOP9Sd5FZRPqo/NpY.auEOxaEqAyrfH.i', NULL, NULL, NULL, '2020-07-04 05:49:41', '2020-07-04 05:49:41', 'Admin', 0),
(23, 'Pegawai', '2000000000', NULL, '$2y$10$mLxBD3UzGldxPNuPvqrs6OnhgY1.pvxL0wSXTu2.84QlJFp4ltTue', NULL, NULL, NULL, '2020-07-04 05:50:31', '2020-07-04 05:50:31', 'Pegawai', 0),
(24, 'Kepala Bidang', '3000000000', NULL, '$2y$10$vCsjVkA2Vxm6WtGl6V8NNeiqYv0q1UIWZGNCYwioYY.N8CDK48zK2', NULL, NULL, NULL, '2020-07-04 05:51:00', '2020-07-04 05:51:00', 'Kepala Bidang', 0),
(25, 'Test, ST', '1111111111111111111111', 'sadasdas', '$2y$10$prJPhqBSqKiiv5Xsb0ztdeyR2WCRGFWS8B3gxBoH1f6PUc/w11j0i', '2000-02-12', 'Pembina (IV/a)', '2', '2020-07-04 06:08:07', '2020-07-04 06:08:07', 'Pegawai', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nip` (`nip`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
