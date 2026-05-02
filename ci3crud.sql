CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `semester` tinyint(2) NOT NULL,
  `ipk` decimal(3,2) NOT NULL DEFAULT '0.00',
  `status` enum('Aktif','Cuti','Lulus','DO') NOT NULL DEFAULT 'Aktif',
  `foto` varchar(255) DEFAULT 'default.png',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `mahasiswa` (`nim`, `nama`, `email`, `jurusan`, `semester`, `ipk`, `status`) VALUES
('2021001', 'Andi Pratama', 'andi@email.com', 'Teknik Informatika', 5, 3.75, 'Aktif'),
('2021002', 'Sari Dewi', 'sari@email.com', 'Sistem Informasi', 3, 3.50, 'Aktif'),
('2021003', 'Budi Santoso', 'budi@email.com', 'Teknik Elektro', 7, 3.20, 'Aktif');