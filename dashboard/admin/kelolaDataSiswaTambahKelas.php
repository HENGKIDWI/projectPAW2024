<?php
// INI CUMA PROSES NYA SAJA
include "../../koneksi.php";
session_start();

// Pastikan user sudah login
if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

// Pastikan form dikirim menggunakan POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama_kelas = $_POST['nama_kelas'];
    $tingkat = $_POST['tingkat'];

    // Validasi input
    if (empty($nama_kelas) || empty($tingkat)) {
        echo "<script>alert('Nama kelas dan tingkat tidak boleh kosong!'); window.location.href = 'kelolaDataSiswa.php';</script>";
        exit;
    }

    // Validasi nama_kelas hanya menerima abjad dan panjang minimal 1 karakter
    if (!preg_match("/^[a-zA-Z]+$/", $nama_kelas)) {
        echo "<script>alert('Nama kelas hanya boleh mengandung abjad (huruf) saja!'); window.location.href = 'kelolaDataSiswa.php';</script>";
        exit;
    }

    // Query untuk memasukkan data ke dalam tabel kelas
    $query = "INSERT INTO kelas (nama_kelas, tingkat) VALUES ('$nama_kelas', '$tingkat')";

    // Jalankan query
    if (mysqli_query($conn, $query)) {
        // Jika sukses, redirect ke halaman kelas atau halaman sebelumnya
        header("Location: kelolaDataKelas.php?success=1");
    } else {
        // Jika gagal, tampilkan error
        echo "Error: " . mysqli_error($conn);
    }

    // Tutup koneksi database
    mysqli_close($conn);
}
?>
