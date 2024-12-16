<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>

<nav class="bg-white shadow-md">
  <div class="container mx-auto px-4 py-2 flex justify-between items-center">
    <!-- Logo dan Nama Sekolah -->
    <div class="flex items-center space-x-4">
      <button id="sidebarToggle" class="text-3xl bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600" onclick="toggleNav()">&#9776;</button>
      <a class="flex items-center space-x-2" href="#">
        <img src="https://i.pinimg.com/originals/e2/57/46/e257468b494f341546a8a30c47b023d6.png" alt="Logo" class="w-8 h-8">
        <span class="font-semibold text-lg text-gray-700">SMP Negeri 1 Tambelangan</span>
      </a>
    </div>
    <!-- profile  -->
    <div class="relative">
      <a href="profile.php" class="flex items-center space-x-2 bg-blue-500 text-white px-4 py-2 rounded-full focus:outline-none hover:bg-blue-600" id="navbarDropdown">
        <i class="fas fa-user-circle"></i>
        <span><?php echo $_SESSION['nama_lengkap']; ?></span>
      </a>
    </div>
  </div>
</nav>

<script>
  document.getElementById('navbarDropdown').addEventListener('click', function() {
    document.getElementById('dropdownMenu').classList.toggle('hidden');
  });

  function toggleNav() {
    const sidebar = document.getElementById("mySidebar");
    if (sidebar.classList.contains("-translate-x-full")) {
      openNav();
    } else {
      closeNav();
    }
  }
</script>
