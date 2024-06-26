CREATE TABLE `kategori` (
  `id_kategori` integer PRIMARY KEY AUTO_INCREMENT,
  `nama_kategori` varchar(255) NOT NULL,
  `created_at` timestamp
);

CREATE TABLE `barang` (
  `id_barang` integer PRIMARY KEY AUTO_INCREMENT,
  `id_kategori` integer NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `gambar` varchar(255),
  `harga_beli` decimal(10,2) NOT NULL,
  `harga_jual` decimal(10,2) NOT NULL,
  `created_at` timestamp
);

CREATE TABLE `role` (
  `id_role` integer PRIMARY KEY AUTO_INCREMENT,
  `nama_role` varchar(255) NOT NULL
);

CREATE TABLE `keranjang` (
  `id_keranjang` integer PRIMARY KEY AUTO_INCREMENT,
  `id_barang` integer NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `kuantitas` integer NOT NULL DEFAULT 1
);

CREATE TABLE `user` (
  `id_user` integer PRIMARY KEY AUTO_INCREMENT,
  `id_role` integer NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_telpon` varchar(255),
  `created_at` timestamp
);

CREATE TABLE `penjualan` (
  `id_penjualan` integer PRIMARY KEY AUTO_INCREMENT,
  `id_user` integer NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `tanggal_penjualan` date NOT NULL
);

CREATE TABLE `detail_penjualan` (
  `id_detail_penjualan` integer PRIMARY KEY AUTO_INCREMENT,
  `id_penjualan` integer NOT NULL,
  `id_barang` integer NOT NULL,
  `jumlah` integer NOT NULL,
  `harga_jual` decimal(10,2) NOT NULL
);

ALTER TABLE `penjualan` ADD FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

ALTER TABLE `detail_penjualan` ADD FOREIGN KEY (`id_penjualan`) REFERENCES `penjualan` (`id_penjualan`);

ALTER TABLE `detail_penjualan` ADD FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

ALTER TABLE `user` ADD FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);

ALTER TABLE `barang` ADD FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);

-- Insert data ke tabel role
INSERT INTO `role` (`nama_role`) VALUES
('Manager'),
('Kasir'),
('Stoker');

-- Insert data ke tabel kategori
INSERT INTO `kategori` (`nama_kategori`) VALUES
('Minyak'),
('Beras'),
('Snack');

-- Insert data ke tabel user
INSERT INTO `user` (`id_role`, `nama`, `email`, `password`, `no_telpon`) VALUES
(1, 'Manager', 'manager@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '123456789'), -- password: password
(2, 'Kasir', 'kasir@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '456123789'), -- password: password
(3, 'Stoker', 'stoker@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '456123789'); -- password: password

-- Insert data ke tabel barang
INSERT INTO `barang` (`id_kategori`, `nama_barang`, `harga_beli`, `harga_jual`) VALUES
(1, 'Minyak Goreng', 15000, 20000),
(1, 'Minyak Sayur', 12000, 15000),
(2, 'Beras Macan', 10000, 12000),
(2, 'Beras Pandan Wangi', 15000, 18000),
(3, 'Chitato', 5000, 7000),
(3, 'Lays', 6000, 8000);