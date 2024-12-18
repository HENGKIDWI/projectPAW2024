<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

if (isset($_GET['id_siswa'])) {
    $id_siswa = $_GET['id_siswa'];
    $query = "DELETE FROM siswa WHERE id_siswa = $id_siswa";

    if (mysqli_query($conn, $query)) {
        header("Location: kelolaDataSiswa.php");
        exit;
    } else {
        echo "Gagal menghapus kelas.";
    }
} else {
    header("Location: kelolaDataSiswa.php");
    exit;
}
?>
