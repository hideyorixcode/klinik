/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.1.36-MariaDB : Database - db_klinik_pratama
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `jadwal` */

DROP TABLE IF EXISTS `jadwal`;

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `hari` enum('senin','selasa','rabu','kamis','jumat','sabtu','minggu') NOT NULL,
  `dari` varchar(10) NOT NULL,
  `sampai` varchar(10) DEFAULT NULL,
  `idpetugas_fk` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_jadwal`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `jadwal` */

insert  into `jadwal`(`id_jadwal`,`hari`,`dari`,`sampai`,`idpetugas_fk`,`active`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
(1,'senin','0802',NULL,37,1,'2020-11-04 20:39:36','2020-11-04 20:39:36',NULL,NULL),
(4,'senin','22:00','22:00',31,1,'2020-11-04 21:51:55','2020-11-04 21:51:55',NULL,NULL),
(5,'senin','22:00','23:00',31,1,'2020-11-04 21:52:08','2020-11-04 21:52:08',NULL,NULL),
(6,'senin','22:00','23:00',37,1,'2020-11-04 22:00:39','2020-11-04 22:18:10',NULL,NULL);

/*Table structure for table `konfigurasi` */

DROP TABLE IF EXISTS `konfigurasi`;

CREATE TABLE `konfigurasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(100) NOT NULL,
  `key` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `tipe` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `konfigurasi` */

insert  into `konfigurasi`(`id`,`label`,`key`,`content`,`tipe`) values 
(1,'LOGO','logo','1604156371_494fbc2c95a1aba1dc56.png','gambar'),
(2,'JUDUL','judul','Sistem Informasi Pelayanan Kesehatan','textfield'),
(3,'DESKRIPSI','deskripsi','Sistem yang dirancang untuk informasi kesehatan','textarea'),
(4,'KEYWORD','keyword','kesehatan, informasi','textfield'),
(5,'EMAIL','email','kesehatan@gmail.com','email'),
(6,'NO TELP','notelepon','06867897','number'),
(7,'NAMA APP','nama_app','SIKAMPRET','textfield'),
(8,'ALAMAT','alamat','Jl. Wolter Monginsidi No.69','textarea'),
(9,'AUTHOR','author','Hideyori','textfield'),
(10,'AREA','area','BANDAR LAMPUNG','textfield'),
(11,'FAVICON','favicon','1604156371_39b65bcd0f049e791bed.ico','favicon');

/*Table structure for table `log` */

DROP TABLE IF EXISTS `log`;

CREATE TABLE `log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `log_id_user` int(11) unsigned NOT NULL,
  `log_description` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`log_id`),
  KEY `log_id_user` (`log_id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=740 DEFAULT CHARSET=latin1;

/*Data for the table `log` */

insert  into `log`(`log_id`,`log_time`,`log_id_user`,`log_description`) values 
(727,'2020-11-03 16:02:47',1,'superadmin Menambah Data Poli yrd'),
(728,'2020-11-04 20:39:37',1,'superadmin Menginput Data Jadwal senin'),
(729,'2020-11-04 20:44:10',1,'superadmin Menginput Data Jadwal kamis'),
(730,'2020-11-04 20:58:44',1,'superadmin Menginput Data Jadwal kamis'),
(731,'2020-11-04 21:08:18',1,'superadmin Menonaktifkan kamis, 23432 - angga'),
(732,'2020-11-04 21:08:28',1,'superadmin Mengaktifkan kamis, 0802 - angga'),
(733,'2020-11-04 21:08:34',1,'superadmin menghapus data Jadwal kamis, 0802 - angga'),
(734,'2020-11-04 21:08:37',1,'superadmin menghapus data Jadwal kamis, 23432 - angga'),
(735,'2020-11-04 21:51:55',1,'superadmin Menginput Data Jadwal '),
(736,'2020-11-04 21:52:08',1,'superadmin Menginput Data Jadwal '),
(737,'2020-11-04 22:00:39',1,'superadmin Menginput Data Jadwal '),
(738,'2020-11-04 22:17:44',1,'superadmin Mengubah Data Jadwal'),
(739,'2020-11-04 22:18:10',1,'superadmin Mengubah Data Jadwal');

/*Table structure for table `pengguna` */

