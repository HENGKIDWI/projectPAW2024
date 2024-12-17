<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

// Filter berdasarkan GET parameter
$filter_tingkat = isset($_GET['tingkat']) ? $_GET['tingkat'] : '';
$filter_kelas   = isset($_GET['id_kelas']) ? $_GET['id_kelas'] : '';

// Query siswa
$query = "SELECT siswa.*, kelas.nama_kelas, kelas.tingkat 
          FROM siswa 
          JOIN kelas ON siswa.kelas_id = kelas.id_kelas";

if (!empty($filter_tingkat) && !empty($filter_kelas)) {
    $query .= " WHERE kelas.tingkat = '$filter_tingkat' AND kelas.id_kelas = '$filter_kelas'";
}

$result = mysqli_query($conn, $query);

// Query semua kelas untuk card
$query_kelas = "SELECT * FROM kelas ORDER BY tingkat, nama_kelas";
$result_kelas = mysqli_query($conn, $query_kelas);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body class="bg-gray-100 text-gray-800">

<div class="flex min-h-screen">
    <!-- Sidebar -->
    <?php include '../../layout/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Navbar -->
        <header class="bg-blue-600 text-white py-4 shadow-md">
            <?php include '../../layout/header.php'; ?>
        </header>

        <!-- Container -->
        <div class="container mx-auto mt-8 px-6">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-gray-700">Kelola Data Siswa</h2>
                <div class="space-x-4">
                    <a href="kelolaDataSiswaTambahSiswa.php" 
                       class="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition duration-300">
                        <i class="fas fa-user-plus mr-2"></i> Tambah Siswa
                    </a>
                    <!-- Button untuk memunculkan pop-up -->
                    <button data-toggle="modal" data-target="#tambahKelasModal" 
                        class="bg-yellow-500 text-white px-4 py-2 rounded-lg shadow hover:bg-yellow-600 transition duration-300">
                        <i class="fas fa-chalkboard-teacher mr-2"></i> Tambah Kelas
                    </button>
                </div>
            </div>

            <!-- Cards Kelas -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <?php while ($kelas = mysqli_fetch_assoc($result_kelas)): ?>
                <a href="?tingkat=<?php echo urlencode($kelas['tingkat']); ?>&id_kelas=<?php echo $kelas['id_kelas']; ?>" 
                   class="bg-blue-200 text-gray-800 rounded-lg shadow-md p-4 hover:bg-green-100 transition duration-300">
                   <h3 class="text-xl font-bold mb-2">
                     <i class="fas fa-chalkboard"></i> 
                     Kelas <?php echo htmlspecialchars($kelas['tingkat']); ?>  <?php echo htmlspecialchars($kelas['nama_kelas']); ?>
                    </h3>
                    <p class="text-sm text-gray-600">Klik untuk melihat siswa di kelas ini.</p>
                </a>
                <?php endwhile; ?>
            </div>

            <!-- Tabel Data Siswa -->
            <div class="bg-white rounded-lg shadow-md overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="bg-blue-600 text-white">
                            <th class="py-3 px-4 text-left">ID</th>
                            <th class="py-3 px-4 text-left">NIS</th>
                            <th class="py-3 px-4 text-left">Nama Lengkap</th>
                            <th class="py-3 px-4 text-left">Kelas</th>
                            <th class="py-3 px-4 text-left">Alamat</th>
                            <th class="py-3 px-4 text-left">Tanggal Lahir</th>
                            <th class="py-3 px-4 text-left">No Telp</th>
                            <th class="py-3 px-4 text-left">Jenis Kelamin</th>
                            <th class="py-3 px-4 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($result) > 0): ?>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4"><?php echo $row['id_siswa']; ?></td>
                                <td class="py-3 px-4"><?php echo htmlspecialchars($row['nis']); ?></td>
                                <td class="py-3 px-4"><?php echo htmlspecialchars($row['nama_lengkap']); ?></td>
                                <td class="py-3 px-4"><?php echo "Kelas " . htmlspecialchars($row['tingkat']) . " - " . htmlspecialchars($row['nama_kelas']); ?></td>
                                <td class="py-3 px-4"><?php echo htmlspecialchars($row['alamat']); ?></td>
                                <td class="py-3 px-4"><?php echo htmlspecialchars($row['tanggal_lahir']); ?></td>
                                <td class="py-3 px-4"><?php echo htmlspecialchars($row['no_telp']); ?></td>
                                <td class="py-3 px-4"><?php echo htmlspecialchars($row['jenis_kelamin']); ?></td>
                                <td class="py-3 px-4">
                                    <button onclick="showEditPopup('<?php echo $row['id_siswa']; ?>')" class="bg-yellow-500 text-white rounded-lg shadow-md p-2 hover:bg-yellow-700 transition duration-300">
                                        Edit
                                    </button>
                                    <button onclick="confirmDelete('<?php echo $row['id_siswa']; ?>')" class="bg-red-500 text-white rounded-lg shadow-md p-2 hover:bg-red-700 transition duration-300">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center py-4">Kelas Kosong</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Kelas -->
