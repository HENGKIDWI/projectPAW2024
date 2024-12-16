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
        <h2 class="text-2xl font-bold text-center text-pink-600 mb-6">Jadwal Mata Pelajaran</h2>

        <!-- Selamat Datang -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-6 text-center">
            <h3 class="text-gray-600 mt-2">Menampilkan Jadwal Mata Pelajaran, dapat dicetak untuk lebih jelasnya.</h3>
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
                    <tr>
                        <td class='border border-gray-300 px-4 py-2 text-center'>1</td>
                        <td class='border border-gray-300 px-4 py-2 text-center'>Senin</td>
                        <td class='border border-gray-300 px-4 py-2 text-center'>Matematika</td>
                        <td class='border border-gray-300 px-4 py-2 text-center'>08:00 - 09:30</td>
                        <td class='border border-gray-300 px-4 py-2 text-center'>Ahmad S.pd</td>
                    </tr>
                    <tr>
                        <td class='border border-gray-300 px-4 py-2 text-center'>2</td>
                        <td class='border border-gray-300 px-4 py-2 text-center'>Selasa</td>
                        <td class='border border-gray-300 px-4 py-2 text-center'>Bahasa Indonesia</td>
                        <td class='border border-gray-300 px-4 py-2 text-center'>09:30 - 11:00</td>
                        <td class='border border-gray-300 px-4 py-2 text-center'>Siti</td>
                    </tr>
                    <tr>
                        <td class='border border-gray-300 px-4 py-2 text-center'>3</td>
                        <td class='border border-gray-300 px-4 py-2 text-center'>Rabu</td>
                        <td class='border border-gray-300 px-4 py-2 text-center'>Fisika</td>
                        <td class='border border-gray-300 px-4 py-2 text-center'>08:00 - 09:30</td>
                        <td class='border border-gray-300 px-4 py-2 text-center'>Pak Budi</td>
                    </tr>
                    <tr>
                        <td class='border border-gray-300 px-4 py-2 text-center'>4</td>
                        <td class='border border-gray-300 px-4 py-2 text-center'>Kamis</td>
                        <td class='border border-gray-300 px-4 py-2 text-center'>Kimia</td>
                        <td class='border border-gray-300 px-4 py-2 text-center'>10:00 - 11:30</td>
                        <td class='border border-gray-300 px-4 py-2 text-center'>Bu Lina</td>
                    </tr>
                    <tr>
                        <td class='border border-gray-300 px-4 py-2 text-center'>5</td>
                        <td class='border border-gray-300 px-4 py-2 text-center'>Jumat</td>
                        <td class='border border-gray-300 px-4 py-2 text-center'>Biologi</td>
                        <td class='border border-gray-300 px-4 py-2 text-center'>08:00 - 09:30</td>
                        <td class='border border-gray-300 px-4 py-2 text-center'>Pak Rizal</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Tombol Cetak -->
        <div class="text-right mt-6">
            <button onclick="window.print()" class="bg-pink-500 hover:bg-pink-600 text-white font-bold py-2 px-4 rounded shadow">
                Cetak Jadwal
            </button>
        </div>
    </div>
</body>
</html>
