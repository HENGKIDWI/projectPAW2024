<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

// Ambil data dari tabel jabatan
$query_jabatan = "SELECT * FROM jabatan";
$result_jabatan = mysqli_query($conn, $query_jabatan);

// Array untuk memetakan nama jabatan ke bagian tertentu
$data_jabatan = [];
while ($row = mysqli_fetch_assoc($result_jabatan)) {
    $data_jabatan[$row['nama_jabatan']] = $row['nama_personil'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struktur Sekolah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10">
<!-- Sidebar -->
<?php include '../../layout/sidebar.php'; ?>
    <!-- Navbar -->
    <header id="header" class="bg-blue-600 text-white py-4 transition-all duration-300">
      <?php include '../../layout/header.php'; ?>
    </header><br>
    <div class="max-w-6xl mx-auto bg-white shadow-lg p-6 rounded-lg border-2 border-blue-300">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-blue-700">STRUKTUR SEKOLAH</h1>
            <h2 class="text-2xl text-blue-600 mt-2">SMP NEGERI 1 TAMBELANGAN</h2>
        </div>

        <div class="relative flex flex-col items-center space-y-8">
            <div class="flex justify-center items-center space-x-16">
                <div class="text-center border-2 border-blue-500 p-4 rounded-lg bg-blue-50">
                    <h3 class="font-semibold">Komite Sekolah</h3>
                    <p class="text-gray-700"><?= htmlspecialchars($data_jabatan['Komite Sekolah'] ?? 'Belum Diisi'); ?></p>
                </div>
                <div class="text-center border-2 border-blue-500 p-4 rounded-lg bg-blue-100">
                    <h3 class="font-semibold">KEPALA SEKOLAH</h3>
                    <p class="text-gray-700"><?= htmlspecialchars($data_jabatan['Kepala Sekolah'] ?? 'Belum Diisi'); ?></p>
                </div>
            </div>

            <div class="relative flex justify-center items-center space-x-8">
                <div class="text-center border-2 border-blue-500 p-4 rounded-lg bg-blue-50">
                    <h3 class="font-semibold">Bendahara</h3>
                    <p class="text-gray-700"><?= htmlspecialchars($data_jabatan['Bendahara'] ?? 'Belum Diisi'); ?></p>
                </div>
                <div class="text-center border-2 border-blue-500 p-4 rounded-lg bg-blue-50">
                    <h3 class="font-semibold">K. Tata Usaha</h3>
                    <p class="text-gray-700"><?= htmlspecialchars($data_jabatan['K. Tata Usaha'] ?? 'Belum Diisi'); ?></p>
                </div>
            </div>

            <div class="mt-6">
                <div class="text-center border-2 border-blue-500 p-4 rounded-lg bg-blue-50">
                    <h3 class="font-semibold">WAKASEK</h3>
                    <p class="text-gray-700"><?= htmlspecialchars($data_jabatan['Wakil Kepala Sekolah'] ?? 'Belum Diisi'); ?></p>
                </div>
            </div>

            <div class="flex justify-between items-start space-x-6 w-full px-10">
                <div class="text-center border-2 border-blue-500 p-4 rounded-lg bg-blue-50 w-1/5">
                    <h3 class="font-semibold">KURIKULUM</h3>
                    <p><?= htmlspecialchars($data_jabatan['Kurikulum'] ?? 'Belum Diisi'); ?></p>
                </div>
                <div class="text-center border-2 border-blue-500 p-4 rounded-lg bg-blue-50 w-1/5">
                    <h3 class="font-semibold">HUMAS</h3>
                    <p><?= htmlspecialchars($data_jabatan['Humas'] ?? 'Belum Diisi'); ?></p>
                </div>
                <div class="text-center border-2 border-blue-500 p-4 rounded-lg bg-blue-50 w-1/5">
                    <h3 class="font-semibold">SARPRAS</h3>
                    <p><?= htmlspecialchars($data_jabatan['Sarpras'] ?? 'Belum Diisi'); ?></p>
                </div>
                <div class="text-center border-2 border-blue-500 p-4 rounded-lg bg-blue-50 w-1/5">
                    <h3 class="font-semibold">KESISWAAN</h3>
                    <p><?= htmlspecialchars($data_jabatan['Kesiswaan'] ?? 'Belum Diisi'); ?></p>
                </div>
            </div>
             <!-- Bagian Bawah: Wali Kelas, Guru, Siswa -->
             <div class="flex justify-center space-x-16 mt-8">
                <div class="text-center border-2 border-blue-500 p-4 rounded-lg bg-blue-50">
                    <h3 class="font-semibold">WALI KELAS</h3>
                </div>
                <div class="text-center border-2 border-blue-500 p-4 rounded-lg bg-blue-50">
                    <h3 class="font-semibold">GURU</h3>
                </div>
                <div class="text-center border-2 border-blue-500 p-4 rounded-lg bg-blue-50">
                    <h3 class="font-semibold">SISWA</h3>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
