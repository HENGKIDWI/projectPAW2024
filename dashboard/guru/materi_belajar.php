<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

$nama_guru = $_SESSION['guru_id'];

// Fungsi untuk mendapatkan tingkat kelas
function getTingkatKelas() {
    global $conn;
    $query = "SELECT DISTINCT tingkat FROM kelas";
    return mysqli_query($conn, $query);
}

// Fungsi untuk mendapatkan semua data kelas
function getAllKelas() {
    global $conn;
    $query = "SELECT id_kelas, tingkat, nama_kelas FROM kelas";
    return mysqli_query($conn, $query);
}

// Ambil semua tingkat dan kelas
$tingkat_list = getTingkatKelas();
$kelas_list = getAllKelas();

// Proses untuk menyimpan data ke database
if (isset($_POST["kirim"])) {
    $judul = mysqli_real_escape_string($conn, $_POST["judul"]);
    $deskripsi = mysqli_real_escape_string($conn, $_POST["deskripsi"]);
    $tingkat_kelas = mysqli_real_escape_string($conn, $_POST["tingkat_kelas"]);
    $kelas_id = mysqli_real_escape_string($conn, $_POST["kelas"]);
    $mata_pelajaran_id = mysqli_real_escape_string($conn, $_POST["mata_pelajaran_id"]);
    $link_yt = mysqli_real_escape_string($conn, $_POST["link_yt"]);
    $file_path = "";

    // Proses upload file
    if (isset($_FILES["file_pdf"]) && $_FILES["file_pdf"]["error"] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES["file_pdf"]["tmp_name"];
        $file_name = $_FILES["file_pdf"]["name"];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if ($file_ext === "pdf") {
            $upload_dir = "../../uploads/materi/";
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            $file_path = $upload_dir . time() . "_" . $file_name;

            if (move_uploaded_file($file_tmp, $file_path)) {
                $file_path = str_replace("../../", "", $file_path); // Simpan path relatif
            } else {
                echo "<script>alert('Gagal mengupload file PDF!');</script>";
                exit;
            }
        } else {
            echo "<script>alert('File harus berupa PDF!');</script>";
            exit;
        }
    }

    // Query untuk menyimpan data
    $tanggal_upload = date("Y-m-d H:i:s");
    $query_insert = "
        INSERT INTO materi (judul, deskripsi, link_yt, file_path, kelas_id, mata_pelajaran_id, id_guru, tanggal_upload, tingkat)
        VALUES ('$judul', '$deskripsi', '$link_yt', '$file_path', '$kelas_id', '$mata_pelajaran_id', '$nama_guru', '$tanggal_upload', '$tingkat_kelas')
    ";

    if (mysqli_query($conn, $query_insert)) {
        header("Location: upload_materi.php?status=sukses");
        exit;
    } else {
        echo "<script>alert('Terjadi kesalahan saat menyimpan data ke database: " . mysqli_error($conn) . "');</script>";
    }
}

// Fungsi untuk mendapatkan riwayat materi
function getRiwayatMateri() {
    global $conn, $nama_guru;
    $query = "SELECT * FROM materi WHERE id_guru = '$nama_guru' ORDER BY tanggal_upload DESC";
    return mysqli_query($conn, $query);
}

$riwayat_materi = getRiwayatMateri();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upload Materi Belajar</title>
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
  <div class="container mx-auto mt-8 px-4">
    <h2 class="text-center text-3xl font-semibold mb-6">Upload Materi Belajar</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Riwayat Materi (Sebelah Kiri) -->
      <div>
        <h2 class="text-2xl font-semibold mb-4">Riwayat Materi</h2>
        <div class="grid grid-cols-1 gap-6">
          <?php while ($row = mysqli_fetch_assoc($riwayat_materi)) : ?>
            <div class="bg-white shadow-md rounded-lg p-4">
              <h3 class="text-lg font-semibold"><?= $row['judul'] ?></h3>
              <p class="text-sm text-gray-600 mb-2">Tanggal Upload: <?= $row['tanggal_upload'] ?></p>
              <p class="text-sm mb-2">Deskripsi: <?= $row['deskripsi'] ?></p>
              <a href="../../<?= $row['file_path'] ?>" class="text-blue-600" target="_blank">Download PDF</a>
              <?php if (!empty($row['link_yt'])) : ?>
                <p><a href="<?= $row['link_yt'] ?>" class="text-blue-600" target="_blank">Lihat Video</a></p>
              <?php endif; ?>
            </div>
          <?php endwhile; ?>
        </div>
      </div>

      <!-- Form Upload Materi (Sebelah Kanan) -->
      <div>
        <div class="bg-white shadow-md rounded-lg p-6">
          <form action="#" method="POST" enctype="multipart/form-data">
            <div class="mb-4">
              <label for="judul" class="block text-sm font-medium text-gray-700">Judul Materi</label>
              <input type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" id="judul" name="judul" required>
            </div>
            <div class="mb-4">
              <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
              <textarea class="mt-1 block w-full p-2 border border-gray-300 rounded-md" id="deskripsi" name="deskripsi" rows="3" required></textarea>
            </div>
            <div class="mb-4">
              <label for="tingkat_kelas" class="block text-sm font-medium text-gray-700">Tingkat Kelas</label>
              <select id="tingkat_kelas" name="tingkat_kelas" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                <option value="">-- Pilih Tingkat --</option>
                <?php while ($row = mysqli_fetch_assoc($tingkat_list)) : ?>
                  <option value="<?= $row['tingkat'] ?>"><?= $row['tingkat'] ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="mb-4">
              <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
              <select id="kelas" name="kelas" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                <option value="">-- Pilih Kelas --</option>
                <?php while ($row = mysqli_fetch_assoc($kelas_list)) : ?>
                  <option value="<?= $row['id_kelas'] ?>" data-tingkat="<?= $row['tingkat'] ?>"><?= $row['nama_kelas'] ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="mb-4">
              <label for="mata_pelajaran_id" class="block text-sm font-medium text-gray-700">Mata Pelajaran</label>
              <input type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" id="mata_pelajaran_id" name="mata_pelajaran_id" required>
            </div>
            <div class="mb-4">
              <label for="link_yt" class="block text-sm font-medium text-gray-700">Link YouTube</label>
              <input type="url" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" id="link_yt" name="link_yt" placeholder="https://youtube.com/example (opsional)">
            </div>
            <div class="mb-4">
              <label for="file_pdf" class="block text-sm font-medium text-gray-700">File</label>
              <input type="file" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" id="file_pdf" name="file_pdf" accept="application/pdf">
            </div>
            <button type="submit" name="kirim" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md">Upload Materi</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const tingkatKelasSelect = document.getElementById("tingkat_kelas");
      const kelasSelect = document.getElementById("kelas");

      tingkatKelasSelect.addEventListener("change", function () {
        const selectedTingkat = this.value;

        // Tampilkan hanya opsi yang sesuai dengan tingkat yang dipilih
        Array.from(kelasSelect.options).forEach(option => {
          if (option.getAttribute("data-tingkat") === selectedTingkat || option.value === "") {
            option.style.display = "block";
          } else {
            option.style.display = "none";
          }
        });

        // Reset pilihan kelas
        kelasSelect.value = "";
      });
    });
  </script>
</body>
</html>
