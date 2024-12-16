<?php
include "../../koneksi.php";
session_start();

// Redirect jika belum login
if (!isset($_SESSION['guru_id'])) {
    header("Location: ../../login.php");
    exit;
}

$guru_id = $_SESSION['guru_id'];

// Query untuk mendapatkan data kelas
$query_kelas = "SELECT id_kelas, nama_kelas FROM kelas ORDER BY nama_kelas ASC";
$result_kelas = mysqli_query($conn, $query_kelas);

// Query untuk mendapatkan data mata pelajaran
$query_mapel = "SELECT id_mata_pelajaran, nama_pelajaran FROM mata_pelajaran ORDER BY nama_pelajaran ASC";
$result_mapel = mysqli_query($conn, $query_mapel);

// Menyimpan data jadwal ke database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hari = $_POST['hari'];
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];
    $mata_pelajaran = $_POST['mata_pelajaran'];
    $kelas = $_POST['kelas'];

    if (!empty($hari) && !empty($jam_mulai) && !empty($jam_selesai) && !empty($mata_pelajaran) && !empty($kelas)) {
        $query = "INSERT INTO jadwal (hari, jam_mulai, jam_selesai, mata_pelajaran_id, kelas_id) VALUES ('$hari', '$jam_mulai', '$jam_selesai', '$mata_pelajaran', '$kelas')";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Jadwal berhasil ditambahkan!'); window.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan jadwal!');</script>";
        }
    } else {
        echo "<script>alert('Semua field harus diisi!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Jadwal Mengajar</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
  <!-- Sidebar -->
  <?php include '../../layout/sidebar.php'; ?>
  <!-- Navbar -->
  <header id="header" class="bg-blue-600 text-white py-4 transition-all duration-300">
    <?php include '../../layout/header.php'; ?>
  </header>

  <!-- Main Content -->
  <div id="mainContent" class="container mx-auto mt-8 px-4 transition-all duration-300">
    <h2 class="text-3xl font-semibold text-center text-gray-800 mb-8">Tambah Jadwal Mengajar</h2>

    <div class="bg-white shadow-lg rounded-xl p-8 max-w-3xl mx-auto">
      <form action="" method="POST" class="space-y-6">
        <!-- Hari -->
        <div>
          <label for="hari" class="block text-sm font-medium text-gray-700 mb-2">Hari</label>
          <select name="hari" id="hari" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <option value="">-- Pilih Hari --</option>
            <option value="Senin">Senin</option>
            <option value="Selasa">Selasa</option>
            <option value="Rabu">Rabu</option>
            <option value="Kamis">Kamis</option>
            <option value="Jumat">Jumat</option>
            <option value="Sabtu">Sabtu</option>
          </select>
        </div>

        <!-- Jam Mulai dan Jam Selesai -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label for="jam_mulai" class="block text-sm font-medium text-gray-700 mb-2">Jam Mulai</label>
            <input type="time" name="jam_mulai" id="jam_mulai" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
          </div>
          <div>
            <label for="jam_selesai" class="block text-sm font-medium text-gray-700 mb-2">Jam Selesai</label>
            <input type="time" name="jam_selesai" id="jam_selesai" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
          </div>
        </div>

        <!-- Mata Pelajaran -->
        <div>
          <label for="mata_pelajaran" class="block text-sm font-medium text-gray-700 mb-2">Mata Pelajaran</label>
          <select name="mata_pelajaran" id="mata_pelajaran" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <option value="">-- Pilih Mata Pelajaran --</option>
            <?php while ($row = mysqli_fetch_assoc($result_mapel)): ?>
              <option value="<?php echo $row['id_mata_pelajaran']; ?>"><?php echo $row['nama_pelajaran']; ?></option>
            <?php endwhile; ?>
          </select>
        </div>

        <!-- Kelas -->
        <div>
          <label for="kelas" class="block text-sm font-medium text-gray-700 mb-2">Kelas</label>
          <select name="kelas" id="kelas" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <option value="">-- Pilih Kelas --</option>
            <?php while ($row = mysqli_fetch_assoc($result_kelas)): ?>
              <option value="<?php echo $row['id_kelas']; ?>"><?php echo $row['nama_kelas']; ?></option>
            <?php endwhile; ?>
          </select>
        </div>

        <!-- Tombol -->
        <div class="flex justify-end space-x-4">
          <a href="Jadwal_Mengajar.php" class="bg-gray-400 text-white px-6 py-2 rounded-lg shadow hover:bg-gray-500 transition">
            Batal
          </a>
          <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-700 transition">
            Simpan
          </button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
