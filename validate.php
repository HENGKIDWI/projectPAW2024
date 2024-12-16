<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $form = $_POST['form']; // Form login: guru, siswa, atau admin

    // Include koneksi database
    include 'koneksi.php';

    // Tentukan tabel berdasarkan form
    if ($form == 'guru') {
        $table = 'guru';
    } elseif ($form == 'siswa') {
        $table = 'siswa';
    } elseif ($form == 'admin') {
        $table = 'admin';
    } else {
        $error = "Form tidak valid";
        exit();
    }

    // Query ke database
    $query = "SELECT * FROM $table WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    // Check if user exists
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php"); // Redirect ke halaman dashboard
        exit();
    } else {
        $error = "Username atau password salah";
    }

    mysqli_close($conn);
}
?>
