<?php
// Koneksi ke database
include "../../koneksi.php";

// Ambil parameter dari AJAX
$tingkat = isset($_GET['tingkat']) ? mysqli_real_escape_string($conn, $_GET['tingkat']) : '';
$nama_kelas = isset($_GET['nama_kelas']) ? mysqli_real_escape_string($conn, $_GET['nama_kelas']) : '';

// Query data siswa berdasarkan tingkat dan nama_kelas
$query = "SELECT id_siswa, nis, nama_lengkap, alamat, tanggal_lahir, no_telp, jenis_kelamin 
          FROM siswa 
          WHERE tingkat = '$tingkat' AND nama_kelas = '$nama_kelas'";
$result = mysqli_query($conn, $query);

// Cek jika query gagal
if (!$result) {
    echo "<tr><td colspan='7' class='text-center py-4'>Gagal memuat data.</td></tr>";
    exit();
}

// Cek jika data kosong
if (mysqli_num_rows($result) == 0) {
    echo "<tr><td colspan='7' class='text-center py-4'>Tidak ada data siswa di kelas ini.</td></tr>";
    exit();
}

// Tampilkan data siswa
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr class='border-b hover:bg-gray-50'>";
    echo "<td class='py-3 px-4'>" . htmlspecialchars($row['id_siswa']) . "</td>";
    echo "<td class='py-3 px-4'>" . htmlspecialchars($row['nis']) . "</td>";
    echo "<td class='py-3 px-4'>" . htmlspecialchars($row['nama_lengkap']) . "</td>";
    echo "<td class='py-3 px-4'>" . htmlspecialchars($row['alamat']) . "</td>";
    echo "<td class='py-3 px-4'>" . htmlspecialchars($row['tanggal_lahir']) . "</td>";
    echo "<td class='py-3 px-4'>" . htmlspecialchars($row['no_telp']) . "</td>";
    echo "<td class='py-3 px-4'>" . htmlspecialchars($row['jenis_kelamin']) . "</td>";
    echo "</tr>";
}

mysqli_close($conn);
?>
