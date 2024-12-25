<?php
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

include '../../koneksi.php';

$nama = $_SESSION['nama_lengkap'];

// Ambil data siswa
$query = "SELECT * FROM siswa WHERE nama_lengkap = '" . mysqli_real_escape_string($conn, $nama) . "'";
$result = mysqli_query($conn, $query);
$siswa = mysqli_fetch_assoc($result);

// Ambil kelas siswa
$kelas_id = $siswa['kelas_id'];
$id_siswa = $siswa['id_siswa'];

// Modifikasi query untuk mengambil file_tugas dan url_tugas
// $tugas_query = "
//     SELECT t.id_tugas, t.judul, t.kelas_id, t.deskripsi, t.deadline, t.file_tugas, t.url_tugas
//     FROM tugas t
//     LEFT JOIN pengumpulan_tugas pt ON t.id_tugas = pt.id_tugas AND pt.id_siswa = '" . mysqli_real_escape_string($conn, $id_siswa) . "'
//     WHERE t.kelas_id = '" . mysqli_real_escape_string($conn, $kelas_id) . "'
//     AND pt.id_tugas IS NULL";
// $tugas_result = mysqli_query($conn, $tugas_query);

// $success_message = "";


// Query untuk tugas yang belum dikumpulkan
$pending_query = "
    SELECT t.id_tugas, t.judul, t.kelas_id, t.deskripsi, t.deadline, t.file_tugas, t.url_tugas
    FROM tugas t
    LEFT JOIN pengumpulan_tugas pt ON t.id_tugas = pt.id_tugas AND pt.id_siswa = '" . mysqli_real_escape_string($conn, $id_siswa) . "'
    WHERE t.kelas_id = '" . mysqli_real_escape_string($conn, $kelas_id) . "'
    AND pt.id_tugas IS NULL";
$pending_result = mysqli_query($conn, $pending_query);

// Query untuk tugas yang sudah dikumpulkan
$completed_query = "
    SELECT t.id_tugas, t.judul, t.kelas_id, t.deskripsi, t.deadline, t.file_tugas, t.url_tugas,
           pt.tanggal_pengumpulan, pt.status_pengumpulan, pt.nilai, pt.file_tugas
    FROM tugas t
    INNER JOIN pengumpulan_tugas pt ON t.id_tugas = pt.id_tugas
    WHERE t.kelas_id = '" . mysqli_real_escape_string($conn, $kelas_id) . "'
    AND pt.id_siswa = '" . mysqli_real_escape_string($conn, $id_siswa) . "'";
$completed_result = mysqli_query($conn, $completed_query);

