<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

$nama_guru = $_SESSION['guru_id'];

// Fungsi untuk mendapatkan tingkat kelas
function getTingkatKelas(){
  global $conn;
  $query = "SELECT DISTINCT tingkat FROM kelas";
  $tingkat = mysqli_query($conn, $query);
  return $tingkat;
}

// Fungsi untuk mendapatkan daftar kelas berdasarkan tingkat
function getKelas($tingkat){
  global $conn;
  if (isset($_POST['tingkat'])){
    $query = "SELECT id_kelas, nama_kelas FROM kelas WHERE tingkat = '$tingkat' ORDER BY nama_kelas ASC";
    $kelas = mysqli_query($conn, $query);
    return $kelas;
  }
}

// Fungsi untuk mendapatkan daftar siswa berdasarkan kelas
function getDaftarSiswa($kelas){
  global $conn;
  $query = "SELECT * FROM siswa WHERE kelas_id = '$kelas'";
  $siswa = mysqli_query($conn, $query);
  return $siswa;
}


// Fungsi untuk menambahkan data struktur kelas ke database
function tambahStrukturKelas($kelas_id, $siswa_id, $jabatan){
    global $conn;
    // Query untuk insert data ke tabel struktural_kelas
    $query = "INSERT INTO struktural_kelas (id_kelas, siswa_id, jabatan) VALUES ('$kelas_id', '$siswa_id', '$jabatan')";

    // Eksekusi query
    if (mysqli_query($conn, $query)) {
        return true;
    } else {
        return false;
    }
}

if (isset($_POST["kirim"])) {
  $kelas_id = trim($_POST['id_kelas']);
  $siswa_id = trim($_POST['siswa']);
  $jabatan = trim($_POST['jabatan']);

  // Validasi input tidak boleh kosong
  if (!empty($kelas_id) && !empty($siswa_id) && !empty($jabatan)) {
      // Simpan data ke database
      if (tambahStrukturKelas($kelas_id, $siswa_id, $jabatan)) {
          echo "<script>alert('Data struktur kelas berhasil ditambahkan!'); window.location.href='';</script>";
      } else {
          echo "<script>alert('Gagal menambahkan data struktur kelas.');</script>";
      }
  } else {
      echo "<script>alert('Harap isi semua kolom!');</script>";
  }
}

