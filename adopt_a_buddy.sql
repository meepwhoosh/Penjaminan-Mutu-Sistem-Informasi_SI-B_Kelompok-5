-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Nov 2025 pada 11.55
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
-- Database: `adopt_ a_buddy`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `adopsi`
--

CREATE TABLE `adopsi` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `hewan_id` int(11) DEFAULT NULL,
  `tanggal_adopsi` date DEFAULT NULL,
  `status` enum('pending','diterima','selesai','ditolak') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `adopsi`
--

INSERT INTO `adopsi` (`id`, `user_id`, `hewan_id`, `tanggal_adopsi`, `status`) VALUES
(1, 1, 1, '2025-01-05', 'pending'),
(2, 2, 2, '2025-01-06', 'diterima'),
(3, 3, 3, '2025-01-07', 'selesai'),
(4, 4, 4, '2025-01-08', 'ditolak'),
(5, 5, 5, '2025-01-09', 'pending');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hewan`
--

CREATE TABLE `hewan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `ras` varchar(50) DEFAULT NULL,
  `usia` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('tersedia','diadopsi') DEFAULT 'tersedia',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `hewan`
--

INSERT INTO `hewan` (`id`, `nama`, `jenis`, `ras`, `usia`, `foto`, `status`, `created_at`, `updated_at`) VALUES
(1, 'milo', 'kucing', 'persia', 4, 'milo.jpeg', 'tersedia', '2025-11-06 10:40:37', '2025-11-06 10:40:37'),
(2, 'bobby', 'anjing', 'golden retriever', 4, 'bobby.jpeg', 'tersedia', '2025-11-06 10:42:06', '2025-11-06 10:42:06'),
(3, 'luna', 'kucing', 'anggora', 3, 'luna.jpeg', 'tersedia', '2025-11-06 10:43:15', '2025-11-06 10:43:15'),
(4, 'rocky', 'anjing', 'bulldog', 2, 'rocky.jpeg', 'tersedia', '2025-11-06 10:43:45', '2025-11-06 10:43:45'),
(5, 'rio', 'anjing', 'beagle', 2, 'rio.jpeg', 'tersedia', '2025-11-06 10:44:23', '2025-11-06 10:44:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kesehatan`
--

CREATE TABLE `kesehatan` (
  `id` int(11) NOT NULL,
  `hewan_id` int(11) DEFAULT NULL,
  `vaksin` varchar(100) DEFAULT NULL,
  `penyakit` varchar(100) DEFAULT NULL,
  `tanggal_cek` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kesehatan`
--

INSERT INTO `kesehatan` (`id`, `hewan_id`, `vaksin`, `penyakit`, `tanggal_cek`) VALUES
(1, 1, 'vaksing rabies', 'tidak ada', '2024-12-01'),
(2, 2, 'vaksin parvo', 'flu ringan', '2024-12-02'),
(3, 3, 'vaksin kombinasi', 'tidak ada', '2024-12-03'),
(4, 4, 'vaksin DHLPP', 'alergi ringan', '2024-12-04'),
(5, 5, 'tidak divaksin', 'infeksi ringan', '2024-12-05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_adopsi`
--

CREATE TABLE `laporan_adopsi` (
  `id` int(11) NOT NULL,
  `hewan_id` int(11) DEFAULT NULL,
  `adopter_id` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `catatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `laporan_adopsi`
--

INSERT INTO `laporan_adopsi` (`id`, `hewan_id`, `adopter_id`, `tanggal`, `catatan`) VALUES
(1, 1, 1, '2025-01-10', 'hewan diterima dalam kondisi baik'),
(2, 2, 2, '2025-01-11', 'sudah divaksin dan sehat'),
(3, 3, 3, '2025-01-12', 'perlu pengecekan kesehatan lanjutan'),
(4, 4, 4, '2025-01-13', 'adaptasi berjalan baik'),
(5, 5, 5, '2025-01-14', 'tidak ada keluhan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`) VALUES
(1, 'annisa', 'annisa@gmail.com', 'annisa12345', 'user'),
(2, 'dian', 'dian@gmail.com', 'dian12345', 'user'),
(3, 'sofia', 'sofia@gmail.com', 'sofia12345', 'user'),
(4, 'dede', 'dede@gmail.com', 'dede12345', 'user'),
(5, 'aura', 'aura@gmail.com', 'aura12345\r\n', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `adopsi`
--
ALTER TABLE `adopsi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `hewan_id` (`hewan_id`);

--
-- Indeks untuk tabel `hewan`
--
ALTER TABLE `hewan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kesehatan`
--
ALTER TABLE `kesehatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hewan_id` (`hewan_id`);

--
-- Indeks untuk tabel `laporan_adopsi`
--
ALTER TABLE `laporan_adopsi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hewan_id` (`hewan_id`),
  ADD KEY `adopter_id` (`adopter_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `adopsi`
--
ALTER TABLE `adopsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `hewan`
--
ALTER TABLE `hewan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kesehatan`
--
ALTER TABLE `kesehatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `laporan_adopsi`
--
ALTER TABLE `laporan_adopsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `adopsi`
--
ALTER TABLE `adopsi`
  ADD CONSTRAINT `adopsi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `adopsi_ibfk_2` FOREIGN KEY (`hewan_id`) REFERENCES `hewan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kesehatan`
--
ALTER TABLE `kesehatan`
  ADD CONSTRAINT `kesehatan_ibfk_1` FOREIGN KEY (`hewan_id`) REFERENCES `hewan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `laporan_adopsi`
--
ALTER TABLE `laporan_adopsi`
  ADD CONSTRAINT `laporan_adopsi_ibfk_1` FOREIGN KEY (`hewan_id`) REFERENCES `hewan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `laporan_adopsi_ibfk_2` FOREIGN KEY (`adopter_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