DROP TABLE IF EXISTS `pengguna`;

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `password` text NOT NULL,
  `notelepon` varchar(16) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `active` tinyint(4) DEFAULT '1',
  `level` enum('admin','dokter','bidan','pasien','pimpinan') DEFAULT NULL,
  `id_poli_fk` int(11) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `jk` enum('pria','wanita') DEFAULT 'pria',
  `tgl_lahir` date DEFAULT '1990-01-01',
  `deskripsi` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kelurahan_fk` (`id_poli_fk`),
  CONSTRAINT `pengguna_ibfk_1` FOREIGN KEY (`id_poli_fk`) REFERENCES `poli` (`id_poli`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pengguna` */

insert  into `pengguna`(`id`,`username`,`nama`,`password`,`notelepon`,`avatar`,`email`,`active`,`level`,`id_poli_fk`,`alamat`,`jk`,`tgl_lahir`,`deskripsi`,`created_at`,`updated_at`) values 
(1,'superadmin','Edi Maryanto','$2y$10$3NVP6DZi7rs919bi6uxvteQJvNlv9Qp/1E3BhX4XjfJC1ATWKDP1u','0804328','1604159317_39da846aa8ef988002a9.png','super@lampungprov.go.id',1,'admin',NULL,'Teluk','pria','1990-05-25','<h3 style=\"margin: 15px 0px; padding: 0px; font-weight: 700; font-size: 14px; font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;\"=\"\">The standard Lorem Ipsum passage, used since the 1500s</h3><p style=\"margin-bottom: 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><ol><li style=\"margin-bottom: 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0);\">fasdfdf</li><li style=\"margin-bottom: 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0);\">asdfasdf</li><li style=\"margin-bottom: 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0);\">asdfasdf</li></ol>','2020-07-19 09:10:40','2020-10-31 22:48:37'),
(31,'sandi','angga','$2y$10$7HBDvgHT.m7nMlSlIPKzIewXcNsueokEFHewljvj4nL0GJ6DmCc86','234234','','angga@gmail.com',1,'dokter',61,NULL,NULL,'1990-01-01',NULL,'2020-09-10 06:55:11','2020-09-10 07:20:44'),
(32,'rio','rio','$2y$10$nbRmcLdbza/QQyZHnobdvOQq2CYYUb6GBZm6mBKsI0GGkYM1.GVee','080','','rio@gmail.com',1,'admin',NULL,NULL,'pria','1990-01-01',NULL,'2020-11-01 08:19:22','2020-11-01 08:26:47'),
(33,'wew','wew','$2y$10$zKJwSpT0PEId2/Q3yL/mke2uC5JOskK.yNzD05GGU2W/BfMWz5Vf.','078','','wew@gmail.com',1,'admin',NULL,NULL,'pria','1990-01-01',NULL,'2020-11-01 08:19:34','2020-11-01 08:26:47'),
(36,'test1','Hei ya','$2y$10$uK5pMcDyxNP6W/OPJcPuluKxOVuGT1Ih84Mn3fXeuAtUNCFSYqFP2','23','1604207744_38d7a304f67987004b81.png','hideyorixcodexx@gmail.com',1,'bidan',1,'asdf','wanita','2020-11-23','<p>asdfasf</p>','2020-11-01 12:15:44','2020-11-01 12:15:44'),
(37,'angga','angga','$2y$10$gVx4411ARX0Ih8I7iyxqSu0gaPiWmCdpISgjEgaBON3vXuOX5TNle','32423','1604210511_78a8f218f683ce7a8d2d.png','anggaxx@gmail.com',1,'dokter',1,'anggaxx','pria','1990-04-26','<p>asdf</p>','2020-11-01 12:17:33','2020-11-01 13:01:51'),
(38,'arif','fasdfsadf','$2y$10$cyTq5sgNsCYR4V3WA0vWCuZoT925r3leWO59vvjhKrnK646lNNOvS','234','1604208138_635b2b73103287c91dbd.png','asdfasdf@gmail.com',0,'bidan',1,'dfsa','pria','2019-11-23','<p>asdf</p>','2020-11-01 12:22:18','2020-11-01 12:42:11'),
(39,'rudi','sadf','$2y$10$ARiwMKtKrJw9lqMZBPwkOuO24U5tWCypGWSbV0Y9t3s32.oiufaUW','234','','rudi@gmail.com',1,'dokter',10,'safdsdfds','pria','2020-11-23','<p>asdf</p>','2020-11-01 12:59:46','2020-11-01 13:01:35');

/*Table structure for table `poli` */

DROP TABLE IF EXISTS `poli`;

