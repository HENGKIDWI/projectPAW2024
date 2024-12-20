<?php
include "../../koneksi.php";
session_start();

// Fungsi untuk mengambil daftar kelas
function getDaftarKelas($guru_id) {
    global $conn;
    $guru_id = mysqli_real_escape_string($conn, $guru_id);
    $query = "SELECT DISTINCT kelas.* FROM kelas 
              JOIN jadwal ON kelas.id_kelas = jadwal.kelas_id 
              WHERE jadwal.guru_id = '$guru_id'";
    return mysqli_query($conn, $query);
}

// Ambil data tugas berdasarkan ID
$tugas_id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : null;
if (!$tugas_id) {
    header("Location: riwayat_tugas.php");
    exit();
}

$query = "SELECT * FROM tugas WHERE id_tugas = '$tugas_id'";
$result = mysqli_query($conn, $query);
$tugas = mysqli_fetch_assoc($result);

if (!$tugas) {
    header("Location: riwayat_tugas.php");
    exit();
}

// Proses form jika disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi input
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $poin = intval($_POST['poin']);
    $kelas_id = mysqli_real_escape_string($conn, $_POST['kelas']);
    $deadline = mysqli_real_escape_string($conn, $_POST['deadline']);
    
    // Proses upload file tugas baru (jika ada)
    $file_tugas = $tugas['file_tugas']; // Gunakan file lama secara default
    if (!empty($_FILES['file_tugas']['name'])) {
        $target_dir = "uploads/tugas/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $file_name = uniqid() . '_' . basename($_FILES['file_tugas']['name']);
        $target_file = $target_dir . $file_name;
        
        if (move_uploaded_file($_FILES['file_tugas']['tmp_name'], $target_file)) {
            // Hapus file lama jika ada
            if ($tugas['file_tugas'] && file_exists($target_dir . $tugas['file_tugas'])) {
                unlink($target_dir . $tugas['file_tugas']);
            }
            $file_tugas = $file_name;
        } else {
            $error_message = "Maaf, terjadi kesalahan saat upload file.";
        }
    }
    
    // URL tugas (opsional)
    $url_tugas = !empty($_POST['url_tugas']) ? mysqli_real_escape_string($conn, $_POST['url_tugas']) : null;
    
    // Query update tugas
    $query = "UPDATE tugas SET 
        judul = '$judul',
        deskripsi = '$deskripsi',
        file_tugas = " . ($file_tugas ? "'$file_tugas'" : "NULL") . ",
        url_tugas = " . ($url_tugas ? "'$url_tugas'" : "NULL") . ",
        poin = $poin,
        kelas_id = '$kelas_id',
        deadline = '$deadline'
        WHERE id_tugas = '$tugas_id'";
    
    if (mysqli_query($conn, $query)) {
        $success_message = "Tugas berhasil diperbarui!";
        header("Location: riwayat_tugas.php");
        exit();
    } else {
        $error_message = "Error: " . mysqli_error($conn);
    }
}

$guru_id = $_SESSION['guru_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tugas Guru</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <!-- Sidebar -->
    <?php include '../../layout/sidebar.php'; ?>
    
    <!-- Navbar -->
    <header id="header" class="bg-blue-600 text-white py-4 transition-all duration-300">
        <?php include '../../layout/header.php'; ?>
    </header>

    <!-- Main Content -->
    <div class="container mx-auto mt-8 px-4">
        <h2 class="text-2xl font-bold text-center mb-6">Edit Tugas Siswa</h2>

        <?php 
        if (isset($success_message)) {
            echo "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4' role='alert'>$success_message</div>";
        }
        if (isset($error_message)) {
            echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4' role='alert'>$error_message</div>";
        }
        ?>

        <div class="bg-white shadow-md rounded-lg p-8 max-w-2xl mx-auto">
            <form action="" method="POST" enctype="multipart/form-data">
                <!-- Judul Tugas -->
                <div class="mb-4">
                    <label for="judul" class="block text-gray-700 font-bold mb-2">Judul Tugas</label>
                    <input type="text" id="judul" name="judul" required 
                        value="<?php echo htmlspecialchars($tugas['judul']); ?>"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan judul tugas">
                </div>

                <!-- Deskripsi Tugas -->
                <div class="mb-4">
                    <label for="deskripsi" class="block text-gray-700 font-bold mb-2">Deskripsi Tugas</label>
                    <textarea id="deskripsi" name="deskripsi" rows="4" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Jelaskan detail tugas"><?php echo htmlspecialchars($tugas['deskripsi']); ?></textarea>
                </div>

                <!-- File Tugas (Opsional) -->
                <div class="mb-4">
                    <label for="file_tugas" class="block text-gray-700 font-bold mb-2">File Tugas (Opsional)</label>
                    <?php if ($tugas['file_tugas']): ?>
                        <p class="text-sm text-gray-600 mb-2">File saat ini: <?php echo htmlspecialchars($tugas['file_tugas']); ?></p>
                    <?php endif; ?>
                    <input type="file" id="file_tugas" name="file_tugas" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- URL Tugas (Opsional) -->
                <div class="mb-4">
                    <label for="url_tugas" class="block text-gray-700 font-bold mb-2">URL Tugas (Opsional)</label>
                    <input type="url" id="url_tugas" name="url_tugas" 
                        value="<?php echo htmlspecialchars($tugas['url_tugas'] ?? ''); ?>"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="https://example.com/tugas">
                </div>

                <!-- Poin Tugas -->
                <div class="mb-4">
                    <label for="poin" class="block text-gray-700 font-bold mb-2">Poin Tugas</label>
                    <input type="number" id="poin" name="poin" required min="0" max="100"
                        value="<?php echo htmlspecialchars($tugas['poin']); ?>"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan poin tugas">
                </div>

                <!-- Deadline -->
                <div class="mb-4">
                    <label for="deadline" class="block text-gray-700 font-bold mb-2">Deadline Tugas</label>
                    <input type="datetime-local" id="deadline" name="deadline" required
                        value="<?php echo date('Y-m-d\TH:i', strtotime($tugas['deadline'])); ?>"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Pilih Kelas -->
                <div class="mb-4">
                    <label for="kelas" class="block text-gray-700 font-bold mb-2">Pilih Kelas</label>
                    <select id="kelas" name="kelas" required 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih Kelas</option>
                        <?php 
                        $kelas_list = getDaftarKelas($guru_id);
                        while ($row = mysqli_fetch_assoc($kelas_list)) {
                            $selected = ($row['id_kelas'] == $tugas['kelas_id']) ? 'selected' : '';
                            echo "<option value='" . $row['id_kelas'] . "' $selected>" . $row['tingkat'],$row['nama_kelas'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="text-right">
                    <a href="riwayat_tugas.php" class="bg-gray-500 text-white px-4 py-2 rounded shadow hover:bg-gray-600">Batal</a>
                    <button type="submit" 
                        class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition duration-300">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>