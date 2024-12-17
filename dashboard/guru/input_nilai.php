<?php
include "../../koneksi.php";
session_start();

// Fungsi untuk mengambil daftar kelas
function getDaftarKelas()
{
  global $conn;
  $query = "SELECT * FROM kelas";
  return mysqli_query($conn, $query);
}

// Fungsi untuk mengambil daftar tugas berdasarkan kelas
function getDaftarTugas($kelas)
{
  global $conn;
  $query = "SELECT * FROM tugas WHERE kelas_id = '$kelas'";
  return mysqli_query($conn, $query);
}

// Fungsi untuk mengambil daftar murid berdasarkan kelas
function getDaftarMurid($kelas)
{
  global $conn;
  $query = "SELECT * FROM siswa WHERE kelas_id = '$kelas' ORDER BY nama_lengkap";
  return mysqli_query($conn, $query);
}

// Fungsi untuk mengambil data pengumpulan tugas
function getPengumpulan($id_siswa, $id_tugas)
{
  global $conn;
  $query = "SELECT file_tugas, status_pengumpulan FROM pengumpulan_tugas 
            WHERE id_siswa = '$id_siswa' AND id_tugas = '$id_tugas'";
  return mysqli_query($conn, $query);
}

// Menghitung siswa yang sudah mengumpulkan
function hitungPengumpulan($kelas, $tugas)
{
  global $conn;

  // Total siswa di kelas
  $query_total = "SELECT COUNT(*) as total FROM siswa WHERE kelas_id = '$kelas'";
  $total_murid = mysqli_fetch_assoc(mysqli_query($conn, $query_total))['total'];

  // Siswa yang sudah mengumpulkan
  $query_sudah = "SELECT COUNT(DISTINCT pt.id_siswa) as total 
  FROM pengumpulan_tugas pt 
  JOIN siswa s ON pt.id_siswa = s.id_siswa 
  WHERE s.kelas_id = '$kelas' AND pt.id_tugas = '$tugas'";
  $sudah_dikumpulkan = mysqli_fetch_assoc(mysqli_query($conn, $query_sudah))['total'];

  $belum_dikumpulkan = $total_murid - $sudah_dikumpulkan;

  return [$sudah_dikumpulkan, $belum_dikumpulkan];
}

// Variabel
$selected_kelas = isset($_POST['kelas']) ? $_POST['kelas'] : '';
$selected_tugas = isset($_POST['tugas']) ? $_POST['tugas'] : '';
$sudah_dikumpulkan = 0;
$belum_dikumpulkan = 0;

if ($selected_kelas && $selected_tugas) {
  list($sudah_dikumpulkan, $belum_dikumpulkan) = hitungPengumpulan($selected_kelas, $selected_tugas);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Input Nilai</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800">
  <!-- Sidebar -->
  <?php include '../../layout/sidebar.php'; ?>

  <!-- Navbar -->
  <header class="bg-blue-600 text-white py-4">
    <?php include '../../layout/header.php'; ?>
  </header>

  <!-- Main Content -->
  <div class="container mx-auto mt-8 px-4">
    <h2 class="text-2xl font-bold text-center mb-6">Input Nilai Siswa</h2>

    <div class="flex space-x-8">
      <!-- Form Pilihan Kelas dan Tugas -->
      <div class="w-1/3 bg-white shadow-md rounded-lg p-6">
        <h3 class="text-xl font-semibold mb-4">Pilih Kelas dan Tugas</h3>
        <!-- Form Pilih Kelas dan Tugas -->
        <form method="POST">
          <div class="mb-4">
            <label>Kelas:</label>
            <select name="kelas" onchange="this.form.submit()" class="border rounded p-2">
              <option value="">Pilih Kelas</option>
              <?php
              $kelas_list = getDaftarKelas();
              while ($row = mysqli_fetch_assoc($kelas_list)) {
                $selected = ($selected_kelas == $row['id_kelas']) ? 'selected' : '';
                echo "<option value='{$row['id_kelas']}' $selected>{$row['tingkat']} {$row['nama_kelas']}</option>";
              }
              ?>
            </select>
          </div>

          <?php if ($selected_kelas): ?>
            <div class="mb-4">
              <label>Tugas:</label>
              <select name="tugas" onchange="this.form.submit()" class="border rounded p-2">
                <option value="">Pilih Tugas</option>
                <?php
                $tugas_list = getDaftarTugas($selected_kelas);
                while ($row = mysqli_fetch_assoc($tugas_list)) {
                  $selected = ($selected_tugas == $row['id_tugas']) ? 'selected' : '';
                  echo "<option value='{$row['id_tugas']}' $selected>{$row['judul']}</option>";
                }
                ?>
              </select>
            </div>
          <?php endif; ?>
        </form>

        <!-- Informasi Pengumpulan -->
        <?php if ($selected_kelas && $selected_tugas): ?>
          <div class="mb-4">
            <span class="text-green-600">Sudah Dikumpulkan: <?= $sudah_dikumpulkan; ?> siswa</span> |
            <span class="text-red-600">Belum Dikumpulkan: <?= $belum_dikumpulkan; ?> siswa</span>
          </div>

          <!-- Tabel Daftar Siswa -->
          <table class="table-auto w-full border-collapse border">
            <thead>
              <tr class="bg-gray-200">
                <th class="border p-2">No</th>
                <th class="border p-2">Nama</th>
                <th class="border p-2">NIS</th>
                <th class="border p-2">File Tugas</th>
                <th class="border p-2">Status</th>
                <th class="border p-2">Nilai</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $daftar_murid = getDaftarMurid($selected_kelas);
              $no = 1;
              while ($murid = mysqli_fetch_assoc($daftar_murid)) {
                $pengumpulan = getPengumpulan($murid['id_siswa'], $selected_tugas);
                $status = 'Belum Dikumpulkan';
                $file_tugas = '-';

                if ($pengumpulan && $row = mysqli_fetch_assoc($pengumpulan)) {
                  $status = $row['status_pengumpulan'];
                  $file_tugas = "<a href='uploads/{$row['file_tugas']}' class='text-blue-500' target='_blank'>Lihat</a>";
                }

                echo "<tr>
                    <td class='border p-2'>$no</td>
                    <td class='border p-2'>{$murid['nama_lengkap']}</td>
                    <td class='border p-2'>{$murid['nis']}</td>
                    <td class='border p-2'>$file_tugas</td>
                    <td class='border p-2'>$status</td>
                    <td class='border p-2'><input type='number' name='nilai[{$murid['id_siswa']}]' min='0' max='100' class='border p-1 w-20'></td>
                  </tr>";
                $no++;
              }
              ?>
            </tbody>
          </table>
        <?php endif; ?>
      </div>
    </div>
</body>

</html>