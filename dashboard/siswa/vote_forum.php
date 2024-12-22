<?php
include '../../koneksi.php';
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $forum_id = $_POST['forum_id'];
    $query = "UPDATE forum SET votes = votes + 1 WHERE id_forum = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $forum_id);
    $stmt->execute();
    header("Location: forum.php");
    exit;
}