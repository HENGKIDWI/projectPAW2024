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

function simpanNilai($id_siswa, $id_tugas, $nilai) {
  global $conn;
  $query = "INSERT INTO penilaian (id_siswa, id_tugas, nilai) 
            VALUES ('$id_siswa', '$id_tugas', '$nilai') 
            ON DUPLICATE KEY UPDATE nilai = '$nilai'";
  return mysqli_query($conn, $query);
}

// Proses penyimpanan nilai jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['simpan_nilai'])) {
  $berhasil = 0;
  $gagal = 0;

  if (isset($_POST['nilai']) && $selected_kelas && $selected_tugas) {
      foreach ($_POST['nilai'] as $id_siswa => $nilai) {
          // Validasi input nilai
          if ($nilai !== '' && is_numeric($nilai) && $nilai >= 0 && $nilai <= 100) {
              if (simpanNilai($id_siswa, $selected_tugas, $nilai)) {
                  $berhasil++;
              } else {
                  $gagal++;
              }
          }
      }
  }
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
  <title>Input Nilai Siswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Custom scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
    }
    ::-webkit-scrollbar-track {
      background: #f1f1f1;
    }
    ::-webkit-scrollbar-thumb {
      background: #888;
      border-radius: 4px;
    }
    ::-webkit-scrollbar-thumb:hover {
      background: #555;
    }
  </style>
</head>

<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">
  <!-- Sidebar -->
  <?php include '../../layout/sidebar.php'; ?>

  <!-- Navbar -->
  <header class="bg-gradient-to-r from-blue-600 to-blue-800 text-white shadow-md py-4">
    <?php include '../../layout/header.php'; ?>
  </header>

  <!-- Main Content -->
  <main class="container mx-auto px-4 py-8 flex-grow">
    <div class="max-w-7xl mx-auto">
      <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">Input Nilai Siswa</h2>

      <div class="grid md:grid-cols-3 gap-8">
        <!-- Form Pilihan Kelas dan Tugas -->
        <div class="md:col-span-1 bg-white shadow-xl rounded-lg p-6 border-t-4 border-blue-500">
          <h3 class="text-xl font-semibold mb-6 text-gray-700">Pilih Kelas dan Tugas</h3>
          
          <!-- Form Pilih Kelas dan Tugas -->
          <form method="POST" class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Kelas:</label>
              <select name="kelas" onchange="this.form.submit()" 
                class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 
                focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                transition duration-200 ease-in-out">
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
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tugas:</label>
                <select name="tugas" onchange="this.form.submit()" 
                  class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 
                  focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                  transition duration-200 ease-in-out">
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
            <div class="mt-6 flex justify-between text-sm">
              <span class="text-green-600 font-semibold">
                Sudah Dikumpulkan: <?= $sudah_dikumpulkan; ?> siswa
              </span>
              <span class="text-red-600 font-semibold">
                Belum Dikumpulkan: <?= $belum_dikumpulkan; ?> siswa
              </span>
            </div>
          <?php endif; ?>
        </div>

        <!-- Tabel Daftar Siswa -->
        <div class="md:col-span-2 bg-white shadow-xl rounded-lg overflow-hidden">
          <?php if ($selected_kelas && $selected_tugas): ?>
            <div class="max-h-[600px] overflow-y-auto">
              <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 sticky top-0">
                  <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File Tugas</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <?php
                  $daftar_murid = getDaftarMurid($selected_kelas);
                  $no = 1;
                  while ($murid = mysqli_fetch_assoc($daftar_murid)) {
                    $pengumpulan = getPengumpulan($murid['id_siswa'], $selected_tugas);
                    $status = 'Belum Dikumpulkan';
                    $file_tugas = '-';

                    if ($pengumpulan && $row = mysqli_fetch_assoc($pengumpulan)) {
                      $status = $row['status_pengumpulan'];
                      $file_tugas = "<a href='uploads/{$row['file_tugas']}' class='text-blue-600 hover:text-blue-800 transition duration-200' target='_blank'>Lihat</a>";
                    }

                    $statusColor = $status == 'Sudah Dikumpulkan' ? 'text-green-600' : 'text-red-600';

                    echo "<tr class='hover:bg-gray-50 transition duration-150'>
                            <td class='px-4 py-3 whitespace-nowrap'>$no</td>
                            <td class='px-4 py-3'>{$murid['nama_lengkap']}</td>
                            <td class='px-4 py-3'>{$murid['nis']}</td>
                            <td class='px-4 py-3'>$file_tugas</td>
                            <td class='px-4 py-3 $statusColor'>$status</td>
                            <td class='px-4 py-3'>
                              <input type='number' 
                                     name='nilai[{$murid['id_siswa']}]' 
                                     min='0' 
                                     max='100' 
                                     class='w-20 border border-gray-300 rounded-md px-2 py-1 
                                            focus:outline-none focus:ring-2 focus:ring-blue-500 
                                            focus:border-blue-500 transition duration-200'>
                            </td>
                          </tr>";
                    $no++;
                  }
                  ?>
                </tbody>
              </table>
              <div class="text-right mt-6">
                    <button type="submit" 
                        class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition duration-300">
                        Save
                    </button>
                </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </main>

  <!-- Optional: Footer -->
  <?php require_once "../../layout/footer.php"; ?>
</body>

</html>