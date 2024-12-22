<?php
include "../../koneksi.php";
session_start();

// Pastikan ID Kelas ada dan valid
if (isset($_POST['id_kelas']) && !empty($_POST['id_kelas'])) {
    $id_kelas = $_POST['id_kelas'];

    // Query untuk memeriksa apakah ada siswa yang terdaftar di kelas ini
    $check_query = "SELECT COUNT(*) AS count FROM siswa WHERE kelas_id = '$id_kelas'";
    $result = mysqli_query($conn, $check_query);
    $row = mysqli_fetch_assoc($result);

    if ($row['count'] > 0) {
        // Set pesan error di session jika ada siswa di kelas ini
        $_SESSION['message'] = "Gagal menghapus kelas: Ada siswa yang terdaftar di kelas ini.";
        header("Location: kelolaDataSiswa.php"); // Atau halaman yang relevan
        exit;
    } else {
        // Query untuk menghapus kelas berdasarkan ID
        $query = "DELETE FROM kelas WHERE id_kelas = '$id_kelas'";

        if (mysqli_query($conn, $query)) {
            // Set pesan sukses di session
            $_SESSION['message'] = "Data kelas berhasil dihapus!";
            header("Location: kelolaDataSiswa.php"); // Atau halaman yang relevan
            exit;
        } else {
            // Set pesan error di session jika gagal
            $_SESSION['message'] = "Gagal menghapus kelas: " . mysqli_error($conn);
            header("Location: kelolaDataSiswa.php"); // Atau halaman yang relevan
            exit;
        }
    }
} else {
    echo "ID kelas tidak ditemukan.";
}
?>
