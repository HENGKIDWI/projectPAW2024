<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

// Fungsi untuk mengambil semua pengumuman yang statusnya aktif
function getPengumumanAktif() {
  global $conn;
  $result = mysqli_query($conn, "SELECT * FROM informasi WHERE status = 'aktif' ORDER BY tanggal_publikasi DESC");
  $pengumuman = [];
  while ($row = mysqli_fetch_assoc($result)) {
      $pengumuman[] = $row;
  }
  return $pengumuman;
}

// Fungsi untuk mengambil jadwal mengajar hari ini berdasarkan nama guru
function getJadwalMengajarHariIni($nama_guru) {
  global $conn;
  
  // Mendapatkan ID guru berdasarkan nama lengkap
  $queryGuru = "SELECT id_guru FROM guru WHERE nama_lengkap = '$nama_guru'";
  $resultGuru = mysqli_query($conn, $queryGuru);
  $guru = mysqli_fetch_assoc($resultGuru);

  // Jika tidak ditemukan, kembalikan array kosong
  if (!$guru) {
      return [];
  }

  $guru_id = $guru['id_guru']; // Menyimpan ID guru yang ditemukan

  // Mendapatkan nama hari (Senin, Selasa, dst)
  $hariIni = date('l'); 
  
  // Mengonversi nama hari dalam bahasa Inggris ke bahasa Indonesia
  $hariIndo = [
      'Monday'    => 'Senin',
      'Tuesday'   => 'Selasa',
      'Wednesday' => 'Rabu',
      'Thursday'  => 'Kamis',
      'Friday'    => 'Jumat',
      'Saturday'  => 'Sabtu',
      'Sunday'    => 'Minggu'
  ];
  
  // Mendapatkan nama hari dalam bahasa Indonesia
  $hariIndo = $hariIndo[$hariIni];
  
  // Query untuk mengambil jadwal mengajar hari ini berdasarkan ID guru
  $query = "SELECT jadwal.jam_mulai, jadwal.jam_selesai, mata_pelajaran.nama_pelajaran as mata_pelajaran, kelas.nama_kelas as kelas 
            FROM jadwal 
            JOIN mata_pelajaran ON jadwal.mata_pelajaran_id = mata_pelajaran.id_mata_pelajaran 
            JOIN kelas ON jadwal.kelas_id = kelas.id_kelas
            WHERE jadwal.guru_id = '$guru_id' AND jadwal.hari = '$hariIndo'"; 

  $result = mysqli_query($conn, $query);
  $jadwal = [];
  while ($row = mysqli_fetch_assoc($result)) {
      $jadwal[] = $row;
  }
  return $jadwal;
}

