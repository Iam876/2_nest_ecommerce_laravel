<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Blog\BlogCategory;
use App\Models\User;

class BlogPost extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function BlogCategory()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->select('short_desc', 'username', 'photo', 'join_date');
    }
}
