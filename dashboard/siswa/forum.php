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

// Ambil forum beserta nama mata pelajaran
$query = "SELECT f.*, s.nama_lengkap, mp.nama_pelajaran 
          FROM forum f 
          JOIN siswa s ON f.dibuat_oleh = s.id_siswa 
          JOIN mata_pelajaran mp ON f.mata_pelajaran_id = mp.id_mata_pelajaran";
$result = mysqli_query($conn, $query);
$forums = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Diskusi</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .forum-item {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .forum-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #3B82F6;
            color: white;
        }

        .btn-primary:hover {
            background-color: #2563EB;
        }

        .btn-info {
            background-color: #38BDF8;
            color: white;
        }

        .btn-info:hover {
            background-color: #0ea5e9;
        }

        .btn-danger {
            background-color: #EF4444;
            color: white;
        }

        .btn-danger:hover {
            background-color: #dc2626;
        }

        .forum-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .forum-item {
            background-color: #FFFFFF;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .forum-item h3 {
            font-size: 1.25rem;
            margin-bottom: 10px;
            color: #1D4ED8;
        }

        .forum-item p {
            margin-bottom: 15px;
            color: #4B5563;
        }

        .forum-item small {
            color: #6B7280;
        }

        .btn-container {
            display: flex;
            gap: 10px;
            justify-content: space-between;
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
        <h1 class="text-center mb-4 text-3xl font-semibold">Forum Diskusi</h1>

        <div class="mb-5">
            <h2 class="text-xl font-semibold mb-3">Buat Forum Baru</h2>
            <form action="buat_forum.php" method="POST" class="bg-white p-6 rounded-lg shadow-md">
                <div class="mb-4">
                    <label for="mata_pelajaran_id" class="form-label text-gray-700">Mata Pelajaran:</label>
                    <select name="mata_pelajaran_id" class="form-select block w-full p-2 border border-gray-300 rounded-md" required>
                        <?php foreach ($mataPelajaran as $mp): ?>
                            <option value="<?= $mp['id_mata_pelajaran'] ?>"><?= $mp['nama_pelajaran'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="judul" class="form-label text-gray-700">Judul:</label>
                    <input type="text" name="judul" class="form-control block w-full p-2 border border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="form-label text-gray-700">Deskripsi:</label>
                    <textarea name="deskripsi" class="form-control block w-full p-2 border border-gray-300 rounded-md" rows="3" required></textarea>
                </div>

                <button type="submit" class="btn-primary px-6 py-2 rounded-md">Buat Forum</button>
            </form>
        </div>

        <div>
            <h2 class="text-xl font-semibold mb-4">Daftar Forum</h2>
            <div class="forum-container">
    <?php foreach ($forums as $forum): ?>
        <div class="forum-item">
            <h3><?= htmlspecialchars($forum['judul']) ?></h3>
            <small class="text-sm text-gray-600">Oleh: <?= htmlspecialchars($forum['nama_lengkap']) ?></small>
            <p class="text-sm text-gray-500">Mata Pelajaran: <?= htmlspecialchars($forum['nama_pelajaran']) ?></p> <!-- Tampilkan mata pelajaran -->
            <p><?= htmlspecialchars($forum['deskripsi']) ?></p>
            <div class="btn-container">
                <a href="komentar.php?id=<?= $forum['id_forum'] ?>" class="btn-info px-4 py-1 rounded-md">Komentar</a>
                <form action="hapus_forum.php" method="POST" style="display:inline;" onsubmit="return confirmDelete();">
                    <input type="hidden" name="forum_id" value="<?= $forum['id_forum'] ?>">
                    <button type="submit" class="btn-danger px-4 py-1 rounded-md">Hapus</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>

        </div>
    </div>

    <script>
        // Konfirmasi sebelum menghapus forum
        function confirmDelete() {
            return confirm("Apakah Anda yakin ingin menghapus forum ini?");
        }
    </script>

</body>

</html>

