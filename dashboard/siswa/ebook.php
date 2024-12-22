<?php
// siswa.php
session_start();
include '../../koneksi.php';
include '../admin/ebook_proses.php';
include '../admin/kategori.php';

// Ambil semua data E-Book
$ebooks = getEbooks($conn);

// Pencarian
$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $ebooks = array_filter($ebooks, function($ebook) use ($search) {
        return stripos($ebook['judul'], $search) !== false || stripos($ebook['penulis'], $search) !== false;
    });
}

// Filter Kategori
$kategori_id = '';
if (isset($_GET['kategori_id'])) {
    $kategori_id = $_GET['kategori_id'];
    if ($kategori_id) {
        $ebooks = array_filter($ebooks, function($ebook) use ($kategori_id) {
            return $ebook['kategori_id'] == $kategori_id;
        });
    }
}

// Ambil semua kategori untuk filter
$kategoris = getKategoris($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Perpustakaan - Siswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1, h2 {
            color: #333;
        }
        table {
            margin-top: 20px;
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <!-- Sidebar -->
  <?php include '../../layout/sidebar.php'; ?>

<!-- Navbar -->
<header id="header" class="bg-teal-500 text-white py-4 transition-all duration-300">
  <?php include '../../layout/header.php' ?>
</header>

<!-- Main Content -->
<div id="mainContent" class="container mx-auto mt-8 px-4 transition-all duration-300">
    <div class="container">
        <h1 class="mt-5">E-Perpustakaan - Siswa</h1>

        <!-- Form Pencarian -->
        <form method="GET" class="form-inline mt-4">
            <input type="text" name="search" class="form-control" placeholder="Cari E-Book" value="<?php echo htmlspecialchars($search); ?>">
            <select name="kategori_id" class="form-control ml-2">
                <option value="">Semua Kategori</option>
                <?php foreach ($kategoris as $kategori): ?>
                    <option value="<?php echo htmlspecialchars($kategori['id']); ?>" <?php echo $kategori['id'] == $kategori_id ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($kategori['nama_kategori']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn-primary ml-2">Cari</button>
        </form>

        <!-- Tabel Daftar E-Book -->
        <h2 class="mt-4">Daftar E-Book</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Kategori</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($ebooks)): ?>
                    <?php foreach ($ebooks as $ebook): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($ebook['judul']); ?></td>
                            <td><?php echo htmlspecialchars($ebook['penulis']); ?></td>
                            <td><?php echo htmlspecialchars($ebook['nama_kategori']); ?></td>
                            <td><?php echo htmlspecialchars($ebook['deskripsi']); ?></td>
                            <td>
                            <button class="btn btn-info" onclick="window.open('<?php echo '/projectPAW2024/dashboard/siswa/flipbook.php?file=' . urlencode(basename($ebook['file_path'])); ?>', '_blank')">Baca</button>



                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada E-Book yang ditemukan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
