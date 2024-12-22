<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id_struktural = $_GET['id'];

    // Query to delete the structure
    $query = "DELETE FROM struktural_kelas WHERE id_struktural = '$id_struktural'";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data struktur kelas berhasil dihapus!');</script>";
        header("Location: struktural_kelas.php");
        exit();
    } else {
        echo "<script>alert('Gagal menghapus data struktur kelas.');;</script>";
        header("Location: struktural_kelas.php");
        exit();
    }
}
?>
