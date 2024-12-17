<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kelas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <div class="max-w-md mx-auto bg-white p-5 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold text-gray-700 mb-5">Tambah Kelas</h2>
            <form action="prosesTambahKelas.php" method="POST">
                <div class="mb-4">
                    <label for="nama_kelas" class="block text-gray-700 font-bold mb-2">Nama Kelas</label>
                    <div class="flex items-center">
                        <i class="fas fa-chalkboard-teacher text-gray-500 mr-2"></i>
                        <input type="text" id="nama_kelas" name="nama_kelas" maxlength="1" pattern="[A-Z]" required
                               class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Tingkat</label>
                    <div class="flex items-center space-x-4">
                        <label class="flex items-center">
                            <input type="radio" name="tingkat" value="7" required class="mr-2">
                            <span class="text-gray-700">7</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="tingkat" value="8" required class="mr-2">
                            <span class="text-gray-700">8</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="tingkat" value="9" required class="mr-2">
                            <span class="text-gray-700">9</span>
                        </label>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 transition duration-300">
                        <i class="fas fa-save mr-2"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>