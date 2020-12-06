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

CREATE TABLE `daftar`
(
    `id_daftar`    int(11) NOT NULL AUTO_INCREMENT,
    `id_pasien_fk` int(11) NOT NULL,
    `id_jadwal_fk` int(11) DEFAULT NULL,
    `tgl_daftar`   date         DEFAULT NULL,
    `layanan`      enum('Rekam Medis','Konsultasi','Pembuatan Surat') DEFAULT NULL,
    `keterangan`   varchar(200) DEFAULT NULL,
    `nomor_urut`   int(11) DEFAULT NULL,
    `status`       enum('tunda','batal','proses','selesai') DEFAULT NULL,
    `created_at`   timestamp NULL DEFAULT NULL,
    `updated_at`   timestamp NULL DEFAULT NULL,
    `created_by`   int(11) DEFAULT '1',
    `updated_by`   int(11) DEFAULT '1',
    PRIMARY KEY (`id_daftar`),
    KEY            `id_jadwal_fk` (`id_jadwal_fk`),
    KEY            `id_pasien_fk` (`id_pasien_fk`),
    CONSTRAINT `daftar_ibfk_1` FOREIGN KEY (`id_jadwal_fk`) REFERENCES `jadwal` (`id_jadwal`) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT `daftar_ibfk_2` FOREIGN KEY (`id_pasien_fk`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

/*Data for the table `daftar` */

insert into `daftar`(`id_daftar`, `id_pasien_fk`, `id_jadwal_fk`, `tgl_daftar`, `layanan`, `keterangan`, `nomor_urut`,
                     `status`, `created_at`, `updated_at`, `created_by`, `updated_by`)
values (10, 55, 13, '2020-11-23', 'Rekam Medis', '', 1, 'selesai', '2020-11-13 21:01:55', '2020-11-13 21:05:02', 55,
        55),
       (11, 55, 14, '2020-12-01', 'Rekam Medis', '', 1, 'selesai', '2020-11-13 21:06:23', '2020-11-13 21:06:51', 55,
        55),
       (12, 58, 13, '2020-11-23', 'Rekam Medis', '', 2, 'tunda', '2020-11-13 21:08:54', '2020-11-13 21:08:54', 58, 58),
       (13, 58, 14, '2020-11-19', 'Konsultasi', '', 1, 'selesai', '2020-11-13 21:09:28', '2020-11-13 21:10:17', 58, 58),
       (14, 58, 13, '2020-11-28', 'Pembuatan Surat', '', 1, 'selesai', '2020-11-13 21:11:19', '2020-11-13 21:14:27', 58,
        58),
       (15, 58, 14, '2020-11-13', 'Rekam Medis', '', 1, 'tunda', '2020-11-13 21:27:47', '2020-11-13 21:27:47', 58, 58),
       (16, 55, 13, '2020-11-23', 'Rekam Medis', '', 3, 'selesai', '2020-11-24 08:59:19', '2020-11-24 09:00:46', 55,
        55),
       (17, 74, 58, '2020-11-24', 'Rekam Medis', '', 1, 'selesai', '2020-11-24 09:06:12', '2020-11-24 09:08:12', 74,
        74),
       (18, 89, 23, '2020-11-24', 'Rekam Medis', 'priksa kandungan', 1, 'tunda', '2020-11-24 16:10:16',
        '2020-11-24 16:10:16', 89, 89),
       (19, 82, 23, '2020-11-24', 'Rekam Medis', 'melahirkan', 2, 'tunda', '2020-11-24 16:11:36', '2020-11-24 16:11:36',
        82, 82);

/*Table structure for table `jadwal` */

DROP TABLE IF EXISTS `jadwal`;

CREATE TABLE `jadwal`
(
    `id_jadwal`    int(11) NOT NULL AUTO_INCREMENT,
    `hari`         enum('senin','selasa','rabu','kamis','jumat','sabtu','minggu') NOT NULL,
    `dari`         varchar(10) NOT NULL,
    `sampai`       varchar(10) DEFAULT NULL,
    `idpetugas_fk` int(11) DEFAULT NULL,
    `active`       tinyint(1) DEFAULT '1',
    `created_at`   timestamp NULL DEFAULT NULL,
    `updated_at`   timestamp NULL DEFAULT NULL,
    `created_by`   int(11) DEFAULT NULL,
    `updated_by`   int(11) DEFAULT NULL,
    PRIMARY KEY (`id_jadwal`),
    KEY            `idpetugas_fk` (`idpetugas_fk`),
    CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`idpetugas_fk`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4;

/*Data for the table `jadwal` */

insert into `jadwal`(`id_jadwal`, `hari`, `dari`, `sampai`, `idpetugas_fk`, `active`, `created_at`, `updated_at`,
                     `created_by`, `updated_by`)
values (13, 'senin', '9:00', '17:00', 56, 1, '2020-11-13 20:57:59', '2020-11-13 20:57:59', NULL, NULL),
       (14, 'selasa', '13:00', '20:00', 56, 1, '2020-11-13 20:58:23', '2020-11-13 20:58:23', NULL, NULL),
       (15, 'senin', '8:00', '15:00', 61, 1, '2020-11-24 08:31:57', '2020-11-24 08:31:57', NULL, NULL),
       (16, 'selasa', '8:00', '8:45', 61, 1, '2020-11-24 08:32:12', '2020-11-24 08:32:12', NULL, NULL),
       (17, 'selasa', '8:00', '15:00', 61, 1, '2020-11-24 08:32:33', '2020-11-24 08:32:33', NULL, NULL),
       (18, 'rabu', '8:00', '15:00', 61, 1, '2020-11-24 08:32:49', '2020-11-24 08:32:49', NULL, NULL),
       (19, 'kamis', '15:00', '20:00', 61, 1, '2020-11-24 08:33:12', '2020-11-24 08:33:12', NULL, NULL),
       (20, 'jumat', '15:00', '20:00', 61, 1, '2020-11-24 08:33:33', '2020-11-24 08:33:33', NULL, NULL),
       (21, 'sabtu', '20:00', '8:00', 61, 1, '2020-11-24 08:33:51', '2020-11-24 08:33:51', NULL, NULL),
       (22, 'senin', '8:00', '15:00', 62, 1, '2020-11-24 08:34:07', '2020-11-24 08:34:07', NULL, NULL),
       (23, 'selasa', '8:00', '15:00', 62, 1, '2020-11-24 08:34:24', '2020-11-24 08:34:24', NULL, NULL),
       (24, 'rabu', '20:00', '8:00', 62, 1, '2020-11-24 08:34:45', '2020-11-24 08:34:45', NULL, NULL),
       (25, 'jumat', '20:00', '8:00', 62, 1, '2020-11-24 08:35:05', '2020-11-24 08:35:05', NULL, NULL),
       (26, 'sabtu', '15:00', '20:00', 62, 1, '2020-11-24 08:35:28', '2020-11-24 08:35:28', NULL, NULL),
       (27, 'minggu', '8:00', '15:00', 62, 1, '2020-11-24 08:35:50', '2020-11-24 08:35:50', NULL, NULL),
       (28, 'selasa', '15:00', '20:00', 63, 1, '2020-11-24 08:36:15', '2020-11-24 08:36:15', NULL, NULL),
       (29, 'rabu', '15:00', '20:00', 63, 1, '2020-11-24 08:36:37', '2020-11-24 08:36:37', NULL, NULL),
       (30, 'kamis', '8:00', '15:00', 63, 1, '2020-11-24 08:37:02', '2020-11-24 08:37:02', NULL, NULL),
       (31, 'jumat', '8:00', '15:00', 63, 1, '2020-11-24 08:37:18', '2020-11-24 08:37:18', NULL, NULL),
       (32, 'sabtu', '8:00', '15:00', 63, 1, '2020-11-24 08:37:36', '2020-11-24 08:37:36', NULL, NULL),
       (33, 'minggu', '15:00', '20:00', 63, 1, '2020-11-24 08:37:57', '2020-11-24 08:37:57', NULL, NULL),
       (34, 'senin', '20:00', '8:00', 64, 1, '2020-11-24 08:38:18', '2020-11-24 08:38:18', NULL, NULL),
       (35, 'selasa', '20:00', '8:00', 64, 1, '2020-11-24 08:38:36', '2020-11-24 08:38:36', NULL, NULL),
       (36, 'kamis', '15:00', '20:00', 64, 1, '2020-11-24 08:39:02', '2020-11-24 08:39:02', NULL, NULL),
       (37, 'jumat', '15:00', '20:00', 64, 1, '2020-11-24 08:39:26', '2020-11-24 08:39:26', NULL, NULL),
       (38, 'sabtu', '8:00', '15:00', 64, 1, '2020-11-24 08:39:45', '2020-11-24 08:39:45', NULL, NULL),
       (39, 'minggu', '8:00', '15:00', 64, 1, '2020-11-24 08:40:06', '2020-11-24 08:40:06', NULL, NULL),
       (40, 'senin', '16:00', '20:00', 67, 1, '2020-11-24 08:41:14', '2020-11-24 08:41:14', NULL, NULL),
       (41, 'selasa', '16:00', '20:00', 67, 1, '2020-11-24 08:41:49', '2020-11-24 08:41:49', NULL, NULL),
       (42, 'rabu', '14:00', '20:00', 67, 1, '2020-11-24 08:42:13', '2020-11-24 08:42:13', NULL, NULL),
       (43, 'jumat', '16:00', '20:00', 67, 1, '2020-11-24 08:42:38', '2020-11-24 08:42:38', NULL, NULL),
       (44, 'sabtu', '16:00', '20:00', 67, 1, '2020-11-24 08:43:10', '2020-11-24 08:43:10', NULL, NULL),
       (45, 'senin', '8:00', '12:00', 68, 1, '2020-11-24 08:44:09', '2020-11-24 08:44:09', NULL, NULL),
       (46, 'selasa', '8:00', '12:00', 68, 1, '2020-11-24 08:44:52', '2020-11-24 08:44:52', NULL, NULL),
       (47, 'rabu', '8:00', '12:00', 68, 1, '2020-11-24 08:45:13', '2020-11-24 08:45:13', NULL, NULL),
       (48, 'kamis', '16:00', '20:00', 68, 1, '2020-11-24 08:45:54', '2020-11-24 08:45:54', NULL, NULL),
       (49, 'jumat', '16:00', '20:00', 56, 1, '2020-11-24 08:46:12', '2020-11-24 08:46:12', NULL, NULL),
       (50, 'sabtu', '16:00', '20:00', 68, 1, '2020-11-24 08:46:36', '2020-11-24 08:46:36', NULL, NULL),
       (51, 'senin', '16:00', '20:00', 69, 1, '2020-11-24 08:47:08', '2020-11-24 08:47:08', NULL, NULL),
       (52, 'selasa', '16:00', '20:00', 69, 1, '2020-11-24 08:47:25', '2020-11-24 08:47:25', NULL, NULL),
       (53, 'rabu', '16:00', '20:00', 69, 1, '2020-11-24 08:47:56', '2020-11-24 08:47:56', NULL, NULL),
       (54, 'kamis', '8:00', '12:00', 69, 1, '2020-11-24 08:48:12', '2020-11-24 08:48:12', NULL, NULL),
       (55, 'jumat', '8:00', '12:00', 69, 1, '2020-11-24 08:48:29', '2020-11-24 08:48:29', NULL, NULL),
       (56, 'sabtu', '8:00', '12:00', 69, 1, '2020-11-24 08:48:45', '2020-11-24 08:48:45', NULL, NULL),
       (57, 'senin', '12:00', '17:00', 70, 1, '2020-11-24 08:49:44', '2020-11-24 08:49:44', NULL, NULL),
       (58, 'selasa', '12:00', '17:00', 70, 1, '2020-11-24 08:50:05', '2020-11-24 08:50:05', NULL, NULL),
       (59, 'rabu', '12:00', '17:00', 70, 1, '2020-11-24 08:50:26', '2020-11-24 08:50:26', NULL, NULL),
       (60, 'jumat', '12:00', '17:00', 56, 1, '2020-11-24 08:50:45', '2020-11-24 08:50:45', NULL, NULL),
       (61, 'jumat', '12:00', '17:00', 70, 1, '2020-11-24 08:51:04', '2020-11-24 08:51:04', NULL, NULL),
       (62, 'sabtu', '12:00', '17:00', 70, 1, '2020-11-24 08:51:23', '2020-11-24 08:51:23', NULL, NULL);

/*Table structure for table `konfigurasi` */

DROP TABLE IF EXISTS `konfigurasi`;

CREATE TABLE `konfigurasi`
(
    `id`      int(11) NOT NULL AUTO_INCREMENT,
    `label`   varchar(100) NOT NULL,
    `key`     varchar(50)  NOT NULL,
    `content` text         NOT NULL,
    `tipe`    varchar(50)  NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `konfigurasi` */

insert into `konfigurasi`(`id`, `label`, `key`, `content`, `tipe`)
values (1, 'LOGO', 'logo', '1604719652_2150ace49c061c32a2ad.png', 'gambar'),
       (2, 'JUDUL', 'judul', 'SISTEM INFORMASI LAYANAN KESEHATAN ', 'textfield'),
       (3, 'DESKRIPSI', 'deskripsi',
        'Klinik Pratama & Bersalin WeDe Ar Rachman merupakan pengembangan dari Balai Pengobatan (BP) Ar Rachman yang melayani pelayanan kesehatan umum & bersalin yang dirintis oleh Bidan Dasa Susilawati sejak tahun 2001 yang beralamat di Jalan Danau Toba Gang Saburai No. 9 Gunung Sulah Kecamatan Way Halim  Bandar Lampung.\r\nSeiring berjalannya waktu & perubahan sistem kesehatan yang ada di Indonesia BP Ar Rachman yang telah bertransformasi menjadi Klinik Pratama & Bersalin WeDe Ar Rachman berkomitmen untuk memberikan pelayanan kesehatan terbaik untuk keluarga Indonesia khususnya wilayah Bandar Lampung. Kami memiliki fasilitas pelayanan poli umum, poli gigi, laboratorium kesehatan, pemeriksaan kehamilan (ANC), imunisasi bayi, kamar bersalin dan kamar perawatan yang terdiri dari kelas VIP, VVIP, I, II, dan III dengan total kapasitas 13 tempat tidur. Rata-rata kunjungan rawat jalan 80 pasien (44% peserta BPJS) per hari dan 70 pasien (38% peserta BPJS) melahirkan setiap bulannya. Sejak tahun 2016 Klinik Pratama & Bersalin Wede Ar Rachman telah berkerjasama dengan BPJS untuk ikut berperan dalam pembangunan nasional berwawasan kesehatan.',
        'textarea'),
       (4, 'KEYWORD', 'keyword', 'kesehatan, informasi', 'textfield'),
       (5, 'EMAIL', 'email', 'kesehatan@gmail.com', 'email'),
       (6, 'NO TELP', 'notelepon', '081394673021', 'number'),
       (7, 'NAMA APP', 'nama_app', 'SI-LAKES', 'textfield'),
       (8, 'ALAMAT', 'alamat', 'Gg. Saburai No.9, Gn. Sulah, Way Halim, Kota Bandar Lampung, Lampung 35122',
        'textarea'),
       (9, 'AUTHOR', 'author', 'Hideyori', 'textfield'),
       (10, 'AREA', 'area', 'Klinik Pratama & Bersalin WeDe Ar Rachman', 'textfield'),
       (11, 'FAVICON', 'favicon', '1604719748_b0539300bb472d0475aa.ico', 'favicon');

/*Table structure for table `konsultasi` */

DROP TABLE IF EXISTS `konsultasi`;

CREATE TABLE `konsultasi`
(
    `id_konsultasi`    int(11) NOT NULL AUTO_INCREMENT,
    `nomor_konsultasi` varchar(20) NOT NULL,
    `id_daftar_fk`     int(11) NOT NULL,
    `tgl_konsultasi`   date         DEFAULT NULL,
    `diagnosis`        varchar(150) DEFAULT NULL,
    `saran`            text,
    `created_at`       timestamp NULL DEFAULT NULL,
    `updated_at`       timestamp NULL DEFAULT NULL,
    `created_by`       int(11) DEFAULT NULL,
    `updated_by`       int(11) DEFAULT NULL,
    PRIMARY KEY (`id_konsultasi`),
    KEY                `id_daftar_fk` (`id_daftar_fk`),
    CONSTRAINT `konsultasi_ibfk_1` FOREIGN KEY (`id_daftar_fk`) REFERENCES `daftar` (`id_daftar`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `konsultasi` */

insert into `konsultasi`(`id_konsultasi`, `nomor_konsultasi`, `id_daftar_fk`, `tgl_konsultasi`, `diagnosis`, `saran`,
                         `created_at`, `updated_at`, `created_by`, `updated_by`)
values (4, 'K001', 13, '2020-11-19', 'Kecapean', 'Istirahat', '2020-11-13 21:10:17', '2020-11-13 21:10:17', 56, 56);

/*Table structure for table `log` */

DROP TABLE IF EXISTS `log`;

CREATE TABLE `log`
(
    `log_id`          int(11) NOT NULL AUTO_INCREMENT,
    `log_time`        timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `log_id_user`     int(11) unsigned NOT NULL,
    `log_description` varchar(150)       DEFAULT NULL,
    PRIMARY KEY (`log_id`),
    KEY               `log_id_user` (`log_id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=933 DEFAULT CHARSET=latin1;

/*Data for the table `log` */

insert into `log`(`log_id`, `log_time`, `log_id_user`, `log_description`)
values (826, '2020-11-13 20:54:17', 55, 'yudi Berhasil Registrasi sebagai pasien'),
       (827, '2020-11-13 20:55:21', 1, 'superadmin Menambah Data Poli Poli Gigi'),
       (828, '2020-11-13 20:55:27', 1, 'superadmin Menambah Data Poli Poli Umum'),
       (829, '2020-11-13 20:55:34', 1, 'superadmin Menambah Data Poli Poli Bidan'),
       (830, '2020-11-13 20:57:10', 1, 'superadmin Menginput Data Petugas Kesehatan dr Angga'),
       (831, '2020-11-13 20:57:59', 1, 'superadmin Menginput Data Jadwal '),
       (832, '2020-11-13 20:58:23', 1, 'superadmin Menginput Data Jadwal '),
       (833, '2020-11-13 21:01:55', 10, 'yudi Berhasil Daftar Layanan Rekam Medis'),
       (834, '2020-11-13 21:03:48', 56, 'angga Mengubah Data Status Permintaan Layanan'),
       (835, '2020-11-13 21:03:59', 56, 'angga Mengubah Data Status Permintaan Layanan'),
       (836, '2020-11-13 21:05:02', 56, 'angga Menginput Data Rekam Medis R001'),
       (837, '2020-11-13 21:06:23', 11, 'yudi Berhasil Daftar Layanan Rekam Medis'),
       (838, '2020-11-13 21:06:51', 56, 'angga Menginput Data Rekam Medis R022'),
       (839, '2020-11-13 21:08:11', 58, 'tono Berhasil Registrasi sebagai pasien'),
       (840, '2020-11-13 21:08:54', 12, 'tono Berhasil Daftar Layanan Rekam Medis'),
       (841, '2020-11-13 21:09:28', 13, 'tono Berhasil Daftar Layanan Konsultasi'),
       (842, '2020-11-13 21:10:17', 56, 'angga Menginput Data Konsultasi K001'),
       (843, '2020-11-13 21:11:19', 14, 'tono Berhasil Daftar Layanan Pembuatan Surat'),
       (844, '2020-11-13 21:12:10', 56, 'angga Menginput Data Surat '),
       (845, '2020-11-13 21:12:53', 0, 'tono merubah data pribadi'),
       (846, '2020-11-13 21:14:27', 56, 'angga Mengubah Data Surat '),
       (847, '2020-11-13 21:22:26', 1, 'superadmin Menginput Data Petugas Kesehatan rendi'),
       (848, '2020-11-13 21:27:49', 15, 'tono Berhasil Daftar Layanan Rekam Medis'),
       (849, '2020-11-24 06:36:43', 60, 'yanto Berhasil Registrasi sebagai pasien'),
       (850, '2020-11-24 08:13:54', 1, 'superadmin Mengubah Data Poli KIA'),
       (851, '2020-11-24 08:15:09', 1, 'superadmin Menginput Data Petugas Kesehatan Dita Putri'),
       (852, '2020-11-24 08:16:00', 1, 'superadmin Menginput Data Petugas Kesehatan Yuniar Istiani '),
       (853, '2020-11-24 08:17:48', 1, 'superadmin Menginput Data Petugas Kesehatan Hanny tisera'),
       (854, '2020-11-24 08:19:22', 1, 'superadmin Menginput Data Petugas Kesehatan vilia agustina'),
       (855, '2020-11-24 08:20:25', 1, 'superadmin Menginput Data Petugas Kesehatan sri rizky'),
       (856, '2020-11-24 08:21:32', 1, 'superadmin Menginput Data Petugas Kesehatan nela academia'),
       (857, '2020-11-24 08:23:20', 1, 'superadmin Menginput Data Petugas Kesehatan DASA'),
       (858, '2020-11-24 08:24:29', 1, 'superadmin Menginput Data Petugas Kesehatan yulia'),
       (859, '2020-11-24 08:25:29', 1, 'superadmin Menginput Data Petugas Kesehatan raihan'),
       (860, '2020-11-24 08:26:20', 1, 'superadmin Menginput Data Petugas Kesehatan uswah'),
       (861, '2020-11-24 08:26:51', 1, 'superadmin menghapus data pengguna Cristiano'),
       (862, '2020-11-24 08:31:57', 1, 'superadmin Menginput Data Jadwal '),
       (863, '2020-11-24 08:32:12', 1, 'superadmin Menginput Data Jadwal '),
       (864, '2020-11-24 08:32:33', 1, 'superadmin Menginput Data Jadwal '),
       (865, '2020-11-24 08:32:49', 1, 'superadmin Menginput Data Jadwal '),
       (866, '2020-11-24 08:33:12', 1, 'superadmin Menginput Data Jadwal '),
       (867, '2020-11-24 08:33:33', 1, 'superadmin Menginput Data Jadwal '),
       (868, '2020-11-24 08:33:51', 1, 'superadmin Menginput Data Jadwal '),
       (869, '2020-11-24 08:34:07', 1, 'superadmin Menginput Data Jadwal '),
       (870, '2020-11-24 08:34:24', 1, 'superadmin Menginput Data Jadwal '),
       (871, '2020-11-24 08:34:45', 1, 'superadmin Menginput Data Jadwal '),
       (872, '2020-11-24 08:35:05', 1, 'superadmin Menginput Data Jadwal '),
       (873, '2020-11-24 08:35:28', 1, 'superadmin Menginput Data Jadwal '),
       (874, '2020-11-24 08:35:50', 1, 'superadmin Menginput Data Jadwal '),
       (875, '2020-11-24 08:36:15', 1, 'superadmin Menginput Data Jadwal '),
       (876, '2020-11-24 08:36:37', 1, 'superadmin Menginput Data Jadwal '),
       (877, '2020-11-24 08:37:02', 1, 'superadmin Menginput Data Jadwal '),
       (878, '2020-11-24 08:37:18', 1, 'superadmin Menginput Data Jadwal '),
       (879, '2020-11-24 08:37:36', 1, 'superadmin Menginput Data Jadwal '),
       (880, '2020-11-24 08:37:57', 1, 'superadmin Menginput Data Jadwal '),
       (881, '2020-11-24 08:38:18', 1, 'superadmin Menginput Data Jadwal '),
       (882, '2020-11-24 08:38:36', 1, 'superadmin Menginput Data Jadwal '),
       (883, '2020-11-24 08:39:02', 1, 'superadmin Menginput Data Jadwal '),
       (884, '2020-11-24 08:39:26', 1, 'superadmin Menginput Data Jadwal '),
       (885, '2020-11-24 08:39:45', 1, 'superadmin Menginput Data Jadwal '),
       (886, '2020-11-24 08:40:06', 1, 'superadmin Menginput Data Jadwal '),
       (887, '2020-11-24 08:41:14', 1, 'superadmin Menginput Data Jadwal '),
       (888, '2020-11-24 08:41:49', 1, 'superadmin Menginput Data Jadwal '),
       (889, '2020-11-24 08:42:13', 1, 'superadmin Menginput Data Jadwal '),
       (890, '2020-11-24 08:42:38', 1, 'superadmin Menginput Data Jadwal '),
       (891, '2020-11-24 08:43:10', 1, 'superadmin Menginput Data Jadwal '),
       (892, '2020-11-24 08:44:09', 1, 'superadmin Menginput Data Jadwal '),
       (893, '2020-11-24 08:44:52', 1, 'superadmin Menginput Data Jadwal '),
       (894, '2020-11-24 08:45:13', 1, 'superadmin Menginput Data Jadwal '),
       (895, '2020-11-24 08:45:54', 1, 'superadmin Menginput Data Jadwal '),
       (896, '2020-11-24 08:46:12', 1, 'superadmin Menginput Data Jadwal '),
       (897, '2020-11-24 08:46:36', 1, 'superadmin Menginput Data Jadwal '),
       (898, '2020-11-24 08:47:08', 1, 'superadmin Menginput Data Jadwal '),
       (899, '2020-11-24 08:47:25', 1, 'superadmin Menginput Data Jadwal '),
       (900, '2020-11-24 08:47:56', 1, 'superadmin Menginput Data Jadwal '),
       (901, '2020-11-24 08:48:12', 1, 'superadmin Menginput Data Jadwal '),
       (902, '2020-11-24 08:48:29', 1, 'superadmin Menginput Data Jadwal '),
       (903, '2020-11-24 08:48:45', 1, 'superadmin Menginput Data Jadwal '),
       (904, '2020-11-24 08:49:45', 1, 'superadmin Menginput Data Jadwal '),
       (905, '2020-11-24 08:50:05', 1, 'superadmin Menginput Data Jadwal '),
       (906, '2020-11-24 08:50:26', 1, 'superadmin Menginput Data Jadwal '),
       (907, '2020-11-24 08:50:45', 1, 'superadmin Menginput Data Jadwal '),
       (908, '2020-11-24 08:51:04', 1, 'superadmin Menginput Data Jadwal '),
       (909, '2020-11-24 08:51:23', 1, 'superadmin Menginput Data Jadwal '),
       (910, '2020-11-24 08:59:19', 16, 'yudi Berhasil Daftar Layanan Rekam Medis'),
       (911, '2020-11-24 09:00:46', 56, 'angga Menginput Data Rekam Medis 123456'),
       (912, '2020-11-24 09:05:20', 74, 'aris Berhasil Registrasi sebagai pasien'),
       (913, '2020-11-24 09:06:12', 17, 'aris Berhasil Daftar Layanan Rekam Medis'),
       (914, '2020-11-24 09:08:12', 70, 'uswah Menginput Data Rekam Medis 12'),
       (915, '2020-11-24 10:04:18', 75, 'cindy Berhasil Registrasi sebagai pasien'),
       (916, '2020-11-24 10:06:33', 76, 'indra Berhasil Registrasi sebagai pasien'),
       (917, '2020-11-24 10:08:14', 77, '123456 Berhasil Registrasi sebagai pasien'),
       (918, '2020-11-24 10:09:52', 78, 'diana Berhasil Registrasi sebagai pasien'),
       (919, '2020-11-24 10:13:39', 79, 'hilda Berhasil Registrasi sebagai pasien'),
       (920, '2020-11-24 13:01:21', 80, 'aldo Berhasil Registrasi sebagai pasien'),
       (921, '2020-11-24 13:02:56', 81, 'robi Berhasil Registrasi sebagai pasien'),
       (922, '2020-11-24 13:05:35', 82, 'santy Berhasil Registrasi sebagai pasien'),
       (923, '2020-11-24 13:07:33', 83, 'desi Berhasil Registrasi sebagai pasien'),
       (924, '2020-11-24 13:09:22', 84, 'dimas Berhasil Registrasi sebagai pasien'),
       (925, '2020-11-24 13:11:03', 85, 'bunayah Berhasil Registrasi sebagai pasien'),
       (926, '2020-11-24 13:13:40', 86, 'dikta Berhasil Registrasi sebagai pasien'),
       (927, '2020-11-24 13:15:45', 87, 'siska Berhasil Registrasi sebagai pasien'),
       (928, '2020-11-24 13:19:40', 88, 'tursinah Berhasil Registrasi sebagai pasien'),
       (929, '2020-11-24 16:02:37', 89, 'rendiii Berhasil Registrasi sebagai pasien'),
       (930, '2020-11-24 16:10:16', 18, 'rendiii Berhasil Daftar Layanan Rekam Medis'),
       (931, '2020-11-24 16:11:36', 19, 'santy Berhasil Daftar Layanan Rekam Medis'),
       (932, '2020-12-06 13:23:33', 90, 'weh Berhasil Registrasi sebagai pasien');

/*Table structure for table `pengguna` */

DROP TABLE IF EXISTS `pengguna`;

CREATE TABLE `pengguna`
(
    `id`           int(11) NOT NULL AUTO_INCREMENT,
    `nopasien`     varchar(30)  DEFAULT NULL,
    `username`     varchar(50)  NOT NULL,
    `nama`         varchar(150) NOT NULL,
    `password`     text         NOT NULL,
    `notelepon`    varchar(16)  DEFAULT NULL,
    `avatar`       varchar(255) DEFAULT NULL,
    `email`        varchar(255) DEFAULT NULL,
    `active`       tinyint(4) DEFAULT '1',
    `level`        enum('admin','dokter','bidan','pasien','pimpinan') DEFAULT NULL,
    `id_poli_fk`   int(11) DEFAULT NULL,
    `alamat`       varchar(255) DEFAULT NULL,
    `jk`           enum('pria','wanita') DEFAULT 'pria',
    `tgl_lahir`    date         DEFAULT '1990-01-01',
    `gol_darah`    enum('-','A','B','AB','O') DEFAULT '-',
    `tinggi_badan` int(11) DEFAULT NULL,
    `berat_badan`  int(11) DEFAULT NULL,
    `bpjs`         enum('-','YA','TIDAK') DEFAULT '-',
    `nama_kk`      varchar(150) DEFAULT NULL,
    `pekerjaan`    varchar(100) DEFAULT NULL,
    `agama`        enum('Islam','Kristen','Katholik','Hindu','Budha','Konghucu') DEFAULT NULL,
    `deskripsi`    text,
    `created_at`   timestamp NULL DEFAULT NULL,
    `updated_at`   timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY            `id_kelurahan_fk` (`id_poli_fk`),
    CONSTRAINT `pengguna_ibfk_1` FOREIGN KEY (`id_poli_fk`) REFERENCES `poli` (`id_poli`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pengguna` */

insert into `pengguna`(`id`, `nopasien`, `username`, `nama`, `password`, `notelepon`, `avatar`, `email`, `active`,
                       `level`, `id_poli_fk`, `alamat`, `jk`, `tgl_lahir`, `gol_darah`, `tinggi_badan`, `berat_badan`,
                       `bpjs`, `nama_kk`, `pekerjaan`, `agama`, `deskripsi`, `created_at`, `updated_at`)
values (1, NULL, 'superadmin', 'Edi Maryanto', '$2y$10$3NVP6DZi7rs919bi6uxvteQJvNlv9Qp/1E3BhX4XjfJC1ATWKDP1u',
        '0804328', '1604159317_39da846aa8ef988002a9.png', 'super@lampungprov.go.id', 1, 'admin', NULL, 'Teluk', 'pria',
        '1990-05-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL,
        '<h3 style=\"margin: 15px 0px; padding: 0px; font-weight: 700; font-size: 14px; font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;\"=\"\">The standard Lorem Ipsum passage, used since the 1500s</h3><p style=\"margin-bottom: 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><ol><li style=\"margin-bottom: 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0);\">fasdfdf</li><li style=\"margin-bottom: 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0);\">asdfasdf</li><li style=\"margin-bottom: 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0);\">asdfasdf</li></ol>',
        '2020-07-19 09:10:40', '2020-10-31 22:48:37'),
       (55, 'P-061220-111', 'yudi', 'Yudi', '$2y$10$9yEUUf0HS7vcYjbq..OvZ.CkeuuTekgQ2JwH7U6I2wJfAX4wKFrWG', '08304',
        '1605275655_0a0f5c51268ea4bfcea9.png', 'yudi@gmail.com', 1, 'pasien', NULL, 'Gunter', 'pria', '2010-11-13', 'B',
        171, 70, 'YA', 'Beni', 'Wiraswasta', 'Islam', '', '2020-11-13 20:54:15', '2020-11-13 20:54:15'),
       (56, NULL, 'angga', 'dr Angga', '$2y$10$lDMJGSmiJ.cQ715O3tGgVOsIyHZaAbOjYIjRsJ92DwzWlzxVtIrO2', '080', '',
        'angga@gmail.com', 1, 'dokter', 142, 'Rajabasa', 'pria', '1997-11-14', '-', NULL, NULL, '-', NULL, NULL, NULL,
        '<ol><li>Lulusan S1 Sarjana</li><li><br></li></ol>', '2020-11-13 20:57:09', '2020-11-13 20:57:09'),
       (58, 'P-061220-222', 'tono', 'Tono', '$2y$10$/6J/bXSz6uNv.TFIyBqRa.31oIhyY6no8goqQbKP09Xju3X7zqFpa', '8080', '',
        'tono@gmail.com', 1, 'pasien', NULL, 'Jepang', 'pria', '2001-11-13', '-', 180, 87, 'YA', 'Sugiono', 'Analyst',
        'Islam', '', '2020-11-13 21:08:11', '2020-11-13 21:12:53'),
       (59, NULL, 'rendi', 'rendi', '$2y$10$rh97YWGv72XBJeLChIMXou3rQ8tp3XmzxDu/TxDh5QMDPZojAeWTa', '123455', '',
        'rendi@gmail.com', 1, 'dokter', 142, 'antasari', 'pria', '2012-11-01', '-', NULL, NULL, '-', NULL, NULL, NULL,
        '', '2020-11-13 21:22:26', '2020-11-13 21:22:26'),
       (60, 'P-061220-333', 'yanto', 'Quo veritatis proide',
        '$2y$10$oWr9CPZ9tQ1o6HUCVuTAke.GZy924I0OcaEypSNrXtDMaQp6fjjwi', 'Ullamco volupt', '', 'site@mailinator.com', 1,
        'pasien', NULL, 'Nihil voluptatem Vi', 'pria', '2020-11-28', 'B', 74, 38, 'YA', 'Architecto incidunt',
        'Eligendi facere ipsa', 'Katholik', 'Voluptatem tempor vo', '2020-11-24 06:36:43', '2020-11-24 06:36:43'),
       (61, NULL, 'dita', 'Dita Putri', '$2y$10$kbwa4JbjcalK4mflC6QyrOkHqEMpfWYNxZ5ZqmrpUUV.WLAwb3KtO', '0812', '',
        'dita@gmail.com', 1, 'bidan', 143, 'kedamaian', 'wanita', '1993-11-15', '-', NULL, NULL, '-', NULL, NULL, NULL,
        '', '2020-11-24 08:15:09', '2020-11-24 08:15:09'),
       (62, NULL, 'yuniar', 'Yuniar Istiani ', '$2y$10$qEc2dfR59zR0a/7J8qPYXegk6/W5E9.JldM42DpVwagWkJ9/tzsP2', '0812',
        '', 'yuniar@gmail.com', 1, 'bidan', 143, 'sukarame', 'wanita', '1993-11-15', '-', NULL, NULL, '-', NULL, NULL,
        NULL, '', '2020-11-24 08:16:00', '2020-11-24 08:16:00'),
       (63, NULL, 'hanny', 'Hanny tisera', '$2y$10$iE7rcX2zdUyEs3o9ue3G7.TiPUTM4xDFfpPhzQgyp0w7evDplBQLy', '0812', '',
        'hanny@gmail.com', 1, 'bidan', 143, 'antasari', 'pria', '1993-11-15', '-', NULL, NULL, '-', NULL, NULL, NULL,
        '', '2020-11-24 08:17:48', '2020-11-24 08:17:48'),
       (64, NULL, 'vilia', 'vilia agustina', '$2y$10$NQctqAvcb0/QIXf6Jor5uegWltT/56hzkAXkl8ybxpq59hgvNFqcm', '0812', '',
        'vilia@gmail.com', 1, 'bidan', 143, 'bukit randu', 'wanita', '1993-11-15', '-', NULL, NULL, '-', NULL, NULL,
        NULL, '', '2020-11-24 08:19:22', '2020-11-24 08:19:22'),
       (65, NULL, 'sri', 'sri rizky', '$2y$10$xOM9CHAOaLLACen5zYptDeV2gsDdo0v89ccXNrd0oD2r8eZk1CplW', '0812', '',
        'sri@gmail.com', 1, 'bidan', 143, 'kedamaian', 'pria', '1993-11-15', '-', NULL, NULL, '-', NULL, NULL, NULL, '',
        '2020-11-24 08:20:25', '2020-11-24 08:20:25'),
       (66, NULL, 'nela', 'nela academia', '$2y$10$MjXHXY1RC3ugE97BbUvozeF8QP0qRACp7umttkS0gCLCKXleDb1Ju', '0812', '',
        'nela@gmail.com', 1, 'bidan', 143, 'sukabumi', 'wanita', '1993-11-15', '-', NULL, NULL, '-', NULL, NULL, NULL,
        '', '2020-11-24 08:21:32', '2020-11-24 08:21:32'),
       (67, NULL, 'dasa', 'DASA', '$2y$10$ZU2odR6/5iwe6L6vm9YHluibNtHgQvx10MlceRbFkc1/1W5PczOkO', '0812', '',
        'dasa@gmail.com', 1, 'bidan', 143, 'gunung sulah', 'wanita', '1970-11-08', '-', NULL, NULL, '-', NULL, NULL,
        NULL, '', '2020-11-24 08:23:20', '2020-11-24 08:23:20'),
       (68, NULL, 'yulia', 'yulia', '$2y$10$/Ze6Hxu4erEXE1WFTcAdHeO/e8e2QiIc6kSvdDwhiV.Q.2aQ7kRrq', '0812', '',
        'yulia@gmail.com', 1, 'dokter', 142, 'teluk', 'wanita', '1990-11-08', '-', NULL, NULL, '-', NULL, NULL, NULL,
        '', '2020-11-24 08:24:29', '2020-11-24 08:24:29'),
       (69, NULL, 'raihan', 'raihan', '$2y$10$JKr7E7BUO.qVg0xPCKMATuvu.K8JGU9Lt1N.lmjubiyi0IZ9FQNvq', '0812', '',
        'raihan@gmail.com', 1, 'dokter', 142, 'pulau sebuku', 'pria', '1990-11-08', '-', NULL, NULL, '-', NULL, NULL,
        NULL, '', '2020-11-24 08:25:29', '2020-11-24 08:25:29'),
       (70, NULL, 'uswah', 'uswah', '$2y$10$ua.0O.JsP8kua8Wy8NBAt.WgpfeiOS8Ud1ltM8ixwumk8HLYzjy1e', '0812', '',
        'uswah@gmail.com', 1, 'dokter', 141, 'jagabaya', 'wanita', '1990-11-08', '-', NULL, NULL, '-', NULL, NULL, NULL,
        '', '2020-11-24 08:26:20', '2020-11-24 08:26:20'),
       (71, NULL, 'DASAA', 'DASAA', '$2y$10$boNa5fQZ4W3nlFvhtVPQEuKuMf/lxh1qT0nEXttLzfuuYgtcc.n7S', '0812', '',
        'dasaa@gmail.com', 1, 'pimpinan', NULL, NULL, 'pria', '1990-01-01', '-', NULL, NULL, '-', NULL, NULL, NULL,
        NULL, '2020-11-24 08:27:47', '2020-11-24 08:27:47'),
       (72, NULL, 'intandwi', 'intan Dwi', '$2y$10$pWaFktAFeKKcAQj9j68v1eQO/lvmRvqNwozZHctVddx0h2L9pVLXS', '0812', '',
        'intan@gmail.com', 1, 'admin', NULL, NULL, 'pria', '1990-01-01', '-', NULL, NULL, '-', NULL, NULL, NULL, NULL,
        '2020-11-24 08:28:30', '2020-11-24 08:28:30'),
       (73, NULL, 'selaD', 'selaD', '$2y$10$Lzyb/RoTWsA4ltHUR6i10OgAHFT.cHC8x22X1KaAV/iKQs4Myz0sO', '0812', '',
        'selad@gmail.com', 1, 'admin', NULL, NULL, 'pria', '1990-01-01', '-', NULL, NULL, '-', NULL, NULL, NULL, NULL,
        '2020-11-24 08:29:19', '2020-11-24 08:29:19'),
       (74, 'P-061220-444', 'aris', 'aris setiwan', '$2y$10$WW42Oefz3A.rZzTHzVIEEOhs75EVsSEENXkVGa1ZSKizZXwZcvMqC',
        '0812', '', 'aris@gmail.com', 1, 'pasien', NULL, 'jagabaya 3', 'pria', '1982-08-12', '-', 170, 62, 'TIDAK',
        'aris', 'guru', 'Islam', '', '2020-11-24 09:05:20', '2020-11-24 09:05:20'),
       (75, 'P-061220-555', 'cindy', 'cindy mayang sari',
        '$2y$10$6bXgnwX3ry5glIVE1E/4vOMgL7I.TV7VZ9663GUg2UN8ACb/WJ8UW', '0812', '', 'cindy@gmail.com', 1, 'pasien',
        NULL, 'urip sumoharjo', 'wanita', '1994-10-11', '-', 160, 50, 'TIDAK', 'danang', 'ibu rumah tangga', 'Islam',
        '', '2020-11-24 10:04:18', '2020-11-24 10:04:18'),
       (76, 'P-061220-666', 'indra', 'indra', '$2y$10$4zprBTMMP1WnQykRaZ8j5O6N5GWo2nHmaK2utbEqcvhwvK/JB8Y6W', '0812',
        '', 'indra@gmail.com', 1, 'pasien', NULL, 'gunung sulah', 'pria', '1993-11-15', '-', 170, 55, 'YA', 'indra', '',
        'Islam', '', '2020-11-24 10:06:33', '2020-11-24 10:06:33'),
       (77, 'P-061220-777', '123456', 'joko susilo', '$2y$10$SGwWje56NUulHYG6YVDBrO.4V7GQwsPzkDceenEF3YuILIX6aTiim',
        '0812', '', 'joko@gmail.com', 1, 'pasien', NULL, 'jagabaya 1', 'pria', '1990-10-12', 'A', 166, 66, 'TIDAK',
        'joko', 'wiraswasta', 'Islam', '', '2020-11-24 10:08:14', '2020-11-24 10:08:14'),
       (78, 'P-061220-888', 'diana', 'diana kusuma', '$2y$10$AamEWoGaBSa080PWT82e2u382/yLG4P2SOk6l/4bWbIk4lHEYxsn.',
        '0812', '', 'diana@gmail.com', 1, 'pasien', NULL, 'sukarame', 'wanita', '1993-11-15', '-', 150, 46, 'TIDAK',
        'bagas', '', 'Islam', '', '2020-11-24 10:09:52', '2020-11-24 10:09:52'),
       (79, 'P-061220-999', 'hilda', 'hilda', '$2y$10$nyGw.M5JX1.F.xq8/pivzeb20RnbD6Cdfi3NxjQcWl1koDA25wZ5e', '0812',
        '', 'hilda@gmail.com', 1, 'pasien', NULL, 'segala mider', 'wanita', '1980-02-16', 'A', 154, 44, 'YA', 'nanang',
        'ibu rumah tangga', 'Islam', '', '2020-11-24 10:13:39', '2020-11-24 10:13:39'),
       (80, 'P-071220-111', 'aldo', 'aldo', '$2y$10$sOih0MvKOZ3.n7GsTsf1w.p/pt8sBuChh2oI.lL8yYz.LvOZIzWG.', '0812', '',
        'aldo@gmail.com', 1, 'pasien', NULL, 'natar', 'pria', '1998-09-08', 'B', 167, 48, 'TIDAK', 'gado', 'mahasiswa',
        'Islam', '', '2020-11-24 13:01:21', '2020-11-24 13:01:21'),
       (81, 'P-071220-222', 'robi', 'robi', '$2y$10$MSwYgkUzhCM.cgpuDPcdieUd.LZ/WTgXsY1mI/EtEM5yxbo2KDGEm', '0812', '',
        'robi@gmail.com', 1, 'pasien', NULL, 'gunung sulah', 'pria', '1997-12-11', '-', 168, 44, 'TIDAK', 'saiful', '',
        'Islam', '', '2020-11-24 13:02:56', '2020-11-24 13:02:56'),
       (82, 'P-071220-333', 'santy', 'santy afriana', '$2y$10$4189BlIfDJtp3gn1SgvHJOKBXTAxnjvxa.RjwCn3DU2NiqesXXjVO',
        '0812', '', 'santy@gmail.com', 1, 'pasien', NULL, 'belitung', 'wanita', '1998-04-08', '-', 163, 48, 'YA',
        'ubaidillah', 'mahasiswa', 'Islam', '', '2020-11-24 13:05:35', '2020-11-24 13:05:35'),
       (83, 'P-071220-444', 'desi', 'desi', '$2y$10$zU.MlfuvC0cof2eJwF5sNuAlbusJdugkhRCC.18YF6SCFc8XZq82C', '0812', '',
        'desi@gmail.com', 1, 'pasien', NULL, 'sukarame', 'wanita', '1998-07-07', '-', 160, 52, 'YA', 'dadi',
        'mahasiswa', 'Islam', '', '2020-11-24 13:07:33', '2020-11-24 13:07:33'),
       (84, 'P-071220-555', 'dimas', 'dimas suki', '$2y$10$SeGc.iCIFShzAZX.oZeTn.cAN5LBlb0uwSM7ncbW0uP/g9Q98WLHC',
        '0812', '', 'dimas@gmail.com', 1, 'pasien', NULL, 'prajurit 1', 'pria', '1999-11-16', '-', 172, 80, 'YA',
        'suki', 'mahasiswa', 'Islam', '', '2020-11-24 13:09:22', '2020-11-24 13:09:22'),
       (85, 'P-071220-666', 'bunayah', 'bunayah', '$2y$10$ohzSoC2pPU5nopITJO1h9.JPnjJmv8Mw3VY2CCWPYALHFYt3rMLZO',
        '0812', '', 'bunayah@gmail.com', 1, 'pasien', NULL, 'panjang ketapang', 'wanita', '1978-04-08', '-', 150, 55,
        'YA', 'muchlas', 'ibu rumah tangga', 'Islam', '', '2020-11-24 13:11:03', '2020-11-24 13:11:03'),
       (86, 'P-071220-777', 'dikta', 'dikta', '$2y$10$tkkqY8ZxjWp6JIsK2md.Mu91YIpMowgCT45CwHCzPKxir8CMnDfPW', '0812',
        '', 'dikta@gmail.com', 1, 'pasien', NULL, 'waydadi', 'pria', '1995-09-23', 'B', 174, 81, 'TIDAK', 'zalilah', '',
        'Islam', '', '2020-11-24 13:13:40', '2020-11-24 13:13:40'),
       (87, 'P-071220-888', 'siska', 'siska anisa', '$2y$10$OIXhV3.2bZkWVV9GbGxfHecZfCU/It0qKAyapUPNMBAqzLlpd.uGq',
        '0812', '', 'siska@gmail.com', 1, 'pasien', NULL, 'puskud', 'wanita', '1998-07-28', '-', 166, 53, 'TIDAK',
        'surya', 'mahasiswa', 'Islam', '', '2020-11-24 13:15:45', '2020-11-24 13:15:45'),
       (88, 'P-071220-999', 'tursinah', 'tursinah', '$2y$10$Ixo.ZMJNV8MQmd2.UthyiuM/pso0qjcGiPMNlu5yeYu0XuJLq.OGK',
        '0812', '', 'tursinah@gmail.com', 1, 'pasien', NULL, 'prajurit 2', 'wanita', '1966-02-07', '-', 150, 60, 'YA',
        'sudarsono', 'ibu rumah tangga', 'Islam', '', '2020-11-24 13:19:40', '2020-11-24 13:19:40'),
       (89, 'P-081220-222', 'rendiii', 'rendirafli', '$2y$10$6kBDo0NqcvoI9dIqwgxeCeQ2Dg76vOX7Il11gf2klf3loWf/fBm8S',
        '0892 222 444 2', '', 'ida@gmail.com', 1, 'pasien', NULL, 'kedamaian', 'wanita', '1998-08-12', '-', 165, 56,
        'YA', 'zainal', 'mahasiswa', 'Islam', '', '2020-11-24 16:02:37', '2020-11-24 16:02:37'),
       (90, 'P-081220-580', 'weh', 'Doloribus dolore ips',
        '$2y$10$yoL.IGyA9XXbAgQDWkMV/OKLHgvmP/zIltt7xW9g0Vp/5KQFH6nYS', 'Hic qui volupt', '', NULL, 1, 'pasien', NULL,
        'Commodi voluptates d', 'pria', '2021-01-01', '-', 23, 63, 'YA', 'Commodi laboriosam ', 'Irure sit ut consequ',
        'Konghucu', 'Asperiores commodo p', '2020-12-06 13:23:33', '2020-12-06 13:23:33');

/*Table structure for table `poli` */

DROP TABLE IF EXISTS `poli`;

CREATE TABLE `poli`
(
    `id_poli`    int(11) NOT NULL AUTO_INCREMENT,
    `nama_poli`  varchar(150) NOT NULL,
    `active`     tinyint(1) NOT NULL DEFAULT '1',
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    `created_by` int(11) DEFAULT '1',
    `updated_by` int(11) DEFAULT '1',
    PRIMARY KEY (`id_poli`)
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf8mb4;

/*Data for the table `poli` */

insert into `poli`(`id_poli`, `nama_poli`, `active`, `created_at`, `updated_at`, `created_by`, `updated_by`)
values (141, 'Poli Gigi', 1, '2020-11-13 20:55:21', '2020-11-13 20:55:21', 1, 1),
       (142, 'Poli Umum', 1, '2020-11-13 20:55:26', '2020-11-13 20:55:26', 1, 1),
       (143, 'KIA', 1, '2020-11-13 20:55:34', '2020-11-24 08:13:54', 1, 1);

/*Table structure for table `rekam_medis` */

DROP TABLE IF EXISTS `rekam_medis`;

CREATE TABLE `rekam_medis`
(
    `id_rekam`      int(11) NOT NULL AUTO_INCREMENT,
    `nomor_rekam`   varchar(20) NOT NULL,
    `id_daftar_fk`  int(11) NOT NULL,
    `tgl_berobat`   date         DEFAULT NULL,
    `subyektif`     varchar(150) DEFAULT NULL,
    `obyektif`      varchar(150) DEFAULT NULL,
    `assesment`     varchar(150) DEFAULT NULL,
    `planning`      varchar(150) DEFAULT NULL,
    `keterangan_rm` text,
    `created_at`    timestamp NULL DEFAULT NULL,
    `updated_at`    timestamp NULL DEFAULT NULL,
    `created_by`    int(11) DEFAULT NULL,
    `updated_by`    int(11) DEFAULT NULL,
    PRIMARY KEY (`id_rekam`),
    KEY             `id_daftar_fk` (`id_daftar_fk`),
    CONSTRAINT `rekam_medis_ibfk_1` FOREIGN KEY (`id_daftar_fk`) REFERENCES `daftar` (`id_daftar`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

/*Data for the table `rekam_medis` */

insert into `rekam_medis`(`id_rekam`, `nomor_rekam`, `id_daftar_fk`, `tgl_berobat`, `subyektif`, `obyektif`,
                          `assesment`, `planning`, `keterangan_rm`, `created_at`, `updated_at`, `created_by`,
                          `updated_by`)
values (10, 'R001', 10, '2020-11-24', 'Subyektif 1', 'Obyektif 1', 'Assesment 1', 'Planning 1', 'Ket 1',
        '2020-11-13 21:05:02', '2020-11-13 21:05:02', 56, 56),
       (11, 'R022', 11, '2020-12-01', 'A', 'B', 'C', 'D', 'E', '2020-11-13 21:06:50', '2020-11-13 21:06:50', 56, 56),
       (12, '123456', 16, '2020-11-23', 'aaaa', 'aaaaaaa', 'aaaaa', 'aaaa', 'aaaa', '2020-11-24 09:00:46',
        '2020-11-24 09:00:46', 56, 56),
       (13, '12', 17, '2020-11-24', '2', '3', '4', '5', '6', '2020-11-24 09:08:12', '2020-11-24 09:08:12', 70, 70);

/*Table structure for table `surat` */

DROP TABLE IF EXISTS `surat`;

CREATE TABLE `surat`
(
    `id_surat`     int(11) NOT NULL AUTO_INCREMENT,
    `id_daftar_fk` int(11) NOT NULL,
    `tgl_surat`    date         DEFAULT NULL,
    `pemeriksaan`  enum('SEHAT','TIDAK SEHAT') DEFAULT NULL,
    `untuk`        varchar(150) DEFAULT NULL,
    `td`           float        DEFAULT NULL,
    `dn`           float        DEFAULT NULL,
    `tb`           float        DEFAULT NULL,
    `bb`           float        DEFAULT NULL,
    `mulai`        date         DEFAULT NULL,
    `sampai`       date         DEFAULT NULL,
    `jenis_surat`  enum('SURAT SEHAT/TIDAK SEHAT','SURAT SAKIT') DEFAULT NULL,
    `created_at`   timestamp NULL DEFAULT NULL,
    `updated_at`   timestamp NULL DEFAULT NULL,
    `created_by`   int(11) DEFAULT NULL,
    `updated_by`   int(11) DEFAULT NULL,
    PRIMARY KEY (`id_surat`),
    KEY            `id_daftar_fk` (`id_daftar_fk`),
    CONSTRAINT `surat_ibfk_1` FOREIGN KEY (`id_daftar_fk`) REFERENCES `daftar` (`id_daftar`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `surat` */

insert into `surat`(`id_surat`, `id_daftar_fk`, `tgl_surat`, `pemeriksaan`, `untuk`, `td`, `dn`, `tb`, `bb`, `mulai`,
                    `sampai`, `jenis_surat`, `created_at`, `updated_at`, `created_by`, `updated_by`)
values (6, 14, '2020-11-28', 'SEHAT', 'Lomba Panjat Pinang', 80, 70, 180, 87, '2020-11-17', '2020-11-20', 'SURAT SAKIT',
        '2020-11-13 21:12:10', '2020-11-13 21:12:10', 56, 56);

/*Table structure for table `vdaftar` */

DROP TABLE IF EXISTS `vdaftar`;

/*!50001 DROP VIEW IF EXISTS `vdaftar` */;
/*!50001 DROP TABLE IF EXISTS `vdaftar` */;

/*!50001 CREATE TABLE  `vdaftar`(
 `id_daftar` int(11) ,
 `id_pasien_fk` int(11) ,
 `nopasien` varchar(30) ,
 `nama` varchar(150) ,
 `tinggi_badan` int(11) ,
 `berat_badan` int(11) ,
 `nama_kk` varchar(150) ,
 `agama` enum('Islam','Kristen','Katholik','Hindu','Budha','Konghucu') ,
 `pekerjaan` varchar(100) ,
 `tgl_lahir` date ,
 `alamat` varchar(255) ,
 `jk` enum('pria','wanita') ,
 `notelepon` varchar(16) ,
 `id_jadwal_fk` int(11) ,
 `hari` enum('senin','selasa','rabu','kamis','jumat','sabtu','minggu') ,
 `dari` varchar(10) ,
 `sampai` varchar(10) ,
 `idpetugas_fk` varchar(11) ,
 `nama_petugas` varchar(150) ,
 `level` enum('admin','dokter','bidan','pasien','pimpinan') ,
 `id_poli_fk` varchar(11) ,
 `nama_poli` varchar(150) ,
 `tgl_daftar` date ,
 `layanan` enum('Rekam Medis','Konsultasi','Pembuatan Surat') ,
 `keterangan` varchar(200) ,
 `nomor_urut` int(11) ,
 `status` enum('tunda','batal','proses','selesai') ,
 `created_at` timestamp ,
 `updated_at` timestamp 
)*/;

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
 `nopasien` varchar(30) ,
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
 `gol_darah` enum('-','A','B','AB','O') ,
 `tinggi_badan` int(11) ,
 `berat_badan` int(11) ,
 `bpjs` enum('-','YA','TIDAK') ,
 `pekerjaan` varchar(100) ,
 `agama` enum('Islam','Kristen','Katholik','Hindu','Budha','Konghucu') ,
 `nama_kk` varchar(150) ,
 `id_poli_fk` varchar(11) ,
 `nama_poli` varchar(150) ,
 `created_at` timestamp ,
 `updated_at` timestamp 
)*/;

/*Table structure for table `vrekam` */

DROP TABLE IF EXISTS `vrekam`;

/*!50001 DROP VIEW IF EXISTS `vrekam` */;
/*!50001 DROP TABLE IF EXISTS `vrekam` */;

/*!50001 CREATE TABLE  `vrekam`(
 `id_rekam` int(11) ,
 `nomor_rekam` varchar(20) ,
 `id_daftar_fk` int(11) ,
 `id_pasien_fk` int(11) ,
 `nama` varchar(150) ,
 `nama_poli` varchar(150) ,
 `tgl_berobat` date ,
 `subyektif` varchar(150) ,
 `obyektif` varchar(150) ,
 `assesment` varchar(150) ,
 `planning` varchar(150) ,
 `keterangan_rm` text ,
 `nama_petugas` varchar(150) 
)*/;

/*View structure for view vdaftar */

/*!50001 DROP TABLE IF EXISTS `vdaftar` */;
/*!50001 DROP VIEW IF EXISTS `vdaftar` */;

/*!50001 CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vdaftar` AS select `daftar`.`id_daftar` AS `id_daftar`,`daftar`.`id_pasien_fk` AS `id_pasien_fk`,`pengguna`.`nopasien` AS `nopasien`,`pengguna`.`nama` AS `nama`,`pengguna`.`tinggi_badan` AS `tinggi_badan`,`pengguna`.`berat_badan` AS `berat_badan`,`pengguna`.`nama_kk` AS `nama_kk`,`pengguna`.`agama` AS `agama`,`pengguna`.`pekerjaan` AS `pekerjaan`,`pengguna`.`tgl_lahir` AS `tgl_lahir`,`pengguna`.`alamat` AS `alamat`,`pengguna`.`jk` AS `jk`,`pengguna`.`notelepon` AS `notelepon`,`daftar`.`id_jadwal_fk` AS `id_jadwal_fk`,`vjadwal`.`hari` AS `hari`,`vjadwal`.`dari` AS `dari`,`vjadwal`.`sampai` AS `sampai`,`vjadwal`.`idpetugas_fk` AS `idpetugas_fk`,`vjadwal`.`nama_petugas` AS `nama_petugas`,`vjadwal`.`level` AS `level`,`vjadwal`.`id_poli_fk` AS `id_poli_fk`,`vjadwal`.`nama_poli` AS `nama_poli`,`daftar`.`tgl_daftar` AS `tgl_daftar`,`daftar`.`layanan` AS `layanan`,`daftar`.`keterangan` AS `keterangan`,`daftar`.`nomor_urut` AS `nomor_urut`,`daftar`.`status` AS `status`,`daftar`.`created_at` AS `created_at`,`daftar`.`updated_at` AS `updated_at` from ((`daftar` join `vjadwal` on((`daftar`.`id_jadwal_fk` = `vjadwal`.`id_jadwal`))) join `pengguna` on((`daftar`.`id_pasien_fk` = `pengguna`.`id`))) */;

/*View structure for view vjadwal */

/*!50001 DROP TABLE IF EXISTS `vjadwal` */;
/*!50001 DROP VIEW IF EXISTS `vjadwal` */;

/*!50001 CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vjadwal` AS select `jadwal`.`id_jadwal` AS `id_jadwal`,`jadwal`.`hari` AS `hari`,`jadwal`.`dari` AS `dari`,`jadwal`.`sampai` AS `sampai`,`jadwal`.`active` AS `active`,ifnull(`jadwal`.`idpetugas_fk`,'-') AS `idpetugas_fk`,ifnull(`vpengguna`.`nama`,'-') AS `nama_petugas`,`vpengguna`.`level` AS `level`,ifnull(`vpengguna`.`id_poli_fk`,'-') AS `id_poli_fk`,ifnull(`vpengguna`.`nama_poli`,'-') AS `nama_poli`,`jadwal`.`created_at` AS `created_at`,`jadwal`.`updated_at` AS `updated_at` from (`jadwal` left join `vpengguna` on((`jadwal`.`idpetugas_fk` = `vpengguna`.`id`))) */;

/*View structure for view vpengguna */

/*!50001 DROP TABLE IF EXISTS `vpengguna` */;
/*!50001 DROP VIEW IF EXISTS `vpengguna` */;

/*!50001 CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vpengguna` AS select `pengguna`.`id` AS `id`,`pengguna`.`nopasien` AS `nopasien`,`pengguna`.`username` AS `username`,`pengguna`.`nama` AS `nama`,`pengguna`.`password` AS `password`,`pengguna`.`notelepon` AS `notelepon`,`pengguna`.`avatar` AS `avatar`,`pengguna`.`email` AS `email`,`pengguna`.`active` AS `active`,`pengguna`.`level` AS `level`,`pengguna`.`alamat` AS `alamat`,`pengguna`.`jk` AS `jk`,`pengguna`.`tgl_lahir` AS `tgl_lahir`,`pengguna`.`deskripsi` AS `deskripsi`,`pengguna`.`gol_darah` AS `gol_darah`,`pengguna`.`tinggi_badan` AS `tinggi_badan`,`pengguna`.`berat_badan` AS `berat_badan`,`pengguna`.`bpjs` AS `bpjs`,`pengguna`.`pekerjaan` AS `pekerjaan`,`pengguna`.`agama` AS `agama`,`pengguna`.`nama_kk` AS `nama_kk`,ifnull(`pengguna`.`id_poli_fk`,'-') AS `id_poli_fk`,ifnull(`poli`.`nama_poli`,'-') AS `nama_poli`,`pengguna`.`created_at` AS `created_at`,`pengguna`.`updated_at` AS `updated_at` from (`pengguna` left join `poli` on((`pengguna`.`id_poli_fk` = `poli`.`id_poli`))) */;

/*View structure for view vrekam */

/*!50001 DROP TABLE IF EXISTS `vrekam` */;
/*!50001 DROP VIEW IF EXISTS `vrekam` */;

/*!50001 CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vrekam` AS select `rekam_medis`.`id_rekam` AS `id_rekam`,`rekam_medis`.`nomor_rekam` AS `nomor_rekam`,`rekam_medis`.`id_daftar_fk` AS `id_daftar_fk`,`vdaftar`.`id_pasien_fk` AS `id_pasien_fk`,`vdaftar`.`nama` AS `nama`,`vdaftar`.`nama_poli` AS `nama_poli`,`rekam_medis`.`tgl_berobat` AS `tgl_berobat`,`rekam_medis`.`subyektif` AS `subyektif`,`rekam_medis`.`obyektif` AS `obyektif`,`rekam_medis`.`assesment` AS `assesment`,`rekam_medis`.`planning` AS `planning`,`rekam_medis`.`keterangan_rm` AS `keterangan_rm`,`vdaftar`.`nama_petugas` AS `nama_petugas` from (`rekam_medis` join `vdaftar` on(((`rekam_medis`.`id_daftar_fk` = `vdaftar`.`id_daftar`) and (`vdaftar`.`status` = 'selesai')))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
