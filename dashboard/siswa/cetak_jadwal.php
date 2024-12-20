<?php
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

include '../../koneksi.php'; // Menghubungkan ke database

$nama = $_SESSION['nama_lengkap'];

// Ambil data siswa
$query = "SELECT * FROM siswa WHERE nama_lengkap = '" . mysqli_real_escape_string($conn, $nama) . "'";
$result = mysqli_query($conn, $query);
$siswa = mysqli_fetch_assoc($result);

// Ambil kelas siswa
$kelas_id = $siswa['kelas_id'];

// Ambil jadwal berdasarkan kelas dan urutkan hari
$jadwal_query = "
    SELECT jadwal.*, mata_pelajaran.nama_pelajaran, guru.nama_lengkap
    FROM jadwal 
    JOIN mata_pelajaran ON jadwal.mata_pelajaran_id = mata_pelajaran.id_mata_pelajaran 
    JOIN guru ON jadwal.guru_id = guru.id_guru 
    WHERE jadwal.kelas_id = '" . mysqli_real_escape_string($conn, $kelas_id) . "' 
    ORDER BY FIELD(jadwal.hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'), jadwal.jam_mulai";
$jadwal_result = mysqli_query($conn, $jadwal_query);
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
        <h2 class="text-2xl font-bold text-center text-blue-600 mb-6">Jadwal Mata Pelajaran</h2>

        <!-- Selamat Datang -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-6 text-center">
            <h3 class="text-gray-600 mt-2">Menampilkan Jadwal Mata Pelajaran untuk Kelas Anda.</h3>
        </div>

        <!-- Tabel Jadwal Mata Pelajaran -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-pink-100">
                        <th class="border border-gray-300 px-4 py-2">No</th>
                        <th class="border border-gray-300 px-4 py-2">Hari</th>
                        <th class="border border-gray-300 px-4 py-2">Mata Pelajaran</th>
                        <th class="border border-gray-300 px-4 py-2">Jam</th>
                        <th class="border border-gray-300 px-4 py-2">Nama Guru</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($jadwal_result) > 0) {
                        $no = 1;
                        while ($jadwal = mysqli_fetch_assoc($jadwal_result)) {
                            echo "<tr>
                                <td class='border border-gray-300 px-4 py-2 text-center'>{$no}</td>
                                <td class='border border-gray-300 px-4 py-2 text-center'>{$jadwal['hari']}</td>
                                <td class='border border-gray-300 px-4 py-2 text-center'>{$jadwal['nama_pelajaran']}</td>
                                <td class='border border-gray-300 px-4 py-2 text-center'>{$jadwal['jam_mulai']} - {$jadwal['jam_selesai']}</td>
                                <td class='border border-gray-300 px-4 py-2 text-center'>{$jadwal['nama_lengkap']}</td>
                            </tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr>
                                <td colspan='5' class='text-center text-gray-500'>Tidak ada jadwal yang tersedia.</td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Tombol Cetak -->
        <div class="text-right mt-6">
            <button onclick="window.print()" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded shadow">
                Cetak Jadwal
            </button>
        </div>
    </div>
</body>
</html>