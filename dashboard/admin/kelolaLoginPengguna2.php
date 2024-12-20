<?php
include "../../koneksi.php"; // Koneksi database
session_start(); // Mulai sesi

// Cek apakah user sudah login
if (isset($_SESSION['username'])) {
    // header("Location: .php"); // Redirect ke dashboard jika sudah login
    exit;
}

// Cek apakah form login sudah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query untuk mencocokkan username dan password dari tabel siswa, guru, dan admin
    $query = "SELECT * FROM (
                SELECT username, password, 'siswa' as role FROM siswa
                UNION
                SELECT username, password, 'guru' as role FROM guru
                UNION
                SELECT username, password, 'admin' as role FROM admin
              ) AS pengguna
              WHERE username = '$username' AND password = '$password' LIMIT 1";

    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Jika username dan password cocok
        $user = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $user['role']; // Menyimpan role (siswa, guru, admin)
        
        header("Location: dashboard.php"); // Arahkan ke dashboard
        exit;
    } else {
        // Jika login gagal
        $error_message = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Pengguna</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
  <!-- Sidebar -->
  <?php include '../../layout/sidebar.php'; ?>

  <!-- Navbar -->
  <header id="header" class="bg-blue-600 text-white py-4">
    <?php include '../../layout/header.php'; ?>
  </header>

  <!-- Main Content -->
  <div id="mainContent" class="container mx-auto mt-8 px-4">
    <h2 class="text-2xl font-bold text-center mb-6">Kelola Login Pengguna</h2>

    <!-- Form Login -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
      <form method="POST" action="" class="space-y-4">
        <div class="mb-4">
          <label for="username" class="block text-sm font-semibold text-gray-700">Username</label>
          <input type="text" id="username" name="username" class="w-full px-4 py-2 border rounded-md" required>
        </div>

        <div class="mb-4">
          <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
          <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-md" required>
        </div>

        <?php if (isset($error_message)): ?>
        <div class="text-red-500 text-sm mt-2"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition-all duration-300">Login</button>
      </form>
    </div>
  </div>

  <?php include '../../layout/footer.php'; ?>

  <script>
    // Javascript jika diperlukan
  </script>
</body>
</html>
