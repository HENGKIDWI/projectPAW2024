<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

// Proses Input Informasi
if (isset($_POST['submit'])) {
    $judul = $_POST['judul_informasi'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal_publikasi = $_POST['tanggal_publikasi'];

    $insert_query = "INSERT INTO informasi (judul_informasi, deskripsi, tanggal_publikasi, status) 
                     VALUES ('$judul', '$deskripsi', '$tanggal_publikasi', 'aktif')";
    mysqli_query($conn, $insert_query);

    header("Location: dashboard.php"); // Redirect setelah input
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Input Pengumuman</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
  <!-- Sidebar -->
  <?php include '../../layout/sidebar.php'; ?>
  
  <!-- Navbar -->
  <header id="header" class="bg-blue-600 text-white py-4 transition-all duration-300">
    <?php include '../../layout/header.php' ?>
  </header>

  <!-- Form Input Informasi -->
  <div class="container mx-auto mt-8 px-4">
    <div class="flex justify-start mb-6">
      <a href="viewInformasiDetail.php" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-all">
          <i class="fas fa-arrow-left"></i> Kembali ke Daftar Pengumuman
      </a>
    </div>

    <h2 class="text-2xl font-bold text-center mb-6">Input Pengumuman Baru</h2>

    <div class="bg-white shadow-md rounded-lg p-6">
      <form method="POST">
        <div class="mb-4">
          <label for="judul_informasi" class="block text-sm font-semibold">Judul Pengumuman</label>
          <input type="text" name="judul_informasi" id="judul_informasi" class="border px-4 py-2 w-full" required>
        </div>

        <div class="mb-4">
          <label for="deskripsi" class="block text-sm font-semibold">Deskripsi Pengumuman</label>
          <textarea name="deskripsi" id="deskripsi" class="border px-4 py-2 w-full" rows="5" required></textarea>
        </div>

        <div class="mb-4">
          <label for="tanggal_publikasi" class="block text-sm font-semibold">Tanggal Publikasi</label>
          <input type="date" name="tanggal_publikasi" id="tanggal_publikasi" class="border px-4 py-2 w-full" required>
        </div>

        <button type="submit" name="submit" class="bg-blue-500 text-white px-6 py-2 rounded">Submit</button>
      </form>
    </div>
  </div>
</body>
</html>