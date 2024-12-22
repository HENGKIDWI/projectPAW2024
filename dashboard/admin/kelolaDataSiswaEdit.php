<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

// Menangani pengeditan data siswa
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_siswa = $_POST['id_siswa'];
    $nis = $_POST['nis'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $kelas_id = $_POST['kelas_id'];
    $alamat = $_POST['alamat'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $no_telp = $_POST['no_telp'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $username = $_POST['username'];
    $password = $_POST['password']; // Assuming password is also being updated

    // Update query
    $query = "UPDATE siswa SET 
              nis = '$nis', 
              nama_lengkap = '$nama_lengkap', 
              kelas_id = '$kelas_id', 
              alamat = '$alamat', 
              tanggal_lahir = '$tanggal_lahir', 
              no_telp = '$no_telp', 
              jenis_kelamin = '$jenis_kelamin', 
              username = '$username', 
              `password` = '$password' 
              WHERE id_siswa = '$id_siswa'";

    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = "Update Data Siswa";
    } else {
        $_SESSION['message'] = "Gagal mengupdate data siswa: " . mysqli_error($conn);
    }

    header("Location: kelolaDataSiswa.php");
    exit;
}

// Mendapatkan data siswa berdasarkan id_siswa
if (isset($_GET['id_siswa'])) {
    $id_siswa = $_GET['id_siswa'];
    $query = "SELECT * FROM siswa WHERE id_siswa = '$id_siswa'";
    $result = mysqli_query($conn, $query);
    $siswa = mysqli_fetch_assoc($result);
    if (!$siswa) {
        $_SESSION['message'] = "Data siswa tidak ditemukan!";
        header("Location: kelolaDataSiswa.php");
        exit;
    }
}

// Get the current class count for each class
$query_class_counts = "SELECT kelas_id, COUNT(*) as siswa_count 
                      FROM siswa 
                      GROUP BY kelas_id";
$result_class_counts = mysqli_query($conn, $query_class_counts);
$class_counts = [];
while ($count = mysqli_fetch_assoc($result_class_counts)) {
    $class_counts[$count['kelas_id']] = $count['siswa_count'];
}

// Modified query for kelas to include the count
$query_kelas = "SELECT k.*, 
                (SELECT COUNT(*) FROM siswa s WHERE s.kelas_id = k.id_kelas) as siswa_count 
                FROM kelas k 
                ORDER BY k.tingkat, k.nama_kelas";
$result_kelas = mysqli_query($conn, $query_kelas);

// Store class data in array
$kelas_data = [];
while ($kelas = mysqli_fetch_assoc($result_kelas)) {
    $kelas_data[] = $kelas;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Sidebar -->
    <?php include '../../layout/sidebar.php'; ?>
    
    <!-- Navbar -->
    <header class="bg-blue-600 text-white py-4 shadow-md">
        <?php include '../../layout/header.php'; ?>
    </header>

    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold text-blue-600 text-center mb-6">Edit Data Siswa</h1>
        <a href="kelolaDataSiswa.php" class="flex items-center text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 p-4 rounded-lg shadow-lg transition-all duration-300">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>

        <?php
        if (isset($_SESSION['message'])) {
            echo '<p class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">' . $_SESSION['message'] . '</p>';
            unset($_SESSION['message']);
        }
        ?>

        <form action="" method="POST" class="bg-white shadow-md rounded px-8 py-6">
            <input type="hidden" name="id_siswa" value="<?php echo $siswa['id_siswa']; ?>">

            <div class="mb-4">
                <label for="nis" class="block text-gray-700 font-bold mb-2">NIS:</label>
                <input type="text" name="nis" id="nis" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300" 
                       value="<?php echo $siswa['nis']; ?>" required>
            </div>

            <div class="mb-4">
                <label for="nama_lengkap" class="block text-gray-700 font-bold mb-2">Nama Lengkap:</label>
                <input type="text" name="nama_lengkap" id="nama_lengkap" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300" 
                       value="<?php echo $siswa['nama_lengkap']; ?>" required>
            </div>

            <div class="mb-4">
                <label for="kelas_id" class="block text-gray-700 font-bold mb-2">Kelas:</label>
                <select name="kelas_id" id="kelas_id" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300" required>
                    <?php foreach ($kelas_data as $kelas): 
                        $is_full = $kelas['siswa_count'] >= 32;
                        $current_class = $kelas['id_kelas'] == $siswa['kelas_id'];
                        $disabled = $is_full && !$current_class ? 'disabled' : '';
                        $class_text = $is_full ? ' (PENUH - 32/32 siswa)' : ' (' . $kelas['siswa_count'] . '/32 siswa)';
                    ?>
                        <option value="<?php echo $kelas['id_kelas']; ?>" 
                                <?php echo $current_class ? 'selected' : ''; ?>
                                <?php echo $disabled; ?>
                                <?php echo $is_full ? 'class="text-gray-400"' : ''; ?>>
                            <?php echo $kelas['nama_kelas']; ?> 
                            (<?php echo $kelas['tingkat']; ?>)
                            <?php echo $class_text; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($kelas['siswa_count']) && $kelas['siswa_count'] >= 32): ?>
                    <p class="text-red-500 text-sm mt-1">
                        <i class="fas fa-exclamation-circle"></i>
                        Kelas ini sudah penuh (maksimal 32 siswa)
                    </p>
                <?php endif; ?>
            </div>

            <div class="mb-4">
                <label for="alamat" class="block text-gray-700 font-bold mb-2">Alamat:</label>
                <textarea name="alamat" id="alamat" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300" required><?php echo $siswa['alamat']; ?></textarea>
            </div>

            <div class="mb-4">
                <label for="tanggal_lahir" class="block text-gray-700 font-bold mb-2">Tanggal Lahir:</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300" 
                       value="<?php echo $siswa['tanggal_lahir']; ?>" required>
            </div>

            <div class="mb-4">
                <label for="no_telp" class="block text-gray-700 font-bold mb-2">No. Telepon:</label>
                <input type="text" name="no_telp" id="no_telp" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300" 
                       value="<?php echo $siswa['no_telp']; ?>" required>
            </div>

            <div class="mb-4">
                <label for="jenis_kelamin" class="block text-gray-700 font-bold mb-2">Jenis Kelamin:</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300" required>
                    <option value="laki-laki" <?php echo ($siswa['jenis_kelamin'] == 'laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                    <option value="perempuan" <?php echo ($siswa['jenis_kelamin'] == 'perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="username" class="block text-gray-700 font-bold mb-2">Username:</label>
                <input type="text" name="username" id="username" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300" 
                       value="<?php echo $siswa['username']; ?>" required>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-bold mb-2">Password:</label>
                <input type="password" name="password" id="password" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 rounded hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-300">Simpan Perubahan</button>
        </form>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const kelasSelect = document.getElementById('kelas_id');
        
        // Style disabled options
        Array.from(kelasSelect.options).forEach(option => {
            if (option.disabled) {
                option.style.backgroundColor = '#f3f4f6';
                option.style.color = '#9ca3af';
            }
        });

        // Add warning if selecting a full class
        kelasSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption.text.includes('PENUH')) {
                alert('Perhatian: Kelas ini sudah penuh (32 siswa). Silakan pilih kelas lain.');
                // Reset to previous selection if needed
                this.value = '<?php echo $siswa['kelas_id']; ?>';
            }
        });
    });
    </script>

    <?php include '../../layout/footer.php'; ?>
</body>
</html>