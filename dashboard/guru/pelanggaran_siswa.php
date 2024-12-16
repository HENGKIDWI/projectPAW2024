<?php
include "../../koneksi.php";
session_start();

// Fungsi untuk mengambil daftar kelas yang diajar guru
function getDaftarKelas($guru_id) {
    global $conn;
    $query = "SELECT * FROM kelas";
    return mysqli_query($conn, $query);
}

// Fungsi untuk mengambil daftar siswa berdasarkan kelas
function getDaftarSiswa($kelas_id) {
    global $conn;
    $query = "SELECT id_siswa, nama_lengkap, nis FROM siswa WHERE kelas_id = '$kelas_id' ORDER BY nama_lengkap";
    return mysqli_query($conn, $query);
}

// Fungsi untuk menyimpan pelanggaran
function simpanPelanggaran($data) {
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
function getRiwayatPelanggaran() {
  global $conn;
  $query = "SELECT 
          k.tingkat, 
          k.nama_kelas, 
          s.nama_lengkap AS nama_siswa, 
          g.nama_lengkap AS nama_guru_wali, 
          SUM(p.poin) AS total_poin, 
          MAX(p.tanggal_pelanggaran) AS tanggal_pelanggaran
      FROM pelanggaran p
      JOIN kelas k ON p.id_kelas = k.id_kelas
      JOIN siswa s ON p.siswa_id = s.id_siswa
      LEFT JOIN guru g ON k.wali_kelas_id = g.id_guru
      GROUP BY s.id_siswa, k.id_kelas
      ORDER BY tanggal_pelanggaran DESC;
      ";
  $result = mysqli_query($conn, $query);
  
  if (!$result) {
      die("Query Error: " . mysqli_error($conn));
  }
  
  return $result;
}


// Proses penyimpanan pelanggaran
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['simpan_pelanggaran'])) {
    if (simpanPelanggaran($_POST)) {
        $sukses = "Pelanggaran berhasil disimpan!";
    } else {
        $error = "Gagal menyimpan pelanggaran: " . mysqli_error($conn);
    }
}

// Variabel untuk menyimpan pilihan
$selected_kelas = isset($_POST['kelas']) ? $_POST['kelas'] : '';
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
                  echo "<option value='" . $row['id_kelas'] . "' $selected>" . $row['tingkat'] . " " . $row["nama_kelas"] . "</option>";
              }
              ?>
            </select>
          </div>

          <?php if ($selected_kelas): ?>
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
          <?php endif; ?>
        </form>
      </div>

      <!-- Riwayat Pelanggaran (Right Side) -->
      <div class="w-2/3 bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold text-center mb-6">Riwayat Pelanggaran</h2>
        
        <table class="table-auto w-full text-left border-collapse border border-gray-300">
          <thead>
            <tr>
              <th class="px-4 py-2 border border-gray-300 bg-blue-100">NO</th>
              <th class="px-4 py-2 border border-gray-300 bg-blue-100">Kelas</th>
              <th class="px-4 py-2 border border-gray-300 bg-blue-100">Siswa</th>
              <th class="px-4 py-2 border border-gray-300 bg-blue-100">Guru Wali</th>
              <th class="px-4 py-2 border border-gray-300 bg-blue-100">Poin</th>
              <th class="px-4 py-2 border border-gray-300 bg-blue-100">Tanggal</th>
              <th class="px-4 py-2 border border-gray-300 bg-blue-100">Total Poin</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $riwayat = getRiwayatPelanggaran();
            $no = 1;
            while ($row = mysqli_fetch_assoc($riwayat)) {
                echo "<tr>";
                echo "<td class='px-4 py-2 border border-gray-300'>" . $no++ . "</td>";
                echo "<td class='px-4 py-2 border border-gray-300'>" . $row['tingkat'] . " " . $row['nama_kelas'] . "</td>";
                echo "<td class='px-4 py-2 border border-gray-300'>" . $row['nama_siswa'] . "</td>";
                echo "<td class='px-4 py-2 border border-gray-300'>" . $row['nama_guru_wali'] . "</td>";
                echo "<td class='px-4 py-2 border border-gray-300'>" . $row['poin'] . "</td>";
                echo "<td class='px-4 py-2 border border-gray-300'>" . $row['tanggal_pelanggaran'] . "</td>";
                echo "<td class='px-4 py-2 border border-gray-300'>" . $row['total_poin'] . "</td>";
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