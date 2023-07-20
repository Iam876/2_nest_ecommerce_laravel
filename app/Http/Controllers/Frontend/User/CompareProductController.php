<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Compare\CompareProducts;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CompareProductController extends Controller
{
    //
    public function productComparePage(){
        return view('frontend.productCompare');
    }

    public function InsertProductCompare($product_id){
        if(Auth::check()){
            $exists = CompareProducts::where('user_id',Auth::id())->where('product_id',$product_id)->first();
            if(!$exists){
                CompareProducts::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                    'created_at' =>Carbon::now(),
                ]);

                return response()->json(['success' => 'Product added for compare']);
            }else{
                return response()->json(['error' => 'Product already exist in compare']);
            }
        }else{
            return response()->json(['error' => 'Please login first ! Before Compare Products']);
        }
    }

    public function ShowCompareProduct(){
        $compare = CompareProducts::with('product')->where('user_id',Auth::id())->latest()->limit(3)->get();
        $compareQty = CompareProducts::count();

        return response()->json([
            'Product' => $compare,
            'Quantity' => $compareQty,
        ]);
    }

    public function CompareProductRemove($id){
        $remove = CompareProducts::findOrFail($id);
        $remove->delete();
 
        return response()->json([
         'success' => 'Product removed from Compare'
        ]);
     }
}
