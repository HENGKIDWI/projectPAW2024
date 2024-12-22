<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil inputan dan membersihkan data untuk mencegah SQL injection
    $nama = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $nisn = mysqli_real_escape_string($conn, $_POST['nisn']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $tanggal_lahir = mysqli_real_escape_string($conn, $_POST['tanggal_lahir']);
    $jenis_kelamin = mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
    $kelas_id = mysqli_real_escape_string($conn, $_POST['kelas_id']);
    $kontak_orang_tua = mysqli_real_escape_string($conn, $_POST['kontak_orang_tua']);

    // Validasi panjang nomor telepon
    if (strlen($kontak_orang_tua) > 15) {
        echo "<script>alert('Nomor telepon tidak boleh lebih dari 15 karakter.'); window.location.href='kelolaDataSiswaTambahSiswa.php';</script>";
        exit;
    }

    // Membuat username dan password sama dengan NISN
    $username = $nisn;
    $password = $nisn;

    // Validasi kelas_id
    $kelas_check = mysqli_query($conn, "SELECT id_kelas FROM kelas WHERE id_kelas = '$kelas_id'");
    if (mysqli_num_rows($kelas_check) == 0) {
        echo "<script>
            alert('Kelas tidak valid!');
            window.location.href = 'kelolaDataSiswaTambah.php';
        </script>";
        exit;
    }
    // Cek apakah kelas sudah penuh
    $kelas_capacity_check = mysqli_query($conn, "SELECT COUNT(*) AS jumlah_siswa 
    FROM siswa WHERE kelas_id = '$kelas_id'");
    $kelas_data = mysqli_fetch_assoc($kelas_capacity_check);

    if ($kelas_data['jumlah_siswa'] >= 32) {
        echo "<script>
        alert('Kelas yang dipilih sudah penuh. Silakan pilih kelas lain.');
        window.location.href = 'kelolaDataSiswaTambah.php';
        </script>";
        exit;
    }

    // Query untuk memasukkan data
    $query = "INSERT INTO siswa (nama_lengkap, nis, alamat, tanggal_lahir, jenis_kelamin, kelas_id, no_telp, username, password) 
              VALUES ('$nama', '$nisn', '$alamat', '$tanggal_lahir', '$jenis_kelamin', '$kelas_id', '$kontak_orang_tua', '$username', '$password')";

    // Eksekusi query
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Jika berhasil, redirect ke halaman kelolaDataSiswa.php
        echo "<script>
            alert('Data siswa berhasil ditambahkan!');
            window.location.href = 'kelolaDataSiswa.php';
        </script>";
    } else {
        // Jika gagal, tampilkan pesan error
        echo "<script>
            alert('Gagal menambahkan data siswa!');
            window.location.href = 'kelolaDataSiswaTambah.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function updateUserInfo() {
            // Ambil nilai dari NISN
            var nisn = document.getElementById("nisn").value;
            
            // Menampilkan nilai NISN di field username dan password
            document.getElementById("username").value = nisn;
            document.getElementById("password").value = nisn;
        }

        function checkClassCapacity() {
            const kelasSelect = document.getElementById("kelas_id");
            const selectedOption = kelasSelect.options[kelasSelect.selectedIndex];
            
            // Jika kelas penuh, tampilkan notifikasi
            if (selectedOption.text.includes("PENUH")) {
                alert("Kelas ini sudah penuh (32 siswa). Silakan pilih kelas lain.");
                kelasSelect.value = ""; // Reset pilihan ke default
            }
        }

        // Style disabled options on load
        document.addEventListener('DOMContentLoaded', function() {
            const kelasSelect = document.getElementById('kelas_id');
            
            Array.from(kelasSelect.options).forEach(option => {
                if (option.disabled) {
                    option.style.backgroundColor = '#f3f4f6';
                    option.style.color = '#9ca3af';
                }
            });
        });
    </script>
</head>
<body class="bg-gray-100 text-gray-800">
    <!-- sidebar -->
    <?php include '../../layout/sidebar.php'; ?>

    <!-- Navbar -->
    <header class="bg-blue-600 text-white py-4">
        <?php include '../../layout/header.php'; ?>
    </header>

    <!-- Main Content -->
    <div class="container mx-auto mt-8 px-4">
        <a href="kelolaDataSiswa.php" 
             class="bg-gradient-to-r from-yellow-800 to-indigo-700 text-white px-8 py-4 text-lg font-semibold rounded-full shadow-lg hover:bg-gradient-to-l hover:from-indigo-500 hover:to-purple-500 transition duration-300 transform hover:scale-105">
             <i class="fa-solid fa-backward"></i> Kelola Data Siswa
        </a>
        <h2 class="text-2xl font-bold text-center mb-6">Form Tambah Data Siswa</h2>
        <form action="" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nama">Nama Siswa</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nama" name="nama_lengkap" type="text" placeholder="Nama Siswa" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nisn">NISN</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nisn" name="nisn" type="text" placeholder="NISN" required oninput="updateUserInfo()">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="alamat">Alamat</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="alamat" name="alamat" type="text" placeholder="Alamat" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="kontak_orang_tua">Kontak Orang Tua</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="kontak_orang_tua" name="kontak_orang_tua" type="text" placeholder="Kontak Orang Tua" required>
                <small>Tidak boleh melebihi 15 angka</small>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="tanggal_lahir">Tanggal Lahir</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="tanggal_lahir" name="tanggal_lahir" type="date" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="jenis_kelamin">Jenis Kelamin</label>
                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="laki-laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="kelas_id">Kelas</label>
                <select name="kelas_id" onchange="checkClassCapacity()" id="kelas_id" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Pilih Kelas</option>
                    <?php
                    // Query untuk mendapatkan semua kelas dan jumlah siswa per kelas
                    $kelas_query = mysqli_query($conn, "SELECT k.id_kelas, k.tingkat, k.nama_kelas, 
                                                      (SELECT COUNT(*) FROM siswa s WHERE s.kelas_id = k.id_kelas) AS jumlah_siswa
                                                      FROM kelas k
                                                      ORDER BY k.tingkat, k.nama_kelas");

                    while ($row = mysqli_fetch_assoc($kelas_query)) {
                        $is_full = $row['jumlah_siswa'] >= 32;
                        $disabled = $is_full ? 'disabled' : '';
                        $capacity_text = $is_full ? 
                                       " (PENUH - 32/32 siswa)" : 
                                       " (" . $row['jumlah_siswa'] . "/32 siswa)";
                        
                        echo "<option value='{$row['id_kelas']}' $disabled " . 
                             ($is_full ? "class='text-gray-400'" : "") . ">
                             Tingkat {$row['tingkat']} - {$row['nama_kelas']}{$capacity_text}
                             </option>";
                    }
                    ?>
                </select>
                <small class="text-gray-600">Maksimal 32 siswa per kelas</small>
            </div>

            <!-- Username and Password (readonly, auto-filled) -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">Username</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" name="username" type="text" readonly>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" name="password" type="text" readonly>
            </div>

            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Simpan</button>
            </div>
        </form>
    </div>
    <?php include '../../layout/footer.php'; ?>

</body>
</html>