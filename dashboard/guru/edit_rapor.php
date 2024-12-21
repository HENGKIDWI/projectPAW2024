<?php
include "../../koneksi.php";
session_start();

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

// Ambil data rapor berdasarkan ID yang dipilih
if (isset($_GET['id_rapor'])) {
    $id_rapor = $_GET['id_rapor'];
    $query_rapor = "SELECT * FROM rapot WHERE id_rapot = '$id_rapor'";
    $result_rapor = mysqli_query($conn, $query_rapor);
    $rapor = mysqli_fetch_assoc($result_rapor);
}

// Jika form disubmit, update data rapor
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $semester = $_POST['semester'];
    $tahun_ajaran = $_POST['tahun_ajaran'];
    $nilai_rata_rata = $_POST['nilai_rata_rata'];
    $ekskul = $_POST['ekskul'];
    $nilai_ekskul = $_POST['nilai_ekskul'];
    $catatan_wali_kelas = $_POST['catatan_wali_kelas'];

    // Update data rapor
    $update_query = "UPDATE rapot SET 
        semester = '$semester', 
        tahun_ajaran = '$tahun_ajaran', 
        nilai_rata = '$nilai_rata_rata', 
        ekskul = '$ekskul', 
        nilai_ekskul = '$nilai_ekskul', 
        catatan_wali = '$catatan_wali_kelas' 
        WHERE id_rapot = '$id_rapor'";

    if (mysqli_query($conn, $update_query)) {
        header("Location: input_rapot.php"); // Redirect setelah berhasil update
        exit;
    } else {
        echo "Gagal mengupdate data: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Rapor</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <!-- Sidebar & Navbar -->
    <?php include '../../layout/sidebar.php'; ?>
    <header class="bg-blue-600 text-white py-4">
        <?php include '../../layout/header.php'; ?>
    </header>

    <div class="container mx-auto mt-6 px-4">
        <h2 class="text-3xl font-semibold text-center mb-6">Edit Rapor</h2>

        <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
            <form action="" method="POST">
                <!-- Input Semester & Tahun Ajaran -->
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="semester" class="block text-sm font-medium">Semester</label>
                        <select name="semester" id="semester" class="w-full px-3 py-2 border rounded-md" required>
                            <option value="Ganjil" <?php echo $rapor['semester'] == 'Ganjil' ? 'selected' : ''; ?>>Ganjil</option>
                            <option value="Genap" <?php echo $rapor['semester'] == 'Genap' ? 'selected' : ''; ?>>Genap</option>
                        </select>
                    </div>
                    <div>
                        <label for="tahun_ajaran" class="block text-sm font-medium">Tahun Ajaran</label>
                        <input type="text" name="tahun_ajaran" id="tahun_ajaran" class="w-full px-3 py-2 border rounded-md" value="<?php echo $rapor['tahun_ajaran']; ?>" required>
                    </div>
                </div>

                <!-- Nilai Rata-Rata -->
                <div class="mb-4">
                    <label for="nilai_rata_rata" class="block text-sm font-medium">Nilai Rata-Rata</label>
                    <input type="text" name="nilai_rata_rata" id="nilai_rata_rata" class="w-full px-3 py-2 border rounded-md" value="<?php echo $rapor['nilai_rata']; ?>" required>
                </div>

                <!-- Input Ekstrakurikuler -->
                <div class="mb-4">
                    <label for="ekskul" class="block text-sm font-medium">Ekstrakurikuler</label>
                    <input type="text" name="ekskul" class="w-full px-3 py-2 border rounded-md" value="<?php echo $rapor['ekskul']; ?>" required>
                    
                    <label for="nilai_ekskul" class="block text-sm font-medium mt-2">Nilai Ekstrakurikuler</label>
                    <input type="text" name="nilai_ekskul" class="w-full px-3 py-2 border rounded-md" value="<?php echo $rapor['nilai_ekskul']; ?>" required>
                </div>

                <!-- Catatan Wali Kelas -->
                <div class="mb-4">
                    <label for="catatan_wali_kelas" class="block text-sm font-medium">Catatan Wali Kelas</label>
                    <textarea name="catatan_wali_kelas" rows="3" class="w-full px-3 py-2 border rounded-md" required><?php echo $rapor['catatan_wali']; ?></textarea>
                </div>

                <button type="submit" class="w-full py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</body>
</html>
