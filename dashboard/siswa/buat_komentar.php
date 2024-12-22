<?php
// buat_komentar.php

include '../../koneksi.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $forum_id = $_POST['forum_id'];
    $isi_komentar = $_POST['isi_komentar'];
    $nama_lengkap = $_SESSION['nama_lengkap']; // Dapatkan nama lengkap dari session

    // Ambil id_siswa berdasarkan nama_lengkap
    $query = "SELECT id_siswa FROM siswa WHERE nama_lengkap = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $nama_lengkap);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $siswa = mysqli_fetch_assoc($result);

    if ($siswa) {
        $siswa_id = $siswa['id_siswa'];

        // Simpan komentar ke database
        $query = "INSERT INTO komentar (forum_id, siswa_id, isi_komentar) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "iis", $forum_id, $siswa_id, $isi_komentar);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            // Mengirimkan nama lengkap dan isi komentar kembali dalam response JSON
            echo json_encode(['success' => true, 'nama_lengkap' => $nama_lengkap, 'isi_komentar' => htmlspecialchars($isi_komentar)]);
        } else {
            echo json_encode(['success' => false]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'User not found']);
    }
}

?>
