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
/*Table structure for table `daftar` */

DROP TABLE IF EXISTS `daftar`;

CREATE TABLE `daftar` (
  `id_daftar` int(11) NOT NULL AUTO_INCREMENT,
  `id_pasien_fk` int(11) NOT NULL,
  `id_jadwal_fk` int(11) DEFAULT NULL,
  `tgl_daftar` date DEFAULT NULL,
  `layanan` enum('Rekam Medis','Konsultasi','Pembuatan Surat') DEFAULT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  `nomor_urut` int(11) DEFAULT NULL,
  `status` enum('tunda','batal','proses','selesai') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT '1',
  `updated_by` int(11) DEFAULT '1',
  PRIMARY KEY (`id_daftar`),
  KEY `id_jadwal_fk` (`id_jadwal_fk`),
  KEY `id_pasien_fk` (`id_pasien_fk`),
  CONSTRAINT `daftar_ibfk_1` FOREIGN KEY (`id_jadwal_fk`) REFERENCES `jadwal` (`id_jadwal`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `daftar_ibfk_2` FOREIGN KEY (`id_pasien_fk`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `daftar` */

insert  into `daftar`(`id_daftar`,`id_pasien_fk`,`id_jadwal_fk`,`tgl_daftar`,`layanan`,`keterangan`,`nomor_urut`,`status`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
(7,49,12,'2020-11-27','Rekam Medis','',1,'selesai','2020-11-12 11:08:11','2020-11-13 06:44:57',49,49),
(8,49,11,'2020-11-29','Konsultasi','asdfadsf',1,'selesai','2020-11-12 16:05:45','2020-11-13 11:02:52',49,49),
(9,49,11,'2020-12-01','Pembuatan Surat','eqweqew',1,'selesai','2020-11-12 16:35:09','2020-11-13 08:09:25',49,49);

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
  PRIMARY KEY (`id_jadwal`),
  KEY `idpetugas_fk` (`idpetugas_fk`),
  CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`idpetugas_fk`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

/*Data for the table `jadwal` */

insert  into `jadwal`(`id_jadwal`,`hari`,`dari`,`sampai`,`idpetugas_fk`,`active`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
(11,'kamis','11:15','14:00',50,1,'2020-11-12 11:06:37','2020-11-12 11:06:37',NULL,NULL),
(12,'selasa','12:15','13:15',51,1,'2020-11-12 11:07:47','2020-11-12 11:07:47',NULL,NULL);

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
(1,'LOGO','logo','1604719652_2150ace49c061c32a2ad.png','gambar'),
(2,'JUDUL','judul','SISTEM INFORMASI LAYANAN KESEHATAN ','textfield'),
(3,'DESKRIPSI','deskripsi','Klinik Pratama & Bersalin WeDe Ar Rachman merupakan pengembangan dari Balai Pengobatan (BP) Ar Rachman yang melayani pelayanan kesehatan umum & bersalin yang dirintis oleh Bidan Dasa Susilawati sejak tahun 2001 yang beralamat di Jalan Danau Toba Gang Saburai No. 9 Gunung Sulah Kecamatan Way Halim  Bandar Lampung.\r\nSeiring berjalannya waktu & perubahan sistem kesehatan yang ada di Indonesia BP Ar Rachman yang telah bertransformasi menjadi Klinik Pratama & Bersalin WeDe Ar Rachman berkomitmen untuk memberikan pelayanan kesehatan terbaik untuk keluarga Indonesia khususnya wilayah Bandar Lampung. Kami memiliki fasilitas pelayanan poli umum, poli gigi, laboratorium kesehatan, pemeriksaan kehamilan (ANC), imunisasi bayi, kamar bersalin dan kamar perawatan yang terdiri dari kelas VIP, VVIP, I, II, dan III dengan total kapasitas 13 tempat tidur. Rata-rata kunjungan rawat jalan 80 pasien (44% peserta BPJS) per hari dan 70 pasien (38% peserta BPJS) melahirkan setiap bulannya. Sejak tahun 2016 Klinik Pratama & Bersalin Wede Ar Rachman telah berkerjasama dengan BPJS untuk ikut berperan dalam pembangunan nasional berwawasan kesehatan.','textarea'),
(4,'KEYWORD','keyword','kesehatan, informasi','textfield'),
(5,'EMAIL','email','kesehatan@gmail.com','email'),
(6,'NO TELP','notelepon','081394673021','number'),
(7,'NAMA APP','nama_app','SI-LAKES','textfield'),
(8,'ALAMAT','alamat','Gg. Saburai No.9, Gn. Sulah, Way Halim, Kota Bandar Lampung, Lampung 35122','textarea'),
(9,'AUTHOR','author','Hideyori','textfield'),
(10,'AREA','area','Klinik Pratama & Bersalin WeDe Ar Rachman','textfield'),
(11,'FAVICON','favicon','1604719748_b0539300bb472d0475aa.ico','favicon');

/*Table structure for table `konsultasi` */

DROP TABLE IF EXISTS `konsultasi`;

CREATE TABLE `konsultasi` (
  `id_konsultasi` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_konsultasi` varchar(20) NOT NULL,
  `id_daftar_fk` int(11) NOT NULL,
  `tgl_konsultasi` date DEFAULT NULL,
  `diagnosis` varchar(150) DEFAULT NULL,
  `saran` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_konsultasi`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `konsultasi` */

insert  into `konsultasi`(`id_konsultasi`,`nomor_konsultasi`,`id_daftar_fk`,`tgl_konsultasi`,`diagnosis`,`saran`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
(3,'K09',8,'2020-11-29','SDF','ASF','2020-11-12 16:09:53','2020-11-12 16:09:53',1,1);

/*Table structure for table `log` */

DROP TABLE IF EXISTS `log`;

CREATE TABLE `log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `log_id_user` int(11) unsigned NOT NULL,
  `log_description` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`log_id`),
  KEY `log_id_user` (`log_id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=826 DEFAULT CHARSET=latin1;

/*Data for the table `log` */

insert  into `log`(`log_id`,`log_time`,`log_id_user`,`log_description`) values 
(764,'2020-11-11 21:20:03',45,'dalu Berhasil Registrasi sebagai pasien'),
(765,'2020-11-11 21:27:54',1,'superadmin merubah data ING DALU'),
(766,'2020-11-11 21:28:00',1,'superadmin merubah data ING DALU'),
(767,'2020-11-11 21:54:40',46,'zenuciwaxo Berhasil Registrasi sebagai pasien'),
(768,'2020-11-11 21:55:33',47,'byjabujoxy Berhasil Registrasi sebagai pasien'),
(769,'2020-11-11 21:55:43',1,'superadmin menghapus data Commodi enim archite'),
(770,'2020-11-11 21:55:43',1,'superadmin menghapus data ING DALU'),
(771,'2020-11-11 22:09:51',1,'superadmin merubah data Aliquip esse ab qui '),
(772,'2020-11-11 22:10:00',1,'superadmin merubah data Aliquip esse ab qui '),
(773,'2020-11-11 22:10:59',1,'superadmin merubah data Aliquip esse ab qui '),
(774,'2020-11-11 22:11:03',1,'superadmin merubah data Aliquip esse ab qui '),
(775,'2020-11-11 22:11:50',1,'superadmin merubah data Aliquip esse ab qui '),
(776,'2020-11-12 05:00:20',48,'ngehek Berhasil Registrasi sebagai pasien'),
(777,'2020-11-12 05:33:27',0,'ngehek merubah data pribadi'),
(778,'2020-11-12 05:36:02',0,'jaziqy merubah data pribadi'),
(779,'2020-11-12 07:56:15',49,'ngehek Berhasil Registrasi sebagai pasien'),
(780,'2020-11-12 10:02:39',1,'ngehek Berhasil Daftar Layanan Konsultasi'),
(781,'2020-11-12 10:03:26',2,'ngehek Berhasil Daftar Layanan Konsultasi'),
(782,'2020-11-12 10:15:12',3,'ngehek Berhasil Daftar Layanan Pembuatan Surat'),
(783,'2020-11-12 10:15:33',4,'ngehek Berhasil Daftar Layanan Rekam Medis'),
(784,'2020-11-12 10:17:02',5,'ngehek Berhasil Daftar Layanan Konsultasi'),
(785,'2020-11-12 10:17:46',6,'ngehek Berhasil Daftar Layanan Rekam Medis'),
(786,'2020-11-12 11:03:08',1,'superadmin menghapus data angga'),
(787,'2020-11-12 11:03:08',1,'superadmin menghapus data Hei ya'),
(788,'2020-11-12 11:03:08',1,'superadmin menghapus data angga'),
(789,'2020-11-12 11:03:09',1,'superadmin menghapus data fasdfsadf'),
(790,'2020-11-12 11:03:09',1,'superadmin menghapus data sadf'),
(791,'2020-11-12 11:04:24',1,'superadmin Menginput Data Petugas Kesehatan dr. Angga'),
(792,'2020-11-12 11:04:31',1,'superadmin menghapus data Jadwal senin, 10:30-10:30 [-]'),
(793,'2020-11-12 11:04:31',1,'superadmin menghapus data Jadwal senin, 10:30-10:30 [-]'),
(794,'2020-11-12 11:06:37',1,'superadmin Menginput Data Jadwal '),
(795,'2020-11-12 11:07:31',1,'superadmin Menginput Data Petugas Kesehatan dr. Ana'),
(796,'2020-11-12 11:07:47',1,'superadmin Menginput Data Jadwal '),
(797,'2020-11-12 11:08:11',7,'ngehek Berhasil Daftar Layanan Rekam Medis'),
(798,'2020-11-12 12:50:01',1,'superadmin Mengubah Data Status Permintaan Layanan'),
(799,'2020-11-12 12:51:03',1,'superadmin Mengubah Data Status Permintaan Layanan'),
(800,'2020-11-12 12:51:27',1,'superadmin Mengubah Data Status Permintaan Layanan'),
(801,'2020-11-12 13:57:25',1,'superadmin Menginput Data Rekam Medis fasc'),
(802,'2020-11-12 13:59:47',1,'superadmin Menginput Data Rekam Medis fd233'),
(803,'2020-11-12 15:41:51',1,'superadmin Mengubah Data Rekam Medis FR43'),
(804,'2020-11-12 15:44:34',1,'superadmin Mengubah Data Rekam Medis FR43'),
(805,'2020-11-12 16:05:45',8,'ngehek Berhasil Daftar Layanan Konsultasi'),
(806,'2020-11-12 16:08:26',1,'superadmin Mengubah Data Konsultasi K001'),
(807,'2020-11-12 16:09:13',1,'superadmin Menginput Data Konsultasi K08'),
(808,'2020-11-12 16:09:53',1,'superadmin Menginput Data Konsultasi K09'),
(809,'2020-11-12 16:35:09',9,'ngehek Berhasil Daftar Layanan Pembuatan Surat'),
(810,'2020-11-12 17:02:38',1,'superadmin Menginput Data Surat '),
(811,'2020-11-12 17:05:01',1,'superadmin Menginput Data Surat '),
(812,'2020-11-13 05:34:44',1,'superadmin Menginput Data Surat '),
(813,'2020-11-13 05:41:02',1,'superadmin Menginput Data Surat '),
(814,'2020-11-13 05:43:13',1,'superadmin Menginput Data Surat '),
(815,'2020-11-13 06:02:24',52,'rusdi Berhasil Registrasi sebagai pasien'),
(816,'2020-11-13 06:08:17',0,'rusdi merubah data pribadi'),
(817,'2020-11-13 06:20:58',1,'superadmin merubah data Hic dignissimos sapi'),
(818,'2020-11-13 06:42:59',1,'superadmin Mengubah Data Rekam Medis FR43'),
(819,'2020-11-13 06:44:57',1,'superadmin Menginput Data Rekam Medis RJ33'),
(820,'2020-11-13 07:30:45',1,'superadmin Mengubah Data Surat '),
(821,'2020-11-13 08:09:25',1,'superadmin Mengubah Data Surat '),
(822,'2020-11-13 10:01:11',53,'alucard Berhasil Registrasi sebagai pasien'),
(823,'2020-11-13 11:02:42',50,'angga Mengubah Data Status Permintaan Layanan'),
(824,'2020-11-13 11:02:52',50,'angga Mengubah Data Status Permintaan Layanan'),
(825,'2020-11-13 11:13:50',1,'superadmin Menginput Data Petugas Kesehatan Officiis quis dolor ');

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
  `gol_darah` enum('-','A','B','AB','O') DEFAULT '-',
  `tinggi_badan` int(11) DEFAULT NULL,
  `berat_badan` int(11) DEFAULT NULL,
  `bpjs` enum('-','YA','TIDAK') DEFAULT '-',
  `nama_kk` varchar(150) DEFAULT NULL,
  `pekerjaan` varchar(100) DEFAULT NULL,
  `agama` enum('Islam','Kristen','Katholik','Hindu','Budha','Konghucu') DEFAULT NULL,
  `deskripsi` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kelurahan_fk` (`id_poli_fk`),
  CONSTRAINT `pengguna_ibfk_1` FOREIGN KEY (`id_poli_fk`) REFERENCES `poli` (`id_poli`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pengguna` */

insert  into `pengguna`(`id`,`username`,`nama`,`password`,`notelepon`,`avatar`,`email`,`active`,`level`,`id_poli_fk`,`alamat`,`jk`,`tgl_lahir`,`gol_darah`,`tinggi_badan`,`berat_badan`,`bpjs`,`nama_kk`,`pekerjaan`,`agama`,`deskripsi`,`created_at`,`updated_at`) values 
(1,'superadmin','Edi Maryanto','$2y$10$3NVP6DZi7rs919bi6uxvteQJvNlv9Qp/1E3BhX4XjfJC1ATWKDP1u','0804328','1604159317_39da846aa8ef988002a9.png','super@lampungprov.go.id',1,'admin',NULL,'Teluk','pria','1990-05-25',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'<h3 style=\"margin: 15px 0px; padding: 0px; font-weight: 700; font-size: 14px; font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;\"=\"\">The standard Lorem Ipsum passage, used since the 1500s</h3><p style=\"margin-bottom: 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><ol><li style=\"margin-bottom: 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0);\">fasdfdf</li><li style=\"margin-bottom: 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0);\">asdfasdf</li><li style=\"margin-bottom: 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0);\">asdfasdf</li></ol>','2020-07-19 09:10:40','2020-10-31 22:48:37'),
(32,'rio','rio','$2y$10$nbRmcLdbza/QQyZHnobdvOQq2CYYUb6GBZm6mBKsI0GGkYM1.GVee','080','','rio@gmail.com',1,'pimpinan',NULL,NULL,'pria','1990-01-01',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-11-01 08:19:22','2020-11-13 10:21:03'),
(33,'wew','wew','$2y$10$zKJwSpT0PEId2/Q3yL/mke2uC5JOskK.yNzD05GGU2W/BfMWz5Vf.','078','','wew@gmail.com',1,'admin',NULL,NULL,'pria','1990-01-01',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-11-01 08:19:34','2020-11-01 08:26:47'),
(47,'byjabujoxy','Aliquip esse ab qui ','$2y$10$xBB8GBPBLsOAYriiYC0Bmu8/ov50KKgTUeLeZ86Lx2cAMYv3CyG.6','Voluptatum non','','hiqehe@mailinator.com',1,'pasien',NULL,'Totam rerum dolore i','wanita','2020-11-21','O',23,54,'YA',NULL,NULL,NULL,'Sequi accusamus dist','2020-11-11 21:55:33','2020-11-11 22:11:50'),
(48,'jaziqy','Occaecat sint velit ','$2y$10$wmfRX37R39DAsfZ2.Mi7pOmuv8HXoUxLphfIBOH16FP6oCLvXHRnO','Est quidem et ','1605134162_8b1d1430f7ac27103fec.png','jycyx@mailinator.com',1,'pasien',NULL,'Cillum id est ad su','wanita','2020-11-28','AB',48,35,'TIDAK',NULL,NULL,NULL,'Aute sed est qui nis','2020-11-12 05:00:20','2020-11-12 05:36:02'),
(49,'ngehek','Qui animi veritatis','$2y$10$.r/56lcjgS0j2CjmYqRDSuTh8pe5LPWAroUgCpaWPSBEnpZlBtZWa','Rem sapiente p','','duhyxysa@mailinator.com',1,'pasien',NULL,'Omnis quo provident','pria','2010-11-01','AB',20,100,'YA',NULL,NULL,NULL,'Maiores totam sapien','2020-11-12 07:56:13','2020-11-12 07:56:13'),
(50,'angga','dr. Angga','$2y$10$lvjf2wiceoui/59cwZ.7Ne7SrA21fE/1WeE.3Uhrzi4kebCjcxpNi','082304','','angga@gmail.com',1,'dokter',1,'way halim','pria','2019-11-16','-',NULL,NULL,'-',NULL,NULL,NULL,'','2020-11-12 11:04:24','2020-11-12 11:04:24'),
(51,'ana','dr. Ana','$2y$10$JKafMJkpkVuAhE1eQzyzPu5k3HeipVTGude.jq7mmq7tQxFXt/XDq','02834','','ana@gmail.com',1,'bidan',2,'gunter','wanita','2020-11-12','-',NULL,NULL,'-',NULL,NULL,NULL,'','2020-11-12 11:07:31','2020-11-12 11:07:31'),
(52,'rusdi','Hic dignissimos sapi','$2y$10$M3mI5A.HNEXbJ1v6UwW60eqkU0mUiQr.x2nPCdvXXeT1lgQH1yxMm','Iusto officia ','','jasijoca@mailinator.com',1,'pasien',NULL,'Dolores et ab unde d','wanita','2020-11-20','A',53,16,'YA','Yudi','analyst','Islam','Minima vel autem Nam','2020-11-13 06:02:24','2020-11-13 06:20:58'),
(53,'alucard','Voluptatem animi re','$2y$10$JS061OYm4kl/63nVAu0zG.x.BfbIZ9ZESUtNj/D6be1YOqyg3g6nG','Id dicta natus','','gavidequ@mailinator.com',1,'pasien',NULL,'Perspiciatis ea ver','wanita','2020-11-28','AB',82,43,'YA','Aut in ipsam ex eius','Eaque quia odio quis','Islam','Excepteur magna sapi','2020-11-13 10:01:11','2020-11-13 10:01:11'),
(54,'rodi','Officiis quis dolor ','$2y$10$78n9YSAsAQUgg2/6HgBCD.3KlMrzdOrccS76rzJLHJaNMEh.EdWL.','Totam cillum l','','kywywahepe@mailinator.com',1,'bidan',70,'Qui repudiandae aspe','wanita','2020-11-26','-',NULL,NULL,'-',NULL,NULL,NULL,'','2020-11-13 11:13:50','2020-11-13 11:13:50');

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

/*Table structure for table `rekam_medis` */

DROP TABLE IF EXISTS `rekam_medis`;

CREATE TABLE `rekam_medis` (
  `id_rekam` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_rekam` varchar(20) NOT NULL,
  `id_daftar_fk` int(11) NOT NULL,
  `tgl_berobat` date DEFAULT NULL,
  `subyektif` varchar(150) DEFAULT NULL,
  `obyektif` varchar(150) DEFAULT NULL,
  `assesment` varchar(150) DEFAULT NULL,
  `planning` varchar(150) DEFAULT NULL,
  `keterangan_rm` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_rekam`),
  KEY `id_daftar_fk` (`id_daftar_fk`),
  CONSTRAINT `rekam_medis_ibfk_1` FOREIGN KEY (`id_daftar_fk`) REFERENCES `daftar` (`id_daftar`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `rekam_medis` */

insert  into `rekam_medis`(`id_rekam`,`nomor_rekam`,`id_daftar_fk`,`tgl_berobat`,`subyektif`,`obyektif`,`assesment`,`planning`,`keterangan_rm`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
(9,'RJ33',7,'2020-11-27','DAS','AFD','AC','CD','SC','2020-11-13 06:44:57','2020-11-13 06:44:57',1,1);

/*Table structure for table `surat` */

DROP TABLE IF EXISTS `surat`;

CREATE TABLE `surat` (
  `id_surat` int(11) NOT NULL AUTO_INCREMENT,
  `id_daftar_fk` int(11) NOT NULL,
  `tgl_surat` date DEFAULT NULL,
  `pemeriksaan` enum('SEHAT','TIDAK SEHAT') DEFAULT NULL,
  `untuk` varchar(150) DEFAULT NULL,
  `td` float DEFAULT NULL,
  `dn` float DEFAULT NULL,
  `tb` float DEFAULT NULL,
  `bb` float DEFAULT NULL,
  `mulai` date DEFAULT NULL,
  `sampai` date DEFAULT NULL,
  `jenis_surat` enum('SURAT SEHAT/TIDAK SEHAT','SURAT SAKIT') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_surat`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `surat` */

insert  into `surat`(`id_surat`,`id_daftar_fk`,`tgl_surat`,`pemeriksaan`,`untuk`,`td`,`dn`,`tb`,`bb`,`mulai`,`sampai`,`jenis_surat`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
(5,9,'2020-12-01','SEHAT','Keterangan Lamar Kerja',80,83,20,100,'2020-11-26','2020-11-30','SURAT SEHAT/TIDAK SEHAT','2020-11-13 05:43:13','2020-11-13 05:43:13',1,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
