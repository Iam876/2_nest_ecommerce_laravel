<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider\Slider;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    //Slider View
    public function AllSlider(){
        return view('backend.slider.all-slider');
    }
    public function AddSlider(Request $request){
        $request->validate([
            'sImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if (!$request->hasFile('sImage')) {
            return response()->json([
                'error' => "No brand image provided"
            ]);
        }

        if($request->hasFile('sImage')){
        $image = $request->file('sImage');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(2376,807)->save('upload/slider/'.$name_gen);
        $save_url = 'upload/slider/'.$name_gen;
        }
        
            Slider::insert([
            'slider_title' => $request->sTitle,
            'slider_short' => $request->sShort,
            'slider_image' => $save_url,
            'slider_status' => $request->sStatus,
        ]);

        return response()->json([
            'success'=>'Slider Added Successfully'
        ]);
    }

    public function ShowSlider(){
        $slider = Slider::latest()->get();
        return response()->json([
            'status'  => 200,
            'AllData' => $slider
        ]);
    }

    public function ActiveSlider($id){
        Slider::findOrFail($id)->update([
            'slider_status'=> 'inactive'
        ]);

        return response()->json([
            'success' => 'Successfull'
        ]);
    }
    public function InactiveSlider($id){
        Slider::findOrFail($id)->update([
            'slider_status'=> 'active'
        ]);

        return response()->json([
            'success' => 'Successfull'
        ]);
    }

    public function DeleteSlider($id){
        $slider = Slider::findOrFail($id);
        $image = public_path($slider->slider_image);
        if(file_exists($image)){
            @unlink($image);
        }
        $slider->delete();
        return response()->json([
            'success'=>'Successfull',
        ]);
    }

    public function EditSlider($id){
        $slider = Slider::findOrFail($id);
        return response()->json([
            'success'=>$slider,
        ]);
    }

    public function UpdateSlider(Request $request,$id){
        $slider = Slider::findOrFail($id);
        $request->validate([
            'updateImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $save_url = $slider->slider_image; // Default to the existing image path
        if($request->hasFile('updateImage') && $request->file('updateImage')->isValid()){
            // Process the uploaded image
            $Oldimage = public_path($slider->slider_image);
            if(file_exists($Oldimage)){
                @unlink($Oldimage);
            }
            $image = $request->file('updateImage');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(2376,807)->save('upload/slider/'.$name_gen);
            $save_url = 'upload/slider/'.$name_gen;
        }
    
        $slider->update([
            'slider_title' => $request->updateTitle,
            'slider_short' => $request->updateShort,
            'slider_image' => $save_url,
            'slider_status' => $request->updateStatus,
        ]);
    
        return response()->json([
            "success"=>"Successfull"
        ]);
    }
    
}
