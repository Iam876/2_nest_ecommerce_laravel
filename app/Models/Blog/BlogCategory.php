<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Blog\BlogPost;


class BlogCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function posts()
    {
        return $this->hasMany(BlogPost::class, 'blog_category_id');
    }
}
