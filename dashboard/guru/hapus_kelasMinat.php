<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

// Pastikan ada ID kelas yang ingin dihapus
if (isset($_GET['id'])) {
    $id_kelas = mysqli_real_escape_string($conn, $_GET['id']);

    // Query untuk menghapus data kelas berdasarkan ID
    $query = "DELETE FROM ekstrakurikuler WHERE id_ekstrakurikuler = '$id_kelas'";

    // Eksekusi query
    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Kelas berhasil dihapus!');
                window.location.href = 'DaftarKelasMinat.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus kelas. Silakan coba lagi.');
                window.location.href = 'DaftarKelasMinat.php';
              </script>";
    }
} else {
    // Jika tidak ada ID, redirect ke halaman utama
    header("Location: DaftarKelasMinat.php");
    exit;
}
?>
