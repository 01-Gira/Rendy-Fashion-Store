-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2021 at 06:16 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualan`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kd_barang` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `harga_jual` double NOT NULL,
  `terjual` int(11) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kd_barang`, `nama`, `id_kategori`, `deskripsi`, `jumlah_barang`, `tanggal_masuk`, `harga_jual`, `terjual`, `foto`) VALUES
(15, 'Kaos Polos Hitam', 1, 'INFO PRODUK:\r\n-Cotton Combed 30s (Soft Hand Feel)\r\n-100% Cotton\r\n-Lembut nyaman di pakai\r\n-Menyerap keringat dengan baik\r\n-Jahitan Rapih\r\n-Anti Bakteri\r\n-Produk Kaos FHC menggunakan EASY TEAR LABEL mudah untuk dirobek sehingga bisa jadi tanpa label/polosan tanpa MERK kami.', 10, '2021-06-07', 50000, 100, '57kaos_Polos_hitam.jpg'),
(16, 'Kaos polos Putih', 1, ' INFO PRODUK:\r\n-Cotton Combed 30s (Soft Hand Feel)\r\n-100% Cotton\r\n-Lembut nyaman di pakai\r\n-Menyerap keringat dengan baik\r\n-Jahitan Rapih\r\n-Anti Bakteri\r\n-Produk Kaos FHC menggunakan EASY TEAR LABEL mudah untuk dirobek sehingga bisa jadi tanpa label/polosan tanpa MERK kami.\r\n                    ', 8, '2021-06-07', 50000, 10, '8kaos_Polos_putih.jpg'),
(17, 'Celana Pria Jogger Chino Cream', 2, ' Detail:\r\n\r\n- Brand: STYLEHAUS\r\n\r\n- Produk: Celana Jogger Pria\r\n\r\n- Warna: Khaki\r\n\r\n- Ukuran: 30, 32, 34, 36\r\n\r\n- Cocok untuk laki-laki\r\n\r\n- Di desain dengan saku kantong samping dan belakang\r\n                    ', 10, '2021-07-06', 390000, 50, '6celana_joggerchino_cream.jpg'),
(18, 'Jaket Bomber Pria Black', 3, 'Model : Kasual Korea\r\nType: Bomber\r\nWarna: Hitam\r\nBahan Luar: Goretex\r\nBahan Dalam: Fece Waterproof\r\n                    ', 2, '2021-07-06', 299999, 5, '49Jaket_Bomber_Black.jpg'),
(19, 'Long Jeans Darkgrey', 2, 'JEANS SLIM\r\nMATERIAL : FULL PRE-WASHED DENIM STRECH (SOFT) = BAHAN NGARET DAN LEMBUT \r\nJAHITAN : RANTAI DAN OVERDEK\r\nSLETING : YKK\r\nWARNA TIDAK LUNTUR\r\n                    ', 8, '2021-07-06', 115000, 30, '67Celana_Jeans_Darkgrey.jpg'),
(20, 'Jeans Pria Hitam', 2, ' Nomor Produk	618758137\r\nClothing Material	Denim\r\nComing Soon	Coming Soon\r\nBelt Styles	Casual\r\nBawahan	Jeans\r\nPants Fly	Mixed Type,Button,Elasticated,Zip\r\n                    ', 10, '2021-07-06', 65000, 20, '68Celana_Jeans_Hitam.jpg'),
(22, 'Jaket Coach Pria Black', 3, ' Jaket the jack kualitas bagus\r\n                    ', 20, '2021-06-16', 400000, 0, '87Jaket-Salju-Quiksilver-seri-Mission-Placed-Art-Snow-Jacket-EQYTJ03089-Original-Hitam.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'T-Shirt'),
(2, 'Celana'),
(3, 'Jaket'),
(4, 'Aksesoris');

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(11) NOT NULL,
  `nama_kota` varchar(50) NOT NULL,
  `tarif` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `nama_kota`, `tarif`) VALUES
(1, 'Cikampek', 0),
(2, 'Jakarta', 15000),
(3, 'Bandung ', 15000),
(4, 'Semarang', 25000),
(5, 'Karawang', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `email_pelanggan` varchar(100) NOT NULL,
  `password_pelanggan` varchar(50) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `no_pelanggan` varchar(20) NOT NULL,
  `alamat_pelanggan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `email_pelanggan`, `password_pelanggan`, `nama_pelanggan`, `no_pelanggan`, `alamat_pelanggan`) VALUES
