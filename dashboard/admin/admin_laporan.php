<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

// Fungsi untuk mengambil semua laporan
function getLaporanKerusakan() {
    global $conn;
    $query = "SELECT l.id_laporan, f.nama AS fasilitas, l.deskripsi, l.tanggal_laporan, l.status 
              FROM laporan_kerusakan l 
              JOIN fasilitas f ON l.fasilitas_id = f.id 
              ORDER BY l.tanggal_laporan DESC";
    return mysqli_query($conn, $query);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil ID laporan dan status yang baru dari form
    $laporan_id = $_POST['laporan_id'];
    $status = $_POST['status'];

    // Query untuk memperbarui status laporan
    $query = "UPDATE laporan_kerusakan SET status = '$status' WHERE id_laporan = '$laporan_id'";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Status laporan berhasil diperbarui'); window.location.href = 'admin_laporan.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Laporan Kerusakan Fasilitas</title>
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
    <h2 class="text-2xl font-bold text-center mb-6">Kelola Laporan Kerusakan Fasilitas</h2>

    <div class="w-full bg-white shadow-md rounded-lg p-6">
      <table class="table-auto w-full text-left border-collapse border border-gray-300">
        <thead>
          <tr>
            <th class="px-4 py-2 border border-gray-300 bg-blue-100">No</th>
            <th class="px-4 py-2 border border-gray-300 bg-blue-100">Fasilitas</th>
            <th class="px-4 py-2 border border-gray-300 bg-blue-100">Deskripsi</th>
            <th class="px-4 py-2 border border-gray-300 bg-blue-100">Tanggal Laporan</th>
            <th class="px-4 py-2 border border-gray-300 bg-blue-100">Status</th>
            <th class="px-4 py-2 border border-gray-300 bg-blue-100">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $laporan = getLaporanKerusakan();
          if (mysqli_num_rows($laporan) > 0) {
              $no = 1;
              while ($row = mysqli_fetch_assoc($laporan)) {
                  echo "<tr>";
                  echo "<td class='px-4 py-2 border border-gray-300'>" . $no++ . "</td>";
                  echo "<td class='px-4 py-2 border border-gray-300'>" . $row['fasilitas'] . "</td>";
                  echo "<td class='px-4 py-2 border border-gray-300'>" . $row['deskripsi'] . "</td>";
                  echo "<td class='px-4 py-2 border border-gray-300'>" . $row['tanggal_laporan'] . "</td>";
                  echo "<td class='px-4 py-2 border border-gray-300'>" . $row['status'] . "</td>";
                  echo "<td class='px-4 py-2 border border-gray-300'>
                          <form action='admin_laporan.php' method='POST'>
                            <input type='hidden' name='laporan_id' value='" . $row['id_laporan'] . "'>
                            <select name='status' class='border rounded p-2'>
                              <option value='belum' " . ($row['status'] == 'belum' ? 'selected' : '') . ">Belum</option>
                              <option value='selesai' " . ($row['status'] == 'selesai' ? 'selected' : '') . ">Selesai</option>
                            </select>
                            <button type='submit' class='bg-blue-600 text-white px-4 py-1 rounded ml-2'>Ubah Status</button>
                          </form>
                        </td>";
                  echo "</tr>";
              }
          } else {
              echo "<tr><td colspan='6' class='px-4 py-2 text-center text-gray-500'>Tidak ada laporan yang tersedia.</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php require_once "../../layout/footer.php"; ?>
</body>
</html>
