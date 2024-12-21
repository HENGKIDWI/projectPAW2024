<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

$nama_guru = $_SESSION['guru_id'];

function getMapel(){
  global $conn;
  $query = "SELECT * FROM mata_pelajaran";
  $mapel = mysqli_query($conn, $query);
  return $mapel;
}

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
$mataPelajaran = getMapel();
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
        header("Location: materi_belajar.php?status=sukses");
        exit;
    } else {
        echo "<script>alert('Terjadi kesalahan saat menyimpan data ke database: " . mysqli_error($conn) . "');</script>";
    }
}
// Proses Edit Materi
if (isset($_POST["edit"])) {
  $id_materi = mysqli_real_escape_string($conn, $_POST["id_materi"]);
  $judul = mysqli_real_escape_string($conn, $_POST["judul"]);
  $deskripsi = mysqli_real_escape_string($conn, $_POST["deskripsi"]);
  $tingkat_kelas = mysqli_real_escape_string($conn, $_POST["tingkat_kelas"]);
  $kelas_id = mysqli_real_escape_string($conn, $_POST["kelas"]);
  $mata_pelajaran_id = mysqli_real_escape_string($conn, $_POST["mata_pelajaran_id"]);
  $link_yt = mysqli_real_escape_string($conn, $_POST["link_yt"]);
  $file_path = $_POST["file_lama"];  // Tidak mengubah file jika tidak ada file baru

  // Proses upload file baru jika ada
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

  // Query untuk update materi
  $query_update = "UPDATE materi SET judul = '$judul', deskripsi = '$deskripsi', link_yt = '$link_yt', file_path = '$file_path', kelas_id = '$kelas_id', mata_pelajaran_id = '$mata_pelajaran_id', tingkat = '$tingkat_kelas'
      WHERE id_materi = '$id_materi' AND id_guru = '$nama_guru'";

  if (mysqli_query($conn, $query_update)) {
      header("Location: materi_belajar.php?status=edit_sukses");
      exit;
  } else {
      echo "<script>alert('Terjadi kesalahan saat mengedit data: " . mysqli_error($conn) . "');</script>";
  }
}

// Proses Hapus Materi
if (isset($_GET["hapus"])) {
  $id_materi = mysqli_real_escape_string($conn, $_GET["hapus"]);

  // Ambil path file PDF sebelum menghapus
  $query_file = "SELECT file_path FROM materi WHERE id_materi = '$id_materi' AND id_guru = '$nama_guru'";
  $result_file = mysqli_query($conn, $query_file);
  $file_data = mysqli_fetch_assoc($result_file);
  $file_path = "../../" . $file_data["file_path"];

  // Hapus file PDF jika ada
  if (file_exists($file_path)) {
      unlink($file_path);
  }

  // Hapus data materi dari database
  $query_delete = "DELETE FROM materi WHERE id_materi = '$id_materi' AND id_guru = '$nama_guru'";
  if (mysqli_query($conn, $query_delete)) {
      header("Location: materi_belajar.php?status=hapus_sukses");
      exit;
  } else {
      echo "<script>alert('Terjadi kesalahan saat menghapus data: " . mysqli_error($conn) . "');</script>";
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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
          <div class="bg-white shadow-md rounded-lg p-6">
              <h2 class="text-2xl font-semibold mb-4">Riwayat Materi</h2>
              <div class="grid grid-cols-1 gap-6">
                  <?php if (mysqli_num_rows($riwayat_materi) > 0) : ?>
                      <!-- Menampilkan materi yang diupload -->
                      <?php while ($row = mysqli_fetch_assoc($riwayat_materi)) : ?>
                          <div class="bg-gray-50 shadow-md rounded-lg p-4">
                              <h3 class="text-lg font-semibold"><?= $row['judul'] ?></h3>
                              <p class="text-sm text-gray-600 mb-2">Diupload Pada : <?= $row['tanggal_upload'] ?></p>
                              <p class="text-sm mb-2"><?= $row['deskripsi'] ?></p>
                              
                              <!-- Tampilan Download PDF -->
                              <?php if (!empty($row['file_path'])) : ?>
                                  <div class="mt-2">
                                      <a href="../../<?= $row['file_path'] ?>" class="inline-block py-2 px-4 bg-blue-600 text-white rounded-md shadow-md hover:bg-blue-700" target="_blank">
                                          <i class="fas fa-file-pdf"></i> Download PDF
                                      </a>
                                  </div>
                              <?php endif; ?>

                              <!-- Tampilan Link YouTube -->
                              <?php if (!empty($row['link_yt'])) : ?>
                                  <div class="mt-2">
                                      <a href="<?= $row['link_yt'] ?>" class="inline-block py-2 px-4 bg-red-600 text-white rounded-md shadow-md hover:bg-red-700" target="_blank">
                                          <i class="fab fa-youtube"></i> Lihat Video
                                      </a>
                                  </div>
                              <?php endif; ?>
                              <!-- Edit dan Hapus -->
                              <div class="mt-4">
                                  <a href="edit_materi.php?id=<?= $row['id_materi'] ?>" class="inline-block py-2 px-4 bg-yellow-600 text-white rounded-md shadow-md hover:bg-yellow-700">
                                      <i class="fas fa-edit"></i> Edit
                                  </a>
                                  <a href="?hapus=<?= $row['id_materi'] ?>" class="inline-block py-2 px-4 bg-red-600 text-white rounded-md shadow-md hover:bg-red-700">
                                      <i class="fas fa-trash-alt"></i> Hapus
                                  </a>
                              </div>
                          </div>
                      <?php endwhile; ?>
                  <?php else : ?>
                      <!-- Jika belum ada materi yang diupload -->
                      <p class="text-center text-gray-500">Belum ada materi yang Anda upload.</p>
                  <?php endif; ?>
              </div>
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
              <select name="mata_pelajaran_id" id="mata_pelajaran_id" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                <option value="">-- Pilih Mapel --</option>
                <?php while ($row = mysqli_fetch_assoc($mataPelajaran)) : ?>
                  <option value="<?= $row['id_mata_pelajaran'] ?>"><?= $row['nama_pelajaran']?></option>
                <?php endwhile; ?>
              </select>
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
