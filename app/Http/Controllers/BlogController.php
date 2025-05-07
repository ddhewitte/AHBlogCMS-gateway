<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //menampilkan data 
    public function index()
    {
        $blog = Blog::latest()->get();
        return view( view: 'blog/blog', data: compact('blog') );
    }

    //refresh data
    public function refresh()
    {
        $blog = Blog::latest()->get();
        return response()->json($blog);
    }

    //add data
    public function add()
    {
        return view( view: 'blog/blog_add' );
    }

    //add data process
    public function addProcess(Request $request)
    {
        $data = $request->validate([
            'blog_title' => 'required',
            'blog_content' => 'required',
            'blog_author' => 'required',
            'blog_images' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('blog_images')) {
            $data['blog_images'] = $request->file('blog_images')->store('blogs', 'public');
        }

        //add status
        $data['status'] = 1;

        Blog::create($data);

        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        return view('blog/blog_edit', ['blogId' => $id]);
    }

    public function editData($id)
    {
        $blog = Blog::findOrFail($id);
        return response()->json($blog);
    }
}