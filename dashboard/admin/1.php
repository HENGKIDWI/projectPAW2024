<?php
// Koneksi ke database
include "../../koneksi.php";
session_start();
// Cek koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi gagal: " . mysqli_connect_error();
    exit();
}

// Query untuk mendapatkan data siswa dengan kelas_id 7
$query = "SELECT id_siswa, nis, nama_lengkap, alamat, tanggal_lahir, no_telp, jenis_kelamin 
          FROM siswa 
          WHERE kelas_id = 7";
$result = mysqli_query($conn, $query);

// Cek jika query berhasil
if (!$result) {
    echo "Error: " . mysqli_error($conn);
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa Kelas 7</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <?php include "../../layout/sidebar.php"; ?>
    <header id="header" class="bg-blue-600 text-white py-4 shadow-md">
        <?php include '../../layout/header.php'; ?>
    </header>

    <div class="container mx-auto px-4 mt-8">
        <!-- Judul Halaman -->
        <div class="flex justify-between items-center mb-6">
            <a href="3.php" class="text-blue-500 hover:text-blue-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M15.707 3.293a1 1 0 00-1.414 0L6.293 11.293a1 1 0 000 1.414l8 8a1 1 0 001.414-1.414L8.414 12l7.293-7.293a1 1 0 000-1.414z"/>
                </svg>
            </a>
            <h1 class="text-3xl font-semibold text-center text-gray-800">Data Siswa Kelas 7</h1>
            <a href="2.php" class="text-blue-500 hover:text-blue-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M8.293 3.293a1 1 0 000 1.414L15.586 12l-7.293 7.293a1 1 0 001.414 1.414l8-8a1 1 0 000-1.414l-8-8a1 1 0 00-1.414 0z"/>
                </svg>
            </a>
        </div>


        <!-- Tabel Data Siswa -->
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-blue-600 text-white">
                    <th class="py-3 px-4 text-left">ID Siswa</th>
                    <th class="py-3 px-4 text-left">NIS</th>
                    <th class="py-3 px-4 text-left">Nama Lengkap</th>
                    <th class="py-3 px-4 text-left">Alamat</th>
                    <th class="py-3 px-4 text-left">Tanggal Lahir</th>
                    <th class="py-3 px-4 text-left">No Telp</th>
                    <th class="py-3 px-4 text-left">Jenis Kelamin</th>
                    <th class="py-3 px-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-4"><?php echo htmlspecialchars($row['id_siswa']); ?></td>
                    <td class="py-3 px-4"><?php echo htmlspecialchars($row['nis']); ?></td>
                    <td class="py-3 px-4"><?php echo htmlspecialchars($row['nama_lengkap']); ?></td>
                    <td class="py-3 px-4"><?php echo htmlspecialchars($row['alamat']); ?></td>
                    <td class="py-3 px-4"><?php echo htmlspecialchars($row['tanggal_lahir']); ?></td>
                    <td class="py-3 px-4"><?php echo htmlspecialchars($row['no_telp']); ?></td>
                    <td class="py-3 px-4"><?php echo htmlspecialchars($row['jenis_kelamin']); ?></td>
                    <td class="py-3 px-4">
                        <a href="edit.php?id=<?php echo $row['id_siswa']; ?>" class="text-blue-500 hover:underline">Edit</a>
                        <span class="mx-2">|</span>
                        <a href="hapus.php?id=<?php echo $row['id_siswa']; ?>" onclick="return confirm('Yakin ingin menghapus?')" class="text-red-500 hover:underline">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
// Tutup koneksi
mysqli_close($conn);
?>


