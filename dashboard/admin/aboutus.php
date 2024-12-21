<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About the Web System</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
  <!-- Wrapper -->
  <div class="min-h-screen flex flex-col">

    <!-- Sidebar -->
    <?php include '../../layout/sidebar.php'; ?>
    <!-- Navbar -->
    <header id="header" class="bg-blue-600 text-white py-4 transition-all duration-300">
      <?php include '../../layout/header.php'; ?>
    </header>

    <!-- Main Content -->
    <main class="flex-1 container mx-auto px-6 mt-8 pb-12">
      <!-- About the Web System -->
      <section>
        <h2 class="text-3xl font-bold text-gray-700 mb-4">Tentang Sistem Web</h2>
        <p class="text-gray-600 leading-relaxed mb-4">
          Asispen dirancang untuk mempermudah pengelolaan data siswa, guru, 
          serta kegiatan belajar mengajar. Dengan antarmuka yang intuitif dan fitur yang lengkap, 
          sistem ini memberikan kemudahan akses bagi semua pihak yang terlibat.
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
          <div class="p-6 bg-blue-500 text-white rounded-lg shadow">
            <h3 class="text-xl font-semibold mb-2">Fitur Utama</h3>
            <ul class="list-disc list-inside">
              <li>Pengelolaan data siswa dan guru</li>
              <li>Manajemen kelas dan jadwal</li>
              <li>Rekapitulasi kehadiran</li>
              <li>Pelaporan hasil belajar</li>
            </ul>
          </div>

          <div class="p-6 bg-green-500 text-white rounded-lg shadow">
            <h3 class="text-xl font-semibold mb-2">Keunggulan Sistem</h3>
            <ul class="list-disc list-inside">
              <li>Berbasis web, dapat diakses dari mana saja</li>
              <li>Desain responsif untuk berbagai perangkat</li>
              <li>Keamanan data yang terjamin</li>
              <li>Mudah digunakan oleh pengguna</li>
            </ul>
          </div>
        </div>
      </section>
    </main>
  </div>
</body>
</html>
