-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Jan 2024 pada 05.16
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_check`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `checklist`
--

CREATE TABLE `checklist` (
  `id_checklist` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `toilet_id` int(11) NOT NULL,
  `kloset` tinyint(1) DEFAULT NULL,
  `wastafel` tinyint(1) DEFAULT NULL,
  `lantai` tinyint(1) DEFAULT NULL,
  `dinding` tinyint(1) DEFAULT NULL,
  `kaca` tinyint(1) DEFAULT NULL,
  `bau` tinyint(1) DEFAULT NULL,
  `sabun` tinyint(1) DEFAULT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `checklist`
--

INSERT INTO `checklist` (`id_checklist`, `tanggal`, `toilet_id`, `kloset`, `wastafel`, `lantai`, `dinding`, `kaca`, `bau`, `sabun`, `users_id`) VALUES
(1, '2024-01-02 03:07:32', 4, 1, 1, 1, 1, 1, 1, 1, 4),
(3, '2024-01-02 03:21:06', 1, 2, 1, 3, 1, 3, 1, 3, 7),
(4, '2024-01-02 04:15:41', 1, 1, 2, 1, 1, 3, 1, 1, 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `toilet`
--

CREATE TABLE `toilet` (
  `id_toilet` int(11) NOT NULL,
  `lokasi` varchar(45) DEFAULT NULL,
  `keterangan` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `toilet`
--

INSERT INTO `toilet` (`id_toilet`, `lokasi`, `keterangan`) VALUES
(1, 'lt 1', 'Gedung B'),
(4, 'lt 2', 'Gedung B');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `role` tinyint(1) DEFAULT 2 COMMENT '1:Admin\n2:User'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_users`, `username`, `password`, `nama`, `email`, `status`, `role`) VALUES
(4, 'rani', '$2y$10$R1J.jup34Qk54lwUZQfi3.ezwFrJGZz/2uP3GmTOW45JkEvEcWbZW', 'Aliyah Asmarani', 'rani@gmail.com', 1, 1),
(7, 'pia', '$2y$10$uPcEYb2I4FP.RQ15Y4zHZeodyWPw30WWu4wzK4qYY0ekfoKFF0F02', 'Alifia Ananda Putri', 'fia@gmail.com', 1, 1),
(8, 'veny', '$2y$10$x0WIGLQhx/7OSVCWIgsIZudaQMNLsW2dmYorgmkAuWduGWwHDRUlG', 'Veronika Natalia Kala', 'veny@gmail.com', 1, 1),
(10, 'user1', '$2y$10$leUXnehq5B7KxVMT34tslepJLeqeOeV7aLg9D6..J6ihXnaCCI1/e', 'Adly Nurfauzan', 'adly@gmail.com', 1, 2),
(11, 'user2', '$2y$10$pCNlLEkUgaBcTepO31xES.xa9/xeLaAcPZXHpqnuGq4JmXA3SkBzq', 'Jaemin', 'jaemin@gmail.com', 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `checklist`
--
ALTER TABLE `checklist`
  ADD PRIMARY KEY (`id_checklist`),
  ADD KEY `fk_checklist_toilet_idx` (`toilet_id`),
  ADD KEY `fk_checklist_users1_idx` (`users_id`);

--
-- Indeks untuk tabel `toilet`
--
ALTER TABLE `toilet`
  ADD PRIMARY KEY (`id_toilet`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `checklist`
--
ALTER TABLE `checklist`
  MODIFY `id_checklist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `toilet`
--
ALTER TABLE `toilet`
  MODIFY `id_toilet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `checklist`
--
ALTER TABLE `checklist`
  ADD CONSTRAINT `fk_checklist_toilet` FOREIGN KEY (`toilet_id`) REFERENCES `toilet` (`id_toilet`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_checklist_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id_users`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
