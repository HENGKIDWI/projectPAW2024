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
  <title>Dashboard Siswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <style>
    .fade-in {
      animation: fadeIn 1s ease-out;
    }
    @keyframes fadeIn {
      0% {
        opacity: 0;
        transform: translateY(20px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>
<body class="bg-teal-50 text-gray-800">

  <!-- Sidebar -->
  <?php include '../../layout/sidebar.php'; ?>

  <!-- Navbar -->
  <header id="header" class="bg-teal-500 text-white py-4 transition-all duration-300">
    <?php include '../../layout/header.php' ?>
  </header>

  <!-- Main Content -->
  <div id="mainContent" class="container mx-auto mt-8 px-4 transition-all duration-300">
    <h2 class="text-4xl font-extrabold text-center mb-6 text-teal-700 fade-in">Selamat Datang di Dashboard Siswa!</h2>

    <!-- Informasi Siswa -->
    <div class="bg-white shadow-lg rounded-lg p-8 mb-6 fade-in">
      <h3 class="text-xl font-semibold text-teal-600">Halo, <?php echo htmlspecialchars($_SESSION['nama_lengkap']); ?>!</h3>
      <p class="text-gray-700 mt-4">Dashboard ini memberikan akses cepat ke berbagai informasi penting. Anda bisa mengakses jadwal pelajaran, tugas, dan pengumuman terbaru.</p>

      <h3 class="text-lg font-semibold mt-6 text-teal-600">Fitur Utama</h3>
      <ul class="list-disc pl-6 mt-4 text-gray-600">
        <li>Jadwal pelajaran dan kegiatan sekolah.</li>
        <li>Akses materi dan tugas yang perlu dikerjakan.</li>
        <li>Bergabung dengan forum diskusi untuk berbagi informasi.</li>
        <li>Lihat pengumuman terbaru mengenai sekolah.</li>
      </ul>
    </div>

    <!-- Section with Multiple Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
      
      <!-- Card 1: Jadwal Pelajaran -->
      <div class="bg-teal-100 p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
        <h4 class="text-xl font-semibold text-teal-600">Jadwal Pelajaran</h4>
        <p class="mt-4 text-gray-800">Lihat jadwal lengkap pelajaran yang akan datang.</p>
        <a href="cetak_jadwal.php" class="mt-4 inline-block text-teal-600 hover:text-teal-800">Lihat Jadwal &rarr;</a>
      </div>

      <!-- Card 2: Tugas -->
      <div class="bg-orange-100 p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
        <h4 class="text-xl font-semibold text-orange-600">Tugas</h4>
        <p class="mt-4 text-gray-800">Akses daftar tugas yang perlu dikerjakan.</p>
        <a href="tugas.php" class="mt-4 inline-block text-orange-600 hover:text-orange-800">Lihat Tugas &rarr;</a>
      </div>

      <!-- Card 3: Pengumuman Terbaru -->
      <div class="bg-purple-100 p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
        <h4 class="text-xl font-semibold text-purple-600">Pengumuman</h4>
        <p class="mt-4 text-gray-800">Baca pengumuman penting dari sekolah.</p>
        <a href="pengumuman.php" class="mt-4 inline-block text-purple-600 hover:text-purple-800">Lihat Pengumuman &rarr;</a>
      </div>

      <!-- Card 4: Forum Diskusi -->
      <div class="bg-yellow-100 p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
        <h4 class="text-xl font-semibold text-yellow-600">Forum Diskusi</h4>
        <p class="mt-4 text-gray-800">Bergabung dengan forum diskusi bersama teman dan guru.</p>
        <a href="forum.php" class="mt-4 inline-block text-yellow-600 hover:text-yellow-800">Gabung Forum &rarr;</a>
      </div>

      <!-- Card 5: Materi Pelajaran -->
      <div class="bg-blue-100 p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
        <h4 class="text-xl font-semibold text-blue-600">Materi Pelajaran</h4>
        <p class="mt-4 text-gray-800">Akses materi pelajaran yang akan dipelajari.</p>
        <a href="materi.php" class="mt-4 inline-block text-blue-600 hover:text-blue-800">Lihat Materi &rarr;</a>
      </div>

      <!-- Card 6: Penilaian -->
      <div class="bg-green-100 p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
        <h4 class="text-xl font-semibold text-green-600">Penilaian</h4>
        <p class="mt-4 text-gray-800">Lihat nilai ujian dan tugas yang sudah dikerjakan.</p>
        <a href="penilaian.php" class="mt-4 inline-block text-green-600 hover:text-green-800">Lihat Nilai &rarr;</a>
      </div>
      
    </div>

    <!-- Informasi Tambahan -->
    <div class="bg-white shadow-lg rounded-lg p-6 mt-8 fade-in">
      <h3 class="text-lg font-semibold text-teal-600">Catatan Tambahan</h3>
      <ul class="list-disc pl-6 mt-4 text-gray-600">
        <li>Periksa secara rutin untuk memastikan tidak ada tugas yang terlewat.</li>
        <li>Penting untuk selalu mengecek pengumuman terbaru di dashboard.</li>
        <li>Diskusikan materi pelajaran dengan teman-teman dan guru di forum.</li>
      </ul>
    </div>
  </div>

  <script>
    function openNav() {
      document.getElementById("mySidebar").classList.remove("-translate-x-full");
      document.getElementById("mySidebar").classList.add("translate-x-0");
      document.getElementById("mainContent").classList.add("ml-64");
      document.getElementById("header").classList.add("ml-64");
    }

    function closeNav() {
      document.getElementById("mySidebar").classList.remove("translate-x-0");
      document.getElementById("mySidebar").classList.add("-translate-x-full");
      document.getElementById("mainContent").classList.remove("ml-64");
      document.getElementById("header").classList.remove("ml-64");
    }

    document.getElementById('navbarDropdown').addEventListener('click', function() {
      document.getElementById('dropdownMenu').classList.toggle('hidden');
    });
  </script>
</body>
</html>

<?php
// Fungsi untuk mengambil pengumuman terbaru
function getPengumumanTerbaru() {
    global $conn;
    $result = mysqli_query($conn, "SELECT judul_informasi, deskripsi, dibuat_oleh FROM informasi ORDER BY tanggal_publikasi DESC LIMIT 1");
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }
    return "Tidak ada pengumuman terbaru.";
}
?>
