<?php
session_start(); // Mulai session
include 'koneksi.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username']; 
    $password = $_POST['password'];

    // Periksa di tabel siswa
    $query = "SELECT 'murid' AS role, nama_lengkap FROM siswa WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        // Jika tidak ditemukan di siswa, periksa di guru
        $query = "SELECT 'guru' AS role, id_guru, nama_lengkap FROM guru WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
    }

    if (!$row) {
        // Jika tidak ditemukan di guru, periksa di admin
        $query = "SELECT 'admin' AS role, nama_lengkap FROM admin WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
    }

    // Jika ditemukan di salah satu tabel
    if ($row) {
        $_SESSION['nama_lengkap'] = $row['nama_lengkap'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['username'] = $username; // Menyimpan username di session
        
        if ($row['role'] == 'guru') {
            $_SESSION['guru_id'] = $row['id_guru']; // Simpan guru_id di session
            header("Location: dashboard/guru/index.php");
        } else if ($row['role'] == 'murid') {
            header("Location: dashboard/siswa/index.php");
        } else if ($row['role'] == 'admin') {
            header("Location: dashboard/admin/index.php");
        }
        exit; // Pastikan menghentikan eksekusi setelah redirect
    } else {
        echo "<script>alert('Login gagal! Username atau password salah.'); window.location.href = 'login.php';</script>";
    }
} else {
    // Jika form belum diisi, arahkan ke login.php
    header("Location: login.php");
    exit;
}
?>
