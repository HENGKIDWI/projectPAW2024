<?php
include "../../koneksi.php";
session_start();

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

$guru_id = $_SESSION['guru_id']; // Mendapatkan ID guru dari session
$kelas_id = $_GET['id']; // Mengambil id kelas dari URL

// Query untuk mengambil data kelas
$query = "SELECT * FROM ekstrakurikuler WHERE id_ekstrakurikuler = '$kelas_id' AND pembimbing_id = '$guru_id'";
$result = mysqli_query($conn, $query);
$kelas = mysqli_fetch_assoc($result);

if (!$kelas) {
    echo "<p class='text-red-500'>Kelas tidak ditemukan atau Anda tidak memiliki akses ke kelas ini.</p>";
    exit;
}

// Query untuk mengambil siswa yang terdaftar di kelas ini, dengan JOIN untuk tingkat dan kelas
$siswa_query = " SELECT siswa.nama_lengkap, kelas.tingkat, kelas.nama_kelas FROM siswa
    JOIN kelas ON siswa.kelas_id = kelas.id_kelas
    WHERE siswa.ekstra_id = '$kelas_id'";
$siswa_result = mysqli_query($conn, $siswa_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Siswa - Kelas Ekstrakurikuler</title>
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
    <h2 class="text-3xl font-semibold text-center mb-8">Daftar Siswa di Kelas Ekstrakurikuler : <?php echo $kelas['nama_kegiatan']; ?></h2>

    <!-- Daftar Siswa -->
    <div class="bg-white shadow-lg rounded-lg p-6">
      <h3 class="text-xl font-semibold mb-4">Siswa yang Terdaftar</h3>
      <table class="table-auto w-full border-collapse">
        <thead>
          <tr class="text-left bg-gray-100">
            <th class="px-4 py-2 border-b">No</th>
            <th class="px-4 py-2 border-b">Nama Siswa</th>
            <th class="px-4 py-2 border-b">Tingkat</th>
            <th class="px-4 py-2 border-b">Kelas</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          if (mysqli_num_rows($siswa_result) > 0) {
              while ($siswa = mysqli_fetch_assoc($siswa_result)) {
                  echo "<tr>";
                  echo "<td class='px-4 py-2 border-b'>" . $no++ . "</td>";
                  echo "<td class='px-4 py-2 border-b'>" . $siswa['nama_lengkap'] . "</td>";
                  echo "<td class='px-4 py-2 border-b'>" . $siswa['tingkat'] . "</td>";
                  echo "<td class='px-4 py-2 border-b'>" . $siswa['nama_kelas'] . "</td>";
                  echo "</tr>";
              }
          } else {
              echo "<tr><td colspan='3' class='px-4 py-2 text-center text-gray-500'>Belum ada siswa yang terdaftar di kelas ini.</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <?php require_once "../../layout/footer.php"; ?>
</body>
</html>
