-- Database: dbpersonal
-- Personal Home Page - Tugas Pemrograman Web

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
SET NAMES utf8mb4;

-- Database
CREATE DATABASE IF NOT EXISTS `dbpersonal`;
USE `dbpersonal`;

-- --------------------------------------------------------
-- Tabel: member (untuk login)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('admin','staff') NOT NULL DEFAULT 'staff',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `member` (`username`, `password`, `role`) VALUES
('admin', SHA1(MD5('admin123')), 'admin'),
('staff1', SHA1(MD5('staff123')), 'staff');

-- --------------------------------------------------------
-- Tabel: level (jenjang pendidikan: TK, SD, SMP, dst)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `level` (`id`, `nama`) VALUES
(1, 'TK'),
(2, 'SD'),
(3, 'SMP'),
(4, 'SMA'),
(5, 'D3'),
(6, 'S1');

-- --------------------------------------------------------
-- Tabel: studies (riwayat pendidikan)
-- Fields: id, nama, idlevel (FK ke level), keterangan, tahun_lulus, foto_sekolah
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `studies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `idlevel` int(11) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `tahun_lulus` int(4) DEFAULT NULL,
  `foto_sekolah` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`idlevel`) REFERENCES `level`(`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `studies` (`nama`, `idlevel`, `keterangan`, `tahun_lulus`, `foto_sekolah`) VALUES
('TK Harapan Bangsa', 1, 'Pendidikan dasar anak usia dini', 2009, NULL),
('SDN 01 Jakarta', 2, 'Sekolah Dasar Negeri terbaik di kecamatan', 2015, NULL),
('SMPN 02 Jakarta', 3, 'Lulus dengan nilai memuaskan', 2018, NULL),
('SMAN 03 Jakarta', 4, 'Jurusan IPA, Ekskul: Robotik & Paskibra', 2021, NULL),
('Universitas Contoh', 6, 'Program Studi Teknik Informatika, Semester 4', NULL, 'sttnf.png');

COMMIT;
