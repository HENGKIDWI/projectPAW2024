<?php
include "../../koneksi.php";
session_start();

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

// Ambil nama siswa dari session
$nama_siswa = $_SESSION['nama_lengkap'];

// Query untuk mendapatkan ID siswa berdasarkan nama lengkap
$query_siswa = "SELECT * FROM siswa, kelas WHERE nama_lengkap = '$nama_siswa' AND kelas_id = id_kelas";
$result_siswa = mysqli_query($conn, $query_siswa);
$siswa = mysqli_fetch_assoc($result_siswa);
$id_siswa = $siswa['id_siswa'];

// Query untuk mendapatkan daftar semester yang tersedia
$query_semester = "SELECT DISTINCT semester FROM rapot WHERE siswa_id = '$id_siswa' ORDER BY semester";
$result_semester = mysqli_query($conn, $query_semester);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Semester</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">
<!-- Sidebar -->
<?php include '../../layout/sidebar.php'; ?>

<!-- Navbar -->
<header id="header" class="bg-blue-500 text-white py-4 transition-all duration-300">
    <?php include '../../layout/header.php' ?>
</header>

<!-- Main Content -->
<div id="mainContent" class="container mx-auto mt-8 px-4 transition-all duration-300">
    <div class="container mx-auto mt-6 px-4">
        <h2 class="text-4xl font-bold text-center mb-6">Pilih Semester</h2>

        <div class="bg-white shadow-lg rounded-lg p-6">
            <form action="cetak_rapot.php" method="GET">
                <div class="mb-4">
                    <label for="semester" class="block text-lg font-semibold mb-2">Semester:</label>
                    <select name="semester" id="semester" class="border border-gray-300 rounded-md p-2 w-full">
                        <option value="">-- Pilih Semester --</option>
                        <?php if (mysqli_num_rows($result_semester) > 0): ?>
                            <?php while ($row_semester = mysqli_fetch_assoc($result_semester)): ?>
                                <option value="<?php echo $row_semester['semester']; ?>">
                                    <?php echo $row_semester['semester']; ?>
                                </option>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <option value="">Belum ada semester yang tersedia.</option>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="py-2 px-4 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition duration-200">
                        Lihat Rapor
                    </button>
                </div>
            </form>
        </div>
    </div>
    </div>
</body>
</html>