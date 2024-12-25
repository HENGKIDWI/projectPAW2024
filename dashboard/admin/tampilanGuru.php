<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

$message = '';
$messageType = ''; // For styling the message (success/error)

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['kelas'])) {
    // Start transaction
    mysqli_begin_transaction($conn);
    
    try {
        foreach ($_POST['kelas'] as $id_guru => $id_kelas) {
            // First, remove this teacher from any existing class they might be wali for
            $clearPreviousQuery = "UPDATE kelas SET wali_kelas_id = NULL WHERE wali_kelas_id = ?";
            $stmt = mysqli_prepare($conn, $clearPreviousQuery);
            mysqli_stmt_bind_param($stmt, "i", $id_guru);
            mysqli_stmt_execute($stmt);
            
            // If a new class is selected (not "Bukan Wali Kelas")
            if (!empty($id_kelas)) {
                // Check if the selected class already has a wali
                $checkQuery = "SELECT wali_kelas_id FROM kelas WHERE id_kelas = ? AND wali_kelas_id IS NOT NULL";
                $stmt = mysqli_prepare($conn, $checkQuery);
                mysqli_stmt_bind_param($stmt, "i", $id_kelas);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                
                if (mysqli_num_rows($result) > 0) {
                    throw new Exception("Kelas yang dipilih sudah memiliki wali kelas!");
                }
                
                // Assign the teacher to the new class
                $updateQuery = "UPDATE kelas SET wali_kelas_id = ? WHERE id_kelas = ?";
                $stmt = mysqli_prepare($conn, $updateQuery);
                mysqli_stmt_bind_param($stmt, "ii", $id_guru, $id_kelas);
                
                if (!mysqli_stmt_execute($stmt)) {
                    throw new Exception("Gagal mengupdate wali kelas!");
                }
            }
        }
        
        // If we get here, everything worked
        mysqli_commit($conn);
        $message = "Data wali kelas berhasil diperbarui!";
        $messageType = 'success';
        
    } catch (Exception $e) {
        mysqli_rollback($conn);
        $message = $e->getMessage();
        $messageType = 'error';
    }
}

// Ambil data guru dengan join mata_pelajaran dan kelas
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$query = "SELECT g.id_guru, g.nip, g.nama_lengkap, g.email, g.no_telp, 
                 mp.nama_pelajaran, 
                 k.id_kelas as wali_kelas_id,
                 CONCAT(k.tingkat, ' ', k.nama_kelas) AS kelas_diampu
          FROM guru g
          LEFT JOIN mata_pelajaran mp ON g.mata_pelajaran_id = mp.id_mata_pelajaran
          LEFT JOIN kelas k ON g.id_guru = k.wali_kelas_id
          WHERE g.nama_lengkap LIKE ?
          ORDER BY g.nama_lengkap";

$stmt = mysqli_prepare($conn, $query);
$searchParam = "%$search%";
mysqli_stmt_bind_param($stmt, "s", $searchParam);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$count = 1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data Guru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function confirmDelete(url) {
            if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                window.location.href = url;
            }
        }

        function showMessage() {
            const message = document.getElementById("message");
            if (message) {
                setTimeout(function() {
                    message.style.display = "none";
                }, 3000);
            }
        }
    </script>
</head>

<body class="bg-gray-50 text-gray-800" onload="showMessage()">
    <?php include '../../layout/sidebar.php'; ?>
    <div class="min-h-screen flex flex-col">
        <?php include '../../layout/header.php'; ?>
        <main class="flex-1 container mx-auto px-6 mt-8 pb-12">
            <h1 class="text-3xl font-bold mb-6">Kelola Data Guru</h1>

            <?php if (!empty($message)) : ?>
                <div id="message" class="<?= $messageType === 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?> border rounded px-4 py-3 mb-4">
                    <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>

            <form method="GET" class="mb-4">
                <input type="text" name="search" placeholder="Cari Nama Guru" class="border p-2 rounded" value="<?= htmlspecialchars($search) ?>">
                <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded">Cari</button>
            </form>

            <div class="flex gap-4 mb-6">
                <a href="cetakDataGuru.php" target="_blank" class="bg-yellow-500 text-white py-2 px-4 rounded hover:bg-yellow-700">Cetak Data Guru</a>
                <a href="createGuru.php" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Tambah Guru</a>
                <a href="showClass.php" class="bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700">Tampilkan Kelas</a>
            </div>

            <form method="POST">
                <table class="table-auto w-full border-collapse w-full bg-white shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-blue-600 text-white">
                        <tr>
                            <th class="border px-4 py-3">No</th>
                            <th class="border px-4 py-3">NIP</th>
                            <th class="border px-4 py-3">Nama Lengkap</th>
                            <th class="border px-4 py-3">Email</th>
                            <th class="border px-4 py-3">No. Telp</th>
                            <th class="border px-4 py-3">Mata Pelajaran</th>
                            <th class="border px-4 py-3">Wali Kelas</th>
                            <th class="border px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr class="border-b hover:bg-gray-100">
                                <td class="border px-4 py-2"><?= $count++ ?></td>
                                <td class="border px-4 py-2"><?= htmlspecialchars($row['nip']) ?></td>
                                <td class="border px-4 py-2"><?= htmlspecialchars($row['nama_lengkap']) ?></td>
                                <td class="border px-4 py-2"><?= htmlspecialchars($row['email']) ?></td>
                                <td class="border px-4 py-2"><?= htmlspecialchars($row['no_telp']) ?></td>
                                <td class="border px-4 py-2"><?= htmlspecialchars($row['nama_pelajaran']) ?></td>
                                <td class="border px-4 py-2">
                                    <select name="kelas[<?= $row['id_guru'] ?>]" class="border rounded px-2 py-1">
                                        <option value="">Bukan Wali Kelas</option>
                                        <?php
                                        $kelasQuery = "SELECT id_kelas, CONCAT(tingkat, ' ', nama_kelas) AS nama_kelas 
                                                      FROM kelas 
                                                      WHERE wali_kelas_id IS NULL 
                                                         OR wali_kelas_id = ? 
                                                      ORDER BY tingkat, nama_kelas";
                                        $stmt = mysqli_prepare($conn, $kelasQuery);
                                        mysqli_stmt_bind_param($stmt, "i", $row['id_guru']);
                                        mysqli_stmt_execute($stmt);
                                        $kelasResult = mysqli_stmt_get_result($stmt);
                                        
                                        while ($kelas = mysqli_fetch_assoc($kelasResult)) :
                                            $selected = ($row['wali_kelas_id'] == $kelas['id_kelas']) ? 'selected' : '';
                                        ?>
                                            <option value="<?= $kelas['id_kelas'] ?>" <?= $selected ?>>
                                                <?= htmlspecialchars($kelas['nama_kelas']) ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                    <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">Simpan</button>
                                </td>
                                <td class="px-4 py-2">
                                    <a href="editGuru.php?id=<?= $row['id_guru'] ?>" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit Data</a>
                                    <a href="javascript:void(0)" onclick="confirmDelete('deleteGuru.php?id=<?= $row['id_guru'] ?>')" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Hapus</a>
                                </td>

                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </form>
        </main>
    </div>
    <?php include '../../layout/footer.php'; ?>
</body>

</html>