<?php
// ebook.php
include '../../koneksi.php';



function getEbooks($conn) {
    $sql = "SELECT ebooks.*, kategori.nama_kategori FROM ebooks JOIN kategori ON ebooks.kategori_id = kategori.id";
    $result = $conn->query($sql);
    $ebooks = [];
    while ($row = $result->fetch_assoc()) {
        $ebooks[] = $row;
    }
    return $ebooks;
}

function addEbook($conn, $judul, $penulis, $deskripsi, $file_path, $kategori_id) {
    $stmt = $conn->prepare("INSERT INTO ebooks (judul, penulis, deskripsi, file_path, kategori_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $judul, $penulis, $deskripsi, $file_path, $kategori_id);
    $stmt->execute();
    $stmt->close();
}

function editEbook($conn, $id, $judul, $penulis, $deskripsi, $file_path, $kategori_id) {
    $stmt = $conn->prepare("UPDATE ebooks SET judul=?, penulis=?, deskripsi=?, file_path=?, kategori_id=? WHERE id=?");
    $stmt->bind_param("ssssii", $judul, $penulis, $deskripsi, $file_path, $kategori_id, $id);
    $stmt->execute();
    $stmt->close();
}

function deleteEbook($conn, $id) {
    // Ambil file_path dari database
    $sql = "SELECT file_path FROM ebooks WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $ebook = $result->fetch_assoc();

    // Hapus file dari server
    if ($ebook) {
        $file_path = $ebook['file_path'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }

    // Hapus entri dari database
    $stmt = $conn->prepare("DELETE FROM ebooks WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
?>