<?php
include '../../koneksi.php';

function getKategoris($conn) {
    $sql = "SELECT * FROM kategori";
    $result = $conn->query($sql);
    $kategoris = [];
    while ($row = $result->fetch_assoc()) {
        $kategoris[] = $row;
    }
    return $kategoris;
}
?>