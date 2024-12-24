<?php
include "../../koneksi.php";
session_start();


// Function to get list of classes
function getDaftarKelas() {
    global $conn;
    $query = "SELECT DISTINCT tingkat FROM kelas ORDER BY tingkat ASC"; ;
    return mysqli_query($conn, $query);
}

// Function to get list of subjects
function getDaftarMapel() {
    global $conn;
    $query = "SELECT * FROM mata_pelajaran";
    return mysqli_query($conn, $query);
}

// Process form if submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $kelas_id = mysqli_real_escape_string($conn, $_POST['kelas']);
    $mapel_id = mysqli_real_escape_string($conn, $_POST['mata_pelajaran']);
    
    // Process file upload for question (optional)
    $file_soal = null;
    if (!empty($_FILES['file_soal']['name'])) {
        $target_dir = "uploads/soal/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $file_name_soal = uniqid() . '_' . basename($_FILES['file_soal']['name']);
        $target_file_soal = $target_dir . $file_name_soal;
        
        if (move_uploaded_file($_FILES['file_soal']['tmp_name'], $target_file_soal)) {
            $file_soal = $file_name_soal;
        } else {
            $error_message = "Maaf, terjadi kesalahan saat upload file soal.";
        }
    }
    
    // Process file upload for answer (optional)
    $file_jawaban = null;
    if (!empty($_FILES['file_jawaban']['name'])) {
        $target_dir = "uploads/jawaban/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $file_name_jawaban = uniqid() . '_' . basename($_FILES['file_jawaban']['name']);
        $target_file_jawaban = $target_dir . $file_name_jawaban;
        
        if (move_uploaded_file($_FILES['file_jawaban']['tmp_name'], $target_file_jawaban)) {
            $file_jawaban = $file_name_jawaban;
        } else {
            $error_message = "Maaf, terjadi kesalahan saat upload file jawaban.";
        }
    }
    
    // Question URL (optional)
    $url_soal = !empty($_POST['url_soal']) ? mysqli_real_escape_string($conn, $_POST['url_soal']) : null;
    
    // Answer URL (optional)
    $url_jawaban = !empty($_POST['url_jawaban']) ? mysqli_real_escape_string($conn, $_POST['url_jawaban']) : null;
    
    // Insert query for task
    $query = "INSERT INTO bank_soal (
        judul_bank_soal, 
        detail_bank_soal, 
        mata_pelajaran,
        kelas, 
        file_soal, 
        file_jawaban,
        url_soal, 
        url_jawaban
    ) VALUES (
        '$judul', 
        '$deskripsi', 
        '$mapel_id',
        '$kelas_id', 
        " . ($file_soal ? "'$file_soal'" : "NULL") . ", 
        " . ($file_jawaban ? "'$file_jawaban'" : "NULL") . ", 
        " . ($url_soal ? "'$url_soal'" : "NULL") . ", 
        " . ($url_jawaban ? "'$url_jawaban'" : "NULL") . "
    )";
    
    if (mysqli_query($conn, $query)) {
        $success_message = "Tugas berhasil ditambahkan!";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();    
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
    <title>Input Bank Soal</title>
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
        <h2 class="text-2xl font-bold text-center mb-6">Input Bank Soal</h2>

        <?php 
        // Display success or error message
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
                    <!-- Left Column: Basic Task Information -->
                    <div class="space-y-4">
                        <h3 class="text-xl font-semibold text-blue-600 mb-4">Bank Soal</h3>
                        
                        <!-- Task Title -->
                        <div>
                            <label for="judul" class="block text-gray-700 font-bold mb-2">Judul</label>
                            <input type="text" id="judul" name="judul" required 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Masukan Judul">
                        </div>

                        <!-- Task Description -->
                        <div>
                            <label for="deskripsi" class="block text-gray-700 font-bold mb-2"> Deskripsi</label>
                            <textarea id="deskripsi" name="deskripsi" rows="4" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Masukan Deskripsi"></textarea>
                        </div>

                        <!-- Subject -->
                        <div>
                            <label for="mata_pelajaran" class="block text-gray-700 font-bold mb-2">Mata Pelajaran</label>
                            <select id="mata_pelajaran" name="mata_pelajaran" required 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Mata Pelajaran</option>
                                <?php 
                                $mapel_list = getDaftarMapel();
                                while ($row = mysqli_fetch_assoc($mapel_list)) {
                                    echo "<option value='" . $row['nama_pelajaran'] . "'>" . $row['nama_pelajaran'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Class -->
                        <div>
                            <label for="kelas" class="block text-gray-700 font-bold mb-2">Tingkat</label>
                            <select id="kelas" name="kelas" required 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Tingkat</option>
                                <?php 
                                $kelas_list = getDaftarKelas();
                                while ($row = mysqli_fetch_assoc($kelas_list)) {
                                    echo "<option value='" . $row['tingkat'] . "'>" . $row['tingkat'] ."</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Task Points -->
                        <!-- <div>
                            <label for="poin" class="block text-gray-700 font-bold mb-2">Task Points</label>
                            <input type="number" id="poin" name="poin" required min="0" max="100"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Enter task points">
                        </div> -->

                        <!-- Deadline -->
                        <!-- <div>
                            <label for="deadline" class="block text-gray-700 font-bold mb-2">Task Deadline</label>
                            <input type="datetime-local" id="deadline" name="deadline" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div> -->
                    </div>

                    <!-- Right Column: File and URL Upload -->
                    <div class="space-y-4">
                        <h3 class="text-xl font-semibold text-blue-600 mb-4">Documents</h3>
                        
                        <!-- Question File (Optional) -->
                        <div>
                            <label for="file_soal" class="block text-gray-700 font-bold mb-2">Soal File (Optional)</label>
                            <input type="file" id="file_soal" name="file_soal" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Soal URL (Optional) -->
                        <div>
                            <label for="url_soal" class="block text-gray-700 font-bold mb-2">Soal URL (Optional)</label>
                            <input type="url" id="url_soal" name="url_soal" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="https://example.com/question">
                        </div>

                        <!-- Answer File (Optional) -->
                        <div>
                            <label for="file_jawaban" class="block text-gray-700 font-bold mb-2">Jawaban File (Optional)</label>
                            <input type="file" id="file_jawaban" name="file_jawaban" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Jawaban URL (Optional) -->
                        <div>
                            <label for="url_jawaban" class="block text-gray-700 font-bold mb-2">Jawaban URL (Optional)</label>
                            <input type="url" id="url_jawaban" name="url_jawaban" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="https://example.com/answer">
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-right mt-6">
                    <a href="bank_soal.php" class="bg-gray-500 text-white px-4 py-2 rounded shadow hover:bg-gray-600">Batal</a>
                    <button type="submit" 
                        class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition duration-300">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php
    require_once "../../layout/footer.php"
    ?>
</body>
</html>