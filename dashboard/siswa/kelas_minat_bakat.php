<?php
    session_start();

    if (!isset($_SESSION['nama_lengkap'])) {
        header("Location: ../../login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function showRegistrationForm(kelas) {
            document.getElementById('registrationForm').classList.remove('hidden');
            document.getElementById('kelasTujuan').value = kelas;
        }
    </script>
</head>
<body class="bg-gray-50 text-gray-800">
    <!-- Sidebar -->
    <?php include '../../layout/sidebar.php'; ?>

    <!-- Navbar -->
    <header id="header" class="bg-pink-500 text-white py-4 transition-all duration-300">
        <?php include '../../layout/header.php' ?>
    </header>

    <!-- Main Content -->
    <div id="mainContent" class="container mx-auto mt-8 px-4 transition-all duration-300">
        <h2 class="text-2xl font-bold text-center text-pink-600 mb-6">Daftar Kelas Minat Bakat</h2>

        <!-- Selamat Datang -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-6 text-center">
            <h3 class="text-gray-600 mt-2">Menampilkan Jadwal Mata Pelajaran, dapat dicetak untuk lebih jelasnya.</h3>
        </div>

        <!-- Card Kelas Minat Bakat -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php
                $kelas = [
                    ["nama" => "Musik", "deskripsi" => "Pelajari berbagai instrumen dan teori musik untuk meningkatkan kemampuan bermusik Anda."],
                    ["nama" => "Olahraga", "deskripsi" => "Ikuti berbagai aktivitas fisik dan pelatihan untuk menjaga kebugaran tubuh."],
                    ["nama" => "Seni Rupa", "deskripsi" => "Eksplorasi kreativitas Anda melalui lukisan, menggambar, dan media seni lainnya."]
                ];

                foreach ($kelas as $k) {
                    echo "<div class='bg-white shadow-lg rounded-lg p-6 text-center'>";
                    echo "<h3 class='text-xl font-bold mb-2'>{$k['nama']}</h3>";
                    echo "<p class='text-gray-600 mb-4'>{$k['deskripsi']}</p>";
                    echo "<button class='bg-pink-500 text-white py-2 px-4 rounded-lg hover:bg-pink-600' onclick=\"showRegistrationForm('{$k['nama']}')\">View</button>";
                    echo "</div>";
                }
            ?>
        </div>

        <!-- Form Pendaftaran -->
        <div id="registrationForm" class="hidden bg-white shadow-lg rounded-lg p-6 mt-8">
            <h3 class="text-lg font-semibold mb-4">Form Pendaftaran</h3>
            <form action="process_registration.php" method="POST">
                <div class="mb-4">
                    <label for="nama" class="block text-gray-700 font-medium mb-2">Nama:</label>
                    <input type="text" name="nama" id="nama" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-pink-300" required>
                </div>
                <div class="mb-4">
                    <label for="kelas" class="block text-gray-700 font-medium mb-2">Kelas:</label>
                    <input type="text" name="kelas" id="kelas" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-pink-300" required>
                </div>
                <div class="mb-4">
                    <label for="tujuan" class="block text-gray-700 font-medium mb-2">Tujuan:</label>
                    <textarea name="tujuan" id="tujuan" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-pink-300" placeholder="Tuliskan tujuan Anda..." required></textarea>
                </div>
                <input type="hidden" name="kelas_tujuan" id="kelasTujuan">
                <div class="text-center">
                    <button type="submit" class="bg-pink-500 text-white py-2 px-4 rounded-lg hover:bg-pink-600">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
