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
  $forum_id = $_POST['forum_id'];
  $isi_komentar = $_POST['isi_komentar'];
  $dibuat_oleh = $row['id_siswa']; // Ambil ID siswa dari session

  $query = "INSERT INTO komentar (forum_id, isi_komentar, siswa_id) VALUES (?, ?, ?)";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, "ssi", $forum_id, $isi_komentar, $dibuat_oleh);

  if (mysqli_stmt_execute($stmt)) {
    echo "Komentar berhasil ditambahkan.";
  } else {
    echo "Error: " . mysqli_error($conn);
  }

  mysqli_stmt_close($stmt);
}

mysqli_close($conn);
header("Location: komentar.php?id=" . $forum_id);
exit();
