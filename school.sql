-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 24, 2024 at 03:14 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` int NOT NULL,
  `kelas_id` int NOT NULL,
  `id_mata_pelajaran` int NOT NULL,
  `guru_id` int NOT NULL,
  `tanggal` date NOT NULL,
  `id_siswa` int NOT NULL,
  `status_absensi` enum('hadir','izin','sakit','alpa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id`, `kelas_id`, `id_mata_pelajaran`, `guru_id`, `tanggal`, `id_siswa`, `status_absensi`) VALUES
(180, 9, 2, 23, '2024-12-21', 3, 'hadir'),
(181, 7, 2, 23, '2024-12-21', 8, 'hadir'),
(183, 7, 2, 23, '2024-12-21', 9, 'hadir'),
(184, 7, 2, 23, '2024-12-21', 18, 'hadir'),
(185, 7, 2, 23, '2024-12-21', 19, 'hadir'),
(186, 7, 2, 23, '2024-12-21', 20, 'hadir'),
(187, 7, 2, 23, '2024-12-21', 21, 'hadir'),
(188, 7, 2, 23, '2024-12-21', 22, 'hadir'),
(189, 7, 2, 23, '2024-12-21', 23, 'hadir'),
(190, 7, 2, 23, '2024-12-21', 24, 'hadir'),
(191, 7, 2, 23, '2024-12-21', 25, 'hadir'),
(192, 7, 2, 23, '2024-12-21', 26, 'hadir'),
(193, 7, 2, 23, '2024-12-21', 27, 'hadir'),
(194, 7, 2, 23, '2024-12-21', 10, 'hadir'),
(195, 7, 2, 23, '2024-12-21', 28, 'hadir'),
(196, 7, 2, 23, '2024-12-21', 29, 'hadir'),
(197, 7, 2, 23, '2024-12-21', 30, 'hadir'),
(198, 7, 2, 23, '2024-12-21', 31, 'hadir'),
(199, 7, 2, 23, '2024-12-21', 32, 'hadir'),
(200, 7, 2, 23, '2024-12-21', 33, 'hadir'),
(201, 7, 2, 23, '2024-12-21', 34, 'hadir'),
(202, 7, 2, 23, '2024-12-21', 11, 'hadir'),
(203, 7, 2, 23, '2024-12-21', 12, 'hadir'),
(204, 7, 2, 23, '2024-12-21', 13, 'hadir'),
(205, 7, 2, 23, '2024-12-21', 14, 'hadir'),
(206, 7, 2, 23, '2024-12-21', 15, 'hadir'),
(207, 7, 2, 23, '2024-12-21', 16, 'hadir'),
(208, 7, 2, 23, '2024-12-21', 17, 'hadir'),
(209, 7, 2, 23, '2024-12-21', 35, 'hadir'),
(210, 7, 2, 23, '2024-12-21', 41, 'hadir');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`, `email`, `no_telp`, `photo`) VALUES
(1, 'admin', 'admin1', 'M Sultan Abdurahman Al zudas', 'danisubianto1@gmail.com', '085123456789', 'uploads/foto_admin/1734867030_islanf.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `bank_soal`
--

CREATE TABLE `bank_soal` (
  `id` int NOT NULL,
  `judul_bank_soal` varchar(255) DEFAULT NULL,
  `detail_bank_soal` text,
  `mata_pelajaran` varchar(255) DEFAULT NULL,
  `kelas` int DEFAULT NULL,
  `file_soal` varchar(255) DEFAULT NULL,
  `file_jawaban` varchar(255) DEFAULT NULL,
  `url_soal` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `url_jawaban` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bank_soal`
--

INSERT INTO `bank_soal` (`id`, `judul_bank_soal`, `detail_bank_soal`, `mata_pelajaran`, `kelas`, `file_soal`, `file_jawaban`, `url_soal`, `url_jawaban`) VALUES
(1, 'test', 'test1', 'Matematika', 7, '676184336bc98_23-163_Hengki Dwi Kurniawan_UAS.docx', NULL, NULL, NULL),
(3, 'test 10', 'ini test', 'Bahasa Indonesia', 8, '6761849a5b1e0_PAW B.php', '6761849a5cf7a_PAW B.php', 'https://www.google.com/', 'https://www.google.com/'),
(4, 'test 10', 'ini test', 'Bahasa Indonesia', 8, '676184d8ce8ab_PAW B.php', '676184d8cee58_PAW B.php', 'https://www.google.com/', 'https://www.google.com/'),
(5, 'test 10', 'ini test', 'Bahasa Indonesia', 8, '676185bb65612_PAW B.php', '676185bb773e1_PAW B.php', 'https://www.google.com/', 'https://www.google.com/'),
(7, 'p', 'soal UAS 1918', 'Bahasa Inggris', 9, NULL, NULL, 'https://chatgpt.com/', 'https://chatgpt.com/');

-- --------------------------------------------------------

--
-- Table structure for table `ebooks`
--

