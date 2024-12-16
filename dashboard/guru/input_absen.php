<?php
include "../../koneksi.php";
session_start();

// Fungsi untuk mengambil daftar kelas yang diajar guru
function getDaftarKelas($guru_id) {
    global $conn;
    // Modifikasi query untuk mengambil kelas yang spesifik untuk guru
    $query = "SELECT DISTINCT kelas.* FROM kelas 
              JOIN jadwal ON kelas.id_kelas = jadwal.kelas_id 
              WHERE jadwal.guru_id = $guru_id";
    return mysqli_query($conn, $query);
}

// Fungsi untuk mengambil mata pelajaran guru
function getMataPelajaranGuru($guru_id) {
    global $conn;
    $query = "SELECT DISTINCT mata_pelajaran.nama_pelajaran 
              FROM mata_pelajaran 
              JOIN jadwal ON mata_pelajaran.id_mata_pelajaran = jadwal.mata_pelajaran_id 
              WHERE jadwal.guru_id = $guru_id";
    return mysqli_query($conn, $query);
}

// Fungsi untuk mengambil daftar murid berdasarkan kelas
function getDaftarMurid($kelas) {
    global $conn;
    $query = "SELECT * FROM siswa WHERE kelas_id = '$kelas' ORDER BY nama_lengkap";
    return mysqli_query($conn, $query);
}

// Fungsi untuk mengambil riwayat absensi
function getRiwayatAbsensi($guru_id) {
    global $conn;
    $query = "SELECT DISTINCT a.*, k.tingkat, k.nama_kelas, mp.nama_pelajaran 
              FROM absensi a
              JOIN kelas k ON a.kelas_id = k.id_kelas
              JOIN jadwal j ON k.id_kelas = j.kelas_id
              JOIN mata_pelajaran mp ON a.mata_pelajaran = mp.nama_pelajaran
              WHERE j.guru_id = $guru_id
              ORDER BY a.tanggal DESC";
    return mysqli_query($conn, $query);
}

// Ambil ID guru dari sesi
$guru_id = $_SESSION['guru_id'];

