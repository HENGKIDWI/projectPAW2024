<?php
// Konfigurasi Database
$host = "localhost";
$user = "root";
$password = "";
$database = "school"; // Ganti dengan nama database kamu

// Koneksi Database
$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Logika Proses Form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_kost = $_POST['id_kost'];
    $nama = $_POST['nama'];
    $tgl_bayar = $_POST['tgl_bayar'];
    $metode_bayar = $_POST['metode_bayar'];
    $jumlah_bayar = $_POST['jumlah_bayar'];

    // Atur Status Berdasarkan Metode Pembayaran
    $status_pembayaran = ($metode_bayar === "Ditempat") ? "sukses" : "pending";

    // Query Simpan ke Database
    $sql = "INSERT INTO pembayaran (id_kost, nama, tgl_bayar, metode_bayar, jumlah_bayar, status_pembayaran) 
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssds", $id_kost, $nama, $tgl_bayar, $metode_bayar, $jumlah_bayar, $status_pembayaran);

    if ($stmt->execute()) {
        // Redirect Berdasarkan Metode Pembayaran
        if ($metode_bayar == "Ditempat") {
            echo "<script>window.location.href = 'transaksiditempat.php';</script>";
        } elseif ($metode_bayar == "QRIS") {
            echo "<script>window.location.href = 'transaksiqris.php';</script>";
        }
        exit();
    } else {
        echo "<div style='text-align: center; margin-top: 50px;'>Gagal menyimpan pembayaran: " . $stmt->error . "</div>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Kost</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    <nav class="bg-white shadow-md py-8 mb-8">
        <div class="container mx-auto flex justify-center">
            <h1 class="text-2xl font-bold text-gray-800">Pembayaran Kost</h1>
        </div>
    </nav>

    <!-- Form Pembayaran -->
    <div class="container mx-auto">
        <div class="bg-white p-8 shadow rounded-lg max-w-md mx-auto">
            <form action="" method="post">
                <!-- ID Kost -->
                <div class="mb-4">
                    <label for="id_kost" class="block text-sm font-medium text-gray-700">ID Kost</label>
                    <input type="text" name="id_kost" id="id_kost" required
                        class="p-3 w-full border border-gray-300 rounded-md mt-2" placeholder="Masukkan ID Kost">
                </div>

                <!-- Nama -->
                <div class="mb-4">
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="nama_kost" id="nama_kost" required
                        class="p-3 w-full border border-gray-300 rounded-md mt-2" placeholder="Masukkan Nama">
                </div>

                <!-- Tanggal Bayar -->
                <div class="mb-4">
                    <label for="tgl_bayar" class="block text-sm font-medium text-gray-700">Tanggal Bayar</label>
                    <input type="date" name="tgl_bayar" id="tgl_bayar" required
                        class="p-3 w-full border border-gray-300 rounded-md mt-2">
                </div>

                <!-- Metode Bayar -->
                <div class="mb-4">
                    <label for="metode_bayar" class="block text-sm font-medium text-gray-700">Metode Bayar</label>
                    <select name="metode_bayar" id="metode_bayar" required
                        class="p-3 w-full border border-gray-300 rounded-md mt-2">
                        <option value="" disabled selected>-- Pilih Metode --</option>
                        <option value="QRIS">QRIS</option>
                        <option value="Ditempat">Ditempat</option>
                    </select>
                </div>

                <!-- Jumlah Bayar -->
                <div class="mb-4">
                    <label for="jumlah_bayar" class="block text-sm font-medium text-gray-700">Jumlah Bayar</label>
                    <input type="number" name="jumlah_bayar" id="jumlah_bayar" required
                        class="p-3 w-full border border-gray-300 rounded-md mt-2" placeholder="Masukkan Jumlah Bayar">
                </div>

                <!-- Tombol Submit -->
                <div class="text-center">
                    <button type="submit"
                        class="bg-[#ebd6ca] text-white px-6 py-3 rounded-lg hover:bg-[#5a3724] transition">
                        Lanjutkan Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>