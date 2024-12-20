<?php
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

// Koneksi ke database
include '../../koneksi.php'; 

// Ambil data guru
$guru_query = "SELECT * FROM guru";
$guru_result = $conn->query($guru_query);

// Proses pengiriman formulir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $guru_id = $_POST['guru_id'];
    $komentar = $_POST['komentar'];
    $rating = $_POST['rating'];
    $siswa_id = $_SESSION['siswa_id']; // Pastikan siswa_id disimpan di session

    // Pastikan semua input diisi
    if (!empty($guru_id) && !empty($komentar) && !empty($rating) && !empty($siswa_id)) {
        // Penggunaan mysqli_query
        $query = "INSERT INTO evaluasi (siswa_id, guru_id, komentar, rating) VALUES ('$siswa_id', '$guru_id', '$komentar', '$rating')";
        
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Komentar berhasil terkirim!');</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat mengirim komentar: " . mysqli_error($conn) . "');</script>";
        }
    } 
}

?>

<!DOCTYPE html>
<html lang="id">
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
    <style>
        .rating {
            direction: rtl;
            display: inline-flex;
        }
        .rating input {
            display: none;
        }
        .rating label {
            font-size: 2rem;
            color: gray;
            cursor: pointer;
        }
        .rating input:checked ~ label,
        .rating label:hover,
        .rating label:hover ~ label {
            color: gold;
        }
    </style>
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
        <h2 class="text-2xl font-bold text-center text-blue-600 mb-6">Evaluasi Guru</h2>

        <!-- Selamat Datang -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-6 text-center">
            <h3 class="text-gray-600 mt-2">Menu Evaluasi Kinerja Guru.</h3>
        </div>

        <!-- Form Evaluasi Kinerja Guru -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Evaluasi Kinerja Guru</h3>

            <form action="" method="POST" onsubmit="showSuccessMessage()">
                <!-- Dropdown Nama Guru -->
                <div class="mb-4">
                    <label for="guru_id" class="block text-gray-700 font-medium mb-2">Pilih Nama Guru:</label>
                    <select name="guru_id" id="guru_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-pink-300" required>
                        <option value="">-- Pilih Guru --</option>
                        <?php
                        // Menampilkan daftar guru ke dalam dropdown
                        if ($guru_result->num_rows > 0) {
                            while ($row = $guru_result->fetch_assoc()) {
                                echo "<option value='" . $row['id_guru'] . "'>" . $row['nama_lengkap'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <!-- Rating Bintang -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Rating:</label>
                    <div class="rating">
                        <input type="radio" name="rating" id="star5" value="5" required>
                        <label for="star5">★</label>
                        <input type="radio" name="rating" id="star4" value="4">
                        <label for="star4">★</label>
                        <input type="radio" name="rating" id="star3" value="3">
                        <label for="star3">★</label>
                        <input type="radio" name="rating" id="star2" value="2">
                        <label for="star2">★</label>
                        <input type="radio" name="rating" id="star1" value="1">
                        <label for="star1">★</label>
                    </div>
                </div>

                <!-- Komentar -->
                <div class="mb-4">
                    <label for="komentar" class="block text-gray-700 font-medium mb-2">Komentar:</label>
                    <textarea name="komentar" id="komentar" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-pink-300" placeholder="Tulis komentar Anda di sini..."></textarea>
                </div>

                <!-- Tombol Kirim -->
                <div class="text-center">
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>