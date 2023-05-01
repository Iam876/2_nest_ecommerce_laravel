<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category\Category;
use App\Models\Subcategory\Subcategory;

class SubcategoryController extends Controller
{
    // All subcategory
    public function AllSubCategory(){
        $subcategory = Subcategory::latest()->get();
        return view('backend.subcategory.allsubcategory',compact('subcategory'));
    }

    public function addCategory(){
        $categories = Category::orderby('category_name','ASC')->get();
        return response()->json([
            'success'=>$categories
        ]);
        // return view('backend.subcategory.allsubcategory',compact('categories'));
    }

    public function addSubCategory(Request $request){
        Subcategory::insert([
            'category_id'=> $request->cid,
            'subcategory_name'=> $request->subName,
            'subcategory_slug'=> strtolower(str_replace(" ","-",$request->subName)),
            'subcategory_status'=>$request->substatus
        ]);

        return response()->json([
            'success'=>'Subcategory Successfully Added'
        ]);
    }

    public function showSubCategory(){
        /*

        * here the "category" is the relationship method defined inside Subcategory model.
        * "Subcategory::with('category')->get()" It will get all the subcategory data from the database also it will get all values from the category table because of the relation.

         */
        $subcategories = Subcategory::with('category')->get();
        return response()->json([
            'status'=>200,
            'AllData'=>$subcategories
        ]);
    }
    public function ActiveSubCategory($id){
        Subcategory::findOrFail($id)->update([
            'subcategory_status'=>'inactive'
        ]);
        return response()->json([
            'success' => 'Subcategory Inactive Successfully'
        ]);
    }
    public function InactiveSubCategory($id){
        Subcategory::findOrFail($id)->update([
            'subcategory_status'=>'active'
        ]);
        return response()->json([
            'success' => 'Subcategory Active Successfully'
        ]);
    }
    public function DeleteSubCategory($id){
        Subcategory::findOrFail($id)->delete();
        return response()->json([
            'success'=>'Subcategory Deleted'
        ]);
    }
}
