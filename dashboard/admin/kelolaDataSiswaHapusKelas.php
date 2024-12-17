<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

if (isset($_GET['id_kelas'])) {
    $id_kelas = $_GET['id_kelas'];
    $query = "DELETE FROM kelas WHERE id_kelas = $id_kelas";

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
