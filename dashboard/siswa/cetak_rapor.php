<?php
include '../../koneksi.php';

session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $siswa_id = $_POST['siswa_id'];
    $semester = $_POST['semester'];

    // Mengambil data nilai dan informasi rapor siswa
    $query = "SELECT siswa.nama_lengkap, siswa.nis, rapot.semester, rapot.tahun_ajaran, rapot.komentar, siswa.kelas_id
              FROM siswa
              LEFT JOIN rapot ON siswa.id_siswa = rapot.siswa_id AND rapot.semester = ?
              WHERE siswa.id_siswa = ?";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $semester, $siswa_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $siswa = mysqli_fetch_assoc($result);

    // Mengambil nilai siswa
    $nilai_query = "SELECT mata_pelajaran.nama_pelajaran, nilai.nilai
                    FROM nilai
                    JOIN mata_pelajaran ON nilai.mata_pelajaran_id = mata_pelajaran.id_mata_pelajaran
                    WHERE nilai.siswa_id = ? AND nilai.semester = ?";

    $nilai_stmt = mysqli_prepare($conn, $nilai_query);
    mysqli_stmt_bind_param($nilai_stmt, "ss", $siswa_id, $semester);
    mysqli_stmt_execute($nilai_stmt);
    $nilai_result = mysqli_stmt_get_result($nilai_stmt);
    $nilai_data = mysqli_fetch_all($nilai_result, MYSQLI_ASSOC);

    $kelas_id = $siswa['kelas_id'] ?? null;
    $kelas = null;
    if ($kelas_id) {
        // Query untuk mengambil data kelas berdasarkan kelas_id
        $query_kelas = "SELECT nama_kelas FROM kelas WHERE id_kelas = $kelas_id";
        $result_kelas = mysqli_query($conn, $query_kelas);
        $kelas = mysqli_fetch_assoc($result_kelas);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Rapor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .btn-print {
                display: none;
            }
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mt-5">
        <?php if ($siswa && $siswa['semester']): ?>
            <h1 class="text-center">Rapor Siswa</h1>

            <div class="card">
                <div class="card-header">
                    Rapor Semester: <?= htmlspecialchars($siswa['semester']) ?> - Tahun Ajaran: <?= htmlspecialchars($siswa['tahun_ajaran']) ?>
                </div>
                <div class="card-body">
                    <h5>Nama Siswa: <?= htmlspecialchars($siswa['nama_lengkap']) ?></h5>
                    <p>NIS: <?= htmlspecialchars($siswa['nis']) ?></p>
                    <p>Kelas: <?= htmlspecialchars($kelas['nama_kelas'] ?? 'Tidak diketahui') ?></p>

                    <h6>Nilai</h6>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Mata Pelajaran</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($nilai_data): ?>
                                <?php foreach ($nilai_data as $nilai): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($nilai['nama_pelajaran']) ?></td>
                                        <td><?= htmlspecialchars($nilai['nilai']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="2" class="text-center">Belum ada nilai.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <h6>Komentar: <?= htmlspecialchars($siswa['komentar'] ?? 'Tidak ada komentar') ?></h6>

                    <a href="cetak_rapot.php" class="btn btn-primary btn-print">Selesai</a>
                    <a href="#" class="btn btn-success btn-print" onclick="window.print();">Cetak Rapor</a>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-warning text-center" role="alert">
                Nilai rapor belum keluar. Silakan cek kembali nanti.
            </div>
            <script>
                setTimeout(function() {
                    window.location.href = 'cetak_rapot.php'; // Ganti dengan halaman form input yang sesuai
                }, 3000);
            </script>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
