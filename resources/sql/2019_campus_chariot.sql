-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Mar 2021 pada 14.33
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `2019_campus_chariot`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `item_market`
--

CREATE TABLE `item_market` (
  `id_item` int(11) NOT NULL,
  `id_market` int(11) NOT NULL,
  `item_name` varchar(128) NOT NULL,
  `item_image` varchar(128) NOT NULL,
  `item_type` varchar(128) NOT NULL,
  `item_price` int(11) NOT NULL,
  `item_stock` int(11) NOT NULL,
  `item_category` varchar(128) NOT NULL,
  `item_description` varchar(255) NOT NULL,
  `is_active` int(1) NOT NULL,
  `item_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `item_market`
--

INSERT INTO `item_market` (`id_item`, `id_market`, `item_name`, `item_image`, `item_type`, `item_price`, `item_stock`, `item_category`, `item_description`, `is_active`, `item_created`) VALUES
(2, 2, 'Superstar 80s', '5d1a1f6b38f58.png', 'MENS ORIGINALS', 550000, 1, 'Adidas', 'Built with leather from the inside out, this legendary mens sneaker has a premium look and feel. Its got the famous rubber shell toe and is updated with 3-Stripes made of felt and a gum rubber outsole.', 1, 1561993067),
(3, 2, 'All star basic', '5d1a20404525f.png', 'WHITE ALL89W', 749000, 13, 'Converse', 'An iconic sneaker, the Converse All Star basic canvas hi in white! The Chuck Taylor All Star Classic celebrates the iconic high top silhouette with a comfortable canvas upper and presented in classic colours. All finished off with the unmistakable ankle p', 1, 1561993280),
(4, 2, ' Classics R.', '5d1a3990173ab.png', 'Mens 574', 2000000, 8, 'New Balance', 'New Balance is dedicated to helping athletes achieve their goals. Its been their mission for more than a century to focus on research and development. Its why they dont design products to fit an image. They design them to fit. New Balance is driven to mak', 1, 1561993527),
(5, 2, 'Court Royale', '5d1a21da8e8ef.png', 'Nike Women', 2053999, 5, 'Nike', 'An old-school design thats as fresh as the day it debuted, the Womens Nike Court Royale Shoe features classic clean lines, a prominent Swoosh design trademark and a rubber cupsole for a comfortable finish.', 1, 1561993690),
(6, 2, 'Terrex', '5d1a37d4b4ba6.png', 'CMTK GTX', 1800000, 7, 'Adidas', 'Canvas upper with abrasion-resistant weldings\r\nGORE-TEX lining for waterproof, breathable performance\r\nLightweight EVA midsole for long-term cushioning\r\nTPU heel clip for stability and protection. TPU toe cap for protection\r\nContinental Rubber for extraor', 1, 1561999316),
(7, 2, 'Adidas Original', '5d1a38610cc32.png', 'N-5923', 900000, 7, 'Adidas', 'Breathable textile/synthetic upper offers a comfortable feel.\r\nWelded overlays and a 3d TPU heel cage.\r\nRubber outsole offers durable traction on a variety of surfaces.', 1, 1561999457);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `name` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `email` varchar(128) NOT NULL,
  `birth` varchar(128) NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`name`, `image`, `gender`, `email`, `birth`, `no_telp`, `address`, `password`, `role_id`, `is_active`, `date_created`) VALUES
('admin', 'default.png', 'L', 'admin@chariot.com', '2019-06-03', '087111112662', 'Chariot.co', '$2y$10$7FPi5U9tEYkfTI5kTI55GOjFOXs7SI6.qbRuPpcO6n5P7gAHOOxNO', 1, 1, 1561462286),
('handoko adji pangestu', '6048b87465c7d.jpg', 'L', 'handokoadjipangestu@gmail.com', '1999-08-16', '089650574913', 'Taman Banjar Agung Indah blok F17 No12, KOTA SERANG - CIPOCOK JAYA, BANTEN, ID 42122', '$2y$10$EHr9I3ftBxAxgX3meGwYvOWYVT5Dd/sw7oMMfw6e635AKq9HfcZ.G', 2, 1, 1615377404),
('rizkia nur safitri', '6048c4ccc2770.jpg', 'P', 'rizkianusa@gmail.com', '1998-01-29', '085312952535', 'Puri Anggrek', '$2y$10$9mRMz0eBFrF97ndRzeBhDuqg2EIF523eNSPazCw.bukOWlErEAVXu', 2, 1, 1615381108),
('Toko', '5d1a1e91f2146.jpg', 'L', 'toko@gmail.com', '1999-08-16', '087888884883', 'Taman banjar agung indah blok F17 no12', '$2y$10$7FPi5U9tEYkfTI5kTI55GOjFOXs7SI6.qbRuPpcO6n5P7gAHOOxNO', 2, 1, 1561992765);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_market`
--

CREATE TABLE `user_market` (
  `id_market` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `market_name` varchar(128) NOT NULL,
  `market_address` varchar(128) NOT NULL,
  `market_rek` varchar(128) NOT NULL,
  `market_image` varchar(128) NOT NULL,
  `market_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_market`
--

INSERT INTO `user_market` (`id_market`, `email`, `market_name`, `market_address`, `market_rek`, `market_image`, `market_created`) VALUES
(2, 'toko@gmail.com', 'Ncrsport', 'Jl. KH Abdul khasan no.88', '1782637843', '5d1a1ecba3be1.png', 1561992907);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_transaksi`
--

CREATE TABLE `user_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_market` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `date_transaksi` varchar(128) NOT NULL,
  `many_transaksi` int(11) NOT NULL,
  `price_transaksi` int(11) NOT NULL,
  `info_transaksi` varchar(128) NOT NULL,
  `method_transaksi` varchar(128) NOT NULL,
  `bukti_transaksi` varchar(128) NOT NULL,
  `payment_transaksi` varchar(128) NOT NULL,
  `item_transaksi` varchar(128) NOT NULL,
  `status_transaksi` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_transaksi`
--

INSERT INTO `user_transaksi` (`id_transaksi`, `id_market`, `id_item`, `email`, `date_transaksi`, `many_transaksi`, `price_transaksi`, `info_transaksi`, `method_transaksi`, `bukti_transaksi`, `payment_transaksi`, `item_transaksi`, `status_transaksi`) VALUES
(3, 2, 4, 'rizkianusa@gmail.com', '2021-03-10', 1, 2000000, 'Mohon segera dikirim', 'BCA', '6048c7b19f7ef.jpg', 'bayar', 'diterima', 'sukses'),
(4, 2, 4, 'rizkianusa@gmail.com', '2021-03-10', 1, 2000000, 'untuk wanita', 'BCA', '-', 'bayar', 'pending', 'pending');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `item_market`
--
ALTER TABLE `item_market`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `id_market` (`id_market`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `user_market`
--
ALTER TABLE `user_market`
  ADD PRIMARY KEY (`id_market`),
  ADD KEY `email` (`email`);

--
-- Indeks untuk tabel `user_transaksi`
--
ALTER TABLE `user_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `user_transaksi_ibfk_1` (`email`),
  ADD KEY `id_item` (`id_item`),
  ADD KEY `id_market` (`id_market`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `item_market`
--
ALTER TABLE `item_market`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user_market`
--
ALTER TABLE `user_market`
  MODIFY `id_market` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user_transaksi`
--
ALTER TABLE `user_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `item_market`
--
ALTER TABLE `item_market`
  ADD CONSTRAINT `item_market_ibfk_1` FOREIGN KEY (`id_market`) REFERENCES `user_market` (`id_market`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_market`
--
ALTER TABLE `user_market`
  ADD CONSTRAINT `user_market_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_transaksi`
--
ALTER TABLE `user_transaksi`
  ADD CONSTRAINT `user_transaksi_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_transaksi_ibfk_2` FOREIGN KEY (`id_item`) REFERENCES `item_market` (`id_item`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_transaksi_ibfk_3` FOREIGN KEY (`id_market`) REFERENCES `user_market` (`id_market`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
