<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

// Proses update wali kelas ketika tombol "Simpan" diklik
$message = ''; // Inisialisasi variabel pesan
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['kelas'])) {
    $errorFound = false; // Variabel untuk melacak kesalahan

    foreach ($_POST['kelas'] as $id_guru => $id_kelas) {
        if ($id_kelas === 'null') {
            $id_kelas = null; // Mengubah string 'null' menjadi null
        }

        if ($id_kelas) { // Jika kelas dipilih (bukan null)
            // Cek apakah kelas sudah memiliki wali
            $checkQuery = "SELECT wali_kelas_id FROM kelas WHERE id_kelas = '$id_kelas'";
            $checkResult = mysqli_query($conn, $checkQuery);
            $checkRow = mysqli_fetch_assoc($checkResult);

            if ($checkRow['wali_kelas_id']) {
                $message = "Kelas ini sudah memiliki wali kelas!";
                $errorFound = true; // Tandai bahwa ada kesalahan
                break; // Hentikan iterasi karena ada konflik
            } else {
                // Jika belum ada wali kelas, update wali kelas
                $query = "UPDATE kelas SET wali_kelas_id = '$id_guru' WHERE id_kelas = '$id_kelas'";
                if (mysqli_query($conn, $query)) {
                    $message = "Data berhasil diperbarui!";
                } else {
                    $message = "Terjadi kesalahan saat memperbarui data: " . mysqli_error($conn);
                    $errorFound = true;
                    break;
                }
            }
        } elseif ($id_kelas === null) {
            // Jika "Bukan Wali Kelas" dipilih, hapus wali kelas (set null)
            $query = "UPDATE kelas SET wali_kelas_id = NULL WHERE wali_kelas_id = '$id_guru'";
            if (mysqli_query($conn, $query)) {
                $message = "Wali kelas berhasil dihapus!";
            } else {
                $message = "Terjadi kesalahan saat menghapus wali kelas: " . mysqli_error($conn);
                $errorFound = true;
                break;
            }
        }
    }

    // Tambahkan logika jika error ditemukan
    if ($errorFound) {
        $message = "Proses dihentikan karena ada konflik dengan wali kelas!";
    }
}

// Ambil data guru dengan join mata_pelajaran dan kelas
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$query = "SELECT g.id_guru, g.nip, g.nama_lengkap, g.email, g.no_telp, mp.nama_pelajaran, 
                 CONCAT(k.tingkat, ' ', k.nama_kelas) AS kelas
          FROM guru g
          LEFT JOIN mata_pelajaran mp ON g.mata_pelajaran_id = mp.id_mata_pelajaran
          LEFT JOIN kelas k ON g.id_guru = k.wali_kelas_id
          WHERE g.nama_lengkap LIKE '%$search%'";
$result = mysqli_query($conn, $query);
$count = 1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelola Data Guru</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    function confirmDelete(url) {
      if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
        window.location.href = url; // Jika ya, lakukan penghapusan
      }
    }

    // Fungsi untuk membuat pesan pop-up hilang setelah 3 detik
    function showMessage() {
      setTimeout(function () {
        document.getElementById("message").style.display = "none"; // Sembunyikan pesan setelah 3 detik
      }, 3000);
    }
  </script>
</head>

<body class="bg-gray-50 text-gray-800">
  <?php include '../../layout/sidebar.php'; ?>
  <div class="min-h-screen flex flex-col">
    <?php include '../../layout/header.php'; ?>
    <main class="flex-1 container mx-auto px-6 mt-8 pb-12">
      <h1 class="text-3xl font-bold mb-6">Kelola Data Guru</h1>

      <!-- Pesan sukses atau peringatan -->
      <?php if (!empty($message)): ?>
        <div id="message" class="bg-green-100 text-green-800 border border-blue-400 rounded px-4 py-3 mb-4">
          <?= htmlspecialchars($message) ?>
        </div>
        <script>
          showMessage(); // Panggil fungsi untuk sembunyikan pesan setelah 3 detik
        </script>
      <?php endif; ?>

      <!-- Form Pencarian -->
      <form method="GET" class="mb-4">
        <input type="text" name="search" placeholder="Cari Nama Guru" class="border p-2 rounded" value="<?= htmlspecialchars($search) ?>">
        <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded">Cari</button>
      </form>

      <!-- Tambah Guru -->
      <a href="createGuru.php" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Tambah Guru</a>
      <a href="showClass.php" class="bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700">Tampilkan Kelas</a>

      <!-- Tabel Data Guru -->
      <div class="mt-6">
        <form method="POST">
          <table class="table-auto w-full border-collapse bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-blue-600 text-white">
              <tr>
                <th class="px-4 py-3">No</th>
                <th class="px-4 py-3">NIP</th>
                <th class="px-4 py-3">Nama Lengkap</th>
                <th class="px-4 py-3">Email</th>
                <th class="px-4 py-3">No. Telp</th>
                <th class="px-4 py-3">Mata Pelajaran</th>
                <th class="px-4 py-3">Wali</th>
                <th class="px-4 py-3">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr class="border-b hover:bg-gray-100">
                  <td class="px-4 py-2"><?= htmlspecialchars($count++) ?></td>
                  <td class="px-4 py-2"><?= htmlspecialchars($row['nip']) ?></td>
                  <td class="px-4 py-2"><?= htmlspecialchars($row['nama_lengkap']) ?></td>
                  <td class="px-4 py-2"><?= htmlspecialchars($row['email']) ?></td>
                  <td class="px-4 py-2"><?= htmlspecialchars($row['no_telp']) ?></td>
                  <td class="px-4 py-2"><?= htmlspecialchars($row['nama_pelajaran']) ?></td>
                  <td class="px-4 py-2">
                    <!-- Dropdown kelas dengan opsi "Bukan Wali Kelas" -->
                    <select name="kelas[<?= $row['id_guru'] ?>]" class="border rounded px-2 py-1">
                      <option value="" disabled>Pilih Kelas</option>
                      <option value="null">Bukan Wali Kelas</option> <!-- Opsi baru untuk "Bukan Wali Kelas" -->
                      <?php
                      // Query untuk mendapatkan daftar kelas
                      $kelasQuery = "SELECT id_kelas, CONCAT(tingkat, ' ', nama_kelas) AS nama_kelas FROM kelas";
                      $kelasResult = mysqli_query($conn, $kelasQuery);
                      while ($kelas = mysqli_fetch_assoc($kelasResult)) :
                      ?>
                        <option value="<?= $kelas['id_kelas'] ?>" <?= ($row['kelas'] == $kelas['nama_kelas'] ? 'selected' : '') ?>>
                          <?= htmlspecialchars($kelas['nama_kelas']) ?>
                        </option>
                      <?php endwhile; ?>
                    </select>
                  </td>
                  <td class="py-4 py-7 ">
                    <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">Simpan</button>
                    <a href="javascript:void(0)" onclick="confirmDelete('deleteGuru.php?id=<?= $row['id_guru'] ?>')" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Hapus</a>
                  </td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </form>
      </div>
    </main>
  </div>
</body>

</html>
