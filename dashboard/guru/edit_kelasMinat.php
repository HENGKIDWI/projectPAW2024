<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

// Pastikan ada ID kelas yang ingin diedit
if (isset($_GET['id'])) {
    $id_kelas = mysqli_real_escape_string($conn, $_GET['id']);

    // Ambil data kelas berdasarkan ID
    $query = "SELECT * FROM ekstrakurikuler WHERE id_ekstrakurikuler = '$id_kelas'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // Jika kelas tidak ditemukan
    if (!$row) {
        echo "<script>
                alert('Kelas tidak ditemukan!');
                window.location.href = 'DaftarKelasMinat.php';
              </script>";
        exit;
    }

    // Proses form ketika disubmit
    if (isset($_POST["edit"])) {
        // Ambil data dari form
        $nama_kelas = mysqli_real_escape_string($conn, $_POST['nama_kelas']);
        $hari = mysqli_real_escape_string($conn, $_POST['hari']);
        $waktu_mulai = mysqli_real_escape_string($conn, $_POST['waktu_mulai']);
        $waktu_selesai = mysqli_real_escape_string($conn, $_POST['waktu_selesai']);
        $ruang_kelas = mysqli_real_escape_string($conn, $_POST['ruang_kelas']);

        // Query untuk memperbarui data kelas
        $query = "UPDATE ekstrakurikuler 
                  SET nama_kegiatan = '$nama_kelas', hari_kegiatan = '$hari', jam_mulai = '$waktu_mulai', jam_selesai = '$waktu_selesai', tempat_kegiatan = '$ruang_kelas'
                  WHERE id_ekstrakurikuler = '$id_kelas'";

        // Eksekusi query
        if (mysqli_query($conn, $query)) {
            echo "<script>
                    alert('Kelas berhasil diperbarui!');
                    window.location.href = 'DaftarKelasMinat.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Gagal memperbarui kelas. Silakan coba lagi.');
                  </script>";
        }
    }
} else {
    // Jika tidak ada ID, redirect ke halaman utama
    header("Location: DaftarKelasMinat.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Kelas Minat dan Bakat</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
  <!-- Sidebar -->
  <?php include '../../layout/sidebar.php'; ?>
  <!-- Navbar -->
  <header id="header" class="bg-blue-600 text-white py-4">
    <?php include '../../layout/header.php'; ?>
  </header>

  <!-- Main Content -->
  <div class="container mx-auto mt-8 px-4">
    <h2 class="text-3xl font-semibold text-center mb-8">Edit Kelas Minat dan Bakat</h2>

    <!-- Form Edit Kelas -->
    <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
      <form action="" method="POST">
        <div class="mb-4">
          <label for="nama_kelas" class="block text-sm font-medium text-gray-700">Nama Kelas</label>
          <input type="text" class="w-full p-3 border border-gray-300 rounded-md" id="nama_kelas" name="nama_kelas" value="<?php echo $row['nama_kegiatan']; ?>" required>
        </div>

        <div class="mb-4">
          <label for="hari" class="block text-sm font-medium text-gray-700">Hari</label>
          <select class="w-full p-3 border border-gray-300 rounded-md" id="hari" name="hari" required>
            <option value="">Pilih Hari</option>
            <option value="Senin" <?php echo ($row['hari_kegiatan'] == 'Senin' ? 'selected' : ''); ?>>Senin</option>
            <option value="Selasa" <?php echo ($row['hari_kegiatan'] == 'Selasa' ? 'selected' : ''); ?>>Selasa</option>
            <option value="Rabu" <?php echo ($row['hari_kegiatan'] == 'Rabu' ? 'selected' : ''); ?>>Rabu</option>
            <option value="Kamis" <?php echo ($row['hari_kegiatan'] == 'Kamis' ? 'selected' : ''); ?>>Kamis</option>
            <option value="Jumat" <?php echo ($row['hari_kegiatan'] == 'Jumat' ? 'selected' : ''); ?>>Jumat</option>
            <option value="Sabtu" <?php echo ($row['hari_kegiatan'] == 'Sabtu' ? 'selected' : ''); ?>>Sabtu</option>
            <option value="Minggu" <?php echo ($row['hari_kegiatan'] == 'Minggu' ? 'selected' : ''); ?>>Minggu</option>
          </select>
        </div>

        <div class="mb-4">
          <label for="waktu_mulai" class="block text-sm font-medium text-gray-700">Waktu Mulai</label>
          <input type="time" class="w-full p-3 border border-gray-300 rounded-md" id="waktu_mulai" name="waktu_mulai" value="<?php echo $row['jam_mulai']; ?>" required>
        </div>

        <div class="mb-4">
          <label for="waktu_selesai" class="block text-sm font-medium text-gray-700">Waktu Selesai</label>
          <input type="time" class="w-full p-3 border border-gray-300 rounded-md" id="waktu_selesai" name="waktu_selesai" value="<?php echo $row['jam_selesai']; ?>" required>
        </div>

        <div class="mb-4">
          <label for="ruang_kelas" class="block text-sm font-medium text-gray-700">Tempat</label>
          <input type="text" class="w-full p-3 border border-gray-300 rounded-md" id="ruang_kelas" name="ruang_kelas" value="<?php echo $row['tempat_kegiatan']; ?>" required>
        </div>

        <button name="edit" class="w-full bg-blue-600 text-white py-3 rounded-md hover:bg-blue-700">Perbarui Kelas</button>
      </form>
    </div>
  </div>

  <?php require_once "../../layout/footer.php" ?>
</body>
</html>
