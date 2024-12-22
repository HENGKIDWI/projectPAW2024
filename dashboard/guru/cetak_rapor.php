<?php
require_once '../../vendor/autoload.php'; // Path ke autoload Composer
include "../../koneksi.php";
session_start();

use Dompdf\Dompdf;
use Dompdf\Options;

// Cek sesi pengguna
if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

// Ambil ID rapor dari URL
$id_rapor = $_GET['id_rapor'];

// Query data rapor
$query_rapor = "SELECT r.*, s.nama_lengkap, s.nis, k.nama_kelas, k.tingkat 
                FROM rapot AS r
                INNER JOIN siswa AS s ON r.siswa_id = s.id_siswa
                INNER JOIN kelas AS k ON s.kelas_id = k.id_kelas
                WHERE r.id_rapot = $id_rapor";
$result_rapor = mysqli_query($conn, $query_rapor);
$rapor = mysqli_fetch_assoc($result_rapor);

// Query nilai mata pelajaran
$query_nilai = "SELECT n.*, m.nama_pelajaran 
                FROM nilai_rapot AS n
                INNER JOIN mata_pelajaran AS m ON n.mata_pelajaran_id = m.id_mata_pelajaran
                WHERE n.rapot_id = $id_rapor";
$result_nilai = mysqli_query($conn, $query_nilai);

// Query absensi
$query_absensi = "SELECT 
                    SUM(CASE WHEN status_absensi = 'hadir' THEN 1 ELSE 0 END) AS total_hadir,
                    SUM(CASE WHEN status_absensi = 'izin' THEN 1 ELSE 0 END) AS total_izin,
                    SUM(CASE WHEN status_absensi = 'sakit' THEN 1 ELSE 0 END) AS total_sakit,
                    SUM(CASE WHEN status_absensi = 'alpha' THEN 1 ELSE 0 END) AS total_alpha
                  FROM absensi 
                  WHERE id_siswa = {$rapor['siswa_id']}";
$result_absensi = mysqli_query($conn, $query_absensi);
$absensi = mysqli_fetch_assoc($result_absensi);

// Default data absensi jika kosong
$absensi['total_hadir'] = $absensi['total_hadir'] ?? '-';
$absensi['total_izin'] = $absensi['total_izin'] ?? '-';
$absensi['total_sakit'] = $absensi['total_sakit'] ?? '-';
$absensi['total_alpha'] = $absensi['total_alpha'] ?? '-';