(1, 'giramni@gmail.com', '123456', 'Gira Muhammad Nur Icharisma ', '081239062114', ''),
(5, 'haffizhhassan@gmail.com', '123456', 'Haffizh Hassan', '0812395401', 'Karang Pawitan'),
(6, 'alamnasra@gmail.com', '1234567', 'Alam Nasra', '081234567', 'Cikampek'),
(7, 'faizal@gmail.com', '123456', 'Faizal', '0812345456', 'Karawang'),
(8, 'alam@gmail.com', '123456', ' Muhammmad Alam', '0812345678', 'Karawang789'),
(9, 'faizal1@gmail.com', '12345', 'Ahmad Faizal', '0812345456', 'Karawang');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `bukti` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembelian`, `nama`, `bank`, `jumlah`, `tanggal`, `bukti`) VALUES
(2, 26, 'Haffizh Hassan', 'BRI', 360000, '2021-06-09', '20210609082732fe24bcc5a84c90254151e1bd2dd6d6c3.jpg'),
(3, 26, 'Haffizh Hassan', 'BRI', 360000, '2021-06-09', '20210609083203fe24bcc5a84c90254151e1bd2dd6d6c3.jpg'),
(4, 24, 'Gira Muhammad Nur Icharisma', 'BNI', 115000, '2021-06-09', '20210609105636fe24bcc5a84c90254151e1bd2dd6d6c3.jpg'),
(5, 25, 'Gira Muhammad Nur Icharisma', 'BRI', 115000, '2021-06-09', '20210609105745fe24bcc5a84c90254151e1bd2dd6d6c3.jpg'),
(6, 27, 'Gira Muhammad Nur Icharisma', 'BRI', 115, '2021-06-09', '20210609105902fe24bcc5a84c90254151e1bd2dd6d6c3.jpg'),
(7, 30, 'Faizal', 'BRI', 2894997, '2021-06-11', '20210611101952fe24bcc5a84c90254151e1bd2dd6d6c3.jpg'),
(8, 32, 'Alam', 'BRI', 624998, '2021-06-11', '20210611112631fe24bcc5a84c90254151e1bd2dd6d6c3.jpg'),
(9, 33, 'Alam', 'BNI', 299999, '2021-06-11', '20210611113038fe24bcc5a84c90254151e1bd2dd6d6c3.jpg'),
(10, 35, 'Ahmad Faizal', 'BRI', 2574998, '2021-06-16', '20210616153738fe24bcc5a84c90254151e1bd2dd6d6c3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  `nama_kota` varchar(50) NOT NULL,
  `tarif` int(11) NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `status_pembelian` varchar(100) NOT NULL DEFAULT 'pending',
  `resi_pembelian` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pelanggan`, `id_ongkir`, `tanggal_pembelian`, `total_pembelian`, `nama_kota`, `tarif`, `alamat_pengiriman`, `status_pembelian`, `resi_pembelian`) VALUES
