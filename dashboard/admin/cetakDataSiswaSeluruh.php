<?php
require '../../vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

include "../../koneksi.php";

// Query untuk mendapatkan seluruh data siswa (tanpa filter kelas)
$query_siswa = "SELECT * FROM siswa";
$result_siswa = mysqli_query($conn, $query_siswa);

// Query untuk mendapatkan data jabatan Kepala Sekolah dan Kesiswaan
$query_jabatan = "SELECT nama_jabatan, nama_personil FROM jabatan WHERE nama_jabatan IN ('Kepala Sekolah', 'Kesiswaan')";
$result_jabatan = mysqli_query($conn, $query_jabatan);

// Variabel untuk menyimpan nama Kepala Sekolah
$nama_kepala_sekolah = '';

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
    <h2>Data Seluruh Siswa</h2>
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


while ($jabatan = mysqli_fetch_assoc($result_jabatan)) {
    if ($jabatan['nama_jabatan'] == 'Kepala Sekolah') {
        $nama_kepala_sekolah = $jabatan['nama_personil'];
    }
}

$html .= "</tbody>
    </table>";

// Variabel untuk menyimpan nama Kesiswaan
$nama_kesiswaan = '';

// Mendapatkan nama Kepala Sekolah dan Kesiswaan
while ($jabatan = mysqli_fetch_assoc($result_jabatan)) {
    if ($jabatan['nama_jabatan'] == 'Kepala Sekolah') {
        $nama_kepala_sekolah = $jabatan['nama_personil'];
    } elseif ($jabatan['nama_jabatan'] == 'Kesiswaan') {
        $nama_kesiswaan = $jabatan['nama_personil'];
    }
}

$html .= "<div class='footer'>
        <div style='float: right; text-align: center;'>
        <p>Tambelangan, " . date('d M Y') . "</p>
        <p>Mengetahui</p>
        <p class='ttd'>Kepala Sekolah</p>
            <p>{$nama_kepala_sekolah}</p>
        </div>
        <div style='clear: both;'></div>
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
$dompdf->stream("Data_Siswa_Seluruh.pdf", ["Attachment" => false]);
exit;
?>
