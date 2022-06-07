/*
SQLyog Enterprise v13.1.1 (64 bit)
MySQL - 10.4.24-MariaDB : Database - data_kampus
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`data_kampus` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `data_kampus`;

/*Table structure for table `mahasiswa` */

DROP TABLE IF EXISTS `mahasiswa`;

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `nilai_ipk` float NOT NULL,
  `grade` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `mahasiswa` */

insert  into `mahasiswa`(`id`,`nama`,`alamat`,`jurusan`,`nilai_ipk`,`grade`) values 
(2,'Budiman','Jl. Panda No. 13','Informatika',3.1,''),
(3,'Budi','Jalan Piranha No. 83','Sistem Informasi',2.6,''),
(4,'Chika','Jalan Sudirman No. 891','Sistem Informasi',3.2,''),
(5,'Darwin','Jalan Cokro No. 73','Informatika',3.6,''),
(6,'Edra','Jalan Cendana No. 92','Sistem Informasi',3.5,''),
(7,'Budiyanto','bandung','Teknik Sipil',3,''),
(8,'Luiz','Bandung','Ilmu Komunikasi',4,'');

/* Procedure structure for procedure `tabelMahasiswa` */

/*!50003 DROP PROCEDURE IF EXISTS  `tabelMahasiswa` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `tabelMahasiswa`()
BEGIN
    SELECT nama, alamat, jurusan, nilai_ipk,
    CASE
    WHEN nilai_ipk >= 2.00 AND nilai_ipk <= 2.75 THEN 'Memuaskan'
        WHEN nilai_ipk > 2.75 AND nilai_ipk <= 3.50 THEN 'Sangat Memuaskan'
        WHEN nilai_ipk > 3.50 AND nilai_ipk <= 4.00 THEN 'Cum Laude'
    END AS grade
    FROM mahasiswa;
END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
