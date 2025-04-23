<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //fillable
    protected $fillable = ['blog_title', 'blog_content', 'blog_images', 'blog_author', 'blog_status'];
}
