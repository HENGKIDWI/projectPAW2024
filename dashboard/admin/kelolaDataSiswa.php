<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}
if (isset($_SESSION['message'])) {
    echo "<script>alert('" . $_SESSION['message'] . "');</script>";
    // Clear the session message after displaying it
    unset($_SESSION['message']);
}
// Filter berdasarkan GET parameter
$filter_tingkat = isset($_GET['tingkat']) ? $_GET['tingkat'] : '';
$filter_kelas = isset($_GET['id_kelas']) ? $_GET['id_kelas'] : '';
$filter_nama_siswa = isset($_GET['nama_siswa']) ? $_GET['nama_siswa'] : '';
$filter_nis_siswa = isset($_GET['nis_siswa']) ? $_GET['nis_siswa'] : '';

// Menentukan teks judul berdasarkan kondisi filter
if (!empty($filter_kelas)) {
    // Query untuk mendapatkan nama_kelas berdasarkan id_kelas
    $query_kelas_filter = "SELECT nama_kelas, tingkat FROM kelas WHERE id_kelas = '$filter_kelas' LIMIT 1";
    $result_kelas_filter = mysqli_query($conn, $query_kelas_filter);
    $kelas_data = mysqli_fetch_assoc($result_kelas_filter);
    $nama_kelas = $kelas_data['nama_kelas'];
    $tingkat = $kelas_data['tingkat'];
    
    // Judul berdasarkan nama kelas
    $judul = "Data Siswa Kelas: $tingkat $nama_kelas";
} else {
    $judul = "Data Siswa Keseluruhan";
}

// Query siswa
$query = "SELECT siswa.*, kelas.nama_kelas, kelas.tingkat 
          FROM siswa 
          JOIN kelas ON siswa.kelas_id = kelas.id_kelas";

// Array untuk menampung kondisi filter
$conditions = [];

// Menambahkan filter tingkat dan kelas
if (!empty($filter_tingkat) && !empty($filter_kelas)) {
    $conditions[] = "kelas.tingkat = '$filter_tingkat' AND kelas.id_kelas = '$filter_kelas'";
} elseif (!empty($filter_tingkat)) {
    $conditions[] = "kelas.tingkat = '$filter_tingkat'";
}

// Menambahkan filter berdasarkan nama siswa
if (!empty($filter_nama_siswa)) {
    $conditions[] = "siswa.nama_lengkap LIKE '%$filter_nama_siswa%'";
}

// Menambahkan filter berdasarkan nis siswa
if (!empty($filter_nis_siswa)) {
    $conditions[] = "siswa.nis LIKE '%$filter_nis_siswa%'";
}

