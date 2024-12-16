<?php
include '../../koneksi.php';

session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

$forum_id = $_GET['id'];

// Ambil forum berdasarkan ID
$query = "SELECT f.*, s.nama_lengkap FROM forum f JOIN siswa s ON f.dibuat_oleh = s.id_siswa WHERE f.id_forum = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $forum_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$forum = mysqli_fetch_assoc($result);

// Ambil komentar
$query = "SELECT k.*, s.nama_lengkap FROM komentar k JOIN siswa s ON k.siswa_id = s.id_siswa WHERE k.forum_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $forum_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$komentar = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komentar Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .comment-bubble {
            max-width: 70%;
            padding: 10px;
            border-radius: 15px;
            margin: 5px 0;
            position: relative;
        }
        .comment-bubble.self {
            background-color: #dcf8c6; /* Warna untuk komentar sendiri */
            align-self: flex-end;
        }
        .comment-bubble.other {
            background-color: #ffffff; /* Warna untuk komentar orang lain */
            align-self: flex-start;
            border: 1px solid #e0e0e0;
        }
        .comment-list {
            max-height: 300px; /* Atur tinggi maksimum untuk scroll */
            overflow-y: auto; /* Tambahkan scroll jika diperlukan */
            margin-bottom: 10px;
        }
        .comment-container {
            display: flex;
            flex-direction: column;
        }
        .comment-author {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h1 class="h5"><?= htmlspecialchars($forum['judul']) ?></h1>
            </div>
            <div class="card-body">
                <p><strong>Oleh:</strong> <?= htmlspecialchars($forum['nama_lengkap']) ?></p>
                <p><?= htmlspecialchars($forum['deskripsi']) ?></p>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h2 class="h6">Komentar</h2>
            </div>
            <div class="card-body">
                <div class="comment-list">
                    <?php foreach ($komentar as $kom): ?>
                        <div class="comment-container">
                            <div class="comment-bubble <?= ($kom['nama_lengkap'] == $_SESSION['nama_lengkap']) ? 'self' : 'other' ?>">
                                <span class="comment-author"><?= htmlspecialchars($kom['nama_lengkap']) ?>:</span>
                                <p><?= htmlspecialchars($kom['isi_komentar']) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div <div class="card">
            <div class="card-header bg-info text-white">
                <h2 class="h6">Buat Komentar Baru</h2>
            </div>
            <div class="card-body">
                <form action="buat_komentar.php" method="POST">
                    <input type="hidden" name="forum_id" value="<?= $forum_id ?>">
                    <div class="mb-3">
                        <label for="isi_komentar" class="form-label">Komentar:</label>
                        <textarea name="isi_komentar" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim Komentar</button>
                    <a href="forum_diskusi.php" class="btn btn-secondary">Selesai</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>