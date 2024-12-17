<?php
include "../../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kelas_id = $_POST['kelas'];
    $fasilitas = $_POST['fasilitas'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal_laporan = date('Y-m-d H:i:s');

    $query = "INSERT INTO laporan_kerusakan (kelas_id, fasilitas, deskripsi, tanggal_laporan, status) 
              VALUES ('$kelas_id', '$fasilitas', '$deskripsi', '$tanggal_laporan', 'pending')";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Laporan berhasil dikirim'); window.location.href = 'laporan.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
