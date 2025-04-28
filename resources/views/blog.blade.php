<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Page</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-700">Data User</h2>
        <a href="#" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            + Add User
        </a>
    </div>

    <div class="overflow-x-auto rounded-lg shadow-md">
        <table class="min-w-full bg-white border border-gray-200 text-sm text-left">
            <thead class="bg-gray-500 text-white">
                <tr>
                    <th class="px-4 py-3 border-b">Title</th>
                    <th class="px-4 py-3 border-b">Author</th>
                    <th class="px-4 py-3 border-b">Date Time</th>
                    <th class="px-4 py-3 border-b">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($blog as $blogData)
                <tr class="hover:bg-gray-100 border-b">
                    <td class="px-4 py-2">{{ $blogData->blog_title }}</td>
                    <td class="px-4 py-2">{{ $blogData->blog_author }}</td>
                    <td class="px-4 py-2">{{ $blogData->created_at }}</td>
                    <td class="px-4 py-2"><button>Ubah Blog</button>| <button>Hapus</button></td>
                </tr>
                @empty
                <div class="alert alert-danger">
                    Data Products belum Tersedia.
                </div>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</body>
</html>