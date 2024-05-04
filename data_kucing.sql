-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for sistem_pakar_db
CREATE DATABASE IF NOT EXISTS `sistem_pakar_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sistem_pakar_db`;

-- Dumping structure for table sistem_pakar_db.aturan
CREATE TABLE IF NOT EXISTS `aturan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_penyakit` int DEFAULT NULL,
  `id_gejala` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_penyakit` (`id_penyakit`),
  KEY `id_gejala` (`id_gejala`),
  CONSTRAINT `aturan_ibfk_1` FOREIGN KEY (`id_penyakit`) REFERENCES `penyakit` (`id`),
  CONSTRAINT `aturan_ibfk_2` FOREIGN KEY (`id_gejala`) REFERENCES `gejala` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sistem_pakar_db.aturan: ~28 rows (approximately)
INSERT INTO `aturan` (`id`, `id_penyakit`, `id_gejala`) VALUES
	(1, 1, 10),
	(2, 1, 12),
	(3, 1, 17),
	(4, 1, 19),
	(5, 2, 1),
	(6, 2, 2),
	(7, 2, 3),
	(8, 2, 4),
	(9, 2, 13),
	(10, 2, 14),
	(11, 2, 16),
	(12, 2, 18),
	(13, 3, 5),
	(14, 3, 6),
	(15, 3, 9),
	(16, 3, 15),
	(17, 3, 16),
	(18, 3, 17),
	(19, 3, 19),
	(20, 4, 11),
	(21, 4, 17),
	(22, 4, 19),
	(23, 5, 5),
	(24, 5, 7),
	(25, 5, 8),
	(26, 5, 9),
	(27, 5, 11),
	(28, 5, 17),
	(29, 5, 18),
	(30, 5, 19);

-- Dumping structure for table sistem_pakar_db.gejala
CREATE TABLE IF NOT EXISTS `gejala` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sistem_pakar_db.gejala: ~19 rows (approximately)
INSERT INTO `gejala` (`id`, `nama`) VALUES
	(1, 'Bulu rontok yang menyebabkan kebotakan'),
	(2, 'Ada kerak berwarna putih di sekitar daun telinga'),
	(3, 'Kulit terlihat bersisik'),
	(4, 'Gatal disekitar telinga'),
	(5, 'Sering menggoyangkan/menggelengkan kepala'),
	(6, 'Sering menggaruk telinga hingga terdapat luka '),
	(7, 'Muncul cairan yang berbau tidak sedap dari dalam telinga '),
	(8, 'Posisi kepala yang selalu miring-miring dan tidak mampu berjalan lurus '),
	(9, 'Mata belekan '),
	(10, 'Perut buncit tapi badan kurus'),
	(11, 'Diare'),
	(12, 'Keluar cacing saat muntah atau pada kotoran kucing'),
	(13, 'Ada kerontokan bulu yang berbentuk lingkaran'),
	(14, 'Sering menggaruk badan'),
	(15, 'Agresif (sering menggit dengan ganas)'),
	(16, 'Sensitif (Sering mencakar bila disentuh)'),
	(17, 'Tidak Nafsu Makan '),
	(18, 'Gelisah/suka bersembunyi/takut air'),
	(19, 'Lemas/lesu ');

-- Dumping structure for table sistem_pakar_db.penyakit
CREATE TABLE IF NOT EXISTS `penyakit` (
  `id` int NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sistem_pakar_db.penyakit: ~5 rows (approximately)
INSERT INTO `penyakit` (`id`, `nama`) VALUES
	(1, 'Cacingan'),
	(2, 'Ringworm (Dermatomikosis)'),
	(3, 'Ispa atau Flu Kucing'),
	(4, 'Gangguan Pencernaan (Leptospirosis)'),
	(5, 'Parasit (Scabiosis)');

-- Dumping structure for table sistem_pakar_db.solusi
CREATE TABLE IF NOT EXISTS `solusi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_penyakit` int DEFAULT NULL,
  `solusi` text,
  PRIMARY KEY (`id`),
  KEY `id_penyakit` (`id_penyakit`),
  CONSTRAINT `solusi_ibfk_1` FOREIGN KEY (`id_penyakit`) REFERENCES `penyakit` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sistem_pakar_db.solusi: ~5 rows (approximately)
INSERT INTO `solusi` (`id`, `id_penyakit`, `solusi`) VALUES
	(1, 1, 'Periksa ke dokter hewan untuk mendapatkan perawatan dan obat yang tepat.'),
	(2, 2, 'Berikan obat anti jamur, topikal dan oral sesuai rekomendasi dokter dan bersihkan lingkungan kucing secara menyeluruh.'),
	(3, 3, 'Berikan obat flu khusus kucing, jaga asupan minumnya, bersihkan mata dan hidungnya, buat nafsu makannya naik dan berikan kehangatan dan kenyamanan pada tempat tidurnya.'),
	(4, 4, 'Segera bawa ke VET terdekat untuk memberikan perawatan medis (antibiotik, cairan, perawaran intensif) guna membantu kucing melawan infeksi dan menjaganya tetap terhidrasi.'),
	(5, 5, 'Periksakan kucing ke dokter hewan untuk mendapat pengobatan medis dengan obat antiparasit, pembersihan kandang dan lingkungan, serta pisahkan kucing yang terinfeksi.');

-- Dumping structure for table sistem_pakar_db.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(50) NOT NULL,
  `nama_kucing` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sistem_pakar_db.user: ~1 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
