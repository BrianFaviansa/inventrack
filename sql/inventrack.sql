CREATE TABLE `kategori` (
  `id_kategori` integer PRIMARY KEY AUTO_INCREMENT,
  `nama_kategori` varchar(255) NOT NULL,
  `created_at` timestamp
);

CREATE TABLE `barang` (
  `id_barang` integer PRIMARY KEY AUTO_INCREMENT,
  `id_kategori` integer NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `stok` integer NOT NULL,
  `harga_beli` decimal(10,2) NOT NULL,
  `harga_jual` decimal(10,2) NOT NULL,
  `status` integer DEFAULT 0,
  `created_at` timestamp
);

CREATE TABLE `role` (
  `id_role` integer PRIMARY KEY AUTO_INCREMENT,
  `nama_role` varchar(255) NOT NULL
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
  `created_at` timestamp
);

CREATE TABLE `detail_penjualan` (
  `id_detail_penjualan` integer PRIMARY KEY AUTO_INCREMENT,
  `id_penjualan` integer NOT NULL,
  `id_barang` integer NOT NULL,
  `jumlah` integer NOT NULL,
  `harga_jual` decimal(10,2) NOT NULL,
  `created_at` timestamp
);

ALTER TABLE `penjualan` ADD FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

ALTER TABLE `detail_penjualan` ADD FOREIGN KEY (`id_penjualan`) REFERENCES `penjualan` (`id_penjualan`);

ALTER TABLE `detail_penjualan` ADD FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

ALTER TABLE `user` ADD FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);

ALTER TABLE `barang` ADD FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);
