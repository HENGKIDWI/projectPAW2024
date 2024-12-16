<?php
include "../../koneksi.php";
session_start();

// Fungsi untuk mengambil laporan fasilitas
function getLaporanFasilitas() {
    global $conn;
    $query = "SELECT * FROM laporan_kerusakan ORDER BY tanggal_laporan DESC";
    return mysqli_query($conn, $query);
}

$nama_guru = $_SESSION['guru_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Kerusakan/Kekurangan Fasilitas</title>
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
    <h2 class="text-2xl font-bold text-center mb-6">Laporan Kerusakan/Kekurangan Fasilitas</h2>

    <!-- Layout Flex: Left side for table, right side for form -->
    <div class="flex space-x-8">
      <!-- Tabel Laporan Fasilitas (Left Side) -->
      <div class="w-2/3 bg-white shadow-md rounded-lg p-6">
        <table class="table-auto w-full text-left border-collapse border border-gray-300">
          <thead>
            <tr>
              <th class="px-4 py-2 border border-gray-300 bg-blue-100">NO</th>
              <th class="px-4 py-2 border border-gray-300 bg-blue-100">Kelas</th>
              <th class="px-4 py-2 border border-gray-300 bg-blue-100">Jenis</th>
              <th class="px-4 py-2 border border-gray-300 bg-blue-100">Deskripsi</th>
              <th class="px-4 py-2 border border-gray-300 bg-blue-100">Tanggal</th>
              <th class="px-4 py-2 border border-gray-300 bg-blue-100">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $laporan = getLaporanFasilitas();
            if (mysqli_num_rows($laporan) > 0) {
                $no = 1;
                while ($row = mysqli_fetch_assoc($laporan)) {
                    echo "<tr>";
                    echo "<td class='px-4 py-2 border border-gray-300'>" . $no++ . "</td>";
                    echo "<td class='px-4 py-2 border border-gray-300'>" . $row['kelas'] . "</td>";
                    echo "<td class='px-4 py-2 border border-gray-300'>" . $row['jenis'] . "</td>";
                    echo "<td class='px-4 py-2 border border-gray-300'>" . $row['deskripsi'] . "</td>";
                    echo "<td class='px-4 py-2 border border-gray-300'>" . $row['tanggal'] . "</td>";
                    echo "<td class='px-4 py-2 border border-gray-300'>";
                    echo "<a href='edit_laporan.php?id=" . $row['id_laporan'] . "' class='text-blue-600 hover:underline'>Edit</a> | ";
                    echo "<a href='hapus_laporan.php?id=" . $row['id_laporan'] . "' class='text-red-600 hover:underline' onclick='return confirm(\"Apakah Anda yakin ingin menghapus laporan ini?\");'>Hapus</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='px-4 py-2 text-center text-gray-500'>Belum ada laporan yang tersedia.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>

      <!-- Form Laporan Fasilitas (Right Side) -->
      <div class="w-1/3 bg-white shadow-md rounded-lg p-6">
        <h3 class="text-xl font-semibold mb-4">Form Laporan</h3>
        <form action="simpan_laporan.php" method="POST">
          <div class="mb-4">
            <label for="kelas" class="block text-sm font-semibold mb-2">Kelas</label>
            <input type="text" id="kelas" name="kelas" class="w-full p-2 border border-gray-300 rounded" required>
          </div>
          <div class="mb-4">
            <label for="jenis" class="block text-sm font-semibold mb-2">Jenis</label>
            <select id="jenis" name="jenis" class="w-full p-2 border border-gray-300 rounded" required>
              <option value="kerusakan">Kerusakan</option>
              <option value="kekurangan">Kekurangan</option>
            </select>
          </div>
          <div class="mb-4">
            <label for="deskripsi" class="block text-sm font-semibold mb-2">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" rows="4" class="w-full p-2 border border-gray-300 rounded" required></textarea>
          </div>
          <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded shadow hover:bg-blue-700">Kirim Laporan</button>
        </form>
      </div>
    </div>
  </div>
  <?php
    require_once "../../layout/footer.php"
  ?>
</body>
</html>
