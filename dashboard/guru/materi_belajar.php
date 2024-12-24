<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

$nama_guru = $_SESSION['guru_id'];

// Ambil daftar kelas untuk filter
function getKelasList() {
  global $conn;
  $query = "SELECT * FROM kelas ORDER BY nama_kelas";
  return mysqli_query($conn, $query);
}

// Fungsi untuk mendapatkan riwayat materi berdasarkan kelas dan judul
function getRiwayatMateri($kelas_id = null) {
  global $conn, $nama_guru;
  $query = "SELECT materi.*, kelas.nama_kelas, kelas.tingkat FROM materi
            JOIN kelas ON materi.kelas_id = kelas.id_kelas
            WHERE materi.id_guru = '$nama_guru'";

  // Filter berdasarkan kelas
  if ($kelas_id) {
    $query .= " AND materi.kelas_id = '$kelas_id'";
  }

  $query .= " ORDER BY materi.tanggal_upload DESC";
  return mysqli_query($conn, $query);
}

// Handle filter kelas dan pencarian materi
$kelas_id = isset($_GET['kelas_id']) ? $_GET['kelas_id'] : null;
$riwayat_materi = getRiwayatMateri($kelas_id);

// Daftar kelas untuk filter
$kelas_list = getKelasList();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upload Materi Belajar</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
  <!-- Sidebar -->
  <?php include '../../layout/sidebar.php'; ?>

  <!-- Navbar -->
  <header id="header" class="bg-blue-600 text-white py-4">
    <?php include '../../layout/header.php'; ?>
  </header>

  <!-- Main Content -->
  <div class="container mx-auto mt-8 px-4">
    <h2 class="text-center text-3xl font-semibold mb-6">Upload Materi Belajar</h2>
    
    <!-- Filter Kelas dan Pencarian -->
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-3xl font-semibold"></h2>
      <a href="upload_materi.php" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">
        <i class="fas fa-upload"></i> Upload Materi
      </a>
    </div>

    <div class="grid grid-cols-1 gap-6 md:gap-10">
      <!-- Riwayat Data Materi -->
      <div class="bg-white shadow-md rounded-lg p-6">
        <form action="" method="GET" class="flex items-center space-x-4">
          <!-- Dropdown Kelas -->
          <select name="kelas_id" class="px-4 py-2 border rounded-md">
            <option value="">-- Pilih Kelas --</option>
            <?php while ($kelas = mysqli_fetch_assoc($kelas_list)) : ?>
              <option value="<?= $kelas['id_kelas'] ?>" <?= $kelas_id == $kelas['id_kelas'] ? 'selected' : '' ?>>
                <?= $kelas['tingkat'] ?> <?= $kelas['nama_kelas'] ?>
              </option>
            <?php endwhile; ?>
          </select>
          <!-- Search Button -->
          <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">
            <i class="fas fa-search"></i> Cari
          </button>
        </form><br>
        <div class="grid grid-cols-1 gap-6">
          <?php if (mysqli_num_rows($riwayat_materi) > 0) : ?>
              <?php while ($row = mysqli_fetch_assoc($riwayat_materi)) : ?>
                <div class="bg-gray-50 shadow-md rounded-lg p-4">
                  <h3 class="text-lg font-semibold"><?= $row['judul'] ?></h3>
                  <p class="text-sm text-gray-600 mb-2">Diupload Pada : <?= $row['tanggal_upload'] ?></p>
                  <p class="text-sm mb-2"><?= $row['deskripsi'] ?></p>

                  <!-- Informasi Kelas dan Tingkat -->
                  <p class="text-sm text-gray-600">Kelas: <?= $row['nama_kelas'] ?> | Tingkat: <?= $row['tingkat'] ?></p>

                  <!-- Tampilan Download PDF -->
                  <?php if (!empty($row['file_path'])) : ?>
                      <div class="mt-2">
                          <a href="../../<?= $row['file_path'] ?>" class="inline-block py-2 px-4 bg-blue-600 text-white rounded-md shadow-md hover:bg-blue-700" target="_blank">
                              <i class="fas fa-file-pdf"></i> Lihat File
                          </a>
                      </div>
                  <?php endif; ?>

                  <!-- Tampilan Link YouTube -->
                  <?php if (!empty($row['link_yt'])) : ?>
                      <div class="mt-2">
                          <a href="<?= $row['link_yt'] ?>" class="inline-block py-2 px-4 bg-red-600 text-white rounded-md shadow-md hover:bg-red-700" target="_blank">
                              <i class="fab fa-youtube"></i> Lihat Video
                          </a>
                      </div>
                  <?php endif; ?>

                  <!-- Edit dan Hapus -->
                  <div class="mt-4">
                      <a href="edit_materi.php?id=<?= $row['id_materi'] ?>" class="inline-block py-2 px-4 bg-yellow-600 text-white rounded-md shadow-md hover:bg-yellow-700">
                          <i class="fas fa-edit"></i> Edit
                      </a>
                      <a href="?hapus=<?= $row['id_materi'] ?>" class="inline-block py-2 px-4 bg-red-600 text-white rounded-md shadow-md hover:bg-red-700">
                          <i class="fas fa-trash-alt"></i> Hapus
                      </a>
                  </div>
                </div>
              <?php endwhile; ?>
          <?php else : ?>
              <p class="text-center text-gray-500">Belum ada materi yang Anda upload.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
