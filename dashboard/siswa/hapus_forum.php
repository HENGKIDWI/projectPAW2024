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
    $siswa_id = $row['id_siswa']; // Ambil ID siswa dari session

    // Cek apakah siswa yang sedang login adalah pembuat forum
    $query = "SELECT dibuat_oleh FROM forum WHERE id_forum = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $forum_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $forum = mysqli_fetch_assoc($result);

    if ($forum) {
        if ($forum['dibuat_oleh'] != $siswa_id) {
            // Jika siswa bukan pembuat forum, tampilkan pesan error
            echo "<script>alert('Anda tidak memiliki izin untuk menghapus forum ini.')</script>";
            header("refresh:0;url=forum.php");
            exit;
        }

        // Hapus komentar yang terkait dengan forum
        $query = "DELETE FROM komentar WHERE forum_id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $forum_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // Hapus forum
        $query = "DELETE FROM forum WHERE id_forum = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $forum_id);
        
        if (mysqli_stmt_execute($stmt)) {
            echo "Forum berhasil dihapus.";
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Forum tidak ditemukan.";
    }
}

mysqli_close($conn);
header("Location: forum.php");
exit();
?>