// Variabel untuk menyimpan pilihan
$selected_kelas = isset($_POST['kelas']) ? $_POST['kelas'] : '';
$selected_mapel = isset($_POST['mata_pelajaran']) ? $_POST['mata_pelajaran'] : '';
$selected_tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Input Absensi Siswa</title>
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
    <h2 class="text-2xl font-bold text-center mb-6">Input Absensi Siswa</h2>

    <!-- Layout Flex: Left side for form, right side for student list -->
    <div class="flex space-x-8">
      <!-- Form Input Absensi (Left Side) -->
      <div class="w-1/3 bg-white shadow-md rounded-lg p-6">
        <h3 class="text-xl font-semibold mb-4">Pilih Kelas dan Mata Pelajaran</h3>
        <form action="" method="POST">
          <div class="mb-4">
            <label for="kelas" class="block text-sm font-semibold mb-2">Kelas</label>
            <select id="kelas" name="kelas" class="w-full p-2 border border-gray-300 rounded" required onchange="this.form.submit()">
              <option value="">Pilih Kelas</option>
              <?php 
              $kelas_list = getDaftarKelas($guru_id);
              while ($row = mysqli_fetch_assoc($kelas_list)) {
                  $selected = ($selected_kelas == $row['id_kelas']) ? 'selected' : '';
                  echo "<option value='" . $row['id_kelas'] . "' $selected>" . $row['tingkat'] . " " . $row["nama_kelas"] . "</option>";
              }
              ?>
            </select>
          </div>

          <?php if ($selected_kelas): ?>
          <div class="mb-4">
            <label for="mata_pelajaran" class="block text-sm font-semibold mb-2">Mata Pelajaran</label>
            <select id="mata_pelajaran" name="mata_pelajaran" class="w-full p-2 border border-gray-300 rounded" required onchange="this.form.submit()">
              <option value="">Pilih Mata Pelajaran</option>
              <?php 
              $mapel_list = getMataPelajaranGuru($guru_id);
              while ($row = mysqli_fetch_assoc($mapel_list)) {
                  $selected = ($selected_mapel == $row['nama_pelajaran']) ? 'selected' : '';
                  echo "<option value='" . $row['nama_pelajaran'] . "' $selected>" . $row['nama_pelajaran'] . "</option>";
              }
              ?>
            </select>
          </div>
          <div class="mb-4">
            <label for="tanggal" class="block text-sm font-semibold mb-2">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" value="<?php echo $selected_tanggal; ?>" 
                   class="w-full p-2 border border-gray-300 rounded" required onchange="this.form.submit()">
          </div>
          <?php endif; ?>
        </form>
      </div>

      <!-- Tabel Daftar Murid (Right Side) -->
      <div class="w-2/3 bg-white shadow-md rounded-lg p-6">
        <?php if ($selected_kelas && $selected_mapel): ?>
        <h3 class="text-xl font-semibold mb-4">Daftar Murid</h3>
        <form action="simpan_absensi.php" method="POST">
          <input type="hidden" name="kelas" value="<?php echo $selected_kelas; ?>">
          <input type="hidden" name="mata_pelajaran" value="<?php echo $selected_mapel; ?>">
          <input type="hidden" name="tanggal" value="<?php echo $selected_tanggal; ?>">
          <table class="table-auto w-full text-left border-collapse border border-gray-300">
            <thead>
              <tr>
                <th class="px-4 py-2 border border-gray-300 bg-blue-100">NO</th>
                <th class="px-4 py-2 border border-gray-300 bg-blue-100">Nama</th>
                <th class="px-4 py-2 border border-gray-300 bg-blue-100">NISN</th>
                <th class="px-4 py-2 border border-gray-300 bg-blue-100">Mata Pelajaran</th>
                <th class="px-4 py-2 border border-gray-300 bg-blue-100">Status Absensi</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $daftar_murid = getDaftarMurid($selected_kelas);
              $no = 1;
              while ($row = mysqli_fetch_assoc($daftar_murid)) {
                  echo "<tr>";
                  echo "<td class='px-4 py-2 border border-gray-300'>" . $no++ . "</td>";
                  echo "<td class='px-4 py-2 border border-gray-300'>" . $row['nama_lengkap'] . "</td>";
                  echo "<td class='px-4 py-2 border border-gray-300'>" . $row['nis'] . "</td>";
                  echo "<td class='px-4 py-2 border border-gray-300'>" . $selected_mapel . "</td>";
                  
                  echo "<td class='px-4 py-2 border border-gray-300'>";
                  echo "<select name='absensi[" . $row['nis'] . "]' class='w-full p-1 border border-gray-300 rounded' required>";
                  echo "<option value='hadir'>Hadir</option>";
                  echo "<option value='izin'>Izin</option>";
                  echo "<option value='sakit'>Sakit</option>";
                  echo "<option value='alpa'>Alpa</option>";
                  echo "</select>";
                  echo "</td>";
                  echo "</tr>";
              }
              ?>
            </tbody>
          </table>
          
          <div class="mt-4 text-right">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded shadow hover:bg-blue-700">Simpan Absensi</button>
          </div>
        </form>
        <?php else: ?>
        <p class="text-center text-gray-500">Pilih kelas dan mata pelajaran untuk menampilkan daftar murid.</p>
        <?php endif; ?>
      </div>
    </div>

    <!-- Riwayat Absensi -->
    <div class="mt-8 bg-white shadow-md rounded-lg p-6">
      <h3 class="text-xl font-semibold mb-4">Riwayat Absensi</h3>
      <table class="w-full table-auto border-collapse">
        <thead class="bg-blue-600 text-white">
          <tr>
            <th class="py-2 px-4 border">No</th>
            <th class="py-2 px-4 border">Mata Pelajaran</th>
            <th class="py-2 px-4 border">Kelas</th>
            <th class="py-2 px-4 border">Tanggal</th>
            <th class="py-2 px-4 border">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $riwayat_absensi = getRiwayatAbsensi($guru_id);
          if (mysqli_num_rows($riwayat_absensi) > 0) {
              $no = 1;
              while ($row = mysqli_fetch_assoc($riwayat_absensi)) {
                  echo "<tr>";
                  echo "<td class='py-2 px-4 border text-center'>" . $no++ . "</td>";
                  echo "<td class='py-2 px-4 border'>" . $row['mata_pelajaran'] . "</td>";
                  echo "<td class='py-2 px-4 border text-center'>" . $row['tingkat'] . " " . $row['nama_kelas'] . "</td>";
                  echo "<td class='py-2 px-4 border text-center'>" . $row['tanggal'] . "</td>";
                  echo "<td class='py-2 px-4 border text-center'>";
                  echo "<a href='detail_absensi.php?kelas=" . $row['kelas_id'] . "&mapel=" . urlencode($row['mata_pelajaran']) . "&tanggal=" . $row['tanggal'] . "' 
                          class='bg-blue-500 text-white py-1 px-3 rounded-md text-sm hover:bg-blue-400'>Detail</a>";
                  echo "</td>";
                  echo "</tr>";
              }
          } else {
              echo "<tr><td colspan='5' class='text-center py-2 px-4 border'>Belum ada riwayat absensi.</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Footer -->
  <?php
    require_once "../../layout/footer.php"
  ?>
</body>
</html>