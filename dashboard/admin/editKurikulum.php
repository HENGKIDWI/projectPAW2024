<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

// Periksa apakah parameter `id` diberikan
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM kurikulum WHERE id_kurikulum = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_assoc($result);

    // Jika data tidak ditemukan
    if (!$data) {
        echo "Data kurikulum tidak ditemukan.";
        exit;
    }
} else {
    echo "ID kurikulum tidak diberikan.";
    exit;
}

// Proses update data jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tahun_ajaran = trim($_POST['tahun_ajaran']);
    $nama = trim($_POST['nama']);
    $deskripsi = trim($_POST['deskripsi']);

    $queryUpdate = "UPDATE kurikulum SET tahun_ajaran = ?, nama = ?, deskripsi = ? WHERE id_kurikulum = ?";
    $stmtUpdate = mysqli_prepare($conn, $queryUpdate);
    mysqli_stmt_bind_param($stmtUpdate, 'sssi', $tahun_ajaran, $nama, $deskripsi, $id);

    if (mysqli_stmt_execute($stmtUpdate)) {
        $success_message = "Kurikulum berhasil diperbarui.";
        header("Location: kurikulum.php"); // Redirect ke halaman daftar kurikulum setelah update
        exit;
    } else {
        $error_message = "Terjadi kesalahan saat memperbarui data.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kurikulum</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 text-gray-900">
    <?php include '../../layout/sidebar.php'; ?>
    <header id="header" class="bg-blue-600 text-white py-4">
        <?php include '../../layout/header.php'; ?>
    </header>

    <div class="container mx-auto mt-8 px-4">
      <a href="kurikulum.php" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">Kembali</a>
      <div class="bg-white shadow-lg rounded-lg p-6 max-w-4xl mx-auto">
            <h3 class="text-xl font-semibold mb-4">Edit Kurikulum</h3>

            <?php if (isset($error_message)): ?>
                <div class="notif bg-red-500 text-white p-4 rounded-lg shadow-md mb-4">
                    <?php echo htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>

            <form action="" method="POST">
                <div class="mb-4">
                    <label for="tahun_ajaran" class="block text-gray-700">Tahun Ajaran</label>
                    <input type="text" id="tahun_ajaran" name="tahun_ajaran" class="w-full p-2 border border-gray-300 rounded-lg" 
                           value="<?php echo htmlspecialchars($data['tahun_ajaran']); ?>" required>
                </div>
                <div class="mb-4">
                    <label for="nama" class="block text-gray-700">Nama Kurikulum</label>
                    <input type="text" id="nama" name="nama" class="w-full p-2 border border-gray-300 rounded-lg" 
                           value="<?php echo htmlspecialchars($data['nama']); ?>" required>
                </div>
                <div class="mb-4">
                    <label for="deskripsi" class="block text-gray-700">Deskripsi Kurikulum</label>
                    <textarea id="deskripsi" name="deskripsi" class="w-full p-2 border border-gray-300 rounded-lg" rows="10" cols="20" required><?php echo htmlspecialchars($data['deskripsi']); ?></textarea>
                </div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                    Update Kurikulum
                </button>
            </form>
        </div>
    </div>

    <?php include '../../layout/footer.php'; ?>
</body>

</html>
