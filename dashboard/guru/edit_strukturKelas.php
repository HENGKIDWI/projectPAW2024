<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id_struktural = $_GET['id'];

    // Fetch the current structure details
    $query = "SELECT * FROM struktural_kelas WHERE id_struktural = '$id_struktural'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);

    // Get the class and student info
    $kelas_id = $data['id_kelas'];
    $siswa_id = $data['siswa_id'];
    $jabatan = $data['jabatan'];

    // Fetch available classes and students for selection
    $kelas_list = mysqli_query($conn, "SELECT id_kelas, nama_kelas FROM kelas ORDER BY nama_kelas ASC");
    $siswa_list = mysqli_query($conn, "SELECT id_siswa, nama_lengkap FROM siswa ORDER BY nama_lengkap ASC");

    // Process the update form
    if (isset($_POST['update'])) {
        $kelas_id = $_POST['id_kelas'];
        $siswa_id = $_POST['siswa'];
        $jabatan = $_POST['jabatan'];

        // Update the structure in the database
        $update_query = "UPDATE struktural_kelas SET id_kelas = '$kelas_id', siswa_id = '$siswa_id', jabatan = '$jabatan' WHERE id_struktural = '$id_struktural'";

        if (mysqli_query($conn, $update_query)) {
            echo "<script>alert('Data struktur kelas berhasil diperbarui!')</script>";
            header("Location: struktural_kelas.php");
            exit();
        } else {
            echo "<script>alert('Gagal memperbarui data struktur kelas.');</script>";
            header("Location: struktural_kelas.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Struktur Kelas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Sidebar -->
    <?php include '../../layout/sidebar.php'; ?>

    <!-- Navbar -->
    <header id="header" class="bg-blue-600 text-white py-4">
        <?php include '../../layout/header.php'; ?>
    </header>

    <!-- Main Content -->
    <div class="container mx-auto mt-6 px-4">
        <h2 class="text-3xl font-semibold text-center mb-6">Edit Struktur Kelas</h2>

        <!-- Form Edit Struktur Kelas -->
        <div class="bg-white shadow-lg rounded-lg mb-6 p-6">
            <form action="" method="POST">
                <!-- Dropdown Kelas -->
                <div class="mb-4">
                    <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas :</label>
                    <select id="kelas" name="id_kelas" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">-- Pilih Kelas --</option>
                        <?php
                        while ($row = mysqli_fetch_assoc($kelas_list)) {
                            $selected = ($row['id_kelas'] == $kelas_id) ? 'selected' : '';
                            echo "<option value='" . $row['id_kelas'] . "' $selected>" . $row['nama_kelas'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Dropdown Siswa -->
                <div class="mb-4">
                    <label for="siswa" class="block text-sm font-medium text-gray-700">Siswa :</label>
                    <select id="siswa" name="siswa" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">-- Pilih Siswa --</option>
                        <?php
                        while ($row = mysqli_fetch_assoc($siswa_list)) {
                            $selected = ($row['id_siswa'] == $siswa_id) ? 'selected' : '';
                            echo "<option value='" . $row['id_siswa'] . "' $selected>" . $row['nama_lengkap'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="jabatan" class="block text-sm font-medium text-gray-700">Jabatan</label>
                    <input type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" id="jabatan" name="jabatan" value="<?php echo $jabatan; ?>" required>
                </div>

                <button name="update" class="w-full py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700">Update Struktur</button>
            </form>
        </div>
    </div>

    <?php require_once "../../layout/footer.php" ?>
</body>
</html>