// Menggabungkan kondisi filter jika ada
if (count($conditions) > 0) {
    $query .= " WHERE " . implode(" AND ", $conditions);
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        /* CSS untuk tombol yang dinonaktifkan */
        a.disabled {
            pointer-events: none;
            opacity: 0.6; 
        }

    </style>
</head>
<body class="bg-gray-100 text-gray-800">
    <?php if (isset($_SESSION['message'])): ?>
        <script>
            alert("<?php echo $_SESSION['message']; ?>");
        </script>
        <?php unset($_SESSION['message']); ?> <!-- Menghapus pesan setelah ditampilkan -->
    <?php endif; ?>

<div class="flex min-h-screen">
    <!-- Sidebar -->
    <?php include '../../layout/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col fixeed ">
        <!-- Navbar -->
        <header class="bg-blue-600 text-white py-4 shadow-md">
            <?php include '../../layout/header.php'; ?>
        </header>

        <!-- Container -->
        <div class="container mx-auto mt-8 px-6">
            <!-- Header -->
            <h1 class="text-4xl font-bold text-white bg-gradient-to-l from-blue-900 via-blue-800 to-blue-500 p-6 rounded-lg shadow-lg mb-4">
                Kelola Data Siswa
            </h1>
            
            <div class="flex justify-between items-center mb-6">
                <a type="submit" href="kelolaDataSiswa.php" class="flex items-center justify-center mb-4 px-4 py-2 bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 text-white font-semibold rounded-md shadow-lg hover:bg-gradient-to-r hover:from-blue-600 hover:via-blue-700 hover:to-blue-800 transition duration-300">
                    <i class="fas fa-sync-alt mr-2"></i> Refresh
                </a>

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
                    <!-- Button untuk memunculkan pop-up Hapus -->
                    <button data-toggle="modal" data-target="#hapusKelasModal" 
                        class="bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600 transition duration-300">
                        <i class="fas fa-trash-alt mr-2"></i> Hapus Kelas
                    </button>
                    <!-- Button untuk memunculkan pop-up Edit -->
                    <button data-toggle="modal" data-target="#editKelasModal" 
                        class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 transition duration-300">
                        <i class="fas fa-edit mr-2"></i> Edit Kelas
                    </button>


                </div>
            </div>

            <!-- Cards Kelas -->
             <h2 class="text-3xl font-italic text-black bg-gradient-to-r from-blue-300 via-blue-100 to-gray-200 p-6 rounded-lg shadow-lg mb-4">
                Filter Siswa Berdasarkan Kelas: 
            </h2>
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
             <div class="flex justify-between items-center mb-6">
                 <form method="GET" action="kelolaDataSiswa.php" class="">
                    <div class="flex space-x-4">
                        <input type="text" name="nama_siswa" placeholder="Cari Nama Siswa" class="px-4 py-2 rounded-md border border-gray-300" value="<?php echo isset($_GET['nama_siswa']) ? $_GET['nama_siswa'] : ''; ?>" />

                        <input type="text" name="nis_siswa" placeholder="Cari NISN Siswa" class="px-4 py-2 rounded-md border border-gray-300" value="<?php echo isset($_GET['nis_siswa']) ? $_GET['nis_siswa'] : ''; ?>" />

                        <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-md">Filter</button>
                    </div>
                </form>
                <!-- Tombol untuk mencetak berdasarkan kelas -->
                <a id="btnCetakKelas" href="cetakDataSiswa.php?tingkat=<?php echo $filter_tingkat; ?>&id_kelas=<?php echo $filter_kelas; ?>" 
                   target="_blank" 
                   class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition duration-300 disabled:opacity-50"
                   <?php echo empty($filter_kelas) ? 'disabled' : ''; ?>>
                   <i class="fas fa-print"></i> Cetak Data <?php echo $judul; ?>
                </a>

                <!-- Tombol untuk mencetak seluruh data siswa -->
                <a id="btnCetakSeluruh" href="cetakDataSiswaSeluruh.php" 
                   target="_blank" 
                   class="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700 transition duration-300">
                   <i class="fas fa-print"></i> Cetak Semua Data Siswa
                </a>



            </div>
            <!-- Data Siswa  -->
            <div class="bg-white rounded-lg shadow-md overflow-x-auto">
                <h2 class="text-4xl font-bold text-white bg-gradient-to-r from-blue-900 via-blue-800 to-blue-500 p-6 rounded-lg shadow-lg mb-4">
                     <?php echo $judul; ?>
                </h2>
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="bg-blue-600 text-white">
                            <th class="py-3 px-4 text-left">ID</th>
                            <th class="py-3 px-4 text-left">NISN</th>
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
                                    <a href="kelolaDataSiswaEdit.php?id_siswa=<?php echo $row['id_siswa']; ?>" 
                                       class="bg-blue-500 text-white rounded-lg shadow-md p-2 hover:bg-blue-700 transition duration-300">
                                        Edit</a>
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

<!-- Modal Edit Kelas -->
<div class="modal fade" id="editKelasModal" tabindex="-1" aria-labelledby="editKelasModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKelasModalLabel">Edit Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="kelolaDataSiswaEditKelas.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_kelas">Pilih Kelas</label>
                        <select class="form-control" id="id_kelas" name="id_kelas" required>
                            <option value="">-- Pilih Kelas --</option>
                            <?php
                            // Query untuk mendapatkan daftar kelas
                            $query_kelas = "SELECT id_kelas, nama_kelas, tingkat FROM kelas ORDER BY tingkat, nama_kelas";
                            $result_kelas = mysqli_query($conn, $query_kelas);
                            while ($kelas = mysqli_fetch_assoc($result_kelas)) {
                                echo "<option value='" . $kelas['id_kelas'] . "'>" . htmlspecialchars($kelas['tingkat']) . " - " . htmlspecialchars($kelas['nama_kelas']) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_kelas">Nama Kelas Baru</label>
                        <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" required>
                    </div>
                    <div class="form-group">
                        <label for="tingkat">Tingkat Baru</label>
                        <select class="form-control" id="tingkat" name="tingkat" required>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
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

<!-- Modal Hapus Kelas -->
<div class="modal fade" id="hapusKelasModal" tabindex="-1" aria-labelledby="hapusKelasModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapusKelasModalLabel">Hapus Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="kelolaDataSiswaHapusKelas.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_kelas">Pilih Kelas untuk Dihapus</label>
                        <select class="form-control" id="id_kelas" name="id_kelas" required>
                            <option value="">-- Pilih Kelas --</option>
                            <?php
                            // Query untuk mendapatkan daftar kelas
                            $query_kelas = "SELECT id_kelas, nama_kelas, tingkat FROM kelas ORDER BY tingkat, nama_kelas";
                            $result_kelas = mysqli_query($conn, $query_kelas);

                            // Menampilkan kelas dalam dropdown
                            while ($kelas = mysqli_fetch_assoc($result_kelas)) {
                                echo "<option value='" . $kelas['id_kelas'] . "'>" . htmlspecialchars($kelas['tingkat']) . " - " . htmlspecialchars($kelas['nama_kelas']) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include '../../layout/footer.php'; ?>


<!-- Include Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script>

    function confirmDelete(id_siswa) {
        if (confirm('Apakah Anda yakin ingin menghapus siswa ini?')) {
            window.location.href = 'kelolaDataSiswaHapus.php?id_siswa=' + id_siswa;
        }
    }
        // Menonaktifkan tombol cetak berdasarkan filter kelas
        const filterKelas = '<?php echo $filter_kelas; ?>';
        const btnCetakKelas = document.getElementById('btnCetakKelas');
        
        // Jika filter kelas kosong, nonaktifkan tombol
        if (!filterKelas) {
            btnCetakKelas.classList.add('disabled');
            btnCetakKelas.setAttribute('disabled', 'true');
        } else {
            btnCetakKelas.classList.remove('disabled');
            btnCetakKelas.removeAttribute('disabled');
        }
</script>

<?php mysqli_close($conn); ?>
</body>
</html>
