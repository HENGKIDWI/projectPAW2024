<?php
include "../../koneksi.php";

if (isset($_POST['tingkat'])) {
    $tingkat = mysqli_real_escape_string($conn, $_POST['tingkat']);
    $query = "SELECT id_kelas, nama_kelas FROM kelas WHERE tingkat = '$tingkat' ORDER BY nama_kelas ASC";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo '<option value="">-- Pilih Kelas --</option>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row['id_kelas'] . "'>" . $row['nama_kelas'] . "</option>";
        }
    } else {
        echo '<option value="">Tidak ada kelas tersedia</option>';
    }
}
?>
