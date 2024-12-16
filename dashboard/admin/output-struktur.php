<?php
include "../../koneksi.php";
session_start();

// Cek sesi login
if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

// Fungsi rekursif untuk menampilkan struktur jabatan
function tampilkanStruktur($conn, $id_atasan = NULL, $level = 0) {
    $query = "SELECT id_jabatan, nama_jabatan, nama_personil FROM jabatan WHERE id_atasan " . 
             ($id_atasan ? "= $id_atasan" : "IS NULL");
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        echo "<ul>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<li>";
            echo "<strong>" . $row['nama_jabatan'] . "</strong> - " . $row['nama_personil'];

            // Panggil fungsi rekursif untuk mencari anak dari jabatan ini
            tampilkanStruktur($conn, $row['id_jabatan'], $level + 1);
            echo "</li>";
        }
        echo "</ul>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struktur Sekolah</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        ul {
            list-style: none;
            margin-left: 20px;
        }
        li {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <h2>Struktur Sekolah</h2>
    <?php
    // Tampilkan struktur dari level tertinggi
    tampilkanStruktur($conn);
    ?>
</body>
</html>
