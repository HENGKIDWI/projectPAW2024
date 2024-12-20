<?php
include "../../koneksi.php";
session_start();

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

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

// Get filter values
$search = isset($_GET['search']) ? $_GET['search'] : '';
$selectedMataPelajaran = isset($_GET['mata_pelajaran']) ? $_GET['mata_pelajaran'] : '';
$selectedKelas = isset($_GET['kelas']) ? $_GET['kelas'] : '';

$bank_soal = getBankSoal($search, $selectedMataPelajaran, $selectedKelas);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Bank Soal</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50">
    <?php include '../../layout/sidebar.php'; ?>
    
    <header class="bg-gradient-to-r from-blue-600 to-blue-800 text-white shadow-md py-4">
        <?php include '../../layout/header.php'; ?>
    </header>

    <main class="container mx-auto px-4 py-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Daftar Bank Soal</h1>
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
                    <option value="9" <?php echo $selectedKelas == ' 9' ? 'selected' : ''; ?>>Kelas 9</option>
                </select>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200">Cari</button>
            </form>

            <!-- Daftar Soal -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">Judul Soal</th>
                            <th class="py-2 px-4 border-b">Mata Pelajaran</th>
                            <th class="py-2 px-4 border-b">Kelas</th>
                            <th class="py-2 px-4 border-b">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($bank_soal)): ?>
                        <tr>
                            <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($row['judul_bank_soal']); ?></td>
                            <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($row['mata_pelajaran']); ?></td>
                            <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($row['kelas']); ?></td>
                            <td class="py-2 px-4 border-b">
                                <a href="kerjakan_soal.php?id=<?php echo $row['id']; ?>" class="text-blue-600 hover:underline">Kerjakan</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>

</html>