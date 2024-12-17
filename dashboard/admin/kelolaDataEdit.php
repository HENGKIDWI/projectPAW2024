<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_siswa = $_POST['id_siswa'];
    $nis = $_POST['nis'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $kelas_id = $_POST['kelas'];
    $alamat = $_POST['alamat'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $no_telp = $_POST['no_telp'];
    $jenis_kelamin = $_POST['jenis_kelamin'];

    // Update query
    $query = "UPDATE siswa SET 
              nis = '$nis', 
              nama_lengkap = '$nama_lengkap', 
              kelas_id = '$kelas_id', 
              alamat = '$alamat', 
              tanggal_lahir = '$tanggal_lahir', 
              no_telp = '$no_telp', 
              jenis_kelamin = '$jenis_kelamin' 
              WHERE id_siswa = '$id_siswa'";

    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = "Data siswa berhasil diupdate!";
    } else {
        $_SESSION['message'] = "Gagal mengupdate data siswa: " . mysqli_error($conn);
    }

    header("Location: kelolaDataSiswa.php");
    exit;
} else {
    header("Location: kelolaDataSiswa.php");
    exit;
}
?>