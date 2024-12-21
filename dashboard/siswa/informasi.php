<?php
include '../../koneksi.php';
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

// Ambil data pengumuman yang aktif
$query = "SELECT * FROM informasi WHERE status = 'aktif' ORDER BY tanggal_publikasi DESC";
$result = mysqli_query($conn, $query);
$pengumumanList = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengumuman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .announcement-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .announcement-item {
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .announcement-item h3 {
            margin-bottom: 10px;
        }

        .announcement-item small {
            display: block;
            margin-bottom: 10px;
            color: #6c757d;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">
    <!-- Sidebar -->
    <?php include '../../layout/sidebar.php'; ?>

<!-- Navbar -->
<header id="header" class="bg-blue-500 text-white py-4 transition-all duration-300 no-print">
    <?php include '../../layout/header.php' ?>
</header>

<!-- Main Content -->
<div id="mainContent" class="container mx-auto mt-8 px-4 transition-all duration-300">
    <h1 class="text-center mb-4">Pengumuman</h1>

    <div class="announcement-container">
        <?php if (empty($pengumumanList)): ?>
            <div class="announcement-item">
                <p class="text-center">Belum ada pengumuman.</p>
            </div>
        <?php else: ?>
            <?php foreach ($pengumumanList as $pengumuman): ?>
                <div class="announcement-item">
                    <h3><?= htmlspecialchars($pengumuman['judul_informasi']) ?></h3>
                    <small>Dipublikasikan pada: <?= htmlspecialchars($pengumuman['tanggal_publikasi']) ?> | Oleh: <?= htmlspecialchars($pengumuman['dibuat_oleh']) ?></small>
                    <p><?= htmlspecialchars($pengumuman['deskripsi']) ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
