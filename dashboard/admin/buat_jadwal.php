<?php
include "../../koneksi.php";
session_start();

// Fungsi untuk mengambil kelas berdasarkan tingkat
function getKelasByTingkat($tingkat) {
    global $conn;
    $query = "SELECT id_kelas, nama_kelas FROM kelas WHERE tingkat = '$tingkat'";
    $result = mysqli_query($conn, $query);
    $kelasOptions = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $kelasOptions[] = $row;
    }
    return $kelasOptions;
}

// Fungsi untuk mengambil pilihan mata pelajaran dan guru
function getOptions($table, $idField, $nameField) {
    global $conn;
    $query = "SELECT $idField, $nameField FROM $table";
    $result = mysqli_query($conn, $query);
    $options = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $options[] = $row;
    }
    return $options;
}

// Mendapatkan data mata pelajaran dan guru
$mapelOptions = getOptions('mata_pelajaran', 'id_mata_pelajaran', 'nama_pelajaran');
$guruOptions = getOptions('guru', 'id_guru', 'nama_lengkap');

// Menangani form submit
$kelasOptions = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tingkat = $_POST['tingkat'];
    if (!empty($tingkat)) {
        $kelasOptions = getKelasByTingkat($tingkat);
    }

    if (isset($_POST['kelas_id'], $_POST['mata_pelajaran_id'], $_POST['guru_id'], $_POST['hari'], $_POST['jam_mulai'], $_POST['jam_selesai'])) {
        $kelas_id = $_POST['kelas_id'];
        $mapel_id = $_POST['mata_pelajaran_id'];
        $guru_id = $_POST['guru_id'];
        $hari = $_POST['hari'];
        $jam_mulai = $_POST['jam_mulai'];
        $jam_selesai = $_POST['jam_selesai'];

        // Validasi input tidak kosong
        if (empty($kelas_id) || empty($mapel_id) || empty($guru_id) || empty($hari) || empty($jam_mulai) || empty($jam_selesai)) {
            echo "<script>alert('Semua field harus diisi!');</script>";
        } else {
            // Debug input
            echo "DEBUG INPUT: Kelas ID: $kelas_id, Mapel ID: $mapel_id, Guru ID: $guru_id, Hari: $hari, Jam Mulai: $jam_mulai, Jam Selesai: $jam_selesai";

            // Cek jadwal bentrok
            $bentrokQuery = "SELECT * FROM jadwal 
                             WHERE hari = '$hari' 
                             AND ((jam_mulai < '$jam_selesai' AND jam_selesai > '$jam_mulai')) 
                             AND (guru_id = '$guru_id' OR kelas_id = '$kelas_id')";

            $result = mysqli_query($conn, $bentrokQuery);

            if (!$result) {
                die("Error Query Bentrok: " . mysqli_error($conn));
            }

            if (mysqli_num_rows($result) > 0) {
                echo "<script>alert('Jadwal bentrok! Pilih waktu, guru, atau kelas lain.');</script>";
            } else {
                // Query insert jadwal
                $insertQuery = "INSERT INTO jadwal (kelas_id, mata_pelajaran_id, guru_id, hari, jam_mulai, jam_selesai) 
                                VALUES ('$kelas_id', '$mapel_id', '$guru_id', '$hari', '$jam_mulai', '$jam_selesai')";

                // Debug query
                echo "DEBUG QUERY: $insertQuery";

                if (mysqli_query($conn, $insertQuery)) {
                    echo "<script>alert('Jadwal berhasil ditambahkan!'); window.location.href='index.php';</script>";
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jadwal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Sidebar -->
    <?php include '../../layout/sidebar.php'; ?>

    <!-- Navbar -->
    <header id="header" class="bg-blue-600 text-white py-4 transition-all duration-300">
        <?php include '../../layout/header.php' ?>
    </header>
    <div class="container mx-auto mt-10 p-6 bg-white shadow-md rounded-md">
        <h2 class="text-2xl font-bold mb-4">Tambah Jadwal</h2>
        <form method="POST" action=""> 
        <div class="mb-4">
    <label for="tingkat" class="block text-gray-700">Tingkat:</label>
    <select name="tingkat" id="tingkat" class="w-full p-2 border border-gray-300 rounded" onchange="this.form.submit()">
        <option value="">Pilih Tingkat</option>
        <option value="7" <?= isset($_POST['tingkat']) && $_POST['tingkat'] == 7 ? 'selected' : ''; ?>>7</option>
        <option value="8" <?= isset($_POST['tingkat']) && $_POST['tingkat'] == 8 ? 'selected' : ''; ?>>8</option>
        <option value="9" <?= isset($_POST['tingkat']) && $_POST['tingkat'] == 9 ? 'selected' : ''; ?>>9</option>
    </select>
</div>

<?php if (!empty($kelasOptions)) : ?>
<div class="mb-4">
    <label for="kelas_id" class="block text-gray-700">Kelas:</label>
    <select name="kelas_id" id="kelas_id" class="w-full p-2 border border-gray-300 rounded">
        <option value="">Pilih Kelas</option>
        <?php foreach ($kelasOptions as $kelas) : ?>
            <option value="<?= $kelas['id_kelas'] ?>"><?= $kelas['nama_kelas'] ?></option>
        <?php endforeach; ?>
    </select>
</div>
<?php endif; ?>

            <div class="mb-4">
                <label for="mata_pelajaran_id" class="block text-gray-700">Mata Pelajaran:</label>
                <select name="mata_pelajaran_id" id="mata_pelajaran_id" class="w-full p-2 border border-gray-300 rounded">
                    <option value="">Pilih Mata Pelajaran</option>
                    <?php foreach ($mapelOptions as $mapel) : ?>
                        <option value="<?= $mapel['id_mata_pelajaran'] ?>"><?= $mapel['nama_pelajaran'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-4">
                <label for="guru_id" class="block text-gray-700">Guru:</label>
                <select name="guru_id" id="guru_id" class="w-full p-2 border border-gray-300 rounded">
                    <option value="">Pilih Guru</option>
                    <?php foreach ($guruOptions as $guru) : ?>
                        <option value="<?= $guru['id_guru'] ?>"><?= $guru['nama_lengkap'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-4">
                <label for="hari" class="block text-gray-700">Hari:</label>
                <select name="hari" id="hari" class="w-full p-2 border border-gray-300 rounded">
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="jam_mulai" class="block text-gray-700">Jam Mulai:</label>
                <input type="time" name="jam_mulai" id="jam_mulai" class="w-full p-2 border border-gray-300 rounded">
            </div>

            <div class="mb-4">
                <label for="jam_selesai" class="block text-gray-700">Jam Selesai:</label>
                <input type="time" name="jam_selesai" id="jam_selesai" class="w-full p-2 border border-gray-300 rounded">
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
        </form>
        <?php
// Query untuk mengambil semua data jadwal
$jadwalQuery = "SELECT j.id_jadwal, k.nama_kelas, k.tingkat, m.nama_pelajaran, g.nama_lengkap, j.hari, j.jam_mulai, j.jam_selesai 
                FROM jadwal j
                JOIN kelas k ON j.kelas_id = k.id_kelas
                JOIN mata_pelajaran m ON j.mata_pelajaran_id = m.id_mata_pelajaran
                JOIN guru g ON j.guru_id = g.id_guru
                ORDER BY k.tingkat, j.hari, j.jam_mulai";

$jadwalResult = mysqli_query($conn, $jadwalQuery);

if (!$jadwalResult) {
    die("Error Query Jadwal: " . mysqli_error($conn));
}
?>

<!-- Tabel Data Jadwal -->
<div class="container mx-auto mt-10 p-6 bg-white shadow-md rounded-md">
    <h2 class="text-2xl font-bold mb-4">Data Jadwal</h2>
    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr class="w-full bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">No</th>
                <th class="py-3 px-6 text-left">Tingkat</th>
                <th class="py-3 px-6 text-left">Kelas</th>
                <th class="py-3 px-6 text-left">Mata Pelajaran</th>
                <th class="py-3 px-6 text-left">Guru</th>
                <th class="py-3 px-6 text-left">Hari</th>
                <th class="py-3 px-6 text-left">Jam Mulai</th>
                <th class="py-3 px-6 text-left">Jam Selesai</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            <?php if (mysqli_num_rows($jadwalResult) > 0): ?>
                <?php $no = 1; ?>
                <?php while ($row = mysqli_fetch_assoc($jadwalResult)): ?>
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6"><?= $no++; ?></td>
                        <td class="py-3 px-6"><?= $row['tingkat']; ?></td>
                        <td class="py-3 px-6"><?= $row['nama_kelas']; ?></td>
                        <td class="py-3 px-6"><?= $row['nama_pelajaran']; ?></td>
                        <td class="py-3 px-6"><?= $row['nama_lengkap']; ?></td>
                        <td class="py-3 px-6"><?= $row['hari']; ?></td>
                        <td class="py-3 px-6"><?= $row['jam_mulai']; ?></td>
                        <td class="py-3 px-6"><?= $row['jam_selesai']; ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="py-3 px-6 text-center text-red-500">Belum ada data jadwal</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
    </div>
</body>
</html>
