<?php
include "../../koneksi.php";
session_start();

// Function to get bank soal data
function getBankSoal()
{
    global $conn;
    $query = "SELECT * FROM bank_soal ORDER BY id ASC";
    $result = mysqli_query($conn, $query);
    return $result ? $result : null;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Soal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    <!-- Sidebar -->
    <?php include '../../layout/sidebar.php'; ?>

    <!-- Header -->
    <header class="bg-gradient-to-r from-blue-600 to-blue-800 text-white shadow-md py-4">
        <?php include '../../layout/header.php'; ?>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Bank Soal</h1>
                <a href="input_bank_soal.php" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                    Tambah Soal
                </a>

            </div>

            <!-- Search and Filter Section -->
            <div class="mb-6 flex gap-4">
                <div class="flex-1">
                    <input type="text"
                        placeholder="Cari soal..."
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <select class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Mata Pelajaran</option>
                    <option value="Matematika">Matematika</option>
                    <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                    <option value="Fisika">Fisika</option>
                </select>
                <select class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Kelas</option>
                    <option value="7">Kelas 7</option>
                    <option value="8">Kelas 8</option>
                    <option value="9">Kelas 9</option>
                </select>
            </div>

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
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File Jawaban</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php
                            $bank_soal = getBankSoal();
                            if ($bank_soal) {
                                while ($row = mysqli_fetch_assoc($bank_soal)) {
                                    echo "<tr class='hover:bg-gray-50'>";
                                    echo "<td class='px-6 py-4 whitespace-nowrap'>{$row['id']}</td>";
                                    echo "<td class='px-6 py-4 whitespace-nowrap'>{$row['judul_bank_soal']}</td>";
                                    echo "<td class='px-6 py-4'>{$row['detail_bank_soal']}</td>";
                                    echo "<td class='px-6 py-4'>{$row['mata_pelajaran']}</td>";
                                    echo "<td class='px-6 py-4'>{$row['kelas']}</td>";
                                    echo "<td class='px-6 py-4'>" . ($row['file_soal'] ? $row['file_soal'] : '-') . "</td>";
                                    echo "<td class='px-6 py-4'>" . ($row['file_jawaban'] ? $row['file_jawaban'] : '-') . "</td>";
                                    echo "<td class='px-6 py-4'>";
                                    echo "<div class='flex space-x-2'>";
                                    echo "<button class='text-blue-600 hover:text-blue-800'>Edit</button>";
                                    echo "<button class='text-red-600 hover:text-red-800'>Hapus</button>";
                                    echo "</div>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='8' class='px-6 py-4 text-center'>Tidak ada data</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-6 flex justify-between items-center">
                <div class="text-sm text-gray-700">
                    Menampilkan 1 - 10 dari 20 data
                </div>
                <div class="flex space-x-2">
                    <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Previous</button>
                    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">1</button>
                    <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">2</button>
                    <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Next</button>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include '../../layout/footer.php'; ?>
</body>

</html>