<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

// Fungsi untuk mengambil pengumuman terbaru
function getPengumumanTerbaru() {
  global $conn;
  $result = mysqli_query($conn, "SELECT deskripsi FROM informasi ORDER BY tanggal_publikasi DESC LIMIT 1");
  $data = mysqli_fetch_assoc($result);
  return $data['deskripsi'] ?? "Tidak ada pengumuman terbaru.";
}

// Fungsi untuk mengambil jadwal mengajar hari ini berdasarkan hari (Senin, Selasa, dll)
function getJadwalMengajarHariIni($nama_guru) {
  global $conn;
  $query = "SELECT jadwal.jam_mulai, jadwal.jam_selesai, mata_pelajaran.nama_pelajaran as mata_pelajaran, kelas.nama_kelas as kelas FROM jadwal 
            JOIN mata_pelajaran ON jadwal.mata_pelajaran_id = mata_pelajaran.id_mata_pelajaran 
            JOIN kelas ON jadwal.kelas_id = kelas.id_kelas
            WHERE jadwal.guru_id = '$nama_guru' AND jadwal.hari = DAYNAME(CURDATE())";
  $result = mysqli_query($conn, $query);
  $jadwal = [];
  while ($row = mysqli_fetch_assoc($result)) {
      $jadwal[] = $row;
  }
  return $jadwal;
}


$nama_guru = $_SESSION['nama_lengkap'];
$jadwalMengajar = getJadwalMengajarHariIni($nama_guru);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Guru</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
  <!-- Sidebar -->
  <?php include '../../layout/sidebar.php'; ?>
  <!-- Navbar -->
  <header id="header" class="bg-blue-600 text-white py-4 transition-all duration-300">
    <?php include '../../layout/header.php' ?>
  </header>

   <!-- Main Content -->
   <div id="mainContent" class="container mx-auto mt-8 px-4 transition-all duration-300">
    <h2 class="text-2xl font-bold text-center mb-6">Dashboard Guru</h2>

    <!-- Informasi Umum Guru -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
      <h3 class="text-lg font-semibold">Selamat Datang, <?php echo $_SESSION['nama_lengkap']; ?>!</h3>
      <p class="text-gray-600 mt-4">Ini adalah dashboard untuk guru yang memungkinkan Anda untuk melihat pengumuman terbaru dan informasi umum.</p>
    </div>

    <!-- Pengumuman -->
    <div class="bg-white shadow-md rounded-lg p-6">
      <h3 class="text-lg font-semibold">Pengumuman Terbaru</h3>
      <p class="text-gray-600 mt-4"><?php echo getPengumumanTerbaru(); ?></p>
    </div>
  </div>


  <?php
    require_once "../../layout/footer.php"
  ?>
</body>
</html>
