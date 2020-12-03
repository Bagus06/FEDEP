-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 04, 2020 at 06:14 AM
-- Server version: 5.7.31-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fedep`
--

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `judul` text NOT NULL,
  `kontent` longtext NOT NULL,
  `files` longtext,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `berita_cat`
--

CREATE TABLE `berita_cat` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `berita_cat`
--

INSERT INTO `berita_cat` (`id`, `title`, `deskripsi`, `created`, `updated`) VALUES
(2, 'Covit 19', 'Covot 19 adalah virus yang mrmatikan. ', '2020-07-11 18:11:14', '2020-07-11 18:11:14');

-- --------------------------------------------------------

--
-- Table structure for table `cluster_pesan`
--

CREATE TABLE `cluster_pesan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pesan` text NOT NULL,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_produk`
--

CREATE TABLE `detail_produk` (
  `id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `fungsi` text,
  `tanggung_jawab` text,
  `volume` text,
  `harga` int(11) DEFAULT NULL,
  `hasil_diskusi` text,
  `sumber_dana` varchar(255) DEFAULT NULL,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `folder`
--

CREATE TABLE `folder` (
  `id` int(11) NOT NULL,
  `protect` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = protect, 2 = not protect',
  `title` varchar(255) NOT NULL,
  `deskripsi` text,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `folder`
--

INSERT INTO `folder` (`id`, `protect`, `title`, `deskripsi`, `created`, `updated`) VALUES
(1, 1, 'web_corousel', 'for-corousel', '2020-06-17 02:24:15', '2020-06-29 15:10:23'),
(2, 1, 'web_galery', 'for-galery', '2020-06-24 20:54:44', '2020-06-30 15:49:37');

-- --------------------------------------------------------

--
-- Table structure for table `galery`
--

CREATE TABLE `galery` (
  `id` int(11) NOT NULL,
  `folder_id` int(11) NOT NULL,
  `img` text NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1 = produk didiskusikan, 2 = produk diterima, 3 = produk ditolak',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `profil_cluster`
--

CREATE TABLE `profil_cluster` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL,
  `tujuan` text NOT NULL,
  `sk` varchar(255) DEFAULT NULL,
  `anggaran` int(11) NOT NULL,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `type_jawaban` tinyint(1) NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL,
  `ceklist` varchar(255) DEFAULT NULL,
  `sub_question` tinyint(1) NOT NULL DEFAULT '0',
  `question_title_sub` varchar(255) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `score`, `number`, `type_jawaban`, `title`, `ceklist`, `sub_question`, `question_title_sub`, `created`, `updated`) VALUES
(1, 10, 1, 1, 'Nama usaha?', '', 0, '', '2020-06-30 07:04:33', '2020-06-30 07:04:33'),
(2, 10, 2, 1, 'Berdiri tahun?', '', 0, '', '2020-06-30 07:04:54', '2020-06-30 07:04:54'),
(3, 10, 3, 1, 'Nama pemilik?', '', 0, '', '2020-06-30 07:05:20', '2020-06-30 07:06:34'),
(4, 10, 4, 1, 'No Tlp/Wa?', '', 0, '', '2020-06-30 07:07:54', '2020-06-30 07:07:54'),
(5, 10, 5, 1, 'Email?', '', 0, '', '2020-06-30 07:08:10', '2020-06-30 07:08:10'),
(6, 10, 6, 3, 'Perjanjian/Sertifikat yang dimiliki?', '', 0, '', '2020-06-30 07:08:46', '2020-06-30 07:08:46'),
(7, 10, 8, 1, 'Jumlah tenaga kerja laki-laki?', '', 0, '', '2020-06-30 07:09:33', '2020-06-30 07:09:33'),
(8, 10, 9, 1, 'Jumlah tenaga kerja perempuan?', '', 0, '', '2020-06-30 07:10:09', '2020-06-30 07:10:09'),
(9, 10, 10, 2, 'Lokasi pemasaran?', 'Kabupaten_Pati,Provinsi_Jateng,Nasional', 0, '', '2020-06-30 07:11:33', '2020-06-30 07:11:33'),
(10, 10, 11, 1, 'Bantuan alat yang pernah diterima?', '', 0, '', '2020-06-30 07:12:17', '2020-06-30 07:12:17'),
(11, 10, 12, 1, 'Pelatihan yang pernah di ikuti?', '', 0, '', '2020-06-30 07:12:46', '2020-06-30 07:12:46'),
(12, 10, 13, 1, 'Pinjaman/Hibah dana yang pernah diterima?', '', 0, '', '2020-06-30 07:14:15', '2020-06-30 07:14:15'),
(13, 10, 14, 1, 'Nama BDS yang mendampingi?', '', 0, '', '2020-06-30 07:14:42', '2020-06-30 07:14:42'),
(14, 10, 15, 1, 'No Tlp/Wa BDS yang mendampingi?', '', 0, '', '2020-06-30 07:15:46', '2020-06-30 07:15:46'),
(16, 10, 16, 1, 'Kendala yang dihadapi :', '', 1, 'Tenaga kerja?', '2020-06-30 07:17:30', '2020-06-30 07:37:17'),
(17, 10, 17, 1, 'Kendala yang dihadapi:', '', 1, 'Bahan baku?', '2020-06-30 07:33:27', '2020-06-30 07:33:27'),
(18, 10, 18, 1, 'Kendala yang dihadapi:', '', 1, 'Proses produksi?', '2020-06-30 07:33:52', '2020-06-30 08:03:24'),
(19, 10, 19, 1, 'Kendala yang dihadapi:', '', 1, 'Pengemasan?', '2020-06-30 07:34:20', '2020-06-30 08:11:07'),
(20, 10, 20, 1, 'Kendala yang dihadapi?', '', 1, 'Pemasaran?', '2020-06-30 08:12:21', '2020-06-30 08:12:21'),
(21, 10, 21, 1, 'Kendala yang dihadapi:', '', 1, 'Perijinan/sertifikat?', '2020-06-30 08:16:19', '2020-06-30 08:16:19'),
(22, 10, 22, 1, 'Solusi yang diharapkan :', '', 1, 'Tenaga kerja?', '2020-06-30 08:17:16', '2020-06-30 08:17:16'),
(23, 10, 23, 1, 'Solusi yang diharapkan :', '', 1, 'Bahan baku?', '2020-06-30 08:17:42', '2020-06-30 08:17:42'),
(24, 10, 24, 1, 'Solusi yang diharapkan :', '', 1, 'Proses produksi?', '2020-06-30 08:22:33', '2020-06-30 08:22:33'),
(25, 10, 25, 1, 'Solusi yang diharapkan :', '', 1, 'Pengemasan?', '2020-06-30 08:23:19', '2020-06-30 08:23:49'),
(26, 10, 26, 1, 'Solusi yang diharapkan :', '', 1, 'Pemasaran?', '2020-06-30 08:24:23', '2020-06-30 08:24:23'),
(27, 10, 27, 1, 'Solusi yang diharapkan :', '', 1, 'Perijinan/sertifikat?', '2020-06-30 08:25:06', '2020-06-30 08:25:06');

-- --------------------------------------------------------

--
-- Table structure for table `question_sub`
--

CREATE TABLE `question_sub` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `question_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE `responses` (
  `id` int(11) NOT NULL,
  `responden_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `isian` longtext,
  `ceklist` varchar(255) DEFAULT NULL,
  `ket` longtext,
  `img` varchar(255) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `responses`
--

INSERT INTO `responses` (`id`, `responden_id`, `question_id`, `isian`, `ceklist`, `ket`, `img`, `created`, `updated`) VALUES
(1, 12, 1, 'pop', '', '', '', '2020-12-03 22:32:23', '2020-12-04 05:32:23'),
(2, 12, 2, 'pnpn', '', '', '', '2020-12-03 22:32:23', '2020-12-04 05:32:23'),
(3, 12, 3, '', '', '', '', '2020-12-03 22:32:23', '2020-12-04 05:32:23'),
(4, 12, 4, '', '', '', '', '2020-12-03 22:32:23', '2020-12-04 05:32:23'),
(5, 12, 5, '', '', '', '', '2020-12-03 22:32:23', '2020-12-04 05:32:23'),
(6, 12, 6, '', '', '', '1607034743Screenshot_from_2020-08-13_11-04-14.png', '2020-12-03 22:32:23', '2020-12-04 05:32:23'),
(7, 12, 7, '', '', '', '', '2020-12-03 22:32:23', '2020-12-04 05:32:23'),
(8, 12, 8, '', '', '', '', '2020-12-03 22:32:23', '2020-12-04 05:32:23'),
(9, 12, 9, '', '', '', '', '2020-12-03 22:32:23', '2020-12-04 05:32:23'),
(10, 12, 10, '', '', '', '', '2020-12-03 22:32:23', '2020-12-04 05:32:23'),
(11, 12, 11, '', '', '', '', '2020-12-03 22:32:23', '2020-12-04 05:32:23'),
(12, 12, 12, '', '', '', '', '2020-12-03 22:32:23', '2020-12-04 05:32:23'),
(13, 12, 13, '', '', '', '', '2020-12-03 22:32:23', '2020-12-04 05:32:23'),
(14, 12, 14, '', '', '', '', '2020-12-03 22:32:23', '2020-12-04 05:32:23'),
(15, 12, 16, '', '', '', '', '2020-12-03 22:32:23', '2020-12-04 05:32:23'),
(16, 12, 17, '', '', '', '', '2020-12-03 22:32:23', '2020-12-04 05:32:23'),
(17, 12, 18, '', '', '', '', '2020-12-03 22:32:23', '2020-12-04 05:32:23'),
(18, 12, 19, '', '', '', '', '2020-12-03 22:32:23', '2020-12-04 05:32:23'),
(19, 12, 20, '', '', '', '', '2020-12-03 22:32:23', '2020-12-04 05:32:23'),
(20, 12, 21, '', '', '', '', '2020-12-03 22:32:23', '2020-12-04 05:32:23'),
(21, 12, 22, '', '', '', '', '2020-12-03 22:32:23', '2020-12-04 05:32:23'),
(22, 12, 23, '', '', '', '', '2020-12-03 22:32:23', '2020-12-04 05:32:23'),
(23, 12, 24, '', '', '', '', '2020-12-03 22:32:23', '2020-12-04 05:32:23'),
(24, 12, 25, '', '', '', '', '2020-12-03 22:32:23', '2020-12-04 05:32:23'),
(25, 12, 26, '', '', '', '', '2020-12-03 22:32:23', '2020-12-04 05:32:23'),
(26, 12, 27, '', '', '', '', '2020-12-03 22:32:23', '2020-12-04 05:32:23');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `is_active`, `created`, `updated`) VALUES
(4, 'cek_pimpinan', '$2y$10$5cccyxIBQdlKV3ryAtH7OuLSRXouAQF5qKmHev5P2mqDy4GNwSuD2', 'pimpinana@fedep.co', 1, '2020-06-25 15:31:07', '2020-06-27 22:46:24'),
(5, 'cek_operator', '$2y$10$BKaUAq4dSvN.asgVaY.fMuo1vVbR1Yx9cQjlasRWnkVGbM8XNx2Fi', 'operator@fedep.co', 1, '2020-06-25 15:31:50', '2020-06-27 22:46:28'),
(9, 'root', '$2y$10$MaeBDW4FFonbjn.gskjh1.6oRPvLhBf0VkZ96GsPcQ17g.abgSHzu', 'root@gmail.com', 1, '2020-06-29 10:24:12', '2020-12-04 05:19:04'),
(12, 'cluster_klapakopyor', '$2y$10$oaFrsX6GNctkyHwboclCYeleFRbUmfoPEqQ56x2eYowjnWzf/HCoW', 'klapakopyor@gmail.com', 1, '2020-08-10 20:56:33', '2020-08-10 21:13:37'),
(13, 'cluster_pamelo', '$2y$10$eZ4ThMR9LBRKoF5.yMa1ueSxkm34JiIpcEfzTjkEMeWbooKYHVx2S', 'pamelo@gmail.com', 1, '2020-08-10 20:57:30', '2020-08-10 21:13:59'),
(14, 'cluster_makananringan', '$2y$10$vxWD2ymRkTxcKQ0YZcydh.8aOpskA.MyQ8ti0ksjON7X5aPIR3hda', 'makananringan@gmail.com', 1, '2020-08-10 20:58:55', '2020-08-10 21:14:06'),
(15, 'cluster_batik', '$2y$10$gdrHrV7AzAJjmIuX.9YmOeQc9Nh5cDBPZMD1OIFWu2AsaNGJp/N5K', 'batik@gmail.com', 1, '2020-08-10 20:59:52', '2020-08-10 21:14:14'),
(16, 'cluster_kopi', '$2y$10$oGocYbGeFQru5UTj9S21hu82c1giIcXlI9/ek9D1pgdElQV44cLlW', 'kopi@gmail.com', 1, '2020-08-10 21:02:12', '2020-08-10 21:14:20'),
(17, 'cluster_kerajinan', '$2y$10$HTVGjH.TNCl69cgAhGySKe/fE/pukKCPSg.rfIew3w0mFm2YOfyOu', 'kerajinan@gmail.com', 1, '2020-08-10 21:03:13', '2020-08-10 21:14:33'),
(18, 'cluster_pariwisata', '$2y$10$EZDr5S9qK1o//y1nQXn1R.A/b0Y0Wa.tSy.sPE19iLvCamXjPIEnC', 'pariwisata@gmail.com', 1, '2020-08-10 21:05:02', '2020-08-10 21:15:12');

-- --------------------------------------------------------

--
-- Table structure for table `user_has_role`
--

CREATE TABLE `user_has_role` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_has_role`
--

INSERT INTO `user_has_role` (`id`, `user_id`, `user_role_id`) VALUES
(47, 4, 3),
(48, 5, 2),
(55, 9, 1),
(58, 12, 4),
(59, 13, 4),
(60, 14, 4),
(61, 15, 4),
(62, 16, 4),
(63, 17, 4),
(64, 18, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `no_tlp` varchar(225) NOT NULL,
  `alamat` text NOT NULL,
  `nama_usaha` varchar(255) DEFAULT NULL,
  `gender` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `user_id`, `nama`, `img`, `no_tlp`, `alamat`, `nama_usaha`, `gender`) VALUES
(5, 4, 'Pimpinan', 'admin.jpg', '0', '-', NULL, 1),
(6, 5, 'Operator', 'admin.jpg', '0', '-', NULL, 1),
(10, 9, 'ROOT', 'ROOT.jpeg', '0', '-', '-', 1),
(13, 12, 'cluster klapakopyor', 'admin.jpg', '08', '-', NULL, 1),
(14, 13, 'cluster pamelo', 'admin.jpg', '08', '-', 'pamelo', 1),
(15, 14, 'cluster makananringan', 'admin.jpg', '08', '-', 'makanan ringan', 1),
(16, 15, 'cluster batik', 'admin.jpg', '08', '-', 'batik', 1),
(17, 16, 'cluster kopi', 'cluster kopi.jpeg', '08', '-', NULL, 1),
(18, 17, 'cluster kerajinan', 'admin.jpg', '08', '-', 'cluster kerajinan', 1),
(19, 18, 'cluster pariwisata', 'admin.jpg', '08', '-', 'cluster pariwisata', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `level` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `title`, `description`, `level`, `created`, `updated`) VALUES
(1, 'admin', 'user untuk admin', 1, '2019-09-25 18:53:20', '2019-09-25 18:53:20'),
(2, 'operator', 'user untuk operator', 2, '2020-06-05 16:58:55', '2020-06-05 16:58:55'),
(3, 'pimpinan', 'user untuk pimpinan', 3, '2020-06-05 16:59:33', '2020-06-05 16:59:33'),
(4, 'cluster', 'user untuk cluster', 4, '2020-06-05 16:59:53', '2020-06-05 16:59:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `berita_cat`
--
ALTER TABLE `berita_cat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cluster_pesan`
--
ALTER TABLE `cluster_pesan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cluster_pesan_ibfk_1` (`user_id`);

--
-- Indexes for table `detail_produk`
--
ALTER TABLE `detail_produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produk_id` (`produk_id`);

--
-- Indexes for table `folder`
--
ALTER TABLE `folder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galery`
--
ALTER TABLE `galery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galery_ibfk_1` (`folder_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `profil_cluster`
--
ALTER TABLE `profil_cluster`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profil_cluster_ibfk_1` (`user_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_sub`
--
ALTER TABLE `question_sub`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_sub_ibfk_1` (`question_id`);

--
-- Indexes for table `responses`
--
ALTER TABLE `responses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `responses_ibfk_1` (`responden_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_has_role`
--
ALTER TABLE `user_has_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_role_id` (`user_role_id`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `berita_cat`
--
ALTER TABLE `berita_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cluster_pesan`
--
ALTER TABLE `cluster_pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `detail_produk`
--
ALTER TABLE `detail_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `folder`
--
ALTER TABLE `folder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `galery`
--
ALTER TABLE `galery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `profil_cluster`
--
ALTER TABLE `profil_cluster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `question_sub`
--
ALTER TABLE `question_sub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `responses`
--
ALTER TABLE `responses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `user_has_role`
--
ALTER TABLE `user_has_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `berita`
--
ALTER TABLE `berita`
  ADD CONSTRAINT `berita_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `berita_cat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cluster_pesan`
--
ALTER TABLE `cluster_pesan`
  ADD CONSTRAINT `cluster_pesan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_produk`
--
ALTER TABLE `detail_produk`
  ADD CONSTRAINT `detail_produk_ibfk_1` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `galery`
--
ALTER TABLE `galery`
  ADD CONSTRAINT `galery_ibfk_1` FOREIGN KEY (`folder_id`) REFERENCES `folder` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profil_cluster`
--
ALTER TABLE `profil_cluster`
  ADD CONSTRAINT `profil_cluster_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `question_sub`
--
ALTER TABLE `question_sub`
  ADD CONSTRAINT `question_sub_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `responses`
--
ALTER TABLE `responses`
  ADD CONSTRAINT `responses_ibfk_1` FOREIGN KEY (`responden_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `responses_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_has_role`
--
ALTER TABLE `user_has_role`
  ADD CONSTRAINT `user_has_role_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_has_role_ibfk_2` FOREIGN KEY (`user_role_id`) REFERENCES `user_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD CONSTRAINT `user_profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
