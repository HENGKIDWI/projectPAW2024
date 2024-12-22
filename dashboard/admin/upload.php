<?php
include '../../koneksi.php';
include 'ebook_proses.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $deskripsi = $_POST['deskripsi'];
    $kategori_id = $_POST['kategori_id'];
    
    
    
    // Upload file
    $folder_tujuan = '../../uploads/ebook/assets/books/';
    $target_file = $folder_tujuan . basename($_FILES["file_path"]["name"]);
    if (move_uploaded_file($_FILES["file_path"]["tmp_name"], $target_file)) {
        addEbook($conn, $judul, $penulis, $deskripsi, $target_file, $kategori_id);
        header("Location: ebook.php");
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>