<?php
include "../../koneksi.php";
session_start();

$kelas_id = $_GET['kelas'];
$mata_pelajaran_id = $_GET['mapel'];
$tanggal = $_GET['tanggal'];

// data murit
function getDaftarMurid($kelas_id)
{
  global $conn;
  $kelas_id = mysqli_real_escape_string($conn, $kelas_id);
  $query = "SELECT * FROM siswa WHERE kelas_id = '$kelas_id' ORDER BY nama_lengkap";
  $result = mysqli_query($conn, $query);

  return $result ? $result : handleDatabaseError($conn, $query);
}

// get absensi
function get_absensi($conn, $id_siswa, $kelas_id, $mata_pelajaran_id, $tanggal){
    $query = "SELECT status_absensi FROM absensi WHERE id_siswa = '$id_siswa' AND kelas_id = '$kelas_id' AND id_mata_pelajaran = '$mata_pelajaran_id' AND tanggal = '$tanggal'";
    $result = mysqli_query($conn, $query);
    return $result ? $result : handleDatabaseError($conn, $query);
}

// Function to update attendance
function update_absensi($conn, $kelas_id, $mata_pelajaran_id, $tanggal, $absensi_data)
{
    $success = true;
    foreach ($absensi_data as $id_siswa => $status) {
        $query = "UPDATE absensi 
                  SET status_absensi = '$status'
                  WHERE kelas_id = '$kelas_id'
                  AND id_mata_pelajaran = '$mata_pelajaran_id'
                  AND tanggal = '$tanggal'";

        if (!mysqli_query($conn, $query)) {
            $success = false;
            break;
        }
    }

    return $success;
}

if (isset($_POST["update_absensi"])) {
    $absensi_data = $_POST['absensi'];

    if (update_absensi($conn, $kelas_id, $mata_pelajaran_id, $tanggal, $absensi_data)) {
        echo "<script>alert('Data absensi berhasil diperbarui.');</script>";
        header("Location: input_absen.php");
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
</head>

<body class="bg-gray-100 text-gray-800">
    <!-- Sidebar -->
    <?php include '../../layout/sidebar.php'; ?>

    <!-- Navbar -->
    <header id="header" class="bg-blue-600 text-white py-4 transition-all duration-300">
        <?php include '../../layout/header.php'; ?>
    </header>

    <!-- Main Content -->
    <div id="mainContent" class="container mx-auto mt-8 px-4 transition-all duration-300">
        <h2 class="text-2xl font-bold text-center mb-6">Daftar Murid</h2>

        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-xl font-semibold mb-4">
                Kelas: <?php echo $kelas_id; ?>
            </h3>
            <h3 class="text-xl font-semibold mb-4">
                Mata Pelajaran: <?php echo $mata_pelajaran_id; ?>,
            </h3>
            <h3 class="text-xl font-semibold mb-4">
                Tanggal: <?php echo $tanggal; ?>
            </h3>


            <!-- Tabel Daftar Murid (Right Side) -->
            <div class="w-2/2 bg-white shadow-md rounded-lg p-6">
                <?php if ($kelas_id && $mata_pelajaran_id): ?>
                    <h3 class="text-xl font-semibold mb-4">Daftar Murid</h3>
                    <form action="" method="POST">
                        <input type="hidden" name="kelas" value="<?php echo $kelas_id; ?>">
                        <input type="hidden" name="mata_pelajaran" value="<?php echo $mata_pelajaran_id; ?>">
                        <input type="hidden" name="tanggal" value="<?php echo $tanggal; ?>">
                        <table class="table-auto w-full text-left border-collapse border border-gray-300">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 border border-gray-300 bg-blue-100">NO</th>
                                    <th class="px-4 py-2 border border-gray-300 bg-blue-100">Nama</th>
                                    <th class="px-4 py-2 border border-gray-300 bg-blue-100">NISN</th>
                                    <th class="px-4 py-2 border border-gray-300 bg-blue-100">Mata Pelajaran</th>
                                    <th class="px-4 py-2 border border-gray-300 bg-blue-100">Status Absensi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $daftar_murid = getDaftarMurid($kelas_id);
                                $no = 1;
                                while ($row = mysqli_fetch_assoc($daftar_murid)) {
                                    $absensi_result = get_absensi($conn, $row['nis'], $kelas_id, $mata_pelajaran_id, $tanggal);
                                    $default_status = 'hadir'; // Default status if no record found

                                    if ($absensi_result && mysqli_num_rows($absensi_result) > 0) {
                                        $absensi_row = mysqli_fetch_assoc($absensi_result);
                                        $default_status = $absensi_row['status_absensi'];
                                    }

                                    echo "<tr>";
                                    echo "<td class='px-4 py-2 border border-gray-300'>" . $no++ . "</td>";
                                    echo "<td class='px-4 py-2 border border-gray-300'>" . $row['nama_lengkap'] . "</td>";
                                    echo "<td class='px-4 py-2 border border-gray-300'>" . $row['nis'] . "</td>";
                                    echo "<td class='px-4 py-2 border border-gray-300'>" . $mata_pelajaran_id . "</td>";

                                    echo "<td class='px-4 py-2 border border-gray-300'>";
                                    echo "<select name='absensi[" . $row['nis'] . "]' class='w-full p-1 border border-gray-300 rounded' required>";
                                    $status_options = ['hadir', 'izin', 'sakit', 'alpa'];
                                    foreach ($status_options as $status) {
                                        $selected = ($status == $default_status) ? 'selected' : '';
                                        echo "<option value='$status' $selected>$status</option>";
                                    }
                                    echo "</select>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </form>
                <?php else: ?>
                    <p class="text-center text-gray-500">Pilih kelas dan mata pelajaran untuk menampilkan daftar murid.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="mt-4 flex justify-between">
            <a href="input_absen.php" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 transition">
                Kembali
            </a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition" name="update_absensi">
                Cetak
            </button>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition" name="update_absensi">
                Perbarui Absensi
            </button>
        </div>
        </form>
    </div>
    </div>

    <!-- Footer -->
    <?php
    require_once "../../layout/footer.php"
    ?>
</body>

</html>