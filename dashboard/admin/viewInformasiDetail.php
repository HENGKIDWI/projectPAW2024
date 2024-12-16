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

// Update status jika tombol di klik
if (isset($_POST['update_status'])) {
    $id = $_POST['id_informasi'];
    $status = $_POST['status'];

    $update_query = "UPDATE informasi SET status = '$status' WHERE id_informasi = $id";
    mysqli_query($conn, $update_query);
    header("Location: viewInformasiDetail.php"); 
}

// Hapus informasi jika tombol di klik
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete_query = "DELETE FROM informasi WHERE id_informasi = $id";
    mysqli_query($conn, $delete_query);
    header("Location: viewInformasiDetail.php"); // Refresh halaman
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
          <div class="bg-white shadow-lg rounded-lg p-4 transition-transform transform hover:scale-105 hover:shadow-2xl duration-300">
            <div class="flex justify-between items-center mb-3">
              <h4 class="text-xl font-bold text-blue-600"><?php echo $row['judul_informasi']; ?></h4>
              <span class="text-sm text-gray-500"><?php echo date('d-m-Y', strtotime($row['tanggal_publikasi'])); ?></span>
            </div>
            <div class="text-gray-700 text-sm mb-4">
              <!-- Deskripsi dengan scroll -->
              <div class="h-40 overflow-y-auto">
                <p><?php echo nl2br($row['deskripsi']); ?></p>
              </div>
            </div>
            <div class="flex justify-between items-center mt-3">
              <form method="POST" class="w-full flex justify-between items-center">
                <input type="hidden" name="id_informasi" value="<?php echo $row['id_informasi']; ?>">
                <select name="status" class="border px-2 py-1 rounded-lg w-1/3">
                  <option value="aktif" <?php echo $row['status'] == 'aktif' ? 'selected' : ''; ?>>Aktif</option>
                  <option value="tidak aktif" <?php echo $row['status'] == 'tidak aktif' ? 'selected' : ''; ?>>Tidak Aktif</option>
                </select>
                <button type="submit" name="update_status" class="bg-blue-500 text-white mr-5 px-4 py-1 rounded-lg hover:bg-blue-600 transition-all">
                  <i class="fas fa-sync-alt"></i> Update
                </button>
              </form>
              <a href="?delete=<?php echo $row['id_informasi']; ?>" class="bg-red-500 text-white px-4 py-1 rounded-lg hover:bg-red-600 transition-all">
                <i class="fas fa-trash-alt"></i> Hapus
              </a>
            </div>

            <!-- Like and Share Button -->
            <div class="flex justify-start mt-4">
              <!-- <button class="text-blue-500 hover:text-blue-700 mr-4">
                <i class="fas fa-thumbs-up"></i> Like
              </button>
              <button class="text-blue-500 hover:text-blue-700">
                <i class="fas fa-share-alt"></i> Share
              </button> -->
            </div>
          </div>
        <?php endwhile; ?>
        
      </div>
    </div>
  </div>
</body>
</html>
