<?php
session_start();
include '../../koneksi.php';
include 'ebook_proses.php';
include 'kategori.php';


if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

$ebooks = getEbooks($conn);
$kategoris = getKategoris($conn);

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    deleteEbook($conn, $id);
    header("Location: ebook.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Perpustakaan</title>
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
<header id="header" class="bg-blue-600 text-white py-4 transition-all duration-300">
  <?php include '../../layout/header.php' ?>
</header>

<!-- Main Content -->
<div id="mainContent" class="container mx-auto mt-8 px-4 transition-all duration-300">
<div class="container">
        <h1 class="mt-5">E-Perpustakaan</h1>
        
        <h2 class="mt-4">Tambah E-Book</h2>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" name="judul" class="form-control" placeholder="Judul" required>
            </div>
            <div class="form-group">
                <input type="text" name="penulis" class="form-control" placeholder="Penulis" required>
            </div>
            <div class="form-group">
                <textarea name="deskripsi" class="form-control" placeholder="Deskripsi" required></textarea>
            </div>
            <div class="form-group">
                <select name="kategori_id" class="form-control" required>
                    <option value="">Pilih Kategori</option>
                    <?php foreach ($kategoris as $kategori): ?>
                        <option value="<?php echo $kategori['id']; ?>"><?php echo $kategori['nama_kategori']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <input type="file" name="file_path" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload E-Book</button>
        </form>

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
                <?php foreach ($ebooks as $ebook): ?>
                    <tr>
                        <td><?php echo $ebook['judul']; ?></td>
                        <td><?php echo $ebook['penulis']; ?></td>
                        <td><?php echo $ebook['nama_kategori']; ?></td>
                        <td><?php echo $ebook['deskripsi']; ?></td>
                        <td>
                            <a href="edit_ebook.php?id=<?php echo $ebook['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="?delete=<?php echo $ebook['id']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus e-book ini?');">Hapus</a>
                            <a href="<?php echo $ebook['file_path']; ?>" class="btn btn-success" download>Download</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>