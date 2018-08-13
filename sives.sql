-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2018 at 06:42 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sives`
--

-- --------------------------------------------------------

--
-- Table structure for table `berkas`
--

CREATE TABLE `berkas` (
  `id_berkas` int(10) NOT NULL,
  `id_mk` int(10) NOT NULL,
  `id_tipe_berkas` int(10) NOT NULL,
  `nama_file` varchar(225) NOT NULL,
  `tanggal_unggah` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `file` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `berkas`
--

INSERT INTO `berkas` (`id_berkas`, `id_mk`, `id_tipe_berkas`, `nama_file`, `tanggal_unggah`, `file`) VALUES
(1, 20, 1, 'Makalah Sidang Sutrisno (G64140045).pdf', '2018-07-24 09:03:26', 'upload/berkas_verifikasi/TA_2017-2018/Ganjil/Sistem Cerdas/Makalah Sidang Sutrisno (G64140045).pdf'),
(2, 15, 2, 'Makalah Sidang Sutrisno (G64140045).pdf', '2018-07-24 09:16:04', 'upload/berkas_kontrak_kuliah/TA_2017-2018/Ganjil/Pengantar Bioinformatika/Makalah Sidang Sutrisno (G64140045).pdf'),
(3, 15, 3, 'Makalah Sidang Sutrisno (G64140045).pdf', '2018-07-24 09:39:44', 'upload/berkas_bap/TA_2017-2018/Ganjil/Pengantar Bioinformatika/Makalah Sidang Sutrisno (G64140045).pdf'),
(4, 22, 3, 'DRAF SKRIPSI YOGA.pdf', '2018-07-24 10:36:05', 'upload/berkas_bap/TA_2017-2018/Ganjil/Pemrosesan Suara dan  Bahasa Alami/DRAF SKRIPSI YOGA.pdf'),
(5, 17, 3, 'DRAF SKRIPSI YOGA.pdf', '2018-07-24 16:39:47', 'upload/berkas_bap/TA_2017-2018/Ganjil/Pengantar Teknologi Geospasial/DRAF SKRIPSI YOGA.pdf'),
(6, 15, 2, 'DRAF SKRIPSI YOGA.pdf', '2018-07-25 05:46:31', 'upload/berkas_kontrak_kuliah/TA_2017-2018/Ganjil/Pengantar Bioinformatika/DRAF SKRIPSI YOGA.pdf'),
(7, 17, 2, 'DRAF SKRIPSI YOGA.pdf', '2018-07-25 05:46:39', 'upload/berkas_kontrak_kuliah/TA_2017-2018/Ganjil/Pengantar Teknologi Geospasial/DRAF SKRIPSI YOGA.pdf'),
(8, 17, 2, 'Makalah Sidang Sutrisno (G64140045).pdf', '2018-07-25 05:49:56', 'upload/berkas_kontrak_kuliah/TA_2017-2018/Ganjil/Pengantar Teknologi Geospasial/Makalah Sidang Sutrisno (G64140045).pdf');

-- --------------------------------------------------------

--
-- Table structure for table `form_verifikasi`
--

CREATE TABLE `form_verifikasi` (
  `id_form` int(10) NOT NULL,
  `id_versi` int(10) NOT NULL,
  `kesesuaian_lo` varchar(50) NOT NULL,
  `penjelasan_lo` varchar(225) DEFAULT NULL,
  `kesesuaian_bs` varchar(50) NOT NULL,
  `penjelasan_bs` varchar(225) DEFAULT NULL,
  `estimasi_wkt` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `tanggal_verif` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form_verifikasi`
--

INSERT INTO `form_verifikasi` (`id_form`, `id_versi`, `kesesuaian_lo`, `penjelasan_lo`, `kesesuaian_bs`, `penjelasan_bs`, `estimasi_wkt`, `status`, `tanggal_verif`) VALUES
(1, 1, 'Sesuai', NULL, 'Mewakili', NULL, 'Cukup', 'Sesuai', '0000-00-00'),
(2, 3, 'Sesuai', NULL, 'Mewakili', NULL, 'Cukup', 'Sesuai', '2018-08-05');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_ujian`
--

CREATE TABLE `jadwal_ujian` (
  `id_jadwal` int(10) NOT NULL,
  `id_mk` int(10) NOT NULL,
  `tanggal_ujian` date NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal_ujian`
