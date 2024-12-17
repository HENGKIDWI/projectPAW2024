-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 31 Agu 2024 pada 06.16
-- Versi server: 10.6.18-MariaDB-cll-lve-log
-- Versi PHP: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smadcsth_esandik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `nokartu` varchar(50) DEFAULT NULL,
  `idsiswa` int(11) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `idpeg` int(11) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `masuk` varchar(50) DEFAULT NULL,
  `pulang` varchar(50) DEFAULT NULL,
  `ket` varchar(5) DEFAULT NULL,
  `bulan` varchar(50) DEFAULT NULL,
  `tahun` varchar(50) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `mesin` varchar(50) DEFAULT NULL,
  `jjm` varchar(50) DEFAULT NULL,
  `honor` varchar(50) DEFAULT NULL,
  `jenis` int(11) DEFAULT NULL,
  `daring` int(11) NOT NULL DEFAULT 0,
  `foto` text DEFAULT NULL,
  `link` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id`, `tanggal`, `nokartu`, `idsiswa`, `kelas`, `idpeg`, `level`, `masuk`, `pulang`, `ket`, `bulan`, `tahun`, `keterangan`, `mesin`, `jjm`, `honor`, `jenis`, `daring`, `foto`, `link`) VALUES
(1, '2024-08-26', NULL, 385, 'XII-1', NULL, 'siswa', '18:20:19', '18:20:19', 'A', '08', '2024', 'Terlambat 479074 jam, 20 menit, 19 detik', 'MANUAL', NULL, NULL, NULL, 0, NULL, NULL),
(2, '2024-08-26', NULL, 388, 'XII-1', NULL, 'siswa', '18:20:41', '18:20:41', 'S', '08', '2024', 'Terlambat 479074 jam, 20 menit, 41 detik', 'MANUAL', NULL, NULL, NULL, 0, NULL, NULL),
(3, '2024-08-26', NULL, NULL, NULL, 6, 'pegawai', '18:28:35', '18:28:35', 'I', '08', '2024', NULL, 'MANUAL', NULL, NULL, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `absen_daringmapel`
--

CREATE TABLE `absen_daringmapel` (
  `id` int(11) NOT NULL,
  `idmateri` int(11) DEFAULT NULL,
  `mapel` varchar(50) DEFAULT NULL,
  `idsiswa` int(11) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `jam` varchar(50) DEFAULT NULL,
  `bulan` varchar(5) DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL,
  `guru` int(11) DEFAULT NULL,
  `tahun` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `absen_daringmapel`
--

INSERT INTO `absen_daringmapel` (`id`, `idmateri`, `mapel`, `idsiswa`, `tanggal`, `jam`, `bulan`, `ket`, `guru`, `tahun`) VALUES
(1, 1, 'EKN', 397, '2024-08-26', '19:09:28', '08', 'H', 8, '2024'),
(2, 1, 'EKN', 0, '2024-08-28', '17:49:31', '08', 'H', 8, '2024');

-- --------------------------------------------------------

--
-- Struktur dari tabel `adm`
--

CREATE TABLE `adm` (
  `id` int(11) NOT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `idmapel` int(11) DEFAULT NULL,
  `idguru` int(11) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `file` text DEFAULT NULL,
  `link` text DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `pesan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `adm`
--

