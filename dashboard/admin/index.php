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
  <title>Dashboard Admin</title>
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
<body class="bg-gray-100 text-gray-800">

  <!-- Sidebar -->
  <?php include '../../layout/sidebar.php'; ?>

  <!-- Navbar -->
  <header id="header" class="bg-blue-600 text-white py-4 transition-all duration-300">
    <?php include '../../layout/header.php' ?>
  </header>

  <!-- Main Content -->
  <div id="mainContent" class="container mx-auto mt-8 px-4 transition-all duration-300">
    <h2 class="text-3xl font-bold text-center mb-6 text-blue-700 fade-in">Dashboard Admin - Informasi</h2>

    <!-- Informasi Umum Admin -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-6 fade-in">
      <h3 class="text-xl font-semibold">Selamat Datang, <?php echo htmlspecialchars($_SESSION['nama_lengkap']); ?>!</h3>
      <p class="text-gray-600 mt-4">Ini adalah dashboard untuk admin yang memungkinkan Anda untuk mengelola berbagai aspek sistem, termasuk data siswa, guru, pengumuman, dan lebih banyak lagi.</p>

      <h3 class="text-lg font-semibold mt-6">Ringkasan Pengelolaan Sistem</h3>
      <ul class="list-disc pl-6 mt-4 text-gray-600">
        <li>Menambah, mengedit, dan menghapus data siswa dan guru.</li>
        <li>Mengelola pengumuman dan informasi penting di sekolah.</li>
        <li>Mengatur jadwal, pelanggaran, dan evaluasi guru.</li>
        <li>Memantau status dan perkembangan berbagai kegiatan administrasi sekolah.</li>
      </ul>
    </div>

    <!-- Card Informasi -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
      <h3 class="text-lg font-semibold">Informasi Terbaru</h3>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
        <!-- Card Jumlah Siswa -->
        <a href="kelolaDataSiswa.php" class="bg-blue-100 p-4 rounded-lg shadow-md text-center hover:bg-blue-200 transition-all duration-300">
          <h4 class="text-xl font-semibold text-blue-700">Jumlah Siswa</h4>
          <p class="text-3xl font-bold text-gray-800"><?php echo htmlspecialchars(getJumlahSiswa()); ?></p>
        </a>
        
        <!-- Card Jumlah Guru -->
        <a href="tampilanGuru.php" class="bg-green-100 p-4 rounded-lg shadow-md text-center hover:bg-green-200 transition-all duration-300">
          <h4 class="text-xl font-semibold text-green-700">Jumlah Guru</h4>
          <p class="text-3xl font-bold text-gray-800"><?php echo htmlspecialchars(getJumlahGuru()); ?></p>
        </a>

        <!-- Card Pengumuman Terbaru -->
        <a href="viewInformasiDetail.php" class="bg-yellow-100 p-4 rounded-lg shadow-md text-center hover:bg-yellow-200 transition-all duration-300">
          <h4 class="text-xl font-semibold text-yellow-700">Pengumuman Terbaru</h4>
          <p class="text-gray-800">
            <?php 
              $pengumuman = getPengumumanTerbaru();
              if (is_array($pengumuman)) {
                echo '<strong>' . htmlspecialchars($pengumuman['judul_informasi']) . '</strong><br>' . 
                     htmlspecialchars($pengumuman['deskripsi']) . '<br>' .
                     '<small>Oleh: ' . htmlspecialchars($pengumuman['dibuat_oleh']) . '</small>';
              } else {
                echo htmlspecialchars($pengumuman);
              }
            ?>
          </p>
        </a>
      </div>
    </div>

    <!-- Informasi Tambahan -->
    <div class="bg-white shadow-md rounded-lg p-6 fade-in">
      <h3 class="text-lg font-semibold">Informasi Tambahan</h3>
      <ul class="list-disc pl-6 mt-4 text-gray-600">
        <li>Pastikan untuk selalu memeriksa pembaruan data siswa dan guru setiap minggu.</li>
        <li>Pengumuman terkait ujian dan kegiatan lainnya dapat diakses melalui menu Pengumuman.</li>
        <li>Untuk laporan evaluasi dan pelanggaran siswa, Anda bisa mengaksesnya langsung di dashboard.</li>
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
// Fungsi untuk mengambil jumlah siswa
function getJumlahSiswa() {
    global $conn;
    $result = mysqli_query($conn, "SELECT COUNT(*) as total FROM siswa");
    return $result ? mysqli_fetch_assoc($result)['total'] : 0;
}

// Fungsi untuk mengambil jumlah guru
function getJumlahGuru() {
    global $conn;
    $result = mysqli_query($conn, "SELECT COUNT(*) as total FROM guru");
    return $result ? mysqli_fetch_assoc($result)['total'] : 0;
}

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
