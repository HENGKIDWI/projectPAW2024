<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

// Mengambil ID guru yang sedang login dari session
$guru_id = $_SESSION['guru_id'];

// Variabel filter yang digunakan
$filter_hari = isset($_POST['hari']) ? $_POST['hari'] : '';

// Fungsi untuk mengambil jadwal mengajar berdasarkan guru_id dan filter hari
function getJadwalMengajar($guru_id, $filter_hari) {
    global $conn;

    // Membuat query dengan filter hari
    $query = "SELECT j.id_jadwal, j.hari, j.jam_mulai, j.jam_selesai, mp.nama_pelajaran, k.nama_kelas, k.tingkat
              FROM jadwal AS j
              JOIN mata_pelajaran AS mp ON j.mata_pelajaran_id = mp.id_mata_pelajaran
              JOIN kelas AS k ON j.kelas_id = k.id_kelas
              WHERE j.guru_id = '$guru_id'";

    if ($filter_hari != '') {
        $query .= " AND j.hari = '$filter_hari'";
    }

    $query .= " ORDER BY j.hari, j.jam_mulai";

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
      <!-- Filter Form -->
      <form method="POST" action="" class="mb-6">
        <div class="flex items-center space-x-4">
          <div>
            <select name="hari" id="hari" class="p-2 border rounded w-40">
              <option value="" selected disabled>-- Pilih Hari --</option>
              <option value="Senin" <?php echo $filter_hari == 'Senin' ? 'selected' : ''; ?>>Senin</option>
              <option value="Selasa" <?php echo $filter_hari == 'Selasa' ? 'selected' : ''; ?>>Selasa</option>
              <option value="Rabu" <?php echo $filter_hari == 'Rabu' ? 'selected' : ''; ?>>Rabu</option>
              <option value="Kamis" <?php echo $filter_hari == 'Kamis' ? 'selected' : ''; ?>>Kamis</option>
              <option value="Jumat" <?php echo $filter_hari == 'Jumat' ? 'selected' : ''; ?>>Jumat</option>
              <option value="Sabtu" <?php echo $filter_hari == 'Sabtu' ? 'selected' : ''; ?>>Sabtu</option>
            </select>
          </div>
          <div>
            <button type="submit" class="bg-blue-600 text-white p-2 rounded w-32">Filter</button>
          </div>
        </div>
      </form>
      <table class="table-auto w-full text-left border-collapse border border-gray-300">
        <thead>
          <tr>
            <th class="px-4 py-2 border border-gray-300 bg-blue-100">No</th>
            <th class="px-4 py-2 border border-gray-300 bg-blue-100">Hari</th>
            <th class="px-4 py-2 border border-gray-300 bg-blue-100">Jam Mengajar</th>
            <th class="px-4 py-2 border border-gray-300 bg-blue-100">Mata Pelajaran</th>
            <th class="px-4 py-2 border border-gray-300 bg-blue-100">Kelas</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $result = getJadwalMengajar($guru_id, $filter_hari);
          if (mysqli_num_rows($result) > 0) {
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              echo "<td class='px-4 py-2 border border-gray-300'>" . $no++ . "</td>";
              echo "<td class='px-4 py-2 border border-gray-300'>" . $row['hari'] . "</td>";
              echo "<td class='px-4 py-2 border border-gray-300'>" . $row['jam_mulai'] . " - " . $row['jam_selesai'] . "</td>";
              echo "<td class='px-4 py-2 border border-gray-300'>" . $row['nama_pelajaran'] . "</td>";
              echo "<td class='px-4 py-2 border border-gray-300'>" . $row["tingkat"] . $row['nama_kelas'] . "</td>";
              echo "</tr>";
            }
          } else {
              echo "<tr><td colspan='5' class='px-4 py-2 border border-gray-300 text-center'>Tidak ada jadwal mengajar untuk saat ini.</td></tr>";
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