// Proses pengumpulan tugas
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_tugas = $_POST['id_tugas'];
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
            $insert_query = "INSERT INTO pengumpulan_tugas (id_tugas, id_siswa, file_tugas, tanggal_pengumpulan, status_pengumpulan, nilai) 
                             VALUES ('" . mysqli_real_escape_string($conn, $id_tugas) . "', '$id_siswa', '" . mysqli_real_escape_string($conn, $file_tugas) . "', '$tanggal_pengumpulan', '$status_pengumpulan', NULL)";
            if (mysqli_query($conn, $insert_query)) {
                $success_message = "Tugas berhasil dikumpulkan!";
                // Refresh halaman setelah pengumpulan berhasil
                echo "<script>window.location.href = window.location.href;</script>";
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
    <header id="header" class="bg-blue-500 text-white py-4 transition-all duration-300">
        <?php include '../../layout/header.php'; ?>
    </header>

    <!-- Main Content -->
    <div id="mainContent" class="container mx-auto mt-8 px-4 transition-all duration-300">
        <h2 class="text-2xl font-bold text-center text-blue-600 mb-6">Halaman Pengumpulan Tugas</h2>

        <!-- Notifikasi -->
        <?php if (!empty($success_message)): ?>
            <div class="bg-green-100 text-green-700 border border-green-400 px-4 py-3 rounded mb-4">
                <?= $success_message; ?>
            </div>
        <?php endif; ?>

        <!-- Tugas yang Belum Dikumpulkan -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-8 overflow-x-auto">
            <h3 class="text-xl font-semibold mb-4 text-gray-700">Tugas yang Belum Dikumpulkan</h3>
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">No</th>
                        <th class="border border-gray-300 px-4 py-2">Judul Tugas</th>
                        <th class="border border-gray-300 px-4 py-2">Kelas</th>
                        <th class="border border-gray-300 px-4 py-2">Deskripsi</th>
                        <th class="border border-gray-300 px-4 py-2">File Soal</th>
                        <th class="border border-gray-300 px-4 py-2">URL Soal</th>
                        <th class="border border-gray-300 px-4 py-2">Batas Waktu</th>
                        <th class="border border-gray-300 px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($pending_result) > 0) {
                        $no = 1;
                        while ($tugas = mysqli_fetch_assoc($pending_result)) {
                            echo "<tr class='hover:bg-gray-100'>
                                <td class='border border-gray-300 px-4 py-2 text-center'>{$no}</td>
                                <td class='border border-gray-300 px-4 py-2'>{$tugas['judul']}</td>
                                <td class='border border-gray-300 px-4 py-2'>{$tugas['kelas_id']}</td>
                                <td class='border border-gray-300 px-4 py-2'>{$tugas['deskripsi']}</td>
                                <td class='border border-gray-300 px-4 py-2 text-center'>" .
                                (!empty($tugas['file_tugas']) ? 
                                    "<a href='../guru/uploads/{$tugas['file_tugas']}' target='_blank' class='text-blue-500 hover:text-blue-700'>Lihat Soal</a>" : 
                                    "-") .
                                "</td>
                                <td class='border border-gray-300 px-4 py-2 text-center'>" .
                                (!empty($tugas['url_tugas']) ? 
                                    "<a href='{$tugas['url_tugas']}' target='_blank' class='text-blue-500 hover:text-blue-700'>Buka Link</a>" : 
                                    "-") .
                                "</td>
                                <td class='border border-gray-300 px-4 py-2 text-center'>{$tugas['deadline']}</td>
                                <td class='border border-gray-300 px-4 py-2 text-center'>
                                    <form method='POST' action='' enctype='multipart/form-data'>
                                        <input type='hidden' name='id_tugas' value='{$tugas['id_tugas']}'>
                                        <input type='file' name='file_tugas' class='mb-2' required>
                                        <button type='submit' class='bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600'>Kumpulkan</button>
                                    </form>
                                </td>
                            </tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='8' class='text-center text-gray-500 py-4'>Tidak ada tugas yang belum dikumpulkan.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Tugas yang Sudah Dikumpulkan -->
        <div class="bg-white shadow-lg rounded-lg p-6 overflow-x-auto">
            <h3 class="text-xl font-semibold mb-4 text-gray-700">Tugas yang Sudah Dikumpulkan</h3>
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead class="bg-green-600 text-white">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">No</th>
                        <th class="border border-gray-300 px-4 py-2">Judul Tugas</th>
                        <th class="border border-gray-300 px-4 py-2">Kelas</th>
                        <th class="border border-gray-300 px-4 py-2">Deskripsi</th>
                        <th class="border border-gray-300 px-4 py-2">File Soal</th>
                        <th class="border border-gray-300 px-4 py-2">URL Soal</th>
                        <th class="border border-gray-300 px-4 py-2">File Jawaban</th>
                        <th class="border border-gray-300 px-4 py-2">Tanggal Pengumpulan</th>
                        <th class="border border-gray-300 px-4 py-2">Status</th>
                        <th class="border border-gray-300 px-4 py-2">Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($completed_result) > 0) {
                        $no = 1;
                        while ($tugas = mysqli_fetch_assoc($completed_result)) {
                            $status_class = $tugas['status_pengumpulan'] == 'Tepat Waktu' ? 'text-green-600' : 'text-yellow-600';
                            echo "<tr class='hover:bg-gray-100'>
                                <td class='border border-gray-300 px-4 py-2 text-center'>{$no}</td>
                                <td class='border border-gray-300 px-4 py-2'>{$tugas['judul']}</td>
                                <td class='border border-gray-300 px-4 py-2'>{$tugas['kelas_id']}</td>
                                <td class='border border-gray-300 px-4 py-2'>{$tugas['deskripsi']}</td>
                                <td class='border border-gray-300 px-4 py-2 text-center'>" .
                                (!empty($tugas['file_tugas']) ? 
                                    "<a href='../guru/uploads/{$tugas['file_tugas']}' target='_blank' class='text-blue-500 hover:text-blue-700'>Lihat Soal</a>" : 
                                    "-") .
                                "</td>
                                <td class='border border-gray-300 px-4 py-2 text-center'>" .
                                (!empty($tugas['url_tugas']) ? 
                                    "<a href='{$tugas['url_tugas']}' target='_blank' class='text-blue-500 hover:text-blue-700'>Buka Link</a>" : 
                                    "-") .
                                "</td>
                                <td class='border border-gray-300 px-4 py-2 text-center'>
                                    <a href='../guru/uploads/{$tugas['file_tugas']}' target='_blank' class='text-blue-500 hover:text-blue-700'>Download Jawaban</a>
                                </td>
                                <td class='border border-gray-300 px-4 py-2 text-center'>{$tugas['tanggal_pengumpulan']}</td>
                                <td class='border border-gray-300 px-4 py-2 text-center {$status_class}'>{$tugas['status_pengumpulan']}</td>
                                <td class='border border-gray-300 px-4 py-2 text-center'>" . 
                                ($tugas['nilai'] !== null ? $tugas['nilai'] : 'Belum dinilai') . 
                                "</td>
                            </tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='10' class='text-center text-gray-500 py-4'>Belum ada tugas yang dikumpulkan.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
