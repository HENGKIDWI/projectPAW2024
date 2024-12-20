<?php
include "../../koneksi.php";
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
    <title>Kelola Pengguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    <div class="min-h-screen flex flex-col">
        <?php include '../../layout/sidebar.php'; ?>
        <header id="header" class="bg-blue-600 text-white py-4">
            <?php include '../../layout/header.php'; ?>
        </header>

        <main class="flex-1 container mx-auto px-6 mt-8">
            <h1 class="text-3xl font-bold mb-6">Kelola Pengguna</h1>

            <!-- Tabs for Admin, Guru, Siswa -->
            <div class="mb-4">
                <ul class="flex space-x-4 border-b">
                    <li><a href="#admin" class="py-2 px-4 bg-blue-600 text-white rounded-t">Admin</a></li>
                    <li><a href="#guru" class="py-2 px-4 bg-gray-100">Guru</a></li>
                    <li><a href="#siswa" class="py-2 px-4 bg-gray-100">Siswa</a></li>
                </ul>
            </div>

            <!-- Admin Section -->
            <section id="admin" class="mb-12">
                <h2 class="text-2xl font-bold mb-4">Data Admin</h2>
                <div class="flex justify-between mb-4">
                    <form method="GET">
                        <input type="text" name="search_admin" placeholder="Cari Admin" class="border p-2 rounded">
                        <button class="bg-blue-600 text-white py-2 px-4 rounded">Cari</button>
                    </form>
                    <a href="tambah_admin.php" class="bg-green-600 text-white py-2 px-4 rounded">Tambah Admin</a>
                </div>
                <table class="min-w-full bg-white border">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border">ID</th>
                            <th class="py-2 px-4 border">Nama Lengkap</th>
                            <th class="py-2 px-4 border">Username</th>
                            <th class="py-2 px-4 border">Email</th>
                            <th class="py-2 px-4 border">No. Telp</th>
                            <th class="py-2 px-4 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM admin";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <td class='py-2 px-4 border'>{$row['id_admin']}</td>
                                    <td class='py-2 px-4 border'>{$row['nama_lengkap']}</td>
                                    <td class='py-2 px-4 border'>{$row['username']}</td>
                                    <td class='py-2 px-4 border'>{$row['email']}</td>
                                    <td class='py-2 px-4 border'>{$row['no_telp']}</td>
                                    <td class='py-2 px-4 border'>
                                        <a href='edit_admin.php?id={$row['id_admin']}' class='text-blue-600'>Edit</a> |
                                        <a href='hapus_admin.php?id={$row['id_admin']}' class='text-red-600'>Hapus</a>
                                    </td>
                                </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </section>

            <!-- Guru Section -->
            <section id="guru" class="mb-12">
                <h2 class="text-2xl font-bold mb-4">Data Guru</h2>
                <div class="flex justify-between mb-4">
                    <form method="GET">
                        <input type="text" name="search_guru" placeholder="Cari Guru" class="border p-2 rounded">
                        <button class="bg-blue-600 text-white py-2 px-4 rounded">Cari</button>
                    </form>
                    <a href="tambah_guru.php" class="bg-green-600 text-white py-2 px-4 rounded">Tambah Guru</a>
                </div>
                <table class="min-w-full bg-white border">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border">ID</th>
                            <th class="py-2 px-4 border">NIP</th>
                            <th class="py-2 px-4 border">Nama Lengkap</th>
                            <th class="py-2 px-4 border">Email</th>
                            <th class="py-2 px-4 border">No. Telp</th>
                            <th class="py-2 px-4 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM guru";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <td class='py-2 px-4 border'>{$row['id_guru']}</td>
                                    <td class='py-2 px-4 border'>{$row['nip']}</td>
                                    <td class='py-2 px-4 border'>{$row['nama_lengkap']}</td>
                                    <td class='py-2 px-4 border'>{$row['email']}</td>
                                    <td class='py-2 px-4 border'>{$row['no_telp']}</td>
                                    <td class='py-2 px-4 border'>
                                        <a href='edit_guru.php?id={$row['id_guru']}' class='text-blue-600'>Edit</a> |
                                        <a href='hapus_guru.php?id={$row['id_guru']}' class='text-red-600'>Hapus</a>
                                    </td>
                                </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </section>

            <!-- Siswa Section -->
            <section id="siswa">
                <h2 class="text-2xl font-bold mb-4">Data Siswa</h2>
                <div class="flex justify-between mb-4">
                    <form method="GET">
                        <input type="text" name="search_siswa" placeholder="Cari Siswa" class="border p-2 rounded">
                        <button class="bg-blue-600 text-white py-2 px-4 rounded">Cari</button>
                    </form>
                    <a href="tambah_siswa.php" class="bg-green-600 text-white py-2 px-4 rounded">Tambah Siswa</a>
                </div>
                <table class="min-w-full bg-white border">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border">ID</th>
                            <th class="py-2 px-4 border">NIS</th>
                            <th class="py-2 px-4 border">Nama Lengkap</th>
                            <th class="py-2 px-4 border">Kelas</th>
                            <th class="py-2 px-4 border">No. Telp</th>
                            <th class="py-2 px-4 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT s.id_siswa, s.nis, s.nama_lengkap, s.no_telp, k.nama_kelas 
                                  FROM siswa s 
                                  LEFT JOIN kelas k ON s.kelas_id = k.id_kelas";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <td class='py-2 px-4 border'>{$row['id_siswa']}</td>
                                    <td class='py-2 px-4 border'>{$row['nis']}</td>
                                    <td class='py-2 px-4 border'>{$row['nama_lengkap']}</td>
                                    <td class='py-2 px-4 border'>{$row['nama_kelas']}</td>
                                    <td class='py-2 px-4 border'>{$row['no_telp']}</td>
                                    <td class='py-2 px-4 border'>
                                        <a href='edit_siswa.php?id={$row['id_siswa']}' class='text-blue-600'>Edit</a> |
                                        <a href='hapus_siswa.php?id={$row['id_siswa']}' class='text-red-600'>Hapus</a>
                                    </td>
                                </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
 <?php include '../../layout/footer.php'; ?>

</body>
</html>
