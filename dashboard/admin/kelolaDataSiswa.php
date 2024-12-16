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
  <title>Kelola Data Siswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <style>
    /* Animasi hover untuk tombol */
    .hover-grow:hover {
      transform: scale(1.05);
      transition: transform 0.3s ease-in-out;
    }
  </style>
</head>
<body class="bg-gray-100 text-gray-800">

  <!-- Wrapper -->
  <div class="flex min-h-screen">

    <!-- Sidebar -->
    <?php include '../../layout/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">

      <!-- Navbar -->
      <header id="header" class="bg-blue-600 text-white py-4 shadow-md">
        <?php include '../../layout/header.php'; ?>
      </header>

      <!-- Container -->
      <div class="container mx-auto mt-8 px-6">
        <!-- Judul Halaman -->
        <div class="flex items-center justify-between mb-6">
          <h2 class="text-3xl font-bold text-gray-700">Kelola Data Siswa</h2>
          <a href="kelolaDataSiswaTambah.php" 
             class="bg-gradient-to-r from-purple-500 to-indigo-500 text-white px-8 py-4 text-lg font-semibold rounded-full shadow-lg hover:bg-gradient-to-l hover:from-indigo-500 hover:to-purple-500 transition duration-300 transform hover:scale-105">
            <i class="fas fa-user-plus mr-2"></i> Tambah Peserta Didik
          </a>
        </div>

        <!-- Grid Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

          <!-- Card Kelas 7 -->
          <div class="bg-gradient-to-r from-blue-400 to-blue-500 text-white shadow-lg rounded-xl p-6 hover-grow">
            <h3 class="text-2xl font-bold mb-4">Kelas 7</h3>
            <p class="mb-6 text-sm text-gray-100">Pengelolaan siswa dan rombel untuk Kelas 7.</p>
            <a href="1.php" 
               class="inline-block px-4 py-2 bg-white text-blue-700 font-bold rounded-full shadow hover:bg-blue-100 transition duration-300">
              Kelola Kelas
            </a>
          </div>

          <!-- Card Kelas 8 -->
          <div class="bg-gradient-to-r from-green-400 to-green-500 text-white shadow-lg rounded-xl p-6 hover-grow">
            <h3 class="text-2xl font-bold mb-4">Kelas 8</h3>
            <p class="mb-6 text-sm text-gray-100">Pengelolaan siswa dan rombel untuk Kelas 8.</p>
            <a href="2.php" 
               class="inline-block px-4 py-2 bg-white text-green-700 font-bold rounded-full shadow hover:bg-green-100 transition duration-300">
              Kelola Kelas
            </a>
          </div>

          <!-- Card Kelas 9 -->
          <div class="bg-gradient-to-r from-red-400 to-red-500 text-white shadow-lg rounded-xl p-6 hover-grow">
            <h3 class="text-2xl font-bold mb-4">Kelas 9</h3>
            <p class="mb-6 text-sm text-gray-100">Pengelolaan siswa dan rombel untuk Kelas 9.</p>
            <a href="3.php" 
               class="inline-block px-4 py-2 bg-white text-red-700 font-bold rounded-full shadow hover:bg-red-100 transition duration-300">
              Kelola Kelas
            </a>
          </div>

        </div>
      </div>

    </div>
  </div>
</body>
</html>
