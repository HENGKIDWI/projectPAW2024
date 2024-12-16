<?php
include "../../koneksi.php";
session_start();

// Ambil semua soal dari tabel bank_soal
$query = "SELECT * FROM bank_soal";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Soal untuk Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
<body class="bg-gray-100 text-gray-800">
    <!-- Sidebar -->
    <?php include '../../layout/sidebar.php'; ?>

    <!-- Navbar -->
    <header id="header" class="bg-blue-600 text-white py-4 transition-all duration-300">
        <?php include '../../layout/header.php'; ?>
    </header>

    <div class="container mx-auto mt-8 px-4">
        <h2 class="text-2xl font-bold text-center mb-6">Bank Soal</h2>
        
        <form action="proses_jawaban.php" method="POST">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="bg-white shadow-md rounded-lg p-6 mt-4">
                <h4 class="text-xl font-semibold"><?= $row['soal'] ?></h4>
                <input type="hidden" name="soal_id[]" value="<?= $row['id_soal'] ?>">
                <textarea name="jawaban[]" rows="4" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    placeholder="Jawaban Anda"></textarea>
            </div>
            <?php endwhile; ?>

            <div class="text-right mt-6">
                <button type="submit" 
                    class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 transition duration-300">
                    Kirim Jawaban
                </button>
            </div>
        </form>
    </div>
</body>
</html>
