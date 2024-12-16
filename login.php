<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-2xl max-w-sm w-full transform transition duration-500 hover:scale-105">
        <div class="text-center mb-6">
            <div class="text-green-600 text-4xl mb-2">
                <i class="fas fa-user-circle"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-700">Login</h1>
            <p class="text-gray-500 text-sm">Please login to your account</p>
        </div>
        <form action="index.php" method="POST">
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-600">Username:</label>
                <div class="relative">
                    <input type="text" id="username" name="username" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter your username">
                    <span class="absolute inset-y-0 right-4 flex items-center text-gray-400">
                        <i class="fas fa-user"></i>
                    </span>
                </div>
                <p class="text-xs text-gray-400 mt-1">Username default siswa NISN</p>
            </div>
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-600">Password:</label>
                <div class="relative">
                    <input type="password" id="password" name="password" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter your password">
                    <span class="absolute inset-y-0 right-4 flex items-center text-gray-400">
                        <i class="fas fa-lock"></i>
                    </span>
                </div>
            </div>
            <button type="submit" class="w-full bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-300 focus:ring-opacity-50">Login</button>
        </form>
    </div>
</body>
</html>
