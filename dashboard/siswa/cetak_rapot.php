<?php
include "../../koneksi.php";
session_start();

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

// Ambil nama siswa dari session
$nama_siswa = $_SESSION['nama_lengkap'];

// Query untuk mendapatkan ID siswa berdasarkan nama lengkap
$query_siswa = "SELECT * FROM siswa, kelas WHERE nama_lengkap = '$nama_siswa' AND kelas_id = id_kelas";
$result_siswa = mysqli_query($conn, $query_siswa);
$siswa = mysqli_fetch_assoc($result_siswa);
$id_siswa = $siswa['id_siswa'];

// Ambil semester dari parameter GET
$semester = isset($_GET['semester']) ? $_GET['semester'] : '';

// Modifikasi query rapor untuk menyertakan semester
$query_rapor = "SELECT r.id_rapot, s.nama_lengkap AS nama_siswa, r.semester, r.tahun_ajaran, r.nilai_rata, r.ekskul, r.nilai_ekskul, r.catatan_wali 
                FROM rapot AS r
                INNER JOIN siswa AS s ON r.siswa_id = s.id_siswa
                WHERE s.id_siswa = '$id_siswa' AND r.semester = '$semester'
                ORDER BY r.tahun_ajaran DESC, r.semester ASC";
$result_rapor = mysqli_query($conn, $query_rapor);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapor Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">
    <!-- Sidebar -->
<?php include '../../layout/sidebar.php'; ?>

<!-- Navbar -->
<header id="header" class="bg-blue-500 text-white py-4 transition-all duration-300 no-print">
    <?php include '../../layout/header.php' ?>
</header>

<!-- Main Content -->
<div id="mainContent" class="container mx-auto mt-8 px-4 transition-all duration-300">
    <div class="container mx-auto mt-6 px-4">
        <h2 class="text-4xl font-bold text-center mb-6 no-print">Rapor Siswa</h2>

        <?php if (mysqli_num_rows($result_rapor) > 0): ?>
            <?php while ($row_rapor = mysqli_fetch_assoc($result_rapor)): ?>
                <div class="bg-white shadow-lg rounded-lg p-6 mb-6 border border-gray-200">
                    <h3 class="text-2xl font-semibold mb-4">Data Siswa</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <p><strong>Nama Siswa:</strong> <?php echo $row_rapor['nama_siswa']; ?></p>
                        <p><strong>NIS:</strong> <?php echo $siswa['nis']; ?></p>
                        <p><strong>Nama Sekolah:</strong> SMP Negeri 1 Tambelangan</p>
                        <p><strong>Kelas:</strong> <?php echo $siswa['tingkat'] . ' ' . $siswa['nama_kelas']; ?></p>
                        <p><strong>Alamat:</strong> <?php echo $siswa['alamat']; ?></p>
                        <p><strong>Semester:</strong> <?php echo $row_rapor['semester']; ?></p>
                        <p><strong>Tahun Ajaran:</strong> <?php echo $row_rapor['tahun_ajaran']; ?></p>
                    </div>

                    <h3 class="text-2xl font-semibold mt-6 mb-4">Detail Hasil Belajar</h3>
                    <table class="table-auto w-full text-left border-collapse border border-gray-200 mb-4">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border border-gray-300 px-4 py-2">No</th>
                                <th class="border border-gray-300 px-4 py-2">Mata Pelajaran</th>
                                <th class="border border-gray-300 px-4 py-2">Nilai Pengetahuan</th>
                                <th class="border border-gray-300 px-4 py-2">Predikat Pengetahuan</th>
                                <th class="border border-gray-300 px-4 py-2">Nilai Keterampilan</th>
                                <th class="border border-gray-300 px-4 py-2">Predikat Keterampilan</th>
                            </tr>
                        </thead>
 <tbody>
                            <?php
                            // Query untuk mendapatkan nilai mata pelajaran berdasarkan id rapor
                            $id_rapor = $row_rapor['id_rapot'];
                            $query_nilai = "SELECT mp.nama_pelajaran, nr.nilai_pengetahuan, nr.predikat_pengetahuan, nr.nilai_keterampilan, nr.predikat_keterampilan
                                            FROM nilai_rapot AS nr
                                            INNER JOIN mata_pelajaran AS mp ON nr.mata_pelajaran_id = mp.id_mata_pelajaran
                                            WHERE nr.rapot_id = '$id_rapor'";
                            $result_nilai = mysqli_query($conn, $query_nilai);

                            if (mysqli_num_rows($result_nilai) > 0): ?>
                                <?php $no = 1; while ($row_nilai = mysqli_fetch_assoc($result_nilai)): ?>
                                    <tr class="hover:bg-gray-50 transition duration-200">
                                        <td class="border border-gray-300 px-4 py-2"><?php echo $no++; ?></td>
                                        <td class="border border-gray-300 px-4 py-2"><?php echo $row_nilai['nama_pelajaran']; ?></td>
                                        <td class="border border-gray-300 px-4 py-2"><?php echo $row_nilai['nilai_pengetahuan']; ?></td>
                                        <td class="border border-gray-300 px-4 py-2"><?php echo $row_nilai['predikat_pengetahuan']; ?></td>
                                        <td class="border border-gray-300 px-4 py-2"><?php echo $row_nilai['nilai_keterampilan']; ?></td>
                                        <td class="border border-gray-300 px-4 py-2"><?php echo $row_nilai['predikat_keterampilan']; ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-gray-500 py-4">Belum ada nilai mata pelajaran yang tersedia.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <p><strong>Ekstrakurikuler:</strong> <?php echo $row_rapor['ekskul']; ?></p>
                    <p><strong>Nilai Ekstrakurikuler:</strong> <?php echo $row_rapor['nilai_ekskul']; ?></p>
                    <h3 class="text-lg font-semibold">Catatan Wali Kelas:</h3>
                    <div class="border border-gray-300 p-4 mt-4">
                        <p><?php echo $row_rapor['catatan_wali']; ?></p>
                    </div>
                    <?php endwhile; ?>
                    
                        
                        
                        <div class="mt-10">
            <h3 class="text-lg font-semibold">Mengetahui:</h3>
            <p class="text-right mb-10">............................................., <?php echo date("d F Y"); ?></p>
            <div class="mt-6 grid grid-cols-3 gap-4">
                <div class="text-center">
                    <p>Orang Tua/Wali</p>
                    <div class="border-t border-gray-400 mt-20"></div>
                </div>
                <div class="text-center mt-20">
                    <p>Kepala Sekolah</p>
                    <div class="border-t border-gray-400 mt-20"></div>
                </div>
                <div class="text-center">
                    <p>Wali Kelas</p>
                    <div class="border-t border-gray-400 mt-20"></div>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="mt-6">
        <button onclick="window.print()" class="py-2 px-4 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition duration-200 no-print">
            Cetak Rapor
        </button>
    </div>
    </div>

    <footer class="bg-blue-600 text-white py-4 mt-6">
        
    </footer>
    <?php else: ?>
                        <div class="bg-white shadow-lg rounded-lg p-6">
                            <p class="text-center text-gray-500">Belum ada data rapor yang tersedia untuk siswa ini.</p>
                        </div>
    <?php endif; ?>
</body>
</html>