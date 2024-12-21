<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

// Lokasi file JSON
$dataFile = '../data/about_school.json';

// Baca data dari file JSON
$aboutData = json_decode(file_get_contents($dataFile), true);

// Jika form disubmit, perbarui data JSON
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Perbarui data berdasarkan input form
    $aboutData['tentang'] = $_POST['tentang'];
    $aboutData['visi'] = $_POST['visi'];
    $aboutData['misi'] = explode("\n", trim($_POST['misi']));
    $aboutData['tujuan'] = $_POST['tujuan'];

    // Simpan data baru ke file JSON
    file_put_contents($dataFile, json_encode($aboutData, JSON_PRETTY_PRINT));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Edit About the School</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
  <div class="min-h-screen flex flex-col">

    <!-- Navbar -->
    <?php include '../../layout/header.php'; ?>
    <!-- Sidebar -->
    <?php include '../../layout/sidebar.php'; ?>

    <!-- Main Content -->
    <main class="flex-1 container mx-auto px-6 mt-8 pb-12">
      <h2 class="text-3xl font-bold text-gray-700 mb-4">Edit Tentang Sekolah</h2>

      <form method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <!-- Tentang Sekolah -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="tentang">Tentang Sekolah</label>
          <textarea name="tentang" id="tentang" rows="4" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:shadow-outline"><?= htmlspecialchars($aboutData['tentang']) ?></textarea>
        </div>

        <!-- Visi -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="visi">Visi</label>
          <textarea name="visi" id="visi" rows="2" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:shadow-outline"><?= htmlspecialchars($aboutData['visi']) ?></textarea>
        </div>

        <!-- Misi -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="misi">Misi</label>
          <textarea name="misi" id="misi" rows="6" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:shadow-outline"><?= htmlspecialchars(implode("\n", $aboutData['misi'])) ?></textarea>
          <small class="text-gray-500">Pisahkan setiap misi dengan baris baru.</small>
        </div>

        <!-- Tujuan -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="tujuan">Tujuan</label>
          <textarea name="tujuan" id="tujuan" rows="4" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:shadow-outline"><?= htmlspecialchars($aboutData['tujuan']) ?></textarea>
        </div>

        <div class="flex items-center justify-between">
          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Simpan</button>
        </div>
      </form>
    </main>
  </div>
</body>
</html>
