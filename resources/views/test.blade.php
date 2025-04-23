<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test Alpine</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body>
    <h1>Test AlpineJS</h1>
    <div x-data="{ count: 0 }">
        <button x-on:click="count++">Tambah</button>
        <p>x-data count: <span x-text="count"></span></p>
    </div>

    <div class="bg-red-500 text-white p-4">
        Test Style
    </div>


</body>
</html>
