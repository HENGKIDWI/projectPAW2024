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
            alert('Tugas berhasil dikumpulkan!');
        }
    </script>
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

        <!-- Selamat Datang -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-6 text-center">
            <h3 class="text-gray-600 mt-2">Menampilkan Jadwal Mata Pelajaran, dapat dicetak untuk lebih jelasnya.</h3>
        </div>

        <!-- Tugas List -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead class="bg-pink-500 text-white">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">No</th>
                        <th class="border border-gray-300 px-4 py-2">Judul Tugas</th>
                        <th class="border border-gray-300 px-4 py-2">Deskripsi</th>
                        <th class="border border-gray-300 px-4 py-2">Batas Waktu</th>
                        <th class="border border-gray-300 px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Contoh data tugas
                    $tugas = [
                        ["judul" => "Tugas Matematika", "deskripsi" => "Kerjakan soal di buku halaman 15-17.", "batas_waktu" => "2024-12-20"],
                        ["judul" => "Tugas Fisika", "deskripsi" => "Laporan praktikum gaya gesek.", "batas_waktu" => "2024-12-25"]
                    ];
                    foreach ($tugas as $index => $item) {
                        echo "<tr class='hover:bg-gray-100'>
                            <td class='border border-gray-300 px-4 py-2 text-center'>".($index + 1)."</td>
                            <td class='border border-gray-300 px-4 py-2'>{$item['judul']}</td>
                            <td class='border border-gray-300 px-4 py-2'>{$item['deskripsi']}</td>
                            <td class='border border-gray-300 px-4 py-2 text-center'>{$item['batas_waktu']}</td>
                            <td class='border border-gray-300 px-4 py-2 text-center'>
                                <form method='POST' action='upload_tugas.php' enctype='multipart/form-data'>
                                    <input type='hidden' name='judul_tugas' value='{$item['judul']}'>
                                    <input type='file' name='file_tugas' class='mb-2' required>
                                    <button type='submit' onclick='showSuccessMessage()' class='bg-pink-500 text-white px-4 py-2 rounded hover:bg-pink-600'>Kumpulkan</button>
                                </form>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
