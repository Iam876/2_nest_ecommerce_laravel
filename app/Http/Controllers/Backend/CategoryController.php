<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category\Category;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    //Category
    public function AllCategory(){
        $category = Category::latest()->get();
        return view('backend.category.allcategory',compact('category'));
    }

    // Add Category Data
    public function AddCategory(Request $request){
        $request->validate([
            'CatImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'CatLogoImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        

        // Upload Category Image
        if($request->hasFile('CatImage')){
            $catImage = $request->file('CatImage');
            $name_gen = hexdec(uniqid()).'.'.$catImage->getClientOriginalExtension();
            Image::make($catImage)->resize(300,300)->save('upload/category/category_image/'.$name_gen);
            $save_url = 'upload/category/category_image/'.$name_gen;
        }

        // Upload Category Logo Image
        if($request->hasFile('CatLogoImage')){
            $CatLogoImage = $request->file('CatLogoImage');
            $name_gen_logo = hexdec(uniqid()).'.'.$CatLogoImage->getClientOriginalExtension();
            Image::make($CatLogoImage)->resize(300,300)->save('upload/category/category_image_logo/'.$name_gen_logo);
            $save_url_logo = 'upload/category/category_image_logo/'.$name_gen_logo;
        }

        // Error Catching
        if (!$request->hasFile('CatImage')) {
            return response()->json([
                'error' => 'The Category Image not found'
            ]);
        }
        if (!$request->hasFile('CatLogoImage')) {
            return response()->json([
                'error' => 'The Category Logo Image not found'
            ]);
        }  

        Category::insert([
            'category_name'=>$request->CatName,
            'category_slug'=>strtolower(str_replace(" ","-",$request->CatName)),
            'category_image'=>$save_url,
            'category_image_logo'=>$save_url_logo,
            'status'=>$request->CatStatus
        ]);

        return response()->json([
            'success' => 'Category Added Successfully',
        ]);
    }

    // Show Category Data
    public function ShowCategory() {
        $category = Category::all();
        return response()->json([
            'status'=>200,
            'AllData'=>$category
        ]);
    }
    // Inactive Category
    public function ActiveCategory($id){
        $category = Category::findorFail($id);

        $category->update([
            'status'=>'inactive'
        ]);
        return response()->json([
            'success'=> $category->status
        ]);
    }
    // Active Category
    public function InactiveCategory($id){
        $category = Category::findorFail($id);

        $category->update([
            'status'=>'active'
        ]);
        return response()->json([
            'success'=> $category->status
        ]);
    }
    // Delete Category
    public function DeleteCategory($id){
        $category = Category::findorFail($id);
        $catImage = public_path($category->category_image);
        $catImageLogo = public_path($category->category_image_logo);
        if(file_exists($catImage)){
            @unlink($catImage);
        }
        if(file_exists($catImageLogo)){
            @unlink($catImageLogo);
        }
        $category->delete();
        return response()->json([
            'success'=>'Delete Successfull',
        ]);
    }

    // Edit Category
    public function EditCategory($id){
        $category = Category::findorFail($id);
        return response()->json([
            'success'=>$category
        ]);
    }
    // Update Category
    public function UpdateCategory(Request $request,$id){

        // $request->validate([
        //     'CatImage' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        //     'CatLogoImage' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
        
        $category = Category::findOrFail($id);

        $save_url = $category->category_image;
        $save_url_logo = $category->category_image_logo;
        if($request->hasFile('CatImage')){
            $imageCat = $request->file('CatImage');

            if ($category->category_image) {
                $old_image_cat = public_path($category->category_image);
                if (file_exists($old_image_cat)) {
                    unlink($old_image_cat);
                }
            }

            $name_gen = hexdec(uniqid()).'.'.$imageCat->getClientOriginalExtension();
            Image::make($imageCat)->resize(300,300)->save('upload/category/category_image/'.$name_gen);
            $save_url = 'upload/category/category_image/'.$name_gen;
        }

        if($request->hasFile('CatLogoImage')){
            $imageCatLogo = $request->file('CatLogoImage');

            if ($category->category_image) {
                $old_image_cat_logo = public_path($category->category_image_logo);
                if (file_exists($old_image_cat_logo)) {
                    unlink($old_image_cat_logo);
                }
            }
            $name_gen_logo = hexdec(uniqid()).'.'.$imageCatLogo->getClientOriginalExtension();
            Image::make($imageCatLogo)->resize(300,300)->save('upload/category/category_image_logo/'.$name_gen_logo);
            $save_url_logo = 'upload/category/category_image_logo/'.$name_gen_logo;
           
        }

        $category->update([
            'category_name'=>$request->CatName,
            'category_slug'=>strtolower(str_replace(" ","-",$request->CatName)),
            'category_image'=>$save_url,
            'category_image_logo'=>$save_url_logo,
            'status'=>$request->CatStatus
        ]);

        return response()->json([
            'success'=>"successfully updated"
        ]);
    }
}