$selectTingkat = isset($_POST['tingkat']) ? $_POST['tingkat'] : '';
$selectKelas = isset($_POST['id_kelas']) ? $_POST['id_kelas'] : '';
$siswa_list = !empty($selectKelas) ? getDaftarSiswa($selectKelas) : [];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Atur Struktur Kelas</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

  <!-- Sidebar -->
  <?php include '../../layout/sidebar.php'; ?>

  <!-- Navbar -->
  <header id="header" class="bg-blue-600 text-white py-4">
    <?php include '../../layout/header.php'; ?>
  </header>

  <!-- Main Content -->
  <div class="container mx-auto mt-6 px-4">
    <h2 class="text-3xl font-semibold text-center mb-6">Atur Struktur Kelas</h2>

    <!-- Form Tambah Struktur Kelas -->
    <div class="bg-white shadow-lg rounded-lg mb-6 p-6">
      <form action="" method="POST">
        <!-- Tingkat Kelas -->
        <div class="mb-4">
            <label for="tingkat" class="block text-sm font-medium text-gray-700">Tingkat : </label>
            <select id="tingkat" name="tingkat" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" onchange="this.form.submit()" required>
              <option value="">-- Pilih Tingkat --</option>
              <?php
              $tingkat_list = getTingkatKelas();
              while ($row = mysqli_fetch_assoc($tingkat_list)) {
                  $selected = ($selectTingkat == $row['tingkat']) ? 'selected' : '';
                  echo "<option value='" . $row['tingkat'] . "' $selected>" . $row['tingkat'] . "</option>";
              }
              ?>
            </select>
        </div>
        <!-- Dropdown Kelas -->
        <div class="mb-4">
          <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas :</label>
          <select id="kelas" name="id_kelas" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" onchange="this.form.submit()" required>
            <option value="">-- Pilih Kelas --</option>
            <?php
            if (!empty($selectTingkat)){
              $kelas_list = getKelas($selectTingkat);
              while ($row = mysqli_fetch_assoc($kelas_list)) {
                $selected = ($selectKelas == $row['id_kelas']) ? 'selected' : '';
                echo "<option value='" . $row['id_kelas'] . "' $selected>" . $row['nama_kelas'] . "</option>";
             }
            }
            ?>
          </select>
        </div>

        <!-- Dropdown Siswa -->
        <div class="mb-4">
          <label for="siswa" class="block text-sm font-medium text-gray-700">Siswa :</label>
          <select id="siswa" name="siswa" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            <option value="">-- Pilih Siswa --</option>
            <?php
            if (!empty($siswa_list)){
              while ($row = mysqli_fetch_assoc($siswa_list)) {
                echo "<option value='" . $row['id_siswa'] . "'>" . $row['nama_lengkap'] . "</option>";
             }
            }
            ?>
          </select>
        </div>

        <div class="mb-4">
          <label for="jabatan" class="block text-sm font-medium text-gray-700">Jabatan</label>
          <input type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" id="jabatan" name="jabatan" required>
        </div>
        
        <button name="kirim" class="w-full py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700">Tambah Struktur</button>
      </form>
    </div>

    <!-- Tabel Struktur Kelas -->
    <div class="bg-white shadow-lg rounded-lg">
      <div class="bg-blue-600 text-white p-4 rounded-t-lg">Struktur Kelas</div>
      <div class="p-4">
        <table class="min-w-full table-auto border-collapse">
          <thead>
            <tr class="text-left border-b">
              <th class="px-4 py-2 text-sm font-medium text-gray-700">No</th>
              <th class="px-4 py-2 text-sm font-medium text-gray-700">Kelas</th>
              <th class="px-4 py-2 text-sm font-medium text-gray-700">Nama</th>
              <th class="px-4 py-2 text-sm font-medium text-gray-700">Jabatan</th>
              <th class="px-4 py-2 text-sm font-medium text-gray-700">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = "SELECT sk.id_struktural, k.tingkat, k.nama_kelas, s.nama_lengkap, sk.jabatan
                FROM struktural_kelas AS sk
                JOIN kelas AS k ON sk.id_kelas = k.id_kelas
                JOIN siswa AS s ON sk.siswa_id = s.id_siswa
                ORDER BY sk.id_struktural DESC";
            $result = mysqli_query($conn, $query);
            $no = 1;
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                $kelas = $row['tingkat'] . $row['nama_kelas'];

                echo "<tr class='border-b'>";
                echo "<td class='px-4 py-2 text-sm'>" . $no++ . "</td>";
                echo "<td class='px-4 py-2 text-sm'>" . $kelas . "</td>";
                echo "<td class='px-4 py-2 text-sm'>" . $row['nama_lengkap'] . "</td>";
                echo "<td class='px-4 py-2 text-sm'>" . $row['jabatan'] . "</td>";
                echo "<td class='px-4 py-2 text-sm'>";
                echo "<a href='edit_struktur.php?id=" . $row['id_struktural'] . "' class='text-yellow-500 hover:text-yellow-700 mr-2'>Edit</a>";
                echo "<a href='hapus_struktur.php?id=" . $row['id_struktural'] . "' class='text-red-500 hover:text-red-700' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");'>Hapus</a>";
                echo "</td>";
                echo "</tr>";
              }
            } else {
                echo "<tr><td colspan='5' class='text-center py-2 text-sm text-gray-700'>Belum ada data struktur kelas.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <?php require_once "../../layout/footer.php" ?>
</body>
</html>
