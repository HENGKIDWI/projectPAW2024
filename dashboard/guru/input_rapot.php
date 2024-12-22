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

// Query untuk mendapatkan data riwayat rapor
$query_riwayat = "SELECT r.id_rapot, s.nama_lengkap AS nama_siswa, r.semester, r.tahun_ajaran, r.nilai_rata, r.ekskul, r.nilai_ekskul, r.catatan_wali FROM rapot AS r
    INNER JOIN siswa AS s ON r.siswa_id = s.id_siswa
    ORDER BY r.tahun_ajaran DESC, r.semester ASC
";
$result_riwayat = mysqli_query($conn, $query_riwayat);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input dan Riwayat Rapor</title>
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
        <h2 class="text-3xl font-semibold text-center mb-6">Input dan Riwayat Rapor</h2>

        <!-- Form Input Rapor -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
            <h3 class="text-2xl font-semibold mb-4">Form Input Rapor</h3>
            <form action="proses_input_rapot.php" method="POST">
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
                    <p class="text-sm text-gray-600 mt-2">
                        <strong>Rentang Nilai untuk Predikat:</strong><br>
                        A: 85-100<br>
                        B: 70-84<br>
                        C: 55-69<br>
                        D: 0-54
                    </p>
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
                    
                    <!-- Dropdown untuk Nilai Ekstrakurikuler -->
                    <label for="nilai_ekskul" class="block text-sm font-medium mt-2">Nilai Ekstrakurikuler</label>
                    <select name="nilai_ekskul" id="nilai_ekskul" class="w-full px-3 py-2 border rounded-md" required>
                        <option value="A" selected disabled>-- Pilih Nilai --</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
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

    <!-- Riwayor -->
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h3 class="text-2xl font-semibold mb-4">Riwayat Data Input Rapor</h3>
        <table class="table-auto w-full text-left border-collapse border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border border-gray-300 px-4 py-2">No</th>
                    <th class="border border-gray-300 px-4 py-2">Nama Siswa</th>
                    <th class="border border-gray-300 px-4 py-2">Semester</th>
                    <th class="border border-gray-300 px-4 py-2">Tahun Ajaran</th>
                    <th class="border border-gray-300 px-4 py-2">Nilai Rata-Rata</th>
                    <th class="border border-gray-300 px-4 py-2">Ekskul</th>
                    <th class="border border-gray-300 px-4 py-2">Nilai Ekskul</th>
                    <th class="border border-gray-300 px-4 py-2">Catatan Wali Kelas</th>
                    <th class="border border-gray-300 px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result_riwayat) > 0): ?>
                    <?php $no = 1; while ($row = mysqli_fetch_assoc($result_riwayat)): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 px-4 py-2"><?php echo $no++; ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?php echo $row['nama_siswa']; ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?php echo $row['semester']; ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?php echo $row['tahun_ajaran']; ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?php echo $row['nilai_rata']; ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?php echo $row['ekskul']; ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?php echo $row['nilai_ekskul']; ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?php echo $row['catatan_wali']; ?></td>
                            <td class="border border-gray-300 px-4 py-2">
                                <a href="edit_rapor.php?id_rapor=<?php echo $row['id_rapot']; ?>" class="text-blue-600">Edit</a> | 
                                <a href="hapus_rapor.php?id_rapor=<?php echo $row['id_rapot']; ?>" class="text-red-600" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a> | 
                                <a href="cetak_rapor.php?id_rapor=<?php echo $row['id_rapot']; ?>" class="text-green-600">Cetak</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center text-gray-500 py-4">Belum ada data rapor yang diinput.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
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
                const rataRata = count > 0 ? (total / count).toFixed(2) : "";
                rataRataInput.value = rataRata;
            }

            nilaiInputs.forEach(input => {
                input.addEventListener("input", hitungRataRata);
            });
        });
    </script>
</body>
</html>
