<?php
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

include '../../koneksi.php'; 

// Ambil data ekstrakurikuler beserta pembimbing
$query = "SELECT e.*, g.nama_lengkap AS nama_pembimbing 
          FROM ekstrakurikuler e 
          JOIN guru g ON e.pembimbing_id = g.id_guru";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .details {
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            transition: all 0.5s ease;
        }

        .details.show {
            max-height: 700px; /* Sesuaikan dengan tinggi maksimal konten */
            opacity: 1;
        }
    </style>
    <script>
        function toggleDetails(id) {
            const details = document.getElementById('details-' + id);
            if (details.classList.contains('show')) {
                details.classList.remove('show');
            } else {
                details.classList.add('show');
            }
        }
    </script>
</head>

<body class="bg-gray-50 text-gray-800">
    <!-- Sidebar -->
    <?php include '../../layout/sidebar.php'; ?>

    <!-- Navbar -->
    <header id="header" class="bg-blue-500 text-white py-4">
        <?php include '../../layout/header.php'; ?>
    </header>

    <!-- Main Content -->
    <div id="mainContent" class="container mx-auto mt-8 px-4">
        <h2 class="text-2xl font-bold text-center text-blue-600 mb-6">Daftar Kelas Minat Bakat</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="bg-white shadow-lg rounded-lg overflow-hidden relative">
                    <!-- Card Header -->
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800"><?= $row['nama_kegiatan']; ?></h3>
                        <p class="text-gray-600">Hari: <?= $row['hari_kegiatan']; ?></p>
                        <button class="mt-4 bg-gradient-to-r from-blue-500 to-blue-700 text-white px-4 py-2 rounded-full hover:shadow-lg transition-all duration-300" 
                                onclick="toggleDetails(<?= $row['id_ekstrakurikuler']; ?>)">
                            View Details
                        </button>
                    </div>
                    
                    <!-- Card Details -->
                    <div id="details-<?= $row['id_ekstrakurikuler']; ?>" 
                         class="details bg-gray-100 px-6 py-4">
                        <p><strong>Jam Mulai:</strong> <?= $row['jam_mulai']; ?></p>
                        <p><strong>Jam Selesai:</strong> <?= $row['jam_selesai']; ?></p>
                        <p><strong>Tempat:</strong> <?= $row['tempat_kegiatan']; ?></p>
                        <p><strong>Pembimbing:</strong> <?= $row['nama_pembimbing']; ?></p>
                        <p><strong>Deskripsi:</strong> <?= $row['Deskripsi'] ?? 'Tidak ada deskripsi'; ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>

</html>

