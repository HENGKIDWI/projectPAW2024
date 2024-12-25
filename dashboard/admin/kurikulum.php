<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['delete_id'])) {
        // Hapus data
        $delete_id = intval($_POST['delete_id']);
        $queryDelete = "DELETE FROM kurikulum WHERE id_kurikulum = ?";
        $stmtDelete = mysqli_prepare($conn, $queryDelete);
        mysqli_stmt_bind_param($stmtDelete, 'i', $delete_id);

        if (mysqli_stmt_execute($stmtDelete)) {
            $success_message = "Kurikulum berhasil dihapus.";
        } else {
            $error_message = "Terjadi kesalahan saat menghapus data.";
        }
    } elseif (isset($_POST['active_id'])) {
        // Aktifkan kurikulum
        $active_id = intval($_POST['active_id']);

        // Reset semua kurikulum ke 'tidak'
        $queryReset = "UPDATE kurikulum SET dipakai = 'tidak'";
        mysqli_query($conn, $queryReset);

        // Set kurikulum yang dipilih ke 'ya'
        $queryActivate = "UPDATE kurikulum SET dipakai = 'ya' WHERE id_kurikulum = ?";
        $stmtActivate = mysqli_prepare($conn, $queryActivate);
        mysqli_stmt_bind_param($stmtActivate, 'i', $active_id);

        if (mysqli_stmt_execute($stmtActivate)) {
            $success_message = "Kurikulum berhasil diaktifkan.";
        } else {
            $error_message = "Terjadi kesalahan saat mengaktifkan kurikulum.";
        }
    } elseif (isset($_POST['deactivate_id'])) {
        // Nonaktifkan kurikulum
        $deactivate_id = intval($_POST['deactivate_id']);

        // Set kurikulum yang dipilih ke 'tidak'
        $queryDeactivate = "UPDATE kurikulum SET dipakai = 'tidak' WHERE id_kurikulum = ?";
        $stmtDeactivate = mysqli_prepare($conn, $queryDeactivate);
        mysqli_stmt_bind_param($stmtDeactivate, 'i', $deactivate_id);

        if (mysqli_stmt_execute($stmtDeactivate)) {
            $success_message = "Kurikulum berhasil dinonaktifkan.";
        } else {
            $error_message = "Terjadi kesalahan saat menonaktifkan kurikulum.";
        }
    } else {
        // Tambah data
        $tahun_ajaran = trim($_POST['tahun_ajaran']);
        $nama = trim($_POST['nama']);
        $deskripsi = trim($_POST['deskripsi']);

        // Prepare the insert statement
        $queryInsert = "INSERT INTO kurikulum (tahun_ajaran, nama, deskripsi) VALUES (?, ?, ?)";
        $stmtInsert = mysqli_prepare($conn, $queryInsert);
        mysqli_stmt_bind_param($stmtInsert, 'sss', $tahun_ajaran, $nama, $deskripsi);

        if (mysqli_stmt_execute($stmtInsert)) {
            $success_message = "Kurikulum berhasil ditambahkan.";
        } else {
            $error_message = "Terjadi kesalahan saat menambahkan kurikulum.";
        }
    }
}
// Ambil data kurikulum untuk dropdown
$queryDropdown = "SELECT * FROM kurikulum ORDER BY tahun_ajaran ASC";
$resultDropdown = mysqli_query($conn, $queryDropdown);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kurikulum</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script>
        function hideNotification() {
            setTimeout(function () {
                let notif = document.querySelector('.notif');
                if (notif) {
                    notif.style.display = 'none';
                }
            }, 3000);
        }
        window.onload = hideNotification;

        function toggleModal(id) {
            let modal = document.getElementById(id);
            modal.classList.toggle('hidden');
        }
    </script>
</head>

