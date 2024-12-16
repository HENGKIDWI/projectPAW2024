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
            alert('Komentar berhasil terkirim!');
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
        <h2 class="text-2xl font-bold text-center text-pink-600 mb-6">Evaluasi Guru</h2>

        <!-- Selamat Datang -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-6 text-center">
            <h3 class="text-gray-600 mt-2">Menampilkan Jadwal Mata Pelajaran, dapat dicetak untuk lebih jelasnya.</h3>
        </div>

        <!-- Form Evaluasi Kinerja Guru -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Evaluasi Kinerja Guru</h3>

            <form action="evaluasi_guru.php" method="POST" onsubmit="showSuccessMessage()">
                <!-- Dropdown Nama Guru -->
                <div class="mb-4">
                    <label for="nama_guru" class="block text-gray-700 font-medium mb-2">Pilih Nama Guru:</label>
                    <select name="nama_guru" id="nama_guru" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-pink-300">
                        <option value="">-- Pilih Guru --</option>
                        <option value="Guru A">Guru A</option>
                        <option value="Guru B">Guru B</option>
                        <option value="Guru C">Guru C</option>
                    </select>
                </div>

                <!-- Komentar -->
                <div class="mb-4">
                    <label for="komentar" class="block text-gray-700 font-medium mb-2">Komentar:</label>
                    <textarea name="komentar" id="komentar" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-pink-300" placeholder="Tulis komentar Anda di sini..."></textarea>
                </div>

                <!-- Tombol Kirim -->
                <div class="text-center">
                    <button type="submit" class="bg-pink-500 text-white py-2 px-4 rounded-lg hover:bg-pink-600">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
