<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

// Fungsi untuk mengambil semua informasi
$query = "SELECT * FROM informasi ORDER BY tanggal_publikasi DESC";
$result = mysqli_query($conn, $query);

// Hapus informasi jika tombol di klik
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete_query = "DELETE FROM informasi WHERE id_informasi = $id";
    mysqli_query($conn, $delete_query);
    header("Location: viewInformasiDetail.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <style>
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
    }

    /* Card hover animation */
    .info-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .info-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .status-aktif {
      color: white;
      background-color: #4caf50;
      padding: 0.25rem 0.5rem;
      border-radius: 0.25rem;
      font-weight: bold;
      font-size: 0.875rem;
    }

    .status-tidak-aktif {
      color: white;
      background-color: #f44336;
      padding: 0.25rem 0.5rem;
      border-radius: 0.25rem;
      font-weight: bold;
      font-size: 0.875rem;
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
        <?php include '../../layout/header.php' ?>
      </header>

      <!-- Content Area -->
      <div class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-bold text-center mb-6 text-blue-600">Pengelolaan Pengumuman</h2>

        <!-- Informasi Detail -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
          <div class="flex justify-end mb-6">
            <a href="inputInformasi.php" class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 transition-all">
              <i class="fas fa-plus"></i> Tambah Pengumuman
            </a>
          </div>

          <h3 class="text-xl font-semibold text-gray-800">Semua Pengumuman</h3>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
              <?php
              $is_aktif = (date('Y-m-d') === $row['tanggal_publikasi']);
              ?>
              <div class="info-card bg-white shadow-lg rounded-lg p-4">
                <div class="flex justify-between items-center mb-3">
                  <h4 class="text-xl font-bold text-blue-600"><?php echo htmlspecialchars($row['judul_informasi']); ?></h4>
                  <span class="text-sm text-gray-500"><?php echo date('d-m-Y', strtotime($row['tanggal_publikasi'])); ?></span>
                </div>
                <div class="text-gray-700 text-sm mb-4">
                  <div class="h-40 overflow-y-auto">
                    <p><?php echo nl2br(htmlspecialchars($row['deskripsi'])); ?></p>
                  </div>
                </div>
                <div class="flex justify-between items-center mt-3">
                  <span class="<?php echo $is_aktif ? 'status-aktif' : 'status-tidak-aktif'; ?>">
                    <?php echo $is_aktif ? 'Aktif (Dipublikasi)' : 'Tidak Aktif (Belum Dipublikasi)'; ?>
                  </span>
                  <a href="editInformasi.php?id=<?php echo htmlspecialchars($row['id_informasi']); ?>" class="bg-blue-500 text-white px-4 py-1 rounded-lg hover:bg-blue-600 transition-all">
                    <i class="fas fa-edit"></i> Update
                  </a>
                  <a href="?delete=<?php echo htmlspecialchars($row['id_informasi']); ?>" 
                     onclick="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?')"
                     class="bg-red-500 text-white px-4 py-1 rounded-lg hover:bg-red-600 transition-all">
                    <i class="fas fa-trash-alt"></i> Hapus
                  </a>
                </div>
              </div>
            <?php endwhile; ?>
          </div>
        </div>
      </div>
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
