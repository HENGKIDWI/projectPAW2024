<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

// Ambil data pengumuman berdasarkan ID
$id = $_GET['id'] ?? '';
if (!$id) {
    header("Location: viewInformasiDetail.php");
    exit;
}

$query = "SELECT * FROM informasi WHERE id_informasi = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    header("Location: viewInformasiDetail.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul_informasi'] ?? '';
    $deskripsi = $_POST['deskripsi'] ?? '';
    $tanggal_publikasi = $_POST['tanggal_publikasi'] ?? '';

    $update_query = "UPDATE informasi SET judul_informasi = ?, deskripsi = ?, tanggal_publikasi = ? WHERE id_informasi = ?";
    $update_stmt = mysqli_prepare($conn, $update_query);
    mysqli_stmt_bind_param($update_stmt, 'sssi', $judul, $deskripsi, $tanggal_publikasi, $id);
    mysqli_stmt_execute($update_stmt);

    header("Location: viewInformasiDetail.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Pengumuman</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">
  <div class="layout-wrapper">
    <!-- Sidebar -->
    <div class="sidebar">
      <?php include '../../layout/sidebar.php'; ?>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      <!-- Navbar -->
      <header class="header bg-blue-600 text-white py-4 shadow-md">
        <?php include '../../layout/header.php'; ?>
      </header>

      <!-- Edit Form -->
      <div class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-bold text-center mb-6 text-blue-600">Edit Pengumuman</h2>

        <div class="bg-white shadow-md rounded-lg p-6">
          <form method="POST" action="">
            <div class="mb-4">
              <label for="judul_informasi" class="block text-sm font-medium text-gray-700">Judul Informasi</label>
              <input type="text" id="judul_informasi" name="judul_informasi" value="<?php echo htmlspecialchars($data['judul_informasi']); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div class="mb-4">
              <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
              <textarea id="deskripsi" name="deskripsi" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"><?php echo htmlspecialchars($data['deskripsi']); ?></textarea>
            </div>

            <div class="mb-4">
              <label for="tanggal_publikasi" class="block text-sm font-medium text-gray-700">Tanggal Publikasi</label>
              <input type="date" id="tanggal_publikasi" name="tanggal_publikasi" value="<?php echo htmlspecialchars($data['tanggal_publikasi']); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div class="flex justify-end">
              <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-all">
                <i class="fas fa-save"></i> Simpan
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
