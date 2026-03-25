<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - STU</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen p-8">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-purple-600">
                    Dashboard Admin
                </h1>
                <p class="text-gray-600 mt-2">Selamat datang, <strong>{{ auth()->user()->name }}</strong> ({{ auth()->user()->role }})</p>
            </div>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                    Log Keluar
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
            <div class="p-6 bg-blue-50 text-blue-800 rounded-lg border border-blue-100 text-center shadow-sm">
                <p class="text-4xl font-bold mb-2">0</p>
                <p class="text-sm font-medium uppercase tracking-wider">Mesej Baru</p>
            </div>
            <div class="p-6 bg-green-50 text-green-800 rounded-lg border border-green-100 text-center shadow-sm">
                <p class="text-4xl font-bold mb-2">0</p>
                <p class="text-sm font-medium uppercase tracking-wider">Permohonan Baru</p>
            </div>
            <div class="p-6 bg-purple-50 text-purple-800 rounded-lg border border-purple-100 text-center shadow-sm">
                <p class="text-4xl font-bold mb-2">0</p>
                <p class="text-sm font-medium uppercase tracking-wider">Borang Baru</p>
            </div>
        </div>
    </div>
</body>
</html>
