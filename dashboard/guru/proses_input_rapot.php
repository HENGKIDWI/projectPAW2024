<?php
include "../../koneksi.php";
session_start();

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

// Memeriksa apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $id_siswa = $_POST['id_siswa'];
    $semester = $_POST['semester'];
    $tahun_ajaran = $_POST['tahun_ajaran'];
    $nilai_rata_rata = $_POST['nilai_rata_rata'];
    $ekskul = $_POST['ekskul'];
    $nilai_ekskul = $_POST['nilai_ekskul'];
    $catatan_wali_kelas = $_POST['catatan_wali_kelas'];

    // Query untuk menyimpan data rapor
    $query_rapor = "INSERT INTO rapot (siswa_id, semester, tahun_ajaran, nilai_rata, ekskul, nilai_ekskul, catatan_wali)
                    VALUES ('$id_siswa', '$semester', '$tahun_ajaran', '$nilai_rata_rata', '$ekskul', '$nilai_ekskul', '$catatan_wali_kelas')";

    if (mysqli_query($conn, $query_rapor)) {
        // Ambil id rapor yang baru saja disimpan
        $id_rapor = mysqli_insert_id($conn);

        // Proses menyimpan nilai mata pelajaran
        if (!empty($_POST['id_mapel']) && !empty($_POST['nilai_pengetahuan']) && !empty($_POST['predikat_pengetahuan']) && !empty($_POST['nilai_keterampilan']) && !empty($_POST['predikat_keterampilan'])) {
            $id_mapel = $_POST['id_mapel'];
            $nilai_pengetahuan = $_POST['nilai_pengetahuan'];
            $predikat_pengetahuan = $_POST['predikat_pengetahuan'];
            $nilai_keterampilan = $_POST['nilai_keterampilan'];
            $predikat_keterampilan = $_POST['predikat_keterampilan'];

            // Menyimpan nilai mata pelajaran
            foreach ($id_mapel as $index => $mapel_id) {
                $nilai_p = $nilai_pengetahuan[$index];
                $predikat_p = $predikat_pengetahuan[$index];
                $nilai_k = $nilai_keterampilan[$index];
                $predikat_k = $predikat_keterampilan[$index];

                $query_nilai = "INSERT INTO nilai_rapot (rapot_id, mata_pelajaran_id, nilai_pengetahuan, predikat_pengetahuan, nilai_keterampilan, predikat_keterampilan)
                                VALUES ('$id_rapor', '$mapel_id', '$nilai_p', '$predikat_p', '$nilai_k', '$predikat_k')";

                mysqli_query($conn, $query_nilai);
            }
        }

        // Redirect setelah data disimpan
        header("Location: input_rapot.php?status=sukses");
    } else {
        // Jika gagal menyimpan data
        echo "Error: " . $query_rapor . "<br>" . mysqli_error($conn);
    }
} else {
    // Jika tidak menggunakan metode POST
    echo "Akses tidak sah!";
}
?>
