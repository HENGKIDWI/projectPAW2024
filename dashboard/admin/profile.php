<?php
session_start();
include "../../koneksi.php";

// Cek apakah session username ada
if (!isset($_SESSION['username'])) {
    header("Location: ../../login.php");
    exit;
}

$username = $_SESSION['username']; // Mengambil username dari session

// Ambil data admin berdasarkan username
$query = "SELECT * FROM admin WHERE username = '$username'";
$result = mysqli_query($conn, $query);

if ($result) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "<script>alert('Gagal mengambil data pengguna.');</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Admin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

  <!-- Sidebar -->
  <?php include '../../layout/sidebar.php'; ?>
  <!-- Navbar -->
  <header id="header" class="bg-blue-600 text-white py-4 transition-all duration-300">
    <?php include '../../layout/header.php' ?>
  </header>
    <!-- Profile Section -->
    <div class="container mx-auto mt-8 px-4">
        <h2 class="text-3xl font-bold mb-6">Profile Admin</h2>

        <!-- Form untuk update profile -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <form method="POST">
                <h3 class="text-lg font-semibold mb-4">Edit Profile</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label for="nama_lengkap" class="block text-gray-700">Nama Lengkap</label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap" value="<?php echo $user['nama_lengkap']; ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700">Password</label>
                        <input type="password" id="password" name="password" placeholder="Masukkan password baru" class="w-full px-4 py-2 border border-gray-300 rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="confirm_password" class="block text-gray-700">Konfirmasi Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Konfirmasi password baru" class="w-full px-4 py-2 border border-gray-300 rounded-md">
                    </div>
                </div>
                <button type="submit" name="update_profile" class="bg-blue-500 text-white px-6 py-2 rounded-md mt-4">Update Profile</button>
            </form>
        </div>
    </div>

</body>
</html>

<?php
// Update profile jika form disubmit
if (isset($_POST['update_profile'])) {
    $nama_lengkap = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // Validasi password
    if ($password !== $confirm_password) {
        echo "<script>alert('Password dan konfirmasi password tidak cocok!');</script>";
        exit;
    }

    // Hash password baru jika ada perubahan
    if (!empty($password)) {
        $password = password_hash($password, PASSWORD_DEFAULT);
    } else {
        // Jika tidak ada password baru, tetap gunakan password lama
        $password = $user['password'];
    }

    // Query untuk update data admin
    $update_query = "UPDATE admin SET nama_lengkap = '$nama_lengkap', email = '$email', password = '$password' WHERE username = '$username'";

    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Profile updated successfully'); window.location.href = 'profile.php';</script>";
    } else {
        echo "<script>alert('Error updating profile');</script>";
    }
}
?>
