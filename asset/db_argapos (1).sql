-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2025 at 07:00 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.4.2

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
('BRG-001', '25030001', 'marjan', 15000, 20000, 20, 'piece', 20, 'BRG-001.jpeg'),
('BRG-002', '24080002', 'betutu', 120000, 100000, 9, 'piece', 5, 'BRG-002.jpeg'),
('BRG-003', '24030003', 'coca-cola', 5000, 8000, 20, 'piece', 14, 'BRG-003.jpeg'),
('BRG-004', '24030004', 'Margarin', 10000, 15000, 21, 'piece', 10, 'BRG-004.jpeg');

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
(14, 'PB0004', '2025-03-02', 'BRG-004', 'Margarin', 6, 10000, 60000),
(15, 'PB0005', '2025-03-04', 'BRG-001', 'marjan', 12, 15000, 180000),
(16, 'PB0005', '2025-03-04', 'BRG-003', 'coca-cola', 12, 5000, 60000),
(17, 'PB0005', '2025-03-04', 'BRG-004', 'Margarin', 12, 10000, 120000);

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
('PB0004', '2025-03-02', 'PT WILIAM', 795000, ''),
('PB0005', '2025-03-04', 'PT Tabrak Lari', 360000, '');

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
(16, 'PJ0011', '2025-03-01', '24030004', 'Margarin', 1, 15000, 15000),
(17, 'PJ0012', '2025-03-03', '25030001', 'marjan', 2, 20000, 40000),
(18, 'PJ0013', '2025-03-04', '24030003', 'coca-cola', 1, 8000, 8000),
(19, 'PJ0014', '2025-03-04', '24030003', 'coca-cola', 1, 8000, 8000),
(20, 'PJ0014', '2025-03-04', '24080002', 'betutu', 1, 100000, 100000),
(21, 'PJ0014', '2025-03-04', '24030004', 'Margarin', 1, 15000, 15000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jual_head`
--

CREATE TABLE `tbl_jual_head` (
  `no_jual` varchar(20) NOT NULL,
  `tgl_jual` date NOT NULL,
  `costumer` varchar(255) NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `jml_bayar` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_jual_head`
--

INSERT INTO `tbl_jual_head` (`no_jual`, `tgl_jual`, `costumer`, `id_pelanggan`, `total`, `keterangan`, `jml_bayar`, `kembalian`) VALUES
('PJ0001', '2025-03-01', 'Umum', 1, 300000, '', 450000, 150000),
('PJ0002', '2025-03-01', 'Umum', 1, 32000, '', 100000, 68000),
('PJ0003', '2025-03-01', 'Umum', 1, 45000, '', 60000, 15000),
('PJ0004', '2025-03-01', 'Umum', 1, 200000, '', 210000, 10000),
('PJ0005', '2025-03-01', 'Umum', 1, 15000, '', 17000, 2000),
('PJ0006', '2025-03-01', 'Umum', 1, 8000, '', 10000, 2000),
('PJ0007', '2025-03-01', 'Umum', 1, 20000, '', 30000, 10000),
('PJ0008', '2025-03-01', 'Umum', 1, 20000, '', 20000, 0),
('PJ0009', '2025-03-01', 'Umum', 1, 15000, '', 15000, 0),
('PJ0010', '2025-03-01', 'Umum', 1, 8000, '', 10000, 2000),
('PJ0011', '2025-03-01', 'Umum', 1, 115000, '', 120000, 5000),
('PJ0012', '2025-03-03', 'Khusus', 2, 40000, '', 40000, 0),
('PJ0013', '2025-03-04', 'Aston', 5, 8000, '', 10000, 2000),
('PJ0014', '2025-03-04', 'Aston', 5, 123000, '', 130000, 7000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pelanggan`
--

CREATE TABLE `tbl_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pelanggan`
--

INSERT INTO `tbl_pelanggan` (`id_pelanggan`, `nama`, `alamat`, `telepon`, `email`, `password`, `created_at`) VALUES
(1, 'Umum', NULL, NULL, NULL, '', '2025-03-03 05:54:39'),
(2, 'Khusus', NULL, NULL, NULL, '', '2025-03-03 05:54:39'),
(5, 'Aston', 'asodkfoaksdf', '2345678', 'aston@gmail.com', '12345', '2025-03-03 07:24:11'),
(6, 'Evan', 'dalung', '123123123', 'evan@gmail.com', '12345', '2025-03-04 01:45:45'),
(7, 'David Gaming 01', 'Gtsu ', '123123123123', 'david@gmail.co', '12345', '2025-03-04 01:53:34');

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
(6, 'PT WILIAM', '123456789010', 'TUKANG JUAL BETUTU KHAS ABIANBASE DAN ES CAMPUR', 'ABIANBASE GAMING 0123');

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
(10, 'evanc', 'pance', '$2y$10$23bBM9lVdYMEkUQ3f.ijLeVYiVj4EpWmdj8FQRguFO1AVB64KVgMW', 'Dalung', 3, '174.pance.jpg'),
(11, 'handy', 'handy', '$2y$12$u1pws/FsaGSuYrDu19/q9.EzXJ0KYvThdgCB90zL/N.QFmYgCa2Ie', 'dalung', 3, 'deafult.png'),
(12, 'flow', 'flow sangt imut', '$2y$12$vS9VCELFj1iQySgzRiPoi.eZc4jABTw9Qc1WnMVEWVXGujA32B0dq', 'sading gaming', 3, 'deafult.png');

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
-- Indexes for table `tbl_jual_detail`
--
ALTER TABLE `tbl_jual_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_jual_head`
--
ALTER TABLE `tbl_jual_head`
  ADD PRIMARY KEY (`no_jual`),
  ADD KEY `fk_jual_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_jual_detail`
--
ALTER TABLE `tbl_jual_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_jual_head`
--
ALTER TABLE `tbl_jual_head`
  ADD CONSTRAINT `fk_jual_pelanggan` FOREIGN KEY (`id_pelanggan`) REFERENCES `tbl_pelanggan` (`id_pelanggan`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
