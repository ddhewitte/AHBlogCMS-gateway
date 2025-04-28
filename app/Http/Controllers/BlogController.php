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
        return view( view: 'blog', data: compact('blog') );
    }

    //refresh data
    public function refresh()
    {
        $blog = Blog::latest()->get();
        return response()->json($blog);
    }
}
