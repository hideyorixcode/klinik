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
                          `id_daftar`    int(11) NOT NULL AUTO_INCREMENT,
                          `id_pasien_fk` int(11) NOT NULL,
                          `id_jadwal_fk` int(11) DEFAULT NULL,
                          `tgl_daftar`   date DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

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
       (15, 58, 14, '2020-11-13', 'Rekam Medis', '', 1, 'tunda', '2020-11-13 21:27:47', '2020-11-13 21:27:47', 58, 58);

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

/*Data for the table `jadwal` */

insert into `jadwal`(`id_jadwal`, `hari`, `dari`, `sampai`, `idpetugas_fk`, `active`, `created_at`, `updated_at`,
                     `created_by`, `updated_by`)
values (13, 'senin', '9:00', '17:00', 56, 1, '2020-11-13 20:57:59', '2020-11-13 20:57:59', NULL, NULL),
       (14, 'selasa', '13:00', '20:00', 56, 1, '2020-11-13 20:58:23', '2020-11-13 20:58:23', NULL, NULL);

/*Table structure for table `konfigurasi` */

DROP TABLE IF EXISTS `konfigurasi`;

CREATE TABLE `konfigurasi`
(
    `id`      int(11) NOT NULL AUTO_INCREMENT,
    `label`   varchar(100) NOT NULL,
    `key`     varchar(50)  NOT NULL,
    `content` text         NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=849 DEFAULT CHARSET=latin1;

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
       (848, '2020-11-13 21:27:49', 15, 'tono Berhasil Daftar Layanan Rekam Medis');

/*Table structure for table `pengguna` */

DROP TABLE IF EXISTS `pengguna`;

CREATE TABLE `pengguna`
(
    `id`           int(11) NOT NULL AUTO_INCREMENT,
    `username`     varchar(50)  NOT NULL,
    `nama`         varchar(150) NOT NULL,
    `password`     text         NOT NULL,
    `notelepon`    varchar(16) DEFAULT NULL,
    `avatar`       varchar(255) DEFAULT NULL,
    `email`        varchar(255) DEFAULT NULL,
    `active`       tinyint(4) DEFAULT '1',
    `level`        enum('admin','dokter','bidan','pasien','pimpinan') DEFAULT NULL,
    `id_poli_fk`   int(11) DEFAULT NULL,
    `alamat`       varchar(255) DEFAULT NULL,
    `jk`           enum('pria','wanita') DEFAULT 'pria',
    `tgl_lahir`    date DEFAULT '1990-01-01',
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
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pengguna` */

insert into `pengguna`(`id`, `username`, `nama`, `password`, `notelepon`, `avatar`, `email`, `active`, `level`,
                       `id_poli_fk`, `alamat`, `jk`, `tgl_lahir`, `gol_darah`, `tinggi_badan`, `berat_badan`, `bpjs`,
                       `nama_kk`, `pekerjaan`, `agama`, `deskripsi`, `created_at`, `updated_at`)
values (1, 'superadmin', 'Edi Maryanto', '$2y$10$3NVP6DZi7rs919bi6uxvteQJvNlv9Qp/1E3BhX4XjfJC1ATWKDP1u', '0804328',
        '1604159317_39da846aa8ef988002a9.png', 'super@lampungprov.go.id', 1, 'admin', NULL, 'Teluk', 'pria',
        '1990-05-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL,
        '<h3 style=\"margin: 15px 0px; padding: 0px; font-weight: 700; font-size: 14px; font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;\"=\"\">The standard Lorem Ipsum passage, used since the 1500s</h3><p style=\"margin-bottom: 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><ol><li style=\"margin-bottom: 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0);\">fasdfdf</li><li style=\"margin-bottom: 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0);\">asdfasdf</li><li style=\"margin-bottom: 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0);\">asdfasdf</li></ol>',
        '2020-07-19 09:10:40', '2020-10-31 22:48:37'),
       (55, 'yudi', 'Yudi', '$2y$10$9yEUUf0HS7vcYjbq..OvZ.CkeuuTekgQ2JwH7U6I2wJfAX4wKFrWG', '08304',
        '1605275655_0a0f5c51268ea4bfcea9.png', 'yudi@gmail.com', 1, 'pasien', NULL, 'Gunter', 'pria', '2010-11-13', 'B',
        171, 70, 'YA', 'Beni', 'Wiraswasta', 'Islam', '', '2020-11-13 20:54:15', '2020-11-13 20:54:15'),
       (56, 'angga', 'dr Angga', '$2y$10$lDMJGSmiJ.cQ715O3tGgVOsIyHZaAbOjYIjRsJ92DwzWlzxVtIrO2', '080', '',
        'angga@gmail.com', 1, 'dokter', 142, 'Rajabasa', 'pria', '1997-11-14', '-', NULL, NULL, '-', NULL, NULL, NULL,
        '<ol><li>Lulusan S1 Sarjana</li><li><br></li></ol>', '2020-11-13 20:57:09', '2020-11-13 20:57:09'),
       (57, 'cristiano', 'Cristiano', '$2y$10$2gUJB/AsVxdMLkwOhq1WmumVWgz2K4DeN2HtUeDTczT1ntNft8XDK', '0834', '',
        'cr7@gmail.com', 1, 'pimpinan', NULL, NULL, 'pria', '1990-01-01', '-', NULL, NULL, '-', NULL, NULL, NULL, NULL,
        '2020-11-13 20:59:27', '2020-11-13 20:59:27'),
       (58, 'tono', 'Tono', '$2y$10$/6J/bXSz6uNv.TFIyBqRa.31oIhyY6no8goqQbKP09Xju3X7zqFpa', '8080', '',
        'tono@gmail.com', 1, 'pasien', NULL, 'Jepang', 'pria', '2001-11-13', '-', 180, 87, 'YA', 'Sugiono', 'Analyst',
        'Islam', '', '2020-11-13 21:08:11', '2020-11-13 21:12:53'),
       (59, 'rendi', 'rendi', '$2y$10$rh97YWGv72XBJeLChIMXou3rQ8tp3XmzxDu/TxDh5QMDPZojAeWTa', '123455', '',
        'rendi@gmail.com', 1, 'dokter', 142, 'antasari', 'pria', '2012-11-01', '-', NULL, NULL, '-', NULL, NULL, NULL,
        '', '2020-11-13 21:22:26', '2020-11-13 21:22:26');

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
       (143, 'Poli Bidan', 1, '2020-11-13 20:55:34', '2020-11-13 20:55:34', 1, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

/*Data for the table `rekam_medis` */

insert into `rekam_medis`(`id_rekam`, `nomor_rekam`, `id_daftar_fk`, `tgl_berobat`, `subyektif`, `obyektif`,
                          `assesment`, `planning`, `keterangan_rm`, `created_at`, `updated_at`, `created_by`,
                          `updated_by`)
values (10, 'R001', 10, '2020-11-24', 'Subyektif 1', 'Obyektif 1', 'Assesment 1', 'Planning 1', 'Ket 1',
        '2020-11-13 21:05:02', '2020-11-13 21:05:02', 56, 56),
       (11, 'R022', 11, '2020-12-01', 'A', 'B', 'C', 'D', 'E', '2020-11-13 21:06:50', '2020-11-13 21:06:50', 56, 56);

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
 `keterangan_rm` text 
)*/;

/*View structure for view vdaftar */

/*!50001 DROP TABLE IF EXISTS `vdaftar` */;
/*!50001 DROP VIEW IF EXISTS `vdaftar` */;

/*!50001 CREATE  VIEW `vdaftar` AS select `daftar`.`id_daftar` AS `id_daftar`,`daftar`.`id_pasien_fk` AS `id_pasien_fk`,`pengguna`.`nama` AS `nama`,`pengguna`.`tinggi_badan` AS `tinggi_badan`,`pengguna`.`berat_badan` AS `berat_badan`,`pengguna`.`nama_kk` AS `nama_kk`,`pengguna`.`agama` AS `agama`,`pengguna`.`pekerjaan` AS `pekerjaan`,`pengguna`.`tgl_lahir` AS `tgl_lahir`,`pengguna`.`alamat` AS `alamat`,`pengguna`.`jk` AS `jk`,`pengguna`.`notelepon` AS `notelepon`,`daftar`.`id_jadwal_fk` AS `id_jadwal_fk`,`vjadwal`.`hari` AS `hari`,`vjadwal`.`dari` AS `dari`,`vjadwal`.`sampai` AS `sampai`,`vjadwal`.`idpetugas_fk` AS `idpetugas_fk`,`vjadwal`.`nama_petugas` AS `nama_petugas`,`vjadwal`.`level` AS `level`,`vjadwal`.`id_poli_fk` AS `id_poli_fk`,`vjadwal`.`nama_poli` AS `nama_poli`,`daftar`.`tgl_daftar` AS `tgl_daftar`,`daftar`.`layanan` AS `layanan`,`daftar`.`keterangan` AS `keterangan`,`daftar`.`nomor_urut` AS `nomor_urut`,`daftar`.`status` AS `status`,`daftar`.`created_at` AS `created_at`,`daftar`.`updated_at` AS `updated_at` from ((`daftar` join `vjadwal` on((`daftar`.`id_jadwal_fk` = `vjadwal`.`id_jadwal`))) join `pengguna` on((`daftar`.`id_pasien_fk` = `pengguna`.`id`))) */;

/*View structure for view vjadwal */

/*!50001 DROP TABLE IF EXISTS `vjadwal` */;
/*!50001 DROP VIEW IF EXISTS `vjadwal` */;

/*!50001 CREATE  VIEW `vjadwal` AS select `jadwal`.`id_jadwal` AS `id_jadwal`,`jadwal`.`hari` AS `hari`,`jadwal`.`dari` AS `dari`,`jadwal`.`sampai` AS `sampai`,`jadwal`.`active` AS `active`,ifnull(`jadwal`.`idpetugas_fk`,'-') AS `idpetugas_fk`,ifnull(`vpengguna`.`nama`,'-') AS `nama_petugas`,`vpengguna`.`level` AS `level`,ifnull(`vpengguna`.`id_poli_fk`,'-') AS `id_poli_fk`,ifnull(`vpengguna`.`nama_poli`,'-') AS `nama_poli`,`jadwal`.`created_at` AS `created_at`,`jadwal`.`updated_at` AS `updated_at` from (`jadwal` left join `vpengguna` on((`jadwal`.`idpetugas_fk` = `vpengguna`.`id`))) */;

/*View structure for view vpengguna */

/*!50001 DROP TABLE IF EXISTS `vpengguna` */;
/*!50001 DROP VIEW IF EXISTS `vpengguna` */;

/*!50001 CREATE  VIEW `vpengguna` AS select `pengguna`.`id` AS `id`,`pengguna`.`username` AS `username`,`pengguna`.`nama` AS `nama`,`pengguna`.`password` AS `password`,`pengguna`.`notelepon` AS `notelepon`,`pengguna`.`avatar` AS `avatar`,`pengguna`.`email` AS `email`,`pengguna`.`active` AS `active`,`pengguna`.`level` AS `level`,`pengguna`.`alamat` AS `alamat`,`pengguna`.`jk` AS `jk`,`pengguna`.`tgl_lahir` AS `tgl_lahir`,`pengguna`.`deskripsi` AS `deskripsi`,`pengguna`.`gol_darah` AS `gol_darah`,`pengguna`.`tinggi_badan` AS `tinggi_badan`,`pengguna`.`berat_badan` AS `berat_badan`,`pengguna`.`bpjs` AS `bpjs`,`pengguna`.`pekerjaan` AS `pekerjaan`,`pengguna`.`agama` AS `agama`,`pengguna`.`nama_kk` AS `nama_kk`,ifnull(`pengguna`.`id_poli_fk`,'-') AS `id_poli_fk`,ifnull(`poli`.`nama_poli`,'-') AS `nama_poli`,`pengguna`.`created_at` AS `created_at`,`pengguna`.`updated_at` AS `updated_at` from (`pengguna` left join `poli` on((`pengguna`.`id_poli_fk` = `poli`.`id_poli`))) */;

/*View structure for view vrekam */

/*!50001 DROP TABLE IF EXISTS `vrekam` */;
/*!50001 DROP VIEW IF EXISTS `vrekam` */;

/*!50001 CREATE  VIEW `vrekam` AS select `rekam_medis`.`id_rekam` AS `id_rekam`,`rekam_medis`.`nomor_rekam` AS `nomor_rekam`,`rekam_medis`.`id_daftar_fk` AS `id_daftar_fk`,`vdaftar`.`id_pasien_fk` AS `id_pasien_fk`,`vdaftar`.`nama` AS `nama`,`vdaftar`.`nama_poli` AS `nama_poli`,`rekam_medis`.`tgl_berobat` AS `tgl_berobat`,`rekam_medis`.`subyektif` AS `subyektif`,`rekam_medis`.`obyektif` AS `obyektif`,`rekam_medis`.`assesment` AS `assesment`,`rekam_medis`.`planning` AS `planning`,`rekam_medis`.`keterangan_rm` AS `keterangan_rm` from (`rekam_medis` join `vdaftar` on(((`rekam_medis`.`id_daftar_fk` = `vdaftar`.`id_daftar`) and (`vdaftar`.`status` = 'selesai')))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
