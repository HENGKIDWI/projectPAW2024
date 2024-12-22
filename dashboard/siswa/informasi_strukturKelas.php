<?php
// Koneksi ke database
include "../../koneksi.php";
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

// Fungsi untuk mendapatkan semua kelas
function getKelas() {
    global $conn;
    $query = "SELECT id_kelas, nama_kelas, tingkat FROM kelas ORDER BY tingkat ASC, nama_kelas ASC";
    $result = mysqli_query($conn, $query);
    return $result;
}

// Fungsi untuk mendapatkan struktur kelas berdasarkan kelas
function getStrukturKelas($kelas_id) {
    global $conn;
    $query = "SELECT sk.id_struktural, k.nama_kelas, s.nama_lengkap, sk.jabatan
              FROM struktural_kelas AS sk
              JOIN kelas AS k ON sk.id_kelas = k.id_kelas
              JOIN siswa AS s ON sk.siswa_id = s.id_siswa
              WHERE sk.id_kelas = '$kelas_id'"; // Filter berdasarkan ID kelas
    $result = mysqli_query($conn, $query);
    return $result;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struktur Kelas per Kelas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

    <!-- Sidebar -->
    <?php include '../../layout/sidebar.php'; ?>

    <!-- Navbar -->
    <header id="header" class="bg-blue-600 text-white py-4">
        <?php include '../../layout/header.php'; ?>
    </header>

    <!-- Main Content -->
    <div class="container mx-auto mt-8 px-6">
        <h2 class="text-3xl font-semibold text-center mb-6 text-gray-800">Struktur Kelas per Kelas</h2>

        <!-- Daftar Kelas -->
        <?php
        $kelas_list = getKelas();
        while ($kelas = mysqli_fetch_assoc($kelas_list)) {
            $kelas_id = $kelas['id_kelas'];
            $kelas_name = $kelas['tingkat'] . " " . $kelas['nama_kelas'];

            // Ambil struktur kelas berdasarkan ID kelas
            $struktur_kelas = getStrukturKelas($kelas_id);
        ?>
            <!-- Kelas -->
            <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-4"><?php echo $kelas_name; ?></h3>

                <!-- Struktur Kelas -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    <?php
                    if (mysqli_num_rows($struktur_kelas) > 0) {
                        while ($row = mysqli_fetch_assoc($struktur_kelas)) {
                            echo "<div class='bg-gray-100 p-4 rounded-lg shadow-md flex flex-col items-center'>";
                            echo "<h4 class='text-md font-semibold text-gray-800 mb-2'>{$row['nama_lengkap']}</h4>";
                            echo "<p class='text-sm text-gray-600'>{$row['jabatan']}</p>";
                            echo "</div>";
                        }
                    } else {
                        echo "<div class='bg-gray-100 p-4 rounded-lg shadow-md col-span-3'>";
                        echo "<p class='text-center text-sm text-gray-600'>Belum ada struktur kelas untuk kelas ini.</p>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
        <?php
        }
        ?>

    </div>

    <!-- Footer -->
    <?php require_once '../../layout/footer.php'; ?>

</body>

</html>
