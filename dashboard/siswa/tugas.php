<?php
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

include '../../koneksi.php'; // File untuk koneksi database

$nama = $_SESSION['nama_lengkap'];

// Ambil data siswa
$query = "SELECT * FROM siswa WHERE nama_lengkap = '" . mysqli_real_escape_string($conn, $nama) . "'";
$result = mysqli_query($conn, $query);
$siswa = mysqli_fetch_assoc($result);

// Ambil kelas siswa
$kelas_id = $siswa['kelas_id'];

// Ambil tugas berdasarkan kelas dan mata pelajaran
$tugas_query = "
    SELECT tugas.*, kelas.*
    FROM tugas 
    JOIN kelas ON tugas.kelas_id = kelas.id_kelas 
    WHERE tugas.kelas_id = '" . mysqli_real_escape_string($conn, $kelas_id) . "'";
$tugas_result = mysqli_query($conn, $tugas_query);

// Proses pengumpulan tugas
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_tugas = $_POST['id_tugas'];
    $id_siswa = $siswa['id_siswa'];
    $file_tugas = $_FILES['file_tugas']['name'];
    $tanggal_pengumpulan = date("Y-m-d H:i:s");

    // Simpan file tugas
    $upload_dir = '../guru/uploads/';
    $file_path = $upload_dir . basename($file_tugas);

    // Validasi file upload
    $allowed_types = ['application/pdf', 'image/jpeg', 'image/png'];
    if (in_array($_FILES['file_tugas']['type'], $allowed_types) && $_FILES['file_tugas']['size'] < 2000000) {
        if (move_uploaded_file($_FILES['file_tugas']['tmp_name'], $file_path)) {
            // Cek deadline
            $tugas_query = "SELECT deadline FROM tugas WHERE id_tugas = '" . mysqli_real_escape_string($conn, $id_tugas) . "'";
            $tugas_result = mysqli_query($conn, $tugas_query);
            $tugas = mysqli_fetch_assoc($tugas_result);
            $deadline = $tugas['deadline'];

            // Tentukan status pengumpulan
            $status_pengumpulan = ($tanggal_pengumpulan <= $deadline) ? "Tepat Waktu" : "Terlambat";

            // Insert ke tabel pengumpulan_tugas
            $insert_query = "INSERT INTO pengumpulan_tugas (id_tugas, id_siswa, file_tugas, tanggal_pengumpulan, status_pengumpulan) 
                             VALUES ('" . mysqli_real_escape_string($conn, $id_tugas) . "', '$id_siswa', '" . mysqli_real_escape_string($conn, $file_tugas) . "', '$tanggal_pengumpulan', '$status_pengumpulan')";
            if (mysqli_query($conn, $insert_query)) {
                echo "<script>alert('Tugas berhasil dikumpulkan!');</script>";
            } else {
                echo "<script>alert('Gagal menyimpan ke database: " . mysqli_error($conn) . "');</script>";
            }
        } else {
            echo "<script>alert('Gagal mengunggah file.');</script>";
        }
    } else {
        echo "<script>alert('File tidak valid atau terlalu besar.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    <!-- Sidebar -->
    <?php include '../../layout/sidebar.php'; ?>

    <!-- Navbar -->
    <header id="header" class="bg-pink-500 text-white py-4 transition-all duration-300">
        <?php include '../../layout/header.php'; ?>
    </header>

    <!-- Main Content -->
    <div id="mainContent" class="container mx-auto mt-8 px-4 transition-all duration-300">
        <h2 class="text-2xl font-bold text-center text-pink-600 mb-6">Halaman Pengumpulan Tugas</h2>

        <!-- Tugas List -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead class="bg-pink-500 text-white">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">No</th>
                        <th class="border border-gray-300 px-4 py-2">Judul Tugas</th>
                        <th class="border border-gray-300 px-4 py-2">Mata Pelajaran</th> <!-- Kolom Mata Pelajaran -->
                        <th class="border border-gray-300 px-4 py-2">Deskripsi</th>
                        <th class="border border-gray-300 px-4 py-2">Batas Waktu</th>
                        <th class="border border-gray-300 px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($tugas_result) > 0) {
                        $no = 1;
                        while ($tugas = mysqli_fetch_assoc($tugas_result)) {
                            echo "<tr class='hover:bg-gray-100'>
                                <td class='border border-gray-300 px-4 py-2 text-center'>{$no}</td>
                                <td class='border border-gray-300 px-4 py-2'>{$tugas['judul']}</td>
                                <td class='border border-gray-300 px-4 py-2'>{$tugas['nama_pelajaran']}</td>
                                <td class='border border-gray-300 px-4 py-2'>{$tugas['deskripsi']}</td>
                                <td class='border border-gray-300 px-4 py-2 text-center'>{$tugas['deadline']}</td>
                                <td class='border border-gray-300 px-4 py-2 text-center'>
                                    <form method='POST' action='' enctype='multipart/form-data'>
                                        <input type='hidden' name='id_tugas' value='{$tugas['id_tugas']}'>
                                        <input type='file' name='file_tugas' class='mb-2' required>
                                        <button type='submit' class='bg-pink-500 text-white px-4 py-2 rounded hover:bg-pink-600'>Kumpulkan</button>
                                    </form>
                                </td>
                            </tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr>
                                <td colspan='6' class='text-center text-gray-500'>Tidak ada tugas yang tersedia.</td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>