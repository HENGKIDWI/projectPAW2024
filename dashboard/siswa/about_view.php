<?php
session_start();

// Pastikan user login
if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

// Lokasi file JSON
$dataFile = '../data/about_school.json';

// Baca data dari file JSON
$aboutData = json_decode(file_get_contents($dataFile), true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tentang Sekolah</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
  <div class="min-h-screen flex">

    <!-- Sidebar -->
    <?php include '../../layout/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
      <!-- Header -->
      <?php include '../../layout/header.php'; ?>

      <main class="flex-1 container mx-auto px-6 mt-8 pb-12">
        <h2 class="text-3xl font-bold text-gray-700 mb-4">Tentang Sekolah</h2>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
          <h3 class="text-xl font-semibold mb-2">Tentang</h3>
          <p class="mb-4"><?= htmlspecialchars($aboutData['tentang']) ?></p>

          <h3 class="text-xl font-semibold mb-2">Visi</h3>
          <p class="mb-4"><?= htmlspecialchars($aboutData['visi']) ?></p>

          <h3 class="text-xl font-semibold mb-2">Misi</h3>
          <ul class="list-disc pl-5 mb-4">
            <?php foreach ($aboutData['misi'] as $misi): ?>
              <li><?= htmlspecialchars($misi) ?></li>
            <?php endforeach; ?>
          </ul>

          <h3 class="text-xl font-semibold mb-2">Tujuan</h3>
          <p><?= htmlspecialchars($aboutData['tujuan']) ?></p>
        </div>

        <!-- Button to View Struktur -->
        <div class="text-center mt-6">
          <a href="view-struktur.php" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded shadow">
            Lihat Struktur Sekolah
          </a>
        </div>
      </main>
    </div>
  </div>
</body>
</html>
