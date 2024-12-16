<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

$nama_guru = $_SESSION['guru_id'];

// Query untuk mendapatkan data kelas
$query_kelas = "SELECT * FROM kelas ORDER BY tingkat, nama_kelas ASC";
$result_kelas = mysqli_query($conn, $query_kelas);
$kelas_list = [];
while ($row = mysqli_fetch_assoc($result_kelas)) {
    $kelas_list[$row['tingkat']][] = $row;
}

// Proses untuk menyimpan data ke database
if (isset($_POST["kirim"])) {
    $judul = mysqli_real_escape_string($conn, $_POST["judul_materi"]);
    $deskripsi = mysqli_real_escape_string($conn, $_POST["deskripsi"]);
    $tingkat_kelas = mysqli_real_escape_string($conn, $_POST["tingkat_kelas"]);
    $kelas_id = mysqli_real_escape_string($conn, $_POST["kelas"]);
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
        INSERT INTO materi (judul, deskripsi, link_yt, file_path, kelas_id, id_guru, tanggal_upload)
        VALUES ('$judul', '$deskripsi', '$link_yt', '$file_path', '$kelas_id', '$nama_guru', '$tanggal_upload')
    ";

    if (mysqli_query($conn, $query_insert)) {
        header("Location: upload_materi.php?status=sukses");
        exit;
    } else {
        echo "<script>alert('Terjadi kesalahan saat menyimpan data ke database: " . mysqli_error($conn) . "');</script>";
    }
}

// Query untuk mendapatkan riwayat upload
$query_riwayat = "SELECT m.id_materi, m.judul, m.deskripsi, m.link_yt, k.nama_kelas, k.tingkat, m.file_path, m.tanggal_upload 
                  FROM materi AS m 
                  JOIN kelas AS k ON m.kelas_id = k.id_kelas
                  WHERE m.id_guru = '$nama_guru'
                  ORDER BY m.tanggal_upload DESC";
$result_riwayat = mysqli_query($conn, $query_riwayat);
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

    <!-- Form Upload Materi -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
      <form action="#" method="POST" enctype="multipart/form-data">
        <div class="mb-4">
          <label for="judul_materi" class="block text-sm font-medium text-gray-700">Judul Materi</label>
          <input type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" id="judul_materi" name="judul_materi" required>
        </div>
        <div class="mb-4">
          <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
          <textarea class="mt-1 block w-full p-2 border border-gray-300 rounded-md" id="deskripsi" name="deskripsi" rows="3" required></textarea>
        </div>
        <div class="mb-4">
          <label for="tingkat_kelas" class="block text-sm font-medium text-gray-700">Tingkat Kelas</label>
          <select id="tingkat_kelas" name="tingkat_kelas" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required onchange="this.form.submit()">
            <option value="">-- Pilih Tingkat --</option>
            <?php while ($row = mysqli_fetch_assoc($result_tingkat)): ?>
              <option value="<?php echo $row['tingkat']; ?>" <?php echo isset($_POST['tingkat_kelas']) && $_POST['tingkat_kelas'] == $row['tingkat'] ? 'selected' : ''; ?>>
                <?php echo $row['tingkat']; ?>
              </option>
            <?php endwhile; ?>
          </select>
        </div>
        <div class="mb-4">
          <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
          <select id="kelas" name="kelas" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            <option value="">-- Pilih Kelas --</option>
            <?php
            if (isset($_POST['tingkat_kelas']) && !empty($_POST['tingkat_kelas'])) {
                $tingkat_kelas_terpilih = $_POST['tingkat_kelas'];
                if (isset($kelas_list[$tingkat_kelas_terpilih])) {
                    foreach ($kelas_list[$tingkat_kelas_terpilih] as $kelas) {
                        echo "<option value='{$kelas['id_kelas']}'>{$kelas['nama_kelas']}</option>";
                    }
                }
            }
            ?>
          </select>
        </div>
        <div class="mb-4">
          <label for="link_yt" class="block text-sm font-medium text-gray-700">Link YouTube</label>
          <input type="url" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" id="link_yt" name="link_yt" placeholder="https://youtube.com/example" required>
        </div>
        <div class="mb-4">
          <label for="file_pdf" class="block text-sm font-medium text-gray-700">File PDF</label>
          <input type="file" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" id="file_pdf" name="file_pdf" accept="application/pdf" required>
        </div>
        <button type="submit" name="kirim" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md">Upload Materi</button>
      </form>
    </div>

    <!-- Riwayat Upload -->
    <div class="bg-white shadow-md rounded-lg p-6">
      <h3 class="text-xl font-semibold mb-4">Riwayat Upload</h3>
      <table class="min-w-full bg-white border border-gray-200">
        <thead>
          <tr>
            <th class="border px-4 py-2">No</th>
            <th class="border px-4 py-2">Judul Materi</th>
            <th class="border px-4 py-2">Deskripsi</th>
            <th class="border px-4 py-2">Tingkat</th>
            <th class="border px-4 py-2">Kelas</th>
            <th class="border px-4 py-2">Link YouTube</th>
            <th class="border px-4 py-2">File PDF</th>
            <th class="border px-4 py-2">Tanggal Upload</th>
          </tr>
        </thead>
        <tbody>
          <?php if (mysqli_num_rows($result_riwayat) > 0): ?>
            <?php $no = 1; while ($row = mysqli_fetch_assoc($result_riwayat)): ?>
              <tr>
                <td class="border px-4 py-2"><?php echo $no++; ?></td>
                <td class="border px-4 py-2"><?php echo $row['judul']; ?></td>
                <td class="border px-4 py-2"><?php echo $row['deskripsi']; ?></td>
                <td class="border px-4 py-2"><?php echo $row['tingkat']; ?></td>
                <td class="border px-4 py-2"><?php echo $row['nama_kelas']; ?></td>
                <td class="border px-4 py-2">
                  <a href="<?php echo $row['link_yt']; ?>" target="_blank" class="text-blue-600">Lihat Video</a>
                </td>
                <td class="border px-4 py-2">
                  <a href="<?php echo $row['file_path']; ?>" target="_blank" class="text-blue-600">Lihat PDF</a>
                </td>
                <td class="border px-4 py-2"><?php echo date('d-m-Y', strtotime($row['tanggal_upload'])); ?></td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr>
              <td colspan="8" class="text-center border px-4 py-2">Belum ada riwayat upload.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php
    require_once "../../layout/footer.php"
  ?>
</body>
</html>
