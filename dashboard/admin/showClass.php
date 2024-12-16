<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
  header("Location: ../../login.php");
  exit;
}

// Ambil data kelas dan wali kelas
$query_kelas = "SELECT k.id_kelas, k.nama_kelas, k.tingkat, g.nama_lengkap AS wali_kelas
                FROM kelas k
                LEFT JOIN guru g ON k.wali_kelas_id = g.id_guru";
$result_kelas = mysqli_query($conn, $query_kelas);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tabel Kelas</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800">
  <?php include '../../layout/sidebar.php'; ?>
  <div class="min-h-screen flex flex-col">
    <?php include '../../layout/header.php'; ?>
    <main class="flex-1 container mx-auto px-6 mt-8 pb-12">
      <h1 class="text-3xl font-bold mb-6">Tabel Kelas</h1>
      <a href="tampilanGuru.php" class="bg-blue-700 text-white py-2 px-4 mb-4 rounded hover:bg-blue-500">Kembali</a>

      <!-- Tabel Kelas -->
      <div class="mt-6">
        <table class="table-auto w-full border-collapse bg-white shadow-md rounded-lg overflow-hidden">
          <thead class="bg-blue-600 text-white">
            <tr>
              <th class="px-4 py-2">No</th>
              <th class="px-4 py-2">Kelas</th>
              <th class="px-4 py-2">Wali Kelas</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $count = 1;
            while ($row = mysqli_fetch_assoc($result_kelas)) :
            ?>
              <tr class="border-b hover:bg-gray-100">
                <td class="px-4 py-2 bg-gray-100 text-gray-800"><?= htmlspecialchars($count++) ?></td>
                <td class="px-4 py-2 bg-gray-100 text-gray-800"><?= htmlspecialchars($row['tingkat'] . ' ' . $row['nama_kelas']) ?></td>
                <td class="px-4 py-2 <?= $row['wali_kelas'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                  <?= $row['wali_kelas'] ? htmlspecialchars($row['wali_kelas']) : 'Tidak Ada Wali Kelas' ?>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</body>

</html>