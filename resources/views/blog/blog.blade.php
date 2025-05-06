<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Page</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="container mx-auto px-4 py-6"  x-data="blogData()" x-init="refreshData()">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-700">Data User</h2>
        <div class="flex space-x-2">
            <button class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-500 transition"><a href="{{ url('blog/add') }}">Add New</a></button>
            <button @click="refreshData" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-500 transition">Refresh</button>
        </div>
    </div>

    <div class="overflow-x-auto border rounded-lg shadow-md">
        <table class="min-w-full bg-white border-gray-200 text-sm text-left">
            <thead class="bg-gray-400 text-white">
                <tr>
                    <th class="px-4 py-3">Title</th>
                    <th class="px-4 py-3">Author</th>
                    <th class="px-4 py-3">Date Time</th>
                    <th class="px-4 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="(blog, index) in blogs" :key="blog.id">
                    <tr class="hover:bg-gray-100" :class="index === blogs.length - 1 ? '' : 'border-b'">
                        <td class="px-4 py-2" x-text="blog.blog_title"></td>
                        <td class="px-4 py-2" x-text="blog.blog_author"></td>
                        <td class="px-4 py-2" x-text="new Date(blog.created_at).toLocaleDateString('id-ID', {
    day: '2-digit', month: 'long', year: 'numeric'
})"></td>
                        <td class="px-4 py-2"><button class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-500 transition">Ubah Blog</button> | <button class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-500 transition">Hapus</button></td>
                    </tr>
                </template>

                <template x-if="blogs.length === 0">
                    <div class="p-2">
                        Data Products belum Tersedia.
                    </div>
                </template>
            </tbody>
        </table>
    </div>
</div>
<script>
function blogData() {
    return {
        blogs: [],
        refreshData() {
            fetch('/blog/refresh')
                .then(res => res.json())
                .then(data => {
                    this.blogs = data;
                });
        }
    }
}
</script>
</body>
</html>