<body class="bg-gray-100 text-gray-900">

    <?php include '../../layout/sidebar.php'; ?>
    <header id="header" class="bg-blue-600 text-white py-4">
        <?php include '../../layout/header.php'; ?>
    </header>

    <div class="container mx-auto mt-8 px-4">

        <div class="bg-white shadow-lg rounded-lg p-6 max-w-4xl mx-auto">
            <?php if (isset($error_message)): ?>
                <div class="notif bg-red-500 text-white p-4 rounded-lg shadow-md mb-4">
                    <?php echo htmlspecialchars($error_message); ?>
                </div>
            <?php elseif (isset($success_message)): ?>
                <div class="notif bg-green-100 text-green-700 p-4 rounded-lg shadow-md mb-4">
                    <?php echo htmlspecialchars($success_message); ?>
                </div>
            <?php endif; ?>
            
            <!-- Form untuk menambah kurikulum -->
            <h3 class="text-xl font-semibold mb-4">Tambah Kurikulum Baru</h3>
            <form action="" method="POST">
                <div class="mb-4">
                    <label for="tahun_ajaran" class="block text-gray-700">Tahun Ajaran</label>
                    <input type="text" id="tahun_ajaran" name="tahun_ajaran" class="w-full p-2 border border-gray-300 rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label for="nama" class="block text-gray-700">nama Kurikulum</label>
                    <input type="text" id="nama" name="nama" class="w-full p-2 border border-gray-300 rounded-lg" required></input>
                </div>
                <div class="mb-4">
                    <label for="deskripsi" class="block text-gray-700">deskripsi Kurikulum</label>
                    <textarea id="deskripsi" name="deskripsi" class="w-full p-2 border border-gray-300 rounded-lg" required></textarea>
                </div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">Tambah Kurikulum</button>
            </form>

            <h3 class="text-xl font-semibold mb-4 mt-8">Kurikulum yang Tersedia</h3>
            <table class="w-full table-auto text-sm mb-6">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border px-4 py-2 text-left text-gray-700">Tahun Ajaran</th>
                        <th class="border px-4 py-2 text-left text-gray-700">Nama Kurikulum</th>
                        <th class="border px-4 py-2 text-center text-gray-700">Deskripsi</th>
                        <th class="border px-4 py-2 text-center text-gray-700">Status</th>
                        <th class="border px-4 py-2 text-center text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($resultDropdown)): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($row['tahun_ajaran']); ?></td>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($row['nama']); ?></td>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($row['deskripsi'] ?? 'Deskripsi Belum Diisi'); ?></td>
                            <td class="border px-4 py-2 text-center 
                                <?php echo $row['dipakai'] === 'ya' ? 'bg-green-500 text-white' : ''; ?>">
                                <?php echo $row['dipakai'] === 'ya' ? 'Diterapkan' : 'Tidak Diterapkan'; ?>
                            </td>
                                                
                            <td class="border px-4 py-2 text-center">
                                <button onclick="toggleModal('modal-<?php echo $row['id_kurikulum']; ?>')" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300"><i class="fas fa-cogs"></i> Aksi</button>

                                <!-- Modal Pop-up -->
                                 <!-- Modal Pop-up -->
                                 <div id="modal-<?php echo $row['id_kurikulum']; ?>" class="hidden fixed inset-0 z-50 bg-gray-800 bg-opacity-50 flex justify-center items-center">
                                     <div class="bg-white rounded-lg p-6 w-96 shadow-lg relative">
                                         <button onclick="toggleModal('modal-<?php echo $row['id_kurikulum']; ?>')" class="absolute top-2 right-2 text-gray-500"><i class="fas fa-times"></i></button>
                                                     
                                         <!-- Tombol Edit -->
                                         <a href="editKurikulum.php?id=<?php echo $row['id_kurikulum']; ?>" class="bg-blue-500 text-white px-4 py-2 rounded-lg mb-2 w-full text-center block hover:bg-blue-600 transition duration-300">
                                             <i class="fas fa-edit"></i> Edit
                                         </a>
                                                     
                                         <!-- Tombol Terapkan -->
                                         <form action="" method="POST" style="display: inline;">
                                             <input type="hidden" name="active_id" value="<?php echo htmlspecialchars($row['id_kurikulum']); ?>">
                                             <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg mb-2 w-full hover:bg-green-700 transition duration-300">Terapkan</button>
                                         </form>
                                                     
                                         <!-- Tombol Tidak Terapkan -->
                                         <form action="" method="POST" style="display: inline;">
                                             <input type="hidden" name="deactivate_id" value="<?php echo htmlspecialchars($row['id_kurikulum']); ?>">
                                             <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded-lg mb-2 w-full hover:bg-yellow-700 transition duration-300">Tidak Terapkan</button>
                                         </form>
                                                     
                                         <!-- Tombol Hapus -->
                                         <form action="" method="POST" style="display: inline;">
                                             <input type="hidden" name="delete_id" value="<?php echo htmlspecialchars($row['id_kurikulum']); ?>">
                                             <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg w-full hover:bg-red-700 transition duration-300">Hapus</button>
                                         </form>
                                     </div>
                                 </div>

                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
 <?php include '../../layout/footer.php'; ?>

</body>

</html>
