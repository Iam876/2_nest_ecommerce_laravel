<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner\Banner;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{
    //
    public function AllBanner(){
        return view('backend.banner.all-banner');
    }


    public function AddBanner(Request $request){
        $request->validate([
            'bImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if (!$request->hasFile('bImage')) {
            return response()->json([
                'error' => "No brand image provided"
            ]);
        }

        if($request->hasFile('bImage')){
        $image = $request->file('bImage');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(768,450)->save('upload/banner/'.$name_gen);
        $save_url = 'upload/banner/'.$name_gen;
        }
        
            Banner::insert([
            'banner_title' => $request->bTitle,
            'banner_url' => $request->bUrl,
            'banner_image' => $save_url,
            'banner_status' => $request->bStatus,
        ]);

        return response()->json([
            'success'=>'Banner Added Successfully'
        ]);
    }

    public function ShowBanner(){
        $banner = Banner::latest()->get();
        return response()->json([
            'status'  => 200,
            'AllData' => $banner
        ]);
    }

    public function ActiveBanner($id){
        Banner::findOrFail($id)->update([
            'banner_status'=> 'inactive'
        ]);

        return response()->json([
            'success' => 'Successfull'
        ]);
    }
    public function InactiveBanner($id){
        Banner::findOrFail($id)->update([
            'banner_status'=> 'active'
        ]);

        return response()->json([
            'success' => 'Successfull'
        ]);
    }


    public function DeleteBanner($id){
        $banner = Banner::findOrFail($id);
        $image = public_path($banner->banner_image);
        if(file_exists($image)){
            @unlink($image);
        }
        $banner->delete();
        return response()->json([
            'success'=>'Successfull',
        ]);
    }
    
    public function EditBanner($id){
        $banner = Banner::findOrFail($id);
        return response()->json([
            'success'=>$banner,
        ]);
    }

    public function UpdateBanner(Request $request,$id){
        $banner = Banner::findOrFail($id);
        $request->validate([
            'updateImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $save_url = $banner->banner_image; // Default to the existing image path
        if($request->hasFile('updateImage') && $request->file('updateImage')->isValid()){
            // Process the uploaded image
            $Oldimage = public_path($banner->banner_image);
            if(file_exists($Oldimage)){
                @unlink($Oldimage);
            }
            $image = $request->file('updateImage');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(768,450)->save('upload/banner/'.$name_gen);
            $save_url = 'upload/banner/'.$name_gen;
        }
    
        $banner->update([
            'banner_title' => $request->updateTitle,
            'banner_url' => $request->updateUrl,
            'banner_image' => $save_url,
            'banner_status' => $request->updateStatus,
        ]);
    
        return response()->json([
            "success"=>"Successfull"
        ]);
    }












}