<div class="modal fade" id="tambahKelasModal" tabindex="-1" aria-labelledby="tambahKelasModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahKelasModalLabel">Tambah Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="kelolaDataSiswaTambahKelas.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_kelas">Nama Kelas</label>
                        <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" required>
                    </div>
                    <div class="form-group">
                        <label for="tingkat">Tingkat</label>
                        <select class="form-control" id="tingkat" name="tingkat" required>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Popup -->
<div id="editPopup" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-md p-6 w-1/2">
        <h2 class="text-xl font-bold mb-4">Edit Siswa</h2>
        <form id="editForm" action="kelolaDataSiswaEdit.php" method="POST">
            <input type="hidden" name="id_siswa" id="editIdSiswa">
            <div class="mb-4">
                <label for="editNama" class="block text-gray-700">Nama Lengkap</label>
                <input type="text" name="nama" id="editNama" class="w-full p-2 border border-gray-300 rounded-lg">
            </div>
            <div class="mb-4">
                <label for="editAlamat" class="block text-gray-700">Alamat</label>
                <input type="text" name="alamat" id="editAlamat" class="w-full p-2 border border-gray-300 rounded-lg">
            </div>
            <div class="mb-4">
                <label for="editTanggalLahir" class="block text-gray-700">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="editTanggalLahir" class="w-full p-2 border border-gray-300 rounded-lg">
            </div>
            <div class="mb-4">
                <label for="editNoTelp" class="block text-gray-700">No Telp</label>
                <input type="text" name="no_telp" id="editNoTelp" class="w-full p-2 border border-gray-300 rounded-lg">
            </div>
            <div class="mb-4">
                <label for="editJenisKelamin" class="block text-gray-700">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="editJenisKelamin" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="hideEditPopup()" class="bg-gray-500 text-white rounded-lg shadow-md p-2 hover:bg-gray-700 transition duration-300 mr-2">Batal</button>
                <button type="submit" class="bg-blue-500 text-white rounded-lg shadow-md p-2 hover:bg-blue-700 transition duration-300">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function showEditPopup(id_siswa) {
        document.getElementById('editIdSiswa').value = id_siswa;
        // Fetch existing data and populate the form fields (optional)
        document.getElementById('editPopup').classList.remove('hidden');
    }

    function hideEditPopup() {
        document.getElementById('editPopup').classList.add('hidden');
    }

    function confirmDelete(id_siswa) {
        if (confirm('Apakah Anda yakin ingin menghapus siswa ini?')) {
            window.location.href = 'kelolaDataSiswaHapus.php?id_siswa=' + id_siswa;
        }
    }
</script>

<?php mysqli_close($conn); ?>
</body>
</html>
