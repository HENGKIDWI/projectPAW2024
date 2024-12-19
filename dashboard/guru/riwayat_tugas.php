<?php
include "../../koneksi.php";
session_start();

// Function to fetch task list with improved error handling and query
function getRiwayatTugas()
{
    global $conn;

    // Improved query to join with kelas table if needed
    $query = "SELECT t.*, k.nama_kelas, k.tingkat 
              FROM tugas t
              LEFT JOIN kelas k ON t.kelas_id = k.id_kelas
              ORDER BY t.deadline DESC";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        // Log error or handle query failure
        error_log("Query failed: " . mysqli_error($conn));
        return false;
    }

    return $result;
}

// Function to safely display file link or name
function displayFileTugas($filePath)
{
    if (empty($filePath)) {
        return "Tidak ada file";
    }

    // Check file extension and provide appropriate display/download link
    $fileExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
    $allowedExtensions = ['pdf', 'docx', 'txt', 'xlsx'];

    if (in_array($fileExtension, $allowedExtensions)) {
        return "<a href='./uploads/tugas/" . htmlspecialchars($filePath) . "' 
                   class='text-blue-600 hover:underline' 
                   target='_blank' 
                   >
                   " . htmlspecialchars($filePath) . "
                </a>";
    }

    return htmlspecialchars($filePath);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tugas Guru</title>
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
    <div class="container mx-auto mt-8 px-4">
        <h2 class="text-2xl font-bold text-center mb-6">Halaman Tugas</h2>

        <div class="bg-white shadow-md rounded-lg p-6 mt-8">
            <div class="flex justify-between items-center mb-4">
                <div class="text-xl font-semibold text-blue-600">Riwayat Tugas</div>
                <a href="input_tugas.php" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-green-600 transition duration-300 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Tambah Tugas Baru
                </a>
            </div>

            <table class="w-full table-auto border-collapse">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="py-2 px-4 border">No</th>
                        <th class="py-2 px-4 border">Judul Tugas</th>
                        <th class="py-2 px-4 border">File Tugas</th>
                        <th class="py-2 px-4 border">URL Tugas</th>
                        <th class="py-2 px-4 border">Poin</th>
                        <th class="py-2 px-4 border">Kelas</th>
                        <th class="py-2 px-4 border">Deadline</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $riwayat_tugas = getRiwayatTugas();

                    if ($riwayat_tugas && mysqli_num_rows($riwayat_tugas) > 0) {
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($riwayat_tugas)) {
                            $kelas_info = !empty($row['tingkat']) && !empty($row['nama_kelas'])
                                ? $row['tingkat'] . " - " . $row['nama_kelas']
                                : "Tidak ditentukan";

                            echo "<tr>";
                            echo "<td class='py-2 px-4 border text-center'>" . $no++ . "</td>";
                            echo "<td class='py-2 px-4 border'>" . htmlspecialchars($row['judul']) . "</td>";
                            echo "<td class='py-2 px-4 border'>" . displayFileTugas($row['file_tugas']) . "</td>";
                            echo "<td class='py-2 px-4 border'>" .
                                (!empty($row['url_tugas'])
                                    ? "<a href='" . htmlspecialchars($row['url_tugas']) . "' 
                                        target='_blank' 
                                        class='text-blue-600 hover:underline'>
                                        Lihat URL
                                    </a>"
                                    : "Tidak ada URL") .
                                "</td>";

                            echo "<td class='py-2 px-4 border text-center'>" . htmlspecialchars($row['poin']) . "</td>";
                            echo "<td class='py-2 px-4 border text-center'>" . htmlspecialchars($kelas_info) . "</td>";
                            echo "<td class='py-2 px-4 border'>" . htmlspecialchars($row['deadline']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' class='text-center py-4 text-gray-500'>Belum ada tugas yang dibuat.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php
    require_once "../../layout/footer.php"
    ?>
</body>

</html>