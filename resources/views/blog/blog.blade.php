<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Blog Page</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="container mx-auto px-4 py-6"  x-data="blogData()" x-init="refreshData()">
    <div 
        x-show="showConfirm" 
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" 
        style="display: none;">
        <div class="bg-white p-6 rounded shadow-md">
            <h2 class="text-lg font-semibold mb-4">Yakin ingin menghapus data ini?</h2>
            <div class="flex justify-end space-x-2">
                <button @click="showConfirm = false" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">Batal</button>
                <button @click="deleteItem" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Ya, Hapus</button>
            </div>
        </div>
    </div>

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
                    <th class="px-4 py-3">Date</th>
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
                        <td class="px-4 py-2"><button class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-500 transition"><a :href="'/blog/edit/' + blog.id">Ubah Blog</a></button> | <button class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-500 transition" @click="confirmDelete(blog.id)" >Hapus</button></td>
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
        //define json var, default etc
        blogs: [],
        confirmDeleteId: null,
        showConfirm: false,

        //function to refreshData
        refreshData() {
            fetch('/blog/refresh')
                .then(res => res.json())
                .then(data => {
                    this.blogs = data;
                });
        },

        //function popup delete
        confirmDelete(id) {
            this.confirmDeleteId = id;
            this.showConfirm = true;
        },

        //function delete data
        async deleteItem() {
            try {
                const response = await fetch(`/blog/deleteData/${this.confirmDeleteId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                if (!response.ok) throw new Error('Gagal menghapus');

                // Refresh data tanpa reload halaman
                this.refreshData();
                //redirect
                window.location.href = '/';

            } catch (error) {
                alert('Gagal menghapus data.');
                console.error(error);
            } finally {
                this.showConfirm = false;
            }
        },
    }
}
</script>
</body>
</html>