// HTML konten
$html = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rapor Siswa - {$rapor['nama_lengkap']}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container .logo img {
            width: 100px;
            height: auto;
            margin-right: 10px;
        }

        .header-title {
            text-align: center;
            margin: 0;
        }

        .header-subtitle {
            text-align: center;
            margin: 0 0 10px;
        }

        .data-siswa {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .data-siswa td {
            padding: 8px;
            text-align: left;
        }

        .section-title {
            margin: 20px 0 10px;
            font-size: 18px;
            font-weight: bold;
        }


        .nilai-table, .absensi-table, .ekskul-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .nilai-table th, .nilai-table td,
        .absensi-table th, .absensi-table td,
        .ekskul-table th, .ekskul-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        .nilai-table th {
            background-color: #eaeaea;
        }

        .ekskul {
            margin: 20px 0 10px;
            font-size: 18px;
            font-weight: bold;
        }

        .ekskul-table th {
            background-color: #eaeaea; 
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            margin-bottom: 40px;
        }

        .footer td.left {
            padding-right: 170px;
            padding-left: 60px;
            vertical-align: top;
        }

        .footer td.right {
            padding-left: 170px;
            padding-right: 60px;
            vertical-align: top;
        }

        .footer-section {
            margin-top: 10px;
        }

        .catatan-wali {
            border: 1px solid #000;
            padding: 10px;
            margin-top: 10px;
            background-color: #f9f9f9;
            font-style: italic;
        }

        .nama {
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class='logo'>
            <img src='https://i.pinimg.com/originals/e2/57/46/e257468b494f341546a8a30c47b023d6.png' alt='Logo Sekolah'>
        </div>
        <h2 class="header-title">Rapor Siswa</h2>
        <h3 class="header-title">SMP Negeri 1 Tambelangan</h3>
        <h4 class="header-subtitle">Tahun Ajaran {$rapor['tahun_ajaran']}</h4>
        <p class="header-subtitle">Jl. Raya Tambelangan - Sampang 69253 Karang Anyar</p>
        <hr>
        <table class="data-siswa">
            <tr>
                <td><strong>Nama Siswa:</strong> {$rapor['nama_lengkap']}</td>
                <td><strong>Kelas:</strong> {$rapor['tingkat']} {$rapor['nama_kelas']}</td>
            </tr>
            <tr>
                <td><strong>NIS:</strong> {$rapor['nis']}</td>
                <td><strong>Semester:</strong> {$rapor['semester']}</td>
            </tr>
        </table>

        <h4 class="section-title">A. Nilai Mata Pelajaran</h4>
        <table class="nilai-table">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Mata Pelajaran</th>
                    <th colspan="2">Pengetahuan</th>
                    <th colspan="2">Keterampilan</th>
                </tr>
                <tr>
                    <th>Nilai</th>
                    <th>Predikat</th>
                    <th>Nilai</th>
                    <th>Predikat</th>
                </tr>
            </thead>
            <tbody>
HTML;

$no = 1;
while ($nilai = mysqli_fetch_assoc($result_nilai)) {
    $html .= <<<HTML
                <tr>
                    <td>{$no}</td>
                    <td>{$nilai['nama_pelajaran']}</td>
                    <td>{$nilai['nilai_pengetahuan']}</td>
                    <td>{$nilai['predikat_pengetahuan']}</td>
                    <td>{$nilai['nilai_keterampilan']}</td>
                    <td>{$nilai['predikat_keterampilan']}</td>
                </tr>
HTML;
    $no++;
}

$html .= <<<HTML
            </tbody>
        </table>

        <h4 class="ekskul">B. Ekstrakurikuler</h4>
        <table class="ekskul-table">
            <tr>
                <th>Kegiatan</th>
                <th>Nilai</th>
            </tr>
            <tr>
                <td class="nama">{$rapor['ekskul']}</td>
                <td class="nilai">{$rapor['nilai_ekskul']}</td>
            </tr>
        </table>

        <h4 class="section-title">C. Data Absensi</h4>
        <table class="absensi-table">
            <tr>
                <th>Hadir</th>
                <th>Izin</th>
                <th>Sakit</th>
                <th>Alpha</th>
            </tr>
            <tr>
                <td>{$absensi['total_hadir']}</td>
                <td>{$absensi['total_izin']}</td>
                <td>{$absensi['total_sakit']}</td>
                <td>{$absensi['total_alpha']}</td>
            </tr>
        </table>

        <h4 class="section-title">D. Catatan Wali Kelas</h4>
        <p class="catatan-wali">{$rapor['catatan_wali']}</p>

        <table class="footer">
            <tr>
                <td class="left">
                    <div class="footer-section">
                        <p>Orang Tua/Wali</p>
                        <p class="footer-signature" style="margin-top: 50px;">________________</p>
                        <p class="nama">Nama Wali</p>
                    </div>
                </td>
                <td class="right">
                    <div class="footer-section">
                        <p>Wali Kelas</p>
                        <p class="footer-signature" style="margin-top: 50px;">________________</p>
                        <p>NIP:</p>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
HTML;

// Dompdf konfigurasi dan output
$options = new Options();
$options->set('isRemoteEnabled', true);

$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A3', 'portrait');
$dompdf->render();
$dompdf->stream("Rapor_Siswa_{$rapor['nama_lengkap']}.pdf", ["Attachment" => false]);
exit;
