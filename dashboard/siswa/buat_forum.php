<?php
session_start();
include '../../koneksi.php';

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

  $nama = $_SESSION['nama_lengkap'];

  $query = "SELECT * FROM siswa WHERE nama_lengkap = '$nama'";
  $result = mysqli_query($conn, $query);

  $row = mysqli_fetch_assoc($result);
  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mata_pelajaran_id = $_POST['mata_pelajaran_id'];
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $dibuat_oleh = $row['id_siswa']; 

    $query = "INSERT INTO forum (mata_pelajaran_id, judul, deskripsi, dibuat_oleh) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "issi", $mata_pelajaran_id, $judul, $deskripsi, $dibuat_oleh);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "Forum berhasil dibuat.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
header("Location: forum.php");
exit();
?>