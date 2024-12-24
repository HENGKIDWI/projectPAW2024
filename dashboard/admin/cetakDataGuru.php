<?php
require '../../vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

include "../../koneksi.php";

// Ambil data guru
$query = "SELECT g.nip, g.nama_lengkap, mp.nama_pelajaran
          FROM guru g
          LEFT JOIN mata_pelajaran mp ON g.mata_pelajaran_id = mp.id_mata_pelajaran";
$result = mysqli_query($conn, $query);

// Query untuk mendapatkan data jabatan Kepala Sekolah dan Kesiswaan
$query_jabatan = "SELECT nama_jabatan, nama_personil FROM jabatan WHERE nama_jabatan IN ('Kepala Sekolah', 'Kesiswaan')";
$result_jabatan = mysqli_query($conn, $query_jabatan);

// Membuat konten HTML untuk PDF
$html = "<html>
<head>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            line-height: 1.5;
            font-size: 12px;
        }
        .kop-surat {
            text-align: center;
            margin-bottom: 20px;
        }
        .kop-surat img {
            width: 80px;
            height: auto;
            position: absolute;
            top: 0;
            left: 50px;
        }
        .kop-surat h1 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
        }
        .kop-surat h2 {
            margin: 0;
            font-size: 16px;
        }
        .kop-surat p {
            margin: 5px 0;
            font-size: 12px;
        }
        hr {
            border: 1px solid black;
            margin-top: 5px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f0f0f0;
        }
        .tanda-tangan {
            margin-top: 50px;
            text-align: center;
            width: 50%;
            float: right;
        }
        .tanda-tangan p {
            margin: 5px;
        }
        .tanda-tangan span {
            display: block;
            margin-top: 70px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class='kop-surat'>
        <img src='https://i.pinimg.com/originals/e2/57/46/e257468b494f341546a8a30c47b023d6.png' alt='Logo Sekolah'>
        <h1>Pemerintah Kabupaten Sampang</h1>
        <h2>SMP Negeri 1 Tambelangan</h2>
        <p>Jl. Raya Tambelangan, Sampang 69253</p>
        <p>Email: info@smpn1tambelangan.sch.id | Telp: (0324) 123456</p>
        <hr>
    </div>
    <h2>Data Guru</h2>
    <table class='table'>
        <thead>
            <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama Lengkap</th>
                <th>Mata Pelajaran</th>
            </tr>
        </thead>
        <tbody>";

$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $html .= "<tr>
                <td>{$no}</td>
                <td>{$row['nip']}</td>
                <td>{$row['nama_lengkap']}</td>
                <td>{$row['nama_pelajaran']}</td>
              </tr>";
    $no++;
}
while ($jabatan = mysqli_fetch_assoc($result_jabatan)) {
  if ($jabatan['nama_jabatan'] == 'Kepala Sekolah') {
      $nama_kepala_sekolah = $jabatan['nama_personil'];
  }
}
$html .= "</tbody>
    </table>
    <div class='tanda-tangan'>
        <p>Sampang, " . date('d-m-Y') . "</p>
        <p>Mengetahui,</p>
        <p>Kepala Sekolah</p>
        <span>{$nama_kepala_sekolah}</span>
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
$dompdf->stream("Data_Guru.pdf", ["Attachment" => false]);
exit;
?>