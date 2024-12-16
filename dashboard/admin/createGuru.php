<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

// Ambil daftar mata pelajaran
$mata_pelajaran = mysqli_query($conn, "SELECT * FROM mata_pelajaran");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nip = $_POST['nip'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $no_telp = $_POST['no_telp'];
    $mata_pelajaran_id = $_POST['id_mata_pelajaran'];
    $username = $nip;
    $password = $nip;
    $query = "INSERT INTO guru (`nip`, `nama_lengkap`, `email`, `no_telp`, `mata_pelajaran_id`, `username`, `password`) 
              VALUES ('$nip', '$nama_lengkap', '$email', '$no_telp', '$mata_pelajaran_id', '$username', '$password')";
    mysqli_query($conn, $query);

    header("Location: tampilan.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Guru</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
<?php include '../../layout/sidebar.php'; ?>
  <div class="min-h-screen flex flex-col">
    <?php include '../../layout/header.php'; ?>
    <main class="flex-1 container mx-auto px-6 mt-8 pb-12">
      <h1 class="text-3xl font-bold mb-6">Tambah Guru</h1>

      <form action="" method="POST" class="space-y-4 bg-white p-6 rounded shadow-md bg-gray-300">
        <div>
          <label for="nip" class="block font-semibold">NIP</label>
          <input type="text" id="nip" name="nip" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
          <label for="nama_lengkap" class="block font-semibold">Nama Lengkap</label>
          <input type="text" id="nama_lengkap" name="nama_lengkap" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
          <label for="email" class="block font-semibold">Email</label>
          <input type="email" id="email" name="email" class="w-full border rounded px-3 py-2">
        </div>
        <div>
          <label for="no_telp" class="block font-semibold">No. Telp</label>
          <input type="text" id="no_telp" name="no_telp" class="w-full border rounded px-3 py-2">
        </div>
        <div>
          <label for="username" class="block font-semibold">Username</label>
          <input type="text" id="username" name="username" class="w-full border rounded px-3 py-2">
        </div>
        <div>
          <label for="password" class="block font-semibold">password</label>
          <input type="text" id="password" name="password" class="w-full border rounded px-3 py-2">
        </div>
        <div>
          <label for="id_mata_pelajaran" class="block font-semibold">Mata Pelajaran</label>
          <select id="id_mata_pelajaran" name="id_mata_pelajaran" class="w-full border rounded px-3 py-2" required>
            <?php while ($row = mysqli_fetch_assoc($mata_pelajaran)) : ?>
              <option value="<?= $row['id_mata_pelajaran'] ?>"><?= htmlspecialchars($row['nama_pelajaran']) ?></option>
            <?php endwhile; ?>
          </select>
        </div>
        
        <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Simpan</button>
      </form>
    </main>
  </div>
  <script>
    const nip = document.getElementById('nip');
    const username = document.getElementById('username');
    const password = document.getElementById('password');
    nip.addEventListener('input', ()=> {
      username.value = nip.value;
      password.value = nip.value;
    })
  </script>
</body>
</html>