// Ambil data
$nama_guru = $_SESSION['nama_lengkap'];
$jadwalMengajar = getJadwalMengajarHariIni($nama_guru);
$pengumumanAktif = getPengumumanAktif();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Guru</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <style>
    @keyframes fadeInUp {
      0% {
        opacity: 0;
        transform: translateY(20px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .fade-in-up {
      animation: fadeInUp 0.6s ease-out forwards;
    }

    .card-icon {
      font-size: 2rem;
      margin-bottom: 1rem;
    }

    .card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    /* Layout styles */
    .layout-wrapper {
      min-height: 100vh;
      position: relative;
    }

    /* Sidebar styles */
    .sidebar {
      position: fixed;
      left: -250px;
      top: 0;
      height: 100vh;
      width: 250px;
      background-color: white;
      z-index: 1000;
      transition: left 0.3s ease;
      box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    }

    /* Sidebar overlay */
    .sidebar-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 999;
      display: none;
    }

    /* Sidebar visible state */
    .sidebar-visible .sidebar {
      left: 0;
    }

    .sidebar-visible .sidebar-overlay {
      display: block;
    }

    /* Header styles */
    .header {
      position: sticky;
      top: 0;
      z-index: 50;
      width: 100%;
    }

    /* Main content wrapper */
    .main-content {
      width: 100%;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    /* Content area */
    .content-area {
      flex: 1;
      padding: 2rem;
    }

    /* Footer styles */
    .footer {
      margin-top: auto;
    }
  </style>
</head>
<body class="bg-gray-100 text-gray-800">
  <div class="layout-wrapper" id="layoutWrapper">
    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
      <?php include '../../layout/sidebar.php'; ?>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      <!-- Navbar -->
      <header class="header bg-blue-600 text-white py-4 shadow-md">
        <?php include '../../layout/header.php'; ?>
      </header>

      <!-- Content Area -->
      <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold text-center mb-6 fade-in-up">Dashboard Guru</h2>

        <!-- Informasi Umum Guru -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6 fade-in-up">
          <h3 class="text-lg font-semibold">Selamat Datang, <?php echo $_SESSION['nama_lengkap']; ?>!</h3>
          <p class="text-gray-600 mt-4">Ini adalah dashboard untuk guru yang memungkinkan Anda melihat informasi penting.</p>
        </div>

         <!-- Daftar Pengumuman -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
          <?php if (!empty($pengumumanAktif)): ?>
            <ul class="space-y-4">
              <?php foreach ($pengumumanAktif as $pengumuman): ?>
                <li class="border-b border-gray-200 pb-4">
                  <h3 class="font-semibold text-lg"><?php echo htmlspecialchars($pengumuman['judul_informasi']); ?></h3>
                  <p class="text-sm text-gray-600 mt-2"><?php echo nl2br(htmlspecialchars($pengumuman['deskripsi'])); ?></p>
                  <p class="text-xs text-gray-400 mt-2">Tanggal: <?php echo date("d M Y", strtotime($pengumuman['tanggal_publikasi'])); ?></p>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php else: ?>
            <p class="text-gray-600">Tidak ada pengumuman aktif saat ini.</p>
          <?php endif; ?>
        </div>

        <!-- Jadwal Mengajar Hari Ini and Inspirasi Hari Ini -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 fade-in-up">
          <!-- Jadwal Mengajar Hari Ini -->
          <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold">Jadwal Mengajar Hari Ini</h3>
            <?php if (!empty($jadwalMengajar)): ?>
              <div class="overflow-x-auto mt-4">
                <table class="table-auto w-full border-collapse border border-gray-300">
                  <thead>
                    <tr class="bg-gray-100">
                      <th class="border border-gray-300 px-4 py-2">Jam</th>
                      <th class="border border-gray-300 px-4 py-2">Mata Pelajaran</th>
                      <th class="border border-gray-300 px-4 py-2">Kelas</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($jadwalMengajar as $jadwal): ?>
                      <tr>
                        <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($jadwal['jam_mulai']) ?> - <?= htmlspecialchars($jadwal['jam_selesai']) ?></td>
                        <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($jadwal['mata_pelajaran']) ?></td>
                        <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($jadwal['kelas']) ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            <?php else: ?>
              <p class="text-gray-600 mt-4">Anda tidak memiliki jadwal mengajar hari ini.</p>
            <?php endif; ?>
          </div>

          <!-- Inspirasi Hari Ini -->
          <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold">Quotes Hari Ini</h3>
            <p class="italic text-gray-600 mt-4">"Seorang guru adalah cahaya yang membimbing murid-muridnya menuju masa depan yang lebih cerah. Keberhasilan mereka bukan hanya diukur oleh nilai, tetapi oleh sejauh mana mereka menginspirasi dan memberi harapan."</p>
          </div>
        </div>

        <!-- Quick Links with Icons -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6 fade-in-up">
          <a href="input_nilai.php" class="block bg-blue-500 text-white text-center py-8 rounded-lg shadow-lg hover:bg-blue-600 transform hover:scale-105 transition-all duration-300 card">
            <div class="flex justify-center items-center mb-4">
              <i class="fas fa-pencil-alt text-4xl"></i>
            </div>
            <p class="font-semibold text-lg">Input Nilai</p>
            <p class="text-sm mt-2">Masukkan nilai siswa dengan mudah dan cepat.</p>
          </a>
          
          <a href="detail_absensi.php" class="block bg-green-500 text-white text-center py-8 rounded-lg shadow-lg hover:bg-green-600 transform hover:scale-105 transition-all duration-300 card">
            <div class="flex justify-center items-center mb-4">
              <i class="fas fa-check-circle text-4xl"></i>
            </div>
            <p class="font-semibold text-lg">Kehadiran</p>
            <p class="text-sm mt-2">Cek dan kelola absensi siswa dengan efisien.</p>
          </a>
          
          <a href="jadwal_mengajar.php" class="block bg-yellow-500 text-white text-center py-8 rounded-lg shadow-lg hover:bg-yellow-600 transform hover:scale-105 transition-all duration-300 card">
            <div class="flex justify-center items-center mb-4">
              <i class="fas fa-calendar-alt text-4xl"></i>
            </div>
            <p class="font-semibold text-lg">Jadwal Kelas</p>
            <p class="text-sm mt-2">Lihat dan kelola jadwal mengajar Anda dengan mudah.</p>
          </a>
        </div>
      </div>

      <!-- Footer -->
      <footer class="bg-white shadow-lg mt-auto">
        <?php require_once "../../layout/footer.php"; ?>
      </footer>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const layoutWrapper = document.getElementById('layoutWrapper');
      const sidebar = document.getElementById('sidebar');
      const sidebarOverlay = document.getElementById('sidebarOverlay');
      const toggleButton = document.querySelector('[data-toggle-sidebar]');

      function toggleSidebar() {
        layoutWrapper.classList.toggle('sidebar-visible');
      }

      // Toggle sidebar when button is clicked
      if (toggleButton) {
        toggleButton.addEventListener('click', toggleSidebar);
      }

      // Close sidebar when clicking overlay
      sidebarOverlay.addEventListener('click', toggleSidebar);

      // Close sidebar when pressing Escape key
      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && layoutWrapper.classList.contains('sidebar-visible')) {
          toggleSidebar();
        }
      });
    });
  </script>
</body>
</html>