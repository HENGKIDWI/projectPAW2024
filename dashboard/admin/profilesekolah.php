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
  <title>About the School</title>
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
      <!-- About the School -->
      <section class="mb-12">
        <h2 class="text-3xl font-bold text-gray-700 mb-4">Tentang Sekolah</h2>
        <p class="text-gray-600 leading-relaxed">
          Sekolah kami adalah lembaga pendidikan yang berkomitmen untuk memberikan pendidikan berkualitas 
          dengan fasilitas terbaik untuk mendukung proses belajar mengajar. Kami percaya bahwa pendidikan 
          adalah kunci untuk masa depan yang lebih baik.
        </p>
      </section>

      <!-- Vision, Mission, and Goals -->
      <section class="mb-12">
        <h2 class="text-3xl font-bold text-gray-700 mb-4">Visi, Misi, dan Tujuan</h2>

        <div class="mb-6">
          <h3 class="text-xl font-semibold text-gray-800 mb-2">Visi</h3>
          <p class="text-gray-600 leading-relaxed">
            "Menciptakan generasi yang berkarakter, berprestasi, dan berdaya saing global."
          </p>
        </div>

        <div class="mb-6">
          <h3 class="text-xl font-semibold text-gray-800 mb-2">Misi</h3>
          <ul class="list-disc list-inside text-gray-600">
            <li>Memberikan pendidikan berkualitas berbasis teknologi dan inovasi.</li>
            <li>Menanamkan nilai-nilai moral dan etika dalam kehidupan sehari-hari siswa.</li>
            <li>Menyediakan lingkungan belajar yang aman, nyaman, dan inklusif.</li>
            <li>Mendorong partisipasi aktif siswa dalam kegiatan akademik dan non-akademik.</li>
          </ul>
        </div>

        <div>
          <h3 class="text-xl font-semibold text-gray-800 mb-2">Tujuan</h3>
          <p class="text-gray-600 leading-relaxed">
            Tujuan kami adalah menghasilkan lulusan yang memiliki keterampilan, pengetahuan, 
            dan karakter yang kuat untuk menghadapi tantangan dunia modern.
          </p>
        </div>
      </section>
    </main>
  </div>
</body>
</html>
