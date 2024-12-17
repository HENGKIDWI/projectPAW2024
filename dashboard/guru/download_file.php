<?php
include "../../koneksi.php";
session_start();

// Check if all required parameters are present
if (!isset($_GET['siswa']) || !isset($_GET['tugas'])) {
    die("Parameter tidak lengkap");
}

$siswa = $conn->real_escape_string($_GET['siswa']);
$tugas = $conn->real_escape_string($_GET['tugas']);

// Retrieve the file from database
$query = "SELECT file_tugas, nama_file FROM pengumpulan_tugas 
          WHERE id_siswa = '$siswa' AND tugas_id = '$tugas'";
$result = $conn->query($query);

if ($result && $row = $result->fetch_assoc()) {
    // Check if file exists
    if (!empty($row['file_tugas'])) {
        // Get the file name or use a default
        $filename = !empty($row['nama_file']) ? $row['nama_file'] : 'tugas_siswa.bin';
        
        // Set headers for file download
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Length: ' . strlen($row['file_tugas']));
        
        // Output the file content
        echo $row['file_tugas'];
        exit;
    } else {
        die("File tidak ditemukan");
    }
} else {
    die("Data tidak ditemukan");
}