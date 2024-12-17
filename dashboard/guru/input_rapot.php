<?php
include "../../koneksi.php";
session_start();

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

// Ambil data siswa untuk dropdown
$query_siswa = "SELECT id_siswa, nama_lengkap FROM siswa";
$result_siswa = mysqli_query($conn, $query_siswa);

// Ambil data mata pelajaran untuk input nilai
$query_mapel = "SELECT id_mata_pelajaran, nama_pelajaran FROM mata_pelajaran";
$result_mapel = mysqli_query($conn, $query_mapel);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Rapor Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <!-- Sidebar -->
    <?php include '../../layout/sidebar.php'; ?>

    <!-- Navbar -->
    <header class="bg-blue-600 text-white py-4">
        <?php include '../../layout/header.php'; ?>
    </header>

    <!-- Main Content -->
    <div class="container mx-auto mt-6 px-4">
        <h2 class="text-3xl font-semibold text-center mb-6">Input Rapor Siswa</h2>

        <!-- Form Input Rapor -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <form action="proses_input_rapor.php" method="POST">
                <!-- Dropdown Siswa -->
                <div class="mb-4">
                    <label for="id_siswa" class="block text-sm font-medium">Nama Siswa</label>
                    <select id="id_siswa" name="id_siswa" class="w-full px-3 py-2 border rounded-md" required>
                        <option value="" disabled selected>-- Pilih Siswa --</option>
                        <?php while ($siswa = mysqli_fetch_assoc($result_siswa)): ?>
                            <option value="<?php echo $siswa['id_siswa']; ?>">
                                <?php echo $siswa['nama_lengkap']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <!-- Input Semester & Tahun Ajaran -->
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="semester" class="block text-sm font-medium">Semester</label>
                        <select name="semester" id="semester" class="w-full px-3 py-2 border rounded-md" required>
                            <option value="Ganjil">Ganjil</option>
                            <option value="Genap">Genap</option>
                        </select>
                    </div>
                    <div>
                        <label for="tahun_ajaran" class="block text-sm font-medium">Tahun Ajaran</label>
                        <input type="text" name="tahun_ajaran" id="tahun_ajaran" class="w-full px-3 py-2 border rounded-md" placeholder="Contoh: 2023/2024" required>
                    </div>
                </div>

                <!-- Input Nilai Mata Pelajaran -->
                <div class="mb-4">
                    <h3 class="text-lg font-semibold mb-2">Nilai Mata Pelajaran</h3>
                    <?php while ($mapel = mysqli_fetch_assoc($result_mapel)): ?>
                        <div class="mb-2">
                            <label class="block font-medium"><?php echo $mapel['nama_pelajaran']; ?></label>
                            <div class="grid grid-cols-3 gap-2">
                                <input type="hidden" name="id_mapel[]" value="<?php echo $mapel['id_mata_pelajaran']; ?>">
                                <input type="number" name="nilai_pengetahuan[]" class="px-3 py-2 border rounded-md" placeholder="Nilai Pengetahuan" min="0" max="100" required>
                                <input type="number" name="nilai_keterampilan[]" class="px-3 py-2 border rounded-md" placeholder="Nilai Keterampilan" min="0" max="100" required>
                                <input type="text" name="predikat[]" class="px-3 py-2 border rounded-md" placeholder="Predikat (A/B/C/D)" required>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>

                <!-- Input Nilai Spiritual & Sosial -->
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="nilai_spiritual" class="block text-sm font-medium">Nilai Spiritual</label>
                        <select name="nilai_spiritual" id="nilai_spiritual" class="w-full px-3 py-2 border rounded-md" required>
                            <option value="Baik">Baik</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Kurang">Kurang</option>
                        </select>
                    </div>
                    <div>
                        <label for="nilai_sosial" class="block text-sm font-medium">Nilai Sosial</label>
                        <select name="nilai_sosial" id="nilai_sosial" class="w-full px-3 py-2 border rounded-md" required>
                            <option value="Baik">Baik</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Kurang">Kurang</option>
                        </select>
                    </div>
                </div>

                <!-- Input Kehadiran -->
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div>
                        <label for="sakit" class="block text-sm font-medium">Sakit</label>
                        <input type="number" name="sakit" id="sakit" class="w-full px-3 py-2 border rounded-md" min="0" placeholder="Jumlah hari">
                    </div>
                    <div>
                        <label for="izin" class="block text-sm font-medium">Izin</label>
                        <input type="number" name="izin" id="izin" class="w-full px-3 py-2 border rounded-md" min="0" placeholder="Jumlah hari">
                    </div>
                    <div>
                        <label for="alfa" class="block text-sm font-medium">Tanpa Keterangan</label>
                        <input type="number" name="alfa" id="alfa" class="w-full px-3 py-2 border rounded-md" min="0" placeholder="Jumlah hari">
                    </div>
                </div>

                <button type="submit" class="w-full py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700">
                    Simpan Rapor
                </button>
            </form>
        </div>
    </div>

    <?php require_once "../../layout/footer.php"; ?>
</body>
</html>
