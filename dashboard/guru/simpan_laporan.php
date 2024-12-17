<?php
include "../../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil nilai dari form
    $fasilitas_id = $_POST['fasilitas_id'];  // Ambil ID fasilitas yang dipilih
    $deskripsi = $_POST['deskripsi'];
    $tanggal_laporan = date('Y-m-d H:i:s');

    // Pastikan fasilitas_id valid (bisa disesuaikan lebih lanjut dengan validasi)
    if (empty($fasilitas_id) || empty($deskripsi)) {
        echo "Fasilitas dan deskripsi tidak boleh kosong.";
        exit;
    }

    // Query untuk menyimpan laporan
    $query = "INSERT INTO laporan_kerusakan (fasilitas_id, deskripsi, tanggal_laporan, status) 
              VALUES ('$fasilitas_id', '$deskripsi', '$tanggal_laporan', 'Belum diperbaiki')";
    
    // Menjalankan query dan mengecek hasil
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Laporan berhasil dikirim'); window.location.href = 'laporan.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
