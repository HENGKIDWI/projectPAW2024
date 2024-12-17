<!-- sidebar.php -->
<div id="mySidebar" class="fixed top-0 left-0 w-64 h-full bg-gray-800 text-white transform -translate-x-full transition-transform duration-300">
    <button class="absolute top-4 right-4 text-2xl" onclick="closeNav()">&times;</button>
    <nav class="mt-10">
        <?php
        if (isset($_SESSION['role'])) {
            // Jika role adalah admin
            if ($_SESSION['role'] == 'admin') {
                echo '<a href="../../dashboard/admin/index.php" class="block py-2.5 px-4 hover:bg-gray-700"><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</a>';
                echo '<a href="../../dashboard/admin/kelolaDataSiswa.php" class="block py-2.5 px-4 hover:bg-gray-700"><i class="fas fa-users mr-2"></i>Kelola Data Siswa</a>';
                echo '<a href="../../dashboard/admin/tampilanGuru.php" class="block py-2.5 px-4 hover:bg-gray-700"><i class="fas fa-chalkboard-teacher mr-2"></i>Kelola Data Guru</a>';
                echo '<a href="../../dashboard/admin/viewInformasiDetail.php" class="block py-2.5 px-4 hover:bg-gray-700"><i class="fas fa-bullhorn mr-2"></i>Informasi/Pengumuman</a>';
                echo '<a href="../../dashboard/admin/kurikulum.php" class="block py-2.5 px-4 hover:bg-gray-700"><i class="fas fa-book mr-2"></i>Input Kurikulum</a>';
                echo '<a href="../../dashboard/admin/profilesekolah.php" class="block py-2.5 px-4 hover:bg-gray-700"><i class="fas fa-school mr-2"></i>Profil Sekolah</a>';
                echo '<a href="../../dashboard/admin/Struktural_sekolah.php" class="block py-2.5 px-4 hover:bg-gray-700"><i class="fas fa-building mr-2"></i>Input Struktural Sekolah</a>';
                echo '<a href="../../dashboard/admin/kelolaLoginPengguna.php" class="block py-2.5 px-4 hover:bg-gray-700"><i class="fas fa-user-lock mr-2"></i>Kelola Akun Pengguna</a>';
                echo '<a href="../../dashboard/admin/edit-profile.php" class="block py-2.5 px-4 hover:bg-gray-700"><i class="fas fa-user-cog mr-2"></i>Edit Profil Admin</a>';
                echo '<a href="../../dashboard/admin/buat_jadwal.php" class="block py-2.5 px-4 hover:bg-gray-700"><i class="fas fa-calendar-plus mr-2"></i>Buat Jadwal</a>';
                echo '<a href="../../dashboard/admin/aboutus.php" class="block py-2.5 px-4 hover:bg-gray-700"><i class="fas fa-info-circle mr-2"></i>About Us</a>';
                echo '<a href="../../dashboard/admin/admin_laporan.php" class="block py-2.5 px-4 hover:bg-gray-700"><i class="fas fa-info-circle mr-2"></i>laporan kerusakan</a>';
            }
            // Jika role adalah guru
            elseif ($_SESSION['role'] == 'guru') {
                echo '<a href="../../dashboard/guru/index.php" class="block py-2.5 px-4 hover:bg-gray-700"><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</a>';
                echo '<a href="../../dashboard/guru/Jadwal_Mengajar.php" class="block py-2.5 px-4 hover:bg-gray-700"><i class="fas fa-calendar-alt mr-2"></i>Jadwal Mengajar</a>';
                echo '<a href="../../dashboard/guru/input_absen.php" class="block py-2.5 px-4 hover:bg-gray-700"><i class="fas fa-check-circle mr-2"></i>Absensi</a>';
                echo '<a href="../../dashboard/guru/materi_belajar.php" class="block py-2.5 px-4 hover:bg-gray-700"><i class="fas fa-book-open mr-2"></i>Upload Materi Belajar</a>';
                echo '<a href="../../dashboard/guru/riwayat_tugas.php" class="block py-2.5 px-4 hover:bg-gray-700"><i class="fas fa-tasks mr-2"></i>Tugas</a>';
                echo '<a href="../../dashboard/guru/input_nilai.php" class="block py-2.5 px-4 hover:bg-gray-700"><i class="fas fa-pencil-alt mr-2"></i>Input Nilai</a>';
                echo '<a href="../../dashboard/guru/struktural_kelas.php" class="block py-2.5 px-4 hover:bg-gray-700"><i class="fas fa-sitemap mr-2"></i>Struktural Kelas</a>';
                echo '<a href="../../dashboard/guru/DaftarKelasMinat.php" class="block py-2.5 px-4 hover:bg-gray-700"><i class="fas fa-graduation-cap mr-2"></i>Kelas Minat Bakat</a>';
                echo '<a href="../../dashboard/guru/bank_soal.php" class="block py-2.5 px-4 hover:bg-gray-700"><i class="fas fa-file-upload mr-2"></i>Input Bank Soal</a>';
                echo '<a href="../../dashboard/guru/input_rapot.php" class="block py-2.5 px-4 hover:bg-gray-700"><i class="fas fa-file-alt mr-2"></i></i>Input Rapot</a>';
                echo '<a href="../../dashboard/guru/pelanggaran_siswa.php" class="block py-2.5 px-4 hover:bg-gray-700"><i class="fas fa-exclamation-triangle mr-2"></i>Pelanggaran Siswa</a>';
                echo '<a href="../../dashboard/guru/Laporan.php" class="block py-2.5 px-4 hover:bg-gray-700"><i class="fas fa-clipboard-list mr-2"></i>Laporan Kerusakan/Kekurangan Fasilitas</a>';
            }
            // Jika role adalah murid
            elseif ($_SESSION['role'] == 'murid') {
                echo '<a href="../../dashboard/siswa/index.php" class="block py-2.5 px-4 hover:bg-gray-700"><i class="fas fa-tachometer-alt mr-2"></i>Dashbroad</a>';
                echo '<a href="../../dashboard/siswa/cetak_rapot.php" class="block py-2.5 px-4 hover:bg-gray-700"><i class="fas fa-file-alt mr-2"></i>Cetak Rapot</a>';
                echo '<a href="../../dashboard/siswa/forum_diskusi.php" class="block py-2.5 px-4 hover:bg-gray-700"><i class="fas fa-comments mr-2"></i>Forum Diskusi</a>';
                echo '<a href="../../dashboard/siswa/bank_soal.php" class="block py-2.5 px-4 hover:bg-gray-700"><i class="fas fa-folder-open mr-2"></i>Bank Soal</a>';
                echo '<a href="../../dashboard/siswa/informasi.php" class="block py-2.5 px-4 hover:bg-gray-700"><i class="fas fa-bullhorn mr-2"></i>Informasi/Pengumuman</a>';
                echo '<a href="../../dashboard/siswa/transkrip_nilai.php" class="block py-2.5 px-4 hover:bg-gray-700"><i class="fas fa-file-alt mr-2"></i>Transkip Nilai</a>';
                echo '<a href="../../dashboard/siswa/cetak_jadwal.php" class="block py-2.5 px-4 hover:bg-gray-700"><i class="fas fa-calendar-alt mr-2"></i>Cetak Jadwal</a>';
                echo '<a href="../../dashboard/siswa/kelas_minat_bakat.php" class="block py-2.5 px-4 hover:bg-gray-700"><i class="fas fa-graduation-cap mr-2"></i>Kelas Minat dan Bakat</a>';
                echo '<a href="../../dashboard/siswa/evaluasi_guru.php" class="block py-2.5 px-4 hover:bg-gray-700"><i class="fas fa-star mr-2"></i>Evaluasi Guru</a>';
                echo '<a href="../../dashboard/siswa/tugas.php" class="block py-2.5 px-4 hover:bg-gray-700"><i class="fas fa-tasks mr-2"></i>Tugas</a>';
                echo '<a href="../../dashboard/siswa/konseling.php" class="block py-2.5 px-4 hover:bg-gray-700"><i class="fas fa-user-friends mr-2"></i>Konseling</a>';
            }
        } else {
            echo '<a href="#" class="block py-2.5 px-4 hover:bg-gray-700"><i class="fas fa-sign-in-alt mr-2"></i>Login</a>';
        }
        ?>
        <a href="../../loguot.php" onclick="return confirm('Apakah Anda yakin ingin logout?')" class="block py-2.5 px-4 hover:bg-gray-700 text-red-500"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
    </nav>
</div>


<script>
  function openNav() {
    document.getElementById("mySidebar").classList.remove("-translate-x-full");
    document.getElementById("mySidebar").classList.add("translate-x-0");
    document.getElementById("mainContent").classList.add("ml-64");
    document.getElementById("header").classList.add("ml-64");
  }

  function closeNav() {
    document.getElementById("mySidebar").classList.remove("translate-x-0");
    document.getElementById("mySidebar").classList.add("-translate-x-full");
    document.getElementById("mainContent").classList.remove("ml-64");
    document.getElementById("header").classList.remove("ml-64");
  }
</script>