(24, 1, 5, '2021-06-08', 115000, 'Karawang', 0, 'Kp. Utama Jaya RT/RW 01/01, Adiarsa Timur Karawang WEST JAVA 41314', 'Barang dikirim', '10001233311'),
(25, 1, 0, '2021-06-09', 115000, '', 0, 'Kp. Utama Jaya RT/RW 01/01, Adiarsa Timur Karawang WEST JAVA 41314', 'Sudah dibayar', ''),
(26, 5, 2, '2021-06-09', 360000, 'Jakarta', 15000, 'Karang Pawitan, JAKARTA, 6969', 'Sudah dibayar', ''),
(27, 1, 0, '2021-06-09', 115000, '', 0, 'Kp. Utama Jaya RT/RW 01/01, Adiarsa Timur Karawang WEST JAVA 41314', 'Sudah dibayar', ''),
(28, 1, 2, '2021-06-09', 130000, 'Jakarta', 15000, 'Jakarta', 'pending', ''),
(29, 1, 2, '2021-06-09', 130000, 'Jakarta', 15000, 'Jakarta', 'pending', ''),
(30, 7, 5, '2021-06-11', 2894997, 'Karawang', 0, 'Kp. Utama Jaya RT/RW 01/01, Adiarsa Timur Karawang WEST JAVA 41314', 'Lunas', ''),
(31, 7, 2, '2021-06-11', 2010000, 'Jakarta', 15000, 'Jakarta', 'pending', ''),
(32, 8, 4, '2021-06-11', 624998, 'Semarang', 25000, 'Kp. Utama Jaya RT/RW 01/01, Adiarsa Timur Karawang WEST JAVA 41314', 'Batal', ''),
(33, 8, 5, '2021-06-11', 299999, 'Karawang', 0, 'Karawang', 'Barang dikirim', '10001233311'),
(34, 8, 4, '2021-06-11', 125000, 'Semarang', 25000, 'SEMARANG', 'pending', ''),
(35, 9, 4, '2021-06-16', 2574998, 'Semarang', 25000, 'Semarang', 'Barang dikirim', '100012333111');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_barang`
--

CREATE TABLE `pembelian_barang` (
  `id_pembelian_barang` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `kd_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian_barang`
--

INSERT INTO `pembelian_barang` (`id_pembelian_barang`, `id_pembelian`, `kd_barang`, `jumlah`) VALUES
(1, 1, 1, 0),
(2, 1, 2, 0),
(3, 0, 19, 3),
(4, 0, 18, 1),
(5, 0, 17, 1),
(6, 0, 16, 1),
(7, 8, 19, 3),
(8, 8, 18, 1),
(9, 8, 17, 1),
(10, 8, 16, 1),
(11, 9, 19, 3),
(12, 9, 18, 1),
(13, 9, 17, 1),
(14, 9, 16, 1),
(15, 10, 19, 1),
(16, 10, 18, 1),
(17, 11, 19, 1),
(18, 12, 19, 1),
(19, 12, 18, 1),
(20, 13, 19, 1),
(21, 14, 18, 1),
(22, 16, 19, 1),
(23, 16, 18, 1),
(24, 17, 19, 0),
(25, 17, 15, 0),
(26, 18, 19, 0),
(27, 18, 18, 0),
(28, 19, 19, 0),
(29, 22, 19, 1),
(30, 23, 19, 2),
(31, 23, 18, 1),
(32, 23, 15, 1),
(33, 24, 19, 1),
(34, 25, 19, 1),
(35, 26, 19, 3),
(36, 27, 19, 1),
(37, 28, 19, 1),
(38, 29, 19, 1),
(39, 30, 17, 5),
(40, 30, 18, 3),
(41, 31, 17, 5),
(42, 32, 18, 2),
(43, 33, 18, 1),
(44, 34, 16, 2),
(45, 35, 17, 5),
(46, 35, 18, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `password` varchar(13) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `level` varchar(20) NOT NULL,
  `blokir` enum('y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `nama_lengkap`, `email`, `no_telp`, `level`, `blokir`) VALUES
('admin', 'admin', 'Hafizh Hasan', '', '', '', 'N');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kd_barang`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_kategori_2` (`id_kategori`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD KEY `email_pelanggan` (`email_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `pembelian_barang`
--
ALTER TABLE `pembelian_barang`
  ADD PRIMARY KEY (`id_pembelian_barang`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `kd_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `pembelian_barang`
--
ALTER TABLE `pembelian_barang`
  MODIFY `id_pembelian_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