--

INSERT INTO `jadwal_ujian` (`id_jadwal`, `id_mk`, `tanggal_ujian`, `waktu_mulai`, `waktu_selesai`) VALUES
(1, 15, '2018-07-16', '10:00:00', '00:00:00'),
(2, 17, '2018-07-23', '08:00:00', '10:00:00'),
(3, 21, '2018-07-19', '08:00:00', '10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `konfigurasi`
--

CREATE TABLE `konfigurasi` (
  `id_konfigurasi` int(10) NOT NULL,
  `periode` varchar(50) NOT NULL,
  `tahun1` int(10) NOT NULL,
  `tahun2` int(10) NOT NULL,
  `verifikator` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konfigurasi`
--

INSERT INTO `konfigurasi` (`id_konfigurasi`, `periode`, `tahun1`, `tahun2`, `verifikator`) VALUES
(20, 'Ganjil', 2017, 2018, 'UTS'),
(21, 'Ganjil', 2017, 2018, 'UTS'),
(22, 'Ganjil', 2017, 2018, 'UTS'),
(23, 'Ganjil', 2017, 2018, 'UTS'),
(24, 'Ganjil', 2017, 2018, 'UTS'),
(25, 'Ganjil', 2017, 2018, 'UTS'),
(26, 'Ganjil', 2017, 2018, 'UTS'),
(27, 'Ganjil', 2017, 2018, 'UTS');

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `id_mk` int(10) NOT NULL,
  `kode_mk` varchar(50) NOT NULL,
  `nama_mk` varchar(225) NOT NULL,
  `bobot_sks` varchar(50) NOT NULL,
  `koordinator` int(10) NOT NULL,
  `status_mk` varchar(50) NOT NULL,
  `status_unggah` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`id_mk`, `kode_mk`, `nama_mk`, `bobot_sks`, `koordinator`, `status_mk`, `status_unggah`) VALUES
(15, 'FMP400', 'Pengantar Bioinformatika', '3(2-2)', 5, 'Wajib', 1),
(16, 'KOM332', 'Data Mining', '3(2-2)', 9, 'Wajib', 1),
(17, 'KOM341', 'Pengantar Teknologi Geospasial', '3(2-2)', 9, 'Pilihan', 1),
(18, 'KOM431', 'Temu Kembali Informasi', '3(2-2)', 3, 'Pilihan', 0),
(19, 'KOM207', 'Struktur Data', '3(2-2)', 22, 'Wajib', 0),
(20, 'KOM320', 'Sistem Cerdas', '3(2-2)', 3, 'Wajib', 0),
(21, 'KOM341', 'Sistem Informasi', '3(2-2)', 6, 'Wajib', 0),
(22, 'KOM420', 'Pemrosesan Suara dan  Bahasa Alami', '3(2-2)', 3, 'Pilihan', 0);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mst_tipe`
--

CREATE TABLE `mst_tipe` (
  `id_tipe` int(10) NOT NULL,
  `nama_tipe` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `peran`
--

CREATE TABLE `peran` (
  `id_peran` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_mk` int(10) NOT NULL,
  `peran` varchar(50) NOT NULL,
  `sesi_verif` varchar(50) DEFAULT NULL,
  `tahun1` int(10) NOT NULL,
  `tahun2` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peran`
--

INSERT INTO `peran` (`id_peran`, `id_user`, `id_mk`, `peran`, `sesi_verif`, `tahun1`, `tahun2`) VALUES
(86, 14, 15, 'Verifikator', 'UTS', 2017, 2018),
(87, 14, 15, 'Verifikator', 'UAS', 2017, 2018),
(88, 9, 16, 'Pengajar', NULL, 2017, 2018),
(89, 14, 16, 'Pengajar', NULL, 2017, 2018),
(90, 22, 16, 'Pengajar', NULL, 2017, 2018),
(91, 14, 16, 'Verifikator', 'UTS', 2017, 2018),
(92, 14, 16, 'Verifikator', 'UAS', 2017, 2018),
(93, 9, 17, 'Pengajar', NULL, 2017, 2018),
(94, 21, 17, 'Pengajar', NULL, 2017, 2018),
(95, 22, 17, 'Pengajar', NULL, 2017, 2018),
(96, 5, 17, 'Verifikator', 'UTS', 2017, 2018),
(97, 5, 17, 'Verifikator', 'UAS', 2017, 2018),
(98, 3, 18, 'Pengajar', NULL, 2017, 2018),
(99, 9, 18, 'Pengajar', NULL, 2017, 2018),
(100, 14, 18, 'Pengajar', NULL, 2017, 2018),
(101, 5, 18, 'Verifikator', 'UTS', 2017, 2018),
(102, 5, 18, 'Verifikator', 'UAS', 2017, 2018),
(106, 7, 19, 'Verifikator', 'UTS', 2017, 2018),
(107, 7, 19, 'Verifikator', 'UAS', 2017, 2018),
(108, 3, 20, 'Pengajar', NULL, 2017, 2018),
(109, 9, 20, 'Pengajar', NULL, 2017, 2018),
(110, 14, 20, 'Pengajar', NULL, 2017, 2018),
(111, 7, 20, 'Verifikator', 'UTS', 2017, 2018),
(112, 7, 20, 'Verifikator', 'UAS', 2017, 2018),
(113, 5, 15, 'Pengajar', NULL, 2017, 2018),
(114, 22, 15, 'Pengajar', NULL, 2017, 2018),
(115, 25, 15, 'Pengajar', NULL, 2017, 2018),
(116, 6, 21, 'Pengajar', NULL, 2017, 2018),
(117, 13, 21, 'Pengajar', NULL, 2017, 2018),
(118, 21, 21, 'Pengajar', NULL, 2017, 2018),
(119, 5, 21, 'Verifikator', 'UTS', 2017, 2018),
(120, 5, 21, 'Verifikator', 'UAS', 2017, 2018),
(121, 3, 22, 'Pengajar', NULL, 2017, 2018),
(122, 4, 22, 'Pengajar', NULL, 2017, 2018),
(123, 5, 22, 'Pengajar', NULL, 2017, 2018),
(124, 7, 22, 'Verifikator', 'UTS', 2017, 2018),
(125, 7, 22, 'Verifikator', 'UAS', 2017, 2018),
(126, 9, 19, 'Pengajar', NULL, 2017, 2018),
(127, 14, 19, 'Pengajar', NULL, 2017, 2018),
(128, 22, 19, 'Pengajar', NULL, 2017, 2018);

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE `periode` (
  `id_mk` int(10) NOT NULL,
  `semester` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`id_mk`, `semester`) VALUES
(16, 6),
(17, 5),
(17, 6),
(18, 5),
(18, 6),
(20, 6),
(15, 7),
(21, 5),
(22, 6),
(22, 7),
(19, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tipe_berkas`
--

CREATE TABLE `tipe_berkas` (
  `id_tipe_berkas` int(10) NOT NULL,
  `nama_tipe` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipe_berkas`
--

INSERT INTO `tipe_berkas` (`id_tipe_berkas`, `nama_tipe`) VALUES
(1, 'Hasil Verifikasi'),
(2, 'Kontrak Kuliah'),
(3, 'Berita Acara Perkuliahan (BAP)');

-- --------------------------------------------------------

--
-- Table structure for table `tipe_soal`
--

CREATE TABLE `tipe_soal` (
  `id_form` int(10) NOT NULL,
  `id_tipe` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipe_soal`
--

INSERT INTO `tipe_soal` (`id_form`, `id_tipe`) VALUES
(1, 5),
(2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `kode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nip` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` int(10) NOT NULL DEFAULT '2',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `kode`, `nip`, `name`, `username`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`, `status`) VALUES
(1, 'ADM', '1111111111', 'Admin', '', 'admin@gmail.com', '$2y$10$ciwn1TnGdVjPChQt2lhq4eypmdPHCdatxG0ps2NrU5apDmzqWGJsy', 1, '7MGUpTcjAIZtQD9basgPAFjft3LqY1DeQfgjJ3Z3P3bOSEmBCLbDdDdUVmCA', '2018-05-27 07:08:41', '2018-07-07 22:00:29', '1'),
(2, 'TU', '121212121', 'Tata Usaha', '', 'tu@gmail.com', '$2y$10$r3qbeo9JafXoHi/VdZ0Bue17jbql5tdKMJVz8cDPjOtaBMZGoTGKO', 1, 'aySHzjb5mhLPcFPfdD25mALiMSL9jGDb5PEcR9uOFU3QgDrdpppJPTNkOkEM', '2018-05-27 07:43:21', '2018-05-27 08:00:52', '1'),
(3, 'AGB', '123123123', 'Dr. Ir. Agus Buono, M.Si, M.Kom', '', 'agusbuono@gmail.com', '$2y$10$o3lonwUFRJ6fzunS2t1NCeY0SjASNZGi2OqEZECBDAJuuAqTMGxPK', 2, 'IbIaLTMuPiVtLx83QTpGIN3Tgkihc4PFHGLr5SsRHmc12jEVy0QcwMWBNzyq', '2018-05-27 07:47:25', '2018-07-09 04:52:03', '1'),
(4, 'ARD', '232123212', 'Ahmad Ridha, S.Kom, MS', '', 'ahmadridha@gmail.com', '$2y$10$vLT7IP.9evBNxil2D5zN4uHdBCuHIft7KL.RTNudMHEgHRDunnQuK', 2, 'JpwyxLUtQZuFCiGXWBkKTFboKJlwPT9bZsys83Ecm2y3xuJvFSaNozYw7g0w', '2018-05-27 07:47:52', '2018-07-08 01:17:52', '1'),
(5, 'WAK', '344453211', 'Dr. Eng. Wisnu Ananta Kusuma, ST, MT', '', 'wisnuananta@gmail.com', '$2y$10$wFvUIMOYaZs5fLvL99m05efnI4wU3aNnMZseCk87YDrwVoiw76VV.', 2, 'QjFcFXZYlkMrAE2BTw52vVzwcA9d4B8KRY1CvD7W51giIdwEd443dZamQV71', '2018-05-27 07:48:14', '2018-05-27 08:01:18', '1'),
(6, 'YNY', '232311223', 'Dr. Yani Nurhadriyani, S.Si, MT', '', 'yaninurhadriyani@gmail.com', '$2y$10$O5edhYyzfhje82TcvUZywuR2qC0hJGdS56pPu7l9poi0zmyocqMLe', 2, 'JZZ8N7v9msKj0LDdpmDSeCsrYALGnhoypFP21IeGI97FioUrbqM94PXcSNjR', '2018-05-27 07:49:16', '2018-05-27 08:01:46', '1'),
(7, 'FAR', '443112233', 'Firman Ardiansyah S.Kom, M.Si', '', 'firmanardiansyah@gmail.com', '$2y$10$w6U4nnA7SugszxrDczIL6O7BWZ.Tl.3K2K.TEXRD7ym5QHxQNzg2a', 2, 'OssJ3rnZqxl5pLmMd8m0qZtdSwgKnh4rAh2rk5K54twmWOCYFHqJ12cR0vSd', '2018-05-27 07:49:40', '2018-07-08 01:42:20', '1'),
(8, 'HRS', '554221233', 'Dr. Eng. Heru Sukoco, S.Si, MT', '', 'herusukoco@gmail.com', '$2y$10$oKvS.2PY02C/bzoQS4.epOaMmoDkztyCfIYTU4KUzNdWOmF8Gfji6', 2, 'jKoxTVX2qpZ0eG0b18WABBdRpJ5pABHgfFX6oC1COapjc0xgS8hChBxf5stG', '2018-05-27 07:50:10', '2018-07-09 04:46:30', '1'),
(9, 'ISS', '644231134', 'Dr. Imas Sukaesih Sitanggang, S.Si, M.Kom', '', 'imassukaesih@gmail.com', '$2y$10$u.eIjbEGSOaE46PbTJLPlu7S1fZ9nnU89F689b/60OzcOQ2gdLDkK', 2, 'zKox8VMJaZrcBqokLZjE4s6EmDoXDbj9noWOOTzT9TiDiyyyfikdxxAKaROJ', '2018-05-27 07:50:40', '2018-07-09 04:52:03', '1'),
(10, 'JAS', '1243423422', 'Ir. Julio Adisantoso, M.Kom', '', 'julioadisantoso@gmail.com', '$2y$10$KN0BgvATSyPvWqvoA5WU.OOYbGSIvUZyfUb5UHoxjCm8ADzmx/DR2', 2, 'xNOaW57XJbWkIGEqJCIhUc2PDuCG31rlWgQtio80KwqEAXuvzuvnl71BQh3b', '2018-05-27 07:51:12', '2018-07-15 20:36:42', '1'),
(11, 'MRC', '2343333333', 'Ir. Meuthia Rachmaniah, M.Sc', '', 'meuthiarachmaniah@gmail.com', '$2y$10$TRVQKEDAysIF/bAFRIjfQOMyG0HDBuQCzj2YuJHGyiH21nYGp0zh6', 2, 'hWgU0D9W1iNXHz6nfYTLEXvcnJ41nTCuHnLnuy9HGwdfXjrNXjEHBCr2zuYe', '2018-05-27 07:52:02', '2018-05-27 08:06:14', '1'),
(12, 'SWJ', '345231231', 'Dr. Ir. Sri Wahjuni, MT', '', 'sriwahjuni@gmail.com', '$2y$10$LerAmBJmAx4vlbLmn1ovq.A2wWV5ZTDe1P38lFk7Ow.C5a8m1Nrva', 2, '4cZEzgYQp9Tj3LCxddqSwNiz8iLhSPFZpig7VW1UCPjVYNKSZljOWaD3oX50', '2018-05-27 07:52:40', '2018-05-27 08:02:58', '1'),
(13, 'IRH', '2524431114', 'Irman Hermadi, S.Kom, M.Sc, PhD', '', 'irmanhermadi@gmail.com', '$2y$10$wk5L.7htRAioAKSvQMPHf.U3falRm5xusN.XfyoQEmhyhwDtQRk6q', 2, 'Zvjeyn9TL3GVuTa1MwzLhsDBXCL7JXO0NdjNfGlcT6U6DBi78BocitvbMtpa', '2018-05-27 07:53:09', '2018-07-15 20:36:35', '1'),
(14, 'MAA', '5252223434', 'Muhammad Ashyar Agmalaro, S.Si, M.Kom', '', 'muhammadashyar@gmail.com', '$2y$10$hEpN1iQix8V5cvfR5BEMn.MePwUcne0hxkjsoyQlmN99J3znaUJ0S', 2, 'gDq7THREDqeynqt8A7uRK0wTzbYNZqUPVXMjoE2g0SmJvCGFl8AzkpQuO8ag', '2018-05-27 07:53:41', '2018-06-01 00:23:33', '1'),
(15, 'THR', '233243432', 'Toto Haryanto, S.Kom, M.Si', '', 'totoharyanto@gmail.com', '$2y$10$kB8RwPdegj0Rfno6h2z16u9Qjmhy/BYy4m7aTN/c6B9pG7k.5Z7fq', 2, 'GTXWgNk7fooYVbGtcjAAhngep3kU89AT7fOl2Isvc34phoCImEdbOWzcOiIV', '2018-05-27 07:54:14', '2018-07-15 00:42:52', '0'),
(16, 'KKN', '223343423', 'Karlina Khiyarin Nisa, S.Kom, M.T', '', 'karlina@gmail.com', '$2y$10$Wj7FManDyYtSC5HJS1ifeuAwsJU0OCBEzUs9qIJW4vlTlb3qbIXIm', 2, '4u8IdGWK4bMNApmpCyxw3m7iCtvxHXM8rakgYCcCdDWXnH4k1BjdZ7vZHxHD', '2018-05-27 07:54:40', '2018-05-27 08:07:07', '1'),
(17, 'ARA', '1231233223', 'Auriza Rahmad Akbar, S.Komp.', '', 'aurizarahmad@gmail.com', '$2y$10$Qr7y6VaVKpw2eSU4ODAgi.6wvGkF.lMe9MkBSLxDHRXUYCoBsWgFO', 2, 'EuVd4Vu5auZPTMvH9Q5VqWAkuG1P7cKpZiM987BZfH6Oz1Hd8O06FzrOUG6X', '2018-05-27 07:55:08', '2018-05-27 08:04:11', '1'),
(18, 'AAS', '1434321344', 'Auzi Asfarian, S.Komp.', '', 'auziasfarian@gmail.com', '$2y$10$XoEtOf6eItU.Jf5iPx5wLuK3ZY5CDOf66EClHyk03FlM25bCMSjn.', 2, 'PuwFPB7mjKSZ4WI9yIPR4di4HvWtgWy6JjfU1jw1kTPxB5cFjcWkEUaRgZx6', '2018-05-27 07:55:37', '2018-07-15 23:27:32', '0'),
(19, 'MAI', '5435432324', 'Muhammad Abrar Istiadi, S.Komp.', '', 'muhammadabrar@gmail.com', '$2y$10$YnQHNR41fWPlkukFE2o9DeGkvmdMxbHsiu3yc2lNbKeWJ0/m0gYY.', 2, 'WrUosNQ6awIIwJsgnqg2uSTpZ3bv7xP29gukAuH7TC47Rou7x7xOoJQJH0TM', '2018-05-27 07:56:06', '2018-05-27 08:04:38', '1'),
(20, 'DAR', '1233434234', 'Dean Aprilia Ramadhan, S.Komp.', '', 'deanapriatna@gmail.com', '$2y$10$nRQdhn/2VSe25IINe/BVSe2KWee16TY2xIHeepMdDH76E1BSQ3of6', 2, 'h2VwUM0Q1WCSDPgzusA6DgWYmeI6AqEP4AAvYjFWNpkS9SHetkkXND81Tr0u', '2018-05-27 07:56:35', '2018-05-27 08:04:51', '1'),
(21, 'RTN', '5542342444', 'Rina Trisminingsih, S.Kom, M.T', '', 'rinatrisminingsih@gmail.com', '$2y$10$x91XRmD98UzR/MLHfZ8k5u2m7XNObPkFWblorNJejmmnxwaJx.k06', 2, 'Pu4TnW3wwbj2DmMACXvlOVN3IJvMGTUfZ6CiAPibEfXGgFtcufbJ7PywZ0y2', '2018-05-27 07:57:03', '2018-05-27 08:05:39', '1'),
(22, 'HKH', '2234323424', 'Husnul Khotimah, S.Komp, M.Kom', '', 'husnulkhotimah@gmail.com', '$2y$10$IylgoZosM.NAJoYwdiaPG.6yiT6.Xim6U6qPBx/yFIJeve1Wz7Aga', 2, '1oTb3QXzKaDuJgZ5L4jgNOAy7TlgrXDwa15q4eegi21VtUDKhzakwbzm2pyr', '2018-05-27 07:57:24', '2018-06-01 00:28:08', '1'),
(23, 'VKD', '313432424', 'Vektor Dewanto, S.T, M.Eng', '', 'vektordewanto@gmail.com', '$2y$10$sPmnTPKnabxXM/kU0K013..3TZNcJNt/PFCpCQZhInH4a8o/0gHi.', 2, '19UunNdFy0LDOZvrYFSLfvOvHNy9wzEGVUcCBxsZdThxHWGTsbV5NIp0vm8L', '2018-05-27 07:57:49', '2018-05-27 08:07:20', '1'),
(24, 'SNN', '2432432434', 'Dr. Shelvie Nidya Neyman,S.Kom, M.Si', '', 'shelvienidya@gmail.com', '$2y$10$uX476c.qJnIrORhelDBvZ.Fq5jHC1T329D87BJYEl8gDH1BACa05y', 2, 'Jerp1RoX10tGKJ6mo07zIarBpqmJHrErghNnRvWG3urMV8AaFalbkPa3GP1R', '2018-05-27 07:58:16', '2018-05-27 08:06:55', '1'),
(25, 'LSH', '2233234343', 'Lailan Sahrina Hasibuan, S.Kom, M.Kom', '', 'lailansahrina@gmail.com', '$2y$10$.DlXw0J8IGPtDKlP3eVLwe3B4X/YeEzPK/3k5.gWUYaYU.2Qm.RHK', 2, 'HtBjl34oi1bvylqZPVeZ3X8zSiwWVe19NSTcwomoc7X8eiJMxtovXG0vB73y', '2018-05-27 07:58:42', '2018-05-27 08:06:29', '1'),
(26, 'ENO', '22424234342', 'eno eno', 'sutrisno_28', 'sutrisnoeno53@gmail.com', NULL, 1, NULL, '2018-07-29 08:05:22', '2018-07-29 08:05:22', '1'),
(27, 'fadlan', '7824623874632', 'fadlan fadlan', 'fadlan', 'fadlan@gmail.com', NULL, 2, NULL, '2018-07-29 08:24:47', '2018-07-29 08:24:47', '1');

-- --------------------------------------------------------

--
-- Table structure for table `verifikasi`
--

CREATE TABLE `verifikasi` (
  `id_verifikasi` int(10) NOT NULL,
  `id_konfigurasi` int(10) NOT NULL,
  `verifikator` int(10) NOT NULL,
  `id_mk` int(10) NOT NULL,
  `jenis_ujian` varchar(50) NOT NULL,
  `status_verif` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `verifikasi`
--

INSERT INTO `verifikasi` (`id_verifikasi`, `id_konfigurasi`, `verifikator`, `id_mk`, `jenis_ujian`, `status_verif`) VALUES
(1, 27, 14, 16, 'UTS', 2),
(2, 27, 5, 17, 'UTS', 0),
(3, 27, 14, 15, 'UTS', 2);

-- --------------------------------------------------------

--
-- Table structure for table `versi_soal`
--

CREATE TABLE `versi_soal` (
  `id_versi` int(10) NOT NULL,
  `id_verifikasi` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `nama_file` varchar(225) NOT NULL,
  `file` varchar(225) NOT NULL,
  `tanggal_unggah` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status_versi` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `versi_soal`
--

INSERT INTO `versi_soal` (`id_versi`, `id_verifikasi`, `id_user`, `nama_file`, `file`, `tanggal_unggah`, `status_versi`) VALUES
(1, 1, 22, 'DRAF SKRIPSI RANGGA.docx', 'upload/berkas_soal/TA_2017-2018/Ganjil/Data Mining/DRAF SKRIPSI RANGGA.docx', '2018-08-02 13:11:47', 0),
(2, 2, 22, 'DRAFT SKRIPSI LARAS.lkas.ass.docx', 'upload/berkas_soal/TA_2017-2018/Ganjil/Pengantar Teknologi Geospasial/DRAFT SKRIPSI LARAS.lkas.ass.docx', '2018-08-02 13:16:45', 0),
(3, 3, 22, 'DRAF SKRIPSI WIDIA.docx', 'upload/berkas_soal/TA_2017-2018/Ganjil/Pengantar Bioinformatika/DRAF SKRIPSI WIDIA.docx', '2018-08-02 13:17:24', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berkas`
--
ALTER TABLE `berkas`
  ADD PRIMARY KEY (`id_berkas`);

--
-- Indexes for table `form_verifikasi`
--
ALTER TABLE `form_verifikasi`
  ADD PRIMARY KEY (`id_form`);

--
-- Indexes for table `jadwal_ujian`
--
ALTER TABLE `jadwal_ujian`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `konfigurasi`
--
ALTER TABLE `konfigurasi`
  ADD PRIMARY KEY (`id_konfigurasi`);

--
-- Indexes for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`id_mk`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_tipe`
--
ALTER TABLE `mst_tipe`
  ADD PRIMARY KEY (`id_tipe`);

--
-- Indexes for table `peran`
--
ALTER TABLE `peran`
  ADD PRIMARY KEY (`id_peran`);

--
-- Indexes for table `tipe_berkas`
--
ALTER TABLE `tipe_berkas`
  ADD PRIMARY KEY (`id_tipe_berkas`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verifikasi`
--
ALTER TABLE `verifikasi`
  ADD PRIMARY KEY (`id_verifikasi`);

--
-- Indexes for table `versi_soal`
--
ALTER TABLE `versi_soal`
  ADD PRIMARY KEY (`id_versi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berkas`
--
ALTER TABLE `berkas`
  MODIFY `id_berkas` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `form_verifikasi`
--
ALTER TABLE `form_verifikasi`
  MODIFY `id_form` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jadwal_ujian`
--
ALTER TABLE `jadwal_ujian`
  MODIFY `id_jadwal` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `konfigurasi`
--
ALTER TABLE `konfigurasi`
  MODIFY `id_konfigurasi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  MODIFY `id_mk` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mst_tipe`
--
ALTER TABLE `mst_tipe`
  MODIFY `id_tipe` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `peran`
--
ALTER TABLE `peran`
  MODIFY `id_peran` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `verifikasi`
--
ALTER TABLE `verifikasi`
  MODIFY `id_verifikasi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `versi_soal`
--
ALTER TABLE `versi_soal`
  MODIFY `id_versi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
