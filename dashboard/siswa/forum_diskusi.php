<?php
include '../../koneksi.php';

session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

// Ambil mata pelajaran
$query = "SELECT * FROM mata_pelajaran";
$result = mysqli_query($conn, $query);
$mataPelajaran = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Ambil forum
$query = "SELECT f.*, s.nama_lengkap FROM forum f JOIN siswa s ON f.dibuat_oleh = s.id_siswa";
$result = mysqli_query($conn, $query);
$forums = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Diskusi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .forum-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .forum-item {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 20px;
            flex: 1 1 calc(33.333% - 20px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .forum-item h3 {
            font-size: 1.25rem;
            margin-bottom: 10px;
        }

        .forum-item p {
            margin-bottom: 15px;
        }

        @media (max-width: 768px) {
            .forum-item {
                flex: 1 1 calc(100% - 20px);
            }
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">
    <!-- Sidebar -->
    <?php include '../../layout/sidebar.php'; ?>

    <!-- Navbar -->
    <header id="header" class="bg-blue-600 text-white py-4 transition-all duration-300">
        <?php include '../../layout/header.php'; ?>
    </header>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Forum Diskusi</h1>

        <div class="mb-5">
            <h2>Buat Forum Baru</h2>
            <form action="buat_forum.php" method="POST" class="bg-white p-4 rounded shadow">
                <div class="mb-3">
                    <label for="mata_pelajaran_id" class="form-label">Mata Pelajaran:</label>
                    <select name="mata_pelajaran_id" class="form-select" required>
                        <?php foreach ($mataPelajaran as $mp): ?>
                            <option value="<?= $mp['id_mata_pelajaran'] ?>"><?= $mp['nama_pelajaran'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul:</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi:</label>
                    <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Buat Forum</button>
            </form>
        </div>

        <div>
            <h2>Daftar Forum</h2>
            <div class="forum-container">
                <?php foreach ($forums as $forum): ?>
                    <div class="forum-item">
                        <h3><?= htmlspecialchars($forum['judul']) ?></h3>
                        <small class="text-muted">Oleh: <?= htmlspecialchars($forum['nama_lengkap']) ?></small>
                        <p><?= htmlspecialchars($forum['deskripsi']) ?></p>
                        <div>
                            <a href="komentar.php?id=<?= $forum['id_forum'] ?>" class="btn btn-info btn-sm">Komentar</a>
                            <form action="hapus_forum.php" method="POST" style="display:inline;">
                                <input type="hidden" name="forum_id" value="<?= $forum['id_forum'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
