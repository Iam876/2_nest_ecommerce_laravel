<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\Paginator;
use App\Models\Blog\BlogPost;
use App\Models\Blog\BlogCategory;
use App\Models\User;

class BlogDetailsListController extends Controller
{
    public function BlogPageShow()
    {
        $blog_post = BlogPost::with('BlogCategory')->latest()->paginate(10);
        $blog_category = BlogCategory::withCount('posts')->latest()->limit(10)->get();
        // $date = Carbon::parse($blog_post->created_at)->format('F j, Y');
        return view('frontend.blogList', compact('blog_post', 'blog_category'));
    }

    public function DetailsBlogPage($id, $slug)
    {
        $blog_post = BlogPost::with('BlogCategory')->findOrFail($id);
        $user = User::where('id', $blog_post->user_id)->first();

        $blog_category = BlogCategory::withCount('posts')->latest()->limit(10)->get();
        $blog_post->update(['view_counts' => $blog_post->view_counts ? $blog_post->view_counts + 1 : 1]);

        $blog_tags = explode(',', $blog_post->tags);
        $postCount = BlogPost::where('user_id', $blog_post->user_id)->count();

        $timeAgo = Carbon::parse($blog_post->created_at)->diffForHumans();
        $date = Carbon::parse($blog_post->created_at)->format('F j, Y');

        $wordCount = str_word_count(strip_tags($blog_post->post_description . $blog_post->post_title));
        $readTime = intval(ceil($wordCount / 200)); //200 is Average reading speed in words per minute

        return view('frontend.singleBlogPage', compact('timeAgo', 'blog_post', 'readTime', 'date', 'blog_category', 'blog_tags', 'postCount', 'user'));
    }
}
