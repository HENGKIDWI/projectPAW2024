<?php
include "../../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_kelas = $_POST['id_kelas'];
    $nama_kelas = $_POST['nama_kelas'];
    $tingkat = $_POST['tingkat'];

    // Validasi input
    if (!empty($id_kelas) && !empty($nama_kelas) && !empty($tingkat)) {
        // Query update kelas
        $query = "UPDATE kelas SET nama_kelas = ?, tingkat = ? WHERE id_kelas = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'ssi', $nama_kelas, $tingkat, $id_kelas);

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['message'] = "Kelas berhasil diperbarui!";
        } else {
            $_SESSION['message'] = "Terjadi kesalahan saat memperbarui kelas.";
        }
        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['message'] = "Semua field harus diisi!";
    }

    header("Location: kelolaDataSiswa.php");
    exit;
}
?>
