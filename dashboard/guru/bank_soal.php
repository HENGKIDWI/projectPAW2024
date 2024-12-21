<?php
include "../../koneksi.php";
session_start();

// Function to get filtered bank soal data
function getBankSoal($search = '', $mataPelajaran = '', $kelas = '') {
    global $conn;
    $query = "SELECT * FROM bank_soal WHERE 1=1";
    
    if (!empty($search)) {
        $search = mysqli_real_escape_string($conn, $search);
        $query .= " AND (judul_bank_soal LIKE '%$search%' OR detail_bank_soal LIKE '%$search%')";
    }
    
    if (!empty($mataPelajaran)) {
        $mataPelajaran = mysqli_real_escape_string($conn, $mataPelajaran);
        $query .= " AND mata_pelajaran = '$mataPelajaran'";
    }
    
    if (!empty($kelas)) {
        $kelas = mysqli_real_escape_string($conn, $kelas);
        $query .= " AND kelas = '$kelas'";
    }
    
    $query .= " ORDER BY id ASC";
    $result = mysqli_query($conn, $query);
    return $result;
}

// Handle delete action
if (isset($_POST['delete_id'])) {
    $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);
    $delete_query = "DELETE FROM bank_soal WHERE id = '$delete_id'";
    mysqli_query($conn, $delete_query);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Get filter values
$search = isset($_GET['search']) ? $_GET['search'] : '';
$selectedMataPelajaran = isset($_GET['mata_pelajaran']) ? $_GET['mata_pelajaran'] : '';
$selectedKelas = isset($_GET['kelas']) ? $_GET['kelas'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Soal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus soal ini?')) {
                document.getElementById('delete_form_' + id).submit();
            }
        }
    </script>
</head>

<body class="bg-gray-50">
    <?php include '../../layout/sidebar.php'; ?>
    
    <header class="bg-gradient-to-r from-blue-600 to-blue-800 text-white shadow-md py-4">
        <?php include '../../layout/header.php'; ?>
    </header>

    <main class="container mx-auto px-4 py-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Bank Soal</h1>
                <a href="input_bank_soal.php" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                    Tambah Soal
                </a>
            </div>

            <!-- Search and Filter Form -->
            <form method="GET" class="mb-6 flex gap-4">
                <div class="flex-1">
                    <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>"
                        placeholder="Cari soal..."
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <select name="mata_pelajaran" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Mata Pelajaran</option>
                    <option value="Matematika" <?php echo $selectedMataPelajaran == 'Matematika' ? 'selected' : ''; ?>>Matematika</option>
                    <option value="Bahasa Indonesia" <?php echo $selectedMataPelajaran == 'Bahasa Indonesia' ? 'selected' : ''; ?>>Bahasa Indonesia</option>
                    <option value="Fisika" <?php echo $selectedMataPelajaran == 'Fisika' ? 'selected' : ''; ?>>Fisika</option>
                </select>
                <select name="kelas" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Kelas</option>
                    <option value="7" <?php echo $selectedKelas == '7' ? 'selected' : ''; ?>>Kelas 7</option>
                    <option value="8" <?php echo $selectedKelas == '8' ? 'selected' : ''; ?>>Kelas 8</option>
                    <option value="9" <?php echo $selectedKelas == '9' ? 'selected' : ''; ?>>Kelas 9</option>
                </select>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Filter
                </button>
            </form>

            <!-- Table Section -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Bank Soal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Detail</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Pelajaran</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File Soal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">URL Soal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File Jawaban</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">URL Jawaban</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php
                            $bank_soal = getBankSoal($search, $selectedMataPelajaran, $selectedKelas);
                            if ($bank_soal && mysqli_num_rows($bank_soal) > 0) {
                                while ($row = mysqli_fetch_assoc($bank_soal)) {
                                    echo "<tr class='hover:bg-gray-50'>";
                                    echo "<td class='px-6 py-4 whitespace-nowrap'>{$row['id']}</td>";
                                    echo "<td class='px-6 py-4 whitespace-nowrap'>{$row['judul_bank_soal']}</td>";
                                    echo "<td class='px-6 py-4'>{$row['detail_bank_soal']}</td>";
                                    echo "<td class='px-6 py-4'>{$row['mata_pelajaran']}</td>";
                                    echo "<td class='px-6 py-4'>{$row['kelas']}</td>";
                                    echo "<td class='px-6 py-4'>" . 
                                    ($row['file_soal'] ? "<a href='/path/to/files/{$row['file_soal']}' target='_blank' class='text-blue-600 hover:underline'>Unduh Soal</a>" : '-') . 
                                "</td>";                                    echo "<td class='px-6 py-4'>" . ($row['url_soal'] ? "<a href='{$row['url_soal']}' target='_blank' class='text-blue-600 hover:underline'>Lihat Soal</a>" : '-') . "</td>";
                                echo "<td class='px-6 py-4'>" . 
                                ($row['file_jawaban'] ? "<a href='/path/to/files/{$row['file_jawaban']}' target='_blank' class='text-blue-600 hover:underline'>Unduh Jawaban</a>" : '-') . 
                            "</td>";                                    echo "<td class='px-6 py-4'>" . ($row['url_jawaban'] ? "<a href='{$row['url_jawaban']}' target='_blank' class='text-blue-600 hover:underline'>Lihat Jawaban</a>" : '-') . "</td>";
                                    echo "<td class='px-6 py-4'>";
                                    echo "<div class='flex space-x-2'>";
                                    echo "<a href='edit_bank_soal.php?id={$row['id']}' class='text-blue-600 hover:text-blue-800'>Edit</a>";
                                    echo "<form id='delete_form_{$row['id']}' method='POST' class='inline'>";
                                    echo "<input type='hidden' name='delete_id' value='{$row['id']}'>";
                                    echo "<button type='button' onclick='confirmDelete({$row['id']})' class='text-red-600 hover:text-red-800'>Hapus</button>";
                                    echo "</form>";
                                    echo "</div>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='10' class='px-6 py-4 text-center'>Tidak ada data</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <!-- <div class="mt-6 flex justify-between items-center">
                <div class="text-sm text-gray-700">
                    Menampilkan 1 - 10 dari 20 data
                </div>
                <div class="flex space-x-2">
                    <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Previous</button>
                    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">1</button>
                    <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">2</button>
                    <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Next</button>
                </div>
            </div> -->
        </div>
    </main>

    <?php include '../../layout/footer.php'; ?>
</body>
</html>