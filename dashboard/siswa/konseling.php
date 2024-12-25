<?php
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

include '../../koneksi.php'; // Pastikan file koneksi Anda benar

// Pesan notifikasi
$successMessage = '';
$errorMessage = '';

// Proses pengiriman laporan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $masalah = mysqli_real_escape_string($conn, $_POST['masalah']);

    // Cari siswa_id berdasarkan nama siswa
    $querySiswa = "SELECT id_siswa FROM siswa WHERE nama_lengkap = '$nama'";
    $resultSiswa = mysqli_query($conn, $querySiswa);
    $rowSiswa = mysqli_fetch_assoc($resultSiswa);

    if ($rowSiswa) {
        $siswa_id = $rowSiswa['id_siswa'];

        // Masukkan data ke tabel konseling
        $queryInsert = "INSERT INTO konseling (siswa_id, Keterangan) VALUES ('$siswa_id', '$masalah')";
        if (mysqli_query($conn, $queryInsert)) {
            $successMessage = 'Laporan berhasil terkirim!';
        } else {
            $errorMessage = 'Gagal mengirim laporan. Silakan coba lagi.';
        }
    } else {
        $errorMessage = 'Nama siswa tidak ditemukan.';
    }
}

// Ambil data laporan konseling
$queryKonseling = "
    SELECT k.id_koseling, s.nama_lengkap AS nama_siswa, k.Keterangan 
    FROM konseling k 
    JOIN siswa s ON k.siswa_id = s.id_siswa
";
$resultKonseling = mysqli_query($conn, $queryKonseling);
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
        <?php include '../../layout/header.php' ?>
    </header>

    <!-- Main Content -->
    <div id="mainContent" class="container mx-auto mt-8 px-4 transition-all duration-300">
        <h2 class="text-2xl font-bold text-center text-blue-600 mb-6">Halaman Konseling</h2>

        <!-- Pesan Notifikasi -->
        <?php if ($successMessage): ?>
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                <?= $successMessage; ?>
            </div>
        <?php elseif ($errorMessage): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                <?= $errorMessage; ?>
            </div>
        <?php endif; ?>

        <!-- Formulir Konseling -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">Formulir Laporan Masalah</h3>
            <form action="" method="POST">
                <div class="mb-4">
                    <label for="nama" class="block text-gray-700 font-medium mb-2">Nama Siswa:</label>
                    <input type="text" name="nama" id="nama" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-pink-300" required>
                </div>
                <div class="mb-4">
                    <label for="masalah" class="block text-gray-700 font-medium mb-2">Masalah:</label>
                    <textarea name="masalah" id="masalah" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-pink-300" placeholder="Tuliskan masalah Anda..." required></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Kirim</button>
                </div>
            </form>
        </div>

        <!-- Tabel Laporan Masalah -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Daftar Laporan Masalah</h3>
            <table class="table-auto w-full border border-gray-200 text-left">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="px-4 py-2 border">No</th>
                        <th class="px-4 py-2 border">Nama Siswa</th>
                        <th class="px-4 py-2 border">Masalah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($resultKonseling) > 0): ?>
                        <?php $no = 1; ?>
                        <?php while ($row = mysqli_fetch_assoc($resultKonseling)): ?>
                            <tr>
                                <td class="px-4 py-2 border text-center"><?= $no++; ?></td>
                                <td class="px-4 py-2 border"><?= $row['nama_siswa']; ?></td>
                                <td class="px-4 py-2 border"><?= $row['Keterangan']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td class="px-4 py-2 border text-center" colspan="3">Belum ada laporan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
