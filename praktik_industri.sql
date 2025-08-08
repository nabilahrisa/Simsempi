-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Des 2021 pada 09.16
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `praktik industri`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `file`
--

CREATE TABLE `file` (
  `id` int(11) NOT NULL,
  `surat` varchar(100) NOT NULL,
  `nilai` varchar(100) NOT NULL,
  `lembar` varchar(100) NOT NULL,
  `proposal` varchar(100) NOT NULL,
  `id_author` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `NIM` varchar(11) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Judul` varchar(100) NOT NULL,
  `dospem` varchar(1000) NOT NULL,
  `tahap` text NOT NULL,
  `id_author` int(100) NOT NULL,
  `is_approved` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `NIM`, `Nama`, `Judul`, `dospem`, `tahap`, `id_author`, `is_approved`) VALUES
(72, '18051204039', 'Yofi Lailatul Fatma', 'Pembuatan aplikasi', 'I Kadek Dwi Nuryana, S.T.,M.Kom.', 'Tahap 1', 47, 1),
(73, '18051204039', 'Yofi Lailatul Fatma', 'Pembuatan aplikasi', 'I Kadek Dwi Nuryana, S.T.,M.Kom.', 'Tahap 1', 47, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahap2`
--

CREATE TABLE `tahap2` (
  `id` int(11) NOT NULL,
  `jadwal` date NOT NULL,
  `pukul` time NOT NULL,
  `uji` varchar(100) NOT NULL,
  `tahapan` text NOT NULL,
  `laporan` varchar(100) NOT NULL,
  `id_author` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nim` varchar(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `level` enum('admin','mahasiswa','dosen','') NOT NULL,
  `program` varchar(100) NOT NULL,
  `prodi` varchar(100) NOT NULL,
  `angkatan` enum('2017','2018','2019','') NOT NULL,
  `perusahaan` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nim`, `nama`, `email`, `level`, `program`, `prodi`, `angkatan`, `perusahaan`, `password`) VALUES
(9, '18051214034', 'Muhammad Rois Syarifudin', 'roisyaris303@gmail.com', 'mahasiswa', 'praktik industri', 'Sistem Informasi', '2018', 'Jurusan Teknik Informatika', '$2y$10$b4I.T0Y9me7C044T0PG0m.On5NVPxewCakVzxSJ9XY2c86js3Qkau'),
(30, '123', 'Dosen', '', 'dosen', '', '', '2018', '', '$2y$10$mh4Coq9VxonFpMNMIF2mSOEKxbOew22WjzO/vfSSMuOgb2hgkk/WG'),
(31, '321', 'Admin', '', 'admin', '', '', '2018', '', '$2y$10$IsXnnDe6Lm85LfwqM73JZ.loFUtS7gDFOIu/9EbLbZzh97k2WS0/O'),
(32, '18051214076', 'Alfando Vifan', 'fando@gmail.com', 'mahasiswa', 'praktik industri', 'Sistem Informasi', '2018', 'Jurusan Teknik Informatika', '$2y$10$BQCBXUYknqJFlPXRx9HbwuLHlcrybnbk2jLIHiMb7iKK015g2igOi'),
(33, '18051214044', 'Aziz Mahardika', 'aziz@gmail.com', 'mahasiswa', 'praktik industri', 'Sistem Informasi', '2018', 'petrokimia', '$2y$10$6dbLRihnrmHzQ28fCqwsveuSE28PPOtDbBp0.DejaaRBHNlcueg3K'),
(34, '18051204002', 'Thowillul Baai Mutaqin', 'aqin@gmail.com', 'mahasiswa', 'Pejuang Muda', 'Sistem Informasi', '2017', 'Kementrian', '$2y$10$yrcjKiYl2u94RdjR5XWKtOoEc/fj6GVOdhia8Xg51ETeIj8sh1fM.'),
(35, '18051204005', 'Ravita Dinia Sofi', 'ravita@gmail.com', 'mahasiswa', 'praktik industri', 'Sistem Informasi', '2018', 'radnet', '$2y$10$UXqho9cJWb5jSlySxOsL3OMpBUVPtAhMsy3D4es6ie3Ss1UPYpiZm'),
(36, '18051204055', 'Rois', 'roisyaris303@gmail.com', 'mahasiswa', 'praktik industri', 'Pendidikan Teknologi Informasi', '2018', 'Jurusan Teknik Informatika', '$2y$10$MF2E2YD2g2iWDgFgRXw98.Ofu3336rDzQUgd2n79u0uKS5.MNBMnm'),
(37, '18051204034', 'Muhammad Rois Syarifudin', 'roisyaris303@gmail.com', 'mahasiswa', 'praktik industrial', 'Sistem Informasi', '2017', 'Jurusan Teknik Informatika', '$2y$10$YczBtPeIT00ALpa.irkL/eW1cee5Sy6riqdcjy/A.Y1Vk7dh.5bnm'),
(47, '18051204039', 'Yofi Lailatul Fatma', 'yofilailatul19@gmail.com', 'mahasiswa', 'Praktik Industri', 'S1 Teknik Informatika', '2018', 'PT EDII Surabaya', '$2y$10$hVCX08.JKzC5gg0QqCFjKOYngcruOgKMC8Smfho7NDv7D2xJC8qEm');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tahap2`
--
ALTER TABLE `tahap2`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `file`
--
ALTER TABLE `file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT untuk tabel `tahap2`
--
ALTER TABLE `tahap2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
