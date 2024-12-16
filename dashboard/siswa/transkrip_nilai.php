<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

$nama = $_SESSION['nama_lengkap'];
$query = "SELECT * FROM siswa WHERE nama_lengkap = '$nama'";
$result = mysqli_query($conn, $query);

// Ambil data siswa
$row = mysqli_fetch_assoc($result);
$siswa_id = $row['id_siswa'];
$kelas_id = $row['kelas_id']; // Menyimpan kelas_id siswa

// Query untuk mengambil semua mata pelajaran dan nilai siswa
$query = "
    SELECT siswa.nama_lengkap, siswa.nis, mata_pelajaran.nama_pelajaran, nilai.semester, nilai.nilai
    FROM nilai
    JOIN siswa ON siswa.id_siswa = nilai.siswa_id
    JOIN mata_pelajaran ON mata_pelajaran.id_mata_pelajaran = nilai.mata_pelajaran_id
    WHERE nilai.siswa_id = $siswa_id
    ORDER BY nilai.semester, mata_pelajaran.nama_pelajaran
";

$result = mysqli_query($conn, $query);
$nilai_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transkrip Nilai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .btn-print {
                display: none;
            }
        }

        .grades-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .grades-item {
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .grades-item h3 {
            margin-bottom: 15px;
        }

        .grades-item table {
            width: 100%;
            border-collapse: collapse;
        }

        .grades-item table th,
        .grades-item table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .grades-item table th {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">

  <!-- Sidebar -->
  <?php include '../../layout/sidebar.php'; ?>

  <!-- Navbar -->
  <header id="header" class="bg-blue-600 text-white py-4 transition-all duration-300 btn-print">
    <?php include '../../layout/header.php'; ?>
  </header>

  <!-- Main Content Wrapper -->
  <div class="container my-5">
    <h2 class="text-center text-2xl font-bold mb-4">Transkrip Nilai</h2>

    <div class="grades-container">
        <!-- Student Details -->
        <div class="grades-item">
            <p><strong>Nama:</strong> <?= $row['nama_lengkap'] ?></p>
            <p><strong>NIS:</strong> <?= $row['nis'] ?></p>
        </div>

        <!-- Grades Table -->
        <div class="grades-item">
            <h3>Nilai</h3>
            <table>
                <thead>
                    <tr>
                        <th>Semester</th>
                        <th>Mata Pelajaran</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($nilai_data as $nilai): ?>
                        <tr>
                            <td><?= $nilai['semester'] ?></td>
                            <td><?= $nilai['nama_pelajaran'] ?></td>
                            <td><?= $nilai['nilai'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Print Button -->
        <div class="grades-item text-center btn-print">
            <button onclick="window.print()" class="btn btn-primary">Print Transkrip</button>
        </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
