-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2020 at 09:16 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_fusfus`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang_jualan`
--

CREATE TABLE `barang_jualan` (
  `kode_barang_jualan` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `nama_produk` varchar(128) NOT NULL,
  `stok` int(11) NOT NULL,
  `image` varchar(128) NOT NULL,
  `harga` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `product_like` int(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='data produk yang dijual rumah inspirasi';

--
-- Dumping data for table `barang_jualan`
--

INSERT INTO `barang_jualan` (`kode_barang_jualan`, `id_category`, `nama_produk`, `stok`, `image`, `harga`, `keterangan`, `product_like`, `date_created`) VALUES
(9, 1, 'Tempat Menyimpan Aqua Gelas', 11, 'tempataquagelas.jpg', 76000, 'Bisa Pesan Jika Stok Habis', 2, 1563118502),
(10, 1, 'Kerajinan Tas', 12, 'kerajinaantas.jpg', 50000, 'Bisa Pesan Jika Stok Habis', 3, 1563118115),
(11, 1, 'Tempat Tisu', 14, 'tempattisu.jpg', 30000, 'Bisa Pesan Jika Stok Habis', 1, 1563118170);

-- --------------------------------------------------------

--
-- Table structure for table `barang_sampah`
--

CREATE TABLE `barang_sampah` (
  `kode_barang_sampah` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `opsi_penukaran` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `saldo_tambah` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `date_updated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='data opsi penukaran sampah menjadi saldo';

--
-- Dumping data for table `barang_sampah`
--

INSERT INTO `barang_sampah` (`kode_barang_sampah`, `id_category`, `opsi_penukaran`, `image`, `saldo_tambah`, `keterangan`, `date_updated`) VALUES
(4, 7, '1 Kg Plastik = 50 Poin', 'garbage-bags-500x500.jpg', 50, 'Anda Mendapat 50 Poin Untuk Penukaran 1 Kg Plastik', 1563190156),
(5, 7, '2 Kg Plastik = 100 Poin', 'garbage-bags-500x5001.jpg', 100, 'Anda Mendapat 100 Poin Untuk Penukaran 2 Kg Plastik', 1563190193),
(6, 9, '1 Kg Kertas = 75 Poin', 'waste-newspaper-500x500.jpg', 75, 'Anda Mendapat 75 Poin Untuk Penukaran 1 Kg Kertas', 1563190269),
(7, 9, '2 Kg Kertas = 150 Poin', 'waste-newspaper-500x5001.jpg', 150, 'Anda Mendapat 150 Poin Untuk Penukaran 2 Kg Kertas', 1563190322);

-- --------------------------------------------------------

--
-- Table structure for table `barang_tukar`
--

CREATE TABLE `barang_tukar` (
  `kode_barang_tukar` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `nama_produk` varchar(128) NOT NULL,
  `stok` int(11) NOT NULL,
  `image` varchar(128) NOT NULL,
  `harga_saldo` int(128) NOT NULL,
  `harga_uang` int(128) NOT NULL,
  `keterangan` text NOT NULL,
  `date_updated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='data barang - barang yang bisa ditukar saldo atau uang';

--
-- Dumping data for table `barang_tukar`
--

INSERT INTO `barang_tukar` (`kode_barang_tukar`, `id_category`, `nama_produk`, `stok`, `image`, `harga_saldo`, `harga_uang`, `keterangan`, `date_updated`) VALUES
(2, 6, 'Lifebuoy Clini Shield', 12, 'lifebuoy-sbn-clini-shield-fresh-70gr-pcs.jpg', 200, 7000, 'Sabun Lifebuoy', 1563190465),
(5, 6, 'Deterjen Cuci Bersih', 5, 'rinso.jpg', 100, 10000, 'Produk Deterjen dengan merk Rinso', 1563189786),
(6, 5, 'Gulaku', 10, '2652148b-d504-4074-9f02-4a6169847842w.jpg', 250, 6000, 'Produk Gula dengan merk Gulaku', 1563190519);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(128) NOT NULL,
  `jenis_category` enum('jualan','penukaran','sampah') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`, `jenis_category`) VALUES
(1, 'Kerajinan', 'jualan'),
(2, 'Bahan Daur Ulang', 'jualan'),
(5, 'Sembako', 'penukaran'),
(6, 'Keperluan Rumah Tangga', 'penukaran'),
(7, 'Plastik', 'sampah'),
(9, 'Kertas', 'sampah'),
(10, 'Kaca', 'sampah'),
(11, 'Organik', 'sampah'),
(12, 'Bekas Elektronik', 'sampah'),
(13, 'Limbah B3', 'sampah');

-- --------------------------------------------------------

--
-- Table structure for table `keluhan_user`
--

CREATE TABLE `keluhan_user` (
  `id_keluhan` int(11) NOT NULL,
  `keluhan` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_keluhan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keluhan_user`
--

INSERT INTO `keluhan_user` (`id_keluhan`, `keluhan`, `id_user`, `date_keluhan`) VALUES
(2, 'Produk nya masa cuma segitu? tambahin lagi min.. saya beli kerajinannya 100 stok kalo ada', 12, 1563896283);

-- --------------------------------------------------------

--
-- Table structure for table `komentar_jualan`
--

CREATE TABLE `komentar_jualan` (
  `id_komentar` int(11) NOT NULL,
  `komentar` text NOT NULL,
  `kode_barang_jualan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_comment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `komentar_jualan`
--

INSERT INTO `komentar_jualan` (`id_komentar`, `komentar`, `kode_barang_jualan`, `id_user`, `date_comment`) VALUES
(1, 'Keren..', 11, 10, 1563892843),
(3, 'kreatif..', 9, 10, 1563893534),
(4, 'Mantap', 9, 12, 1563893574),
(5, 'Produk Yang Super Sekali', 10, 12, 1563893605),
(6, 'Bolehlah..', 9, 10, 1563894639),
(7, 'Super banget.. :V', 10, 10, 1563894750);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_kerajinan`
--

CREATE TABLE `pemesanan_kerajinan` (
  `id_pesan` int(11) NOT NULL,
  `kode_barang_pesan` int(11) NOT NULL COMMENT 'relasi ke kode_barang_jualan',
  `id_user` int(11) NOT NULL,
  `tanggal_pesan` int(11) NOT NULL,
  `jumlah_pesan` int(11) NOT NULL,
  `total` double NOT NULL,
  `resi` varchar(128) NOT NULL COMMENT 'Foto Bukti Pembayaran',
  `status` enum('Sedang Diproses','Sedang Dikirim','Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='data pembelian kerajinan dengan uang';

--
-- Dumping data for table `pemesanan_kerajinan`
--

INSERT INTO `pemesanan_kerajinan` (`id_pesan`, `kode_barang_pesan`, `id_user`, `tanggal_pesan`, `jumlah_pesan`, `total`, `resi`, `status`) VALUES
(3, 10, 10, 1563286121, 3, 150000, 'download5.jpg', 'Sedang Dikirim'),
(4, 10, 10, 1563497177, 2, 100000, '7725_BulbaConfused.png', 'Sedang Diproses'),
(5, 11, 10, 1563497299, 2, 60000, '25e6bfae0c0a7cd42126f5cc96f4deed--log-horizon-artsy.jpg', 'Sedang Diproses'),
(6, 11, 10, 1563500537, 12, 360000, '2363_LaxEat.png', 'Sedang Diproses'),
(7, 11, 10, 1563501429, 3, 90000, '7821_AshWTF.png', 'Sedang Diproses'),
(8, 11, 10, 1563501541, 12, 360000, 'polsub.png', 'Sedang Diproses'),
(9, 10, 10, 1563501841, 1, 50000, 'polsub.png', 'Sedang Diproses'),
(10, 9, 10, 1563502227, 5, 380000, 'polsub.png', 'Sedang Diproses'),
(11, 9, 10, 1563520077, 1, 76000, 'polsub.png', 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_tambah_saldo`
--

CREATE TABLE `permintaan_tambah_saldo` (
  `kode_tambah_saldo` int(11) NOT NULL,
  `id_barang_sampah` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal_permintaan` int(11) NOT NULL,
  `status` enum('Sedang Diproses','Terkonfirmasi','Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permintaan_tambah_saldo`
--

INSERT INTO `permintaan_tambah_saldo` (`kode_tambah_saldo`, `id_barang_sampah`, `id_user`, `tanggal_permintaan`, `status`) VALUES
(3, 4, 10, 1563277972, 'Selesai'),
(4, 7, 10, 1563520297, 'Terkonfirmasi');

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_tukar_saldo`
--

CREATE TABLE `permintaan_tukar_saldo` (
  `kode_tukar_saldo` int(11) NOT NULL,
  `id_barang_tukar` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal_permintaan` int(11) NOT NULL,
  `status` enum('Sedang Diproses','Siap Ambil','Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='data permintaan member menukar saldo jadi barang tukar';

--
-- Dumping data for table `permintaan_tukar_saldo`
--

INSERT INTO `permintaan_tukar_saldo` (`kode_tukar_saldo`, `id_barang_tukar`, `id_user`, `tanggal_permintaan`, `status`) VALUES
(3, 6, 10, 1563271885, 'Selesai'),
(4, 5, 10, 1563459273, 'Sedang Diproses'),
(5, 2, 10, 1563520369, 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `saldo_user` int(25) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `no_hp`, `alamat`, `image`, `password`, `role_id`, `is_active`, `saldo_user`, `date_created`) VALUES
(10, 'Firo', 'firo@gmail.com', '082128823091', 'Jl. Angka 1 Rt.03/Rw.04 Kecamatan 2 Kabupaten 5', '7821_AshWTF.png', '$2y$10$TShFRwPLseqWudtchvAIU.phnfAhdl6eQknl9P9XcV8p12kFCSd8i', 1, 1, 50, 1557588250),
(12, 'Rianikha', 'rian@gmail.com', '081234567890', 'Jl. Huruf A Rt.01/Rw. 01 Kecamatan B Kabupaten C', '3247_MeowthM1.png', '$2y$10$LsOeWHU0YaEugaVdtIQ15enlV6cwM7BippSW.Bnu.tV7zdq4DQs.6', 2, 1, 0, 1558842882),
(16, 'Mr. Fusfus', 'rizifaarsien@gmail.com', '08123456789', 'Jl fusfus no.21 RT.01/RW.91 Kec Fus Kab Fus', 'default.jpg', '$2y$10$NfuESiorGoSZu05U6ebXdu.a45H3kF0atYdhMfxtdHyU.e9QERM6e', 2, 0, 0, 1561693673);

-- --------------------------------------------------------

--
-- Table structure for table `users_access_menu`
--

CREATE TABLE `users_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL COMMENT 'foreign key dari tabel users_role',
  `menu_id` int(11) NOT NULL COMMENT 'foreign key dari tabel users_menu'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_access_menu`
--

INSERT INTO `users_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(13, 2, 2),
(25, 2, 6),
(29, 1, 6),
(30, 1, 3),
(31, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users_menu`
--

CREATE TABLE `users_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_menu`
--

INSERT INTO `users_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Menu'),
(6, 'fusfus');

-- --------------------------------------------------------

--
-- Table structure for table `users_role`
--

CREATE TABLE `users_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_role`
--

INSERT INTO `users_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Anggota');

-- --------------------------------------------------------

--
-- Table structure for table `users_sub_menu`
--

CREATE TABLE `users_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_sub_menu`
--

INSERT INTO `users_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'user', 'fas fa-fw fa-user', 1),
(3, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(4, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(5, 3, 'Sub Menu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(7, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(8, 2, 'Change Password', 'user/ubahpassword', 'fas fa-fw fa-key', 1),
(9, 1, 'Data Anggota', 'admin/dataanggota', 'fas fa-fw fa-table', 1),
(10, 1, 'Data Jualan', 'admin/datajualan', 'fas fa-fw  fa-store', 1),
(11, 1, 'Data Barang Tukar', 'admin/databarangtukar', 'fas fa-fw  fa-people-carry', 1),
(12, 1, 'Opsi Penukaran', 'admin/datasampah', 'fas fa-fw  fa-dumpster', 1),
(13, 1, 'Pemesanan Kerajinan', 'admin/pemesanankerajinan', 'fas fa-fw fa-sticky-note', 1),
(14, 1, 'Permintaan Penukaran', 'admin/permintaantukar', 'fas fa-fw fa-tasks', 1),
(15, 1, 'Permintaan Tambah Saldo', 'admin/permintaantambah', 'fas fa-fw fa-coins', 1),
(16, 6, 'Beranda', 'fusfus', 'fas fa-fw fa-store-alt', 1),
(17, 1, 'Data Kategori', 'admin/dataKategori', 'fas fa-fw fa-sort', 1),
(18, 6, 'Status Pemesanan', 'fusfus/statusPemesanan', 'fas fa-fw fa-cubes', 1),
(19, 6, 'Status Penukaran', 'fusfus/statusPenukaran', 'fas fa-fw fa-sync', 1),
(20, 6, 'Status Tambah Saldo', 'fusfus/statusTambahSaldo', 'fas fa-fw fa-chess-pawn', 1),
(21, 1, 'Data Komentar', 'admin/datakomentar', 'far fa-fw fa-comments', 1),
(22, 6, 'Kirim Keluhan', 'fusfus/kirimkeluhan', 'fas fa-fw fa-bullhorn', 1),
(23, 1, 'Data Keluhan', 'admin/datakeluhan', 'fab fa-fw fa-intercom', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_token`
--

CREATE TABLE `users_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_token`
--

INSERT INTO `users_token` (`id`, `email`, `token`, `date_created`) VALUES
(1, 'rizifaarsien@gmail.com', 'b7ktbjSwYVN3S3Qzk/6JTaSaGpK0rVZefOIVIA757Gc=', 1561693673);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang_jualan`
--
ALTER TABLE `barang_jualan`
  ADD PRIMARY KEY (`kode_barang_jualan`);

--
-- Indexes for table `barang_sampah`
--
ALTER TABLE `barang_sampah`
  ADD PRIMARY KEY (`kode_barang_sampah`);

--
-- Indexes for table `barang_tukar`
--
ALTER TABLE `barang_tukar`
  ADD PRIMARY KEY (`kode_barang_tukar`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keluhan_user`
--
ALTER TABLE `keluhan_user`
  ADD PRIMARY KEY (`id_keluhan`);

--
-- Indexes for table `komentar_jualan`
--
ALTER TABLE `komentar_jualan`
  ADD PRIMARY KEY (`id_komentar`);

--
-- Indexes for table `pemesanan_kerajinan`
--
ALTER TABLE `pemesanan_kerajinan`
  ADD PRIMARY KEY (`id_pesan`);

--
-- Indexes for table `permintaan_tambah_saldo`
--
ALTER TABLE `permintaan_tambah_saldo`
  ADD PRIMARY KEY (`kode_tambah_saldo`);

--
-- Indexes for table `permintaan_tukar_saldo`
--
ALTER TABLE `permintaan_tukar_saldo`
  ADD PRIMARY KEY (`kode_tukar_saldo`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_access_menu`
--
ALTER TABLE `users_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_menu`
--
ALTER TABLE `users_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_role`
--
ALTER TABLE `users_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_sub_menu`
--
ALTER TABLE `users_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_token`
--
ALTER TABLE `users_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang_jualan`
--
ALTER TABLE `barang_jualan`
  MODIFY `kode_barang_jualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `barang_sampah`
--
ALTER TABLE `barang_sampah`
  MODIFY `kode_barang_sampah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `barang_tukar`
--
ALTER TABLE `barang_tukar`
  MODIFY `kode_barang_tukar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `keluhan_user`
--
ALTER TABLE `keluhan_user`
  MODIFY `id_keluhan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `komentar_jualan`
--
ALTER TABLE `komentar_jualan`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pemesanan_kerajinan`
--
ALTER TABLE `pemesanan_kerajinan`
  MODIFY `id_pesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `permintaan_tambah_saldo`
--
ALTER TABLE `permintaan_tambah_saldo`
  MODIFY `kode_tambah_saldo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permintaan_tukar_saldo`
--
ALTER TABLE `permintaan_tukar_saldo`
  MODIFY `kode_tukar_saldo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users_access_menu`
--
ALTER TABLE `users_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users_menu`
--
ALTER TABLE `users_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users_role`
--
ALTER TABLE `users_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_sub_menu`
--
ALTER TABLE `users_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users_token`
--
ALTER TABLE `users_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
