<?php
include "../../koneksi.php";
session_start();

// Fungsi untuk mengambil daftar kelas untuk percabangan
function getDaftarKelasPercabangan($id_kelas)
{
  global $conn;
  $query = "SELECT tingkat, nama_kelas FROM kelas WHERE id_kelas = '$id_kelas'";
  return mysqli_query($conn, $query);
}

// Fungsi untuk mengambil daftar kelas yang diajar guru
function getDaftarKelas($guru_id)
{
  global $conn;
  $query = "SELECT id_kelas, tingkat, nama_kelas FROM kelas ORDER BY tingkat, nama_kelas";
  return mysqli_query($conn, $query);
}

// Fungsi untuk mengambil daftar siswa berdasarkan kelas
function getDaftarSiswa($kelas_id)
{
  global $conn;
  $query = "SELECT id_siswa, nama_lengkap, nis FROM siswa WHERE kelas_id = '$kelas_id' ORDER BY nama_lengkap";
  return mysqli_query($conn, $query);
}

// Fungsi untuk menyimpan pelanggaran
function simpanPelanggaran($data)
{
  global $conn;

  // Ambil ID guru dari sesi
  $guru_id = $_SESSION['guru_id'];

  // Ambil ID kelas yang dipilih
  $kelas_id = $data['kelas'];

  // Ambil ID siswa yang dipilih
  $query_siswa = "SELECT id_siswa FROM siswa WHERE nis = '" . $data['siswa'] . "'";
  $result_siswa = mysqli_query($conn, $query_siswa);
  $siswa = mysqli_fetch_assoc($result_siswa);
  $siswa_id = $siswa['id_siswa'];

  // Escape dan filter input
  $deskripsi = mysqli_real_escape_string($conn, $data['deskripsi']);
  $poin = intval($data['poin']);
  $tanggal = mysqli_real_escape_string($conn, $data['tanggal']);

  // Query untuk menyimpan pelanggaran
  $query = "INSERT INTO pelanggaran (
        id_kelas, 
        siswa_id, 
        deskripsi, 
        poin, 
        tanggal_pelanggaran
    ) VALUES (
        '$kelas_id', 
        '$siswa_id', 
        '$deskripsi', 
        $poin, 
        '$tanggal'
    )";

  return mysqli_query($conn, $query);
}

// Fungsi untuk mengambil riwayat pelanggaran dengan nama guru wali
function getRiwayatPelanggaran($nama_siswa = '', $kelas = '') {
  global $conn;
  $conditions = [];
  if ($nama_siswa) {
      $nama_siswa = mysqli_real_escape_string($conn, $nama_siswa);
      $conditions[] = "s.nama_lengkap LIKE '%$nama_siswa%'";
  }
  if ($kelas) {
      $conditions[] = "k.id_kelas = '$kelas'";
  }

  $where_clause = $conditions ? 'WHERE ' . implode(' AND ', $conditions) : '';
  $query = "SELECT 
              p.id_pelanggaran,
              s.nama_lengkap AS nama_siswa,
              CONCAT(k.tingkat, ' ', k.nama_kelas) AS nama_kelas,
              IFNULL(g.nama_lengkap, 'Tidak Ada Guru Wali') AS nama_guru_wali,
              p.poin AS poin_terbaru,
              p.tanggal_pelanggaran,
              p.deskripsi,
              (
                  SELECT SUM(p2.poin) 
                  FROM pelanggaran p2
                  WHERE p2.siswa_id = s.id_siswa
              ) AS total_poin
            FROM pelanggaran p
            JOIN siswa s ON p.siswa_id = s.id_siswa
            JOIN kelas k ON p.id_kelas = k.id_kelas
            LEFT JOIN guru g ON k.wali_kelas_id = g.id_guru
            $where_clause
            ORDER BY p.tanggal_pelanggaran DESC";

  return mysqli_query($conn, $query);
}

