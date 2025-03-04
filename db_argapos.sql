-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2025 at 11:36 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_argapos`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id_barang` varchar(100) NOT NULL,
  `barcode` varchar(20) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `stock_minimal` int(11) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`id_barang`, `barcode`, `nama_barang`, `harga_beli`, `harga_jual`, `stock`, `satuan`, `stock_minimal`, `gambar`) VALUES
('BRG-001', '25030001', 'marjan', 15000, 20000, 10, 'piece', 20, 'BRG-001.jpeg'),
('BRG-002', '24080002', 'betutu', 120000, 100000, 10, 'piece', 5, 'BRG-002.jpeg'),
('BRG-003', '24030003', 'coca-cola', 5000, 8000, 10, 'piece', 14, 'BRG-003.jpeg'),
('BRG-004', '24030004', 'Margarin', 10000, 15000, 10, 'piece', 10, 'BRG-004.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_beli_detail`
--

CREATE TABLE `tbl_beli_detail` (
  `id` int(11) NOT NULL,
  `no_beli` varchar(20) NOT NULL,
  `tgl_beli` date NOT NULL,
  `kode_brg` varchar(10) NOT NULL,
  `nama_brg` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `jml_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_beli_detail`
--

INSERT INTO `tbl_beli_detail` (`id`, `no_beli`, `tgl_beli`, `kode_brg`, `nama_brg`, `qty`, `harga_beli`, `jml_harga`) VALUES
(2, 'PB0001', '2025-03-01', 'BRG-002', 'betutu', 4, 120000, 480000),
(5, 'PB0001', '2025-03-01', 'BRG-001', 'marjan', 4, 15000, 60000),
(6, 'PB0002', '2025-03-01', 'BRG-003', 'coca-cola', 5, 120000, 600000),
(7, 'PB0003', '2025-03-01', 'BRG-001', 'marjan', 6, 15000, 90000),
(8, 'PB0003', '2025-03-01', 'BRG-002', 'betutu', 6, 120000, 720000),
(9, 'PB0003', '2025-03-01', 'BRG-003', 'coca-cola', 5, 5000, 25000),
(10, 'PB0003', '2025-03-01', 'BRG-004', 'Margarin', 10, 10000, 100000),
(11, 'PB0004', '2025-03-02', 'BRG-001', 'marjan', 7, 15000, 105000),
(12, 'PB0004', '2025-03-02', 'BRG-002', 'betutu', 5, 120000, 600000),
(13, 'PB0004', '2025-03-02', 'BRG-003', 'coca-cola', 6, 5000, 30000),
(14, 'PB0004', '2025-03-02', 'BRG-004', 'Margarin', 6, 10000, 60000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_beli_head`
--

CREATE TABLE `tbl_beli_head` (
  `no_beli` varchar(20) NOT NULL,
  `tgl_beli` date NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `total` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_beli_head`
--

INSERT INTO `tbl_beli_head` (`no_beli`, `tgl_beli`, `supplier`, `total`, `keterangan`) VALUES
('PB0001', '2025-03-01', 'PT Tabrak Lari', 540000, ''),
('PB0002', '2025-03-01', 'PT WILIAM', 600000, ''),
('PB0003', '2025-03-01', '', 935000, ''),
('PB0004', '2025-03-02', 'PT WILIAM', 795000, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_costumer`
--

CREATE TABLE `tbl_costumer` (
  `id_costumer` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `deskripsi` varchar(256) NOT NULL,
  `alamat` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_costumer`
--

INSERT INTO `tbl_costumer` (`id_costumer`, `nama`, `telepon`, `deskripsi`, `alamat`) VALUES
(1, 'Umum', '123456789', 'Umum', 'petang'),
(3, 'Khusus', '09120912', 'Ini Khusus', 'Rumah Adit');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jual_detail`
--

CREATE TABLE `tbl_jual_detail` (
  `id` int(11) NOT NULL,
  `no_jual` varchar(20) NOT NULL,
  `tgl_jual` date NOT NULL,
  `barcode` varchar(100) NOT NULL,
  `nama_brg` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `jml_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_jual_detail`
--

INSERT INTO `tbl_jual_detail` (`id`, `no_jual`, `tgl_jual`, `barcode`, `nama_brg`, `qty`, `harga_jual`, `jml_harga`) VALUES
(2, 'PJ0001', '2025-03-01', '24080002', 'betutu', 2, 100000, 200000),
(3, 'PJ0001', '2025-03-01', '25030001', 'marjan', 5, 20000, 100000),
(4, 'PJ0002', '2025-03-01', '24030003', 'coca-cola', 4, 8000, 32000),
(7, 'PJ0003', '2025-03-01', '24030004', 'Margarin', 3, 15000, 45000),
(8, 'PJ0004', '2025-03-01', '24080002', 'betutu', 2, 100000, 200000),
(9, 'PJ0005', '2025-03-01', '24030004', 'Margarin', 1, 15000, 15000),
(10, 'PJ0006', '2025-03-01', '24030003', 'coca-cola', 1, 8000, 8000),
(11, 'PJ0007', '2025-03-01', '25030001', 'marjan', 1, 20000, 20000),
(12, 'PJ0008', '2025-03-01', '25030001', 'marjan', 1, 20000, 20000),
(13, 'PJ0009', '2025-03-01', '24030004', 'Margarin', 1, 15000, 15000),
(14, 'PJ0010', '2025-03-01', '24030003', 'coca-cola', 1, 8000, 8000),
(15, 'PJ0011', '2025-03-01', '24080002', 'betutu', 1, 100000, 100000),
(16, 'PJ0011', '2025-03-01', '24030004', 'Margarin', 1, 15000, 15000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jual_head`
--

CREATE TABLE `tbl_jual_head` (
  `no_jual` varchar(20) NOT NULL,
  `tgl_jual` date NOT NULL,
  `costumer` varchar(255) NOT NULL,
  `total` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `jml_bayar` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_jual_head`
--

INSERT INTO `tbl_jual_head` (`no_jual`, `tgl_jual`, `costumer`, `total`, `keterangan`, `jml_bayar`, `kembalian`) VALUES
('PJ0001', '2025-03-01', 'Umum', 300000, '', 450000, 150000),
('PJ0002', '2025-03-01', 'Umum', 32000, '', 100000, 68000),
('PJ0003', '2025-03-01', 'Umum', 45000, '', 60000, 15000),
('PJ0004', '2025-03-01', 'Umum', 200000, '', 210000, 10000),
('PJ0005', '2025-03-01', 'Umum', 15000, '', 17000, 2000),
('PJ0006', '2025-03-01', 'Umum', 8000, '', 10000, 2000),
('PJ0007', '2025-03-01', 'Umum', 20000, '', 30000, 10000),
('PJ0008', '2025-03-01', 'Umum', 20000, '', 20000, 0),
('PJ0009', '2025-03-01', 'Umum', 15000, '', 15000, 0),
('PJ0010', '2025-03-01', 'Umum', 8000, '', 10000, 2000),
('PJ0011', '2025-03-01', 'Umum', 115000, '', 120000, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `telepon` varchar(25) NOT NULL,
  `deskripsi` varchar(256) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`id_supplier`, `nama`, `telepon`, `deskripsi`, `alamat`) VALUES
(5, 'PT Tabrak Lari', '0811112344', 'Tukang Bakso Tabrak DAN RUJAK CINGUR', 'Dalung'),
(6, 'PT WILIAM', '123456789010', 'TUKANG JUAL BETUTU KHAS ABIANBASE DAN ES CAMPUR', 'ABIANBASE GAMING 0123'),
(7, 'PT Chaya sentosa', '0811112344', 'asidjifjaidf', 'asidjfiajsdfaf');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `userid` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL,
  `address` varchar(100) NOT NULL,
  `level` int(1) NOT NULL COMMENT '1-administrator\r\n2-supervisor\r\n3-operator',
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`userid`, `username`, `fullname`, `password`, `address`, `level`, `foto`) VALUES
(2, 'admin', 'administrator', '$2y$10$KX.g/W5XsssgD87k9JxZk.C0gaKi6mxjRh58q7J9tyGwxRw7NrTmG', 'jalan bojong gede 02', 1, '558.user.png'),
(7, 'evan', 'Filbert', '$2y$10$P6vJ02u2xEXR0bv95w41Feb0JRdimndvCK1TIr1FlYwrQYfQ/Dmo2', 'Gatsu Gamings', 2, '120.cowboy_6543179.png'),
(9, 'wili', 'WILLIAM ayam', '$2y$10$SnYebp2.PKUaywIUI1CQhOVyqTVw5EvS0/R..SNUTOyKoUhcd8iV2', 'ABIANBASE GAMING 123', 3, '933.user_667432.png'),
(10, 'evanc', 'pance', '$2y$10$23bBM9lVdYMEkUQ3f.ijLeVYiVj4EpWmdj8FQRguFO1AVB64KVgMW', 'Dalung', 3, '174.pance.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tbl_beli_detail`
--
ALTER TABLE `tbl_beli_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_beli_head`
--
ALTER TABLE `tbl_beli_head`
  ADD PRIMARY KEY (`no_beli`);

--
-- Indexes for table `tbl_costumer`
--
ALTER TABLE `tbl_costumer`
  ADD PRIMARY KEY (`id_costumer`);

--
-- Indexes for table `tbl_jual_detail`
--
ALTER TABLE `tbl_jual_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_jual_head`
--
ALTER TABLE `tbl_jual_head`
  ADD PRIMARY KEY (`no_jual`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_beli_detail`
--
ALTER TABLE `tbl_beli_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_costumer`
--
ALTER TABLE `tbl_costumer`
  MODIFY `id_costumer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_jual_detail`
--
ALTER TABLE `tbl_jual_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
