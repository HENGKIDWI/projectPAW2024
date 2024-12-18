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
                            <div class="grid grid-cols-4 gap-2">
                                <input type="hidden" name="id_mapel[]" value="<?php echo $mapel['id_mata_pelajaran']; ?>">
                                <input type="number" name="nilai_pengetahuan[]" class="px-3 py-2 border rounded-md" placeholder="Nilai Pengetahuan" min="0" max="100" required>
                                <input type="text" name="predikat_pengetahuan[]" class="px-3 py-2 border rounded-md" placeholder="Predikat (A/B/C/D)" required>
                                <input type="number" name="nilai_keterampilan[]" class="px-3 py-2 border rounded-md" placeholder="Nilai Keterampilan" min="0" max="100" required>
                                <input type="text" name="predikat_keterampilan[]" class="px-3 py-2 border rounded-md" placeholder="Predikat (A/B/C/D)" required>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>

                <!-- Nilai Rata-Rata -->
                <div class="mb-4">
                    <label for="nilai_rata_rata" class="block text-sm font-medium">Nilai Rata-Rata</label>
                    <input type="text" name="nilai_rata_rata" id="nilai_rata_rata" class="w-full px-3 py-2 border rounded-md bg-gray-200" placeholder="Otomatis dihitung" readonly>
                </div>

                <!-- Input Ekstrakurikuler -->
                <div class="mb-4">
                    <h3 class="text-lg font-semibold mb-2">Ekstrakurikuler</h3>
                    <input type="text" name="ekskul" class="w-full px-3 py-2 border rounded-md" placeholder="Nama Ekstrakurikuler" required>
                    <input type="number" name="nilai_ekskul" class="w-full px-3 py-2 border rounded-md mt-2" placeholder="Nilai Ekstrakurikuler" min="0" max="100" required>
                </div>

                <!-- Input Prestasi -->
                <div class="mb-4">
                    <h3 class="text-lg font-semibold mb-2">Prestasi Siswa</h3>
                    <input type="text" name="prestasi_akademik" class="w-full px-3 py-2 border rounded-md" placeholder="Prestasi Akademik">
                    <input type="text" name="prestasi_non_akademik" class="w-full px-3 py-2 border rounded-md mt-2" placeholder="Prestasi Non-Akademik">
                </div>

                <!-- Catatan Wali Kelas -->
                <div class="mb-4">
                    <label for="catatan_wali_kelas" class="block text-sm font-medium">Catatan Wali Kelas</label>
                    <textarea name="catatan_wali_kelas" rows="3" class="w-full px-3 py-2 border rounded-md" placeholder="Catatan perkembangan siswa..."></textarea>
                </div>

                <button type="submit" class="w-full py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700">
                    Simpan Rapor
                </button>
            </form>
        </div>
    </div>

    <?php require_once "../../layout/footer.php"; ?>

    <!-- JavaScript Hitung Rata-Rata -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const nilaiInputs = document.querySelectorAll('input[name="nilai_pengetahuan[]"], input[name="nilai_keterampilan[]"]');
            const rataRataInput = document.getElementById("nilai_rata_rata");

            function hitungRataRata() {
                let total = 0, count = 0;
                nilaiInputs.forEach(input => {
                    const nilai = parseFloat(input.value);
                    if (!isNaN(nilai)) {
                        total += nilai;
                        count++;
                    }
                });
                const rataRata = count > 0 ? (total / count).toFixed(2) : 0;
                rataRataInput.value = rataRata;
            }

            nilaiInputs.forEach(input => input.addEventListener("input", hitungRataRata));
        });
    </script>
</body>
</html>