// hapus pelanggaran
function hapusPelanggaran($id_pelanggaran) {
  global $conn;
  $id_pelanggaran = mysqli_real_escape_string($conn, $id_pelanggaran);
  $query = "DELETE FROM pelanggaran WHERE id_pelanggaran = '$id_pelanggaran'";
  return mysqli_query($conn, $query);
}

// Proses penyimpanan pelanggaran
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['simpan_pelanggaran'])) {
  if (simpanPelanggaran($_POST)) {
    $sukses = "Pelanggaran berhasil disimpan!";
    header("Location: pelanggaran_siswa.php");
    exit();
  } else {
    $error = "Gagal menyimpan pelanggaran: " . mysqli_error($conn);
  }
}

// Proses penghapusan pelanggaran
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['hapus_pelanggaran'])) {
  $id_pelanggaran = $_POST['id_pelanggaran'];
  if (hapusPelanggaran($id_pelanggaran)) {
      $sukses = "Pelanggaran berhasil dihapus!";
  } else {
      $error = "Gagal menghapus pelanggaran: " . mysqli_error($conn);
  }
}

// Variabel untuk menyimpan pilihan
$selected_kelas = isset($_POST['kelas']) ? $_POST['kelas'] : '';
$nama_siswa = isset($_POST['nama_siswa']) ? $_POST['nama_siswa'] : '';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Input Pelanggaran Siswa</title>
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
  <div class="container mx-auto mt-8 px-4">
    <?php
    if (isset($sukses)) {
      echo "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative' role='alert'>$sukses</div>";
    }
    if (isset($error)) {
      echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative' role='alert'>$error</div>";
    }
    ?>

    <!-- Layout Flex: Left side for form, right side for history -->
    <div class="flex space-x-8">
      <!-- Form Input Pelanggaran (Left Side) -->
      <div class="w-1/3 bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold text-center mb-6">Input Pelanggaran Siswa</h2>

        <form action="" method="POST">
          <div class="mb-4">
            <label for="kelas" class="block text-sm font-semibold mb-2">Kelas</label>
            <select id="kelas" name="kelas" class="w-full p-2 border border-gray-300 rounded" required onchange="this.form.submit()">
              <option value="">Pilih Kelas</option>
              <?php
              $kelas_list = getDaftarKelas($_SESSION['guru_id']);
              while ($row = mysqli_fetch_assoc($kelas_list)) {
                $selected = ($selected_kelas == $row['id_kelas']) ? 'selected' : '';
                echo "<option value='" . $row['id_kelas'] . "' $selected>" . $row["tingkat"] . " " . $row["nama_kelas"] . "</option>";
              }
              ?>
            </select>
          </div>

          <div class="mb-4">
            <label for="siswa" class="block text-sm font-semibold mb-2">Siswa</label>
            <select id="siswa" name="siswa" class="w-full p-2 border border-gray-300 rounded" required>
              <option value="">Pilih Siswa</option>
              <?php
              $siswa_list = getDaftarSiswa($selected_kelas);
              while ($row = mysqli_fetch_assoc($siswa_list)) {
                echo "<option value='" . $row['nis'] . "'>" . $row['nama_lengkap'] . "</option>";
              }
              ?>
            </select>
          </div>

          <div class="mb-4">
            <label for="deskripsi" class="block text-sm font-semibold mb-2">Deskripsi Pelanggaran</label>
            <textarea id="deskripsi" name="deskripsi" rows="4" class="w-full p-2 border border-gray-300 rounded" required></textarea>
          </div>

          <div class="mb-4">
            <label for="poin" class="block text-sm font-semibold mb-2">Poin Pelanggaran</label>
            <input type="number" id="poin" name="poin" class="w-full p-2 border border-gray-300 rounded" required min="1">
          </div>

          <div class="mb-4">
            <label for="tanggal" class="block text-sm font-semibold mb-2">Tanggal Pelanggaran</label>
            <input type="date" id="tanggal" name="tanggal" class="w-full p-2 border border-gray-300 rounded" required value="<?php echo date('Y-m-d'); ?>">
          </div>

          <div class="text-right">
            <button type="submit" name="simpan_pelanggaran" class="bg-blue-600 text-white px-6 py-2 rounded shadow hover:bg-blue-700">Simpan Pelanggaran</button>
          </div>
        </form>
      </div>

      <!-- Riwayat Pelanggaran (Right Side) -->
      <div class="w-2/3 bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold text-center mb-6">Daftar Pelanggaran</h2>

        <!-- Filter untuk Riwayat Pelanggaran -->
        <form method="POST" class="flex items-center space-x-4 mb-6">
          <input type="text" name="nama_siswa" placeholder="Cari siswa..." value="<?= htmlspecialchars($nama_siswa); ?>" class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out">
          <select name="kelas" class="border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out">
            <option value="">Semua Kelas</option>
            <?php
            $kelas_list = getDaftarKelas($_SESSION['guru_id']);
            while ($kelas = mysqli_fetch_assoc($kelas_list)) {
              $selected = isset($_POST['kelas']) && $_POST['kelas'] == $kelas['id_kelas'] ? 'selected' : '';
              echo "<option value='{$kelas['id_kelas']}' $selected>{$kelas['tingkat']} {$kelas['nama_kelas']}</option>";
            }
            ?>
          </select>
          <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow-sm hover:bg-blue-600 transition duration-200 ease-in-out">Filter</button>
        </form>

        <table class="table-auto w-full text-left border-collapse border border-gray-300">
        <thead>
            <tr>
              <th class="px-4 py-2 border border-gray-300 bg-blue-100">NO</th>
              <th class="px-4 py-2 border border-gray-300 bg-blue-100">Kelas</th>
              <th class="px-4 py-2 border border-gray-300 bg-blue-100">Siswa</th>
              <th class="px-4 py-2 border border-gray-300 bg-blue-100">Guru Wali</th>
              <th class="px-4 py-2 border border-gray-300 bg-blue-100">Deskripsi</th>
              <th class="px-4 py-2 border border-gray-300 bg-blue-100">Poin</th>
              <th class="px-4 py-2 border border-gray-300 bg-blue-100">Tanggal</th>
              <th class="px-4 py-2 border border-gray-300 bg-blue-100">Total Poin</th>
              <th class="px-4 py-2 border border-gray-300 bg-blue-100">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $riwayat = getRiwayatPelanggaran($nama_siswa, $selected_kelas);
            $no = 1;
            while ($row = mysqli_fetch_assoc($riwayat)) {
                echo "<tr>";
                echo "<td class='px-4 py-2 border border-gray-300'>" . $no++ . "</td>";
                echo "<td class='px-4 py-2 border border-gray-300'>" . $row['nama_kelas'] . "</td>";
                echo "<td class='px-4 py-2 border border-gray-300'>" . $row['nama_siswa'] . "</td>";
                echo "<td class='px-4 py-2 border border-gray-300'>" . $row['nama_guru_wali'] . "</td>";
                echo "<td class='px-4 py-2 border border-gray-300'>" . $row['deskripsi'] . "</td>";
                echo "<td class='px-4 py-2 border border-gray-300'>" . $row['poin_terbaru'] . "</td>";
                echo "<td class='px-4 py-2 border border-gray-300'>" . $row['tanggal_pelanggaran'] . "</td>";
                echo "<td class='px-4 py-2 border border-gray-300'>" . $row['total_poin'] . "</td>";
                echo "<td class='px-4 py-2 border border-gray-300'>
                        <form method='POST' onsubmit='return confirm(\"Apakah Anda yakin ingin menghapus pelanggaran ini?\");'>
                            <input type='hidden' name='id_pelanggaran' value='" . $row['id_pelanggaran'] . "'>
                            <button type='submit' name='hapus_pelanggaran' class='bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition duration-200'>
                                Hapus
                            </button>
                        </form>
                      </td>";
                echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <?php
  require_once "../../layout/footer.php"
  ?>
</body>

</html>
