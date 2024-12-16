<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

$nama_guru = $_SESSION['guru_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buat Kelas Minat dan Bakat</title>
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
    <h2 class="text-3xl font-semibold text-center mb-8">Buat Kelas Minat dan Bakat</h2>

    <!-- Form Buat Kelas -->
    <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
      <form action="proses_buat_kelas.php" method="POST">
        <div class="mb-4">
          <label for="nama_kelas" class="block text-sm font-medium text-gray-700">Nama Kelas</label>
          <input type="text" class="w-full p-3 border border-gray-300 rounded-md" id="nama_kelas" name="nama_kelas" required>
        </div>
        <div class="mb-4">
          <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
          <textarea class="w-full p-3 border border-gray-300 rounded-md" id="deskripsi" name="deskripsi" rows="3" required></textarea>
        </div>
        
        <!-- Jadwal Kompleks -->
        <div class="mb-4">
          <label for="hari" class="block text-sm font-medium text-gray-700">Hari</label>
          <select class="w-full p-3 border border-gray-300 rounded-md" id="hari" name="hari" required>
            <option value="">Pilih Hari</option>
            <option value="Senin">Senin</option>
            <option value="Selasa">Selasa</option>
            <option value="Rabu">Rabu</option>
            <option value="Kamis">Kamis</option>
            <option value="Jumat">Jumat</option>
            <option value="Sabtu">Sabtu</option>
            <option value="Minggu">Minggu</option>
          </select>
        </div>

        <div class="mb-4">
          <label for="waktu_mulai" class="block text-sm font-medium text-gray-700">Waktu Mulai</label>
          <input type="time" class="w-full p-3 border border-gray-300 rounded-md" id="waktu_mulai" name="waktu_mulai" required>
        </div>

        <div class="mb-4">
          <label for="waktu_selesai" class="block text-sm font-medium text-gray-700">Waktu Selesai</label>
          <input type="time" class="w-full p-3 border border-gray-300 rounded-md" id="waktu_selesai" name="waktu_selesai" required>
        </div>

        <div class="mb-4">
          <label for="ruang_kelas" class="block text-sm font-medium text-gray-700">Tempat</label>
          <input type="text" class="w-full p-3 border border-gray-300 rounded-md" id="ruang_kelas" name="ruang_kelas" placeholder="Contoh: Ruang Kelas 7A" required>
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-md hover:bg-blue-700">Buat Kelas</button>
      </form>
    </div>

    <!-- Tabel Kelas yang Sudah Dibuat -->
    <div class="bg-white shadow-lg rounded-lg">
      <div class="bg-blue-600 text-white px-6 py-3 rounded-t-lg font-semibold">Kelas yang Sudah Dibuat</div>
      <div class="px-6 py-4">
        <table class="table-auto w-full border-collapse">
          <thead>
            <tr class="text-left bg-gray-100">
              <th class="px-4 py-2 border-b">#</th>
              <th class="px-4 py-2 border-b">Nama Kelas</th>
              <th class="px-4 py-2 border-b">Deskripsi</th>
              <th class="px-4 py-2 border-b">Hari</th>
              <th class="px-4 py-2 border-b">Waktu</th>
              <th class="px-4 py-2 border-b">Ruang Kelas</th>
              <th class="px-4 py-2 border-b">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = "SELECT * FROM ekstrakurikuler ORDER BY id_ekstrakurikuler DESC";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td class='px-4 py-2 border-b'>" . $row['id_kelas'] . "</td>";
                    echo "<td class='px-4 py-2 border-b'>" . $row['nama_kelas'] . "</td>";
                    echo "<td class='px-4 py-2 border-b'>" . $row['deskripsi'] . "</td>";
                    echo "<td class='px-4 py-2 border-b'>" . $row['hari'] . "</td>";
                    echo "<td class='px-4 py-2 border-b'>" . $row['waktu_mulai'] . " - " . $row['waktu_selesai'] . "</td>";
                    echo "<td class='px-4 py-2 border-b'>" . $row['ruang_kelas'] . "</td>";
                    echo "<td class='px-4 py-2 border-b'>";
                    echo "<a href='edit_kelas.php?id=" . $row['id_kelas'] . "' class='text-yellow-500 hover:underline'>Edit</a> | ";
                    echo "<a href='hapus_kelas.php?id=" . $row['id_kelas'] . "' class='text-red-500 hover:underline' onclick='return confirm(\"Apakah Anda yakin ingin menghapus kelas ini?\");'>Hapus</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7' class='px-4 py-2 text-center text-gray-500'>Belum ada kelas yang dibuat.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php
    require_once "../../layout/footer.php"
  ?>
</body>
</html>
