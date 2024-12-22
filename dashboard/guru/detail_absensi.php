<?php
include "../../koneksi.php";
session_start();

// Ambil parameter query dengan sanitasi
$kelas_id = isset($_GET['kelas']) ? mysqli_real_escape_string($conn, $_GET['kelas']) : null;
$mata_pelajaran_id = isset($_GET['mapel']) ? mysqli_real_escape_string($conn, $_GET['mapel']) : null;
$tanggal = isset($_GET['tanggal']) ? mysqli_real_escape_string($conn, $_GET['tanggal']) : null;

// to int
function toInt($mapel)
{
    global $conn;
    $query = "SELECT id_mata_pelajaran FROM mata_pelajaran WHERE nama_pelajaran = '$mapel'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['id_mata_pelajaran'];
}

// Fungsi untuk mengambil daftar murid berdasarkan kelas
function getDaftarMurid($kelas_id)
{
    global $conn;
    $query = "SELECT * FROM siswa WHERE kelas_id = '$kelas_id' ORDER BY nama_lengkap";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Error: " . mysqli_error($conn));
    }
    return $result;
}

// Fungsi untuk mengambil data absensi
function get_absensi($conn, $id_siswa, $tanggal)
{
    $query = "SELECT * FROM absensi 
              WHERE id_siswa = '$id_siswa' 
              AND tanggal = '$tanggal'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Error: " . mysqli_error($conn));
    }
    return $result;
}

// Fungsi untuk memperbarui data absensi
function update_absensi($conn, $kelas_id, $mata_pelajaran_id, $tanggal, $absensi_data)
{
    foreach ($absensi_data as $id_siswa => $status) {
        // Query untuk update data absensi
        $query = "UPDATE absensi 
                  SET status_absensi = '$status'
                  WHERE id_siswa = '$id_siswa' 
                    AND kelas_id = '$kelas_id' 
                    AND id_mata_pelajaran = '$mata_pelajaran_id' 
                    AND tanggal = '$tanggal'";

        if (!mysqli_query($conn, $query)) {
            return false; // Kembalikan false jika ada error
        }
    }
    return true; // Kembalikan true jika semua update berhasil
}

// Proses form update absensi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["update_absensi"])) {
    $absensi_data = $_POST['absensi']; // Data absensi dari form
    $kelas_id = isset($_GET['kelas']) ? mysqli_real_escape_string($conn, $_GET['kelas']) : null;
    $mapel = isset($_GET['mapel']) ? mysqli_real_escape_string($conn, $_GET['mapel']) : null;
    $mata_pelajaran_id = toInt($mapel);
    $tanggal = isset($_GET['tanggal']) ? mysqli_real_escape_string($conn, $_GET['tanggal']) : null;

    if (update_absensi($conn, $kelas_id, $mata_pelajaran_id, $tanggal, $absensi_data)) {
        echo "<script>alert('Data absensi berhasil diperbarui.');</script>";
        echo "<script>window.location.href = 'input_absen.php';</script>";
        exit();
    } else {
        echo "<script>alert('Terjadi kesalahan saat memperbarui absensi.');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Murid</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Tambahkan style cetak */
        @media print {

            body * {
                visibility: hidden;
                /* Sembunyikan semua elemen */
            }

            .printable-area,
            #printable-area * {
                visibility: visible;
                /* Tampilkan elemen tertentu */
                background-image: none !important;
                margin-top: 0%;
            }

            #cetak,
            #kembali,
            #perbarui {
                display: none ;
            }

            .printable-area {
                position: absolute;
                top: 1;
                left: 0;
            }
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800">
    <?php include '../../layout/sidebar.php'; ?>
    <header class="bg-blue-600 text-white py-4">
        <?php include '../../layout/header.php'; ?>
    </header>

    <div class="container mx-auto mt-8 px-4">
        <h2 class="text-2xl font-bold text-center mb-6">Daftar Murid</h2>

        <div class="bg-white shadow-md rounded-lg p-6" id="printable-area">
            <?php if ($kelas_id && $mata_pelajaran_id): ?>
                <h3 class="text-xl font-semibold mb-4">Kelas = <?= $kelas_id ?></h3>
                <h3 class="text-xl font-semibold mb-4">Mata pelajaran = <?= $mata_pelajaran_id ?></h3>
                <h3 class="text-xl font-semibold mb-4">tanggal = <?= $tanggal ?></h3>
                <form action="" method="POST">
                    <input type="hidden" name="kelas" value="<?php echo htmlspecialchars($kelas_id); ?>">
                    <input type="hidden" name="mata_pelajaran" value="<?php echo htmlspecialchars($mata_pelajaran_id); ?>">
                    <input type="hidden" name="tanggal" value="<?php echo htmlspecialchars($tanggal); ?>">

                    <table class="table-auto w-full border-collapse border border-gray-300">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border bg-blue-100">NO</th>
                                <th class="px-4 py-2 border bg-blue-100">Nama</th>
                                <th class="px-4 py-2 border bg-blue-100">NISN</th>
                                <th class="px-4 py-2 border bg-blue-100">Status Absensi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $daftar_murid = getDaftarMurid($kelas_id);
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($daftar_murid)) {
                                $default_status = 'izin'; // Nilai default jika tidak ada data absensi

                                // Periksa data absensi
                                $absensi_result = get_absensi($conn, $row['id_siswa'],  $tanggal);
                                $absensi_row = mysqli_num_rows($absensi_result);
                                $absensi_row = mysqli_fetch_assoc($absensi_result);
                                $default_status = $absensi_row['status_absensi'];
                                // Set default dari data absensi


                                echo "<tr>";
                                echo "<td class='px-4 py-2 border'>" . $no++ . "</td>";
                                echo "<td class='px-4 py-2 border'>" . htmlspecialchars($row['nama_lengkap']) . "</td>";
                                echo "<td class='px-4 py-2 border'>" . htmlspecialchars($row['nis']) . "</td>";
                                echo "<td class='px-4 py-2 border'>";

                                // Dropdown absensi
                                echo "<select name='absensi[" . htmlspecialchars($row['id_siswa']) . "]' class='w-full p-1 border rounded'>";
                                foreach (['hadir', 'izin', 'sakit', 'alpa'] as $status) {
                                    $selected = ($status === $default_status) ? 'selected' : ''; // Pilih status default
                                    echo "<option value='$status' $selected>" . ucfirst($status) . "</option>";
                                }
                                echo "</select>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>

                        </tbody>
                    </table>

                    <div class="mt-4 flex justify-end gap-4">
                        <a href="input_absen.php" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500" id="kembali">Kembali</a>
                        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" id="cetak" onclick="window.print()">Cetak</button>                        <button type="submit" name="update_absensi" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" id="perbarui">Perbarui Absensi</button>
                    </div>
                </form>
            <?php else: ?>
                <p class="text-center text-gray-500">Pilih kelas dan mata pelajaran untuk menampilkan daftar murid.</p>
            <?php endif; ?>
        </div>
    </div>

    <?php include '../../layout/footer.php'; ?>
</body>

</html>