<?php
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

$nama = $_SESSION['nama_lengkap']
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Rapor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
  <!-- Sidebar -->
  <?php include '../../layout/sidebar.php'; ?>

  <!-- Navbar -->
  <header id="header" class="bg-blue-600 text-white py-4 transition-all duration-300">
    <?php include '../../layout/header.php'; ?>
  </header>
    <div class="container mt-5">
        <h1 class="text-center">Formulir Cetak Rapor</h1>
        <form action="cetak_rapor.php" method="POST">
            
                    <?php
                    
                    include '../../koneksi.php';

                    // Menampilkan daftar siswa
                    $query = "SELECT * FROM siswa WHERE nama_lengkap = '$nama'";
                    $result = mysqli_query($conn, $query);

                    $row = mysqli_fetch_assoc($result)
                    ?>

            <input type="hidden" name="siswa_id" value="<?=$row['id_siswa']?>">
            <div class="mb-3">
                <label for="semester" class="form-label">Pilih Semester</label>
                <select class="form-select" name="semester" id="semester" required>
                    <option value="">Pilih Semester</option>
                    <option value="1">Ganjil</option>
                    <option value="2">Genap</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Cetak Rapor</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
