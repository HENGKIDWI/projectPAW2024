<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../../login.php");
    exit;
}

$id = $_GET['id'];
$query = "DELETE FROM guru WHERE id_guru = $id";
mysqli_query($conn, $query);

header("Location: index.php");
exit;
?>
