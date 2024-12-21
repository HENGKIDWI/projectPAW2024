<?php
include "../../koneksi.php";
session_start();

// Function to get list of classes
function getDaftarKelas() {
    global $conn;
    $query = "SELECT DISTINCT tingkat FROM kelas ORDER BY tingkat ASC";
    return mysqli_query($conn, $query);
}

// Function to get list of subjects
function getDaftarMapel() {
    global $conn;
    $query = "SELECT * FROM mata_pelajaran";
    return mysqli_query($conn, $query);
}

// Get bank soal data by ID
function getBankSoalById($id) {
    global $conn;
    $id = mysqli_real_escape_string($conn, $id);
    $query = "SELECT * FROM bank_soal WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

// Check if ID is provided
if (!isset($_GET['id'])) {
    header("Location: bank_soal.php");
    exit();
}

// Get bank soal data
$bank_soal = getBankSoalById($_GET['id']);
if (!$bank_soal) {
    header("Location: bank_soal.php");
    exit();
}

// Process form if submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $kelas_id = mysqli_real_escape_string($conn, $_POST['kelas']);
    $mapel_id = mysqli_real_escape_string($conn, $_POST['mata_pelajaran']);
    
    // Initialize update query
    $query = "UPDATE bank_soal SET 
        judul_bank_soal = '$judul',
        detail_bank_soal = '$deskripsi',
        mata_pelajaran = '$mapel_id',
        kelas = '$kelas_id'";

    // Process file upload for question (optional)
    if (!empty($_FILES['file_soal']['name'])) {
        $target_dir = "uploads/soal/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $file_name_soal = uniqid() . '_' . basename($_FILES['file_soal']['name']);
        $target_file_soal = $target_dir . $file_name_soal;
        
        if (move_uploaded_file($_FILES['file_soal']['tmp_name'], $target_file_soal)) {
            // Delete old file if exists
            if ($bank_soal['file_soal'] && file_exists($target_dir . $bank_soal['file_soal'])) {
                unlink($target_dir . $bank_soal['file_soal']);
            }
            $query .= ", file_soal = '$file_name_soal'";
        } else {
            $error_message = "Maaf, terjadi kesalahan saat upload file soal.";
        }
    }
    
    // Process file upload for answer (optional)
    if (!empty($_FILES['file_jawaban']['name'])) {
        $target_dir = "uploads/jawaban/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $file_name_jawaban = uniqid() . '_' . basename($_FILES['file_jawaban']['name']);
        $target_file_jawaban = $target_dir . $file_name_jawaban;
        
        if (move_uploaded_file($_FILES['file_jawaban']['tmp_name'], $target_file_jawaban)) {
            // Delete old file if exists
            if ($bank_soal['file_jawaban'] && file_exists($target_dir . $bank_soal['file_jawaban'])) {
                unlink($target_dir . $bank_soal['file_jawaban']);
            }
            $query .= ", file_jawaban = '$file_name_jawaban'";
        } else {
            $error_message = "Maaf, terjadi kesalahan saat upload file jawaban.";
        }
    }
    
    // Update URLs if provided
    if (isset($_POST['url_soal'])) {
        $url_soal = mysqli_real_escape_string($conn, $_POST['url_soal']);
        $query .= ", url_soal = " . (!empty($url_soal) ? "'$url_soal'" : "NULL");
    }
    
    if (isset($_POST['url_jawaban'])) {
        $url_jawaban = mysqli_real_escape_string($conn, $_POST['url_jawaban']);
        $query .= ", url_jawaban = " . (!empty($url_jawaban) ? "'$url_jawaban'" : "NULL");
    }
    
    // Complete the update query
    $query .= " WHERE id = '$id'";
    
    if (mysqli_query($conn, $query)) {
        $success_message = "Bank soal berhasil diupdate!";
        // Refresh data after update
        $bank_soal = getBankSoalById($id);
    } else {
        $error_message = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Bank Soal</title>
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
        <h2 class="text-2xl font-bold text-center mb-6">Edit Bank Soal</h2>

        <?php 
        if (isset($success_message)) {
            echo "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4' role='alert'>$success_message</div>";
        }
        if (isset($error_message)) {
            echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4' role='alert'>$error_message</div>";
        }
        ?>

        <div class="bg-white shadow-md rounded-lg p-8 max-w-4xl mx-auto">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Column: Basic Information -->
                    <div class="space-y-4">
                        <h3 class="text-xl font-semibold text-blue-600 mb-4">Bank Soal</h3>
                        
                        <!-- Title -->
                        <div>
                            <label for="judul" class="block text-gray-700 font-bold mb-2">Judul</label>
                            <input type="text" id="judul" name="judul" required 
                                value="<?php echo htmlspecialchars($bank_soal['judul_bank_soal']); ?>"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="deskripsi" class="block text-gray-700 font-bold mb-2">Deskripsi</label>
                            <textarea id="deskripsi" name="deskripsi" rows="4" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"><?php echo htmlspecialchars($bank_soal['detail_bank_soal']); ?></textarea>
                        </div>

                        <!-- Subject -->
                        <div>
                            <label for="mata_pelajaran" class="block text-gray-700 font-bold mb-2">Mata Pelajaran</label>
                            <select id="mata_pelajaran" name="mata_pelajaran" required 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <?php 
                                $mapel_list = getDaftarMapel();
                                while ($row = mysqli_fetch_assoc($mapel_list)) {
                                    $selected = ($row['nama_pelajaran'] == $bank_soal['mata_pelajaran']) ? 'selected' : '';
                                    echo "<option value='" . $row['nama_pelajaran'] . "' $selected>" . $row['nama_pelajaran'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Class -->
                        <div>
                            <label for="kelas" class="block text-gray-700 font-bold mb-2">Tingkat</label>
                            <select id="kelas" name="kelas" required 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <?php 
                                $kelas_list = getDaftarKelas();
                                while ($row = mysqli_fetch_assoc($kelas_list)) {
                                    $selected = ($row['tingkat'] == $bank_soal['kelas']) ? 'selected' : '';
                                    echo "<option value='" . $row['tingkat'] . "' $selected>" . $row['tingkat'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <!-- Right Column: Files and URLs -->
                    <div class="space-y-4">
                        <h3 class="text-xl font-semibold text-blue-600 mb-4">Documents</h3>
                        
                        <!-- Question File -->
                        <div>
                            <label for="file_soal" class="block text-gray-700 font-bold mb-2">File Soal</label>
                            <?php if ($bank_soal['file_soal']): ?>
                                <p class="text-sm text-gray-600 mb-2">File saat ini: <?php echo $bank_soal['file_soal']; ?></p>
                            <?php endif; ?>
                            <input type="file" id="file_soal" name="file_soal" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Question URL -->
                        <div>
                            <label for="url_soal" class="block text-gray-700 font-bold mb-2">URL Soal</label>
                            <input type="url" id="url_soal" name="url_soal" 
                                value="<?php echo !empty($bank_soal['url_soal']) ? htmlspecialchars($bank_soal['url_soal']) : "-"; ?>"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Answer File -->
                        <div>
                            <label for="file_jawaban" class="block text-gray-700 font-bold mb-2">File Jawaban</label>
                            <?php if ($bank_soal['file_jawaban']): ?>
                                <p class="text-sm text-gray-600 mb-2">File saat ini: <?php echo $bank_soal['file_jawaban']; ?></p>
                            <?php endif; ?>
                            <input type="file" id="file_jawaban" name="file_jawaban" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Answer URL -->
                        <div>
                            <label for="url_jawaban" class="block text-gray-700 font-bold mb-2">URL Jawaban</label>
                            <input type="url" id="url_jawaban" name="url_jawaban" 
                                value="<?php echo !empty($bank_soal['url_jawaban']) ? htmlspecialchars($bank_soal['url_jawaban']) : '-'; ?>"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="text-right mt-6">
                    <a href="bank_soal.php" class="bg-gray-500 text-white px-4 py-2 rounded shadow hover:bg-gray-600">Batal</a>
                    <button type="submit" 
                        class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition duration-300">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php include '../../layout/footer.php'; ?>
</body>
</html>