CREATE TABLE `poli` (
  `id_poli` int(11) NOT NULL AUTO_INCREMENT,
  `nama_poli` varchar(150) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT '1',
  `updated_by` int(11) DEFAULT '1',
  PRIMARY KEY (`id_poli`)
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=utf8mb4;

/*Data for the table `poli` */

insert  into `poli`(`id_poli`,`nama_poli`,`active`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
(1,'Padang Ratu',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(2,'Pampangan',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(3,'Cipadang',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(4,'Way Layap',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(5,'Sukadadi',0,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(6,'Gedung Tataan',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(7,'Bagelen',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(8,'Sukaraja',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(9,'Kebagusan',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(10,'Sungai Langka',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(11,'Kurungan Nyawa',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(12,'Negeri Sakti',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(13,'Bernung',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(14,'Suka Banjar',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(15,'Wiyono',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(16,'Taman Sari',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(17,'Bogorejo',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(18,'Karang Anyar',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(19,'Kutoarjo',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(20,'Kagungan Ratu',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(21,'Kali Rejo',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(22,'Purworejo',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(23,'Pujo Rahayu',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(24,'Negeri Katon',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(25,'Ponco Kresno',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(26,'Halangan Ratu',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(27,'Pejambon',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(28,'Negara Saka',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(29,'Sinar Bandung',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(30,'Tanjung Rejo',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(31,'Rowo Rejo',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(32,'Tresno Maju',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(33,'Sidomulyo',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(34,'Lumbirejo',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(35,'Tri Rahayu',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(36,'Bangun Sari',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(37,'Karang Rejo',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(38,'Negeri Ulangan Jaya',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(39,'Bumi Agung',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(40,'Kejadian',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(41,'Batang Hari Ogan',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(42,'Negea Ratu Wates',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(43,'Gunung Sugih Baru',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(44,'Gedung Gumanti',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(45,'Kresno Widodo',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(46,'Sinarjati',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(47,'Margo Rejo',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(48,'Gerning',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(49,'Panca Bakti',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(50,'Margo Mulyo',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(51,'Rejo Agung',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(52,'Kota Agung',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(53,'Trimulyo',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(54,'Sriwedari',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(55,'Padang Manis',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(56,'Banjar Negeri',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(57,'Sidodadi',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(58,'Pekondoh Gedung',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(59,'Pekondoh',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(60,'Kota Dalam',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(61,'Tanjung Agung',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(62,'Gedong Dalam',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(63,'Sindang Garut',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(64,'Baturaja',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(65,'Way Harong',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(66,'Gunung Rejo',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(67,'Margodadi',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(68,'Cimanuk',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(69,'Sukamandi',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(70,'Paguyuban',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(71,'Banjaran',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(72,'Durian',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(73,'Hanau Berak',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(74,'Paya',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(75,'Padang Cermin',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(76,'Sanggi',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(77,'Tambangan',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(78,'Way Urang',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(79,'Khepong Jaya',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(80,'Trimulyo',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(81,'Gayau',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(82,'Bawang',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(83,'Banding Agung',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(84,'Batu Raja',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(85,'Sukajaya Pidada',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(86,'Rubasa',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(87,'Kota Jawa',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(88,'Sukarame',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(89,'Pagar Jaya',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(90,'Pulau Legundi',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(91,'Suka Maju',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(92,'Bangun Rejo',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(93,'Way Kepayang',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(94,'Suka Maju',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(95,'Kedondong',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(96,'Pasar Baru',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(97,'Tempel Rejo',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(98,'Kertasana',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(99,'Gunung Sugih',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(100,'Sinar Harapan',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(101,'Teba Jawa',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(102,'Babakan Loa',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(103,'Pesawaran Indah',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(104,'Harapan Jaya',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(105,'Tanjung Rejo',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(106,'Sukajaya Punduh',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(107,'Maja',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(108,'Penyandingan',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(109,'Tajur',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(111,'Pekon Ampai',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(112,'Kunyaian',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(113,'Kekatang',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(114,'Kampung Baru',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(115,'Pulau Pahawang',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(116,'Penengahan',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(117,'Suka Jaya',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(119,'Bayas Jaya',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(120,'Tanjung Kerta',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(121,'Kota Jawa',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(122,'Gunung Sari',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(123,'Mada Jaya',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(124,'Kubu Batu',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(125,'Batu Menyan',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(126,'Cilimus',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(127,'Gebang',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(128,'Hanura',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(130,'Munca',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(132,'Sukajaya Lempasing',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(134,'Tanjung Agung',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(136,'Bunut Seberang',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(137,'Wates Way Ratai',1,'2020-07-07 20:47:21','2020-07-07 20:47:21',1,1),
(138,'Ceringin Sari',1,'2020-07-07 20:47:21','2020-11-01 11:14:10',1,1),
(139,'tesx',1,'2020-11-01 11:12:05','2020-11-01 11:14:10',1,1),
(140,'yrd',1,'2020-11-03 16:02:47','2020-11-03 16:02:47',1,1);

/*Table structure for table `vjadwal` */

DROP TABLE IF EXISTS `vjadwal`;

/*!50001 DROP VIEW IF EXISTS `vjadwal` */;
/*!50001 DROP TABLE IF EXISTS `vjadwal` */;

/*!50001 CREATE TABLE  `vjadwal`(
 `id_jadwal` int(11) ,
 `hari` enum('senin','selasa','rabu','kamis','jumat','sabtu','minggu') ,
 `dari` varchar(10) ,
 `sampai` varchar(10) ,
 `active` tinyint(1) ,
 `idpetugas_fk` varchar(11) ,
 `nama_petugas` varchar(150) ,
 `level` enum('admin','dokter','bidan','pasien','pimpinan') ,
 `id_poli_fk` varchar(11) ,
 `nama_poli` varchar(150) ,
 `created_at` timestamp ,
 `updated_at` timestamp 
)*/;

/*Table structure for table `vpengguna` */

DROP TABLE IF EXISTS `vpengguna`;

/*!50001 DROP VIEW IF EXISTS `vpengguna` */;
/*!50001 DROP TABLE IF EXISTS `vpengguna` */;

/*!50001 CREATE TABLE  `vpengguna`(
 `id` int(11) ,
 `username` varchar(50) ,
 `nama` varchar(150) ,
 `password` text ,
 `notelepon` varchar(16) ,
 `avatar` varchar(255) ,
 `email` varchar(255) ,
 `active` tinyint(4) ,
 `level` enum('admin','dokter','bidan','pasien','pimpinan') ,
 `alamat` varchar(255) ,
 `jk` enum('pria','wanita') ,
 `tgl_lahir` date ,
 `deskripsi` text ,
 `id_poli_fk` varchar(11) ,
 `nama_poli` varchar(150) ,
 `created_at` timestamp ,
 `updated_at` timestamp 
)*/;

/*View structure for view vjadwal */

/*!50001 DROP TABLE IF EXISTS `vjadwal` */;
/*!50001 DROP VIEW IF EXISTS `vjadwal` */;

/*!50001 CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vjadwal` AS select `jadwal`.`id_jadwal` AS `id_jadwal`,`jadwal`.`hari` AS `hari`,`jadwal`.`dari` AS `dari`,`jadwal`.`sampai` AS `sampai`,`jadwal`.`active` AS `active`,ifnull(`jadwal`.`idpetugas_fk`,'-') AS `idpetugas_fk`,ifnull(`vpengguna`.`nama`,'-') AS `nama_petugas`,`vpengguna`.`level` AS `level`,ifnull(`vpengguna`.`id_poli_fk`,'-') AS `id_poli_fk`,ifnull(`vpengguna`.`nama_poli`,'-') AS `nama_poli`,`jadwal`.`created_at` AS `created_at`,`jadwal`.`updated_at` AS `updated_at` from (`jadwal` left join `vpengguna` on((`jadwal`.`idpetugas_fk` = `vpengguna`.`id`))) */;

/*View structure for view vpengguna */

/*!50001 DROP TABLE IF EXISTS `vpengguna` */;
/*!50001 DROP VIEW IF EXISTS `vpengguna` */;

/*!50001 CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vpengguna` AS select `pengguna`.`id` AS `id`,`pengguna`.`username` AS `username`,`pengguna`.`nama` AS `nama`,`pengguna`.`password` AS `password`,`pengguna`.`notelepon` AS `notelepon`,`pengguna`.`avatar` AS `avatar`,`pengguna`.`email` AS `email`,`pengguna`.`active` AS `active`,`pengguna`.`level` AS `level`,`pengguna`.`alamat` AS `alamat`,`pengguna`.`jk` AS `jk`,`pengguna`.`tgl_lahir` AS `tgl_lahir`,`pengguna`.`deskripsi` AS `deskripsi`,ifnull(`pengguna`.`id_poli_fk`,'-') AS `id_poli_fk`,ifnull(`poli`.`nama_poli`,'-') AS `nama_poli`,`pengguna`.`created_at` AS `created_at`,`pengguna`.`updated_at` AS `updated_at` from (`pengguna` left join `poli` on((`pengguna`.`id_poli_fk` = `poli`.`id_poli`))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
