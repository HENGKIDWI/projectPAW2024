<?php
include '../../koneksi.php';
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = $_POST['post_id'];
    $tags = $_POST['tags']; // Asumsikan tags dipisahkan dengan koma

    // Memisahkan tag dan menyimpannya
    $tagsArray = explode(',', $tags);
    foreach ($tagsArray as $tag) {
        $tag = trim($tag);
        // Cek apakah tag sudah ada
        $queryTag = "SELECT * FROM tag WHERE nama_tag = '$tag'";
        $resultTag = mysqli_query($conn, $queryTag);
        
        if (mysqli_num_rows($resultTag) == 0) {
            // Jika tag belum ada, masukkan ke dalam tabel tag
            $queryInsertTag = "INSERT INTO tag (nama_tag) VALUES ('$tag')";
            mysqli_query($conn, $queryInsertTag);
            $tag_id = mysqli_insert_id($conn);
        } else {
            $rowTag = mysqli_fetch_assoc($resultTag);
            $tag_id = $rowTag['id_tag'];
        }

        // Masukkan ke dalam tabel post_tag
        $queryPostTag = "INSERT INTO post_tag (id_post, id_tag) VALUES ('$post_id', '$tag_id')";
        mysqli_query($conn, $queryPostTag);
    }

    header("Location: post.php?id=$post_id");
    exit;
}