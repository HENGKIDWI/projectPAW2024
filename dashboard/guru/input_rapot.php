<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

// Query untuk mengambil data kelas
$query_kelas = "SELECT * FROM kelas";
$result_kelas = mysqli_query($conn, $query_kelas);

// Query untuk mengambil data mata pelajaran
$query_mapel = "SELECT * FROM mata_pelajaran";
$result_mapel = mysqli_query($conn, $query_mapel);

// Cek status dari URL query untuk feedback
$status = isset($_GET['status']) ? $_GET['status'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Input Rapor Siswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

  <!-- Sidebar -->
  <?php include '../../layout/sidebar.php'; ?>

  <!-- Navbar -->
  <header id="header" class="bg-blue-600 text-white py-4">
    <?php include '../../layout/header.php'; ?>
  </header>

  <!-- Main Content -->
  <div class="container mx-auto mt-6 px-4">
    <h2 class="text-3xl font-semibold text-center mb-6">Input Rapor Siswa</h2>

    <?php if ($status): ?>
      <div class="mb-4 p-4 rounded-md <?php echo $status === 'sukses' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
        <?php echo $status === 'sukses' ? 'Data berhasil disimpan!' : 'Terjadi kesalahan. Coba lagi.'; ?>
      </div>
    <?php endif; ?>

    <!-- Form Input Rapor -->
    <div class="bg-white shadow-lg rounded-lg mb-6 p-6">
      <form action="proses_input_rapor.php" method="POST">
        <!-- Dropdown Kelas -->
        <div class="mb-4">
          <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
          <select id="kelas" name="id_kelas" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            <option value="" disabled selected>-- Pilih Kelas --</option>
            <?php while ($row_kelas = mysqli_fetch_assoc($result_kelas)): ?>
                <option value="<?= $row_kelas['id_kelas']; ?>"><?= $row_kelas['tingkat'] . " " . $row_kelas['nama_kelas']; ?></option>
            <?php endwhile; ?>
          </select>
        </div>

        <!-- Dropdown Mata Pelajaran -->
        <div class="mb-4">
          <label for="mapel" class="block text-sm font-medium text-gray-700">Mata Pelajaran</label>
          <select id="mapel" name="id_mapel" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            <option value="" disabled selected>-- Pilih Mata Pelajaran --</option>
            <?php while ($row_mapel = mysqli_fetch_assoc($result_mapel)): ?>
                <option value="<?= $row_mapel['id_mapel']; ?>"><?= $row_mapel['nama_mapel']; ?></option>
            <?php endwhile; ?>
          </select>
        </div>

        <!-- Identitas Siswa -->
        <div class="mb-4">
          <label for="nama_siswa" class="block text-sm font-medium text-gray-700">Nama Siswa</label>
          <input type="text" id="nama_siswa" name="nama_siswa" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required>
        </div>

        <!-- Input Nilai Akademik -->
        <div class="grid grid-cols-2 gap-4 mb-4">
          <div>
            <label for="nilai_harian" class="block text-sm font-medium text-gray-700">Nilai Harian</label>
            <input type="number" id="nilai_harian" name="nilai_harian" min="0" max="100" class="mt-1 block w-full px-3 py-2 border rounded-md" required>
          </div>
          <div>
            <label for="nilai_tugas" class="block text-sm font-medium text-gray-700">Nilai Tugas</label>
            <input type="number" id="nilai_tugas" name="nilai_tugas" min="0" max="100" class="mt-1 block w-full px-3 py-2 border rounded-md" required>
          </div>
          <div>
            <label for="nilai_uts" class="block text-sm font-medium text-gray-700">Nilai UTS</label>
            <input type="number" id="nilai_uts" name="nilai_uts" min="0" max="100" class="mt-1 block w-full px-3 py-2 border rounded-md" required>
          </div>
          <div>
            <label for="nilai_uas" class="block text-sm font-medium text-gray-700">Nilai UAS</label>
            <input type="number" id="nilai_uas" name="nilai_uas" min="0" max="100" class="mt-1 block w-full px-3 py-2 border rounded-md" required>
          </div>
        </div>

        <!-- Sikap & Kehadiran -->
        <div class="mb-4">
          <label for="sikap" class="block text-sm font-medium text-gray-700">Sikap</label>
          <select id="sikap" name="sikap" class="mt-1 block w-full px-3 py-2 border rounded-md" required>
            <option value="" disabled selected>-- Pilih Sikap --</option>
            <option value="Sangat Baik">Sangat Baik</option>
            <option value="Baik">Baik</option>
            <option value="Cukup">Cukup</option>
            <option value="Kurang">Kurang</option>
          </select>
        </div>

        <!-- Catatan Wali Kelas -->
        <div class="mb-4">
          <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan Wali Kelas</label>
          <textarea id="catatan" name="catatan" rows="3" class="mt-1 block w-full px-3 py-2 border rounded-md"></textarea>
        </div>

        <button type="submit" class="w-full py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700">Simpan Rapor</button>
      </form>
    </div>
  </div>

  <?php require_once "../../layout/footer.php" ?>
</body>
</html>
