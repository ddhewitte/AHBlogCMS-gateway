<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Add | Blog Page</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="container mx-auto px-4 py-6" x-data="blogDataInput()">

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-700">Add Data User</h2>
        <div class="flex space-x-2">
            <button class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-500 transition"><a href="{{ url('/') }}">Back</a></button>
        </div>
    </div>
   
    <div class="overflow-x-auto rounded-lg border shadow-md">
        <table class="min-w-full bg-white border border-gray-200 text-sm text-left">
            <tbody>
                <tr>
                    <td class="p-4">Blog Title</td>
                    <td class="p-4">:</td>
                    <td class="p-4"><input x-model="form.blog_title" type="text" name="blog_title" class="block border  min-w-0 w-100 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"></td>
                </tr>
                <tr>
                    <td class="p-4">Blog Content</td>
                    <td class="p-4">:</td>
                    <td class="p-4"><textarea x-model="form.blog_content" name="blog_content" class="block border  min-w-0 w-100 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"></textarea></td>
                </tr>
                <tr>
                    <td class="p-4">Blog Author</td>
                    <td class="p-4">:</td>
                    <td class="p-4"><input type="text" x-model="form.blog_author" name="blog_author" class="block border  min-w-0 w-100 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"></td>
                </tr>
                <tr>
                    <td class="p-4">Blog Images</td>
                    <td class="p-4">:</td>
                    <td class="p-4"><input @change="handleFileUpload" type="file" name="blog_images" class="block border  min-w-0 w-100 row py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"></td>
                </tr>
                <tr>
                    <td class="p-4"></td>
                    <td class="p-4"></td>
                    <td class="p-4"><button @click="submitForm" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Submit</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</body>
<script>
    function blogDataInput(){
        return {
            form: {
                blog_title: '',
                blog_content: '',
                blog_author: '',
                blog_images: null,
            },
            handleFileUpload(event) {
                this.form.blog_images = event.target.files[0];
            },
            async submitForm(){
                const formData = new FormData();

                formData.append('blog_title', this.form.blog_title);
                formData.append('blog_content', this.form.blog_content);
                formData.append('blog_author', this.form.blog_author);
                if (this.form.blog_images) {
                    formData.append('blog_images', this.form.blog_images);
                }

                try {
                    const response = await fetch('/blog/add/process', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: formData
                    });

                    const result = await response.json();
                    alert('Data berhasil ditambahkan');
                    // Reset form
                    this.form.blog_title = '';
                    this.form.blog_content = '';
                    this.form.blog_author = '';
                    this.form.blog_images = null;
                } catch (error) {
                    alert('Gagal menambahkan data, isi semua !');
                    console.error(error);
                }
            }
        }
        
    }
</script>
</html>