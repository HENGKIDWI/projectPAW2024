<?php
include "../../koneksi.php";
session_start();

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

// Ambil ID siswa dari session
$nama_siswa = $_SESSION['nama_lengkap'];

// Ambil ID bank soal dari parameter GET
$bank_soal_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Query untuk mendapatkan detail bank soal
$query_soal = "SELECT * FROM bank_soal WHERE id = '$bank_soal_id'";
$result_soal = mysqli_query($conn, $query_soal);
$soal = mysqli_fetch_assoc($result_soal);

// Memeriksa apakah soal ditemukan
if (!$soal) {
    echo "Soal tidak ditemukan.";
    exit;
}

// Proses penyimpanan jawaban jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jawaban = mysqli_real_escape_string($conn, $_POST['jawaban']);
    $query_jawaban = "INSERT INTO jawaban (siswa_id, bank_soal_id, jawaban) VALUES ('$nama_siswa', '$bank_soal_id', '$jawaban')";
    
    if (mysqli_query($conn, $query_jawaban)) {
        $success_message = "Jawaban berhasil disimpan!";
    } else {
        $error_message = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mengerjakan Soal</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto mt-8 px-4">
        <h2 class="text-2xl font-bold text-center mb-6">Mengerjakan Soal</h2>

        <?php 
        // Tampilkan pesan sukses atau error
        if (isset($success_message)) {
            echo "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4' role='alert'>$success_message</div>";
        }
        if (isset($error_message)) {
            echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4' role='alert'>$error_message</div>";
        }
        ?>

        <div class="bg-white shadow-md rounded-lg p-8">
            <h3 class="text-xl font-semibold mb-4"><?php echo htmlspecialchars($soal['judul_bank_soal']); ?></h3>
            <p class="mb-4"><?php echo nl2br(htmlspecialchars($soal['detail_bank_soal'])); ?></p>

            <?php if ($soal['file_soal']): ?>
                <div class="mb-4">
                    <strong>File Soal:</strong> 
                    <a href="/path/to/files/<?php echo $soal['file_soal']; ?>" target="_blank" class="text-blue-600 hover:underline">Unduh Soal</a>
                </div>
            <?php endif; ?>

            <form action="" method="POST">
                <div class="mb-4">
                    <label for="jawaban" class="block text-gray-700 font-bold mb-2">Jawaban:</label>
                    <textarea id="jawaban" name="jawaban" rows="6" required 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan jawaban Anda..."></textarea>
                </div>
                <div class="text-right">
                    <button type="submit" 
                        class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition duration-300">
                        Simpan Jawaban
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>