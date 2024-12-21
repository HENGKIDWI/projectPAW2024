<?php
include "../../koneksi.php";
session_start();

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

// Memeriksa apakah id_rapor ada di URL
if (isset($_GET['id_rapor'])) {
    $id_rapor = $_GET['id_rapor'];

    // Hapus data rapor dari database
    $delete_query = "DELETE FROM rapot WHERE id_rapot = '$id_rapor'";

    if (mysqli_query($conn, $delete_query)) {
        header("Location: input_rapot.php"); // Redirect setelah berhasil hapus
        exit;
    } else {
        echo "Gagal menghapus data: " . mysqli_error($conn);
    }
}
?>
