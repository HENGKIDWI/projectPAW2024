<?php
include "../../koneksi.php";
session_start();

// Function to fetch task list with improved error handling and query
function getRiwayatTugas()
{
    global $conn;
    $query = "SELECT t.*, k.nama_kelas, k.tingkat 
              FROM tugas t
              LEFT JOIN kelas k ON t.kelas_id = k.id_kelas
              ORDER BY t.deadline DESC";
    $result = mysqli_query($conn, $query);
    return $result;
}

// Function to safely display file link or name
function displayFileTugas($filePath)
{
    if (empty($filePath)) {
        return "Tidak ada file";
    }
    $fileExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
    $allowedExtensions = ['pdf', 'docx', 'txt', 'xlsx'];
    
    if (in_array($fileExtension, $allowedExtensions)) {
        return "<a href='./uploads/tugas/" . htmlspecialchars($filePath) . "' 
                   class='text-blue-600 hover:underline' 
                   target='_blank'>
                   " . htmlspecialchars($filePath) . "
                </a>";
    }
    return htmlspecialchars($filePath);
}

// Handle delete action
if (isset($_POST['delete_id'])) {
    $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);
    
    // Get file information before deleting
    $file_query = "SELECT file_tugas FROM tugas WHERE id_tugas = '$delete_id'";
    $file_result = mysqli_query($conn, $file_query);
    $file_data = mysqli_fetch_assoc($file_result);
    
    // Delete the file if it exists
    if ($file_data && !empty($file_data['file_tugas'])) {
        $file_path = "./uploads/tugas/" . $file_data['file_tugas'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }
    
    // Delete the record from database
    $delete_query = "DELETE FROM tugas WHERE id_tugas = '$delete_id'";
    if (mysqli_query($conn, $delete_query)) {
        // Redirect to refresh the page
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tugas Guru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus tugas ini?')) {
                document.getElementById('delete_form_' + id).submit();
            }
        }
    </script>
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
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Aksi</th>
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
                            echo "<td class='py-2 px-4 border text-center'>" . htmlspecialchars($row['poin'] ?? '-') . "</td>";                            echo "<td class='py-2 px-4 border text-center'>" . htmlspecialchars($kelas_info) . "</td>";
                            echo "<td class='py-2 px-4 border'>" . htmlspecialchars($row['deadline']) . "</td>";
                            echo "<td class='px-6 py-4'>";
                            echo "<div class='flex space-x-2'>";
                            // Corrected edit link
                            echo "<a href='edit_tugas.php?id={$row['id_tugas']}' class='text-blue-600 hover:text-blue-800'>Edit</a>";
                            // Delete form with confirmation
                            echo "<form id='delete_form_{$row['id_tugas']}' method='POST' class='inline'>";
                            echo "<input type='hidden' name='delete_id' value='{$row['id_tugas']}'>";
                            echo "<button type='button' onclick='confirmDelete({$row['id_tugas']})' class='text-red-600 hover:text-red-800'>Hapus</button>";
                            echo "</form>";
                            echo "</div>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8' class='text-center py-4 text-gray-500'>Belum ada tugas yang dibuat.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include '../../layout/footer.php'; ?>
</body>
</html>