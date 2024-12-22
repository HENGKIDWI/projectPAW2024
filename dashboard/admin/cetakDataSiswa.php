<?php
require '../../vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

include "../../koneksi.php";

// Filter berdasarkan GET parameter
$filter_kelas = isset($_GET['id_kelas']) ? $_GET['id_kelas'] : '';

if (empty($filter_kelas)) {
    die("Kelas tidak ditemukan.");
}

// Query untuk mendapatkan informasi kelas
$query_kelas = "SELECT kelas.nama_kelas, kelas.tingkat, guru.nama_lengkap AS wali_kelas 
                FROM kelas 
                LEFT JOIN guru ON kelas.wali_kelas_id = guru.id_guru 
                WHERE kelas.id_kelas = '$filter_kelas' LIMIT 1";
$result_kelas = mysqli_query($conn, $query_kelas);
$kelas_data = mysqli_fetch_assoc($result_kelas);

if (!$kelas_data) {
    die("Data kelas tidak ditemukan.");
}

$nama_kelas = $kelas_data['nama_kelas'];
$tingkat = $kelas_data['tingkat'];
$wali_kelas = $kelas_data['wali_kelas'];

// Query untuk mendapatkan data siswa
$query_siswa = "SELECT * FROM siswa WHERE kelas_id = '$filter_kelas'";
$result_siswa = mysqli_query($conn, $query_siswa);

// Query untuk mendapatkan data jabatan Kepala Sekolah dan Kesiswaan
$query_jabatan = "SELECT nama_jabatan, nama_personil FROM jabatan WHERE nama_jabatan IN ('Kepala Sekolah', 'Kesiswaan')";
$result_jabatan = mysqli_query($conn, $query_jabatan);

// Membuat konten HTML untuk PDF
$html = "<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.4;
            font-size: 10px;
        }
        .kop-surat {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
        }
        .kop-surat .logo img {
            width: 70px;
            height: auto;
            margin-right: 10px;
        }
        .kop-surat .info h1 {
            font-size: 16px;
            margin: 0;
            text-align: center;
        }
        .kop-surat .info p {
            margin: 3px 0;
            font-size: 10px;
            text-align: center;
        }
        .garis {
            border-bottom: 2px solid black;
            margin: 10px 0 15px 0;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            font-size: 9px;
        }
        .table th, .table td {
            border: 1px solid black;
            padding: 6px;
            text-align: left;
        }
        .table th {
            background-color: #f0f0f0;
        }
        .footer {
            text-align: right;
            margin-top: 30px;
        }
        .footer .ttd {
            margin-top: 50px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class='kop-surat'>
        <div class='logo'>
            <img src='https://i.pinimg.com/originals/e2/57/46/e257468b494f341546a8a30c47b023d6.png' alt='Logo Sekolah'>
        </div>
        <div class='info'>
          <h1>SMP NEGERI 1 TAMBELANGAN</h1>
          <p>Jl. Raya Tambelangan - Sampang 69253 Karang Anyar</p>
        </div>
    </div>
    <div class='garis'></div>
    <h2>Data Siswa</h2>
    <p><strong>Kelas:</strong> {$tingkat} {$nama_kelas}</p>
    <p><strong>Wali Kelas:</strong> {$wali_kelas}</p>
    <table class='table'>
        <thead>
            <tr>
                <th>No</th>
                <th>NISN</th>
                <th>Nama Lengkap</th>
                <th>Alamat</th>
                <th>Tanggal Lahir</th>
                <th>No. Telepon</th>
                <th>Jenis Kelamin</th>
            </tr>
        </thead>
        <tbody>";

$no = 1;
while ($row = mysqli_fetch_assoc($result_siswa)) {
    $html .= "<tr>
                <td>{$no}</td>
                <td>{$row['nis']}</td>
                <td>{$row['nama_lengkap']}</td>
                <td>{$row['alamat']}</td>
                <td>{$row['tanggal_lahir']}</td>
                <td>{$row['no_telp']}</td>
                <td>{$row['jenis_kelamin']}</td>
              </tr>";
    $no++;
}

$html .= "</tbody>
    </table>";

// Add Jabatan Data
$html .= "<h3>Jabatan</h3>
    <table class='table'>
        <thead>
            <tr>
                <th>Nama Jabatan</th>
                <th>Nama Personil</th>
            </tr>
        </thead>
        <tbody>";

while ($jabatan = mysqli_fetch_assoc($result_jabatan)) {
    $html .= "<tr>
                <td>{$jabatan['nama_jabatan']}</td>
                <td>{$jabatan['nama_personil']}</td>
              </tr>";
}

$html .= "</tbody>
    </table>
    <div class='footer'>
        <p>Tambelangan, " . date('d M Y') . "</p>
        <p>Mengetahui,</p>
        <p class='ttd'>{$wali_kelas}</p>
    </div>
</body>
</html>";

// Konfigurasi Dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Output file PDF
$dompdf->stream("Data_Siswa_Kelas_{$tingkat}_{$nama_kelas}.pdf", ["Attachment" => false]);
exit;
?>
