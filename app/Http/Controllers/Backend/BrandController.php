<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand\Brand;
use Intervention\Image\Facades\Image;



class BrandController extends Controller
{
    //Brand All
    public function AllBrand()
    {
        $brands = Brand::latest()->get();
        return view('backend.brand.brandAll', compact('brands'));
    }
    public function AddBrandStore(Request $request)
    {

        $request->validate([
            'Bimage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('Bimage')) {
            $image = $request->file('Bimage');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(2376, 807)->save('upload/brand/' . $name_gen);
            $save_url = 'upload/brand/' . $name_gen;
        }

        if (!$request->hasFile('Bimage')) {
            return response()->json([
                'error' => "No brand image provided"
            ]);
        }

        $brand = new Brand();
        $brand->brand_name = $request->Bname;
        $brand->brand_slug = strtolower(str_replace(' ', '-', $request->Bname));
        $brand->brand_image = $save_url;
        $brand->save();

        return response()->json([
            'success' => "Brand Added success"
        ]);
    }

    // Show Data
    public function ShowBrand()
    {
        $brands = Brand::all();
        return response()->json([
            'status' => 200,
            'AllData' => $brands,
        ]);
    }

    public function ActiveBrand($id)
    {
        $brands = Brand::findorFail($id);

        if ($brands) {
            $brands->status = 'inactive';
            $brands->save();
            return response()->json([
                'success' => $brands->status,
            ]);
        } else {
            return response()->json(['error' => 'Brand not found.'], 404);
        }
    }

    public function InactiveBrand($id)
    {
        $brands = Brand::findorFail($id);

        if ($brands) {
            $brands->status = 'active';
            $brands->save();
            return response()->json([
                'success' => 'Brand Inactivated Successfully',
            ]);
        } else {
            return response()->json(['error' => 'Brand not found.'], 404);
        }
    }
    // Brand Destroy
    public function DestroyBrand($id)
    {
        $brand = Brand::findorFail($id);

        $image = public_path($brand->brand_image);
        if (file_exists($image)) {
            @unlink($image);
        }

        $brand->delete();
        return response()->json([
            'success' => 'Brand Deleted',
        ]);
    }

    // Edit 
    public function EditBrand($id)
    {
        $brand = Brand::find($id);
        return response()->json([
            "success" => $brand
        ]);
    }

    // Update
    public function UpdateBrand(Request $request, $id)
    {

        $request->validate([
            'Bimage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $old_image = $request->Boldimage;

        if ($request->hasFile('Bimage')) {
            $image = $request->file('Bimage');
            $old_image_path = public_path(parse_url($old_image, PHP_URL_PATH));
            if (file_exists($old_image_path)) {
                @unlink($old_image_path);
            }
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(2376, 807)->save('upload/brand/' . $name_gen);
            $save_url = 'upload/brand/' . $name_gen;
        }

        $brand = Brand::find($id);
        $brand->brand_name = $request->Bname;
        $brand->brand_slug = strtolower(str_replace(' ', '-', $request->Bname));
        $brand->brand_image = $save_url;
        $brand->status = $request->Bstatus;
        $brand->update();
        return response()->json([
            'success' => 'Brand Inactivated Successfully',
        ]);
    }
}
