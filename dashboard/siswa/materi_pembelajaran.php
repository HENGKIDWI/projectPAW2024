<?php
session_start();
include '../../koneksi.php'; 

// Cek apakah user sudah login
if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

// Ambil nama siswa dari sesi
$siswa_id = $_SESSION['nama_lengkap'];

// Ambil data kelas siswa
$querySiswa = "SELECT kelas_id FROM siswa WHERE nama_lengkap = '$siswa_id'";
$resultSiswa = mysqli_query($conn, $querySiswa);

// Variabel untuk menyimpan daftar materi
$materiList = [];

if ($resultSiswa && mysqli_num_rows($resultSiswa) > 0) {
    $siswa = mysqli_fetch_assoc($resultSiswa);
    $kelas_id = $siswa['kelas_id'];

    // Ambil materi berdasarkan kelas_id
    $queryMateri = "SELECT * FROM materi WHERE kelas_id = '$kelas_id'";
    $resultMateri = mysqli_query($conn, $queryMateri);

    if ($resultMateri) {
        while ($materi = mysqli_fetch_assoc($resultMateri)) {
            $materiList[] = $materi;
        }
    }
} else {
    $error = "Gagal mengambil data kelas siswa.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Materi Pembelajaran</title>
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
    <h2 class="text-center text-3xl font-semibold mb-6">Materi Pembelajaran</h2>

    <div class="grid grid-cols-1 gap-6 md:gap-10">
      <div class="bg-white shadow-md rounded-lg p-6">
        <div class="grid grid-cols-1 gap-6">
          <?php if (!empty($materiList)): ?>
            <?php foreach ($materiList as $materi): ?>
              <div class="bg-gray-50 shadow-md rounded-lg p-4">
                <h3 class="text-lg font-semibold"><?= htmlspecialchars($materi['judul']) ?></h3>
                <p class="text-sm text-gray-600 mb-2">Diupload Pada: <?= htmlspecialchars($materi['tanggal_upload']) ?></p>
                <p class="text-sm mb-2">Deskripsi: <?= htmlspecialchars($materi['deskripsi']) ?></p>

                <!-- Tautan PDF -->
                <?php if (!empty($materi['file_path'])): ?>
                  <a href="../../<?= htmlspecialchars($materi['file_path']) ?>" class="inline-block py-2 px-4 bg-blue-600 text-white rounded-md shadow-md hover:bg-blue-700" target="_blank">
                    <i class="fas fa-file-pdf"></i> Lihat File
                  </a>
                <?php endif; ?>

                <!-- Tautan Video YouTube -->
                <?php if (!empty($materi['link_yt'])): ?>
                  <a href="<?= htmlspecialchars($materi['link_yt']) ?>" class="inline-block py-2 px-4 bg-red-600 text-white rounded-md shadow-md hover:bg-red-700" target="_blank">
                    <i class="fab fa-youtube"></i> Lihat Video
                  </a>
                <?php endif; ?>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p class="text-center text-gray-500"><?= isset($error) ? $error : "Belum ada materi yang diupload." ?></p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
