<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Category\Category;
use App\Models\Subcategory\Subcategory;
use App\Models\Brand\Brand;
use App\Models\Multiimage\MultiImage;
use App\Models\Product\Product;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{

    public function AllProduct(){
        return view('backend.product.allproduct');
    }

    //product manage
    public function ShowProduct(){
        $products = Product::latest()->get();
        // return view('backend.product.allproduct',compact('products'));
        return response()->json([
            'status' => 200,
            'AllProducts' => $products
        ]);
    }
    // Add Product
    public function AddProduct(){;
        $activeVendor = User::where('status','active')->where('role','vendor')->latest()->get();
        $brand = Brand::latest()->get();
        $category = Category::latest()->get();
        return view('backend.product.addproduct',compact('activeVendor','brand','category'));
    }

    // Show subcategory
    public function ShowSubCategory($cat_id){
        $subcat = Subcategory::where('category_id',$cat_id)->orderBy('subcategory_name','ASC')->get();
        return response()->json([
            'status' => 200,
            'AllData'=> $subcat
        ]);
    }

    // Product save and upload
    public function StoreProduct(Request $request){

        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(800,800)->save('upload/products/thumbnail/'.$name_gen);
        $save_url = 'upload/products/thumbnail/'.$name_gen;
																		
        $product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(" ","-",$request->product_name)),

            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_size' => $request->product_size,
            'product_tags' => $request->product_tags,
            'product_color' => $request->product_color,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'product_thumbnail' => $save_url,
            'vendor_id' => $request->vendor_id,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        // Multi Image Upload
        $images = $request->file('multi_img');
        foreach($images as $img){
        $name_gen_multi = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
        Image::make($img)->resize(800,800)->save('upload/products/multiImage/'.$name_gen_multi);
        $uploadPath = 'upload/products/multiImage/'.$name_gen_multi;

        MultiImage::insert([
            'product_id' => $product_id,
            'photo_name' => $uploadPath,
            'created_at' => Carbon::now(),
        ]);
        }

        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all_product')->with($notification);


    }
    
    public function DeleteProduct($id){
        $deleteProduct = Product::findOrFail($id);
        $thumbnail = public_path($deleteProduct->product_thumbnail);
        if(file_exists($thumbnail)){
            @unlink($thumbnail);
        }
        $deleteProduct -> delete();
       
        $imges = MultiImage::where('product_id', $id)->get();
        foreach($imges as $img){
            @unlink($img->photo_name);
            $img->delete();
        }

        return response()->json([
            'success'=>'Successfull',
        ]);
    }
    
    // Active to inactive
    public function ActiveProduct($id){
        Product::findOrFail($id)->update([
            'status' => 0,
        ]);
        return response()->json([
            'success' => 'Successfully Inactive'
        ]);
    }
    // Inactive to Active
    public function InactiveProduct($id){
        Product::findOrFail($id)->update([
            'status' => 1,
        ]);
        return response()->json([
            'success' => 'Successfully Active'
        ]);
    }


    // Edit Product Page
    public function EditProduct($id){
        $activeVendor = User::where('status','active')->where('role','vendor')->latest()->get();
        $multiImage = MultiImage::where('product_id',$id)->get();
        $brand = Brand::latest()->get();
        $category = Category::latest()->get();
        $subCategory = Subcategory::latest()->get();
        $products = Product::findOrFail($id);
        return view('backend.product.editproduct',compact('activeVendor','multiImage','brand','category','subCategory','products'));
    }

    public function UpdateProduct(Request $request,$id){
        Product::findOrFail($id)->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(" ","-",$request->product_name)),

            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_size' => $request->product_size,
            'product_tags' => $request->product_tags,
            'product_color' => $request->product_color,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'vendor_id' => $request->vendor_id,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'status' => 1,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => "Product Updated Successfull",
            'alert-type' => "success"
        );
        return redirect()->route('all_product')->with($notification);
    }

    public function UpdateMainThumbnail(Request $request,$id){
        $products = Product::findOrFail($id);

        $save_url = $products->product_thumbnail;
        if($request->hasFile('product_thumbnail')){
            $Thumb = $request->file('product_thumbnail');

            if ($products->product_thumbnail) {
                $old_thumb = public_path($products->product_thumbnail);
                if (file_exists($old_thumb)) {
                    unlink($old_thumb);
                }
            }

            $name_gen = hexdec(uniqid()).'.'.$Thumb->getClientOriginalExtension();
            Image::make($Thumb)->resize(800,800)->save('upload/products/thumbnail/'.$name_gen);
            $save_url = 'upload/products/thumbnail/'.$name_gen;
        }
        
        $products->update([
            'product_thumbnail' => $save_url
        ]);

        $notification = array(
            'message' => 'Image Successfully Updated',
            'alert-type' => 'success'
        );

        return redirect()->route('all_product')->with($notification);

    }

    // Delete Multi Image Single single
    public function DeleteMultiImages($id){
        $multiImage = MultiImage::findOrFail($id);


        if ($multiImage->photo_name) {
            $old_thumb = public_path($multiImage->photo_name);
            if (file_exists($old_thumb)) {
                unlink($old_thumb);
            }
        }

        $multiImage->delete();
        $notification = array(
            'message' => 'Image Successfully Deleted',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    public function UpdateMultiImages(Request $request){
        $imgs = $request->multi_img;

        foreach($imgs as $id => $img ){
            $imgDel = MultiImage::findOrFail($id);
            unlink($imgDel->photo_name);

        $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
        Image::make($img)->resize(800,800)->save('upload/products/multiImage/'.$make_name);
        $uploadPath = 'upload/products/multiImage/'.$make_name;

        MultiImage::where('id',$id)->update([
            'photo_name' => $uploadPath,
            'updated_at' => Carbon::now(),

        ]); 
        }

         $notification = array(
            'message' => 'Image Successfully Updated',
            'alert-type' => 'success'
        );
        return redirect()->route('all_product')->with($notification);

    }
}