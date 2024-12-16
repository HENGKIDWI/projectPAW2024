<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

// Ambil data jabatan
$query_jabatan = "SELECT * FROM jabatan";
$result_jabatan = mysqli_query($conn, $query_jabatan);

// Proses Update Data
if (isset($_POST['update_semua'])) {
    foreach ($_POST['jabatan'] as $id_jabatan => $data) {
        $nama_personil = $data['nama_personil'];
        mysqli_query($conn, "UPDATE jabatan SET nama_personil = '$nama_personil' WHERE id_jabatan = '$id_jabatan'");
    }

    header("Location: view-struktur.php"); // Arahkan ke tampilan
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Struktur Sekolah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Sidebar -->
    <?php include '../../layout/sidebar.php'; ?>

    <!-- Navbar -->
    <header id="header" class="bg-blue-600 text-white py-4 transition-all duration-300">
    <?php include '../../layout/header.php' ?>
    </header>
    <div class="container mx-auto mt-10 p-6 bg-white rounded shadow-md">
        <h2 class="text-3xl font-bold mb-6 text-center text-gray-700">Update Struktur Sekolah</h2>

        <form method="POST" class="space-y-6">
            <div class="space-y-4">
                <h3 class="text-xl font-semibold text-blue-600">Data Jabatan</h3>
                <?php while ($row = mysqli_fetch_assoc($result_jabatan)) { ?>
                    <div class="p-4 border rounded bg-gray-50">
                        <h4 class="text-lg font-semibold mb-2"><?= htmlspecialchars($row['nama_jabatan']); ?></h4>
                        <label class="block text-gray-700 font-medium">Nama Personil</label>
                        <input type="text" name="jabatan[<?= $row['id_jabatan']; ?>][nama_personil]" 
                               value="<?= htmlspecialchars($row['nama_personil']); ?>" 
                               class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    </div>
                <?php } ?>
            </div>
            <div class="text-right">
                <button type="submit" name="update_semua" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 transition">
                    Update Semua
                </button>
            </div>
        </form>
    </div>
</body>
</html>
