<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

// Mengambil ID guru yang sedang login dari session
$guru_id = $_SESSION['guru_id'];

// Fungsi untuk mengambil jadwal mengajar berdasarkan guru_id
function getJadwalMengajar($guru_id) {
    global $conn;
    $query = "SELECT j.id_jadwal, j.hari, j.jam_mulai, j.jam_selesai, mp.nama_pelajaran, k.nama_kelas
              FROM jadwal j
              JOIN mata_pelajaran mp ON j.mata_pelajaran_id = mp.id_mata_pelajaran
              JOIN kelas k ON j.kelas_id = k.id_kelas
              WHERE j.guru_id = '$guru_id'
              ORDER BY j.hari, j.jam_mulai";

    return mysqli_query($conn, $query);
}

$nama_guru = $_SESSION['nama_lengkap'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jadwal Mengajar</title>
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
    <h2 class="text-2xl font-bold text-center mb-6">Jadwal Mengajar Anda</h2>

    <!-- Tabel Jadwal Mengajar -->
    <div class="bg-white shadow-md rounded-lg p-6 overflow-x-auto">
      <table class="table-auto w-full text-left border-collapse border border-gray-300">
        <thead>
          <tr>
            <th class="px-4 py-2 border border-gray-300 bg-blue-100">No</th>
            <th class="px-4 py-2 border border-gray-300 bg-blue-100">Hari</th>
            <th class="px-4 py-2 border border-gray-300 bg-blue-100">Jam Mulai</th>
            <th class="px-4 py-2 border border-gray-300 bg-blue-100">Jam Selesai</th>
            <th class="px-4 py-2 border border-gray-300 bg-blue-100">Mata Pelajaran</th>
            <th class="px-4 py-2 border border-gray-300 bg-blue-100">Kelas</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $result = getJadwalMengajar($guru_id);
          if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                  echo "<tr>";
                  echo "<td class='px-4 py-2 border border-gray-300'>" . $row['id_jadwal'] . "</td>";
                  echo "<td class='px-4 py-2 border border-gray-300'>" . $row['hari'] . "</td>";
                  echo "<td class='px-4 py-2 border border-gray-300'>" . $row['jam_mulai'] . "</td>";
                  echo "<td class='px-4 py-2 border border-gray-300'>" . $row['jam_selesai'] . "</td>";
                  echo "<td class='px-4 py-2 border border-gray-300'>" . $row['nama_pelajaran'] . "</td>";
                  echo "<td class='px-4 py-2 border border-gray-300'>" . $row['nama_kelas'] . "</td>";
                  echo "</tr>";
              }
          } else {
              echo "<tr><td colspan='6' class='px-4 py-2 border border-gray-300 text-center'>Tidak ada jadwal mengajar untuk saat ini.</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <?php
    require_once "../../layout/footer.php";
  ?>
</body>
</html>
