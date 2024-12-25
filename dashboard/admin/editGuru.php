<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

$message = '';
$messageType = ''; // Untuk styling pesan (success/error)

// Ambil data guru berdasarkan ID dari URL
if (isset($_GET['id'])) {
    $id_guru = intval($_GET['id']);
    $query = "SELECT * FROM guru WHERE id_guru = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_guru);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $guru = mysqli_fetch_assoc($result);

    if (!$guru) {
        $message = "Data guru tidak ditemukan.";
        $messageType = 'error';
    }
} else {
    header("Location: tampilanGuru.php");
    exit;
}

// Update data guru jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_lengkap = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $nip = mysqli_real_escape_string($conn, $_POST['nip']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $no_telp = mysqli_real_escape_string($conn, $_POST['no_telp']);
    $mata_pelajaran_id = intval($_POST['mata_pelajaran_id']);

    $updateQuery = "UPDATE guru SET nama_lengkap = ?, nip = ?, email = ?, no_telp = ?, mata_pelajaran_id = ? WHERE id_guru = ?";
    $stmt = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($stmt, "ssssii", $nama_lengkap, $nip, $email, $no_telp, $mata_pelajaran_id, $id_guru);

    if (mysqli_stmt_execute($stmt)) {
        $message = "Data guru berhasil diperbarui.";
        $messageType = 'success';
        header("Refresh: 2; URL=tampilanGuru.php"); // Redirect setelah 2 detik
    } else {
        $message = "Gagal memperbarui data guru.";
        $messageType = 'error';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Guru</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800">
    <?php include '../../layout/sidebar.php'; ?>
    <div class="min-h-screen flex flex-col">
        <?php include '../../layout/header.php'; ?>
        <main class="flex-1 container mx-auto px-6 mt-8 pb-12">
            <h1 class="text-3xl font-bold mb-6">Edit Data Guru</h1>

            <?php if (!empty($message)) : ?>
                <div class="<?= $messageType === 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?> border rounded px-4 py-3 mb-4">
                    <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>

            <?php if ($guru) : ?>
                <form method="POST" class="bg-white p-6 rounded shadow-md">
                    <div class="mb-4">
                        <label for="nama_lengkap" class="block font-semibold mb-1">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap" value="<?= htmlspecialchars($guru['nama_lengkap']) ?>" class="w-full border p-2 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label for="nip" class="block font-semibold mb-1">NIP</label>
                        <input type="text" name="nip" id="nip" value="<?= htmlspecialchars($guru['nip']) ?>" class="w-full border p-2 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block font-semibold mb-1">Email</label>
                        <input type="email" name="email" id="email" value="<?= htmlspecialchars($guru['email']) ?>" class="w-full border p-2 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label for="no_telp" class="block font-semibold mb-1">No. Telp</label>
                        <input type="text" name="no_telp" id="no_telp" value="<?= htmlspecialchars($guru['no_telp']) ?>" class="w-full border p-2 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label for="mata_pelajaran_id" class="block font-semibold mb-1">Mata Pelajaran</label>
                        <select name="mata_pelajaran_id" id="mata_pelajaran_id" class="w-full border p-2 rounded" required>
                            <option value="">Pilih Mata Pelajaran</option>
                            <?php
                            $mpQuery = "SELECT id_mata_pelajaran, nama_pelajaran FROM mata_pelajaran";
                            $mpResult = mysqli_query($conn, $mpQuery);

                            while ($mp = mysqli_fetch_assoc($mpResult)) :
                                $selected = ($guru['mata_pelajaran_id'] == $mp['id_mata_pelajaran']) ? 'selected' : '';
                            ?>
                                <option value="<?= $mp['id_mata_pelajaran'] ?>" <?= $selected ?>>
                                    <?= htmlspecialchars($mp['nama_pelajaran']) ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Simpan Perubahan</button>
                    <a href="tampilanGuru.php" class="bg-gray-600 text-white py-2 px-4 rounded hover:bg-gray-700">Kembali</a>
                </form>
            <?php endif; ?>
        </main>
    </div>
    <?php include '../../layout/footer.php'; ?>
</body>

</html>
                              