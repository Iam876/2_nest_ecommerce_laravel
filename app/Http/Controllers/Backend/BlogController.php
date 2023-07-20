<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Blog\BlogCategory;
use App\Models\Blog\BlogPost;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    // Blog Category Start
    public function BlogCategory()
    {
        return view('backend.blog.blog_category');
    }
    public function AddBlogCategory(Request $request)
    {
        $request->validate([
            'CatLogoImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        // Upload Category Logo Image
        if ($request->hasFile('CatLogoImage')) {
            $CatLogoImage = $request->file('CatLogoImage');
            $name_gen_logo = hexdec(uniqid()) . '.' . $CatLogoImage->getClientOriginalExtension();
            Image::make($CatLogoImage)->resize(300, 300)->save('upload/blog/blog_category/' . $name_gen_logo);
            $save_url_logo = 'upload/blog/blog_category/' . $name_gen_logo;
        }

        // Error Catching
        if (!$request->hasFile('CatLogoImage')) {
            return response()->json([
                'error' => 'The Category Logo Image not found'
            ]);
        }

        BlogCategory::insert([
            'blog_category_name' => $request->CatName,
            'blog_category_slug' => strtolower(str_replace(" ", "-", $request->CatName)),
            'blog_category_image' => $save_url_logo,
            'status' => $request->CatStatus,
            'created_at' => Carbon::now()
        ]);

        return response()->json([
            'success' => 'Category Added Successfully',
        ]);
    }
    public function ShowBlogCategory()
    {
        $category = BlogCategory::all();
        return response()->json([
            'status' => 200,
            'AllData' => $category
        ]);
    }

    public function InactiveBlogCategory($id)
    {
        $inactive = BlogCategory::findOrFail($id);
        $inactive->update([
            'status' => 'inactive'
        ]);
        return response()->json([
            'message' => 'Successfully inactive category'
        ]);
    }
    public function ActiveBlogCategory($id)
    {
        $active = BlogCategory::findOrFail($id);
        $active->update([
            'status' => 'active'
        ]);
        return response()->json([
            'message' => 'Successfully active category'
        ]);
    }

    public function DeleteBlogCategory($id)
    {
        $category = BlogCategory::findorFail($id);
        $catImageLogo = public_path($category->blog_category_image);

        if (file_exists($catImageLogo)) {
            @unlink($catImageLogo);
        }
        $category->delete();
        return response()->json([
            'success' => 'Delete Successfull',
        ]);
    }

    public function EditBlogCategory($id)
    {
        $category = BlogCategory::findorFail($id);
        return response()->json([
            'success' => 200,
            'Alldata' => $category
        ]);
    }

    public function UpdateBlogCategory(Request $request, $id)
    {

        $request->validate([
            'CatLogoImage' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $category = BlogCategory::findOrFail($id);

        $save_url_logo = $category->blog_category_image;

        if ($request->hasFile('CatLogoImage')) {
            $imageCatLogo = $request->file('CatLogoImage');

            if ($category->blog_category_image) {
                $old_image_cat_logo = public_path($category->blog_category_image);
                if (file_exists($old_image_cat_logo)) {
                    unlink($old_image_cat_logo);
                }
            }
            $name_gen_logo = hexdec(uniqid()) . '.' . $imageCatLogo->getClientOriginalExtension();
            Image::make($imageCatLogo)->resize(100, 100)->save('upload/blog/blog_category/' . $name_gen_logo);
            $save_url_logo = 'upload/blog/blog_category/' . $name_gen_logo;
        }

        $category->update([
            'blog_category_name' => $request->CatName,
            'blog_category_slug' => strtolower(str_replace(" ", "-", $request->CatName)),
            'blog_category_image' => $save_url_logo,
            'status' => $request->CatStatus
        ]);

        return response()->json([
            'success' => "successfully updated"
        ]);
    }

    // Blog Category End


    // Blog Post Start
    public function BlogPosts()
    {
        $posts = BlogPost::with('BlogCategory')->latest()->get();
        return view('backend.blog.all_blog_post', compact('posts'));
    }

    public function AddBlogPosts()
    {
        $category = BlogCategory::all();
        return view('backend.blog.add_blog_post', compact('category'));
    }

    public function StoreBlogPosts(Request $request)
    {
        $image = $request->file('blog_thumbnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(800, 800)->save('upload/blog/blog_post/' . $name_gen);
        $save_url = 'upload/blog/blog_post/' . $name_gen;

        $id = Auth::user()->id;

        BlogPost::insert([
            'user_id' => $id,
            'post_title' => $request->blog_title,
            'post_title_slug' => strtolower(str_replace(" ", "-", $request->blog_title)),
            'post_image' => $save_url,
            'post_description' => $request->long_descp,
            'tags' => $request->blog_tags,
            'blog_category_id' => $request->category,
            'status' => 'active',
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('blog.post')->with($notification);
    }


    public function ActiveBlogPosts($id)
    {
        BlogPost::findOrFail($id)->update(['status' => 'inactive']);
        $notification = array(
            'message' => 'Post Inactive Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    public function InactiveBlogPosts($id)
    {
        BlogPost::findOrFail($id)->update(['status' => 'active']);
        $notification = array(
            'message' => 'Post Active Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function DeleteBlogPosts($id)
    {

        $post = BlogPost::findorFail($id);
        $post_thumbnail = public_path($post->post_image);

        if (file_exists($post_thumbnail)) {
            @unlink($post_thumbnail);
        }
        $post->delete();

        $notification = array(
            'message' => 'Post Delete Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function EditeBlogPosts($id)
    {
        $post = BlogPost::with('BlogCategory')->findOrFail($id);
        $category = BlogCategory::all();
        return view('backend.blog.update_blog_post', compact('post', 'category'));
    }
    public function UpdateStoreBlogPosts(Request $request, $id)
    {
        $post = BlogPost::findOrFail($id);

        $post_thumbnail = public_path($post->post_image);
        if (file_exists($post_thumbnail)) {
            @unlink($post_thumbnail);
        }
        if ($request->hasFile('blog_thumbnail')) {
            $image = $request->file('blog_thumbnail');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(800, 800)->save('upload/blog/blog_post/' . $name_gen);
            $save_url = 'upload/blog/blog_post/' . $name_gen;
        } else {
            $save_url = $post->post_image; // Replace with the actual fixed image link
        }
        $post->update([
            'post_title' => $request->blog_title,
            'post_title_slug' => strtolower(str_replace(" ", "-", $request->blog_title)),
            'post_image' => $save_url,
            'post_description' => $request->long_descp,
            'tags' => $request->blog_tags,
            'blog_category_id' => $request->category,
            'status' => 'active',
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Post Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('blog.post')->with($notification);
    }
    // Blog Post end
}