INSERT INTO `adm` (`id`, `kelas`, `idmapel`, `idguru`, `nama`, `file`, `link`, `tanggal`, `pesan`) VALUES
(1, 'VIII-A', 3, 3, 'RPP', '1bulat.png', NULL, '2024-08-03', 'Assalamualaikum.wr.wb\n\n Saya selaku Kepala Sekolah SMP NEW SANDIK menginformasikan bahwa Sdr/i Edi Sukarna telah Upload Data Administrasi berupa File dengan nama RPP-VIII-A dan saya sampaikan pesan saya yaitu administrasi sudah sesuai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `agenda`
--

CREATE TABLE `agenda` (
  `id` int(11) NOT NULL,
  `mapel` int(11) NOT NULL,
  `kuri` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `idd` varchar(11) DEFAULT NULL,
  `kd` varchar(50) DEFAULT NULL,
  `materi` text DEFAULT NULL,
  `kehadiran` int(11) DEFAULT NULL,
  `bulan` varchar(10) DEFAULT NULL,
  `tahun` varchar(10) DEFAULT NULL,
  `guru` int(11) DEFAULT NULL,
  `hambatan` text DEFAULT NULL,
  `pemecahan` text DEFAULT NULL,
  `lm` varchar(20) DEFAULT NULL,
  `idt` varchar(11) DEFAULT NULL,
  `tp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `agenda`
--

INSERT INTO `agenda` (`id`, `mapel`, `kuri`, `tanggal`, `kelas`, `idd`, `kd`, `materi`, `kehadiran`, `bulan`, `tahun`, `guru`, `hambatan`, `pemecahan`, `lm`, `idt`, `tp`) VALUES
(1, 3, '1', '2024-11-03', 'VIII-A', '1', '3.1', 'nnnnnnnn', 0, '08', '2024', 3, 'bbbbbbb', 'bbbbbbbbbbbbbb', NULL, NULL, NULL),
(2, 3, '1', '2025-02-03', 'VIII-A', '2', '4.1', 'bbbbbbbbbbbb', 0, '08', '2024', 3, 'ngggggggg', 'oooooooo', NULL, NULL, NULL),
(3, 4, '2', '2024-08-26', 'XII-1', NULL, NULL, 'Kaidah Pencacahan ', 0, '08', '2024', 6, NULL, NULL, '1', '3', '1'),
(4, 4, '2', '2024-08-26', 'XII-1', NULL, NULL, 'Kaidah Pencacahan ', 0, '08', '2024', 6, NULL, NULL, '1', '4', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `aplikasi`
--

CREATE TABLE `aplikasi` (
  `id_aplikasi` int(11) NOT NULL,
  `aplikasi` varchar(50) DEFAULT NULL,
  `sekolah` varchar(50) DEFAULT NULL,
  `kode_sekolah` varchar(50) DEFAULT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  `jenjang` varchar(50) DEFAULT NULL,
  `npsn` varchar(50) DEFAULT NULL,
  `semester` int(11) NOT NULL DEFAULT 1,
  `tp` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `desa` varchar(50) DEFAULT NULL,
  `kecamatan` varchar(50) DEFAULT NULL,
  `kabupaten` varchar(50) DEFAULT NULL,
  `propinsi` varchar(50) DEFAULT NULL,
  `kepsek` varchar(50) DEFAULT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `nowa` varchar(12) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `web` varchar(50) DEFAULT NULL,
  `telp` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `waktu` varchar(50) DEFAULT NULL,
  `url_host` varchar(50) DEFAULT NULL,
  `token_api` text DEFAULT NULL,
  `id_server` varchar(50) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `logo` text DEFAULT NULL,
  `header_kartu` text DEFAULT NULL,
  `header` text DEFAULT NULL,
  `server` varchar(20) DEFAULT NULL,
  `proktor` varchar(50) DEFAULT NULL,
  `tekhnisi` text DEFAULT NULL,
  `stempel` text DEFAULT NULL,
  `ttd` text DEFAULT NULL,
  `nama_ujian` varchar(50) DEFAULT NULL,
  `mesin` varchar(20) DEFAULT NULL,
  `url_api` varchar(100) DEFAULT NULL,
  `masuk` varchar(50) DEFAULT NULL,
  `pulang` varchar(50) DEFAULT NULL,
  `alpha` varchar(50) DEFAULT NULL,
  `pelanggaran` int(11) NOT NULL DEFAULT 0,
  `tanggal_rapor` varchar(100) DEFAULT NULL,
  `tgltrx` varchar(2) DEFAULT NULL,
  `idbayar` int(11) DEFAULT NULL,
  `jamkirim` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `aplikasi`
--

INSERT INTO `aplikasi` (`id_aplikasi`, `aplikasi`, `sekolah`, `kode_sekolah`, `jenis`, `jenjang`, `npsn`, `semester`, `tp`, `alamat`, `desa`, `kecamatan`, `kabupaten`, `propinsi`, `kepsek`, `nip`, `nowa`, `email`, `web`, `telp`, `fax`, `waktu`, `url_host`, `token_api`, `id_server`, `status`, `logo`, `header_kartu`, `header`, `server`, `proktor`, `tekhnisi`, `stempel`, `ttd`, `nama_ujian`, `mesin`, `url_api`, `masuk`, `pulang`, `alpha`, `pelanggaran`, `tanggal_rapor`, `tgltrx`, `idbayar`, `jamkirim`) VALUES
(1, 'Sandik All in One', 'SMA DULWICH COLLEGE SCHOOL', 'P01', 'REGULER', 'SMA', '40100862', 1, '2024/2025', 'Jln. Gunung Agung Merdeka Barat No 02', 'Rinegetan ', 'Tondano Barat', 'Mianahasa', 'Sulawesi Utara', 'Drs. George M. Dondokambey, M.S.c', '197406171998031002', '0', 'official@smadcs-tdo.sch.id', 'www.smadcs-tdo.shc.id', '-', '(+62) 873', 'Asia/Makassar', 'https://ujian.mkkskabmalang.com', 'M4L4N9KJ9vUTCuZwEdis', 'SRV-1', 0, 'logo51.png', 'KARTU LOGIN', 'YONGSAN INTERNASIONAL SCHOOL ', 'pusat', 'PROKTOR', NULL, 'stempel85.png', 'ttd73.png', 'SUMATIF AKHIR TAHUN', 'BARCODE', 'http://new.serversandik.my.id', '21:00', '23:00', '09:45', 0, '26 Juni 2024', '14', 1, '10:15:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `banksoal`
--

CREATE TABLE `banksoal` (
  `id_bank` int(11) NOT NULL,
  `kode` varchar(255) DEFAULT NULL,
  `idguru` varchar(11) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `pk` text DEFAULT NULL,
  `status` varchar(2) DEFAULT NULL,
  `soal_agama` varchar(50) DEFAULT NULL,
  `model` int(11) DEFAULT 0,
  `groupsoal` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barusikap`
--

CREATE TABLE `barusikap` (
  `idp` int(11) NOT NULL,
  `nis` varchar(50) DEFAULT NULL,
  `p_dimensi` int(11) NOT NULL,
  `p_elemen` int(11) NOT NULL,
  `p_sub` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `barusikap`
--

INSERT INTO `barusikap` (`idp`, `nis`, `p_dimensi`, `p_elemen`, `p_sub`) VALUES
(1, '20221041', 1, 1, 1),
(2, '20221041', 2, 6, 12),
(3, '20221041', 3, 10, 25),
(4, '20221041', 4, 13, 29),
(5, '20221041', 5, 16, 38),
(6, '20221041', 6, 19, 41);

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id_berita` int(11) NOT NULL,
  `id_bank` int(11) NOT NULL,
  `sesi` varchar(10) NOT NULL,
  `ruang` varchar(20) NOT NULL,
  `jenis` varchar(30) NOT NULL,
  `ikut` varchar(10) DEFAULT NULL,
  `susulan` varchar(10) DEFAULT NULL,
  `no_susulan` text DEFAULT NULL,
  `mulai` varchar(10) DEFAULT NULL,
  `selesai` varchar(10) DEFAULT NULL,
  `nama_proktor` varchar(50) DEFAULT NULL,
  `nip_proktor` varchar(50) DEFAULT NULL,
  `nama_pengawas` varchar(50) DEFAULT NULL,
  `nip_pengawas` varchar(50) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `tgl_ujian` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bk_kategori`
--

CREATE TABLE `bk_kategori` (
  `id` int(11) NOT NULL,
  `kategori` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `bk_kategori`
--

INSERT INTO `bk_kategori` (`id`, `kategori`) VALUES
(1, 'Kelakuan'),
(2, 'Kerapihan'),
(3, 'Kerajinan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bk_pelanggaran`
--

CREATE TABLE `bk_pelanggaran` (
  `id` int(11) NOT NULL,
  `idkat` int(11) NOT NULL,
  `idsub` int(11) DEFAULT NULL,
  `pelanggaran` text DEFAULT NULL,
  `poin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `bk_pelanggaran`
--

INSERT INTO `bk_pelanggaran` (`id`, `idkat`, `idsub`, `pelanggaran`, `poin`) VALUES
(1, 1, 1, 'Terlambat hadir di sekolah \r\n', 2),
(2, 1, 1, 'Tidak membawa buku paket/pelajaran', 5),
(3, 1, 1, 'TIdak mengerjakan tugas sesuai dengan batas waktu yang ditentukan\r\n', 5),
(4, 1, 1, 'Mencontek/ menconteki', 10),
(5, 1, 1, 'Keluar kelas tanpa ijin guru/kabur', 10),
(6, 1, 1, 'Makan/ minum/ tidur saat PBM tanpa ijin guru/\r\n', 10),
(7, 1, 1, 'Membuat gaduh di kelas\r\n', 5),
(8, 1, 1, 'Tidak mengikuti ekstrakurikuler wajib di sekolah\r\n', 10),
(9, 1, 1, 'Tidak mengikuti upacara bendera\r\n', 10),
(12, 2, 3, 'Tidak menggunakan seragam sekolah sesuai aturan', 5),
(13, 2, 3, 'Baju tidak dimasukan', 5),
(14, 1, 6, 'Menggunakan Narkoba\r\n', 100);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bk_siswa`
--

CREATE TABLE `bk_siswa` (
  `id` int(11) NOT NULL,
  `nis` varchar(50) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `idkat` int(11) DEFAULT NULL,
  `idsub` int(11) DEFAULT NULL,
  `idpel` int(11) DEFAULT NULL,
  `idpres` int(11) DEFAULT NULL,
  `tapel` varchar(50) DEFAULT NULL,
  `ket` text DEFAULT NULL,
  `poin` int(11) DEFAULT NULL,
  `sts` varchar(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `bk_siswa`
--

INSERT INTO `bk_siswa` (`id`, `nis`, `kelas`, `tanggal`, `idkat`, `idsub`, `idpel`, `idpres`, `tapel`, `ket`, `poin`, `sts`) VALUES
(1, '13507', 'XII-1', '2024-08-26', 1, 1, 1, NULL, '2024/2025', 'tes', 2, '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bk_sp`
--

CREATE TABLE `bk_sp` (
  `id` int(11) NOT NULL,
  `nis` varchar(50) DEFAULT NULL,
  `poin` int(11) DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL,
  `tapel` varchar(50) DEFAULT NULL,
  `sts` varchar(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bk_sub`
--

CREATE TABLE `bk_sub` (
  `id` int(11) NOT NULL,
  `id_kat` int(11) NOT NULL,
  `sub_kategori` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `bk_sub`
--

INSERT INTO `bk_sub` (`id`, `id_kat`, `sub_kategori`) VALUES
(1, 1, 'Kegiatan Belajar Mengajar'),
(2, 2, 'Rambut'),
(3, 2, 'Pakaian'),
(4, 3, 'Kehadiran'),
(5, 1, 'Merokok'),
(6, 1, 'Minuman keras'),
(7, 1, 'Pornogafi'),
(8, 1, 'Mencuri'),
(9, 1, 'Memeras'),
(10, 1, 'Penghinaan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bk_surat`
--

CREATE TABLE `bk_surat` (
  `id` int(11) NOT NULL,
  `nosurat` varchar(50) DEFAULT NULL,
  `nis` varchar(50) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `sanksi` text NOT NULL,
  `tapel` varchar(50) DEFAULT NULL,
  `sts` varchar(11) DEFAULT '0',
  `idsp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bk_tindakan`
--

CREATE TABLE `bk_tindakan` (
  `id` int(11) NOT NULL,
  `tindakan` varchar(50) DEFAULT NULL,
  `ketentuan` text DEFAULT NULL,
  `minpoin` int(11) DEFAULT NULL,
  `maxpoin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `bk_tindakan`
--

INSERT INTO `bk_tindakan` (`id`, `tindakan`, `ketentuan`, `minpoin`, `maxpoin`) VALUES
(2, 'SP1', 'Orang Tua akan dikirim Surat Peringatan ke 1 (SP1) atas tindakan pelanggaan oleh peserta didik', 35, 45),
(3, 'SP2', 'Orang Tua akan dikirim Surat Peringatan ke 2 (SP2) atas tindakan pelanggaan oleh peserta didik', 46, 74),
(4, 'SP3', 'Orang Tua akan dikirim Surat Peringatan ke 13(SP3) atas tindakan pelanggaan oleh peserta didik', 75, 100);

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `idkategori` int(11) DEFAULT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `penerbit` varchar(100) DEFAULT NULL,
  `pengarang` varchar(100) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `barkode` text DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bulan`
--

CREATE TABLE `bulan` (
  `id` int(11) NOT NULL,
  `bln` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ket` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `bulan`
--

INSERT INTO `bulan` (`id`, `bln`, `ket`) VALUES
(1, '01', 'Januari'),
(2, '02', 'Februari'),
(3, '03', 'Maret'),
(4, '04', 'April'),
(5, '05', 'Mei'),
(6, '06', 'Juni'),
(7, '07', 'Juli'),
(8, '08', 'Agustus'),
(9, '09', 'September'),
(10, '10', 'Oktober'),
(11, '11', 'Nopember'),
(12, '12', 'Desember');

-- --------------------------------------------------------

--
-- Struktur dari tabel `datareg`
--

CREATE TABLE `datareg` (
  `id` int(11) NOT NULL,
  `nokartu` varchar(50) DEFAULT NULL,
  `idsiswa` int(11) DEFAULT NULL,
  `idpeg` int(11) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `idjari` int(11) DEFAULT NULL,
  `serial` varchar(50) NOT NULL,
  `sts` int(11) NOT NULL DEFAULT 0,
  `no_wa` varchar(13) DEFAULT NULL,
  `folder` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `deskripsi`
--

CREATE TABLE `deskripsi` (
  `id` int(11) NOT NULL,
  `mapel` varchar(100) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `smt` int(11) DEFAULT NULL,
  `ki` varchar(11) DEFAULT NULL,
  `kd` varchar(20) DEFAULT NULL,
  `guru` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `deskripsi`
--

INSERT INTO `deskripsi` (`id`, `mapel`, `level`, `deskripsi`, `smt`, `ki`, `kd`, `guru`) VALUES
(1, '3', '8', 'yyyyy', 2, 'KI3', '3.1', 3),
(2, '3', '8', 'nnnnnn', 2, 'KI4', '4.1', 3),
(3, '3', '8', 'bbbbb', 2, 'KI3', '3.2', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `download`
--

CREATE TABLE `download` (
  `id` int(11) NOT NULL,
  `npsn` varchar(50) DEFAULT NULL,
  `idbank` int(11) DEFAULT NULL,
  `ket` int(11) NOT NULL DEFAULT 1,
  `waktu` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `file_pendukung`
--

CREATE TABLE `file_pendukung` (
  `id_file` int(11) NOT NULL,
  `id_bank` int(11) DEFAULT 0,
  `nama_file` varchar(50) DEFAULT NULL,
  `status_file` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `informasi`
--

CREATE TABLE `informasi` (
  `id` int(11) NOT NULL,
  `judul` varchar(50) DEFAULT NULL,
  `untuk` varchar(50) DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `waktu` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `informasi`
--

INSERT INTO `informasi` (`id`, `judul`, `untuk`, `isi`, `waktu`) VALUES
(1, 'INFORMASI', '0', '<p>Selamat datang di Aplikasi Sistem Informasi Pendidikan <strong>SMA DULWICH COLLEGE SCHOOL!</strong></p>', '26 Aug 2024 18:49:42'),
(2, 'INFORMASI', '1', '<p>Selamat datang di Aplikasi Sistem Informasi Pendidikan <strong>SMA DULWICH COLLEGE SCHOOL TONDANO!</strong></p>', '26 Aug 2024 18:50:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_mapel`
--

CREATE TABLE `jadwal_mapel` (
  `id_jadwal` int(11) NOT NULL,
  `tingkat` varchar(50) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `mapel` varchar(100) DEFAULT NULL,
  `guru` int(11) DEFAULT NULL,
  `hari` varchar(50) DEFAULT NULL,
  `kuri` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `jadwal_mapel`
--

INSERT INTO `jadwal_mapel` (`id_jadwal`, `tingkat`, `kelas`, `mapel`, `guru`, `hari`, `kuri`) VALUES
(1, '12', 'XII-1', '3', 6, 'Mon', '2'),
(2, '12', 'XII-2', '3', 6, 'Tue', '2'),
(3, '12', 'XII-3', '8', 6, 'Tue', '2'),
(4, '12', 'XII-2', '3', 6, 'Wed', '2'),
(5, '12', 'XII-4', '8', 6, 'Thu', '2'),
(6, '12', 'XII-3', '8', 6, 'Thu', '2'),
(7, '12', 'XII-4', '8', 6, 'Fri', '2'),
(8, '12', 'XII-1', '8', 8, 'Mon', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_rapor`
--

CREATE TABLE `jadwal_rapor` (
  `id` int(11) NOT NULL,
  `level` int(11) DEFAULT NULL,
  `kelas` varchar(100) DEFAULT NULL,
  `guru` int(11) DEFAULT NULL,
  `kuri` varchar(50) DEFAULT NULL,
  `mapel` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban`
--

CREATE TABLE `jawaban` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `npsn` varchar(50) DEFAULT NULL,
  `id_bank` int(11) NOT NULL DEFAULT 0,
  `id_soal` int(11) NOT NULL DEFAULT 0,
  `id_ujian` int(11) NOT NULL DEFAULT 0,
  `jawaban` varchar(50) DEFAULT NULL,
  `jawabx` varchar(50) DEFAULT NULL,
  `jenis` int(11) NOT NULL,
  `esai` text DEFAULT NULL,
  `jawabmulti` text DEFAULT NULL,
  `jawabbs` text DEFAULT NULL,
  `jawaburut` text DEFAULT NULL,
  `bs1` varchar(5) DEFAULT NULL,
  `bs2` varchar(5) DEFAULT NULL,
  `bs3` varchar(5) DEFAULT NULL,
  `bs4` varchar(5) DEFAULT NULL,
  `bs5` varchar(5) DEFAULT NULL,
  `urut1` text DEFAULT NULL,
  `urut2` text DEFAULT NULL,
  `urut3` text DEFAULT NULL,
  `urut4` text DEFAULT NULL,
  `urut5` text DEFAULT NULL,
  `nilai_esai` int(11) NOT NULL DEFAULT 0,
  `ragu` int(11) NOT NULL DEFAULT 0,
  `status` int(11) DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL,
  `skor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban_dup`
--

CREATE TABLE `jawaban_dup` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `npsn` varchar(50) DEFAULT NULL,
  `id_bank` int(11) NOT NULL DEFAULT 0,
  `id_soal` int(11) NOT NULL DEFAULT 0,
  `id_ujian` int(11) NOT NULL DEFAULT 0,
  `jawaban` varchar(50) DEFAULT NULL,
  `jawabx` varchar(50) DEFAULT NULL,
  `jenis` int(11) NOT NULL,
  `esai` text DEFAULT NULL,
  `jawabmulti` text DEFAULT NULL,
  `jawabbs` text DEFAULT NULL,
  `jawaburut` text DEFAULT NULL,
  `bs1` varchar(5) DEFAULT NULL,
  `bs2` varchar(5) DEFAULT NULL,
  `bs3` varchar(5) DEFAULT NULL,
  `bs4` varchar(5) DEFAULT NULL,
  `bs5` varchar(5) DEFAULT NULL,
  `urut1` text DEFAULT NULL,
  `urut2` text DEFAULT NULL,
  `urut3` text DEFAULT NULL,
  `urut4` text DEFAULT NULL,
  `urut5` text DEFAULT NULL,
  `nilai_esai` int(11) NOT NULL DEFAULT 0,
  `ragu` int(11) NOT NULL DEFAULT 0,
  `status` int(11) DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL,
  `skor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban_soal`
--

CREATE TABLE `jawaban_soal` (
  `id_jawaban` int(11) NOT NULL,
  `id_soal` int(11) DEFAULT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `id_bank` int(11) DEFAULT NULL,
  `id_ujian` int(11) DEFAULT NULL,
  `idjawab` varchar(50) DEFAULT NULL,
  `jenis` int(11) DEFAULT NULL,
  `jawab` text DEFAULT NULL,
  `skor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban_tugas`
--

CREATE TABLE `jawaban_tugas` (
  `id_jawaban` int(11) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `id_tugas` int(11) DEFAULT NULL,
  `jawaban` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `file` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `tgl_dikerjakan` datetime DEFAULT NULL,
  `tgl_update` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nilai` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `nama`, `status`) VALUES
('PAT', 'Penilaian Akhir Tahun', 'tidak'),
('SAT', 'SUMATIF AKHIR TAHUN', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_sp`
--

CREATE TABLE `jenis_sp` (
  `id_sp` int(11) NOT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  `jenjang` varchar(50) DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jenis_sp`
--

INSERT INTO `jenis_sp` (`id_sp`, `jenis`, `jenjang`, `ket`) VALUES
(1, 'REGULER', 'SD', 'SD/MI'),
(2, 'REGULER', 'SMP', 'SMP/MTs'),
(3, 'REGULER', 'SMA', 'SMA/MA'),
(4, 'REGULER', 'SMK', 'SMK'),
(5, 'PKBM', 'PAKET-A', 'KESETARAAN SD'),
(6, 'PKBM', 'PAKET-B', 'KESETARAAN SMP'),
(7, 'PKBM', 'PAKET-C', 'KESETARAAN SMA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jodoh`
--

CREATE TABLE `jodoh` (
  `id_jawaban` int(11) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `id_bank` int(11) NOT NULL DEFAULT 0,
  `id_soal` int(11) NOT NULL DEFAULT 0,
  `id_ujian` int(11) NOT NULL DEFAULT 0,
  `jenis` varchar(50) DEFAULT NULL,
  `jawaburut` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `id` int(11) NOT NULL,
  `kode_jurusan` varchar(50) DEFAULT NULL,
  `nama_jurusan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`id`, `kode_jurusan`, `nama_jurusan`) VALUES
(1, 'UMUM', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `level` int(11) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `pk` varchar(100) DEFAULT NULL,
  `kuri` varchar(11) DEFAULT NULL,
  `model_kkm` varchar(50) DEFAULT NULL,
  `model_rapor` varchar(11) DEFAULT NULL,
  `ketua` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `level`, `kelas`, `pk`, `kuri`, `model_kkm`, `model_rapor`, `ketua`) VALUES
(1, 10, 'X-1', 'UMUM', '2', NULL, '3', NULL),
(2, 10, 'X-2', 'UMUM', '2', NULL, '3', NULL),
(3, 10, 'X-3', 'UMUM', '2', NULL, '3', NULL),
(4, 10, 'X-4', 'UMUM', '2', NULL, '3', NULL),
(5, 10, 'X-5', 'UMUM', '2', NULL, '3', NULL),
(6, 10, 'X-6', 'UMUM', '2', NULL, '3', NULL),
(7, 11, 'XI-1', 'UMUM', '2', NULL, '3', NULL),
(8, 11, 'XI-2', 'UMUM', '2', NULL, '3', NULL),
(9, 11, 'XI-3', 'UMUM', '2', NULL, '3', NULL),
(10, 11, 'XI-4', 'UMUM', '2', NULL, '3', NULL),
(11, 11, 'XI-5', 'UMUM', '2', NULL, '3', NULL),
(12, 11, 'XI-6', 'UMUM', '2', NULL, '3', NULL),
(13, 12, 'XII-1', 'UMUM', '2', NULL, '3', '397'),
(14, 12, 'XII-2', 'UMUM', '2', NULL, '3', NULL),
(15, 12, 'XII-3', 'UMUM', '2', NULL, '3', NULL),
(16, 12, 'XII-4', 'UMUM', '2', NULL, '3', NULL),
(17, 12, 'XII-5', 'UMUM', '2', NULL, '3', NULL),
(18, 12, 'XII-6', 'UMUM', '2', NULL, '3', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar`
--

CREATE TABLE `komentar` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_materi` int(11) DEFAULT NULL,
  `komentar` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `jenis` tinyint(2) DEFAULT NULL,
  `tgl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `guru` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `komentar`
--

INSERT INTO `komentar` (`id`, `id_user`, `id_materi`, `komentar`, `jenis`, `tgl`, `guru`) VALUES
(1, 397, 1, 'Selamat sore pak, saya masih tidaak mengerti di point 2. APakah bisa memberikan referensi tambahan lagi agar saya dapat mengerti?\r\n', 1, '2024-08-26 12:10:41', 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kontakme`
--

CREATE TABLE `kontakme` (
  `id` int(11) NOT NULL,
  `nowa` varchar(13) DEFAULT NULL,
  `nama_kontak` varchar(50) DEFAULT NULL,
  `pemilik` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `kontakme`
--

INSERT INTO `kontakme` (`id`, `nowa`, `nama_kontak`, `pemilik`) VALUES
(1, '0882021733186', 'Admin', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kunci_soal`
--

CREATE TABLE `kunci_soal` (
  `id_bank` int(11) DEFAULT NULL,
  `id_soal` int(11) DEFAULT NULL,
  `id_jawab` varchar(50) DEFAULT NULL,
  `jawaban` text DEFAULT NULL,
  `skor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `level`
--

CREATE TABLE `level` (
  `id_level` int(11) NOT NULL,
  `level` int(11) DEFAULT NULL,
  `kurikulum` varchar(5) DEFAULT NULL,
  `model_kkm` varchar(50) DEFAULT NULL,
  `model_rapor` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `level`
--

INSERT INTO `level` (`id_level`, `level`, `kurikulum`, `model_kkm`, `model_rapor`) VALUES
(10, 10, '2', NULL, '3'),
(11, 11, '2', NULL, '3'),
(12, 12, '2', NULL, '3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lingkup`
--

CREATE TABLE `lingkup` (
  `id` int(11) NOT NULL,
  `mapel` varchar(11) DEFAULT NULL,
  `level` varchar(11) DEFAULT NULL,
  `materi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `smt` varchar(11) DEFAULT NULL,
  `lm` int(11) DEFAULT NULL,
  `guru` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `lingkup`
--

INSERT INTO `lingkup` (`id`, `mapel`, `level`, `materi`, `smt`, `lm`, `guru`) VALUES
(3, '4', '12', 'Kaidah Pencacahan ', '1', 1, 6),
(4, '8', '12', 'Konsep Dasar Akuntansi', '1', 1, 8),
(5, '8', '12', 'Konsep dan manfaat informasi akuntansi, Pemakai informasi akuntansi.', '1', 1, 6),
(6, '8', '12', 'Pengertian persamaan dasar akuntansi dan Unsur-unsur persamaan dasar akuntansi.', '1', 2, 6),
(7, '8', '12', 'Analisis transaksi persamaan dasar akuntansi.', '1', 3, 6),
(8, '8', '12', 'Laporan keuangan', '1', 4, 6),
(9, '8', '12', 'Laporan keuangan.', '1', 5, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `text` varchar(20) NOT NULL,
  `date` varchar(20) NOT NULL,
  `level` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `log`
--

INSERT INTO `log` (`id_log`, `id_user`, `type`, `text`, `date`, `level`) VALUES
(1, 1, 'login', 'Masuk', '2024-08-30 17:49:16', 'admin'),
(2, 1, 'login', 'Masuk', '2024-08-30 17:49:19', 'admin'),
(3, 1, 'login', 'Masuk', '2024-08-30 17:49:19', 'admin'),
(4, 1, 'login', 'Masuk', '2024-08-30 17:49:20', 'admin'),
(5, 1, 'login', 'Masuk', '2024-08-30 17:49:20', 'admin'),
(6, 1, 'login', 'Masuk', '2024-08-30 17:51:44', 'admin'),
(7, 1, 'login', 'Masuk', '2024-08-30 17:56:53', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel_rapor`
--

CREATE TABLE `mapel_rapor` (
  `idm` int(11) NOT NULL,
  `urut` int(11) DEFAULT NULL,
  `mapel` varchar(50) DEFAULT NULL,
  `tingkat` int(11) DEFAULT NULL,
  `pk` varchar(50) DEFAULT NULL,
  `kelompok` varchar(2) DEFAULT NULL,
  `kkm` int(11) DEFAULT NULL,
  `sikap` varchar(11) DEFAULT NULL,
  `kurikulum` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id` int(11) NOT NULL,
  `kode` varchar(50) DEFAULT NULL,
  `nama_mapel` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id`, `kode`, `nama_mapel`) VALUES
(1, 'PKN', 'Pendidikan Pancasila'),
(2, 'BIND', 'Bahasa Indonesia'),
(3, 'MTK', 'Matematika'),
(4, 'FSK', 'Fisika'),
(5, 'BLG', 'Biologi'),
(6, 'KMA', 'Kimia'),
(7, 'SLG', 'Sosiologi'),
(8, 'EKN', 'Ekonomi'),
(9, 'GRF', 'Geografi'),
(10, 'SJRH', 'Sejarah'),
(11, 'BING', 'Bahasa Inggris'),
(12, 'PJOK', 'Pendidikan Jasmani,Olahraga dan Kesehatan'),
(13, 'TIK', 'Informatika'),
(14, 'SBD', 'Seni Budaya'),
(15, 'PRAK', 'Mulok : Prakarya dan Kewirausahaan'),
(16, 'BJEP', 'Bahasa Jepang'),
(17, 'BJER', 'Bahasa Jerman'),
(18, 'SING', 'Sastra nggris'),
(19, 'MTKl', 'Matematika Tingkat Lanjut'),
(20, 'PAK', 'Pendidikan Agama dan Budi Pekerti');

-- --------------------------------------------------------

--
-- Struktur dari tabel `materi`
--

CREATE TABLE `materi` (
  `id_materi` int(255) NOT NULL,
  `id_guru` int(255) DEFAULT NULL,
  `kelas` text DEFAULT NULL,
  `mapel` varchar(255) DEFAULT NULL,
  `judul` text DEFAULT NULL,
  `materi` longtext DEFAULT NULL,
  `quiz` varchar(50) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `tgl_mulai` datetime NOT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `tgl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `materi`
--

INSERT INTO `materi` (`id_materi`, `id_guru`, `kelas`, `mapel`, `judul`, `materi`, `quiz`, `file`, `tgl_mulai`, `youtube`, `tgl`, `status`) VALUES
(1, 8, 'a:1:{i:0;s:5:\"XII-1\";}', 'EKN', 'AKUNTANSI', '<div class=\"LT6XE\">\r\n<div class=\"f5cPye\">\r\n<div>\r\n<div class=\"WaaZC\">\r\n<div class=\"rPeykc PZPZlf\" data-attrid=\"SGEParagraphFeedback\" data-hveid=\"CCgQAQ\" data-ved=\"2ahUKEwii_cWEwpKIAxU-cGwGHYY0HjsQo_EKegQIKBAB\">Akuntansi adalah sistem atau proses yang mencatat, mengelompokkan, meringkas, menganalisis, dan menyajikan informasi keuangan suatu entitas, seperti perusahaan, organisasi, atau individu.&nbsp;Akuntansi menyediakan informasi dan jawaban untuk segala urusan yang berhubungan dengan keuangan perusahaan.&nbsp;Laporan yang berisi informasi yang lengkap dan akurat dapat digunakan untuk menstabilkan bahkan meningkatkan performa perusahaan.<span class=\"UV3uM\">&nbsp;</span>\r\n<div class=\"NPrrbc\" data-cid=\"_4WHMZuKIOL7gseMPhun42AM_40\">\r\n<div class=\"BMebGe btku5b k0Jjg fCrZyc LwdV0e FR7ZSc OJeuxf PrjL8c\" tabindex=\"0\" role=\"button\" aria-label=\"Luaskan\" data-hveid=\"CCYQAQ\" data-ved=\"2ahUKEwii_cWEwpKIAxU-cGwGHYY0HjsQ3fYKegQIJhAB\">\r\n<div class=\"niO4u VDgVie SlP8xc iCQO5d\">\r\n<div class=\"kHtcsd DopHqc\">&nbsp;</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"WaaZC\">\r\n<div class=\"rPeykc PZPZlf\" data-attrid=\"SGEParagraphFeedback\" data-hveid=\"CCMQAQ\" data-ved=\"2ahUKEwii_cWEwpKIAxU-cGwGHYY0HjsQo_EKegQIIxAB\">Akuntansi melibatkan prinsip-prinsip dan teknik khusus untuk merangkai catatan keuangan yang akurat.&nbsp;Siklus akuntansi adalah sebuah proses akuntansi yang mencatat berbagai bukti transaksi keuangan secara teratur untuk dijadikan sebuah laporan atau informasi akuntansi dalam kurun waktu tertentu.<span class=\"UV3uM\">&nbsp;</span>\r\n<div class=\"NPrrbc\" data-cid=\"_4WHMZuKIOL7gseMPhun42AM_39\">\r\n<div class=\"BMebGe btku5b k0Jjg fCrZyc LwdV0e FR7ZSc OJeuxf PrjL8c\" tabindex=\"0\" role=\"button\" aria-label=\"Luaskan\" data-hveid=\"CCIQAQ\" data-ved=\"2ahUKEwii_cWEwpKIAxU-cGwGHYY0HjsQ3fYKegQIIhAB\">\r\n<div class=\"niO4u VDgVie SlP8xc iCQO5d\">\r\n<div class=\"kHtcsd DopHqc\">&nbsp;</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"WaaZC\">\r\n<div class=\"rPeykc PZPZlf\" data-attrid=\"SGEParagraphFeedback\" data-hveid=\"CBwQAQ\" data-ved=\"2ahUKEwii_cWEwpKIAxU-cGwGHYY0HjsQo_EKegQIHBAB\">Lima jenis utama akuntansi meliputi akuntansi biaya, akuntansi keuangan, akuntansi forensik, akuntansi manajemen, dan akuntansi pajak.<span class=\"UV3uM\">&nbsp;</span>\r\n<div class=\"NPrrbc\" data-cid=\"_4WHMZuKIOL7gseMPhun42AM_52\">\r\n<div class=\"BMebGe btku5b k0Jjg fCrZyc LwdV0e FR7ZSc OJeuxf PrjL8c\" tabindex=\"0\" role=\"button\" aria-label=\"Luaskan\" data-hveid=\"CCcQAQ\" data-ved=\"2ahUKEwii_cWEwpKIAxU-cGwGHYY0HjsQ3fYKegQIJxAB\">\r\n<div class=\"niO4u VDgVie SlP8xc iCQO5d\">\r\n<div class=\"kHtcsd DopHqc\">&nbsp;</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"WaaZC\">\r\n<div class=\"rPeykc PZPZlf\" data-attrid=\"SGEParagraphFeedback\" data-hveid=\"CBsQAQ\" data-ved=\"2ahUKEwii_cWEwpKIAxU-cGwGHYY0HjsQo_EKegQIGxAB\">Mahasiswa jurusan akuntansi akan mempelajari berbagai macam hal terkait akuntansi seperti dasar-dasar akuntansi, akuntansi keuangan, audit, perpajakan, sistem informasi akuntansi, analisis laporan keuangan, dan lain sebagainya.<span class=\"UV3uM\">&nbsp;</span>\r\n<div class=\"NPrrbc\" data-cid=\"_4WHMZuKIOL7gseMPhun42AM_35\">\r\n<div class=\"BMebGe btku5b k0Jjg fCrZyc LwdV0e FR7ZSc OJeuxf PrjL8c\" tabindex=\"0\" role=\"button\" aria-label=\"Luaskan\" data-hveid=\"CBoQAQ\" data-ved=\"2ahUKEwii_cWEwpKIAxU-cGwGHYY0HjsQ3fYKegQIGhAB\">\r\n<div class=\"niO4u VDgVie SlP8xc iCQO5d\">\r\n<div class=\"kHtcsd DopHqc\">&nbsp;</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"kLMmLc\">\r\n<div class=\"TRXNOc\">\r\n<div class=\"BOThhc\">\r\n<div>\r\n<div>\r\n<div id=\"_4WHMZuKIOL7gseMPhun42AM_53\" class=\"fx92l\" data-hveid=\"CBgQCg\" data-ved=\"2ahUKEwii_cWEwpKIAxU-cGwGHYY0HjsQ99ANegQIGBAK\">&nbsp;</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', NULL, 'Panduan-Pembelajarn-dan-Asesmen.pdf', '2024-08-26 18:00:00', '', '2024-08-26 11:08:18', NULL),
(2, 6, 'a:1:{i:0;s:5:\"XII-3\";}', 'EKN', 'Penggolongan Akun Akuntansi ', '<p>Akun disebut juga rekening atau perkiraan, merupakan daftar untuk mencatat perubahan aset, liabilitas, ekuitas, perubahan pendapatan dan beban dari transaksi keuangan. Dengan kata lain, akun merupakan alat untuk mencatat transaksi. Terdapat dua kelompok akun, yaitu akun riil dan akun nominal. Adapun pembagiannya sebagai berikut.</p>\r\n<p><strong>a.</strong> <strong>Akun riil</strong></p>\r\n<p>Akun riil merupakan akun yang tercantum dalam laporan posisi keuangan. Menurut standar akuntansi keuangan (SAK) entitas mikro kecil dan menengah (EMKM), akun riil terdiri dari tiga akun, sebagai berikut.</p>\r\n<p><strong>&nbsp; &nbsp; &nbsp;1) Aset</strong></p>\r\n<p>Aset merupakan sumber daya yang dikuasai oleh entitas sebagai hasil usaha di masa lalu, manfaat ekonomi di masa depan diharapkan akan diperoleh oleh entitas. Aset juga diartikan sebagai sumber daya yang dimiliki oleh perusahaan, berupa kumpulan dari berbagai harta atau kekayaan yang dimiliki perusahaan dan bisa dipergunakan untuk memperoleh penghasilan selama tahun berjalannya perusahaan.</p>\r\n<p><strong>&nbsp; &nbsp; &nbsp;2) Liabilitas</strong></p>\r\n<p>Liabilitas merupakan kewajiban terkini entitas yang timbul dari peristiwa masa lalu, penyelesaiannya mengakibatkan arus keluar dari sumber daya entitas yang mengandung manfaat ekonomi. Sederhananya, liabilitas merupakan kewajiban perusahaan untuk membayar kepada pihak lain berupa sejumlah uang maupun barang di masa depan akibat transaksi di masa lalu.</p>\r\n<p><strong>&nbsp; &nbsp; &nbsp;3) Ekuitas</strong></p>\r\n<p>Ekuitas merupakan hak residual atas aset entitas setelah dikurangi liabilitasnya. Dengan kata lain, ekuitas merupakan salah satu sumber dana perusahaan dari pemilik perusahaan maupune pemegang saham.</p>\r\n<p><strong>b. Akun nominal</strong></p>\r\n<p>Akun nominal akan tercantum di laporan laba rugi di akhir periode. Akun ini terdiri dari dua akun, sebagai berikut.</p>\r\n<p><strong>&nbsp; &nbsp; &nbsp;1) Pendapatan</strong></p>\r\n<p>Merupakan hasil yang diperoleh dari kegiatan usaha atau berasal dari kegiatan operasional perusahaan yang mengalir ke kas Prusahaan.</p>\r\n<p><strong>&nbsp; &nbsp; &nbsp;2) Beban</strong></p>\r\n<p>Merupakan uang yang dikeluarkan oleh perusahaan untuk menunjang kegiatan operasionalnya.&nbsp;</p>', NULL, NULL, '2024-08-27 17:00:00', '', '2024-08-27 04:53:30', NULL),
(3, 6, 'a:2:{i:0;s:5:\"XII-3\";i:1;s:5:\"XII-4\";}', 'EKN', 'Sumber Pencatatan Transaksi', '<p style=\"text-align: center;\"><strong>Sumber Pencatatan Transaksi </strong></p>\r\n<p>Pernahkan kalian menerima nota belanja setiap membeli sesuatu? Seberapa penting bukti transaksi dalam transaksi keuangan?</p>\r\n<p>&nbsp;</p>\r\n<p>Setiap melakukan pencatatan transaksi keuangan, harus mengacu kepada dokumen sumber pencatatan atau yang biasa disebut bukti transaksi. Hal ini sangat diperlukan karena bukti transaksi merupakan bukti yang sah dan bisa dipertanggungjawabkan sebelum mencatatnya ke dalam transaksi keuangan. Terdapat dua jenis bukti transaksi, sebagai berikut.</p>', NULL, 'Sumber Pencatatan Transaksi .pdf', '2024-08-29 15:45:00', '', '2024-08-28 01:56:05', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_bayar`
--

CREATE TABLE `m_bayar` (
  `id` int(11) NOT NULL,
  `kode` varchar(50) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `model` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `angsuran` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_buku`
--

CREATE TABLE `m_buku` (
  `idm` int(11) NOT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `rak` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_dimensi`
--

CREATE TABLE `m_dimensi` (
  `id_dimensi` int(11) NOT NULL,
  `dimensi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `m_dimensi`
--

INSERT INTO `m_dimensi` (`id_dimensi`, `dimensi`) VALUES
(1, 'Beriman, Bertakwa Kepada Tuhan Yang Maha Esa, dan Berakhlak Mulia'),
(2, 'Berkebhinekaan Global'),
(3, 'Bergotong-Royong'),
(4, 'Mandiri'),
(5, 'Bernalar Kritis'),
(6, 'Kreatif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_elemen`
--

CREATE TABLE `m_elemen` (
  `id_elemen` int(11) NOT NULL,
  `iddimensi` int(11) NOT NULL,
  `elemen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `m_elemen`
--

INSERT INTO `m_elemen` (`id_elemen`, `iddimensi`, `elemen`) VALUES
(1, 1, 'Akhlak Beragama'),
(2, 1, 'Akhlak Pribadi'),
(3, 1, 'Akhlak Kepada Manusia'),
(4, 1, 'Akhlak Kepada Alam'),
(5, 1, 'Akhlak Bernegara'),
(6, 2, 'Mengenal dan menghargai budaya'),
(7, 2, 'Komunikasi dan interaksi antar budaya'),
(8, 2, 'Refleksi dan bertanggung jawab terhadap pengalaman kebinekaan'),
(9, 2, 'Berkeadilan Sosial'),
(10, 3, 'Kolaborasi'),
(11, 3, 'Kepedulian'),
(12, 3, 'Berbagi'),
(13, 4, 'Pemahaman diri dan situasi yang dihadap'),
(14, 4, 'Regulasi Diri'),
(15, 5, 'Memperoleh dan memproses informasi dan gagasan'),
(16, 5, 'Menganalisis dan mengevaluasi penalaran dan prosedurnya'),
(17, 5, 'Refleksi pemikiran dan proses berpikir'),
(18, 6, 'Menghasilkan gagasan yang orisinal'),
(19, 6, 'Menghasilkan karya dan tindakan yang orisinal'),
(20, 6, 'Memiliki keluwesan berpikir dalam mencari alternatif solusi permasalahan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_eskul`
--

CREATE TABLE `m_eskul` (
  `id` int(11) NOT NULL,
  `eskul` varchar(100) DEFAULT NULL,
  `guru` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_hari`
--

CREATE TABLE `m_hari` (
  `idh` int(11) NOT NULL,
  `hari` varchar(50) NOT NULL,
  `inggris` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `m_hari`
--

INSERT INTO `m_hari` (`idh`, `hari`, `inggris`) VALUES
(1, 'Senin', 'Mon'),
(2, 'Selasa', 'Tue'),
(3, 'Rabu', 'Wed'),
(4, 'Kamis', 'Thu'),
(5, 'Jumat', 'Fri'),
(6, 'Sabtu', 'Sat'),
(7, 'Minggu', 'mon');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_kurikulum`
--

CREATE TABLE `m_kurikulum` (
  `idk` int(11) NOT NULL,
  `nama_kurikulum` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `m_kurikulum`
--

INSERT INTO `m_kurikulum` (`idk`, `nama_kurikulum`) VALUES
(1, 'K-13'),
(2, 'K-Merdeka');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_nilai_proyek`
--

CREATE TABLE `m_nilai_proyek` (
  `nilai` varchar(3) NOT NULL,
  `ket` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `m_nilai_proyek`
--

INSERT INTO `m_nilai_proyek` (`nilai`, `ket`) VALUES
('BB', 'Belum Berkembang'),
('BSH', 'Berkembang Sesuai Harapan'),
('MB', 'Mulai Berkembang'),
('SB', 'Sangat Berkembang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_pesan`
--

CREATE TABLE `m_pesan` (
  `id` int(11) NOT NULL,
  `pesan1` text DEFAULT NULL,
  `pesan2` text DEFAULT NULL,
  `pesan3` text DEFAULT NULL,
  `pesan4` text DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `m_pesan`
--

INSERT INTO `m_pesan` (`id`, `pesan1`, `pesan2`, `pesan3`, `pesan4`, `ket`) VALUES
(1, 'Assalamualaikum wr.wb', 'Kami informasikan Bahwa Ananda', 'Telah hadir dalam KBM SMP NEW SANDIK menggunakan Absesi Digital RFID pada ', 'Demikian Informasi kami sampaikan untuk menjadi Sarana Monitoring Orang Tua Siswa terhadap putra putrinya. Terima kasih dan salam hangat dari Kami,Pesan ini tidak perlu dibalas dikirim via *SERVER WA GATEWAY SMP NEW SANDIK*', NULL),
(2, 'Assalamualaikum wr.wb', 'Kami informasikan Bahwa Ananda', 'Telah selesai melaksanakan KBM SMP NEW SANDIK menggunakan Absesi Digital RFID pada', 'Demikian Informasi kami sampaikan untuk menjadi Sarana Monitoring Orang Tua Siswa terhadap putra putrinya. Terima kasih dan salam hangat dari Kami,Pesan ini tidak perlu dibalas dikirim via *SERVER WA GATEWAY SMP NEW SANDIK*', NULL),
(3, 'Assalamualaikum wr.wb', 'Kami informasikan kepada Kepala Sekolah SMP NEW SANDIK Bahwa Sdr/i', 'Telah hadir dalam KBM SMP NEW SANDIK menggunakan Absesi Digital *FACE RECOGNITION* pada ', 'Demikian Informasi kami sampaikan untuk menjadi Sarana Monitoring Kepala Sekolah terhadap para pegawai. Terima kasih dan salam hangat dari Kami,Pesan ini tidak perlu dibalas dikirim via *SERVER WA GATEWAY SMP NEW SANDIK*', NULL),
(4, 'Assalamualaikum wr.wb', 'Kami informasikan kepada Kepala Sekolah SMP NEW SANDIK Bahwa Sdr/i', 'Telah selesai dalam KBM SMK NEW SANDIK menggunakan Absesi Digital *FACE RECOGNITION* pada ', 'Demikian Informasi kami sampaikan untuk menjadi Sarana Monitoring Kepala Sekolah terhadap para pegawai. Terima kasih dan salam hangat dari Kami,Pesan ini tidak perlu dibalas dikirim via *SERVER WA GATEWAY SMP NEW SANDIK*', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_proyek`
--

CREATE TABLE `m_proyek` (
  `id` int(11) NOT NULL,
  `ke` varchar(50) NOT NULL,
  `tingkat` varchar(50) DEFAULT NULL,
  `fase` varchar(1) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `judul` text DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `semester` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `m_proyek`
--

INSERT INTO `m_proyek` (`id`, `ke`, `tingkat`, `fase`, `kelas`, `judul`, `deskripsi`, `semester`) VALUES
(1, 'Proyek 1', '12', 'F', 'XII-1', 'Kewirausahaan', 'Menciptakan Produk lokal sehingga dapat dijual dan menjadi pendapatan', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_rapor`
--

CREATE TABLE `m_rapor` (
  `idr` int(11) NOT NULL,
  `kuri` int(11) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `m_rapor`
--

INSERT INTO `m_rapor` (`idr`, `kuri`, `model`) VALUES
(1, 1, 'Model 2016'),
(2, 1, 'Model 2023'),
(3, 2, 'Model Kurmer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_spiritual`
--

CREATE TABLE `m_spiritual` (
  `id` int(11) NOT NULL,
  `ket` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `m_spiritual`
--

INSERT INTO `m_spiritual` (`id`, `ket`) VALUES
(1, 'berdoa sebelum dan sesudah melakukan kegiatan'),
(2, 'menjalankan ibadah sesuai dengan agamanya'),
(3, 'memberi salam pada saat awal dan akhir kegiatan'),
(4, 'bersyukur atas nikmat dan karunia Tuhan Yang Maha Esa'),
(5, 'bersyukur ketika berhasil mengerjakan sesuatu'),
(6, 'berserah diri (tawakal) kepada Tuhan setelah berikhtiar atau melakukan usaha'),
(7, 'memelihara hubungan baik dengan sesama umat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_sub_elemen`
--

CREATE TABLE `m_sub_elemen` (
  `id_sub` int(11) NOT NULL,
  `iddimensi` int(11) NOT NULL,
  `idelemen` int(11) NOT NULL,
  `sub_elemen` varchar(100) NOT NULL,
  `A` text DEFAULT NULL,
  `B` text DEFAULT NULL,
  `C` text DEFAULT NULL,
  `D` text DEFAULT NULL,
  `E` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `m_sub_elemen`
--

INSERT INTO `m_sub_elemen` (`id_sub`, `iddimensi`, `idelemen`, `sub_elemen`, `A`, `B`, `C`, `D`, `E`) VALUES
(1, 1, 1, 'Mengenal dan Mencintai Tuhan Yang Maha Esa', 'Mengenali sifat-sifat utama Tuhan bahwa Ia Maha Esa dan Ia adalah Sang Pencipta yang Maha Pengasih dan Maha Penyayang dan mengenali kebaikan dirinya sebagai cerminan sifat Tuhan', 'Memahami sifat-sifat Tuhan utama lainnya dan mengaitkan sifatsifat tersebut dengan konsep dirinya dan ciptaan-Nya', 'Memahami berbagai kualitas atau sifat-sifat Tuhan yang diutarakan dalam kitab suci agama masing-masing dan menghubungkan kualitas-kualitas positif Tuhan dengan sikap pribadinya, serta meyakini firman Tuhan sebagai kebenaran', 'Memahami kehadiran Tuhan dalam kehidupan sehari-hari serta mengaitkan pemahamannya tentang kualitas atau sifat-sifat Tuhan dengan konsep peran manusia di bumi sebagai makhluk Tuhan yang bertanggung jawab', 'Menerapkan pemahamannya tentang kualitas atau sifat-sifat Tuhan dalam ritual ibadahnya baik ibadah yang bersifat personal maupun sosial.'),
(2, 1, 1, 'Pemahaman Agama/Kepercayaan', 'Mengenali unsur-unsur utama agama/kepercayaan (ajaran, ritual keagamaan, kitab suci, dan orang suci/ utusan Tuhan YME).', 'Mengenali unsur-unsur utama agama/kepercayaan (simbol-simbol keagamaan dan sejarah agama/ kepercayaan)', 'Memahami berbagai kualitas atau sifat-sifat Tuhan yang diutarakan dalam kitab suci agama masing-masing dan menghubungkan kualitas-kualitas positif Tuhan dengan sikap pribadinya, serta meyakini firman Tuhan sebagai kebenaran', 'Memahami kehadiran Tuhan dalam kehidupan sehari-hari serta mengaitkan pemahamannya tentang kualitas atau sifat-sifat Tuhan dengan konsep peran manusia di bumi sebagai makhluk Tuhan yang bertanggung jawab', 'Memahami struktur organisasi, unsur-unsur utama agama /kepercayaan dalam konteks Indonesia, memahami kontribusi agama/kepercayaan terhadap peradaban dunia.'),
(3, 1, 1, 'Pelaksanaan Ritual Ibadah', 'Terbiasa melaksanakan ibadah sesuai ajaran agama/kepercayaannya', 'Terbiasa melaksanakan ibadah wajib sesuai tuntunan agama/kepercayaannya', 'Melaksanakan ibadah secara rutin sesuai dengan tuntunan agama/kepercayaan, berdoa mandiri, merayakan, dan memahami makna hari-hari besarnya', 'Melaksanakan ibadah secara rutin dan mandiri sesuai dengan tuntunan agama/kepercayaan, serta berpartisipasi pada perayaan hari-hari besarnya\r\n', 'Melaksanakan ibadah secara rutin dan mandiri serta menyadari arti penting ibadah tersebut dan berpartisipasi aktif pada kegiatan keagamaan atau kepercayaan'),
(4, 1, 2, 'Integritas', 'Membiasakan bersikap jujur terhadap diri sendiri dan orang lain dan berani menyampaikan kebenaran atau fakta', 'Membiasakan melakukan refleksi tentang pentingnya bersikap jujur dan berani menyampaikan kebenaran atau fakta', 'Berani dan konsisten menyampaikan kebenaran atau fakta serta memahami konsekuensi-konsekuensinya untuk diri sendiri', 'Berani dan konsisten menyampaikan kebenaran atau fakta serta memahami konsekuensi-konsekuensinya untuk diri sendiri dan orang lain', 'Menyadari bahwa aturan agama dan sosial merupakan aturan yang baik dan menjadi bagian dari diri sehingga bisa menerapkannya secara bijak dan kontekstual'),
(5, 1, 2, 'Merawat Diri secara Fisik, Mental dan Spiritual', 'Memiliki rutinitas sederhana yang diatur secara mandiri dan dijalankan sehari-hari serta menjaga kesehatan dan keselamatan/keamanan diri dalam semua aktivitas kesehariannya.\r\n', 'Mulai membiasakan diri untuk disiplin, rapi, membersihkan dan merawat tubuh, menjaga tingkah laku dan perkataan dalam semua aktivitas kesehariannya', 'Memperhatikan kesehatan jasmani, mental, dan rohani dengan melakukan aktivitas fisik, sosial, dan ibadah', 'Mengidentifikasi pentingnya menjaga keseimbangan kesehatan jasmani, mental, dan rohani serta berupaya menyeimbangkan aktivitas fisik, sosial dan ibadah', 'Melakukan aktivitas fisik, sosial, dan ibadah secara seimbang.'),
(6, 1, 3, 'Mengutamakan persamaan dengan orang lain dan menghargai perbedaan', 'Mengenali hal-hal yang sama dan berbeda yang dimiliki diri dan temannya dalam berbagai hal, serta memberikan respon secara positif.', 'Terbiasa mengidentifikasi hal-hal yang sama dan berbeda yang dimiliki diri dan temannya dalam berbagai hal serta memberikan respon secara positif.', 'Mengidentifikasi kesamaan dengan orang lain sebagai perekat hubungan sosial dan mewujudkannya dalam aktivitas kelompok. Mulai mengenal berbagai kemungkinan interpretasi dan cara pandang yang berbeda ketika dihadapkan dengan dilema.', 'Mengenal perspektif dan emosi/perasaan dari sudut pandang orang atau kelompok lain yang tidak pernah dijumpai atau dikenalnya. Mengutamakan persamaan dan menghargai perbedaan sebagai alat pemersatu dalam keadaan konflik atau perdebatan.', 'Mengidentifikasi hal yang menjadi permasalahan bersama, memberikan alternatif solusi untuk menjembatani perbedaan dengan mengutamakan kemanusiaan.'),
(7, 1, 3, 'Berempati kepada orang lain', 'Mengidentifikasi emosi, minat dan kebutuhan orang-orang terdekat dan meresponnya secara positif.', 'Terbiasa memberikan apresiasi di lingkungan sekolah dan masyarakat', 'Mulai memandang sesuatu dari perspektif orang lain serta mengidentifikasi kebaikan dan kelebihan orang sekitarnya.', 'Memahami perasaan dan sudut pandang orang dan/atau kelompok lain yang tidak pernah dikenalnya', 'Memahami dan menghargai perasaan dan sudut pandang orang dan/atau kelompok lain.'),
(8, 1, 4, 'Memahami Keterhubungan Ekosistem Bumi', 'Mengidentifikasi berbagai ciptaan Tuhan', 'Memahami keterhubungan antara satu ciptaan dengan ciptaan Tuhan yang lainnya', 'Memahami konsep harmoni dan mengidentifikasi adanya saling ketergantungan antara berbagai ciptaan Tuhan', 'Memahami konsep sebab-akibat di antara berbagai ciptaan Tuhan dan mengidentifikasi berbagai sebab yang mempunyai dampak baik atau buruk, langsung maupun tidak langsung, terhadap alam semesta.\r\n', 'Mengidentifikasi masalah lingkungan hidup di tempat ia tinggal dan melakukan langkah-langkah konkrit yang bisa dilakukan untuk menghindari kerusakan dan menjaga keharmonisan ekosistem yang ada di lingkungannya.'),
(9, 1, 4, 'Menjaga Lingkungan Alam Sekitar', 'Membiasakan bersyukur atas lingkungan alam sekitar dan berlatih untuk menjaganya\r\n', 'Terbiasa memahami tindakan-tindakan yang ramah dan tidak ramah lingkungan serta membiasakan diri untuk berperilaku ramah lingkungan\r\n', 'Mewujudkan rasa syukur dengan terbiasa berperilaku ramah lingkungan dan memahami akibat perbuatan tidak ramah lingkungan dalam lingkup kecil maupun besar.\r\n', 'Mewujudkan rasa syukur dengan berinisiatif untuk menyelesaikan permasalahan lingkungan alam sekitarnya dengan mengajukan alternatif solusi dan mulai menerapkan solusi tersebut.\r\n', 'Mewujudkan rasa syukur dengan membangun kesadaran peduli lingkungan alam dengan menciptakan dan mengimplementasikan solusi dari permasalahan lingkungan yang ada.'),
(10, 1, 5, 'Melaksanakan Hak dan Kewajiban sebagai Warga Negara Indonesia', 'Mengidentifikasi hak dan tanggung jawabnya di rumah, sekolah, dan lingkungan sekitar serta kaitannya dengan keimanan kepada Tuhan YME.\r\n\r\n', 'Mengidentifikasi hak dan tanggung jawab orang-orang di sekitarnya serta kaitannya dengan keimanan kepada Tuhan YME.\r\n', 'Mengidentifikasi dan memahami peran, hak, dan kewajiban dasar sebagai warga negara serta kaitannya dengan keimanan kepada Tuhan YME dan secara sadar mempraktikkannya dalam kehidupan sehari-hari.\r\n', 'Menganalisa peran, hak, dan kewajiban sebagai warga negara, memahami perlunya mengutamakan kepentingan umum di atas kepentingan pribadi sebagai wujud dari keimanannya kepada Tuhan YME.\r\n', 'Memperoleh hak dan melaksanakan kewajiban kewarganegaraan dan terbiasa mendahulukan kepentingan umum di atas kepentingan pribadi sebagai wujud dari keimanannya kepada Tuhan YME.'),
(11, 2, 6, 'Mendalami budaya dan identitas budaya', 'Mengidentifikasi dan mendeskripsikan ide-ide tentang dirinya dan beberapa macam kelompok di lingkungan sekitarnya\r\n', 'Mengidentifikasi dan mendeskripsikan ide-ide tentang dirinya dan berbagai macam kelompok di lingkungan sekitarnya, serta cara orang lain berperilaku dan berkomunikasi dengannya.\r\n', 'Mengidentifikasi dan mendeskripsikan keragaman budaya di sekitarnya; serta menjelaskan peran budaya dan Bahasa dalam membentuk identitas dirinya.\r\n', 'Menjelaskan perubahan budaya seiring waktu dan sesuai konteks, baik dalam skala lokal, regional, dan nasional. Menjelaskan identitas diri yang terbentuk dari budaya bangsa.\r\n', 'Menganalisis pengaruh keanggotaan kelompok lokal, regional, nasional, dan global terhadap pembentukan identitas, termasuk identitas dirinya. Mulai menginternalisasi identitas diri sebagai bagian dari budaya bangsa.'),
(12, 2, 6, 'Mengeksplorasi dan membandingkan pengetahuan budaya, kepercayaan, serta praktiknya', 'Mengidentifikasi dan mendeskripsikan praktik keseharian diri dan budayanya\r\n', 'Mengidentifikasi dan membandingkan praktik keseharian diri dan budayanya dengan orang lain di tempat dan waktu/era yang berbeda.\r\n', 'Mendeskripsikan dan membandingkan pengetahuan, kepercayaan, dan praktik dari berbagai kelompok budaya.\r\n', 'Memahami dinamika budaya yang mencakup pemahaman, kepercayaan, dan praktik keseharian dalam konteks personal dan sosial.\r\n', 'Menganalisis dinamika budaya yang mencakup pemahaman, kepercayaan, dan praktik keseharian dalam rentang waktu yang panjang dan konteks yang luas.'),
(13, 2, 6, 'Menumbuhkan rasa menghormati terhadap keanekaragaman budaya', 'Mendeskripsikan pengalaman dan pemahaman hidup bersama-sama dalam kemajemukan.\r\n', 'Memahami bahwa kemajemukan dapat memberikan kesempatan untuk mendapatkan pengalaman dan pemahaman yang baru.\r\n', 'Mengidentifikasi peluang dan tantangan yang muncul dari keragaman budaya di Indonesia.\r\n', 'Memahami pentingnya melestarikan dan merayakan tradisi budaya untuk mengembangkan identitas pribadi, sosial, dan bangsa Indonesia serta mulai berupaya melestarikan budaya dalam kehidupan sehari-hari.\r\n', 'Memahami pentingnya saling menghormati dalam mempromosikan pertukaran budaya dan kolaborasi dalam dunia yang saling terhubung serta menunjukkannya dalam perilaku.'),
(14, 2, 7, 'Berkomunikasi antar budaya', 'Mengenali bahwa diri dan orang lain menggunakan kata, gambar, dan bahasa tubuh yang dapat memiliki makna yang berbeda di lingkungan sekitarnya\r\n', 'Mendeskripsikan penggunaan kata, tulisan dan bahasa tubuh yang memiliki makna yang berbeda di lingkungan sekitarnya dan dalam suatu budaya tertentu.\r\n', 'Memahami persamaan dan perbedaan cara komunikasi baik di dalam maupun antar kelompok budaya.\r\n', 'Mengeksplorasi pengaruh budaya terhadap penggunaan bahasa serta dapat mengenali risiko dalam berkomunikasi antar budaya.\r\n', 'Menganalisis hubungan antara bahasa, pikiran, dan konteks untuk memahami dan meningkatkan komunikasi antar budaya yang berbeda-beda.'),
(15, 2, 7, 'Mempertimbangkan dan menumbuhkan berbagai perspektif', 'Mengekspresikan pandangannya terhadap topik yang umum dan mendengarkan sudut pandang orang lain yang berbeda dari dirinya dalam lingkungan keluarga dan sekolah\r\n', 'Mengekspresikan pandangannya terhadap topik yang umum dan dapat mengidentifikasi sudut pandang orang lain. Mendengarkan dan membayangkan sudut pandang orang lain yang berbeda dari dirinya pada situasi di ranah sekolah, keluarga, dan lingkungan sekitar.\r\n', 'Membandingkan beragam perspektif untuk memahami permasalahan sehari-hari. Membayangkan dan mendeskripsikan situasi komunitas yang berbeda dengan dirinya ke dalam situasi dirinya dalam konteks lokal dan regional.\r\n', 'Menjelaskan asumsi-asumsi yang mendasari perspektif tertentu. Membayangkan dan mendeskripsikan perasaan serta motivasi komunitas yang berbeda dengan dirinya yang berada dalam situasi yang sulit.\r\n', 'Menyajikan pandangan yang seimbang mengenai permasalahan yang dapat menimbulkan pertentangan pendapat. Memperlakukan orang lain dan budaya yang berbeda darinya dalam posisi setara dengan diri dan budayanya, serta bersedia memberikan pertolongan ketika orang lain berada dalam situasi sulit.'),
(16, 2, 8, 'Refleksi terhadap pengalaman kebinekaan', 'Menyebutkan apa yang telah dipelajari tentang orang lain dari interaksinya dengan kemajemukan budaya di lingkungan sekolah dan rumah\r\n', 'Menyebutkan apa yang telah dipelajari tentang orang lain dari interaksinya dengan kemajemukan budaya di lingkungan sekitar.\r\n', 'Menjelaskan apa yang telah dipelajari dari interaksi dan pengalaman dirinya dalam lingkungan yang beragam.\r\n', 'Merefleksikan secara kritis gambaran berbagai kelompok budaya yang ditemui dan cara meresponnya.\r\n', 'Merefleksikan secara kritis dampak dari pengalaman hidup di lingkungan yang beragam terkait dengan perilaku, kepercayaan serta tindakannya terhadap orang lain.'),
(17, 2, 8, 'Menghilangkan stereotip dan prasangka', 'Mengenali perbedaan tiap orang atau kelompok dan menganggapnya sebagai kewajaran\r\n', 'Mengkonfirmasi dan mengklarifikasi stereotip dan prasangka yang dimilikinya tentang orang atau kelompokdi sekitarnya untuk mendapatkan pemahaman yang lebih baik\r\n', 'Mengkonfirmasi dan mengklarifikasi stereotip dan prasangka yang dimilikinya tentang orang atau kelompok di sekitarnya untuk mendapatkan pemahaman yang lebih baik serta mengidentifikasi pengaruhnya terhadap individu dan kelompok di lingkungan sekitarnya\r\n', 'Mengkonfirmasi, mengklarifikasi dan menunjukkan sikapmenolak stereotip serta prasangka tentang gambaran identitas kelompok dan suku bangsa.\r\n', 'Mengkritik dan menolak stereotip serta prasangka tentang gambaran identitas kelompok dan suku bangsa serta berinisiatif mengajak orang lain untuk menolak stereotip dan prasangka.'),
(18, 2, 8, 'Menyelaraskan perbedaan budaya', 'Mengidentifikasi perbedaan-perbedaan budaya yang konkrit di lingkungan sekitar\r\n', 'Mengenali bahwa perbedaan budaya mempengaruhi pemahaman antarindividu.\r\n', 'Mencari titik temu nilai budaya yang beragam untuk menyelesaikan permasalahan bersama.\r\n', 'Mengkonfirmasi, mengklarifikasi dan menunjukkan sikapmenolak stereotip serta prasangka tentang gambaran identitas kelompok dan suku bangsa.\r\n', 'Mengetahui tantangan dan keuntungan hidup dalam lingkungan dengan budaya yang beragam, serta memahami pentingnya kerukunan antar budaya dalam kehidupan bersama yang harmonis.'),
(19, 2, 9, 'Aktif membangun masyarakat yang inklusif, adil, dan berkelanjutan\r\n', 'Menjalin pertemanan tanpa memandang perbedaan agama, suku, ras, jenis kelamin, dan perbedaan lainnya, dan mengenal masalah-masalah sosial, ekonomi, dan lingkungan di lingkungan sekitarnya\r\n', 'Mengidentifikasi cara berkontribusi terhadap lingkungan sekolah, rumah dan lingkungan sekitarnya yang inklusif, adil dan berkelanjutan\r\n', 'Membandingkan beberapa tindakan dan praktik perbaikan lingkungan sekolah yang inklusif, adil, dan berkelanjutan, dengan mempertimbangkan dampaknya secara jangka panjang terhadap manusia, alam, dan masyarakat\r\n', 'Mengidentifikasi masalah yang ada di sekitarnya sebagai akibat dari pilihan yang dilakukan oleh manusia, serta dampak masalah tersebut terhadap sistem ekonomi, sosial dan lingkungan, serta mencari solusi yang memperhatikan prinsip-prinsip keadilan terhadap manusia, alam dan masyarakat\r\n', 'Berinisiatif melakukan suatu tindakan berdasarkan identifikasi masalah untuk mempromosikan keadilan, keamanan ekonomi, menopang ekologi dan demokrasi sambil menghindari kerugian jangka panjang terhadap manusia, alam ataupun masyarakat.\r\n'),
(20, 2, 9, 'Berpartisipasi dalam proses pengambilan keputusan bersama', 'Mengidentifikasi pilihan-pilihan berdasarkan kebutuhan dirinya dan orang lain ketika membuat keputusan\r\n', 'Berpartisipasi menentukan beberapa pilihan untuk keperluan bersama berdasarkan kriteria sederhana\r\n', 'Berpartisipasi dalam menentukan kriteria yang disepakati bersama untuk menentukan pilihan dan keputusan untuk kepentingan bersama\r\n', 'Berpartisipasi dalam menentukan kriteria dan metode yang disepakati bersama untuk menentukan pilihan dan keputusan untuk kepentingan bersama melalui proses bertukar pikiran secara cermat dan terbuka dengan panduan pendidik\r\n', 'Berpartisipasi menentukan pilihan dan keputusan untuk kepentingan bersama melalui proses bertukar pikiran secara cermat dan terbuka secara mandiri\r\n'),
(21, 2, 9, 'Memahami peran individu dalam demokrasi', 'Mengidentifikasi peran, hak dan kewajiban warga dalam masyarakat demokratis\r\n', 'Memahami konsep hak dan kewajiban, serta implikasinya terhadap perilakunya.\r\n', 'Memahami konsep hak dan kewajiban, serta implikasinya terhadap perilakunya. Menggunakan konsep ini untuk menjelaskan perilaku diri dan orang sekitarnya\r\n', 'Memahami konsep hak dan kewajiban serta implikasinya terhadap ekspresi dan perilakunya. Mulai aktif mengambil sikap dan langkah untuk melindungi hak orang/kelompok lain.\r\n', 'Memahami konsep hak dan kewajiban, serta implikasinya terhadap ekspresi dan perilakunya. Mulai mencari solusi untuk dilema terkait konsep hak dan kewajibannya.\r\n'),
(22, 3, 10, 'Kerja sama', 'Menerima dan melaksanakan tugas serta peran yang diberikan kelompok dalam sebuah kegiatan bersama.\r\n', 'Menampilkan tindakan yang sesuai dengan harapan dan tujuan kelompok.\r\n', 'Menunjukkan ekspektasi (harapan) positif kepada orang lain dalam rangka mencapai tujuan kelompok di lingkungan sekitar (sekolah dan rumah).\r\n', 'Menyelaraskan tindakan sendiri dengan tindakan orang lain untuk melaksanakan kegiatan dan mencapai tujuan kelompok di lingkungan sekitar, serta memberi semangat kepada orang lain untuk bekerja efektif dan mencapai tujuan bersama.\r\n', 'Membangun tim dan mengelola kerjasama untuk mencapai tujuan bersama sesuai dengan target yang sudah ditentukan.\r\n'),
(23, 3, 10, 'Komunikasi untuk mencapai tujuan bersama', 'Memahami informasi sederhana dari orang lain dan menyampaikan informasi sederhana kepada orang lain menggunakan kata-katanya sendiri.\r\n', 'Memahami informasi yang disampaikan (ungkapan pikiran, perasaan, dan keprihatinan) orang lain dan menyampaikan informasi secara akurat menggunakan berbagai simbol dan media\r\n', 'Memahami informasi dari berbagai sumber dan menyampaikan pesan menggunakan berbagai simbol dan media secara efektif kepada orang lain untuk mencapai tujuan bersama\r\n', 'Memahami informasi, gagasan, emosi, keterampilan dan keprihatinan yang diungkapkan oleh orang lain menggunakan berbagai simbol dan media secara efektif, serta memanfaatkannya untuk meningkatkan kualitas hubungan interpersonal guna mencapai tujuan bersama.\r\n', 'Aktif menyimak untuk memahami dan menganalisis informasi, gagasan, emosi, keterampilan dan keprihatinan yang disampaikan oleh orang lain dan kelompok menggunakan berbagai simbol dan media secara efektif, serta menggunakan berbagai strategi komunikasi untuk menyelesaikan masalah guna mencapai berbagai tujuan bersama.\r\n'),
(24, 3, 10, 'Saling-ketergantungan positif', 'Mengenali kebutuhan-kebutuhan diri sendiri yang memerlukan orang lain dalam pemenuhannya.\r\n', 'Menyadari bahwa setiap orang membutuhkan orang lain dalam memenuhi kebutuhannya dan perlunya saling membantu\r\n', 'Menyadari bahwa meskipun setiap orang memiliki otonominya masing-masing, setiap orang membutuhkan orang lain dalam memenuhi kebutuhannya.\r\n', 'Mendemonstrasikan kegiatan kelompok yang menunjukkan bahwa anggota kelompok dengan kelebihan dan kekurangannya masing-masing perlu dan dapat saling membantu memenuhi kebutuhan.\r\n', 'Menyelaraskan kapasitas kelompok agar para anggota kelompok dapat saling membantu satu sama lain memenuhi kebutuhan mereka baik secara individual maupun kolektif.\r\n'),
(25, 3, 10, 'Koordinasi Sosial', 'Melaksanakan aktivitas kelompok sesuai dengan kesepakatan bersama dengan bimbingan, dan saling mengingatkan adanya kesepakatan tersebut.\r\n', 'Menyadari bahwa dirinya memiliki peran yang berbeda dengan orang lain/temannya, serta mengetahui konsekuensi perannya terhadap ketercapaian tujuan.\r\n', 'Menyelaraskan tindakannya sesuai dengan perannya dan mempertimbangkan peran orang lain untuk mencapai tujuan bersama.\r\n', 'Membagi peran dan menyelaraskan tindakan dalam kelompok serta menjaga tindakan agar selaras untuk mencapai tujuan bersama.\r\n', 'Menyelaraskan dan menjaga tindakan diri dan anggota kelompok agar sesuai antara satu dengan lainnya serta menerima konsekuensi tindakannya dalam rangka mencapai tujuan bersama.\r\n'),
(26, 3, 11, 'Tanggap terhadap lingkungan Sosial', 'Peka dan mengapresiasi orang-orang di lingkungan sekitar, kemudian melakukan tindakan sederhana untuk mengungkapkannya.\r\n', 'Peka dan mengapresiasi orang-orang di lingkungan sekitar, kemudian melakukan tindakan untuk menjaga keselarasan dalam berelasi dengan orang lain.\r\n', 'Tanggap terhadap lingkungan sosial sesuai dengan tuntutan peran sosialnya dan menjaga keselarasan dalam berelasi dengan orang lain.\r\n', 'Tanggap terhadap lingkungan sosial sesuai dengan tuntutan peran sosialnya dan berkontribusi sesuai dengan kebutuhan masyarakat.\r\n', 'Tanggap terhadap lingkungan sosial sesuai dengan tuntutan peran sosialnya dan berkontribusi sesuai dengan kebutuhan masyarakat untuk menghasilkan keadaan yang lebih baik.\r\n'),
(27, 3, 11, 'Persepsi sosial', 'Mengenali berbagai reaksi orang lain di lingkungan sekitar dan penyebabnya.\r\n', 'Memahami berbagai alasan orang lain menampilkan respon tertentu\r\n', 'Menerapkan pengetahuan mengenai berbagai reaksi orang lain dan penyebabnya dalam konteks keluarga, sekolah, serta pertemanan dengan sebaya.\r\n', 'Menggunakan pengetahuan tentang sebab dan alasan orang lain menampilkan reaksi tertentu untuk menentukan tindakan yang tepat agar orang lain menampilkan respon yang diharapkan.\r\n', 'Melakukan tindakan yang tepat agar orang lain merespon sesuai dengan yang diharapkan dalam rangka penyelesaian pekerjaan dan pencapaian tujuan.\r\n'),
(28, 3, 12, 'Berbagi', 'Memberi dan menerima hal yang dianggap berharga dan penting kepada/dari orang-orang di lingkungan sekitar.\r\n', '\"\r\nMemberi dan menerima hal yang dianggap penting dan berharga kepada/dari orang-orang di lingkungan sekitar baik yang dikenal maupun tidak dikenal.\"\r\n', 'Memberi dan menerima hal yang dianggap penting dan berharga kepada/dari orang-orang di lingkungan luas/masyarakat baik yang dikenal maupun tidak dikenal.\r\n', '\"\r\nMengupayakan memberi hal yang dianggap penting dan berharga kepada masyarakat yang membutuhkan bantuan di sekitar tempat tinggal\"\r\n', 'Mengupayakan memberi hal yang dianggap penting dan berharga kepada orang-orang yang membutuhkan di masyarakat yang lebih luas (negara, dunia).\r\n'),
(29, 4, 13, 'Mengenali kualitas dan minat diri serta tantangan yang dihadapi', 'Mengidentifikasi dan menggambarkan kemampuan, prestasi, dan ketertarikannya secara subjektif\r\n', 'Mengidentifikasi kemampuan, prestasi, dan ketertarikannya serta tantangan yang dihadapi berdasarkan kejadian-kejadian yang dialaminya dalam kehidupan sehari-hari.\r\n', 'Menggambarkan pengaruh kualitas dirinya terhadap pelaksanaan dan hasil belajar; serta mengidentifikasi kemampuan yang ingin dikembangkan dengan mempertimbangkan tantangan yang dihadapinya dan umpan balik dari orang dewasa\r\n', 'Membuat penilaian yang realistis terhadap kemampuan dan minat , serta prioritas pengembangan diri berdasarkan pengalaman belajar dan aktivitas lain yang dilakukannya.\r\n', 'Mengidentifikasi kekuatan dan tantangan-tantangan yang akan dihadapi pada konteks pembelajaran, sosial dan pekerjaan yang akan dipilihnya di masa depan.\r\n'),
(30, 4, 13, 'Mengembangkan refleksi diri', 'Melakukan refleksi untuk mengidentifikasi kekuatan dan kelemahan, serta prestasi dirinya.\r\n', 'Melakukan refleksi untuk mengidentifikasi kekuatan, kelemahan, dan prestasi dirinya, serta situasi yang dapat mendukung dan menghambat pembelajaran dan pengembangan dirinya\r\n', 'Melakukan refleksi untuk mengidentifikasi faktor-faktor di dalam maupun di luar dirinya yang dapat mendukung/menghambatnya dalam belajar dan mengembangkan diri; serta mengidentifikasi cara-cara untuk mengatasi kekurangannya.\r\n', 'Memonitor kemajuan belajar yang dicapai serta memprediksi tantangan pribadi dan akademik yang akan muncul berlandaskan pada pengalamannya untuk mempertimbangkan strategi belajar yang sesuai.\r\n', 'Melakukan refleksi terhadap umpan balik dari teman, guru, dan orang dewasa lainnya, serta informasi-informasi karir yang akan dipilihnya untuk menganalisis karakteristik dan keterampilan yang dibutuhkan dalam menunjang atau menghambat karirnya di masa depan.\r\n'),
(31, 4, 14, 'Regulasi emosi', 'Mengidentifikasi perbedaan emosi yang dirasakannya dan situasi-situasi yang menyebabkan-nya; serta mengekspresi-kan secara wajar\r\n', 'Mengetahui adanya pengaruh orang lain, situasi, dan peristiwa yang terjadi terhadap emosi yang dirasakannya; serta berupaya untuk mengekspresikan emosi secara tepat dengan mempertimbangkan perasaan dan kebutuhan orang lain disekitarnya\r\n', 'Memahami perbedaan emosi yang dirasakan dan dampaknya terhadap proses belajar dan interaksinya dengan orang lain; serta mencoba cara-cara yang sesuai untuk mengelola emosi agar dapat menunjang aktivitas belajar dan interaksinya dengan orang lain.\r\n', 'Memahami dan memprediksi konsekuensi dari emosi dan pengekspresiannya dan menyusun langkah-langkah untuk mengelola emosinya dalam pelaksanaan belajar dan berinteraksi dengan orang lain.\r\n', 'Mengendalikan dan menyesuaikan emosi yang dirasakannya secara tepat ketika menghadapi situasi yang menantang dan menekan pada konteks belajar, relasi, dan pekerjaan.\r\n'),
(32, 4, 14, 'Penetapan tujuan belajar, prestasi, dan pengembangan diri serta rencana strategis untuk mencapainya', 'Menetapkan target belajar dan merencanakan waktu dan tindakan belajar yang akan dilakukannya.\r\n', 'Menjelaskan pentingnya memiliki tujuan dan berkomitmen dalam mencapainya serta mengeksplorasi langkah-langkah yang sesuai untuk mencapainya\r\n', 'Menilai faktor-faktor (kekuatan dan kelemahan) yang ada pada dirinya dalam upaya mencapai tujuan belajar, prestasi, dan pengembangan dirinya serta mencoba berbagai strategi untuk mencapainya.\r\n', 'Merancang strategi yang sesuai untuk menunjang pencapaian tujuan belajar, prestasi, dan pengembangan diri dengan mempertimbangkan kekuatan dan kelemahan dirinya, serta situasi yang dihadapi.\r\n', 'Mengevaluasi efektivitas strategi pembelajaran digunakannya, serta menetapkan tujuan belajar, prestasi, dan pengembangan diri secara spesifik dan merancang strategi yang sesuai untuk menghadapi tantangan-tantangan yang akan dihadapi pada konteks pembelajaran, sosial dan pekerjaan yang akan dipilihnya di masa depan.\r\n'),
(33, 4, 14, 'Menunjukkan inisiatif dan bekerja secara mandiri', 'Berinisiatif untuk mengerjakan tugas-tugas rutin secara mandiri dibawah pengawasan dan dukungan orang dewasa\r\n', 'Mempertimbangkan, memilih dan mengadopsi berbagai strategi dan mengidentifikasi sumber bantuan yang diperlukan serta berinisiatif menjalankannya untuk mendapatkan hasil belajar yang diinginkan.\r\n', 'Memahami arti penting bekerja secara mandiri serta inisiatif untuk melakukannya dalam menunjang pembelajaran dan pengembangan dirinya\r\n', 'Mengkritisi efektivitas dirinya dalam bekerja secara mandiri dengan mengidentifikasi hal-hal yang menunjang maupun menghambat dalam mencapai tujuan.\r\n', 'Menentukan prioritas pribadi, berinisiatif mencari dan mengembangkan pengetahuan dan keterampilan yang spesifik sesuai tujuan di masa depan.\r\n'),
(34, 4, 14, 'Mengembangkan pengendalian dan disiplin diri', 'Melaksanakan kegiatan belajar di kelas dan menyelesaikan tugas-tugas dalam waktu yang telah disepakati.\r\n', 'Menjelaskan pentingnya mengatur diri secara mandiri dan mulai menjalankan kegiatan dan tugas yang telah sepakati secara mandiri\r\n', 'Mengidentifikasi faktor-faktor yang dapat mempengaruhi kemampuan dalam mengelola diri dalam pelaksanaan aktivitas belajar dan pengembangan dirinya.\r\n', 'Berkomitmen dan menjaga konsistensi pencapaian tujuan yang telah direncanakannya untuk mencapai tujuan belajar dan pengembangan diri yang diharapkannya\r\n', 'Melakukan tindakan-tindakan secara konsisten guna mencapai tujuan karir dan pengembangan dirinya di masa depan, serta berusaha mencari dan melakukan alternatif tindakan lain yang dapat dilakukan ketika menemui hambatan.\r\n'),
(35, 4, 14, 'Percaya diri, tangguh (resilient), dan adaptif', 'Berani mencoba dan adaptif menghadapi situasi baru serta bertahan mengerjakan tugas-tugas yang disepakati hingga tuntas\r\n', 'Tetap bertahan mengerjakan tugas ketika dihadapkan dengan tantangan dan berusaha menyesuaikan strateginya ketika upaya sebelumnya tidak berhasil.\r\n', 'Menyusun, menyesuaikan, dan mengujicobakan berbagai strategi dan cara kerjanya untuk membantu dirinya dalam penyelesaian tugas yang menantang\r\n', 'Membuat rencana baru dengan mengadaptasi, dan memodifikasi strategi yang sudah dibuat ketika upaya sebelumnya tidak berhasil, serta menjalankan kembali tugasnya dengan keyakinan baru.\r\n', 'Menyesuaikan dan mulai menjalankan rencana dan strategi pengembangan dirinya dengan mempertimbangkan minat dan tuntutan pada konteks belajar maupun pekerjaan yang akan dijalaninya di masa depan, serta berusaha untuk mengatasi tantangan-tantangan yang ditemui.\r\n\r\n\r\nProfil Pelajar Pancasila\r\nPilih Fase\r\n\r\n\r\nFase E\r\n\r\nDimensi & Elemen\r\nBeriman, Bertakwa Kepada Tuhan Yang Maha Esa, dan Berakhlak Mulia\r\nBerkebinekaan Global\r\nBergotong-Royong\r\nMandiri\r\nElemen\r\n\r\n\r\nPemahaman diri dan situasi yang dihadapi\r\n\r\n\r\nRegulasi Diri\r\n\r\nBernalar Kritis\r\nKreatif\"\r\n'),
(36, 5, 15, 'Mengajukan pertanyaan', 'Mengajukan pertanyaan untuk menjawab keingintahuannya dan untuk mengidentifikasi suatu permasalahan mengenai dirinya dan lingkungan sekitarnya.\r\n', 'Mengajukan pertanyaan untuk mengidentifikasi suatu permasalahan dan mengkonfirmasi pemahaman terhadap suatu permasalahan mengenai dirinya dan lingkungan sekitarnya.\r\n', 'Mengajukan pertanyaan untuk membandingkan berbagai informasi dan untuk menambah pengetahuannya.\r\n', 'Mengajukan pertanyaan untuk klarifikasi dan interpretasi informasi, serta mencari tahu penyebab dan konsekuensi dari informasi tersebut.\r\n', 'Mengajukan pertanyaan untuk menganalisis secara kritis permasalahan yang kompleks dan abstrak.\r\n'),
(37, 5, 15, 'Mengidentifikasi, mengklarifikasi, dan mengolah informasi dan gagasan', 'Mengidentifikasi dan mengolah informasi dan gagasan\r\n', 'Mengumpulkan, mengklasifikasikan, membandingkan dan memilih informasi dan gagasan dari berbagai sumber.\r\n', 'Mengumpulkan, mengklasifikasikan, membandingkan, dan memilih informasi dari berbagai sumber, serta memperjelas informasi dengan bimbingan orang dewasa.\r\n', 'Mengidentifikasi, mengklarifikasi, dan menganalisis informasi yang relevan serta memprioritaskan beberapa gagasan tertentu.\r\n', 'Secara kritis mengklarifikasi serta menganalisis gagasan dan informasi yang kompleks dan abstrak dari berbagai sumber. Memprioritaskan suatu gagasan yang paling relevan dari hasil klarifikasi dan analisis.\r\n'),
(38, 5, 16, 'Menganalisis dan mengevaluasi penalaran dan prosedurnya', 'Melakukan penalaran konkrit dan memberikan alasan dalam menyelesaikan masalah dan mengambil keputusan\r\n', 'Menjelaskan alasan yang relevan dalam penyelesaian masalah dan pengambilan keputusan\r\n', 'Menjelaskan alasan yang relevan dan akurat dalam penyelesaian masalah dan pengambilan keputusan\r\n', 'Membuktikan penalaran dengan berbagai argumen dalam mengambil suatu simpulan atau keputusan.\r\n', 'Menganalisis dan mengevaluasi penalaran yang digunakannya dalam menemukan dan mencari solusi serta mengambil keputusan.\r\n'),
(39, 5, 17, 'Merefleksi dan mengevaluasi pemikirannya sendiri', 'Menyampaikan apa yang sedang dipikirkan secara terperinci\r\n', 'Menyampaikan apa yang sedang dipikirkan dan menjelaskan alasan dari hal yang dipikirkan\r\n', 'Memberikan alasan dari hal yang dipikirkan, serta menyadari kemungkinan adanya bias pada pemikirannya sendiri\r\n\r\nProfil Pelajar Pancasila\r\nPilih Fase\r\n\r\n\r\nFase C\r\n\r\nDimensi & Elemen\"\r\n', 'Menjelaskan asumsi yang digunakan, menyadari kecenderungan dan konsekuensi bias pada pemikirannya, serta berusaha mempertimbangkan perspektif yang berbeda.\r\n', 'Menjelaskan alasan untuk mendukung pemikirannya dan memikirkan pandangan yang mungkin berlawanan dengan pemikirannya dan mengubah pemikirannya jika diperlukan.\r\n'),
(40, 6, 18, 'Menghasilkan gagasan yang orisinal', 'Menggabungkan beberapa gagasan menjadi ide atau gagasan imajinatif yang bermakna untuk mengekspresikan pikiran dan/atau perasaannya.\r\n', 'Memunculkan gagasan imajinatif baru yang bermakna dari beberapa gagasan yang berbeda sebagai ekspresi pikiran dan/atau perasaannya.\r\n', 'Mengembangkan gagasan yang ia miliki untuk membuat kombinasi hal yang baru dan imajinatif untuk mengekspresikan pikiran dan/atau perasaannya.\r\n', 'Menghubungkan gagasan yang ia miliki dengan informasi atau gagasan baru untuk menghasilkan kombinasi gagasan baru dan imajinatif untuk mengekspresikan pikiran dan/atau perasaannya.\r\n', 'Menghasilkan gagasan yang beragam untuk mengekspresikan pikiran dan/atau perasaannya, menilai gagasannya, serta memikirkan segala risikonya dengan mempertimbangkan banyak perspektif seperti etika dan nilai kemanusiaan ketika gagasannya direalisasikan.\r\n'),
(41, 6, 19, 'Menghasilkan karya dan tindakan yang orisinal', 'Mengeksplorasi dan mengekspresikan pikiran dan/atau perasaannya dalam bentuk karya dan/atau tindakan serta mengapresiasi karya dan tindakan yang dihasilkan\r\n', 'Mengeksplorasi dan mengekspresikan pikiran dan/atau perasaannya sesuai dengan minat dan kesukaannya dalam bentuk karya dan/atau tindakan serta mengapresiasi karya dan tindakan yang dihasilkan\r\n', 'Mengeksplorasi dan mengekspresikan pikiran dan/atau perasaannya sesuai dengan minat dan kesukaannya dalam bentuk karya dan/atau tindakan serta mengapresiasi dan mengkritik karya dan tindakan yang dihasilkan\r\n', 'Mengeksplorasi dan mengekspresikan pikiran dan/atau perasaannya dalam bentuk karya dan/atau tindakan, serta mengevaluasinya dan mempertimbangkan dampaknya bagi orang lain\r\n', 'Mengeksplorasi dan mengekspresikan pikiran dan/atau perasaannya dalam bentuk karya dan/atau tindakan, serta mengevaluasinya dan mempertimbangkan dampak dan risikonya bagi diri dan lingkungannya dengan menggunakan berbagai perspektif.\r\n'),
(42, 6, 20, 'Memiliki keluwesan berpikir dalam mencari alternatif solusi permasalahan', 'Mengidentifikasi gagasan-gagasan kreatif untuk menghadapi situasi dan permasalahan.\r\n', 'Membandingkan gagasan-gagasan kreatif untuk menghadapi situasi dan permasalahan.\r\n', 'berupaya mencari solusi alternatif saat pendekatan yang diambil tidak berhasil berdasarkan identifikasi terhadap situasi\r\n', 'Menghasilkan solusi alternatif dengan mengadaptasi berbagai gagasan dan umpan balik untuk menghadapi situasi dan permasalahan\r\n', 'Bereksperimen dengan berbagai pilihan secara kreatif untuk memodifikasi gagasan sesuai dengan perubahan situasi.\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_ujian` int(11) DEFAULT NULL,
  `id_bank` int(11) DEFAULT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `kode_ujian` varchar(30) DEFAULT NULL,
  `ujian_mulai` varchar(20) DEFAULT NULL,
  `ujian_berlangsung` varchar(20) DEFAULT NULL,
  `ujian_selesai` varchar(20) DEFAULT NULL,
  `jml_benar` int(11) DEFAULT NULL,
  `benar_esai` int(11) NOT NULL DEFAULT 0,
  `benar_multi` int(11) NOT NULL DEFAULT 0,
  `benar_bs` int(11) NOT NULL DEFAULT 0,
  `benar_urut` int(11) NOT NULL DEFAULT 0,
  `skor` varchar(255) DEFAULT NULL,
  `skor_esai` varchar(255) DEFAULT NULL,
  `skor_multi` varchar(255) DEFAULT NULL,
  `skor_bs` varchar(255) DEFAULT NULL,
  `skor_urut` varchar(255) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `makskor` int(11) DEFAULT NULL,
  `nilai` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `ipaddress` varchar(20) DEFAULT NULL,
  `hasil` int(11) DEFAULT NULL,
  `jawaban_pg` text DEFAULT NULL,
  `jawaban_esai` longtext DEFAULT NULL,
  `jawaban_multi` text DEFAULT NULL,
  `jawaban_bs` text DEFAULT NULL,
  `jawaban_urut` text DEFAULT NULL,
  `nilai_esai` int(11) DEFAULT NULL,
  `nilai_esai2` text DEFAULT NULL,
  `online` int(11) NOT NULL DEFAULT 0,
  `id_soal` longtext DEFAULT NULL,
  `id_opsi` longtext DEFAULT NULL,
  `id_esai` text DEFAULT NULL,
  `blok` int(11) NOT NULL DEFAULT 0,
  `server` varchar(50) DEFAULT NULL,
  `browser` int(11) DEFAULT 0,
  `jenis_browser` varchar(50) DEFAULT NULL,
  `jumjawab` varchar(11) DEFAULT NULL,
  `jumsoal` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_formatif`
--

CREATE TABLE `nilai_formatif` (
  `id` int(11) NOT NULL,
  `nis` varchar(50) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `mapel` varchar(50) DEFAULT NULL,
  `tinggi` longtext DEFAULT NULL,
  `rendah` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_harian`
--

CREATE TABLE `nilai_harian` (
  `idn` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `idsiswa` varchar(11) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `mapel` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `kd` varchar(14) DEFAULT NULL,
  `ki` varchar(11) DEFAULT NULL,
  `kuri` varchar(12) DEFAULT NULL,
  `guru` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_proses`
--

CREATE TABLE `nilai_proses` (
  `idpros` int(11) NOT NULL,
  `idsiswa` int(11) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `proyek_ke` varchar(50) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `semester` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_proyek`
--

CREATE TABLE `nilai_proyek` (
  `idn` int(11) NOT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `idsiswa` int(11) DEFAULT NULL,
  `idproyek` int(11) DEFAULT NULL,
  `proyek` int(11) DEFAULT NULL,
  `nilai` varchar(5) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_rapor`
--

CREATE TABLE `nilai_rapor` (
  `id` int(11) NOT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `nis` varchar(50) DEFAULT NULL,
  `mapel` varchar(50) DEFAULT NULL,
  `nilai3` int(11) DEFAULT NULL,
  `desmin3` text DEFAULT NULL,
  `desmax3` text DEFAULT NULL,
  `nilai4` int(11) DEFAULT NULL,
  `desmin4` text DEFAULT NULL,
  `desmax4` text DEFAULT NULL,
  `guru` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_sumatif`
--

CREATE TABLE `nilai_sumatif` (
  `id` int(11) NOT NULL,
  `nis` varchar(50) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `mapel` varchar(50) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL,
  `khp` varchar(50) DEFAULT NULL,
  `guru` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan_terkirim`
--

CREATE TABLE `pesan_terkirim` (
  `id` int(11) NOT NULL,
  `idsiswa` varchar(11) DEFAULT NULL,
  `idpeg` varchar(11) DEFAULT NULL,
  `waktu` varchar(50) DEFAULT NULL,
  `ket` varchar(5) DEFAULT NULL,
  `nowa` varchar(14) DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `sender` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `pesan_terkirim`
--

INSERT INTO `pesan_terkirim` (`id`, `idsiswa`, `idpeg`, `waktu`, `ket`, `nowa`, `isi`, `sender`) VALUES
(1, NULL, '3', '2024-08-17 20:04:15', '1', NULL, NULL, NULL),
(2, NULL, '3', '2024-08-17 20:20:26', '1', NULL, NULL, NULL),
(3, NULL, '3', '2024-08-17 20:43:04', '1', NULL, NULL, NULL),
(4, NULL, '3', '2024-08-17 21:26:38', '1', NULL, NULL, NULL),
(5, NULL, '3', '2024-08-18 06:12:09', '1', NULL, NULL, NULL),
(6, NULL, '3', '2024-08-18 08:42:21', '1', NULL, NULL, NULL),
(7, NULL, '3', '2024-08-18 09:36:39', '1', NULL, NULL, NULL),
(8, NULL, '3', '2024-08-18 09:47:46', '1', NULL, NULL, NULL),
(9, NULL, '3', '2024-08-18 09:51:03', '1', NULL, NULL, NULL),
(10, NULL, '3', '2024-08-18 10:07:42', '1', NULL, NULL, NULL),
(11, '2', NULL, '2024-08-18 20:46:19', '1', NULL, NULL, NULL),
(12, '3', NULL, '2024-08-18 21:09:08', '1', NULL, NULL, NULL),
(13, NULL, NULL, '26 Aug 2024 16:05:25', NULL, '0882021733186', 'Halo', '1'),
(14, NULL, NULL, '26 Aug 2024 16:18:52', NULL, '0882021733186', 'Siang\r\n', '1'),
(15, NULL, NULL, '26 Aug 2024 16:19:57', NULL, '0882021733186', 'Selamat Siang\r\n', '1'),
(16, NULL, NULL, '26 Aug 2024 17:48:05', NULL, '0882021733186', 'Selamat pagi msh ada tugas saat ini dan versi iPhone yang lebih ', '1'),
(17, NULL, NULL, '26 Aug 2024 18:41:59', NULL, '0882021733186', 'halo', '1'),
(18, NULL, NULL, '29 Aug 2024 18:23:37', NULL, '0882021733186', 'Selamat Malam', '1'),
(19, NULL, NULL, '29 Aug 2024 18:25:28', NULL, '0882021733186', 'Halo', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peskul`
--

CREATE TABLE `peskul` (
  `idp` int(11) NOT NULL,
  `nis` varchar(50) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `eskul` varchar(50) DEFAULT NULL,
  `guru` varchar(16) DEFAULT NULL,
  `nilai` varchar(50) DEFAULT NULL,
  `ket` text DEFAULT NULL,
  `smt` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `prestasi`
--

CREATE TABLE `prestasi` (
  `id` int(11) NOT NULL,
  `smt` varchar(5) DEFAULT NULL,
  `tp` varchar(50) DEFAULT NULL,
  `idsiswa` int(11) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `kegiatan` text DEFAULT NULL,
  `tanggal` text DEFAULT NULL,
  `penyelenggara` text DEFAULT NULL,
  `juara` text DEFAULT NULL,
  `foto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `proyek`
--

CREATE TABLE `proyek` (
  `idp` int(11) NOT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `p_proyek` int(11) NOT NULL,
  `p_dimensi` int(11) NOT NULL,
  `p_elemen` int(11) NOT NULL,
  `p_sub` int(11) NOT NULL,
  `semester` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `proyek`
--

INSERT INTO `proyek` (`idp`, `kelas`, `p_proyek`, `p_dimensi`, `p_elemen`, `p_sub`, `semester`) VALUES
(1, 'XII-1', 1, 1, 3, 6, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `refleksi`
--

CREATE TABLE `refleksi` (
  `idr` int(11) NOT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jawab1` text DEFAULT NULL,
  `jawab2` text DEFAULT NULL,
  `jawab3` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `refleksi`
--

INSERT INTO `refleksi` (`idr`, `kelas`, `tanggal`, `jawab1`, `jawab2`, `jawab3`) VALUES
(1, 'XII-1', '2024-08-26', 'Menyenangkan', 'tes', 'tes');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reset`
--

CREATE TABLE `reset` (
  `id` int(11) NOT NULL,
  `idsiswa` int(11) DEFAULT NULL,
  `idnilai` int(11) DEFAULT NULL,
  `idujian` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruang`
--

CREATE TABLE `ruang` (
  `kode_ruang` varchar(10) NOT NULL,
  `keterangan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `server`
--

CREATE TABLE `server` (
  `id` int(11) NOT NULL,
  `kode_server` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `server`
--

INSERT INTO `server` (`id`, `kode_server`) VALUES
(1, 'SRV-1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sesi`
--

CREATE TABLE `sesi` (
  `kode_sesi` varchar(10) NOT NULL,
  `nama_sesi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sinkron`
--

CREATE TABLE `sinkron` (
  `id` int(11) NOT NULL,
  `npsn` varchar(50) DEFAULT NULL,
  `waktu` varchar(50) DEFAULT NULL,
  `sts` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `no_peserta` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nis` varchar(50) DEFAULT NULL,
  `nisn` varchar(10) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `jurusan` varchar(50) DEFAULT NULL,
  `fase` varchar(5) DEFAULT NULL,
  `agama` varchar(50) DEFAULT NULL,
  `jk` varchar(50) DEFAULT NULL,
  `server` varchar(50) DEFAULT NULL,
  `sesi` int(11) DEFAULT 1,
  `ruang` varchar(50) DEFAULT NULL,
  `online` int(11) NOT NULL DEFAULT 0,
  `foto` text DEFAULT NULL,
  `nowa` varchar(14) DEFAULT NULL,
  `sts` int(11) NOT NULL DEFAULT 0,
  `idjari` varchar(11) DEFAULT NULL,
  `sakit` int(11) NOT NULL DEFAULT 0,
  `izin` int(11) NOT NULL DEFAULT 0,
  `alpha` int(11) NOT NULL DEFAULT 0,
  `catatan` text DEFAULT NULL,
  `lulus` int(11) NOT NULL DEFAULT 0,
  `prestasi` text DEFAULT NULL,
  `tingkat` text DEFAULT NULL,
  `juara` text DEFAULT NULL,
  `t_lahir` varchar(50) DEFAULT NULL,
  `tgl_lahir` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `desa` varchar(50) DEFAULT NULL,
  `kecamatan` varchar(50) DEFAULT NULL,
  `kabupaten` varchar(50) DEFAULT NULL,
  `ayah` varchar(50) DEFAULT NULL,
  `pek_ayah` varchar(50) DEFAULT NULL,
  `ibu` varchar(50) DEFAULT NULL,
  `pek_ibu` varchar(50) DEFAULT NULL,
  `stskel` varchar(50) DEFAULT NULL,
  `anakke` varchar(11) DEFAULT NULL,
  `asal_sek` varchar(50) DEFAULT NULL,
  `dikelas` varchar(50) DEFAULT NULL,
  `tgl_terima` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `no_peserta`, `username`, `password`, `nis`, `nisn`, `nama`, `level`, `kelas`, `jurusan`, `fase`, `agama`, `jk`, `server`, `sesi`, `ruang`, `online`, `foto`, `nowa`, `sts`, `idjari`, `sakit`, `izin`, `alpha`, `catatan`, `lulus`, `prestasi`, `tingkat`, `juara`, `t_lahir`, `tgl_lahir`, `alamat`, `desa`, `kecamatan`, `kabupaten`, `ayah`, `pek_ayah`, `ibu`, `pek_ibu`, `stskel`, `anakke`, `asal_sek`, `dikelas`, `tgl_terima`) VALUES
(1, '2020-001', '2020-1', '2020-1-GPC', '44236', '0083860058', 'STEVANNY ALZHY AGATHA KARUNDENG', 10, 'X-1', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(2, '2020-002', '2020-2', '2020-2-AHE', '56053', '0082308684', 'REYNALDO KUSEN', 10, 'X-1', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(3, '2020-003', '2020-3', '2020-3-RTA', '30502', '0089980393', 'NURNAYLA ZAENAB KASIM', 10, 'X-1', 'UMUM', 'E', 'Islam', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(4, '2020-004', '2020-4', '2020-4-IVN', '59174', '0089043767', 'SIVILLIA MISHEL MAKALIKIS', 10, 'X-1', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(5, '2020-005', '2020-5', '2020-5-DGQ', '16617', '0081632020', 'AFRA NAILAH ARKANA', 10, 'X-1', 'UMUM', 'E', 'Islam', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(6, '2020-006', '2020-6', '2020-6-HLS', '59428', '0080955764', 'CLARISA IMANUELA RAU', 10, 'X-1', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(7, '2020-007', '2020-7', '2020-7-NCW', '44042', '0085029229', 'FADILLO HULUNGO', 10, 'X-1', 'UMUM', 'E', 'Islam', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(8, '2020-008', '2020-8', '2020-8-VYL', '25076', '0082614255', 'CHEREN CHRISTY SHINE PONTO', 10, 'X-1', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(9, '2020-009', '2020-9', '2020-9-CXT', '40884', '0087559980', 'NOELION AGUERO PALANDENG', 10, 'X-1', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(10, '2020-010', '2020-10', '2020-10-DPB', '37089', '0087687002', 'MUHAMMAD RAFLY KIU', 10, 'X-1', 'UMUM', 'E', 'Islam', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(11, '2020-011', '2020-11', '2020-11-SVE', '98495', '0086958273', 'BRIGITHA PRICILLIA MAMOSEY', 10, 'X-1', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(12, '2020-012', '2020-12', '2020-12-NEK', '34862', '0081988736', 'TALITA REGINACEALI ALEXANDRA MALONDA', 10, 'X-1', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(13, '2020-013', '2020-13', '2020-13-HJI', '52606', '0089120135', 'SYALLOM CHELSIA FELISHIA RUNTU', 10, 'X-1', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(14, '2020-014', '2020-14', '2020-14-ZHK', '20087', '0080153870', 'PEDRO IMER WEWENGKANG', 10, 'X-1', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(15, '2020-015', '2020-15', '2020-15-YRZ', '41973', '0084165789', 'IMANUEL JESAYA JOSHUA WAGEY', 10, 'X-1', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(16, '2020-016', '2020-16', '2020-16-TMW', '21317', '0083161100', 'ZHEFANYA JELIA MARSYA MANGOWAL', 10, 'X-1', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(17, '2020-017', '2020-17', '2020-17-BOI', '28752', '0080711240', 'RIVALDO CRISTIAN RUMANGKANG', 10, 'X-1', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '4', 'SMP NEGERI', 'X', '16 Juli 2022'),
(18, '2020-018', '2020-18', '2020-18-FHW', '48905', '0087900439', 'DEWA PUTU ARIANGGA', 10, 'X-1', 'UMUM', 'E', 'Islam', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(19, '2020-019', '2020-19', '2020-19-BTZ', '53568', '0089249053', 'ZANIAH BEVERLY YADI TENDEAN', 10, 'X-1', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(20, '2020-020', '2020-20', '2020-20-SZD', '98581', '0086765113', 'LISNAWATI HANIPA', 10, 'X-1', 'UMUM', 'E', 'Islam', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(21, '2020-021', '2020-21', '2020-21-JCR', '12314', '0082908855', 'MARVEL BELLINUS PAAT', 10, 'X-1', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(22, '2020-022', '2020-22', '2020-22-OIZ', '26991', '0089054481', 'KIMBERLY ABIIGAIL UMBOH', 10, 'X-1', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(23, '2020-023', '2020-23', '2020-23-HCG', '55775', '0088115906', 'EVRANANDA GALATIA PAKEKONG', 10, 'X-1', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(24, '2020-024', '2020-24', '2020-24-EKB', '27160', '0084873669', 'LIONY THERESA TIHO', 10, 'X-1', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(25, '2020-025', '2020-25', '2020-25-JMC', '12959', '0086949110', 'NAYSILA SOFIE WALANGARE', 10, 'X-1', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(26, '2020-026', '2020-26', '2020-26-HJD', '66046', '0080784686', 'ALFANA ADENSI MAKAPUNAS', 10, 'X-1', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(27, '2020-027', '2020-27', '2020-27-EQM', '38896', '0086809310', 'MIKHAEL BENTLEY SHALOM ANTOW', 10, 'X-1', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(28, '2020-028', '2020-28', '2020-28-QBS', '50487', '0084259506', 'JUNITA EMILIA LUMOINDONG', 10, 'X-1', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(29, '2020-029', '2020-29', '2020-29-MGD', '72738', '0080735340', 'BRILLIANTNA NATHALIA SILAEN', 10, 'X-1', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(30, '2020-030', '2020-30', '2020-30-PXB', '98325', '0080149262', 'JUNIOR XAVERIUS KOROMPIS', 10, 'X-1', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(31, '2020-031', '2020-31', '2020-31-WPY', '44557', '0081306133', 'JONATHAN LIONEL MAMAHIT', 10, 'X-1', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(32, '2020-032', '2020-32', '2020-32-LQO', '53115', '0084468789', 'VANNESA NICOLE BESOUW', 10, 'X-1', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(33, '2020-033', '2020-33', '2020-33-SIJ', '11044', '0080078067', 'ANGELINA CARLA WONGKAR', 10, 'X-2', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(34, '2020-034', '2020-34', '2020-34-WPR', '27576', '0086286555', 'BRILYAN MONTESQUI SIMON ROTINSULU', 10, 'X-2', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(35, '2020-035', '2020-35', '2020-35-YDA', '83223', '0081184392', 'JOYFUL KLAUDIA ANGEL ASSA', 10, 'X-2', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(36, '2020-036', '2020-36', '2020-36-IXW', '43101', '0089808600', 'TRISTANIA KIREI TIMBULENG', 10, 'X-2', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(37, '2020-037', '2020-37', '2020-37-KRU', '48697', '0080992207', 'CHEALSEA KEISYA TUMELAP', 10, 'X-2', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '4', 'SMP NEGERI', 'X', '16 Juli 2022'),
(38, '2020-038', '2020-38', '2020-38-DGE', '90410', '0084524887', 'CLAUDIA GABRIELLA ENGGELA SOMPOTAN', 10, 'X-2', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(39, '2020-039', '2020-39', '2020-39-MHI', '50338', '0082804056', 'JELIANA NOVENIA MARENTEK', 10, 'X-2', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(40, '2020-040', '2020-40', '2020-40-QDK', '92149', '0084215921', 'PRAISEVIN D\'WAYNE LORDI PAAT', 10, 'X-2', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(41, '2020-041', '2020-41', '2020-41-CZB', '29173', '0086564367', 'SAMUEL BELTSAZAR WARANEY KILIS', 10, 'X-2', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(42, '2020-042', '2020-42', '2020-42-TMH', '15968', '0088575288', 'GRIFITIA AVE MARIA SONDAKH', 10, 'X-2', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(43, '2020-043', '2020-43', '2020-43-CVD', '75822', '0084389203', 'WENDA SHIFANA MANGUNDAP', 10, 'X-2', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(44, '2020-044', '2020-44', '2020-44-SFP', '81150', '0083113248', 'APRIANSYAH IBANEZ NEZA HERMAWAN', 10, 'X-2', 'UMUM', 'E', 'Islam', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(45, '2020-045', '2020-45', '2020-45-XNK', '24743', '0087874250', 'AURELIA MONICA SARESE', 10, 'X-2', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(46, '2020-046', '2020-46', '2020-46-OTX', '68317', '0087899046', 'YEREMIA DANIEL WICAKSANA PALIT', 10, 'X-2', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(47, '2020-047', '2020-47', '2020-47-IOD', '71863', '0088036837', 'YEHEZKIEL FAITH TANOS', 10, 'X-2', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(48, '2020-048', '2020-48', '2020-48-QAZ', '54447', '0084010839', 'DEWITA PRICILIA TESALONIKA UMBOLA', 10, 'X-2', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(49, '2020-049', '2020-49', '2020-49-QBM', '41535', '0086632385', 'KEYRA BRIGITTA LEILEY', 10, 'X-2', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(50, '2020-050', '2020-50', '2020-50-CIT', '68286', '0089513443', 'AZMI AZALIA SURATINOJO', 10, 'X-2', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(51, '2020-051', '2020-51', '2020-51-AMS', '33152', '0088868881', 'VALEN RAFAEL NAZARIO RAPAR', 10, 'X-2', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(52, '2020-052', '2020-52', '2020-52-JMV', '88158', '0081040904', 'JULIO PEHVAHNO PANDEY', 10, 'X-2', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(53, '2020-053', '2020-53', '2020-53-UNF', '93947', '0086577550', 'LOVELY TULONG', 10, 'X-2', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(54, '2020-054', '2020-54', '2020-54-GDU', '80618', '0088207325', 'JESSICA GRACIA MAILENSUN', 10, 'X-2', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(55, '2020-055', '2020-55', '2020-55-RIP', '74217', '0086169830', 'MARIA ANGEL MAHARANI SINAMBELA', 10, 'X-2', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(56, '2020-056', '2020-56', '2020-56-QIT', '27746', '0083893305', 'KARUNIA RIFILITA KAAWOAN', 10, 'X-2', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(57, '2020-057', '2020-57', '2020-57-NPX', '77664', '0082799065', 'JEVIKA SWITLI PANGALILA', 10, 'X-2', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '4', 'SMP NEGERI', 'X', '16 Juli 2022'),
(58, '2020-058', '2020-58', '2020-58-CGV', '42519', '0080439922', 'JEHONICCI JIREH MARGIE WILAR', 10, 'X-2', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(59, '2020-059', '2020-59', '2020-59-UBZ', '62030', '0080986713', 'PATRICIA EQUEENA JILLY PUSUNG', 10, 'X-2', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(60, '2020-060', '2020-60', '2020-60-DUW', '38942', '0084596011', 'MELATY LETICYA PARENGKUAN', 10, 'X-2', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(61, '2020-061', '2020-61', '2020-61-VKI', '78292', '0080990100', 'MIGUEL VICTORY KUSEN', 10, 'X-2', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(62, '2020-062', '2020-62', '2020-62-LZT', '58485', '0080809774', 'FABIAN CHLITZCHO LOMBOAN', 10, 'X-2', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(63, '2020-063', '2020-63', '2020-63-TEY', '74449', '0084864074', 'ZEFANYA XIOUXUEN KIRSTIN SALMON', 10, 'X-2', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(64, '2020-064', '2020-64', '2020-64-VRQ', '57701', '0080055519', 'TRICIA ELVIRA DEVITANIA KAWENGIAN', 10, 'X-2', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(65, '2020-065', '2020-65', '2020-65-TSV', '93366', '0088543630', 'AGNESIA PUTRI SHMILY ROMPAS', 10, 'X-3', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(66, '2020-066', '2020-66', '2020-66-ZFQ', '50627', '0089413451', 'MICHAEL NICK PALANDENG', 10, 'X-3', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(67, '2020-067', '2020-67', '2020-67-WQB', '92142', '0085944454', 'STEFANY AURELIA FRISTIKA KAUNANG', 10, 'X-3', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(68, '2020-068', '2020-68', '2020-68-THD', '78563', '0081382152', 'JESON GOLDEN BIBLE KORENGKENG', 10, 'X-3', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(69, '2020-069', '2020-69', '2020-69-QGO', '94350', '0087344934', 'JULIO YERIKHO MAMAHIT', 10, 'X-3', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(70, '2020-070', '2020-70', '2020-70-FEN', '68205', '0083879489', 'PATRICIO ALEXANDRO BOJOH', 10, 'X-3', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(71, '2020-071', '2020-71', '2020-71-IQL', '55220', '0081640411', 'AURELYA GRATIA KALENSUN', 10, 'X-3', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(72, '2020-072', '2020-72', '2020-72-HZU', '96400', '0084045104', 'ALVIERO TOMBINAWA', 10, 'X-3', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(73, '2020-073', '2020-73', '2020-73-SIV', '50385', '0085893542', 'KEYZIA SHERREN MONICA WONDAL', 10, 'X-3', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(74, '2020-074', '2020-74', '2020-74-XKY', '37191', '0082665380', 'JONERUS SEMUEL KUMAPASAL', 10, 'X-3', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(75, '2020-075', '2020-75', '2020-75-KTV', '84744', '0080786223', 'ANDRA IMMANUEL KALIGIS', 10, 'X-3', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(76, '2020-076', '2020-76', '2020-76-HKT', '98227', '0085749625', 'GEVINA PRINCESS MAWERU', 10, 'X-3', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(77, '2020-077', '2020-77', '2020-77-WCR', '85912', '0080970789', 'GRACE DEBORA LANGI', 10, 'X-3', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '4', 'SMP NEGERI', 'X', '16 Juli 2022'),
(78, '2020-078', '2020-78', '2020-78-VUW', '87900', '0089206402', 'IRENE ZEVANYA LOTULUNG', 10, 'X-3', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(79, '2020-079', '2020-79', '2020-79-CDK', '11126', '0083849212', 'LOVINA CLERIEN BOLAH', 10, 'X-3', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(80, '2020-080', '2020-80', '2020-80-TJN', '31427', '0086084158', 'GRACIA VALENCIA ALEXANRINA SUMENDAP', 10, 'X-3', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(81, '2020-081', '2020-81', '2020-81-NBA', '78544', '0083038828', 'PRITHY ZEFANYA NIKITA PONTO', 10, 'X-3', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(82, '2020-082', '2020-82', '2020-82-JRQ', '64343', '0086600620', 'YOHANA MEYRABELLA MAGDALENA LANGITAN', 10, 'X-3', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(83, '2020-083', '2020-83', '2020-83-RNP', '71888', '0087247276', 'CHIARA MEGUMI ADELIA LONTAAN', 10, 'X-3', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(84, '2020-084', '2020-84', '2020-84-VLB', '29217', '0085739684', 'RAVAEL ANDREAS GERRARD SUMUWENG', 10, 'X-3', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(85, '2020-085', '2020-85', '2020-85-IVH', '33812', '0083487978', 'BRIGHTON JEREMY MANDAGI', 10, 'X-3', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(86, '2020-086', '2020-86', '2020-86-XJW', '59722', '0087670185', 'JUAN HELMUS SIKOME', 10, 'X-3', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(87, '2020-087', '2020-87', '2020-87-QYF', '64411', '0080907617', 'RICHARD YOHAN FRANS LASUT', 10, 'X-3', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(88, '2020-088', '2020-88', '2020-88-DBY', '66636', '0085144541', 'FRISKA FEIBRIA PAAT', 10, 'X-3', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(89, '2020-089', '2020-89', '2020-89-GTS', '87468', '0086454378', 'FIRELIO GABRIEL WAHANI', 10, 'X-3', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(90, '2020-090', '2020-90', '2020-90-BCD', '92591', '0081832988', 'GRACIA KANDOUW', 10, 'X-3', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(91, '2020-091', '2020-91', '2020-91-FIQ', '45411', '0086786962', 'JUAN RAVAEL TIMOTHY KALALO', 10, 'X-3', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(92, '2020-092', '2020-92', '2020-92-ERM', '47176', '0084903827', 'AURELIA ESTHERLITA TEOFANI KOJOH', 10, 'X-3', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(93, '2020-093', '2020-93', '2020-93-TYN', '34190', '0089167974', 'RYUCANDELL BLESSIANO SURYA', 10, 'X-3', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(94, '2020-094', '2020-94', '2020-94-ACI', '27420', '0083122345', 'EUGENIA NATALI PARUNTU', 10, 'X-3', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(95, '2020-095', '2020-95', '2020-95-JRS', '16645', '0088632057', 'THALITA EMMANUELA TUTU', 10, 'X-3', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(96, '2020-096', '2020-96', '2020-96-OPD', '54686', '0085633679', 'PRAYSI ECCLESIA KOROMPIS', 10, 'X-3', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(97, '2020-097', '2020-97', '2020-97-NCM', '28093', '0083590958', 'BRITNEY JESSICA SRITENAYA BORORING', 10, 'X-4', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(98, '2020-098', '2020-98', '2020-98-YHN', '21591', '0083063595', 'PRINCESS RATULANGI', 10, 'X-4', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(99, '2020-099', '2020-99', '2020-99-CJM', '44701', '0084281586', 'WITTY SERAFIM MOKOROWU', 10, 'X-4', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(100, '2020-100', '2020-100', '2020-100-DAH', '18832', '0083912041', 'VRISKY IMANUEL SUMUWENG', 10, 'X-4', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(101, '2020-101', '2020-101', '2020-101-PUA', '53606', '0081078687', 'ADRIANO YOHANES POLII', 10, 'X-4', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(102, '2020-102', '2020-102', '2020-102-OHU', '35160', '0083315979', 'GIVENLY CHRIST DELON LARESO', 10, 'X-4', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(103, '2020-103', '2020-103', '2020-103-SIV', '13454', '0082570929', 'BRIGEL TULUS', 10, 'X-4', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(104, '2020-104', '2020-104', '2020-104-XKG', '22353', '0081383244', 'RIVO NATHANAEL KASINGKU LUMAIN', 10, 'X-4', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(105, '2020-105', '2020-105', '2020-105-LVS', '17097', '0085251618', 'LIAN NADIA QUEEN PANDEY', 10, 'X-4', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(106, '2020-106', '2020-106', '2020-106-TWX', '51384', '0081613445', 'JACIKA ELCY RAINTUNG', 10, 'X-4', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(107, '2020-107', '2020-107', '2020-107-BNE', '27504', '0089028221', 'NEVANYA PUTERI PEEA SUMAMPOUW', 10, 'X-4', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(108, '2020-108', '2020-108', '2020-108-XJL', '96941', '0081381306', 'AFSELLA AFIQA CHARITY MONGDONG', 10, 'X-4', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(109, '2020-109', '2020-109', '2020-109-TLD', '96929', '0081374413', 'APRILIA TIENEKE LISYE KALANGI', 10, 'X-4', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(110, '2020-110', '2020-110', '2020-110-DLU', '49096', '0082619527', 'SYALOMITHA PUTRI CONCHETA TANGBAYONG', 10, 'X-4', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(111, '2020-111', '2020-111', '2020-111-UFZ', '18703', '0083533273', 'WILLY ANDREAS SWIDIO DANA', 10, 'X-4', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(112, '2020-112', '2020-112', '2020-112-NLK', '84601', '0088465353', 'FILIA JESIKA PELEALU', 10, 'X-4', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(113, '2020-113', '2020-113', '2020-113-DBI', '24692', '0087460234', 'FAHWA RIZKY MANGGALA PUTRA', 10, 'X-4', 'UMUM', 'E', 'Islam', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(114, '2020-114', '2020-114', '2020-114-RFP', '94271', '0084994061', 'JEHEZKIEL JULIO SAROINSONG', 10, 'X-4', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(115, '2020-115', '2020-115', '2020-115-TIH', '72759', '0087445286', 'ANJELINA WAROW', 10, 'X-4', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(116, '2020-116', '2020-116', '2020-116-PJD', '39600', '0087513511', 'YUNIKA VIANI LUMOLOS', 10, 'X-4', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(117, '2020-117', '2020-117', '2020-117-VFP', '42460', '0084573433', 'METANOIA JONTHAN ALLINSKE PESIK', 10, 'X-4', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(118, '2020-118', '2020-118', '2020-118-QBM', '37619', '0086726073', 'ANGIEWHITE. D. KUSOY', 10, 'X-4', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(119, '2020-119', '2020-119', '2020-119-FVN', '88877', '0089921064', 'OKTAVIA TAMBAHANI', 10, 'X-4', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(120, '2020-120', '2020-120', '2020-120-WDQ', '97575', '0084474105', 'CHRISTJOY ECLAT MANDAGI', 10, 'X-4', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(121, '2020-121', '2020-121', '2020-121-QKP', '79451', '0084591463', 'DEBORA CHARINA SENDOW', 10, 'X-4', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(122, '2020-122', '2020-122', '2020-122-DUC', '99865', '0087393446', 'VANUELL KLOUS WAWOLANGI', 10, 'X-4', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(123, '2020-123', '2020-123', '2020-123-CIU', '90161', '0089509101', 'ERLANGGA MANCHESTER TATILU', 10, 'X-4', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(124, '2020-124', '2020-124', '2020-124-BNJ', '37903', '0087716724', 'MAYSHA FYCHITA WOWOR', 10, 'X-4', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(125, '2020-125', '2020-125', '2020-125-DIW', '17542', '0080190911', 'RAKA AZRIEL FAUZI LOLONG', 10, 'X-4', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(126, '2020-126', '2020-126', '2020-126-PWY', '14561', '0084990261', 'MISCHA CHRISTIANI IGREYA REPI', 10, 'X-4', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(127, '2020-127', '2020-127', '2020-127-UMY', '41577', '0089713320', 'GLEI SAMUEL BOYOH', 10, 'X-4', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(128, '2020-128', '2020-128', '2020-128-YUN', '45195', '0086267041', 'SION ANUGRAH RUMONDOR', 10, 'X-4', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(129, '2020-129', '2020-129', '2020-129-SNX', '44898', '0080057536', 'CHELSEA MAYSILA RAMBING', 10, 'X-5', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(130, '2020-130', '2020-130', '2020-130-SJH', '86843', '0089863191', 'GERALDY GIVENLEE GILBERT GERUNGAN', 10, 'X-5', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(131, '2020-131', '2020-131', '2020-131-ZHY', '47025', '0086270887', 'SYALOMITA SIVIA TANGKERE', 10, 'X-5', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(132, '2020-132', '2020-132', '2020-132-KCL', '78046', '0083782887', 'ALLISYA CINDERELLA TANOS', 10, 'X-5', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(133, '2020-133', '2020-133', '2020-133-MJN', '50939', '0082315699', 'ZEVANYA DEVI MELODYA TUMUJU', 10, 'X-5', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(134, '2020-134', '2020-134', '2020-134-OYV', '58277', '0085669969', 'AUREEL ANASTASYA RUNTU', 10, 'X-5', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(135, '2020-135', '2020-135', '2020-135-XAV', '33172', '0087473014', 'PUTRI GRACIA QWINZY MUMPEL', 10, 'X-5', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(136, '2020-136', '2020-136', '2020-136-YOE', '40523', '0087330998', 'SYALOMITHA PUTRI SIKOME BARE', 10, 'X-5', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(137, '2020-137', '2020-137', '2020-137-QLD', '49573', '0089237804', 'ELOVITA LETHICYA POMANTOW', 10, 'X-5', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(138, '2020-138', '2020-138', '2020-138-EGM', '17097', '0085785028', 'MUHAMMAD AL HAFIIZH UMSOHI', 10, 'X-5', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(139, '2020-139', '2020-139', '2020-139-XNP', '97716', '0088529426', 'ABIGEL JIBRAEL SUMENGE', 10, 'X-5', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(140, '2020-140', '2020-140', '2020-140-DZJ', '91544', '0083436401', 'MIRACLE DEWA MESSI WALANGITAN', 10, 'X-5', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(141, '2020-141', '2020-141', '2020-141-LTF', '37864', '0082736640', 'JAVIER ALEXANDER SOPUTAN', 10, 'X-5', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(142, '2020-142', '2020-142', '2020-142-MIK', '53083', '0080131691', 'CLEITHA AMALIA VICTORIA KALIGIS', 10, 'X-5', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(143, '2020-143', '2020-143', '2020-143-OXS', '91776', '0088344283', 'MEZHIKO SONDAKH', 10, 'X-5', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(144, '2020-144', '2020-144', '2020-144-OQP', '76191', '0086031029', 'TALITHA MILITIA LOLOWANG', 10, 'X-5', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(145, '2020-145', '2020-145', '2020-145-QKB', '96231', '0083866160', 'GWYNETH NATALIA POLUAN', 10, 'X-5', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(146, '2020-146', '2020-146', '2020-146-DFQ', '39626', '0080521215', 'GRACIA GRACE MENDE', 10, 'X-5', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(147, '2020-147', '2020-147', '2020-147-QCY', '54501', '0084572817', 'LEONARDO ALVINO RAMBITAN', 10, 'X-5', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(148, '2020-148', '2020-148', '2020-148-PRX', '55915', '0086550240', 'ELISSA ELIANA LINGKAN WATUSEKE', 10, 'X-5', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(149, '2020-149', '2020-149', '2020-149-JPC', '83265', '0085400828', 'GIORGI PELEALU', 10, 'X-5', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(150, '2020-150', '2020-150', '2020-150-YTW', '64922', '0088035658', 'SYALLOMITHA NATASYHA YULLIANTHY WATULINGAS', 10, 'X-5', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022');
INSERT INTO `siswa` (`id_siswa`, `no_peserta`, `username`, `password`, `nis`, `nisn`, `nama`, `level`, `kelas`, `jurusan`, `fase`, `agama`, `jk`, `server`, `sesi`, `ruang`, `online`, `foto`, `nowa`, `sts`, `idjari`, `sakit`, `izin`, `alpha`, `catatan`, `lulus`, `prestasi`, `tingkat`, `juara`, `t_lahir`, `tgl_lahir`, `alamat`, `desa`, `kecamatan`, `kabupaten`, `ayah`, `pek_ayah`, `ibu`, `pek_ibu`, `stskel`, `anakke`, `asal_sek`, `dikelas`, `tgl_terima`) VALUES
(151, '2020-151', '2020-151', '2020-151-SOX', '79439', '0086335948', 'RIGENLI MONTOLALU', 10, 'X-5', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(152, '2020-152', '2020-152', '2020-152-XOU', '83146', '0085482572', 'ANNISA MAWARDAH LAUMA', 10, 'X-5', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(153, '2020-153', '2020-153', '2020-153-IBG', '31991', '0080885179', 'KEYLA MICHIKO WALALANGI', 10, 'X-5', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(154, '2020-154', '2020-154', '2020-154-CPT', '33008', '0089869276', 'MATHEW MAESA TUMO SALAINTI', 10, 'X-5', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(155, '2020-155', '2020-155', '2020-155-OTU', '54258', '0086695185', 'AURELIA ABIGAIL MAKAPINDAR', 10, 'X-5', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(156, '2020-156', '2020-156', '2020-156-KUN', '80695', '0086763990', 'KEZIA SARAH OCEAN TANOR', 10, 'X-5', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(157, '2020-157', '2020-157', '2020-157-LQX', '71554', '0085103366', 'ANGELIA MICHELLE ESTHER LITOW', 10, 'X-5', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(158, '2020-158', '2020-158', '2020-158-OBM', '70543', '0087811952', 'KEZIA TESALONIKA SENGKEY', 10, 'X-5', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(159, '2020-159', '2020-159', '2020-159-LNS', '12521', '0083524312', 'BRIGHTLY LIONEL PALIT', 10, 'X-5', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(160, '2020-160', '2020-160', '2020-160-NQG', '66892', '0081043973', 'WILLY EXCELCIUS RUMENGAN', 10, 'X-5', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(161, '2020-161', '2020-161', '2020-161-ZCX', '75072', '0081176816', 'RENATA IMORTAL TULANGOW', 10, 'X-6', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(162, '2020-162', '2020-162', '2020-162-EOV', '11152', '0089193276', 'HAPPY CHRISTMAS MARRYLEA OROH', 10, 'X-6', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(163, '2020-163', '2020-163', '2020-163-XKY', '44910', '0081886340', 'STEVANNO GERRIT KAMASI', 10, 'X-6', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(164, '2020-164', '2020-164', '2020-164-UMR', '60650', '0089816121', 'TIFFANY CLEOPATRA LAHA', 10, 'X-6', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(165, '2020-165', '2020-165', '2020-165-PVA', '52640', '0084087933', 'ETHAN WIRA ADRIYAN DIEN', 10, 'X-6', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(166, '2020-166', '2020-166', '2020-166-MKJ', '66463', '0086104253', 'JOCELYN GISELLA RARUNG', 10, 'X-6', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(167, '2020-167', '2020-167', '2020-167-XUA', '28546', '0082614533', 'YOVITA EKLESIA MOKALU', 10, 'X-6', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(168, '2020-168', '2020-168', '2020-168-UGC', '67461', '0089621330', 'ABIGAEL HILLARY VELOVE MUNTUAN', 10, 'X-6', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(169, '2020-169', '2020-169', '2020-169-KTL', '48841', '0080572052', 'RASYA KANIA PUTRI SUMARANDAK', 10, 'X-6', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(170, '2020-170', '2020-170', '2020-170-FPO', '49828', '0083238295', 'ADVENLY ARIEF JULIO KELES', 10, 'X-6', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(171, '2020-171', '2020-171', '2020-171-QFH', '35232', '0081162167', 'STUARDT MANTIRI', 10, 'X-6', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(172, '2020-172', '2020-172', '2020-172-UKQ', '75199', '0082349427', 'PATRICIA DIOSEGNETTE ANGELRILY RUAW', 10, 'X-6', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(173, '2020-173', '2020-173', '2020-173-LAV', '12185', '0089997636', 'CHRISTIANI JESSICA MEDELU', 10, 'X-6', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(174, '2020-174', '2020-174', '2020-174-IEF', '97171', '0087761787', 'TIMOTHY LIONEL SAKTI SINGGIMA', 10, 'X-6', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(175, '2020-175', '2020-175', '2020-175-EWX', '31297', '0083480322', 'MICHAYLA CHRISTIN ADAM', 10, 'X-6', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(176, '2020-176', '2020-176', '2020-176-ZSJ', '38306', '0087466534', 'IMANOEL DEVIS LUTHER WALANGITAN', 10, 'X-6', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(177, '2020-177', '2020-177', '2020-177-MCY', '66076', '0088014752', 'CAROLUS HENDRIKUS JOSEPH', 10, 'X-6', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(178, '2020-178', '2020-178', '2020-178-FAO', '18439', '0081558235', 'MAJESTY PUTRI IMANUEL WOLAYAN', 10, 'X-6', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(179, '2020-179', '2020-179', '2020-179-PSV', '75462', '0082954368', 'CRISTOFEL EDENNEW LUMAIN', 10, 'X-6', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(180, '2020-180', '2020-180', '2020-180-AKB', '71837', '0083366480', 'CHARISSA AURELIA SUPIT', 10, 'X-6', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(181, '2020-181', '2020-181', '2020-181-GAK', '78973', '0080250764', 'KAREN STEFANIA ANGELIA TUMIMOMOR', 10, 'X-6', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(182, '2020-182', '2020-182', '2020-182-JIP', '12464', '0080076234', 'AURELIA HELENA KAINAMA', 10, 'X-6', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(183, '2020-183', '2020-183', '2020-183-WFP', '46508', '0083458934', 'MAJESTY PRINCHES KOWAAS', 10, 'X-6', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(184, '2020-184', '2020-184', '2020-184-AKZ', '51112', '0083049327', 'SASKIA CARITY PALILINGAN', 10, 'X-6', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(185, '2020-185', '2020-185', '2020-185-IHN', '76407', '0085680717', 'KIMI ALFRED MALACHI WALANGITAN', 10, 'X-6', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(186, '2020-186', '2020-186', '2020-186-QXE', '36413', '0088760982', 'MIRABLE IVHENA SYARBIE MAENGKOM', 10, 'X-6', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(187, '2020-187', '2020-187', '2020-187-FED', '84551', '0083470272', 'PUTRI MAHARANI', 10, 'X-6', 'UMUM', 'E', 'Islam', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(188, '2020-188', '2020-188', '2020-188-MAO', '59930', '0088605344', 'ESTEFANI GRATYA VILISYA PALIT', 10, 'X-6', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(189, '2020-189', '2020-189', '2020-189-NUG', '95265', '0089044128', 'GLORY PRINCES TRISYA ROYANA MOKODOMPIT', 10, 'X-6', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(190, '2020-190', '2020-190', '2020-190-DMA', '87980', '0084072311', 'CASEY HENDRIK MONTOLALU', 10, 'X-6', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(191, '2020-191', '2020-191', '2020-191-LGH', '95540', '0082138294', 'JUWITA JANET ISABEL ROMPAS', 10, 'X-6', 'UMUM', 'E', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(192, '2020-192', '2020-192', '2020-192-VKO', '31044', '0080988709', 'MARVEL APRILANDO NGALA', 10, 'X-6', 'UMUM', 'E', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(193, '2020-193', '2020-193', '2020-193-EIV', '77411', '0086226202', 'AMELIA LINU', 11, 'XI-1', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(194, '2020-194', '2020-194', '2020-194-JIV', '85751', '0085908803', 'ANATASYA SILANGEN', 11, 'XI-1', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(195, '2020-195', '2020-195', '2020-195-YGF', '89307', '0086564867', 'ARVANDO CHRISTOFEL TULUNG', 11, 'XI-1', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(196, '2020-196', '2020-196', '2020-196-HRJ', '87621', '0085239824', 'AZALIA LANTANG', 11, 'XI-1', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(197, '2020-197', '2020-197', '2020-197-OJD', '46439', '0085705391', 'BRENDEN MONINGKEY', 11, 'XI-1', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(198, '2020-198', '2020-198', '2020-198-WZF', '48512', '0082946384', 'CHINTYA MYLOVE PUTRY GIMON', 11, 'XI-1', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(199, '2020-199', '2020-199', '2020-199-FBA', '77131', '0084763779', 'CHRYNA EUGENIA ALINDRI NGANTUNG', 11, 'XI-1', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(200, '2020-200', '2020-200', '2020-200-VHM', '14749', '0078608463', 'CLAUDIA S. RUMATE', 11, 'XI-1', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(201, '2020-201', '2020-201', '2020-201-SHP', '42649', '0085369468', 'DJIARAHMAN FARREL BUDIATMA RIFAI', 11, 'XI-1', 'UMUM', 'F', 'Islam', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(202, '2020-202', '2020-202', '2020-202-DVP', '75979', '0087958462', 'FATIMAH AZAHRA PADJA', 11, 'XI-1', 'UMUM', 'F', 'Islam', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(203, '2020-203', '2020-203', '2020-203-SMF', '58817', '0085786083', 'FILICIA GLORYA KORAAG', 11, 'XI-1', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(204, '2020-204', '2020-204', '2020-204-GJC', '72032', '0085694387', 'FLORENCHYA MCKEYLA GULE', 11, 'XI-1', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(205, '2020-205', '2020-205', '2020-205-FCB', '44885', '0079460237', 'FRAYSIFEA JISSY UMBOKAHU', 11, 'XI-1', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(206, '2020-206', '2020-206', '2020-206-UNS', '30023', '0085398488', 'FRILVAN IMANUEL RANTUNG	', 11, 'XI-1', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(207, '2020-207', '2020-207', '2020-207-KUL', '43837', '0095843810', 'GRAYLEE ALFABRYAN TUMELAP', 11, 'XI-1', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(208, '2020-208', '2020-208', '2020-208-LCT', '17244', '0082563147', 'JONATAN MICHAEL DEENG', 11, 'XI-1', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(209, '2020-209', '2020-209', '2020-209-XCP', '98616', '0088462718', 'JULIAN EZRA MOLEONG', 11, 'XI-1', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(210, '2020-210', '2020-210', '2020-210-KAH', '67093', '3580096847', 'KEIZIA MICHELLE RUNTURAMBI', 11, 'XI-1', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(211, '2020-211', '2020-211', '2020-211-HTZ', '14935', '0085236984', 'Marvel Kinglee Kenzhie Lintang', 11, 'XI-1', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(212, '2020-212', '2020-212', '2020-212-ZOS', '51131', '0083332090', 'MARVEL SUMARAUW', 11, 'XI-1', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(213, '2020-213', '2020-213', '2020-213-ZBL', '77298', '0084972551', 'MEILANY CLAUDIA LAOTJI', 11, 'XI-1', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(214, '2020-214', '2020-214', '2020-214-DMT', '56895', '0082960894', 'NATHANIA MIKHA MONINGKA', 11, 'XI-1', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(215, '2020-215', '2020-215', '2020-215-DXJ', '37655', '0089517077', 'RACHEL VIRGINIA TATILU', 11, 'XI-1', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(216, '2020-216', '2020-216', '2020-216-DJR', '26761', '0086648319', 'RAHEL MARSELA MANUS', 11, 'XI-1', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(217, '2020-217', '2020-217', '2020-217-QJW', '48035', '0088548897', 'RAIHAN PUTRA PRATAMA', 11, 'XI-1', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(218, '2020-218', '2020-218', '2020-218-UOG', '98367', '0052684859', 'SOLAGRATIA SUAWA', 11, 'XI-1', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(219, '2020-219', '2020-219', '2020-219-TKW', '56253', '8056493484', 'STIVANI SIVIAH BRIGITA TATILU', 11, 'XI-1', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(220, '2020-220', '2020-220', '2020-220-ZDM', '51737', '0084609424', 'VERANDO TIMOTI MEATIU WENBEN', 11, 'XI-1', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(221, '2020-221', '2020-221', '2020-221-LNM', '33691', '0085569647', 'VICTORIOUS JOY MAGNIFICENT MARINGKA	', 11, 'XI-1', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(222, '2020-222', '2020-222', '2020-222-PMK', '19405', '0080099361', 'VILENTINO MARSELINUS HONGA', 11, 'XI-1', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(223, '2020-223', '2020-223', '2020-223-EIA', '70174', '0048523946', 'VIRGINIA LEONI GLORI KUMENAP', 11, 'XI-1', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(224, '2020-224', '2020-224', '2020-224-DCN', '55468', '0026985489', 'WILLIAM L. DJAGAWOLI', 11, 'XI-1', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(225, '2020-225', '2020-225', '2020-225-OXY', '66875', '0069428379', 'AHMAT REFLAH MAKALUNSENGE', 11, 'XI-2', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(226, '2020-226', '2020-226', '2020-226-HND', '15880', '3589070074', 'AGNESYA VINOLIANDRA SARIT', 11, 'XI-2', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(227, '2020-227', '2020-227', '2020-227-OZB', '96132', '0078965785', 'AILEN REMBULAN MONINGKEY', 11, 'XI-2', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(228, '2020-228', '2020-228', '2020-228-YIW', '26745', '0082369584', 'AZIEL PELEALU', 11, 'XI-2', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(229, '2020-229', '2020-229', '2020-229-HIU', '23130', '0088364649', 'CAROLIN PANGEMANAN', 11, 'XI-2', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(230, '2020-230', '2020-230', '2020-230-TVR', '80026', '0098236847', 'CHEREN TITA PAKASI', 11, 'XI-2', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(231, '2020-231', '2020-231', '2020-231-WHJ', '26964', '0082364985', 'CHRISTELINA NATALIE RUMENGAN', 11, 'XI-2', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(232, '2020-232', '2020-232', '2020-232-SLN', '62873', '0095642014', 'CINDY KOROH', 11, 'XI-2', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(233, '2020-233', '2020-233', '2020-233-ZQF', '88779', '0080936536', 'EUGENIA AUBREY E. RUNTURAMBY', 11, 'XI-2', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(234, '2020-234', '2020-234', '2020-234-CMW', '58365', '0086557889', 'FILADELFIA PINANGKAAN', 11, 'XI-2', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(235, '2020-235', '2020-235', '2020-235-NVL', '60011', '0085366943', 'FRANDY TAMBARIKI', 11, 'XI-2', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(236, '2020-236', '2020-236', '2020-236-VHI', '73167', '0085360532', 'GAVRA PREISLY CLEARESTA KOJONGIAN', 11, 'XI-2', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(237, '2020-237', '2020-237', '2020-237-GTQ', '80993', '0089784597', 'GRACE MESYA LOUIS WANGKAR', 11, 'XI-2', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(238, '2020-238', '2020-238', '2020-238-GLC', '89220', '0083109360', 'GREYCIA TERESIA STACY ITEM', 11, 'XI-2', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(239, '2020-239', '2020-239', '2020-239-FDX', '99361', '2085964873', 'GRIVERNO GABRIEL GAMALIEL WALALANGI', 11, 'XI-2', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(240, '2020-240', '2020-240', '2020-240-OQA', '63991', '0082964837', 'HIZKIA OLIVER HENRY WANGKO', 11, 'XI-2', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(241, '2020-241', '2020-241', '2020-241-IFE', '35140', '0096328498', 'JONATHAN ANTOW', 11, 'XI-2', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(242, '2020-242', '2020-242', '2020-242-RUK', '83757', '0082369781', 'KENNYJIO MANAWAN', 11, 'XI-2', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(243, '2020-243', '2020-243', '2020-243-DGZ', '72128', '0085940864', 'KEYLA RANTUNG', 11, 'XI-2', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(244, '2020-244', '2020-244', '2020-244-ABH', '58847', '0085239468', 'MAGFHIRA JIHAN RAMADHANI SUGEHA', 11, 'XI-2', 'UMUM', 'F', 'Islam', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(245, '2020-245', '2020-245', '2020-245-OXJ', '87148', '0085370938', 'MAKARAWUNG KENZO GOGANI', 11, 'XI-2', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(246, '2020-246', '2020-246', '2020-246-WOR', '28342', '0095131770', 'MARCELINO TAKAYOSI PAKASI', 11, 'XI-2', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(247, '2020-247', '2020-247', '2020-247-LSD', '90612', '0082394672', 'MOSES LOVERT TAMBALEAN', 11, 'XI-2', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(248, '2020-248', '2020-248', '2020-248-XDG', '50937', '0080968048', 'PRATIWI PUTRI SYAKIB', 11, 'XI-2', 'UMUM', 'F', 'Islam', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(249, '2020-249', '2020-249', '2020-249-CSN', '19742', '0078694534', 'QWEENSY CINTA SENDUK', 11, 'XI-2', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(250, '2020-250', '2020-250', '2020-250-TYI', '42880', '0085476148', 'SERENSIA WOLAJAN', 11, 'XI-2', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(251, '2020-251', '2020-251', '2020-251-LDY', '48060', '0096625486', 'STEVIO ELNINO TIWOW', 11, 'XI-2', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(252, '2020-252', '2020-252', '2020-252-RXP', '80520', '0079064384', 'SYALOM SUCI AURELIA LASUT', 11, 'XI-2', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(253, '2020-253', '2020-253', '2020-253-NVB', '18748', '0084218923', 'VALENSIA MEWENGKANG', 11, 'XI-2', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(254, '2020-254', '2020-254', '2020-254-NCM', '98853', '0085635927', 'Viljya J V Tumelap', 11, 'XI-2', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(255, '2020-255', '2020-255', '2020-255-LGM', '28801', '0088592148', 'VRIZY JOSE HIQUAIN MAMESAH', 11, 'XI-2', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(256, '2020-256', '2020-256', '2020-256-BFI', '31190', '0082394684', 'YEHEZKIEL LUMOINDONG', 11, 'XI-2', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(257, '2020-257', '2020-257', '2020-257-DMS', '70087', '0096328464', 'ARYNN JAQUEEN RUMANGKANG', 11, 'XI-3', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(258, '2020-258', '2020-258', '2020-258-RME', '22496', '3005696468', 'AURELLIA AZALIA WALANDOUW', 11, 'XI-3', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(259, '2020-259', '2020-259', '2020-259-FPS', '55712', '0084236048', 'BRITNEY BREBECA PONTOH', 11, 'XI-3', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(260, '2020-260', '2020-260', '2020-260-HRP', '65547', '3008490567', 'CHARENINA GWEENVEXIA LOWING', 11, 'XI-3', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(261, '2020-261', '2020-261', '2020-261-SBJ', '46503', '0085236470', 'CHELSEA N TAMBAYONG', 11, 'XI-3', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(262, '2020-262', '2020-262', '2020-262-TDX', '70965', '0052399458', 'ELKANIA RILLIANA KUMAYAS', 11, 'XI-3', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(263, '2020-263', '2020-263', '2020-263-KRN', '97066', '0088068857', 'FATURRAHMAN TIKU', 11, 'XI-3', 'UMUM', 'F', 'Islam', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(264, '2020-264', '2020-264', '2020-264-XFL', '15614', '0088523694', 'FRENDLY SAVIOR MUNDUNG', 11, 'XI-3', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(265, '2020-265', '2020-265', '2020-265-KDU', '60658', '0029738962', 'GISELLA PATRICIA MANGUNDAP', 11, 'XI-3', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(266, '2020-266', '2020-266', '2020-266-ZDL', '22389', '0086908431', 'GLORIFY BARBIE MATHEOS', 11, 'XI-3', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(267, '2020-267', '2020-267', '2020-267-NGI', '86441', '0078053904', 'GLORY APLONIA ROTINSULU', 11, 'XI-3', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(268, '2020-268', '2020-268', '2020-268-GDB', '87090', '0089463910', 'GRAFFILA MYLOVER RAMBITAN', 11, 'XI-3', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(269, '2020-269', '2020-269', '2020-269-RIO', '70342', '0080889054', 'INJILIA CIREIG STIEN ARINA', 11, 'XI-3', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(270, '2020-270', '2020-270', '2020-270-XGE', '67747', '0086268518', 'JASIVA VERONIKA ROTINSULU', 11, 'XI-3', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(271, '2020-271', '2020-271', '2020-271-GSL', '23252', '0022358649', 'JONATHAN VALERIO ENGELHARD SUMAKUL', 11, 'XI-3', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(272, '2020-272', '2020-272', '2020-272-SIC', '67259', '0081562013', 'JULIO SAMUEL TIWOW', 11, 'XI-3', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(273, '2020-273', '2020-273', '2020-273-DAT', '54025', '0081032408', 'KHOIRUL MUBAROK MASLOMAN', 11, 'XI-3', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(274, '2020-274', '2020-274', '2020-274-HCJ', '10979', '0085685236', 'KIRSTEN EUNIKE EASTHER MANUEKE', 11, 'XI-3', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(275, '2020-275', '2020-275', '2020-275-PIX', '81627', '0085968406', 'LIONEL FERNANDES MENTU', 11, 'XI-3', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(276, '2020-276', '2020-276', '2020-276-GRJ', '97617', '0073824081', 'LOURIN NOVYTA WAGEY', 11, 'XI-3', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(277, '2020-277', '2020-277', '2020-277-ETP', '46832', '0098084638', 'MARCHFRYSTA EXELCISDEO MOKOLENSANG', 11, 'XI-3', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(278, '2020-278', '2020-278', '2020-278-LQG', '64911', '0082960564', 'MATTHEW M. H. RUMAGIT', 11, 'XI-3', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(279, '2020-279', '2020-279', '2020-279-BDA', '42884', '0085649853', 'Maylavaisya Victoria Pakasi', 11, 'XI-3', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(280, '2020-280', '2020-280', '2020-280-XFM', '14202', '0086958438', 'MIRACLE CRISTO GERUNGAN', 11, 'XI-3', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(281, '2020-281', '2020-281', '2020-281-DBY', '78811', '0041253984', 'NOEL CHRISTIAN RORING', 11, 'XI-3', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(282, '2020-282', '2020-282', '2020-282-IXZ', '34182', '0082394603', 'REFANDRIS BOSSO', 11, 'XI-3', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(283, '2020-283', '2020-283', '2020-283-EFR', '18537', '0023645284', 'REVAN TIMOTIUS PIETER', 11, 'XI-3', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(284, '2020-284', '2020-284', '2020-284-YTP', '38616', '0085894634', 'TIFFANI BELLA SAMPELAN', 11, 'XI-3', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(285, '2020-285', '2020-285', '2020-285-OYG', '65227', '0085300642', 'TRISTAN REY', 11, 'XI-3', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(286, '2020-286', '2020-286', '2020-286-FTI', '47436', '0086566800', 'VALENTINO GABRIEL CHRISTIAN BEYAH', 11, 'XI-3', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(287, '2020-287', '2020-287', '2020-287-LNT', '25164', '0089453817', 'VALENTINO KURON', 11, 'XI-3', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(288, '2020-288', '2020-288', '2020-288-QNZ', '59886', '0082963854', 'ZELENTINO RUMONDOR', 11, 'XI-3', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(289, '2020-289', '2020-289', '2020-289-YSD', '43893', '0085420046', 'ALFA KAMBEY', 11, 'XI-4', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(290, '2020-290', '2020-290', '2020-290-YHM', '33506', '0086952849', 'ANDARAYANLI YAHYA', 11, 'XI-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(291, '2020-291', '2020-291', '2020-291-KDN', '89840', '0082968748', 'ANISHA ADISTHA NONGKA', 11, 'XI-4', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(292, '2020-292', '2020-292', '2020-292-RZX', '92415', '0076604324', 'BRANDON HIZKIA RARUMANGKAY', 11, 'XI-4', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(293, '2020-293', '2020-293', '2020-293-FHN', '79345', '0085236948', 'CALVIN GIVEN F. SUMANTI', 11, 'XI-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(294, '2020-294', '2020-294', '2020-294-DFQ', '27126', '0082360524', 'CENDY APRILIA KIREY MOCHTAR', 11, 'XI-4', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(295, '2020-295', '2020-295', '2020-295-KYO', '43644', '0087443005', 'CESILIA FIBRIANI SENASTRY LANTANG', 11, 'XI-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(296, '2020-296', '2020-296', '2020-296-VHU', '41505', '0080556943', 'CHRISTIAN RISKY SIAHAYA', 11, 'XI-4', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(297, '2020-297', '2020-297', '2020-297-ENO', '19804', '0048976833', 'CHRISTOFANI IMANUEL TAMAUKA', 11, 'XI-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(298, '2020-298', '2020-298', '2020-298-HDJ', '44921', '2586904703', 'CLERENS URIEL NEHEMIA TUMENGKOL', 11, 'XI-4', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(299, '2020-299', '2020-299', '2020-299-YJH', '37100', '0082369864', 'DIAN ADELEIDA ONIBALA', 11, 'XI-4', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(300, '2020-300', '2020-300', '2020-300-WGY', '86596', '0082368504', 'EIZER EDWARD EFRAIM MINGKID', 11, 'XI-4', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022');
INSERT INTO `siswa` (`id_siswa`, `no_peserta`, `username`, `password`, `nis`, `nisn`, `nama`, `level`, `kelas`, `jurusan`, `fase`, `agama`, `jk`, `server`, `sesi`, `ruang`, `online`, `foto`, `nowa`, `sts`, `idjari`, `sakit`, `izin`, `alpha`, `catatan`, `lulus`, `prestasi`, `tingkat`, `juara`, `t_lahir`, `tgl_lahir`, `alamat`, `desa`, `kecamatan`, `kabupaten`, `ayah`, `pek_ayah`, `ibu`, `pek_ibu`, `stskel`, `anakke`, `asal_sek`, `dikelas`, `tgl_terima`) VALUES
(301, '2020-301', '2020-301', '2020-301-QNI', '16943', '0079580064', 'FELA MOREN NAJOAN', 11, 'XI-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(302, '2020-302', '2020-302', '2020-302-NGH', '56088', '0080908467', 'FILADELFIA SIXLY R. MEA', 11, 'XI-4', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(303, '2020-303', '2020-303', '2020-303-GNE', '25803', '0079965843', 'ISSABELLE KALIGIS', 11, 'XI-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(304, '2020-304', '2020-304', '2020-304-EKZ', '22885', '0082369905', 'JERICO ALEXANDER TULUS', 11, 'XI-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(305, '2020-305', '2020-305', '2020-305-EOS', '79123', '0078543469', 'JONATHAN RUMAMPUK', 11, 'XI-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(306, '2020-306', '2020-306', '2020-306-TOM', '94448', '0085260897', 'JULIO GREGORY LORD PAKASI', 11, 'XI-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(307, '2020-307', '2020-307', '2020-307-QTK', '95379', '0082859647', 'KARUNIA PUTRI MONGDONG', 11, 'XI-4', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(308, '2020-308', '2020-308', '2020-308-JGD', '87350', '0085791931', 'KEVIN KARAMOY', 11, 'XI-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(309, '2020-309', '2020-309', '2020-309-OED', '75179', '0093658427', 'KEYZA P. CH. KALALO', 11, 'XI-4', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(310, '2020-310', '2020-310', '2020-310-EFT', '26088', '0083488029', 'LAURENCIA WALUYAN', 11, 'XI-4', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(311, '2020-311', '2020-311', '2020-311-HDV', '60514', '0082963846', 'MONIQUELLA BRYGIETHA LUMINGKEWAS', 11, 'XI-4', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(312, '2020-312', '2020-312', '2020-312-UGL', '93573', '0096325847', 'NAFTALIA QUEEN KOWAAS', 11, 'XI-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(313, '2020-313', '2020-313', '2020-313-KTH', '70115', '9068453408', 'NATASHA DESIRE SUMAMPOUW', 11, 'XI-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(314, '2020-314', '2020-314', '2020-314-SFM', '74052', '0082084964', 'PREYTI LIMPELE', 11, 'XI-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(315, '2020-315', '2020-315', '2020-315-GRI', '47250', '0078089054', 'SHALOMITA TRIVANDA SHARON DINAR', 11, 'XI-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(316, '2020-316', '2020-316', '2020-316-IZG', '99650', '0082394628', 'TZIVNI LIVNI RUMONDOR', 11, 'XI-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(317, '2020-317', '2020-317', '2020-317-HGT', '88331', '0085236482', 'VACESHY WOWILING', 11, 'XI-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(318, '2020-318', '2020-318', '2020-318-RWQ', '21560', '0086957483', 'VALKYRIE NAICHEL PARENGKUAN', 11, 'XI-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(319, '2020-319', '2020-319', '2020-319-AQB', '23522', '0074250063', 'VELOVE RIVIERRA PITOY', 11, 'XI-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(320, '2020-320', '2020-320', '2020-320-EVA', '45039', '0085498618', 'WARANEY AQUINAS RENGKUAN', 11, 'XI-4', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(321, '2020-321', '2020-321', '2020-321-HPI', '69717', '0082369483', 'ABIGAEL LENGKONG', 11, 'XI-5', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(322, '2020-322', '2020-322', '2020-322-ARI', '26052', '0085236400', 'ADITYA STEFANO SEPANG', 11, 'XI-5', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(323, '2020-323', '2020-323', '2020-323-YLM', '60160', '0082934873', 'AFIFAH CANTIKA SOLEHA PAKPAHAN', 11, 'XI-5', 'UMUM', 'F', 'Islam', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(324, '2020-324', '2020-324', '2020-324-DQT', '35167', '0078536054', 'ALFREDO KEVIN KALALO', 11, 'XI-5', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(325, '2020-325', '2020-325', '2020-325-PER', '41918', '0081259365', 'ANGELICA WADJIRAN', 11, 'XI-5', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(326, '2020-326', '2020-326', '2020-326-YXW', '72109', '0075860846', 'ANGGIE CHARMELIA RANTUNG', 11, 'XI-5', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(327, '2020-327', '2020-327', '2020-327-HLX', '48610', '0082394681', 'AZIEL GENTZA PELEALU', 11, 'XI-5', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(328, '2020-328', '2020-328', '2020-328-JHV', '85106', '0070869384', 'BAYU SAMUDRA', 11, 'XI-5', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(329, '2020-329', '2020-329', '2020-329-WKP', '84358', '0026938421', 'CALISTA EKLESIA RAWUNG', 11, 'XI-5', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(330, '2020-330', '2020-330', '2020-330-SYO', '46600', '0086507701', 'CHIQUITA GENOVEVA KAWENGIAN', 11, 'XI-5', 'UMUM', 'F', 'Kristen', '', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(331, '2020-331', '2020-331', '2020-331-VJG', '56571', '0085493848', 'CHRISTIAN IMANUEL DEXTER YAN EDOARDO KALALO	', 11, 'XI-5', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(332, '2020-332', '2020-332', '2020-332-WLQ', '35434', '0082968094', 'CHRISTIAN NATHANNAEL RUNTUWENE', 11, 'XI-5', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(333, '2020-333', '2020-333', '2020-333-YRL', '86157', '0070853943', 'CHRISTOPHER POLII', 11, 'XI-5', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(334, '2020-334', '2020-334', '2020-334-UYD', '40387', '0078904864', 'CINTA BRIGITA LANTANG', 11, 'XI-5', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(335, '2020-335', '2020-335', '2020-335-VIT', '93917', '0082089648', 'CLARISA SENDEWANA', 11, 'XI-5', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(336, '2020-336', '2020-336', '2020-336-RFK', '10141', '0088150334', 'EVANDLY EBEN SANGGOR', 11, 'XI-5', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(337, '2020-337', '2020-337', '2020-337-PVG', '55847', '0042558624', 'FELOVE CHELSEA CHENAYA GERUNGAN', 11, 'XI-5', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(338, '2020-338', '2020-338', '2020-338-OFN', '96868', '0080761992', 'Gloria Meilka Monijung', 11, 'XI-5', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(339, '2020-339', '2020-339', '2020-339-RGJ', '66888', '0084734257', 'HILLARY YIMNA MAHARANI KAPOH', 11, 'XI-5', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(340, '2020-340', '2020-340', '2020-340-QCF', '82261', '0090870637', 'JELITA JULIANA SWEETLY KALALO', 11, 'XI-5', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(341, '2020-341', '2020-341', '2020-341-KVP', '83707', '0069848023', 'JULIE BLESSITA SEPANG', 11, 'XI-5', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(342, '2020-342', '2020-342', '2020-342-HFK', '20840', '0086327092', 'MARSHELL YESAYA SUMANTI', 11, 'XI-5', 'UMUM', 'F', 'Kristen', '', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(343, '2020-343', '2020-343', '2020-343-ILW', '80229', '0096958604', 'MATTHEW CHRISTANIO BOJOH', 11, 'XI-5', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(344, '2020-344', '2020-344', '2020-344-RXJ', '33874', '0085566952', 'NIKITA MEYSHA LADY KAMBEY', 11, 'XI-5', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(345, '2020-345', '2020-345', '2020-345-EFC', '67503', '0086054384', 'PUTRI SUMANTI', 11, 'XI-5', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(346, '2020-346', '2020-346', '2020-346-WLX', '26470', '0078694538', 'RASYA MINGGU PIRI', 11, 'XI-5', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(347, '2020-347', '2020-347', '2020-347-MJZ', '64641', '0086703452', 'SEFANIA TAMPI', 11, 'XI-5', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(348, '2020-348', '2020-348', '2020-348-IUV', '35331', '0056985068', 'STARY SUMUAL', 11, 'XI-5', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(349, '2020-349', '2020-349', '2020-349-CDS', '77168', '0089547569', 'STEVANO GUMERUNG', 11, 'XI-5', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(350, '2020-350', '2020-350', '2020-350-GKE', '26732', '0078536083', 'SYALOOM CHAIN WIJAYA', 11, 'XI-5', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(351, '2020-351', '2020-351', '2020-351-TNM', '19987', '0080896586', 'VELOMITA QUEEN OMEGA RUMATE', 11, 'XI-5', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(352, '2020-352', '2020-352', '2020-352-KUW', '50297', '0081470713', 'WYNED ELISABETH ESTER POSUMAH', 11, 'XI-5', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(353, '2020-353', '2020-353', '2020-353-BLU', '56867', '0084357362', 'ALBERT SIMBOH SAMPUL', 11, 'XI-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(354, '2020-354', '2020-354', '2020-354-VML', '31285', '0082968340', 'ANDREA DANIELLE POSUMAH', 11, 'XI-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(355, '2020-355', '2020-355', '2020-355-AKB', '79416', '0068420946', 'CARISSA PUTRI KALALO', 11, 'XI-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(356, '2020-356', '2020-356', '2020-356-ZEN', '31726', '0089634744', 'CATTLEYA SHARON JUDEA LOLAEN', 11, 'XI-6', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(357, '2020-357', '2020-357', '2020-357-SMZ', '91718', '0081418142', 'CHAREN JANIVER CHELSEA GERUNG', 11, 'XI-6', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(358, '2020-358', '2020-358', '2020-358-TDM', '15776', '0087723196', 'CHELSEA LAUREL PAKASI', 11, 'XI-6', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(359, '2020-359', '2020-359', '2020-359-HWD', '87942', '0078690543', 'CHERIL TESALONIKA KINDANGEN', 11, 'XI-6', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(360, '2020-360', '2020-360', '2020-360-NLZ', '78301', '0089899267', 'CHESTHER POLII', 11, 'XI-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(361, '2020-361', '2020-361', '2020-361-IFG', '44283', '0078085306', 'Christian Jonathan Tumbel', 11, 'XI-6', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(362, '2020-362', '2020-362', '2020-362-NVY', '83981', '0085436487', 'CHRISTOFAEL NIRAN DIMITRY TATIPANG', 11, 'XI-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(363, '2020-363', '2020-363', '2020-363-HWY', '45331', '0086514739', 'CIVILEA JIREY MONINGKA', 11, 'XI-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(364, '2020-364', '2020-364', '2020-364-UWF', '29762', '0078086339', 'DANIEL E. F. MARANDE', 11, 'XI-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(365, '2020-365', '2020-365', '2020-365-KDO', '93259', '0075200963', 'DINDA PRAYER FAITH KALIGIS', 11, 'XI-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(366, '2020-366', '2020-366', '2020-366-DOL', '89992', '0087683648', 'FELICITY INDRIY MONONUTU', 11, 'XI-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(367, '2020-367', '2020-367', '2020-367-RME', '97797', '0087834649', 'FELINRY RUMATE', 11, 'XI-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(368, '2020-368', '2020-368', '2020-368-SMY', '19353', '0083825969', 'FERIL PRINCESS SAROINSONG', 11, 'XI-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(369, '2020-369', '2020-369', '2020-369-JCL', '19444', '0082394682', 'GIBRAELLI RAIKONEN MUKUAN', 11, 'XI-6', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(370, '2020-370', '2020-370', '2020-370-DKC', '68768', '0083052749', 'GRACHIA CLAUDIA INJILIA KARUH', 11, 'XI-6', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(371, '2020-371', '2020-371', '2020-371-BUH', '13606', '0081631303', 'INDAH FATIMAH MA\'RUF', 11, 'XI-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(372, '2020-372', '2020-372', '2020-372-KOL', '13366', '0078596438', 'JAYDEN CHRISTIANO RATULANGI', 11, 'XI-6', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(373, '2020-373', '2020-373', '2020-373-HCN', '60492', '0080045820', 'JUVENTUS KASEGER', 11, 'XI-6', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(374, '2020-374', '2020-374', '2020-374-RVA', '56362', '0052436974', 'KIREY IMANUELA PASEKI', 11, 'XI-6', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(375, '2020-375', '2020-375', '2020-375-FOH', '70431', '0083540269', 'MARSHELLO SAMUEL KAMAGI', 11, 'XI-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(376, '2020-376', '2020-376', '2020-376-BLH', '34855', '0099850034', 'MICHELLE GABRIELLA PELEALU', 11, 'XI-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(377, '2020-377', '2020-377', '2020-377-AMX', '25126', '0078086684', 'MICHELLE REYLIN ALBERTA MANTIRI', 11, 'XI-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(378, '2020-378', '2020-378', '2020-378-VFK', '15442', '0080353501', 'Mikayla Lentey', 11, 'XI-6', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(379, '2020-379', '2020-379', '2020-379-VZC', '69142', '0082147917', 'MIRACLE SURENTU', 11, 'XI-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(380, '2020-380', '2020-380', '2020-380-IGY', '87397', '0081997063', 'MONICA HILLERY MAMAHIT', 11, 'XI-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(381, '2020-381', '2020-381', '2020-381-XJO', '57892', '0086410087', 'NADHIVA SHALVIA GUNAWAN', 11, 'XI-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(382, '2020-382', '2020-382', '2020-382-KUE', '98628', '0080864321', 'NATALIE CINTA RATU', 11, 'XI-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(383, '2020-383', '2020-383', '2020-383-XSD', '74658', '0075483904', 'NAYLA QHUMAYRAH BADERAN', 11, 'XI-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(384, '2020-384', '2020-384', '2020-384-URW', '46952', '0085396854', 'PILGRIM BILLY DAVID KIROJAN', 11, 'XI-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(385, '2020-385', '2020-385', '2020-385-XHA', '13507', '0024819073', 'AINI ANGELI TAMBARIKI', 12, 'XII-1', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '0882021733186', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(386, '2020-386', '2020-386', '2020-386-LHT', '29796', '0079427606', 'AMBRIL UMBOKAHU', 12, 'XII-1', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(387, '2020-387', '2020-387', '2020-387-LUK', '77149', '0082443752', 'ARKASIH MAYLANGKAY', 12, 'XII-1', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(388, '2020-388', '2020-388', '2020-388-BAU', '85823', '0087352851', 'BELLATRIX NATHALIA MAMUAYA', 12, 'XII-1', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(389, '2020-389', '2020-389', '2020-389-OCS', '99591', '0075846972', 'BRAVLEE MAUKAR', 12, 'XII-1', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(390, '2020-390', '2020-390', '2020-390-DHG', '28117', '0075354328', 'CELINE TANDOKO', 12, 'XII-1', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(391, '2020-391', '2020-391', '2020-391-AXW', '64440', '0084506296', 'DIOALBERTO SALAINTI', 12, 'XII-1', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(392, '2020-392', '2020-392', '2020-392-PQK', '51178', '0074698512', 'DIRLY IMANUEL TULUNG', 12, 'XII-1', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(393, '2020-393', '2020-393', '2020-393-NYX', '72694', '0084171030', 'GISELA KEYCHIA DEWA WALALANGI', 12, 'XII-1', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(394, '2020-394', '2020-394', '2020-394-OGS', '41964', '0087091251', 'GISSEL PELALU', 12, 'XII-1', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(395, '2020-395', '2020-395', '2020-395-PTR', '30624', '0087054907', 'GRACIA WULAN KUHON', 12, 'XII-1', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(396, '2020-396', '2020-396', '2020-396-RBC', '15812', '0071289375', 'HAYDEN FORLAND KILAPONG', 12, 'XII-1', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(397, '2020-397', '2020-397', '2020-397-UWJ', '88806', '0072637743', 'HELONI EASTIME MANDANG', 12, 'XII-1', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 1, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(398, '2020-398', '2020-398', '2020-398-BKU', '31330', '0076530063', 'INJILIA ANNABEL SURENTU', 12, 'XII-1', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(399, '2020-399', '2020-399', '2020-399-NRW', '58810', '0024786315', 'INJILIA LIMPULUS', 12, 'XII-1', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(400, '2020-400', '2020-400', '2020-400-RVD', '73166', '0074501802', 'JEFERSON MAURITS KUMAYAS', 12, 'XII-1', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(401, '2020-401', '2020-401', '2020-401-ONW', '37592', '0071176685', 'JENNIFER TIFFANY ROMPAS', 12, 'XII-1', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(402, '2020-402', '2020-402', '2020-402-XVT', '11815', '0094375482', 'JEREMIA KARUNDENG', 12, 'XII-1', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(403, '2020-403', '2020-403', '2020-403-KBG', '42954', '72,652,867', 'JOAQUIN OTNIEL RUNTURAMBI', 12, 'XII-1', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(404, '2020-404', '2020-404', '2020-404-SJZ', '63114', '75,466,936', 'KAYLA RAMBITAN', 12, 'XII-1', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(405, '2020-405', '2020-405', '2020-405-LHV', '45167', '0087544122', 'KAYRA RAMBITAN', 12, 'XII-1', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(406, '2020-406', '2020-406', '2020-406-LCS', '39474', '0071203670', 'KEIZA MEYBELINE UMBOKAHU', 12, 'XII-1', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(407, '2020-407', '2020-407', '2020-407-HEO', '11058', '0078277028', 'LARA SABATIA PARENGKUAN', 12, 'XII-1', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(408, '2020-408', '2020-408', '2020-408-SFR', '47118', '0073391223', 'MARCHELIN KIROJAN', 12, 'XII-1', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(409, '2020-409', '2020-409', '2020-409-GTF', '41447', '0058931057', 'MARSHELINO YONATAN MANTIK', 12, 'XII-1', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(410, '2020-410', '2020-410', '2020-410-TBY', '29063', '0089604827', 'NAYSILLA H. DJAFAR', 12, 'XII-1', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(411, '2020-411', '2020-411', '2020-411-ZHP', '33631', '0091826451', 'NIKITA WAURAN', 12, 'XII-1', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(412, '2020-412', '2020-412', '2020-412-GDV', '81953', '0084369727', 'OTILDA GAGHENGGANG', 12, 'XII-1', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(413, '2020-413', '2020-413', '2020-413-NTO', '59612', '0035652866', 'STEVANO VALENT SIRANG', 12, 'XII-1', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(414, '2020-414', '2020-414', '2020-414-TFC', '13560', '0084317284', 'THIMOTY MARSELINO PAKEKONG', 12, 'XII-1', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(415, '2020-415', '2020-415', '2020-415-XFZ', '89665', '0045132819', 'ZEFANYA SEMBEL', 12, 'XII-1', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(416, '2020-416', '2020-416', '2020-416-JNA', '23964', '0088559312', 'ZILDJIAN UNIQUE MAUKAR', 12, 'XII-1', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(417, '2020-417', '2020-417', '2020-417-FYC', '78135', '78,792,594', 'ALFREDO KIOSHI BARENT PELEALU', 12, 'XII-2', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(418, '2020-418', '2020-418', '2020-418-XHW', '18064', '0078252478', 'AURELIA MONINGKEY', 12, 'XII-2', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(419, '2020-419', '2020-419', '2020-419-GPZ', '99680', '0035069359', 'BEVERLY CLAUDIA INGGRID RANTUNG', 12, 'XII-2', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(420, '2020-420', '2020-420', '2020-420-QYS', '60991', '0030843975', 'BIBLE LANGI', 12, 'XII-2', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(421, '2020-421', '2020-421', '2020-421-DMU', '37616', '0071559383', 'CHIKA CECILIA SUMANTI', 12, 'XII-2', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(422, '2020-422', '2020-422', '2020-422-RXN', '14466', '0051817068', 'CHILCHIA PAKASI', 12, 'XII-2', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(423, '2020-423', '2020-423', '2020-423-RWA', '97798', '0076426049', 'CLARSKY SAJOW', 12, 'XII-2', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(424, '2020-424', '2020-424', '2020-424-AMN', '20536', '0077882330', 'CLARYSA EKKLESIA PANAMBUNAN', 12, 'XII-2', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(425, '2020-425', '2020-425', '2020-425-JNG', '57610', '0078016579', 'DIAN NATHALIA UMBAS', 12, 'XII-2', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(426, '2020-426', '2020-426', '2020-426-MOC', '32216', '0077819173', 'DELANO DEFRANO GUMERUNG', 12, 'XII-2', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(427, '2020-427', '2020-427', '2020-427-JUQ', '54790', '0073394680', 'EFRAIM DANIEL KAIRUPAN', 12, 'XII-2', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(428, '2020-428', '2020-428', '2020-428-IST', '32726', '0028739054', 'EXCEL DEO NAZAR GUMALANG', 12, 'XII-2', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(429, '2020-429', '2020-429', '2020-429-WUO', '95992', '0086330635', 'FARREL CANNAVARO MALALUTANG', 12, 'XII-2', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(430, '2020-430', '2020-430', '2020-430-EHY', '98878', '0086006710', 'FIKA NATASIA NENDER', 12, 'XII-2', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(431, '2020-431', '2020-431', '2020-431-YON', '80297', '0028439158', 'GERENCHIA E R ROROH', 12, 'XII-2', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(432, '2020-432', '2020-432', '2020-432-NLJ', '82750', '0078515803', 'GRAY JITRO KAPARANG', 12, 'XII-2', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(433, '2020-433', '2020-433', '2020-433-USQ', '34545', '0082664703', 'JENIVER RORINTULUS', 12, 'XII-2', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(434, '2020-434', '2020-434', '2020-434-ZYN', '71960', '0078496754', 'JESHA MICHEL LONTAAN', 12, 'XII-2', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(435, '2020-435', '2020-435', '2020-435-GRA', '24637', '0082047893', 'JESICA SANTA SOPUTAN', 12, 'XII-2', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(436, '2020-436', '2020-436', '2020-436-HMA', '87833', '0082670943', 'LEANDRO PANDE', 12, 'XII-2', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(437, '2020-437', '2020-437', '2020-437-HTK', '27989', '0075604894', 'LEONIEL JUVENTIO WAROUW', 12, 'XII-2', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(438, '2020-438', '2020-438', '2020-438-QBY', '87801', '0073025108', 'MARSILANO TANGKA', 12, 'XII-2', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(439, '2020-439', '2020-439', '2020-439-XSJ', '56893', '0073119748', 'MCLHAREN SUMUWENG', 12, 'XII-2', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(440, '2020-440', '2020-440', '2020-440-LMV', '20183', '0072813135', 'MIRACLE HEAVENLY MONTOLALU', 12, 'XII-2', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(441, '2020-441', '2020-441', '2020-441-WAU', '77344', '0058308940', 'NAYLA AURELLIA LOLONG', 12, 'XII-2', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(442, '2020-442', '2020-442', '2020-442-XAQ', '76698', '0058963758', 'PINKAN JEREMIMA SARAPUNG', 12, 'XII-2', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(443, '2020-443', '2020-443', '2020-443-TCI', '90404', '0071615871', 'PRICHEL KARUNIA PRANATA RAMBING', 12, 'XII-2', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(444, '2020-444', '2020-444', '2020-444-REW', '21140', '54,827,967', 'RENATHA TANGKUMAN', 12, 'XII-2', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(445, '2020-445', '2020-445', '2020-445-CUN', '11922', '0072687102', 'RIDEL JEHEZKIEL JONATHAN PANGEMANAN', 12, 'XII-2', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(446, '2020-446', '2020-446', '2020-446-INR', '74389', '0035652918', 'SEBASTIAN RONDONUWU', 12, 'XII-2', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(447, '2020-447', '2020-447', '2020-447-BWG', '97321', '0082947037', 'THIRXY LALUAN', 12, 'XII-2', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(448, '2020-448', '2020-448', '2020-448-YPG', '71292', '0072751609', 'VABRIEL PANGEMANAN', 12, 'XII-2', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(449, '2020-449', '2020-449', '2020-449-JNH', '54129', '0025843057', 'AIRIN CLARA WALELENG', 12, 'XII-3', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(450, '2020-450', '2020-450', '2020-450-DRQ', '34573', '0082419538', 'ALDO GABRIEL RORING', 12, 'XII-3', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022');
INSERT INTO `siswa` (`id_siswa`, `no_peserta`, `username`, `password`, `nis`, `nisn`, `nama`, `level`, `kelas`, `jurusan`, `fase`, `agama`, `jk`, `server`, `sesi`, `ruang`, `online`, `foto`, `nowa`, `sts`, `idjari`, `sakit`, `izin`, `alpha`, `catatan`, `lulus`, `prestasi`, `tingkat`, `juara`, `t_lahir`, `tgl_lahir`, `alamat`, `desa`, `kecamatan`, `kabupaten`, `ayah`, `pek_ayah`, `ibu`, `pek_ibu`, `stskel`, `anakke`, `asal_sek`, `dikelas`, `tgl_terima`) VALUES
(451, '2020-451', '2020-451', '2020-451-MSA', '20997', '0085372972', 'ANJELA ANATASYA WULUR', 12, 'XII-3', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(452, '2020-452', '2020-452', '2020-452-QRL', '35383', '0072231496', 'ARIEL MANENGKEY', 12, 'XII-3', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(453, '2020-453', '2020-453', '2020-453-SKX', '48006', '0074873054', 'BEKANIA BOYOH', 12, 'XII-3', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(454, '2020-454', '2020-454', '2020-454-QHR', '34045', '0078490735', 'BRESAISSE KHELZHE CHERISH KOROUW', 12, 'XII-3', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(455, '2020-455', '2020-455', '2020-455-HBP', '36632', '0073914682', 'BRITNIE LUMINGKEWAS', 12, 'XII-3', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(456, '2020-456', '2020-456', '2020-456-HRT', '41372', '0082367159', 'CHELSHE ELISABETH SARAH RUMATE', 12, 'XII-3', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(457, '2020-457', '2020-457', '2020-457-DBU', '20381', '0083493629', 'CHEVANDI LUCK DERIL LOMPOLIU', 12, 'XII-3', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(458, '2020-458', '2020-458', '2020-458-NGR', '96052', '0073184712', 'CHRISTANIA ZEFANYA KEYZHA KALALO', 12, 'XII-3', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(459, '2020-459', '2020-459', '2020-459-JZY', '98448', '75,873,302', 'CHRISTOFORD NOVERT GUMERUNG', 12, 'XII-3', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(460, '2020-460', '2020-460', '2020-460-NCW', '38553', '54,873,984', 'DAMIAN WALINGAS', 12, 'XII-3', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(461, '2020-461', '2020-461', '2020-461-ZUS', '82711', '0098710568', 'EUGENIA GLORIA TAMPAH', 12, 'XII-3', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(462, '2020-462', '2020-462', '2020-462-QRC', '13518', '0082153827', 'FEALOVE WALALANGI', 12, 'XII-3', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(463, '2020-463', '2020-463', '2020-463-IFB', '23015', '0077694671', 'FElISIA SYALOMITA LEGOH', 12, 'XII-3', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(464, '2020-464', '2020-464', '2020-464-UIE', '57991', '0076242578', 'FILLIPO KUSEN', 12, 'XII-3', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(465, '2020-465', '2020-465', '2020-465-TFR', '27855', '0083428165', 'GLORIA ANASTASYA FLORENSIA TUMETEL', 12, 'XII-3', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(466, '2020-466', '2020-466', '2020-466-SPW', '68724', '0074301366', 'INDRIANI AMELI TINUNGKI', 12, 'XII-3', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(467, '2020-467', '2020-467', '2020-467-BJH', '40308', '0074177364', 'KAILA DESWITA PELEALU', 12, 'XII-3', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(468, '2020-468', '2020-468', '2020-468-BCZ', '62264', '0071783258', 'MIKHAEL Z. WAKULU', 12, 'XII-3', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(469, '2020-469', '2020-469', '2020-469-YHQ', '89543', '0074797407', 'MUTIARA ANATASYA PONGGAWA', 12, 'XII-3', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(470, '2020-470', '2020-470', '2020-470-ZAL', '59182', '0072813135', 'NAYLA AURELLIA WUISANG', 12, 'XII-3', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(471, '2020-471', '2020-471', '2020-471-EJB', '42220', '0085256264', 'PRINCES AURELL MIKHAELLA PANDE', 12, 'XII-3', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(472, '2020-472', '2020-472', '2020-472-PDY', '49326', '0074550348', 'RACHEL AURORA SIGAR', 12, 'XII-3', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(473, '2020-473', '2020-473', '2020-473-RXL', '34590', '79,489,775', 'RIEDEL DEFRAEL KORENGKENG', 12, 'XII-3', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(474, '2020-474', '2020-474', '2020-474-DIA', '79118', '0075438168', 'SEVANYA KEREN PESIK', 12, 'XII-3', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(475, '2020-475', '2020-475', '2020-475-VIQ', '64083', '0064324506', 'SEYFL MANUEKE', 12, 'XII-3', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(476, '2020-476', '2020-476', '2020-476-BAP', '75149', '0078100353', 'SONIA LEYSIA RAMBING', 12, 'XII-3', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(477, '2020-477', '2020-477', '2020-477-TAR', '88641', '0034815793', 'TOAR MIKHAEL KAISAR TINANGON', 12, 'XII-3', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(478, '2020-478', '2020-478', '2020-478-YIL', '62173', '0067658648', 'VEYBY CANDLE MOKOAGOUW', 12, 'XII-3', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(479, '2020-479', '2020-479', '2020-479-YAE', '51815', '0085024103', 'YOEL DOMPAS', 12, 'XII-3', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(480, '2020-480', '2020-480', '2020-480-EQG', '64400', '0023034698', 'ZERA DAUDA', 12, 'XII-3', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(481, '2020-481', '2020-481', '2020-481-JUT', '77489', '0055802031', 'AFRIL JELITA NENDER', 12, 'XII-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(482, '2020-482', '2020-482', '2020-482-ABG', '17730', '0084311370', 'ALDO RUDY PENDONG', 12, 'XII-4', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(483, '2020-483', '2020-483', '2020-483-UFW', '87276', '79,283,348', 'ALESSANDRIA P. C. SUMARAUW', 12, 'XII-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(484, '2020-484', '2020-484', '2020-484-LDM', '99515', '0082514628', 'ALICIA SUMARAU', 12, 'XII-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(485, '2020-485', '2020-485', '2020-485-JSX', '92566', '0088683992', 'ARZELY MONINGKA', 12, 'XII-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(486, '2020-486', '2020-486', '2020-486-JRB', '81858', '0086494076', 'ATAYA PASKAL MAMBU', 12, 'XII-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(487, '2020-487', '2020-487', '2020-487-QHS', '41384', '0075372572', 'CHELSEA MUNTU', 12, 'XII-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(488, '2020-488', '2020-488', '2020-488-HIK', '76466', '0047633569', 'EYFRYL SILADJA', 12, 'XII-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(489, '2020-489', '2020-489', '2020-489-XBJ', '17164', '0064379829', 'FEYBI ANGELISTA DJAMEN', 12, 'XII-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(490, '2020-490', '2020-490', '2020-490-JKW', '43612', '0086732849', 'GALATEA MANGALA', 12, 'XII-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(491, '2020-491', '2020-491', '2020-491-KAB', '83400', '0019370045', 'GISSELA MAWUNTU', 12, 'XII-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(492, '2020-492', '2020-492', '2020-492-WCE', '27261', '0078688156', 'HIZKIARA IMANUELA NGANTUNG', 12, 'XII-4', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(493, '2020-493', '2020-493', '2020-493-VZW', '72687', '25,718,642', 'JUDE WALANGITAN', 12, 'XII-4', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(494, '2020-494', '2020-494', '2020-494-AXO', '66833', '85,856,848', 'JUNIOR CHRISTIAN FOURJUNE MANDEY', 12, 'XII-4', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(495, '2020-495', '2020-495', '2020-495-VCK', '72797', '0086427983', 'KARENINA PAOKI', 12, 'XII-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(496, '2020-496', '2020-496', '2020-496-YIF', '32715', '0082455131', 'MARANATHA QUEENZY NENDER', 12, 'XII-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(497, '2020-497', '2020-497', '2020-497-DCT', '41303', '28,739,408', 'MICHAEL E. KUSEN', 12, 'XII-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(498, '2020-498', '2020-498', '2020-498-XKY', '59501', '0072537499', 'MICHAEL LUMANAUW', 12, 'XII-4', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(499, '2020-499', '2020-499', '2020-499-SDL', '74548', '0073836880', 'MILITIA C. KAMASI', 12, 'XII-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(500, '2020-500', '2020-500', '2020-500-ZCH', '50629', '0084912711', 'NATHALIA MANGUNDAP', 12, 'XII-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(501, '2020-501', '2020-501', '2020-501-FMH', '88436', '0087716473', 'NAYLA NASIM ', 12, 'XII-4', 'UMUM', 'F', 'Islam', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(502, '2020-502', '2020-502', '2020-502-ROW', '68385', '0073384658', 'NICOLE VICTORIA PRAISEY KANDOUW', 12, 'XII-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(503, '2020-503', '2020-503', '2020-503-LJW', '25987', '0084061078', 'NOVIA PUTRI GOSAL', 12, 'XII-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(504, '2020-504', '2020-504', '2020-504-XUJ', '62729', '0075649837', 'OKTAVIANUS C. BULURDTTY', 12, 'XII-4', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(505, '2020-505', '2020-505', '2020-505-ZQB', '94043', '0096407821', 'RAHEL MARSELA MANUS', 12, 'XII-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(506, '2020-506', '2020-506', '2020-506-SOK', '75482', '0073900109', 'RAYNALDI SELA RATU', 12, 'XII-4', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(507, '2020-507', '2020-507', '2020-507-VEP', '26034', '0084607891', 'RILIA NASRANI MONDIGIR', 12, 'XII-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(508, '2020-508', '2020-508', '2020-508-BDS', '18926', '0082967345', 'RIVA VIONA MAMAHIT', 12, 'XII-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(509, '2020-509', '2020-509', '2020-509-BVI', '48325', '0074073343', 'SHARON VANIA RUMBAJAN', 12, 'XII-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(510, '2020-510', '2020-510', '2020-510-SRB', '74645', '0084912711', 'SHIREN NAFTALI TUMENGKOL', 12, 'XII-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(511, '2020-511', '2020-511', '2020-511-EQL', '91022', '0083954532', 'SYALLOMITA MONIQ RONDONUWU', 12, 'XII-4', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(512, '2020-512', '2020-512', '2020-512-UNV', '96098', '0052422267', 'VICTOR PARUNTU', 12, 'XII-4', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(513, '2020-513', '2020-513', '2020-513-STW', '91849', '0075156374', 'ABRAHAM LUMINGKEWAS', 12, 'XII-5', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(514, '2020-514', '2020-514', '2020-514-WIU', '26720', '0072851438', 'AlFA ALEXANDER KUNONTOY', 12, 'XII-5', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(515, '2020-515', '2020-515', '2020-515-ZPE', '40230', '0034073495', 'ANATASYA TUMELAP', 12, 'XII-5', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(516, '2020-516', '2020-516', '2020-516-ZXM', '50583', '0078427698', 'ANGGIE KUSOY', 12, 'XII-5', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(517, '2020-517', '2020-517', '2020-517-LSH', '43441', '0054827094', 'BELLA SKY KAMASI', 12, 'XII-5', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(518, '2020-518', '2020-518', '2020-518-MAL', '98470', '0088200674', 'BRANDON HIZKIA RARUMANGKAY', 12, 'XII-5', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(519, '2020-519', '2020-519', '2020-519-MUT', '22351', '0028743900', 'BRITNEY PONTOH', 12, 'XII-5', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(520, '2020-520', '2020-520', '2020-520-PSE', '23534', '0089172304', 'CEISYA J. SAGAY', 12, 'XII-5', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(521, '2020-521', '2020-521', '2020-521-JTL', '96455', '0074988750', 'CHEREN MARIA ANGEL TAMBAHANI', 12, 'XII-5', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(522, '2020-522', '2020-522', '2020-522-CXN', '84905', '0081911174', 'CHRISTOFEL VICTOR WENAS', 12, 'XII-5', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(523, '2020-523', '2020-523', '2020-523-SHF', '60994', '0083576489', 'CLIFORT TOMBUKU', 12, 'XII-5', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(524, '2020-524', '2020-524', '2020-524-CAK', '48182', '0085493103', 'DIRLY KOROH', 12, 'XII-5', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(525, '2020-525', '2020-525', '2020-525-UBN', '59703', '0086307819', 'ERLINA SYALOM SOLANG', 12, 'XII-5', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(526, '2020-526', '2020-526', '2020-526-DEM', '99632', '0086420647', 'FEBRIAN MAUKAR', 12, 'XII-5', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(527, '2020-527', '2020-527', '2020-527-LBI', '57446', '0023987195', 'FELICIA EIRENE LIWANG', 12, 'XII-5', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(528, '2020-528', '2020-528', '2020-528-WMJ', '12963', '0035712982', 'FROLAY AMAZIA PONGOH', 12, 'XII-5', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(529, '2020-529', '2020-529', '2020-529-UYV', '42886', '0072996177', 'GLORIA KUSEN', 12, 'XII-5', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(530, '2020-530', '2020-530', '2020-530-TWG', '48784', '0074266391', 'GRATIA RATU', 12, 'XII-5', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(531, '2020-531', '2020-531', '2020-531-GSK', '17504', '78,493,752', 'JEREMIA RICHARD PANGALILA', 12, 'XII-5', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(532, '2020-532', '2020-532', '2020-532-EIX', '31368', '0071636888', 'JUWITA MILITIA CHRISTY KALALO', 12, 'XII-5', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(533, '2020-533', '2020-533', '2020-533-DEN', '94838', '0041563278', 'KENZO HIZKIA PANGAU', 12, 'XII-5', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(534, '2020-534', '2020-534', '2020-534-MEW', '10865', '0073142468', 'MICHELLE ZEVANYA DEENG', 12, 'XII-5', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(535, '2020-535', '2020-535', '2020-535-ZLE', '81347', '0072602062', 'MILVA HESKIEL RIVALDY WORAN', 12, 'XII-5', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(536, '2020-536', '2020-536', '2020-536-OVJ', '52159', '0084294562', 'MOSES RUMATE', 12, 'XII-5', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(537, '2020-537', '2020-537', '2020-537-DUS', '60674', '0083149510', 'MYRELLIO PAKASI', 12, 'XII-5', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(538, '2020-538', '2020-538', '2020-538-KLW', '80761', '82,450,076', 'NABILA GISCA PAKASI', 12, 'XII-5', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(539, '2020-539', '2020-539', '2020-539-JSX', '79742', '0074119286', 'PRISCILLA JEANI BELLA PAAT', 12, 'XII-5', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(540, '2020-540', '2020-540', '2020-540-NDB', '58741', '0086329849', 'REVALINA DONDOKAMBEY', 12, 'XII-5', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(541, '2020-541', '2020-541', '2020-541-QHL', '44126', '0074854938', 'SEPTIANI OLIVIA PANGAU', 12, 'XII-5', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(542, '2020-542', '2020-542', '2020-542-PSX', '11911', '0082490465', 'SNSET ITALIA ROOS TAMBARIKI', 12, 'XII-5', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(543, '2020-543', '2020-543', '2020-543-SCN', '35967', '0037824057', 'VICTOR KARAMOY', 12, 'XII-5', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(544, '2020-544', '2020-544', '2020-544-XPD', '58416', '0072258872', 'VIRGINIA WAROUW', 12, 'XII-5', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(545, '2020-545', '2020-545', '2020-545-RZG', '34751', '0035676878', 'ANISSA ROSYIDIN', 12, 'XII-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(546, '2020-546', '2020-546', '2020-546-APL', '76024', '0035196175', 'AURENNIA EKEL', 12, 'XII-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(547, '2020-547', '2020-547', '2020-547-BOR', '58062', '0035657692', 'CHAIRA E.E . SILOW', 12, 'XII-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(548, '2020-548', '2020-548', '2020-548-OBC', '55252', '0035697229', 'CHRISTIAN BRIFEY PANTOW', 12, 'XII-6', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(549, '2020-549', '2020-549', '2020-549-TON', '35054', '0035698063', 'Christiano Praise Pandey', 12, 'XII-6', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(550, '2020-550', '2020-550', '2020-550-FOU', '76776', '0035657690', 'CLARA CRISTIN DUMINGAN', 12, 'XII-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(551, '2020-551', '2020-551', '2020-551-PTL', '79247', '0035652912', 'DINA GLORIA WAURAN', 12, 'XII-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(552, '2020-552', '2020-552', '2020-552-TND', '50262', '0035697215', 'EIFFEL JOSHUA CHRISTOPHER KUMENIT', 12, 'XII-6', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(553, '2020-553', '2020-553', '2020-553-NYK', '74048', '0011124941', 'FEBI GABRIELA RAKIAN', 12, 'XII-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(554, '2020-554', '2020-554', '2020-554-LEQ', '78039', '0035652923', 'FEBRIAN ASSA', 12, 'XII-6', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(555, '2020-555', '2020-555', '2020-555-RCY', '60616', '0035676288', 'FEREN VERONIKA RUMENDE', 12, 'XII-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(556, '2020-556', '2020-556', '2020-556-ISU', '32104', '0035652507', 'FERLITA WATULINGAS', 12, 'XII-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(557, '2020-557', '2020-557', '2020-557-USK', '61740', '0021522769', 'GABRYANNY HIZKIA MOKOLINUG', 12, 'XII-6', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(558, '2020-558', '2020-558', '2020-558-QXW', '12255', '0022056101', 'GILBY DWAYNE TUILAN', 12, 'XII-6', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(559, '2020-559', '2020-559', '2020-559-GZH', '53229', '0022153899', 'GIVENCY JOE STEWARD PONGAI', 12, 'XII-6', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(560, '2020-560', '2020-560', '2020-560-RGC', '14880', '0035697228', 'GYCHELA CHRISTANIA MANEIN', 12, 'XII-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(561, '2020-561', '2020-561', '2020-561-UFM', '72500', '0035652948', 'ISABELLA CHELSEA A. WAWORUNTU', 12, 'XII-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(562, '2020-562', '2020-562', '2020-562-IYP', '95836', '0025874919', 'IVANNA AURELY NAGITA SIGIT', 12, 'XII-6', 'UMUM', 'F', 'Islam', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(563, '2020-563', '2020-563', '2020-563-NFL', '60022', '0025874922', 'IZABELL BRIGITHA KARTINI PANGAU', 12, 'XII-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(564, '2020-564', '2020-564', '2020-564-VMS', '88500', '0035652904', 'JELCY AMISELA VIERA PARUNTU', 12, 'XII-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(565, '2020-565', '2020-565', '2020-565-XFO', '93154', '0035697648', 'JENIFER MEGAWATI SIAR', 12, 'XII-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(566, '2020-566', '2020-566', '2020-566-HOL', '45347', '0025912401', 'JEREMIA PONGGAWA POSUMAH', 12, 'XII-6', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(567, '2020-567', '2020-567', '2020-567-ICS', '37085', '0025990591', 'JESREEL WARANEY MANTOW', 12, 'XII-6', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(568, '2020-568', '2020-568', '2020-568-QEZ', '45368', '0032450678', 'KLINTEN IMANUEL ISAI TULAR', 12, 'XII-6', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(569, '2020-569', '2020-569', '2020-569-DLO', '73987', '0073360346', 'MIRACLE JONATHAN GOSAL ', 12, 'XII-6', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(570, '2020-570', '2020-570', '2020-570-HPE', '99526', '0035652954', 'MUHHAMAD ALGAZALI RIDHO', 12, 'XII-6', 'UMUM', 'F', 'Islam', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(571, '2020-571', '2020-571', '2020-571-FBG', '32312', '0034974134', 'NABILLA RAHMADHANI', 12, 'XII-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(572, '2020-572', '2020-572', '2020-572-IDZ', '15898', '0089284708', 'QUEENSHY NIKITA POLUAN', 12, 'XII-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '2', 'SMP NEGERI', 'X', '16 Juli 2022'),
(573, '2020-573', '2020-573', '2020-573-ZBF', '70854', '0032393843', 'RENATHA CHRISTANIA ARIANCE SUMOLAN', 12, 'XII-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022'),
(574, '2020-574', '2020-574', '2020-574-IDB', '63451', '0034935270', 'SAFIRA NAYLA UTAMA', 12, 'XII-6', 'UMUM', 'F', 'Islam', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(575, '2020-575', '2020-575', '2020-575-ADT', '59001', '0036652012', 'SALSABILLA ALYA CAHYA', 12, 'XII-6', 'UMUM', 'F', 'Kristen', 'P', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '1', 'SMP NEGERI', 'X', '16 Juli 2022'),
(576, '2020-576', '2020-576', '2020-576-RSW', '32873', '0074673089', 'SAMUEL MOLEKUL', 12, 'XII-6', 'UMUM', 'F', 'Kristen', 'L', 'SRV-1', 1, NULL, 0, '', '', 0, NULL, 0, 0, 0, NULL, 0, NULL, NULL, NULL, '-', '12 Agustus 2000', '-', '-', '-', '-', '-', '-', '-', '-', 'Anak Kandung', '3', 'SMP NEGERI', 'X', '16 Juli 2022');

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal`
--

CREATE TABLE `soal` (
  `id_soal` int(11) NOT NULL,
  `id_bank` int(11) DEFAULT NULL,
  `nomor` int(11) DEFAULT NULL,
  `soal` longtext DEFAULT NULL,
  `jenis` int(11) DEFAULT NULL,
  `opsi` int(11) DEFAULT NULL,
  `pilA` longtext DEFAULT NULL,
  `pilB` longtext DEFAULT NULL,
  `pilC` longtext DEFAULT NULL,
  `pilD` longtext DEFAULT NULL,
  `pilE` longtext DEFAULT NULL,
  `perA` text DEFAULT NULL,
  `perB` text DEFAULT NULL,
  `perC` text DEFAULT NULL,
  `perD` text DEFAULT NULL,
  `perE` text DEFAULT NULL,
  `jawaban` text DEFAULT NULL,
  `file` longtext DEFAULT NULL,
  `file1` mediumtext DEFAULT NULL,
  `fileA` mediumtext DEFAULT NULL,
  `fileB` mediumtext DEFAULT NULL,
  `fileC` mediumtext DEFAULT NULL,
  `fileD` mediumtext DEFAULT NULL,
  `fileE` mediumtext DEFAULT NULL,
  `ket` text DEFAULT NULL,
  `sts` int(11) DEFAULT 0,
  `max_skor` int(11) DEFAULT 1,
  `jenisjawab` varchar(50) DEFAULT NULL,
  `panjang` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sosial`
--

CREATE TABLE `sosial` (
  `ids` int(11) NOT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `mapel` varchar(11) DEFAULT NULL,
  `guru` varchar(11) DEFAULT NULL,
  `nis` varchar(50) DEFAULT NULL,
  `ket1` text DEFAULT NULL,
  `ket2` text DEFAULT NULL,
  `pred` varchar(5) DEFAULT NULL,
  `smt` int(11) DEFAULT NULL,
  `tahun` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `spiritual`
--

CREATE TABLE `spiritual` (
  `ids` int(11) NOT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `mapel` varchar(11) DEFAULT NULL,
  `guru` varchar(11) DEFAULT NULL,
  `nis` varchar(50) DEFAULT NULL,
  `ket1` text DEFAULT NULL,
  `ket2` text DEFAULT NULL,
  `pred` varchar(5) DEFAULT NULL,
  `smt` int(11) DEFAULT NULL,
  `tahun` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `mode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `status`
--

INSERT INTO `status` (`id`, `mode`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `statustrx`
--

CREATE TABLE `statustrx` (
  `id` int(11) NOT NULL,
  `mode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `statustrx`
--

INSERT INTO `statustrx` (`id`, `mode`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_face`
--

CREATE TABLE `status_face` (
  `id` int(11) NOT NULL,
  `mode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `status_face`
--

INSERT INTO `status_face` (`id`, `mode`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `temp_file`
--

CREATE TABLE `temp_file` (
  `id_file` int(11) NOT NULL,
  `id_bank` int(11) DEFAULT 0,
  `nama_file` varchar(50) DEFAULT NULL,
  `status_file` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `temp_finger`
--

CREATE TABLE `temp_finger` (
  `id` int(11) NOT NULL,
  `level` varchar(50) DEFAULT NULL,
  `idjari` int(11) DEFAULT NULL,
  `serial` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `temp_pil`
--

CREATE TABLE `temp_pil` (
  `id` int(11) NOT NULL,
  `idbank` int(11) NOT NULL,
  `nomor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `temp_soal`
--

CREATE TABLE `temp_soal` (
  `id` int(11) NOT NULL,
  `id_bank` int(11) NOT NULL,
  `nomor` int(11) NOT NULL,
  `idfile` int(11) NOT NULL,
  `file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmpbayar`
--

CREATE TABLE `tmpbayar` (
  `nokartu` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmpbuku`
--

CREATE TABLE `tmpbuku` (
  `kode` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmpreg`
--

CREATE TABLE `tmpreg` (
  `nokartu` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmpsis`
--

CREATE TABLE `tmpsis` (
  `nokartu` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `token`
--

CREATE TABLE `token` (
  `id_token` int(11) NOT NULL,
  `token` varchar(6) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `masa_berlaku` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `token`
--

INSERT INTO `token` (`id_token`, `token`, `time`, `masa_berlaku`) VALUES
(1, 'VKUNXL', '2024-05-17 15:44:21', '00:15:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `idsiswa` varchar(11) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `idbuku` varchar(11) DEFAULT NULL,
  `jml` int(11) NOT NULL DEFAULT 1,
  `tgl_kembali` date DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `trx_bayar`
--

CREATE TABLE `trx_bayar` (
  `id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `blth` varchar(50) DEFAULT NULL,
  `idsiswa` int(11) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `idbayar` int(11) DEFAULT NULL,
  `bayar` int(11) DEFAULT NULL,
  `ke` int(11) DEFAULT NULL,
  `bukti` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tugas`
--

CREATE TABLE `tugas` (
  `id_tugas` int(255) NOT NULL,
  `id_guru` int(255) DEFAULT NULL,
  `kelas` text DEFAULT NULL,
  `mapel` varchar(255) DEFAULT NULL,
  `judul` varchar(50) DEFAULT NULL,
  `tugas` longtext DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `tgl_mulai` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tugas`
--

INSERT INTO `tugas` (`id_tugas`, `id_guru`, `kelas`, `mapel`, `judul`, `tugas`, `file`, `tgl_mulai`, `tgl_selesai`, `tgl`, `status`) VALUES
(1, 6, 'a:1:{i:0;s:5:\"XII-3\";}', 'EKN', 'Pengelompokan Akun Akuntansi ', '<p>Kerjakanlah Lembar Aktivitas 2 dan 3 Berikut Ini !</p>', 'Ekonomi Akuntansi Aktivitas 2 dan 3.pdf', '2024-08-27 17:00:00', '2024-08-27 18:00:00', '2024-08-27 08:25:23', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tujuan`
--

CREATE TABLE `tujuan` (
  `idt` int(11) NOT NULL,
  `mapel` varchar(11) DEFAULT NULL,
  `level` varchar(11) DEFAULT NULL,
  `lm` int(11) DEFAULT NULL,
  `tujuan` longtext DEFAULT NULL,
  `tp` int(11) DEFAULT NULL,
  `smt` int(11) DEFAULT NULL,
  `guru` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tujuan`
--

INSERT INTO `tujuan` (`idt`, `mapel`, `level`, `lm`, `tujuan`, `tp`, `smt`, `guru`) VALUES
(3, '4', '12', 1, 'Peserta didik dapat menjelaskan aturan perkalian dan penjumlahan, menganalisis aturan perkalian dan penjumlahan melalui \r\nmasalah kontekstual', 1, 1, 6),
(4, '4', '12', 1, 'Peserta didik mampu menyelesaikan masalah kontekstual yang \r\n berkaitan dengan aturan perkalian dan penjumlahan.', 2, 1, 6),
(5, '4', '12', 1, 'Peserta Didik mampu memahami dan menjelaskan notasi faktorial', 3, 1, 6),
(6, '8', '12', 1, 'Peserta didik mampu menjelaskan konsep dan manfaat akuntansi.', 1, 1, 6),
(7, '8', '12', 1, 'Peserta didik mampu membedakan pemakai informasi akuntansi.', 2, 1, 6),
(8, '8', '12', 2, 'Peserta didik mampu menjelaskan pengertian persamaan dasar \r\nakuntansi.', 3, 1, 6),
(9, '8', '12', 2, 'Peserta didik mampu mengelompokkan unsur-unsur persamaan \r\ndasar akuntansi.', 4, 1, 6),
(10, '8', '12', 3, 'Peserta didik mampu menjelaskan bentuk persamaan dasar \r\nakuntansi.', 5, 1, 6),
(11, '8', '12', 3, 'Peserta didik mampu menganalisis transaksi keuangan terhadap \r\npersamaan dasar akuntansi.', 6, 1, 6),
(12, '8', '12', 3, 'Peserta didik mampu membuat pencatatan persamaan dasar \r\nakuntansi.', 7, 1, 6),
(13, '8', '12', 4, 'Peserta didik mampu menjelaskan pengertian dan komponen \r\nlaporan keuangan.', 8, 1, 6),
(14, '8', '12', 4, 'Peserta didik mampu mengidentifikasi laporan posisi keuangan.', 9, 1, 6),
(15, '8', '12', 4, 'Peserta didik mampu membuat laporan posisi keuangan.', 10, 1, 6),
(16, '8', '12', 4, 'Peserta didik mampu membuat laporan laba rugi.', 11, 1, 6),
(17, '8', '12', 5, 'Peserta didik mampu membuat laporan posisi keuangan \r\nberdasarkan rancangan bisnis atau pengamatan salah satu badan \r\nusaha di lingkungan sekitar.', 12, 1, 6),
(18, '8', '12', 5, 'Peserta didik mampu membuat laporan laba rugi berdasarkan \r\nrancangan bisnis atau pengamatan salah satu badan usaha di \r\nlingkungan sekitar.', 13, 1, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ujian`
--

CREATE TABLE `ujian` (
  `id_ujian` int(11) NOT NULL,
  `kode_nama` varchar(255) DEFAULT NULL,
  `id_bank` int(11) DEFAULT NULL,
  `kode_ujian` varchar(30) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jml_soal` int(11) NOT NULL DEFAULT 0,
  `jml_esai` int(11) NOT NULL DEFAULT 0,
  `jml_multi` int(11) NOT NULL DEFAULT 0,
  `jml_bs` int(11) NOT NULL DEFAULT 0,
  `jml_urut` int(11) NOT NULL DEFAULT 0,
  `tampil_bs` int(11) NOT NULL DEFAULT 0,
  `tampil_urut` int(11) NOT NULL DEFAULT 0,
  `tampil_pg` int(11) NOT NULL DEFAULT 0,
  `tampil_esai` int(11) NOT NULL DEFAULT 0,
  `tampil_multi` int(11) NOT NULL DEFAULT 0,
  `lama_ujian` int(11) NOT NULL DEFAULT 0,
  `tgl_ujian` datetime DEFAULT NULL,
  `tgl_selesai` datetime DEFAULT NULL,
  `waktu_ujian` time DEFAULT NULL,
  `selesai_ujian` time DEFAULT NULL,
  `level` varchar(5) DEFAULT NULL,
  `pk` text DEFAULT NULL,
  `opsi` int(11) DEFAULT 4,
  `sesi` varchar(1) DEFAULT NULL,
  `acak` int(11) DEFAULT 1,
  `token` int(11) DEFAULT 0,
  `status` int(11) DEFAULT NULL,
  `hasil` int(11) DEFAULT 0,
  `kkm` varchar(128) DEFAULT NULL,
  `ulang` int(11) DEFAULT 0,
  `soal_agama` varchar(50) DEFAULT NULL,
  `reset` int(11) DEFAULT 0,
  `pelanggaran` int(11) DEFAULT 0,
  `btnselesai` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nip` varchar(25) DEFAULT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `walas` varchar(20) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` varchar(20) DEFAULT NULL,
  `nowa` varchar(13) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `sts` int(11) NOT NULL DEFAULT 0,
  `idjari` varchar(11) DEFAULT NULL,
  `ttd` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nip`, `jenis`, `nama`, `walas`, `username`, `password`, `level`, `nowa`, `foto`, `sts`, `idjari`, `ttd`) VALUES
(1, '-', NULL, 'Admin', NULL, 'admin', '$2y$10$MI.UkP3igafD5bXyKWXAXOHLUYOV03F99wopo9CtYh4sTEu57ZYIC', 'admin', NULL, NULL, 0, NULL, NULL),
(5, '-', NULL, 'Drs. George M. Dondokambey, M.Sc.', NULL, '12', '12', 'kepala', '0', 'prp.png', 0, NULL, NULL),
(6, '-', 'Guru Mapel', 'Rafael J. Christian. M.Pd.', 'XII-1', 'rafael', 'rafael', 'guru', '0882021733186', NULL, 0, NULL, NULL),
(7, '198111192011012008', 'Guru BK', 'Lidia B. Sumual, S.Pd.', '', 'lidia', 'lidia', 'guru', '0', NULL, 0, NULL, NULL),
(8, '-', 'Guru Mapel', 'Meyske Kalalo, S.Pd.', '', 'meyske', 'meyske', 'guru', '0', NULL, 0, NULL, NULL),
(9, '196904242005012001', NULL, 'Philip Andrean Sualang, S.Pd.', NULL, 'philip', 'philip', 'staff', '0', NULL, 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `absen_daringmapel`
--
ALTER TABLE `absen_daringmapel`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `adm`
--
ALTER TABLE `adm`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `aplikasi`
--
ALTER TABLE `aplikasi`
  ADD PRIMARY KEY (`id_aplikasi`);

--
-- Indeks untuk tabel `banksoal`
--
ALTER TABLE `banksoal`
  ADD PRIMARY KEY (`id_bank`),
  ADD UNIQUE KEY `kode` (`kode`);

--
-- Indeks untuk tabel `barusikap`
--
ALTER TABLE `barusikap`
  ADD PRIMARY KEY (`idp`);

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indeks untuk tabel `bk_kategori`
--
ALTER TABLE `bk_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bk_pelanggaran`
--
ALTER TABLE `bk_pelanggaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bk_siswa`
--
ALTER TABLE `bk_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bk_sp`
--
ALTER TABLE `bk_sp`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bk_sub`
--
ALTER TABLE `bk_sub`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bk_surat`
--
ALTER TABLE `bk_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bk_tindakan`
--
ALTER TABLE `bk_tindakan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tindakan` (`tindakan`);

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bulan`
--
ALTER TABLE `bulan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `datareg`
--
ALTER TABLE `datareg`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nokartu` (`nokartu`);

--
-- Indeks untuk tabel `deskripsi`
--
ALTER TABLE `deskripsi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `download`
--
ALTER TABLE `download`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `file_pendukung`
--
ALTER TABLE `file_pendukung`
  ADD PRIMARY KEY (`id_file`);

--
-- Indeks untuk tabel `informasi`
--
ALTER TABLE `informasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jadwal_mapel`
--
ALTER TABLE `jadwal_mapel`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indeks untuk tabel `jadwal_rapor`
--
ALTER TABLE `jadwal_rapor`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jawaban_dup`
--
ALTER TABLE `jawaban_dup`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jawaban_soal`
--
ALTER TABLE `jawaban_soal`
  ADD PRIMARY KEY (`id_jawaban`);

--
-- Indeks untuk tabel `jawaban_tugas`
--
ALTER TABLE `jawaban_tugas`
  ADD PRIMARY KEY (`id_jawaban`);

--
-- Indeks untuk tabel `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `jenis_sp`
--
ALTER TABLE `jenis_sp`
  ADD PRIMARY KEY (`id_sp`);

--
-- Indeks untuk tabel `jodoh`
--
ALTER TABLE `jodoh`
  ADD PRIMARY KEY (`id_jawaban`);

--
-- Indeks untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kontakme`
--
ALTER TABLE `kontakme`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indeks untuk tabel `lingkup`
--
ALTER TABLE `lingkup`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indeks untuk tabel `mapel_rapor`
--
ALTER TABLE `mapel_rapor`
  ADD PRIMARY KEY (`idm`);

--
-- Indeks untuk tabel `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id_materi`);

--
-- Indeks untuk tabel `m_bayar`
--
ALTER TABLE `m_bayar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_buku`
--
ALTER TABLE `m_buku`
  ADD PRIMARY KEY (`idm`);

--
-- Indeks untuk tabel `m_dimensi`
--
ALTER TABLE `m_dimensi`
  ADD PRIMARY KEY (`id_dimensi`);

--
-- Indeks untuk tabel `m_elemen`
--
ALTER TABLE `m_elemen`
  ADD PRIMARY KEY (`id_elemen`);

--
-- Indeks untuk tabel `m_eskul`
--
ALTER TABLE `m_eskul`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_hari`
--
ALTER TABLE `m_hari`
  ADD PRIMARY KEY (`idh`);

--
-- Indeks untuk tabel `m_kurikulum`
--
ALTER TABLE `m_kurikulum`
  ADD PRIMARY KEY (`idk`);

--
-- Indeks untuk tabel `m_nilai_proyek`
--
ALTER TABLE `m_nilai_proyek`
  ADD PRIMARY KEY (`nilai`);

--
-- Indeks untuk tabel `m_pesan`
--
ALTER TABLE `m_pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_proyek`
--
ALTER TABLE `m_proyek`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_rapor`
--
ALTER TABLE `m_rapor`
  ADD PRIMARY KEY (`idr`);

--
-- Indeks untuk tabel `m_spiritual`
--
ALTER TABLE `m_spiritual`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_sub_elemen`
--
ALTER TABLE `m_sub_elemen`
  ADD PRIMARY KEY (`id_sub`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indeks untuk tabel `nilai_formatif`
--
ALTER TABLE `nilai_formatif`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilai_harian`
--
ALTER TABLE `nilai_harian`
  ADD PRIMARY KEY (`idn`);

--
-- Indeks untuk tabel `nilai_proses`
--
ALTER TABLE `nilai_proses`
  ADD PRIMARY KEY (`idpros`);

--
-- Indeks untuk tabel `nilai_proyek`
--
ALTER TABLE `nilai_proyek`
  ADD PRIMARY KEY (`idn`);

--
-- Indeks untuk tabel `nilai_rapor`
--
ALTER TABLE `nilai_rapor`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilai_sumatif`
--
ALTER TABLE `nilai_sumatif`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesan_terkirim`
--
ALTER TABLE `pesan_terkirim`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `peskul`
--
ALTER TABLE `peskul`
  ADD PRIMARY KEY (`idp`);

--
-- Indeks untuk tabel `prestasi`
--
ALTER TABLE `prestasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `proyek`
--
ALTER TABLE `proyek`
  ADD PRIMARY KEY (`idp`);

--
-- Indeks untuk tabel `refleksi`
--
ALTER TABLE `refleksi`
  ADD PRIMARY KEY (`idr`);

--
-- Indeks untuk tabel `reset`
--
ALTER TABLE `reset`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`kode_ruang`);

--
-- Indeks untuk tabel `server`
--
ALTER TABLE `server`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sesi`
--
ALTER TABLE `sesi`
  ADD PRIMARY KEY (`kode_sesi`);

--
-- Indeks untuk tabel `sinkron`
--
ALTER TABLE `sinkron`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indeks untuk tabel `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id_soal`);

--
-- Indeks untuk tabel `sosial`
--
ALTER TABLE `sosial`
  ADD PRIMARY KEY (`ids`);

--
-- Indeks untuk tabel `spiritual`
--
ALTER TABLE `spiritual`
  ADD PRIMARY KEY (`ids`);

--
-- Indeks untuk tabel `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `statustrx`
--
ALTER TABLE `statustrx`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `status_face`
--
ALTER TABLE `status_face`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `temp_file`
--
ALTER TABLE `temp_file`
  ADD PRIMARY KEY (`id_file`);

--
-- Indeks untuk tabel `temp_finger`
--
ALTER TABLE `temp_finger`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `temp_pil`
--
ALTER TABLE `temp_pil`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `temp_soal`
--
ALTER TABLE `temp_soal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tmpbayar`
--
ALTER TABLE `tmpbayar`
  ADD KEY `nokartu` (`nokartu`);

--
-- Indeks untuk tabel `tmpbuku`
--
ALTER TABLE `tmpbuku`
  ADD KEY `nokartu` (`kode`);

--
-- Indeks untuk tabel `tmpreg`
--
ALTER TABLE `tmpreg`
  ADD KEY `nokartu` (`nokartu`);

--
-- Indeks untuk tabel `tmpsis`
--
ALTER TABLE `tmpsis`
  ADD KEY `nokartu` (`nokartu`);

--
-- Indeks untuk tabel `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id_token`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `trx_bayar`
--
ALTER TABLE `trx_bayar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id_tugas`);

--
-- Indeks untuk tabel `tujuan`
--
ALTER TABLE `tujuan`
  ADD PRIMARY KEY (`idt`);

--
-- Indeks untuk tabel `ujian`
--
ALTER TABLE `ujian`
  ADD PRIMARY KEY (`id_ujian`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `absen_daringmapel`
--
ALTER TABLE `absen_daringmapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `adm`
--
ALTER TABLE `adm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `aplikasi`
--
ALTER TABLE `aplikasi`
  MODIFY `id_aplikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `banksoal`
--
ALTER TABLE `banksoal`
  MODIFY `id_bank` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `barusikap`
--
ALTER TABLE `barusikap`
  MODIFY `idp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `bk_kategori`
--
ALTER TABLE `bk_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `bk_pelanggaran`
--
ALTER TABLE `bk_pelanggaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `bk_siswa`
--
ALTER TABLE `bk_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `bk_sp`
--
ALTER TABLE `bk_sp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `bk_sub`
--
ALTER TABLE `bk_sub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `bk_surat`
--
ALTER TABLE `bk_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `bk_tindakan`
--
ALTER TABLE `bk_tindakan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `bulan`
--
ALTER TABLE `bulan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `datareg`
--
ALTER TABLE `datareg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `deskripsi`
--
ALTER TABLE `deskripsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `download`
--
ALTER TABLE `download`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `file_pendukung`
--
ALTER TABLE `file_pendukung`
  MODIFY `id_file` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `informasi`
--
ALTER TABLE `informasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `jadwal_mapel`
--
ALTER TABLE `jadwal_mapel`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `jadwal_rapor`
--
ALTER TABLE `jadwal_rapor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jawaban_dup`
--
ALTER TABLE `jawaban_dup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jawaban_soal`
--
ALTER TABLE `jawaban_soal`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jawaban_tugas`
--
ALTER TABLE `jawaban_tugas`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jenis_sp`
--
ALTER TABLE `jenis_sp`
  MODIFY `id_sp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `jodoh`
--
ALTER TABLE `jodoh`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kontakme`
--
ALTER TABLE `kontakme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `lingkup`
--
ALTER TABLE `lingkup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `mapel_rapor`
--
ALTER TABLE `mapel_rapor`
  MODIFY `idm` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `materi`
--
ALTER TABLE `materi`
  MODIFY `id_materi` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `m_bayar`
--
ALTER TABLE `m_bayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_buku`
--
ALTER TABLE `m_buku`
  MODIFY `idm` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_dimensi`
--
ALTER TABLE `m_dimensi`
  MODIFY `id_dimensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `m_elemen`
--
ALTER TABLE `m_elemen`
  MODIFY `id_elemen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `m_eskul`
--
ALTER TABLE `m_eskul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_hari`
--
ALTER TABLE `m_hari`
  MODIFY `idh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `m_kurikulum`
--
ALTER TABLE `m_kurikulum`
  MODIFY `idk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `m_pesan`
--
ALTER TABLE `m_pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `m_proyek`
--
ALTER TABLE `m_proyek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `m_rapor`
--
ALTER TABLE `m_rapor`
  MODIFY `idr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `m_spiritual`
--
ALTER TABLE `m_spiritual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `m_sub_elemen`
--
ALTER TABLE `m_sub_elemen`
  MODIFY `id_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `nilai_formatif`
--
ALTER TABLE `nilai_formatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `nilai_harian`
--
ALTER TABLE `nilai_harian`
  MODIFY `idn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `nilai_proses`
--
ALTER TABLE `nilai_proses`
  MODIFY `idpros` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `nilai_proyek`
--
ALTER TABLE `nilai_proyek`
  MODIFY `idn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `nilai_rapor`
--
ALTER TABLE `nilai_rapor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `nilai_sumatif`
--
ALTER TABLE `nilai_sumatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pesan_terkirim`
--
ALTER TABLE `pesan_terkirim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `peskul`
--
ALTER TABLE `peskul`
  MODIFY `idp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `prestasi`
--
ALTER TABLE `prestasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `proyek`
--
ALTER TABLE `proyek`
  MODIFY `idp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `refleksi`
--
ALTER TABLE `refleksi`
  MODIFY `idr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `reset`
--
ALTER TABLE `reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `server`
--
ALTER TABLE `server`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `sinkron`
--
ALTER TABLE `sinkron`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=577;

--
-- AUTO_INCREMENT untuk tabel `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sosial`
--
ALTER TABLE `sosial`
  MODIFY `ids` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `spiritual`
--
ALTER TABLE `spiritual`
  MODIFY `ids` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `statustrx`
--
ALTER TABLE `statustrx`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `status_face`
--
ALTER TABLE `status_face`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `temp_file`
--
ALTER TABLE `temp_file`
  MODIFY `id_file` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `temp_finger`
--
ALTER TABLE `temp_finger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `temp_pil`
--
ALTER TABLE `temp_pil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `temp_soal`
--
ALTER TABLE `temp_soal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `token`
--
ALTER TABLE `token`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `trx_bayar`
--
ALTER TABLE `trx_bayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id_tugas` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tujuan`
--
ALTER TABLE `tujuan`
  MODIFY `idt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `ujian`
--
ALTER TABLE `ujian`
  MODIFY `id_ujian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
