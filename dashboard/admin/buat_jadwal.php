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
    $tingkat = $_POST['tingkat'];  // Menyimpan tingkat yang dipilih
    // Ambil kelas berdasarkan tingkat yang dipilih
    if (!empty($tingkat)) {
        $kelasOptions = getKelasByTingkat($tingkat);
    }

    // Proses penambahan jadwal setelah tombol simpan diklik
    if (isset($_POST['kelas_id'], $_POST['mata_pelajaran_id'], $_POST['guru_id'], $_POST['hari'], $_POST['jam_mulai'], $_POST['jam_selesai'])) {
        $kelas_id = $_POST['kelas_id'];
        $mapel_id = $_POST['mata_pelajaran_id'];
        $guru_id = $_POST['guru_id'];
        $hari = $_POST['hari'];
        $jam_mulai = $_POST['jam_mulai'];
        $jam_selesai = $_POST['jam_selesai'];

        // Validasi jika kelas_id kosong
        if (empty($kelas_id) || empty($mapel_id) || empty($guru_id) || empty($hari) || empty($jam_mulai) || empty($jam_selesai)) {
            echo "<script>alert('Semua field harus diisi!');</script>";
        } else {
            // Validasi bentrok jadwal
            $bentrokQuery = "SELECT * FROM jadwal 
                             WHERE hari = '$hari' 
                             AND (
                                 (jam_mulai < '$jam_selesai' AND jam_selesai > '$jam_mulai') 
                             ) 
                             AND (guru_id = '$guru_id' OR kelas_id = '$kelas_id')";

            $result = mysqli_query($conn, $bentrokQuery);

            if (mysqli_num_rows($result) > 0) {
                echo "<script>alert('Jadwal bentrok! Harap pilih waktu atau guru/kelas lain.');</script>";
            } else {
                // Jika tidak ada bentrok, simpan jadwal
                $insertQuery = "INSERT INTO jadwal (kelas_id, mata_pelajaran_id, guru_id, hari, jam_mulai, jam_selesai) 
                                VALUES ('$kelas_id', '$mapel_id', '$guru_id', '$hari', '$jam_mulai', '$jam_selesai')";

                if (mysqli_query($conn, $insertQuery)) {
                    echo "<script>alert('Jadwal berhasil ditambahkan!'); window.location.href='index.php';</script>";
                } else {
                    echo "<script>alert('Gagal menambahkan jadwal.');</script>";
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
    <h2 class="text-2xl font-bold mb-4">Tambah Jadwal</h2>
    <div class="container mx-auto mt-10 p-6 bg-white shadow-md rounded-md">
        <form method="POST" action=""> 

            <!-- Dropdown untuk memilih tingkat -->
            <div class="mb-4">
                <label for="tingkat" class="block text-gray-700">Tingkat:</label>
                <select name="tingkat" id="tingkat" class="w-full p-2 border border-gray-300 rounded">
                    <option value="">Pilih Tingkat</option>
                    <option value="7" <?= isset($_POST['tingkat']) && $_POST['tingkat'] == 7 ? 'selected' : ''; ?>>7</option>
                    <option value="8" <?= isset($_POST['tingkat']) && $_POST['tingkat'] == 8 ? 'selected' : ''; ?>>8</option>
                    <option value="9" <?= isset($_POST['tingkat']) && $_POST['tingkat'] == 9 ? 'selected' : ''; ?>>9</option>
                </select>
            </div>

            <!-- Dropdown untuk memilih kelas, hanya muncul setelah tingkat dipilih -->
            <?php if (isset($_POST['tingkat'])) : ?>
            <div class="mb-4">
                <label for="kelas_id" class="block text-gray-700">Kelas:</label>
                <select name="kelas_id" id="kelas_id" class="w-full p-2 border border-gray-300 rounded">
                    <option value="">Pilih Kelas</option>
                    <?php foreach ($kelasOptions as $kelas) : ?>
                        <option value="<?= $kelas['id_kelas'] ?>" <?= isset($_POST['kelas_id']) && $_POST['kelas_id'] == $kelas['id_kelas'] ? 'selected' : ''; ?>>
                            <?= $kelas['nama_kelas'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <?php endif; ?>

            <!-- Mata Pelajaran -->
            <div class="mb-4">
                <label for="mata_pelajaran_id" class="block text-gray-700">Mata Pelajaran:</label>
                <select name="mata_pelajaran_id" id="mata_pelajaran_id" class="w-full p-2 border border-gray-300 rounded">
                    <option value="">Pilih Mata Pelajaran</option>
                    <?php foreach ($mapelOptions as $mapel) : ?>
                        <option value="<?= $mapel['id_mata_pelajaran'] ?>"><?= $mapel['nama_pelajaran'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Guru -->
            <div class="mb-4">
                <label for="guru_id" class="block text-gray-700">Guru:</label>
                <select name="guru_id" id="guru_id" class="w-full p-2 border border-gray-300 rounded">
                    <option value="">Pilih Guru</option>
                    <?php foreach ($guruOptions as $guru) : ?>
                        <option value="<?= $guru['id_guru'] ?>"><?= $guru['nama_lengkap'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Hari -->
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

            <!-- Jam Mulai -->
            <div class="mb-4">
                <label for="jam_mulai" class="block text-gray-700">Jam Mulai:</label>
                <input type="time" name="jam_mulai" id="jam_mulai" class="w-full p-2 border border-gray-300 rounded">
            </div>

            <!-- Jam Selesai -->
            <div class="mb-4">
                <label for="jam_selesai" class="block text-gray-700">Jam Selesai:</label>
                <input type="time" name="jam_selesai" id="jam_selesai" class="w-full p-2 border border-gray-300 rounded">
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
        </form>
    </div>

    <!-- Tabel Riwayat Jadwal -->
    <div class="container mx-auto mt-10 px-6 py-4 bg-white shadow-md rounded-md">
        <h3 class="text-xl font-semibold mb-4 text-center">Riwayat Jadwal</h3>
        <table class="min-w-full table-auto border border-gray-300">
            <thead class="bg-gray-200 text-center">
                <tr>
                    <th class="p-3 text-sm text-gray-700">No</th> <!-- Added 'No' column -->
                    <th class="p-3 text-sm text-gray-700">Tingkat</th>
                    <th class="p-3 text-sm text-gray-700">Kelas</th>
                    <th class="p-3 text-sm text-gray-700">Mata Pelajaran</th>
                    <th class="p-3 text-sm text-gray-700">Guru</th>
                    <th class="p-3 text-sm text-gray-700">Hari</th>
                    <th class="p-3 text-sm text-gray-700">Jam Mulai</th>
                    <th class="p-3 text-sm text-gray-700">Jam Selesai</th>
                    <th class="p-3 text-sm text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php
                // Menampilkan riwayat jadwal
                $riwayatQuery = "SELECT j.id_jadwal, k.nama_kelas, k.tingkat, mp.nama_pelajaran, g.nama_lengkap AS nama_guru, j.hari, j.jam_mulai, j.jam_selesai
                FROM jadwal j
                JOIN kelas k ON j.kelas_id = k.id_kelas
                JOIN mata_pelajaran mp ON j.mata_pelajaran_id = mp.id_mata_pelajaran
                JOIN guru g ON j.guru_id = g.id_guru";
                $riwayatResult = mysqli_query($conn, $riwayatQuery);
                ?>
                <?php $no = 1; // Initialize row number ?>
                <?php while ($row = mysqli_fetch_assoc($riwayatResult)) : ?>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3 text-sm"><?= $no++ ?></td> <!-- Display row number here -->
                        <td class="p-3 text-sm"><?= $row['tingkat'] ?></td>
                        <td class="p-3 text-sm"><?= $row['nama_kelas'] ?></td>
                        <td class="p-3 text-sm"><?= $row['nama_pelajaran'] ?></td>
                        <td class="p-3 text-sm"><?= $row['nama_guru'] ?></td>
                        <td class="p-3 text-sm"><?= $row['hari'] ?></td>
                        <td class="p-3 text-sm"><?= $row['jam_mulai'] ?></td>
                        <td class="p-3 text-sm"><?= $row['jam_selesai'] ?></td>
                        <td class="p-3">
                            <a href="edit_jadwal.php?id=<?= $row['id_jadwal'] ?>" class="text-blue-500 hover:text-blue-700">Edit</a> | 
                            <a href="delete_jadwal.php?id=<?= $row['id_jadwal'] ?>" class="text-red-500 hover:text-red-700" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
