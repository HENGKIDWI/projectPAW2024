<?php
include "../../koneksi.php";
session_start();

// Fungsi untuk mengambil daftar kelas
function getDaftarKelas() {
    global $conn;
    $query = "SELECT * FROM kelas";
    return mysqli_query($conn, $query);
}

// Proses form jika disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi input
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $poin = intval($_POST['poin']);
    $kelas_id = mysqli_real_escape_string($conn, $_POST['kelas']);
    $deadline = mysqli_real_escape_string($conn, $_POST['deadline']);
    
    // Proses upload file tugas (opsional)
    $file_tugas = null;
    if (!empty($_FILES['file_tugas']['name'])) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $file_name = uniqid() . '_' . basename($_FILES['file_tugas']['name']);
        $target_file = $target_dir . $file_name;
        
        if (move_uploaded_file($_FILES['file_tugas']['tmp_name'], $target_file)) {
            $file_tugas = $file_name;
        } else {
            $error_message = "Maaf, terjadi kesalahan saat upload file.";
        }
    }
    
    // URL tugas (opsional)
    $url_tugas = !empty($_POST['url_tugas']) ? mysqli_real_escape_string($conn, $_POST['url_tugas']) : null;
    
    // Query insert tugas
    $query = "INSERT INTO tugas (
        judul, 
        deskripsi, 
        file_tugas, 
        url_tugas, 
        poin, 
        kelas_id, 
        deadline, 
        created_at
    ) VALUES (
        '$judul', 
        '$deskripsi', 
        " . ($file_tugas ? "'$file_tugas'" : "NULL") . ", 
        " . ($url_tugas ? "'$url_tugas'" : "NULL") . ", 
        $poin, 
        '$kelas_id', 
        '$deadline', 
        NOW()
    )";
    
    if (mysqli_query($conn, $query)) {
        $success_message = "Tugas berhasil ditambahkan!";
    } else {
        $error_message = "Error: " . mysqli_error($conn);
    }
}

function getRiwayatTugas() {
    global $conn;
    $query = "SELECT * FROM tugas as tg
    CROSS JOIN mata_pelajaran as mp 
    CROSS JOIN kelas as kls
    WHERE tg.mata_pelajaran_id = mp.id_mata_pelajaran 
    AND tg.kelas_id=kls.id_kelas";
    return mysqli_query($conn, $query);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Tugas Guru</title>
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
        <h2 class="text-2xl font-bold text-center mb-6">Halaman Tugas</h2>

    <!-- button tambah tugas -->
    <div class="bg-white shadow-md rounded-lg p-6 mt-8">
    <div class="flex justify-between items-center mb-4">
        <div class="text-xl font-semibold text-blue-600">Riwayat Tugas</div>
        <a href="input_tugas.php" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-green-600 transition duration-300 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Tambah Tugas Baru
        </a>
    </div>

    <table class="w-full table-auto border-collapse">
        <thead class="bg-blue-600 text-white">
            <tr>
                <th class="py-2 px-4 border">No</th>
                <th class="py-2 px-4 border">Mata Pelajaran</th>
                <th class="py-2 px-4 border">Kelas</th>
                <th class="py-2 px-4 border">Judul Tugas</th>
                <th class="py-2 px-4 border">Dikumpulkan</th>
                <th class="py-2 px-4 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $riwayat_tugas = getRiwayatTugas();
            if (mysqli_num_rows($riwayat_tugas) > 0) {
                $no = 1;
                while ($row = mysqli_fetch_assoc($riwayat_tugas)) {
                    echo "<tr>";
                    echo "<td class='py-2 px-4 border text-center'>" . $no++ . "</td>";
                    echo "<td class='py-2 px-4 border'>" . $row['nama_pelajaran'] . "</td>";
                    echo "<td class='py-2 px-4 border text-center'>" . $row['tingkat'],$row["nama_kelas"] . "</td>";
                    echo "<td class='py-2 px-4 border'>" . $row['judul'] . "</td>";
                    // echo "<td class='py-2 px-4 border text-center'>" . $row['dikumpulkan'] . "</td>";
                    echo "<td class='py-2 px-4 border text-center'>";
                    // echo "<a href='detail_tugas.php?id=" . $row['no'] . "' class='bg-blue-500 text-white py-1 px-3 rounded-md text-sm hover:bg-blue-400'>Detail</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center py-2 px-4 border'>Belum ada tugas yang dibuat.</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
    </div>

    <!-- histori tugas -->


    <?php
    require_once "../../layout/footer.php"
    ?>
</body>
</html>