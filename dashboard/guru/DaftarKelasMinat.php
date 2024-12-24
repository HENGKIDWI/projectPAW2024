<?php
include "../../koneksi.php";
session_start();

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

$guru_id = $_SESSION['guru_id']; // Mendapatkan ID guru dari session
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelas Ekstrakurikuler - Guru</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
  <!-- Sidebar -->
  <?php include '../../layout/sidebar.php'; ?>
  <!-- Navbar -->
  <header id="header" class="bg-blue-600 text-white py-4">
    <?php include '../../layout/header.php'; ?>
  </header>

  <!-- Main Content -->
  <div class="container mx-auto mt-8 px-4">
    <h2 class="text-3xl font-semibold text-center mb-8">KELAS EKSTRAKURIKULER</h2>

    <!-- Tombol Buat Kelas -->
    <div class="mb-6 text-right">
      <a href="BuatKelasMinat.php" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">Buat Ektrakurikuler</a>
    </div>

    <!-- Menampilkan Kelas yang Dibuat Guru -->
    <div class="bg-white shadow-lg rounded-lg p-6">
      <h3 class="text-xl font-semibold mb-4">Kelas Ekstrakurikuler</h3>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php
        // Query untuk mengambil kelas ekstrakurikuler berdasarkan guru_id dan menampilkan nama guru
        $query = "SELECT e.*, g.nama_lengkap FROM ekstrakurikuler AS e JOIN guru AS g ON e.pembimbing_id = g.id_guru
                  WHERE e.pembimbing_id = '$guru_id' ORDER BY e.id_ekstrakurikuler DESC";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='bg-blue-50 border border-blue-300 rounded-lg p-4'>";
                echo "<h4 class='text-lg font-semibold'>" . $row['nama_kegiatan'] . "</h4>";
                echo "<p class='text-sm text-gray-600'>Pembimbing: " . $row['nama_lengkap'] . "</p>"; // Menampilkan nama guru pembimbing
                echo "<p class='text-sm text-gray-600'>Hari: " . $row['hari_kegiatan'] . "</p>";
                echo "<p class='text-sm text-gray-600'>Waktu: " . $row['jam_mulai'] . " - " . $row['jam_selesai'] . "</p>";
                echo "<p class='text-sm text-gray-600'>Tempat: " . $row['tempat_kegiatan'] . "</p>";
                echo "<a href='KelasMinatBakat.php?id=" . $row['id_ekstrakurikuler'] . "' class='text-blue-500 hover:underline'>Lihat Kelas</a>";
                echo "</div>";
            }
        } else {
            echo "<p class='text-gray-500'>Belum ada kelas ekstrakurikuler yang dibuat.</p>";
        }
        ?>
      </div>
    </div>
  </div>

  <?php require_once "../../layout/footer.php"; ?>
</body>
</html>
