<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

$nama_guru = $_SESSION['guru_id'];

// Mengambil data materi yang akan diedit
if (isset($_GET["id"])) {
    $id_materi = mysqli_real_escape_string($conn, $_GET["id"]);
    $query = "SELECT * FROM materi WHERE id_materi = '$id_materi' AND id_guru = '$nama_guru'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $materi = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Materi tidak ditemukan!'); window.location.href='materi_belajar.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('ID materi tidak ditemukan!'); window.location.href='materi_belajar.php';</script>";
    exit;
}

// Proses edit materi
if (isset($_POST["edit"])) {
    $judul = mysqli_real_escape_string($conn, $_POST["judul"]);
    $deskripsi = mysqli_real_escape_string($conn, $_POST["deskripsi"]);
    $link_yt = mysqli_real_escape_string($conn, $_POST["link_yt"]);
    $file_path = $_POST["file_lama"];  // Tetap gunakan file lama jika tidak ada file baru

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
    $query_update = "
        UPDATE materi
        SET judul = '$judul', deskripsi = '$deskripsi', link_yt = '$link_yt', file_path = '$file_path'
        WHERE id_materi = '$id_materi' AND id_guru = '$nama_guru'
    ";

    if (mysqli_query($conn, $query_update)) {
        header("Location: materi_belajar.php?status=edit_sukses");
        exit;
    } else {
        echo "<script>alert('Terjadi kesalahan saat mengedit materi: " . mysqli_error($conn) . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Materi</title>
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
    <h2 class="text-center text-3xl font-semibold mb-6">Edit Materi</h2>

    <!-- Formulir Edit Materi -->
    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
      <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_materi" value="<?= $materi['id_materi'] ?>">

        <!-- Judul -->
        <div class="mb-4">
          <label for="judul" class="block text-sm font-medium text-gray-700">Judul Materi</label>
          <input type="text" id="judul" name="judul" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" value="<?= $materi['judul'] ?>" required>
        </div>

        <!-- Deskripsi -->
        <div class="mb-4">
          <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Materi</label>
          <textarea id="deskripsi" name="deskripsi" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" rows="4"><?= $materi['deskripsi'] ?></textarea>
        </div>

        <!-- Link YouTube -->
        <div class="mb-4">
          <label for="link_yt" class="block text-sm font-medium text-gray-700">Link YouTube</label>
          <input type="url" id="link_yt" name="link_yt" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" value="<?= $materi['link_yt'] ?>">
        </div>

        <!-- File PDF (opsional) -->
        <div class="mb-4">
          <label for="file_pdf" class="block text-sm font-medium text-gray-700">Unggah PDF (Opsional)</label>
          <input type="file" id="file_pdf" name="file_pdf" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
          <small class="text-gray-500">File PDF lama: <?= $materi['file_path'] ? '<a href="../../' . $materi['file_path'] . '" target="_blank">Lihat File</a>' : 'Tidak ada file' ?></small>
          <input type="hidden" name="file_lama" value="<?= $materi['file_path'] ?>">
        </div>

        <div class="flex justify-between">
          <a href="materi_belajar.php" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Batal</a>
          <button type="submit" name="edit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