CREATE TABLE `ebooks` (
  `id` int NOT NULL,
  `judul` varchar(255) NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `deskripsi` text,
  `file_path` varchar(255) NOT NULL,
  `kategori_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ebooks`
--

INSERT INTO `ebooks` (`id`, `judul`, `penulis`, `deskripsi`, `file_path`, `kategori_id`) VALUES
(15, 'Perahu Kertas', 'De / Dewi Lestari', 'Perahu Kertas bercerita tentang dua orang yang sama-sama unik bernama Kugy dan Keenan', '../../uploads/ebook/assets/books/Perahu_Kertas.pdf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ekstrakurikuler`
--

CREATE TABLE `ekstrakurikuler` (
  `id_ekstrakurikuler` int NOT NULL,
  `nama_kegiatan` varchar(100) NOT NULL,
  `hari_kegiatan` enum('Senin','Selasa','Rabu','Kamis','Jum''at','Sabtu','Minggu') DEFAULT NULL,
  `pembimbing_id` int DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `tempat_kegiatan` varchar(50) DEFAULT NULL,
  `Deskripsi` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ekstrakurikuler`
--

INSERT INTO `ekstrakurikuler` (`id_ekstrakurikuler`, `nama_kegiatan`, `hari_kegiatan`, `pembimbing_id`, `jam_mulai`, `jam_selesai`, `tempat_kegiatan`, `Deskripsi`) VALUES
(1, 'Kelas Musik', 'Sabtu', 23, '15:00:00', '16:40:00', 'Ruang Band Sekolah', NULL),
(3, 'Drumband', 'Minggu', 26, '15:00:00', '17:00:00', 'Sekolah', 'Ekstrakurikuler Drumband adalah kegiatan seni pertunjukan yang melibatkan siswa dalam memainkan alat musik perkusi dan tiup. Kegiatan ini bertujuan untuk:\r\n\r\nMengembangkan Keterampilan Musik: Belajar membaca notasi dan teknik bermain.\r\nMembangun Kerja Sama Tim: Mengajarkan kolaborasi dan komunikasi.\r\nMenanamkan Disiplin: Melalui latihan rutin dan persiapan pertunjukan.\r\n\r\nKegiatan ini mencakup latihan rutin, pertunjukan, dan workshop, serta membantu siswa dalam pengembangan karakter dan keterampilan sosial.'),
(4, 'Futsal', 'Sabtu', 30, '18:30:00', '21:00:00', 'Lapangan Futsal SAKA', 'Ekstrakurikuler Futsal adalah kegiatan olahraga yang melibatkan permainan sepak bola dalam ruangan, dengan ukuran lapangan dan jumlah pemain yang lebih kecil. Kegiatan ini bertujuan untuk meningkatkan keterampilan sepak bola, membangun kerja sama tim, dan menjaga kebugaran fisik siswa. Selain itu, futsal juga mengajarkan disiplin dan tanggung jawab melalui latihan rutin dan partisipasi dalam kompetisi. Dengan demikian, siswa dapat bersosialisasi dan bersaing secara sehat.'),
(5, 'Volly', 'Minggu', 28, '15:00:00', '17:00:00', 'Lapangan Volly SOKA', 'Olahraga untuk prestasi sekolah, dengan pelatih berpengalaman serta fasilitas yang layak');

-- --------------------------------------------------------

--
-- Table structure for table `evaluasi`
--

CREATE TABLE `evaluasi` (
  `id_evaluasi` int NOT NULL,
  `siswa_id` int NOT NULL,
  `guru_id` int NOT NULL,
  `komentar` text,
  `rating` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `evaluasi`
--

INSERT INTO `evaluasi` (`id_evaluasi`, `siswa_id`, `guru_id`, `komentar`, `rating`) VALUES
(1, 3, 23, 'bagus', 5),
(2, 2, 28, 'Lumayan', 3),
(3, 1, 23, 'GG', 5),
(4, 8, 23, 'entut', 5);

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `fasilitas`
--

INSERT INTO `fasilitas` (`id`, `nama`) VALUES
(1, 'Papan Tulis'),
(2, 'Proyektor'),
(3, 'Kursi dan Meja Siswa'),
(4, 'AC (Air Conditioner)'),
(5, 'Lemari Buku'),
(6, 'Laboratorium Komputer'),
(7, 'Laboratorium Sains'),
(8, 'Perpustakaan'),
(9, 'Lapangan Olahraga'),
(10, 'Ruang Guru'),
(11, 'Kantin Sekolah'),
(12, 'Ruang UKS (Unit Kesehatan Sekolah)'),
(13, 'Wi-Fi Sekolah'),
(14, 'Aula Sekolah'),
(15, 'Toilet Siswa'),
(16, 'Mushola'),
(17, 'Tempat Parkir Sepeda dan Motor');

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE `forum` (
  `id_forum` int NOT NULL,
  `mata_pelajaran_id` int NOT NULL,
  `judul` varchar(200) NOT NULL,
  `deskripsi` text NOT NULL,
  `dibuat_oleh` int NOT NULL,
  `tanggal_dibuat` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`id_forum`, `mata_pelajaran_id`, `judul`, `deskripsi`, `dibuat_oleh`, `tanggal_dibuat`) VALUES
(7, 1, 'tes', 'tes', 1, '2024-12-22 05:33:01');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id_guru` int NOT NULL,
  `nip` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `mata_pelajaran_id` int DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `nip`, `nama_lengkap`, `email`, `no_telp`, `mata_pelajaran_id`, `username`, `password`, `photo`) VALUES
(23, '19870002', 'Dina Kurnia', 'dina.kurnia@example.com', '081234567891', 2, 'guru', 'guru1', 'uploads/foto_guru/1734359815_tes.png'),
(24, '19870003', 'Budi Santoso', 'budi.santoso@example.com', '081234567892', 3, 'budi', 'password123', NULL),
(25, '19870004', 'Citra Dewi', 'citra.dewi@example.com', '081234567893', 4, 'citra', 'password123', NULL),
(26, '19870005', 'Eko Saputra', 'eko.saputra@example.com', '081234567894', 5, 'eko', 'password123', NULL),
(28, '19870007', 'Gilang Pratama', 'gilang.pratama@example.com', '081234567896', 7, 'gilang', 'password123', NULL),
(29, '19870008', 'Hana Kartika', 'hana.kartika@example.com', '081234567897', 8, 'hana', 'password123', NULL),
(30, '19870009', 'Indra Wijaya', 'indra.wijaya@example.com', '081234567898', 9, 'indra', 'password123', NULL),
(31, '19870010', 'Joko Susilo', 'joko.susilo@example.com', '081234567899', 10, 'joko', 'password123', NULL),
(32, '1234567891', 'Alice Smith', 'alicesmith@example.com', '08123456790', 2, 'alicesmith', 'password123', NULL),
(33, '1234567892', 'Bob Johnson', 'bobjohnson@example.com', '08123456791', 3, 'bobjohnson', 'password123', NULL),
(34, '1234567893', 'Charlie Brown', 'charliebrown@example.com', '08123456792', 4, 'charliebrown', 'password123', NULL),
(37, '3439', 'aura', 'sultanmoh096@gmail.com', '03483821242', 4, '3439', '3439', NULL),
(38, '4539432', 'sultan abdurrahman', '230411100191@student.trunojoyo.ac.id', '0831231313334', 8, '4539432', '4539432', NULL),
(41, '11111', 'mahalini', 'lini@ex.com', '084234422822', 8, '11111', '11111', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `informasi`
--

CREATE TABLE `informasi` (
  `id_informasi` int NOT NULL,
  `judul_informasi` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal_publikasi` date NOT NULL,
  `dibuat_oleh` varchar(50) NOT NULL,
  `status` enum('aktif','tidak aktif') DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `informasi`
--

INSERT INTO `informasi` (`id_informasi`, `judul_informasi`, `deskripsi`, `tanggal_publikasi`, `dibuat_oleh`, `status`) VALUES
(18, 'penerima beasiswa', 'berikut adalah siswa yang menerima beasiswa\r\n-dnjfhdf\r\n-rfjfjasifda\r\n-fdskfiadfmsf\r\ndffhmdfgs--\r\nsdogks-', '2024-12-22', 'admin', 'aktif'),
(22, 'ertwerz', '35ws', '2024-12-22', 'admin', 'aktif'),
(23, 'ngawur', 'heahdjdhewue dwfuieweiof ehuhj', '2024-12-25', 'admin', 'tidak aktif'),
(24, 'libur 10 bulan', 'diberitahukan kepada seluruh siswa bahwa besok akan ada virus corona', '2024-12-22', 'admin', 'aktif'),
(25, 'ebrhsa', 'eurewu', '2024-12-25', 'admin', 'tidak aktif'),
(26, 'perubahan jadwal', 'diberitahukan kepada hu', '2024-12-22', 'admin', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int NOT NULL,
  `nama_jabatan` varchar(100) NOT NULL,
  `id_atasan` int DEFAULT NULL,
  `nama_personil` varchar(100) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `id_atasan`, `nama_personil`, `keterangan`) VALUES
(1, 'Kepala Sekolah', NULL, 'Askhab Ganteng sejagat', ''),
(2, 'Wakil Kepala Sekolah', 1, 'Fathor Rahem, S.Pd', ''),
(3, 'Kurikulum', 2, 'Zainab, S.Pd', ''),
(4, 'Humas', 2, 'Mashuri S, S.Pd', ''),
(5, 'Sarpras', 2, 'Moh. Yamin S.Sos', ''),
(6, 'Kesiswaan', 2, 'Imam, S.Pd, S.Ag', ''),
(7, 'Bendahara', 1, 'Feri DSB, S.Pd', ''),
(8, 'K. Tata Usaha', 1, 'Hengki Punk', ''),
(9, 'K. Laboratorium', 3, 'Dewi Homdiyati N, S.Pd', ''),
(10, 'K. Perpustakaan', 3, 'Siti Rofiyah H, S.Pd', ''),
(11, 'B. Konseling', 6, 'Imam, S.Pd, S.Ag', ''),
(12, 'K. Kopsis', 6, 'Dewi Homdiyati N, S.Pd', ''),
(13, 'Komite Sekolah', NULL, 'Dani Subianto', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int NOT NULL,
  `kelas_id` int NOT NULL,
  `mata_pelajaran_id` int NOT NULL,
  `guru_id` int NOT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jum''at','Sabtu','Minggu') DEFAULT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `kelas_id`, `mata_pelajaran_id`, `guru_id`, `hari`, `jam_mulai`, `jam_selesai`) VALUES
(58, 7, 2, 23, 'Senin', '10:00:00', '12:00:00'),
(59, 8, 2, 23, 'Senin', '10:00:00', '12:00:00'),
(60, 9, 2, 23, 'Senin', '10:00:00', '12:00:00'),
(61, 7, 3, 24, 'Selasa', '08:00:00', '10:00:00'),
(62, 8, 3, 24, 'Selasa', '08:00:00', '10:00:00'),
(63, 9, 3, 24, 'Selasa', '08:00:00', '10:00:00'),
(64, 7, 4, 25, 'Selasa', '10:00:00', '12:00:00'),
(65, 8, 4, 25, 'Selasa', '10:00:00', '12:00:00'),
(66, 9, 4, 25, 'Selasa', '10:00:00', '12:00:00'),
(67, 7, 5, 26, 'Rabu', '08:00:00', '10:00:00'),
(68, 8, 5, 26, 'Rabu', '08:00:00', '10:00:00'),
(69, 9, 5, 26, 'Rabu', '08:00:00', '10:00:00'),
(75, 15, 1, 23, 'Minggu', '16:42:54', '17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`) VALUES
(1, 'Fiksi'),
(2, 'Non-Fiksi'),
(3, 'Sains'),
(4, 'Teknologi'),
(5, 'Sejarah'),
(6, 'Biografi');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int NOT NULL,
  `nama_kelas` varchar(50) NOT NULL,
  `tingkat` varchar(10) DEFAULT NULL,
  `wali_kelas_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `tingkat`, `wali_kelas_id`) VALUES
(7, 'A', '7', 37),
(8, 'B', '8', 23),
(9, 'C', '9', 25),
(10, 'D', '7', 26),
(11, 'A', '8', 33),
(13, 'C', '8', 29),
(14, 'D', '8', 30),
(15, 'A', '9', 31),
(16, 'B', '9', 32),
(18, 'D', '9', 34),
(19, 'B', '7', 24),
(20, 'C', '7', 28);

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id_komentar` int NOT NULL,
  `forum_id` int NOT NULL,
  `siswa_id` int NOT NULL,
  `isi_komentar` text NOT NULL,
  `tanggal_komentar` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id_komentar`, `forum_id`, `siswa_id`, `isi_komentar`, `tanggal_komentar`) VALUES
(30, 7, 1, 'tes', '2024-12-22 05:43:49'),
(31, 7, 1, 'tes', '2024-12-22 05:44:40'),
(32, 7, 1, 'tes', '2024-12-22 05:50:45'),
(33, 7, 1, 'tes', '2024-12-22 05:50:57'),
(34, 7, 1, 'tes', '2024-12-22 05:51:12'),
(35, 7, 1, 'halo', '2024-12-22 05:51:16'),
(36, 7, 1, 'oke', '2024-12-22 05:51:20'),
(37, 7, 1, 'h', '2024-12-22 05:51:42'),
(38, 7, 1, 'tes', '2024-12-22 05:52:07'),
(39, 7, 4, 'halo', '2024-12-22 05:52:52'),
(40, 7, 4, 'halo', '2024-12-22 05:57:14');

-- --------------------------------------------------------

--
-- Table structure for table `konseling`
--

CREATE TABLE `konseling` (
  `id_koseling` int NOT NULL,
  `siswa_id` int DEFAULT NULL,
  `Keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `konseling`
--

INSERT INTO `konseling` (`id_koseling`, `siswa_id`, `Keterangan`) VALUES
(1, 3, 'Coba'),
(2, 3, 'Dibully oleh teman sekelas');

-- --------------------------------------------------------

--
-- Table structure for table `kurikulum`
--

CREATE TABLE `kurikulum` (
  `id_kurikulum` int NOT NULL,
  `tahun_ajaran` varchar(20) NOT NULL,
  `nama` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `dipakai` enum('ya','tidak') DEFAULT NULL,
  `deskripsi` varchar(7000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kurikulum`
--

INSERT INTO `kurikulum` (`id_kurikulum`, `tahun_ajaran`, `nama`, `dipakai`, `deskripsi`) VALUES
(2, '2013', 'ktsp', 'ya', 'libur'),
(9, '2025', 'merdeka', 'tidak', NULL),
(11, '2012', 'M. SULTAN ABDURRAHMAN AL ZUDAS', 'tidak', 'wqdcsdfsvs'),
(12, '2014', 'randomly', 'tidak', 'jangan saya kan mencari hewan kalau tidak orang kepada orang tidak mau jika saya memanggil disebut akan jalan menuju langka pernah bangun kepada tidak akan memberikan sesuatu paling tidak akan mengunjungi rumah bila tetapi membuat jalan akan waktu tidak bisa orang orang akan memanggil nama dengan sebutan siapa kan ada dan dan tidak mau jika seseorang sesuatu memberikan hadiah terhadap seseorang bila hewan memanggil nama kan siapa siapa menjauh bila tidak bisa berada di samping sebuah ubah menjadi kategori disebut melakukan atas dasar bermain dengan seseorang membuat dan');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_kerusakan`
--

CREATE TABLE `laporan_kerusakan` (
  `id_laporan` int NOT NULL,
  `deskripsi` text NOT NULL,
  `status` varchar(50) DEFAULT 'Belum Ditangani',
  `tanggal_laporan` datetime DEFAULT CURRENT_TIMESTAMP,
  `fasilitas_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `laporan_kerusakan`
--

INSERT INTO `laporan_kerusakan` (`id_laporan`, `deskripsi`, `status`, `tanggal_laporan`, `fasilitas_id`) VALUES
(4, 'mboh', 'selesai', '2024-12-17 15:56:15', 11),
(5, 'kelas 7A pak', 'selesai', '2024-12-17 16:13:40', 5),
(6, 'Bau', 'selesai', '2024-12-19 20:46:34', 15);

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id_mata_pelajaran` int NOT NULL,
  `nama_pelajaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id_mata_pelajaran`, `nama_pelajaran`) VALUES
(1, 'Matematika'),
(2, 'Bahasa Indonesia'),
(3, 'Bahasa Inggris'),
(4, 'IPA'),
(5, 'IPS'),
(6, 'Seni Budaya'),
(7, 'Pendidikan Jasmani'),
(8, 'Agama'),
(9, 'Komputer'),
(10, 'Fisika');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id_materi` int NOT NULL,
  `mata_pelajaran_id` int NOT NULL,
  `kelas_id` int NOT NULL,
  `judul` varchar(200) NOT NULL,
  `deskripsi` text,
  `file_path` varchar(255) DEFAULT NULL,
  `tanggal_upload` datetime DEFAULT CURRENT_TIMESTAMP,
  `link_yt` text,
  `id_guru` int DEFAULT NULL,
  `tingkat` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id_materi`, `mata_pelajaran_id`, `kelas_id`, `judul`, `deskripsi`, `file_path`, `tanggal_upload`, `link_yt`, `id_guru`, `tingkat`) VALUES
(2, 9, 7, 'Lord kingdom', 'Silahkan Dibuat Bahan belajar', 'uploads/materi/1734691735_Riwayat Kuesioner - Sistem Evaluasi Akademik Tahun Ajaran Semester (1).pdf', '2024-12-20 10:48:55', 'https://youtu.be/MwuU7spynZo?si=r5J7hqxuU7BXrQZ3', 23, 7),
(3, 8, 13, 'Harry Potter in Dragon Castle', 'Silahkan dipelajari untuk uas', '', '2024-12-20 16:41:37', 'https://youtu.be/QFLAuddS6qM?si=nitzyMFOrDilALeC', 23, 8),
(4, 4, 14, 'Prakter menanam kacang hijau dengan kapas', 'Silahkan Amati apa yang terjadi selama proses pertumbuhan karang hijau dan catat ukurannya.', 'uploads/materi/1734774767_Panduan Install Local.pdf', '2024-12-21 09:52:47', 'https://youtu.be/Qzcc-FWv0cM?si=Ma76qM2vL7OVZlgi', 23, 8);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int NOT NULL,
  `siswa_id` int NOT NULL,
  `mata_pelajaran_id` int NOT NULL,
  `nilai` int NOT NULL,
  `semester` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `siswa_id`, `mata_pelajaran_id`, `nilai`, `semester`) VALUES
(1, 1, 8, 100, '1'),
(2, 1, 2, 100, '1');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_rapot`
--

CREATE TABLE `nilai_rapot` (
  `id_nilai_rapot` int NOT NULL,
  `rapot_id` int DEFAULT NULL,
  `mata_pelajaran_id` int DEFAULT NULL,
  `nilai_pengetahuan` decimal(5,2) DEFAULT NULL,
  `predikat_pengetahuan` enum('A','B','C','D') DEFAULT NULL,
  `nilai_keterampilan` decimal(5,2) DEFAULT NULL,
  `predikat_keterampilan` enum('A','B','C','D') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `nilai_rapot`
--

INSERT INTO `nilai_rapot` (`id_nilai_rapot`, `rapot_id`, `mata_pelajaran_id`, `nilai_pengetahuan`, `predikat_pengetahuan`, `nilai_keterampilan`, `predikat_keterampilan`) VALUES
(11, 4, 1, '100.00', 'A', '100.00', 'A'),
(12, 4, 2, '100.00', 'A', '100.00', 'A'),
(13, 4, 3, '100.00', 'A', '100.00', 'A'),
(14, 4, 4, '100.00', 'A', '100.00', 'A'),
(15, 4, 5, '100.00', 'A', '100.00', 'A'),
(16, 4, 6, '100.00', 'A', '100.00', 'A'),
(17, 4, 7, '100.00', 'A', '100.00', 'A'),
(18, 4, 8, '100.00', 'A', '100.00', 'A'),
(19, 4, 9, '100.00', 'A', '100.00', 'A'),
(20, 4, 10, '100.00', 'A', '100.00', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggaran`
--

CREATE TABLE `pelanggaran` (
  `id_pelanggaran` int NOT NULL,
  `siswa_id` int NOT NULL,
  `deskripsi` text NOT NULL,
  `poin` int NOT NULL,
  `tanggal_pelanggaran` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_kelas` int DEFAULT NULL,
  `id_guru` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pelanggaran`
--

INSERT INTO `pelanggaran` (`id_pelanggaran`, `siswa_id`, `deskripsi`, `poin`, `tanggal_pelanggaran`, `id_kelas`, `id_guru`) VALUES
(22, 3, 'pup sembaranagan', 5, '2024-12-18 00:00:00', 9, NULL),
(23, 39, 'rokok', 40, '2024-12-19 00:00:00', 8, NULL),
(24, 39, 'bolos', 10, '2024-12-19 00:00:00', 8, NULL),
(25, 40, 'rias wajah', 5, '2024-12-19 00:00:00', 8, NULL),
(26, 39, 'bolos', 10, '2024-12-19 00:00:00', 8, NULL),
(27, 39, 'bolos', 10, '2024-12-19 00:00:00', 8, NULL),
(28, 39, 'bolos', 10, '2024-12-19 00:00:00', 8, NULL),
(29, 40, 'bolos', 10, '2024-12-19 00:00:00', 8, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengumpulan_tugas`
--

CREATE TABLE `pengumpulan_tugas` (
  `pengumpulan_id` int NOT NULL,
  `id_tugas` int DEFAULT NULL,
  `id_siswa` int DEFAULT NULL,
  `file_tugas` varchar(1000) DEFAULT NULL,
  `tanggal_pengumpulan` date DEFAULT NULL,
  `status_pengumpulan` enum('Tepat Waktu','Terlambat','Belum Dikumpulkan') DEFAULT NULL,
  `nilai` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengumpulan_tugas`
--

INSERT INTO `pengumpulan_tugas` (`pengumpulan_id`, `id_tugas`, `id_siswa`, `file_tugas`, `tanggal_pengumpulan`, `status_pengumpulan`, `nilai`) VALUES
(20, 8, 3, 'coding.jpg', '2024-12-21', 'Tepat Waktu', 99);

-- --------------------------------------------------------

--
-- Table structure for table `rapot`
--

CREATE TABLE `rapot` (
  `id_rapot` int NOT NULL,
  `siswa_id` int NOT NULL,
  `semester` varchar(20) NOT NULL,
  `tahun_ajaran` varchar(20) NOT NULL,
  `nilai_rata` decimal(5,2) DEFAULT NULL,
  `nilai_ekskul` enum('A','B','C','D') DEFAULT NULL,
  `catatan_wali` text,
  `ekskul` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rapot`
--

INSERT INTO `rapot` (`id_rapot`, `siswa_id`, `semester`, `tahun_ajaran`, `nilai_rata`, `nilai_ekskul`, `catatan_wali`, `ekskul`) VALUES
(4, 1, 'Ganjil', '2023/2024', '100.00', 'A', 'perfect', 'judo');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int NOT NULL,
  `nis` varchar(15) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `kelas_id` int NOT NULL,
  `alamat` text,
  `tanggal_lahir` date DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `ekstra_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nis`, `nama_lengkap`, `kelas_id`, `alamat`, `tanggal_lahir`, `no_telp`, `username`, `password`, `jenis_kelamin`, `photo`, `ekstra_id`) VALUES
(1, '20240101', 'Andi Wijaya Kusumaa', 15, 'Jl. Merdeka No.1', '2008-01-15', '081234567890', 'siswa', 'siswa1', 'laki-laki', 'uploads/foto_siswa/1734362780_hengki.png', 1),
(2, '20240102', 'Budi Santoso', 8, 'Jl. Sudirman No.2', '2008-05-20', '081234567891', 'budi', 'password456', 'laki-laki', NULL, NULL),
(3, '20240103', 'Citra Dewi', 9, 'Jl. Kartini No.3', '2008-07-10', '081234567892', 'citra', 'password789', 'laki-laki', NULL, NULL),
(5, '20240105', 'Eko Prasetyo', 8, 'Jl. Kebangsaan No.5', '2008-11-15', '081234567894', 'eko', 'password202', 'laki-laki', NULL, NULL),
(8, '3434343', 'danisa', 7, 'Bangkalan', '2024-12-18', '083123133839', '3434343', '3434343', 'perempuan', NULL, NULL),
(9, '123456789012345', 'Siswa 1', 7, 'Jl. Contoh Alamat No. 1', '2006-01-01', '081234567890', '123456789012345', '123456789012345', 'laki-laki', NULL, NULL),
(10, '123456789012346', 'Siswa 2', 7, 'Jl. Contoh Alamat No. 2', '2006-02-02', '081234567891', '123456789012346', '123456789012346', 'perempuan', NULL, NULL),
(11, '123456789012347', 'Siswa 3', 7, 'Jl. Contoh Alamat No. 3', '2006-03-03', '081234567892', '123456789012347', '123456789012347', 'laki-laki', NULL, NULL),
(12, '123456789012348', 'Siswa 4', 7, 'Jl. Contoh Alamat No. 4', '2006-04-04', '081234567893', '123456789012348', '123456789012348', 'perempuan', NULL, NULL),
(13, '123456789012349', 'Siswa 5', 7, 'Jl. Contoh Alamat No. 5', '2006-05-05', '081234567894', '123456789012349', '123456789012349', 'laki-laki', NULL, NULL),
(14, '123456789012350', 'Siswa 6', 7, 'Jl. Contoh Alamat No. 6', '2006-06-06', '081234567895', '123456789012350', '123456789012350', 'perempuan', NULL, NULL),
(15, '123456789012351', 'Siswa 7', 7, 'Jl. Contoh Alamat No. 7', '2006-07-07', '081234567896', '123456789012351', '123456789012351', 'laki-laki', NULL, NULL),
(16, '123456789012352', 'Siswa 8', 7, 'Jl. Contoh Alamat No. 8', '2006-08-08', '081234567897', '123456789012352', '123456789012352', 'perempuan', NULL, NULL),
(17, '123456789012353', 'Siswa 9', 7, 'Jl. Contoh Alamat No. 9', '2006-09-09', '081234567898', '123456789012353', '123456789012353', 'laki-laki', NULL, NULL),
(18, '123456789012354', 'Siswa 10', 7, 'Jl. Contoh Alamat No. 10', '2006-10-10', '081234567899', '123456789012354', '123456789012354', 'perempuan', NULL, NULL),
(19, '123456789012355', 'Siswa 11', 7, 'Jl. Contoh Alamat No. 11', '2006-11-11', '081234567900', '123456789012355', '123456789012355', 'laki-laki', NULL, NULL),
(20, '123456789012356', 'Siswa 12', 7, 'Jl. Contoh Alamat No. 12', '2006-12-12', '081234567901', '123456789012356', '123456789012356', 'perempuan', NULL, NULL),
(21, '123456789012357', 'Siswa 13', 7, 'Jl. Contoh Alamat No. 13', '2007-01-13', '081234567902', '123456789012357', '123456789012357', 'laki-laki', NULL, NULL),
(22, '123456789012358', 'Siswa 14', 7, 'Jl. Contoh Alamat No. 14', '2007-02-14', '081234567903', '123456789012358', '123456789012358', 'perempuan', NULL, NULL),
(23, '123456789012359', 'Siswa 15', 7, 'Jl. Contoh Alamat No. 15', '2007-03-15', '081234567904', '123456789012359', '123456789012359', 'laki-laki', NULL, NULL),
(24, '123456789012360', 'Siswa 16', 7, 'Jl. Contoh Alamat No. 16', '2007-04-16', '081234567905', '123456789012360', '123456789012360', 'perempuan', NULL, NULL),
(25, '123456789012361', 'Siswa 17', 7, 'Jl. Contoh Alamat No. 17', '2007-05-17', '081234567906', '123456789012361', '123456789012361', 'laki-laki', NULL, NULL),
(26, '123456789012362', 'Siswa 18', 7, 'Jl. Contoh Alamat No. 18', '2007-06-18', '081234567907', '123456789012362', '123456789012362', 'perempuan', NULL, NULL),
(27, '123456789012363', 'Siswa 19', 7, 'Jl. Contoh Alamat No. 19', '2007-07-19', '081234567908', '123456789012363', '123456789012363', 'laki-laki', NULL, NULL),
(28, '123456789012364', 'Siswa 20', 7, 'Jl. Contoh Alamat No. 20', '2007-08-20', '081234567909', '123456789012364', '123456789012364', 'perempuan', NULL, NULL),
(29, '123456789012365', 'Siswa 21', 7, 'Jl. Contoh Alamat No. 21', '2007-09-21', '081234567910', '123456789012365', '123456789012365', 'laki-laki', NULL, NULL),
(30, '123456789012366', 'Siswa 22', 7, 'Jl. Contoh Alamat No. 22', '2007-10-22', '081234567911', '123456789012366', '123456789012366', 'perempuan', NULL, NULL),
(31, '123456789012367', 'Siswa 23', 7, 'Jl. Contoh Alamat No. 23', '2007-11-23', '081234567912', '123456789012367', '123456789012367', 'laki-laki', NULL, NULL),
(32, '123456789012368', 'Siswa 24', 7, 'Jl. Contoh Alamat No. 24', '2007-12-24', '081234567913', '123456789012368', '123456789012368', 'perempuan', NULL, NULL),
(33, '123456789012369', 'Siswa 25', 7, 'Jl. Contoh Alamat No. 25', '2008-01-25', '081234567914', '123456789012369', '123456789012369', 'laki-laki', NULL, NULL),
(34, '123456789012370', 'Siswa 26', 7, 'Jl. Contoh Alamat No. 26', '2008-02-26', '081234567915', '123456789012370', '123456789012370', 'perempuan', NULL, NULL),
(35, '123456789012371', 'Siswah 27', 7, 'Jl. Contoh Alamat No. 27', '2008-03-27', '081234567916', '123456789012371', '', 'laki-laki', NULL, NULL),
(39, '38472273', 'ayu ting ting', 8, 'dns', '2004-03-04', '3948292', '38472273', '38472273', 'perempuan', NULL, NULL),
(40, '35485423040', 'rara', 8, 'jl suhadak', '2003-02-04', '083123133839', '35485423040', '35485423040', 'laki-laki', NULL, NULL),
(41, '34932339', 'sultan felycadee', 7, 'jl raya tambelanga, kecamatan tambelangan, kabupaten sampang ', '2003-07-03', '083123133789', '349323396', '', 'laki-laki', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `struktural_kelas`
--

CREATE TABLE `struktural_kelas` (
  `id_struktural` int NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `siswa_id` int DEFAULT NULL,
  `id_kelas` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `struktural_kelas`
--

INSERT INTO `struktural_kelas` (`id_struktural`, `jabatan`, `siswa_id`, `id_kelas`) VALUES
(9, 'Wakil Ketua', 8, 7);

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id_tugas` int NOT NULL,
  `judul` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `file_tugas` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `url_tugas` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `poin` int DEFAULT NULL,
  `kelas_id` int NOT NULL,
  `deadline` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id_tugas`, `judul`, `deskripsi`, `file_tugas`, `url_tugas`, `poin`, `kelas_id`, `deadline`) VALUES
(8, 'Bahasa indonesia', 'Carikan perbedaan bahasa baku dan resmi', NULL, NULL, NULL, 9, '2024-12-21 23:33:21'),
(9, 'Tugas Akhir', 'Kerjakan Latihan Soal Halaman 90 LKS', '6767d151923bf_Sertifikat PKKMB SAKERA 2023 - Hengki Dwi Kurniawan .pdf', 'https://api.flutter.dev/flutter/material/TabBarTheme-class.html', 100, 7, '2025-01-01 23:43:00');

-- --------------------------------------------------------

--
-- Table structure for table `ujian`
--

CREATE TABLE `ujian` (
  `id_ujian` int NOT NULL,
  `nama_ujian` varchar(100) NOT NULL,
  `mata_pelajaran_id` int NOT NULL,
  `kelas_id` int NOT NULL,
  `tanggal` datetime NOT NULL,
  `durasi` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `absensi_ibfk_1` (`kelas_id`),
  ADD KEY `absensi_ibfk_2` (`guru_id`),
  ADD KEY `absensi_ibfk_3` (`id_siswa`),
  ADD KEY `absensi_ibfk_4` (`id_mata_pelajaran`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `bank_soal`
--
ALTER TABLE `bank_soal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ebooks`
--
ALTER TABLE `ebooks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indexes for table `ekstrakurikuler`
--
ALTER TABLE `ekstrakurikuler`
  ADD PRIMARY KEY (`id_ekstrakurikuler`),
  ADD KEY `pembimbing_id` (`pembimbing_id`);

--
-- Indexes for table `evaluasi`
--
ALTER TABLE `evaluasi`
  ADD PRIMARY KEY (`id_evaluasi`),
  ADD KEY `siswa_id` (`siswa_id`),
  ADD KEY `guru_id` (`guru_id`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`id_forum`),
  ADD KEY `mata_pelajaran_id` (`mata_pelajaran_id`),
  ADD KEY `dibuat_oleh` (`dibuat_oleh`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`),
  ADD UNIQUE KEY `nip` (`nip`),
  ADD KEY `mata_pelajaran_id` (`mata_pelajaran_id`);

--
-- Indexes for table `informasi`
--
ALTER TABLE `informasi`
  ADD PRIMARY KEY (`id_informasi`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`),
  ADD KEY `id_atasan` (`id_atasan`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `mata_pelajaran_id` (`mata_pelajaran_id`),
  ADD KEY `guru_id` (`guru_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `wali_kelas_id` (`wali_kelas_id`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentar`),
  ADD KEY `forum_id` (`forum_id`),
  ADD KEY `siswa_id` (`siswa_id`);

--
-- Indexes for table `konseling`
--
ALTER TABLE `konseling`
  ADD PRIMARY KEY (`id_koseling`),
  ADD KEY `siswa_id` (`siswa_id`);

--
-- Indexes for table `kurikulum`
--
ALTER TABLE `kurikulum`
  ADD PRIMARY KEY (`id_kurikulum`);

--
-- Indexes for table `laporan_kerusakan`
--
ALTER TABLE `laporan_kerusakan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id_mata_pelajaran`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id_materi`),
  ADD KEY `mata_pelajaran_id` (`mata_pelajaran_id`),
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `id_guru` (`id_guru`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `siswa_id` (`siswa_id`),
  ADD KEY `mata_pelajaran_id` (`mata_pelajaran_id`);

--
-- Indexes for table `nilai_rapot`
--
ALTER TABLE `nilai_rapot`
  ADD PRIMARY KEY (`id_nilai_rapot`),
  ADD KEY `rapot_id` (`rapot_id`),
  ADD KEY `mata_pelajaran_id` (`mata_pelajaran_id`);

--
-- Indexes for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  ADD PRIMARY KEY (`id_pelanggaran`),
  ADD KEY `siswa_id` (`siswa_id`),
  ADD KEY `fk_kelas` (`id_kelas`),
  ADD KEY `fk_guru` (`id_guru`);

--
-- Indexes for table `pengumpulan_tugas`
--
ALTER TABLE `pengumpulan_tugas`
  ADD PRIMARY KEY (`pengumpulan_id`),
  ADD KEY `id_tugas` (`id_tugas`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indexes for table `rapot`
--
ALTER TABLE `rapot`
  ADD PRIMARY KEY (`id_rapot`),
  ADD KEY `siswa_id` (`siswa_id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `nis` (`nis`),
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `fk_minat_siswa` (`ekstra_id`);

--
-- Indexes for table `struktural_kelas`
--
ALTER TABLE `struktural_kelas`
  ADD PRIMARY KEY (`id_struktural`),
  ADD KEY `fk_kelas_struktural` (`id_kelas`),
  ADD KEY `fk_str_siswa` (`siswa_id`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id_tugas`),
  ADD KEY `kelas_id` (`kelas_id`);

--
-- Indexes for table `ujian`
--
ALTER TABLE `ujian`
  ADD PRIMARY KEY (`id_ujian`),
  ADD KEY `mata_pelajaran_id` (`mata_pelajaran_id`),
  ADD KEY `kelas_id` (`kelas_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bank_soal`
--
ALTER TABLE `bank_soal`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ebooks`
--
ALTER TABLE `ebooks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ekstrakurikuler`
--
ALTER TABLE `ekstrakurikuler`
  MODIFY `id_ekstrakurikuler` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `evaluasi`
--
ALTER TABLE `evaluasi`
  MODIFY `id_evaluasi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `forum`
--
ALTER TABLE `forum`
  MODIFY `id_forum` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `informasi`
--
ALTER TABLE `informasi`
  MODIFY `id_informasi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komentar` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `konseling`
--
ALTER TABLE `konseling`
  MODIFY `id_koseling` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kurikulum`
--
ALTER TABLE `kurikulum`
  MODIFY `id_kurikulum` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `laporan_kerusakan`
--
ALTER TABLE `laporan_kerusakan`
  MODIFY `id_laporan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id_mata_pelajaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id_materi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nilai_rapot`
--
ALTER TABLE `nilai_rapot`
  MODIFY `id_nilai_rapot` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  MODIFY `id_pelanggaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `pengumpulan_tugas`
--
ALTER TABLE `pengumpulan_tugas`
  MODIFY `pengumpulan_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `rapot`
--
ALTER TABLE `rapot`
  MODIFY `id_rapot` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `struktural_kelas`
--
ALTER TABLE `struktural_kelas`
  MODIFY `id_struktural` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id_tugas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ujian`
--
ALTER TABLE `ujian`
  MODIFY `id_ujian` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `absensi_ibfk_2` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id_guru`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `absensi_ibfk_3` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `absensi_ibfk_4` FOREIGN KEY (`id_mata_pelajaran`) REFERENCES `mata_pelajaran` (`id_mata_pelajaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ebooks`
--
ALTER TABLE `ebooks`
  ADD CONSTRAINT `ebooks_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ekstrakurikuler`
--
ALTER TABLE `ekstrakurikuler`
  ADD CONSTRAINT `ekstrakurikuler_ibfk_1` FOREIGN KEY (`pembimbing_id`) REFERENCES `guru` (`id_guru`);

--
-- Constraints for table `evaluasi`
--
ALTER TABLE `evaluasi`
  ADD CONSTRAINT `evaluasi_ibfk_1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id_siswa`),
  ADD CONSTRAINT `evaluasi_ibfk_2` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id_guru`);

--
-- Constraints for table `forum`
--
ALTER TABLE `forum`
  ADD CONSTRAINT `forum_ibfk_1` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajaran` (`id_mata_pelajaran`),
  ADD CONSTRAINT `forum_ibfk_2` FOREIGN KEY (`dibuat_oleh`) REFERENCES `siswa` (`id_siswa`);

--
-- Constraints for table `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `guru_ibfk_1` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajaran` (`id_mata_pelajaran`);

--
-- Constraints for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD CONSTRAINT `jabatan_ibfk_1` FOREIGN KEY (`id_atasan`) REFERENCES `jabatan` (`id_jabatan`);

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajaran` (`id_mata_pelajaran`),
  ADD CONSTRAINT `jadwal_ibfk_3` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id_guru`) ON DELETE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `fk_wali_kelas` FOREIGN KEY (`wali_kelas_id`) REFERENCES `guru` (`id_guru`) ON DELETE SET NULL,
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`wali_kelas_id`) REFERENCES `guru` (`id_guru`);

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`forum_id`) REFERENCES `forum` (`id_forum`);

--
-- Constraints for table `konseling`
--
ALTER TABLE `konseling`
  ADD CONSTRAINT `konseling_ibfk_1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id_siswa`);

--
-- Constraints for table `materi`
--
ALTER TABLE `materi`
  ADD CONSTRAINT `materi_ibfk_1` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajaran` (`id_mata_pelajaran`),
  ADD CONSTRAINT `materi_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `materi_ibfk_3` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`);

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id_siswa`),
  ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajaran` (`id_mata_pelajaran`);

--
-- Constraints for table `nilai_rapot`
--
ALTER TABLE `nilai_rapot`
  ADD CONSTRAINT `nilai_rapot_ibfk_1` FOREIGN KEY (`rapot_id`) REFERENCES `rapot` (`id_rapot`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_rapot_ibfk_2` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajaran` (`id_mata_pelajaran`) ON DELETE CASCADE;

--
-- Constraints for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  ADD CONSTRAINT `fk_guru` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pelanggaran_ibfk_1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengumpulan_tugas`
--
ALTER TABLE `pengumpulan_tugas`
  ADD CONSTRAINT `pengumpulan_tugas_ibfk_1` FOREIGN KEY (`id_tugas`) REFERENCES `tugas` (`id_tugas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengumpulan_tugas_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON UPDATE CASCADE;

--
-- Constraints for table `rapot`
--
ALTER TABLE `rapot`
  ADD CONSTRAINT `rapot_ibfk_1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `fk_minat_siswa` FOREIGN KEY (`ekstra_id`) REFERENCES `ekstrakurikuler` (`id_ekstrakurikuler`),
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id_kelas`);

--
-- Constraints for table `struktural_kelas`
--
ALTER TABLE `struktural_kelas`
  ADD CONSTRAINT `fk_kelas_struktural` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_str_siswa` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ujian`
--
ALTER TABLE `ujian`
  ADD CONSTRAINT `ujian_ibfk_1` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajaran` (`id_mata_pelajaran`),
  ADD CONSTRAINT `ujian_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id_kelas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
