<?php
include "../../koneksi.php";
session_start();

// Fungsi untuk mengambil laporan fasilitas
function getLaporanFasilitas() {
    global $conn;
    $query = "SELECT l.*, f.nama AS nama_fasilitas 
              FROM laporan_kerusakan AS l
              JOIN fasilitas AS f ON l.fasilitas_id = f.id
              ORDER BY l.tanggal_laporan DESC";
    return mysqli_query($conn, $query);
}

// Fungsi untuk mendapatkan daftar fasilitas
function getDaftarFasilitas() {
    global $conn;
    $query = "SELECT id, nama FROM fasilitas";
    return mysqli_query($conn, $query);
}

$nama_guru = $_SESSION['guru_id'] ?? 'Guest';
$daftar_fasilitas = getDaftarFasilitas();
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
  <header id="header" class="bg-blue-600 text-white py-4">
    <?php include '../../layout/header.php'; ?>
  </header>

  <!-- Main Content -->
  <div id="mainContent" class="container mx-auto mt-8 px-4">
    <h2 class="text-2xl font-bold text-center mb-6">Laporan Kerusakan/Kekurangan Fasilitas</h2>

    <div class="flex space-x-8">
      <!-- Tabel Laporan -->
      <div class="w-2/3 bg-white shadow-md rounded-lg p-6">
        <h3 class="text-lg font-semibold mb-4">Daftar Laporan</h3>
        <table class="table-auto w-full border-collapse border border-gray-300">
          <thead>
            <tr>
              <th class="px-4 py-2 border bg-blue-100">NO</th>
              <th class="px-4 py-2 border bg-blue-100">Fasilitas</th>
              <th class="px-4 py-2 border bg-blue-100">Deskripsi</th>
              <th class="px-4 py-2 border bg-blue-100">Tanggal</th>
              <th class="px-4 py-2 border bg-blue-100">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $laporan = getLaporanFasilitas();
            if (mysqli_num_rows($laporan) > 0) {
                $no = 1;
                while ($row = mysqli_fetch_assoc($laporan)) {
                    echo "<tr>";
                    echo "<td class='px-4 py-2 border'>" . $no++ . "</td>";
                    echo "<td class='px-4 py-2 border'>" . $row['nama_fasilitas'] . "</td>";
                    echo "<td class='px-4 py-2 border'>" . $row['deskripsi'] . "</td>";
                    echo "<td class='px-4 py-2 border'>" . $row['tanggal_laporan'] . "</td>";
                    echo "<td class='px-4 py-2 border'>" . $row['status'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='text-center text-gray-500 py-4'>Belum ada laporan tersedia.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>

      <!-- Form Laporan -->
      <div class="w-1/3 bg-white shadow-md rounded-lg p-6">
        <h3 class="text-lg font-semibold mb-4">Form Laporan</h3>
        <form action="simpan_laporan.php" method="POST">
          <!-- Dropdown Fasilitas -->
          <div class="mb-4">
            <label for="fasilitas" class="block text-sm font-semibold mb-2">Fasilitas</label>
            <select id="fasilitas" name="fasilitas_id" class="w-full p-2 border rounded" required>
              <option value="" disabled selected>-- Pilih Fasilitas --</option>
              <?php while ($fasilitas = mysqli_fetch_assoc($daftar_fasilitas)): ?>
                <option value="<?php echo $fasilitas['id']; ?>">
                  <?php echo $fasilitas['nama']; ?>
                </option>
              <?php endwhile; ?>
            </select>
          </div>
          <!-- Deskripsi -->
          <div class="mb-4">
            <label for="deskripsi" class="block text-sm font-semibold mb-2">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" rows="4" class="w-full p-2 border rounded" required></textarea>
          </div>
          <!-- Submit -->
          <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Kirim Laporan</button>
        </form>
      </div>
    </div>
  </div>

  <?php include "../../layout/footer.php"; ?>
</body>
</html>
