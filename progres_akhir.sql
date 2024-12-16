-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 16, 2024 at 05:39 PM
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
  `id_absensi` int NOT NULL,
  `kelas_id` int NOT NULL,
  `mata_pelajaran` int NOT NULL,
  `guru_id` int NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(1, 'admin', 'admin1', 'M Sultan Abdurahman Al zudas', 'danisubianto1@gmail.com', '085123456789', 'uploads/foto_admin/1734360260_OIP.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `bank_soal`
--

CREATE TABLE `bank_soal` (
  `id_soal` int NOT NULL,
  `mata_pelajaran_id` int NOT NULL,
  `kelas_id` int NOT NULL,
  `soal` text NOT NULL,
  `jawaban` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ekstrakurikuler`
--

CREATE TABLE `ekstrakurikuler` (
  `id_ekstrakurikuler` int NOT NULL,
  `nama_kegiatan` varchar(100) NOT NULL,
  `jadwal_kegiatan` datetime NOT NULL,
  `pembimbing_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(3, 1, 'tes', 'ayooo', 2, '2024-12-13 00:01:12');

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
(22, '19870001', 'Ahmad Fauzi', 'ahmad.fauzi@example.com', '081234567890', 1, 'ahmad', '$2y$10$BgfLJsK0WmTh3R9DGefnDuUktxCKGZVtb4JbHOqw8g24j/umcVwRm', NULL),
(23, '19870002', 'Dina Kurnia', 'dina.kurnia@example.com', '081234567891', 2, 'guru', 'guru1', 'uploads/foto_guru/1734359815_tes.png'),
(24, '19870003', 'Budi Santoso', 'budi.santoso@example.com', '081234567892', 3, 'budi', 'password123', NULL),
(25, '19870004', 'Citra Dewi', 'citra.dewi@example.com', '081234567893', 4, 'citra', 'password123', NULL),
(26, '19870005', 'Eko Saputra', 'eko.saputra@example.com', '081234567894', 5, 'eko', 'password123', NULL),
(27, '19870006', 'Fitri Lestari', 'fitri.lestari@example.com', '081234567895', 6, 'fitri', 'password123', NULL),
(28, '19870007', 'Gilang Pratama', 'gilang.pratama@example.com', '081234567896', 7, 'gilang', 'password123', NULL),
(29, '19870008', 'Hana Kartika', 'hana.kartika@example.com', '081234567897', 8, 'hana', 'password123', NULL),
(30, '19870009', 'Indra Wijaya', 'indra.wijaya@example.com', '081234567898', 9, 'indra', 'password123', NULL),
(31, '19870010', 'Joko Susilo', 'joko.susilo@example.com', '081234567899', 10, 'joko', 'password123', NULL),
(32, '1234567891', 'Alice Smith', 'alicesmith@example.com', '08123456790', 2, 'alicesmith', 'password123', NULL),
(33, '1234567892', 'Bob Johnson', 'bobjohnson@example.com', '08123456791', 3, 'bobjohnson', 'password123', NULL),
(34, '1234567893', 'Charlie Brown', 'charliebrown@example.com', '08123456792', 4, 'charliebrown', 'password123', NULL),
(37, '3439', 'aura', 'sultanmoh096@gmail.com', '03483821242', 4, '3439', '3439', NULL);

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
(13, 'Pengumuman Libur', 'Sekolah akan diliburkan pada tanggal 25 Desember 2024', '2024-12-20', 'Admin', 'aktif'),
(14, 'Seminar Pendidikan', 'Seminar tentang metode pembelajaran efektif akan diadakan pada 15 Januari 2025', '2024-12-26', 'Admin', 'aktif'),
(15, 'Pengambilan Raport', 'Pengambilan raport akan dilaksanakan pada 30 Desember 2024', '2024-12-25', 'Guru', 'tidak aktif');

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
(1, 'Kepala Sekolah', NULL, 'Askhab Ganteng', ''),
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
(13, 'Komite Sekolah', NULL, 'Dani oioi', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int NOT NULL,
  `kelas_id` int NOT NULL,
  `mata_pelajaran_id` int NOT NULL,
  `guru_id` int NOT NULL,
  `hari` varchar(20) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `kelas_id`, `mata_pelajaran_id`, `guru_id`, `hari`, `jam_mulai`, `jam_selesai`) VALUES
(55, 7, 1, 22, 'Senin', '08:00:00', '10:00:00'),
(56, 8, 1, 22, 'Senin', '08:00:00', '10:00:00'),
(57, 9, 1, 22, 'Senin', '08:00:00', '10:00:00'),
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
(70, 7, 6, 27, 'Rabu', '10:00:00', '12:00:00'),
(71, 8, 6, 27, 'Rabu', '10:00:00', '12:00:00'),
(72, 9, 6, 27, 'Rabu', '10:00:00', '12:00:00');

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
(7, 'A', '7', 23),
(8, 'B', '8', NULL),
(9, 'C', '9', 25),
(10, 'D', '7', 26),
(11, 'A', '8', 27),
(13, 'C', '8', 29),
(14, 'D', '8', 30),
(15, 'A', '9', 31),
(16, 'B', '9', 32),
(18, 'D', '9', 34),
(19, 'B', '7', NULL),
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
(7, 3, 1, 'tes', '2024-12-13 00:42:50'),
(8, 3, 1, 'halo', '2024-12-13 01:30:51'),
(9, 3, 2, 'halo', '2024-12-13 02:19:41'),
(11, 3, 2, 'oke bang', '2024-12-13 02:21:25'),
(12, 3, 1, 'tes', '2024-12-14 20:53:11');

-- --------------------------------------------------------

--
-- Table structure for table `kurikulum`
--

CREATE TABLE `kurikulum` (
  `id_kurikulum` int NOT NULL,
  `tahun_ajaran` varchar(20) NOT NULL,
  `nama` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `dipakai` enum('ya','tidak') DEFAULT NULL,
  `deskripsi` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kurikulum`
--

INSERT INTO `kurikulum` (`id_kurikulum`, `tahun_ajaran`, `nama`, `dipakai`, `deskripsi`) VALUES
(2, '2013', 'ktsp', 'tidak', 'libur'),
(9, '2025', 'merdeka', 'ya', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `laporan_kerusakan`
--

CREATE TABLE `laporan_kerusakan` (
  `id_laporan` int NOT NULL,
  `kelas_id` int NOT NULL,
  `deskripsi` text NOT NULL,
  `status` varchar(50) DEFAULT 'Belum Ditangani',
  `tanggal_laporan` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `id_guru` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(1, 2, 'Bolos', 20, '2024-12-16 00:00:00', 8, NULL),
(2, 2, 'Bolos', 20, '2024-12-16 00:00:00', 8, NULL),
(3, 2, 'Bolos', 20, '2024-12-16 00:00:00', 8, NULL),
(4, 2, 'Bolos', 20, '2024-12-16 00:00:00', 8, NULL),
(5, 2, 'Bolos', 20, '2024-12-16 00:00:00', 8, NULL),
(6, 2, 'Bolos', 20, '2024-12-16 00:00:00', 8, NULL),
(7, 2, 'Bolos', 20, '2024-12-16 00:00:00', 8, NULL),
(8, 2, 'Bolos', 20, '2024-12-16 00:00:00', 8, NULL),
(9, 2, 'Bolos', 20, '2024-12-16 00:00:00', 8, NULL),
(10, 2, 'Bolos', 20, '2024-12-16 00:00:00', 8, NULL),
(11, 2, 'Bolos', 20, '2024-12-16 00:00:00', 8, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengumpulan_tugas`
--

CREATE TABLE `pengumpulan_tugas` (
  `pengumpulan_id` int NOT NULL,
  `id_tugas` int DEFAULT NULL,
  `id_siswa` int DEFAULT NULL,
  `file_tugas` longblob,
  `tanggal_pengumpulan` date DEFAULT NULL,
  `status_pengumpulan` enum('Tepat Waktu','Terlambat','Belum Dikumpulkan') DEFAULT NULL,
  `nilai` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rapot`
--

CREATE TABLE `rapot` (
  `id_rapot` int NOT NULL,
  `siswa_id` int NOT NULL,
  `semester` varchar(20) NOT NULL,
  `tahun_ajaran` varchar(20) NOT NULL,
  `komentar` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rapot`
--

INSERT INTO `rapot` (`id_rapot`, `siswa_id`, `semester`, `tahun_ajaran`, `komentar`) VALUES
(1, 1, '1', '2024', 'bagus');

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
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nis`, `nama_lengkap`, `kelas_id`, `alamat`, `tanggal_lahir`, `no_telp`, `username`, `password`, `jenis_kelamin`, `photo`) VALUES
(1, '20240101', 'Andi Wijaya Kusuma', 7, 'Jl. Merdeka No.1', '2008-01-15', '081234567890', 'siswa', 'siswa1', 'laki-laki', 'uploads/foto_siswa/1734362780_hengki.png'),
(2, '20240102', 'Budi Santoso', 8, 'Jl. Sudirman No.2', '2008-05-20', '081234567891', 'budi', 'password456', 'laki-laki', NULL),
(3, '20240103', 'Citra Dewi', 9, 'Jl. Kartini No.3', '2008-07-10', '081234567892', 'citra', 'password789', 'laki-laki', NULL),
(4, '20240104', 'Dewi Lestari', 7, 'Jl. Pahlawan No.4', '2008-09-25', '081234567893', 'dewi', 'password101', 'laki-laki', NULL),
(5, '20240105', 'Eko Prasetyo', 8, 'Jl. Kebangsaan No.5', '2008-11-15', '081234567894', 'eko', 'password202', 'laki-laki', NULL),
(7, '24354621', 'hengki subianto', 8, 'jl suhadak', '2024-12-05', '083123133839', '24354621', '24354621', 'perempuan', NULL),
(8, '3434343', 'danisa', 7, 'Bangkalan', '2024-12-18', '083123133839', '3434343', '3434343', 'perempuan', NULL),
(9, '123456789012345', 'Siswa 1', 7, 'Jl. Contoh Alamat No. 1', '2006-01-01', '081234567890', '123456789012345', '123456789012345', 'laki-laki', NULL),
(10, '123456789012346', 'Siswa 2', 7, 'Jl. Contoh Alamat No. 2', '2006-02-02', '081234567891', '123456789012346', '123456789012346', 'perempuan', NULL),
(11, '123456789012347', 'Siswa 3', 7, 'Jl. Contoh Alamat No. 3', '2006-03-03', '081234567892', '123456789012347', '123456789012347', 'laki-laki', NULL),
(12, '123456789012348', 'Siswa 4', 7, 'Jl. Contoh Alamat No. 4', '2006-04-04', '081234567893', '123456789012348', '123456789012348', 'perempuan', NULL),
(13, '123456789012349', 'Siswa 5', 7, 'Jl. Contoh Alamat No. 5', '2006-05-05', '081234567894', '123456789012349', '123456789012349', 'laki-laki', NULL),
(14, '123456789012350', 'Siswa 6', 7, 'Jl. Contoh Alamat No. 6', '2006-06-06', '081234567895', '123456789012350', '123456789012350', 'perempuan', NULL),
(15, '123456789012351', 'Siswa 7', 7, 'Jl. Contoh Alamat No. 7', '2006-07-07', '081234567896', '123456789012351', '123456789012351', 'laki-laki', NULL),
(16, '123456789012352', 'Siswa 8', 7, 'Jl. Contoh Alamat No. 8', '2006-08-08', '081234567897', '123456789012352', '123456789012352', 'perempuan', NULL),
(17, '123456789012353', 'Siswa 9', 7, 'Jl. Contoh Alamat No. 9', '2006-09-09', '081234567898', '123456789012353', '123456789012353', 'laki-laki', NULL),
(18, '123456789012354', 'Siswa 10', 7, 'Jl. Contoh Alamat No. 10', '2006-10-10', '081234567899', '123456789012354', '123456789012354', 'perempuan', NULL),
(19, '123456789012355', 'Siswa 11', 7, 'Jl. Contoh Alamat No. 11', '2006-11-11', '081234567900', '123456789012355', '123456789012355', 'laki-laki', NULL),
(20, '123456789012356', 'Siswa 12', 7, 'Jl. Contoh Alamat No. 12', '2006-12-12', '081234567901', '123456789012356', '123456789012356', 'perempuan', NULL),
(21, '123456789012357', 'Siswa 13', 7, 'Jl. Contoh Alamat No. 13', '2007-01-13', '081234567902', '123456789012357', '123456789012357', 'laki-laki', NULL),
(22, '123456789012358', 'Siswa 14', 7, 'Jl. Contoh Alamat No. 14', '2007-02-14', '081234567903', '123456789012358', '123456789012358', 'perempuan', NULL),
(23, '123456789012359', 'Siswa 15', 7, 'Jl. Contoh Alamat No. 15', '2007-03-15', '081234567904', '123456789012359', '123456789012359', 'laki-laki', NULL),
(24, '123456789012360', 'Siswa 16', 7, 'Jl. Contoh Alamat No. 16', '2007-04-16', '081234567905', '123456789012360', '123456789012360', 'perempuan', NULL),
(25, '123456789012361', 'Siswa 17', 7, 'Jl. Contoh Alamat No. 17', '2007-05-17', '081234567906', '123456789012361', '123456789012361', 'laki-laki', NULL),
(26, '123456789012362', 'Siswa 18', 7, 'Jl. Contoh Alamat No. 18', '2007-06-18', '081234567907', '123456789012362', '123456789012362', 'perempuan', NULL),
(27, '123456789012363', 'Siswa 19', 7, 'Jl. Contoh Alamat No. 19', '2007-07-19', '081234567908', '123456789012363', '123456789012363', 'laki-laki', NULL),
(28, '123456789012364', 'Siswa 20', 7, 'Jl. Contoh Alamat No. 20', '2007-08-20', '081234567909', '123456789012364', '123456789012364', 'perempuan', NULL),
(29, '123456789012365', 'Siswa 21', 7, 'Jl. Contoh Alamat No. 21', '2007-09-21', '081234567910', '123456789012365', '123456789012365', 'laki-laki', NULL),
(30, '123456789012366', 'Siswa 22', 7, 'Jl. Contoh Alamat No. 22', '2007-10-22', '081234567911', '123456789012366', '123456789012366', 'perempuan', NULL),
(31, '123456789012367', 'Siswa 23', 7, 'Jl. Contoh Alamat No. 23', '2007-11-23', '081234567912', '123456789012367', '123456789012367', 'laki-laki', NULL),
(32, '123456789012368', 'Siswa 24', 7, 'Jl. Contoh Alamat No. 24', '2007-12-24', '081234567913', '123456789012368', '123456789012368', 'perempuan', NULL),
(33, '123456789012369', 'Siswa 25', 7, 'Jl. Contoh Alamat No. 25', '2008-01-25', '081234567914', '123456789012369', '123456789012369', 'laki-laki', NULL),
(34, '123456789012370', 'Siswa 26', 7, 'Jl. Contoh Alamat No. 26', '2008-02-26', '081234567915', '123456789012370', '123456789012370', 'perempuan', NULL),
(35, '123456789012371', 'Siswa 27', 7, 'Jl. Contoh Alamat No. 27', '2008-03-27', '081234567916', '123456789012371', '123456789012371', 'laki-laki', NULL),
(36, '123456789012372', 'Siswa 28', 7, 'Jl. Contoh Alamat No. 28', '2008-04-28', '081234567917', '123456789012372', '123456789012372', 'perempuan', NULL),
(37, '123456789012373', 'Siswa 29', 7, 'Jl. Contoh Alamat No. 29', '2008-05-29', '081234567918', '123456789012373', '123456789012373', 'laki-laki', NULL),
(38, '123456789012374', 'Siswa 30', 7, 'Jl. Contoh Alamat No. 30', '2008-06-30', '081234567919', '123456789012374', '123456789012374', 'perempuan', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `struktural_kelas`
--

CREATE TABLE `struktural_kelas` (
  `id_struktural` int NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id_kelas` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `struktural_kelas`
--

INSERT INTO `struktural_kelas` (`id_struktural`, `jabatan`, `nama`, `id_kelas`) VALUES
(4, 'ketua', 'Andi Wijaya', 7),
(5, 'sekertaris', 'Dewi Lestari', 7),
(6, 'bendahara', 'hengki subianto', 7);

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id_tugas` int NOT NULL,
  `mata_pelajaran_id` int NOT NULL,
  `kelas_id` int NOT NULL,
  `judul` varchar(200) NOT NULL,
  `deskripsi` text,
  `deadline` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id_tugas`, `mata_pelajaran_id`, `kelas_id`, `judul`, `deskripsi`, `deadline`) VALUES
(1, 1, 7, 'Tugas 1', 'Silahkan Kerjakan Latihan Soal 1 Di LKS', '2024-12-17 21:20:28');

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
  ADD PRIMARY KEY (`id_absensi`),
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `mata_pelajaran` (`mata_pelajaran`),
  ADD KEY `guru_id` (`guru_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `bank_soal`
--
ALTER TABLE `bank_soal`
  ADD PRIMARY KEY (`id_soal`),
  ADD KEY `mata_pelajaran_id` (`mata_pelajaran_id`),
  ADD KEY `kelas_id` (`kelas_id`);

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
-- Indexes for table `kurikulum`
--
ALTER TABLE `kurikulum`
  ADD PRIMARY KEY (`id_kurikulum`);

--
-- Indexes for table `laporan_kerusakan`
--
ALTER TABLE `laporan_kerusakan`
  ADD PRIMARY KEY (`id_laporan`),
  ADD KEY `kelas_id` (`kelas_id`);

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
  ADD KEY `kelas_id` (`kelas_id`);

--
-- Indexes for table `struktural_kelas`
--
ALTER TABLE `struktural_kelas`
  ADD PRIMARY KEY (`id_struktural`),
  ADD KEY `fk_kelas_struktural` (`id_kelas`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id_tugas`),
  ADD KEY `mata_pelajaran_id` (`mata_pelajaran_id`),
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
  MODIFY `id_absensi` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bank_soal`
--
ALTER TABLE `bank_soal`
  MODIFY `id_soal` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ekstrakurikuler`
--
ALTER TABLE `ekstrakurikuler`
  MODIFY `id_ekstrakurikuler` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `evaluasi`
--
ALTER TABLE `evaluasi`
  MODIFY `id_evaluasi` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forum`
--
ALTER TABLE `forum`
  MODIFY `id_forum` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `informasi`
--
ALTER TABLE `informasi`
  MODIFY `id_informasi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komentar` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kurikulum`
--
ALTER TABLE `kurikulum`
  MODIFY `id_kurikulum` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `laporan_kerusakan`
--
ALTER TABLE `laporan_kerusakan`
  MODIFY `id_laporan` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id_mata_pelajaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id_materi` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  MODIFY `id_pelanggaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rapot`
--
ALTER TABLE `rapot`
  MODIFY `id_rapot` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `struktural_kelas`
--
ALTER TABLE `struktural_kelas`
  MODIFY `id_struktural` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id_tugas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `absensi_ibfk_2` FOREIGN KEY (`mata_pelajaran`) REFERENCES `mata_pelajaran` (`id_mata_pelajaran`),
  ADD CONSTRAINT `absensi_ibfk_3` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id_guru`);

--
-- Constraints for table `bank_soal`
--
ALTER TABLE `bank_soal`
  ADD CONSTRAINT `bank_soal_ibfk_1` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajaran` (`id_mata_pelajaran`),
  ADD CONSTRAINT `bank_soal_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id_kelas`);

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
  ADD CONSTRAINT `jadwal_ibfk_3` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id_guru`);

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
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`forum_id`) REFERENCES `forum` (`id_forum`),
  ADD CONSTRAINT `komentar_ibfk_2` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id_siswa`);

--
-- Constraints for table `laporan_kerusakan`
--
ALTER TABLE `laporan_kerusakan`
  ADD CONSTRAINT `laporan_kerusakan_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id_kelas`);

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
-- Constraints for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  ADD CONSTRAINT `fk_guru` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`),
  ADD CONSTRAINT `fk_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `pelanggaran_ibfk_1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id_siswa`);

--
-- Constraints for table `pengumpulan_tugas`
--
ALTER TABLE `pengumpulan_tugas`
  ADD CONSTRAINT `pengumpulan_tugas_ibfk_1` FOREIGN KEY (`id_tugas`) REFERENCES `tugas` (`id_tugas`),
  ADD CONSTRAINT `pengumpulan_tugas_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`);

--
-- Constraints for table `rapot`
--
ALTER TABLE `rapot`
  ADD CONSTRAINT `rapot_ibfk_1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id_siswa`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id_kelas`);

--
-- Constraints for table `struktural_kelas`
--
ALTER TABLE `struktural_kelas`
  ADD CONSTRAINT `fk_kelas_struktural` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tugas`
--
ALTER TABLE `tugas`
  ADD CONSTRAINT `tugas_ibfk_1` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajaran` (`id_mata_pelajaran`),
  ADD CONSTRAINT `tugas_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id_kelas`);

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
