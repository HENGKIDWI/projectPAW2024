<?php
    session_start();

    if (!isset($_SESSION['nama_lengkap'])) {
        header("Location: ../../login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function showSuccessMessage() {
            alert('Laporan berhasil terkirim!');
        }
    </script>
</head>
<body class="bg-gray-50 text-gray-800">
    <!-- Sidebar -->
    <?php include '../../layout/sidebar.php'; ?>

    <!-- Navbar -->
    <header id="header" class="bg-pink-500 text-white py-4 transition-all duration-300">
        <?php include '../../layout/header.php' ?>
    </header>

    <!-- Main Content -->
    <div id="mainContent" class="container mx-auto mt-8 px-4 transition-all duration-300">
        <h2 class="text-2xl font-bold text-center text-pink-600 mb-6">Halaman Konseling</h2>

        <!-- Selamat Datang -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-6 text-center">
            <h3 class="text-gray-600 mt-2">Menampilkan Jadwal Mata Pelajaran, dapat dicetak untuk lebih jelasnya.</h3>
        </div>

        <!-- Formulir Konseling -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">Formulir Laporan Masalah</h3>
            <form action="process_konseling.php" method="POST" onsubmit="showSuccessMessage()">
                <div class="mb-4">
                    <label for="nama" class="block text-gray-700 font-medium mb-2">Nama Siswa:</label>
                    <input type="text" name="nama" id="nama" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-pink-300" required>
                </div>
    
                <div class="mb-4">
                    <label for="masalah" class="block text-gray-700 font-medium mb-2">Masalah:</label>
                    <textarea name="masalah" id="masalah" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-pink-300" placeholder="Tuliskan masalah Anda..." required></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="bg-pink-500 text-white py-2 px-4 rounded-lg hover:bg-pink-600">Kirim</button>
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
                    <tr>
                        <td class="px-4 py-2 border text-center" colspan="3">Belum ada laporan.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
