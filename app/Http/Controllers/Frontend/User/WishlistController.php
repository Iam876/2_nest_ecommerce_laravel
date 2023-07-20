<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\Wishlist\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    //
    public function viewWishList(){
        return view('frontend.wishListProduct');
    }
    public function InsertWishList($product_id){
        if(Auth::check()){
            $exists = Wishlist::where('user_id',Auth::id())->where('product_id',$product_id)->first();
            if(!$exists){
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                    'created_at' => Carbon::now()
                ]);

                return response()->json([ 'success' => 'Product added to wishlist successfully' ]);
            }else{
                return response()->json([ 'error' => 'Product already exist in wishlist' ]);
            }
        }else{
            return response()->json([ 'error' => 'Please login for adding product into wishlist' ]);
        }
    }

    public function wishListAjax(){
        $wishlist = Wishlist::with('product')->where('user_id',Auth::id())->latest()->get();
        $wishQty = Wishlist::count();

        return response()->json([
            'wishlist' =>$wishlist,
            'wishQty' => $wishQty
        ]);

    }

    public function wishProductRemove($id){
       $remove = Wishlist::findOrFail($id);
       $remove->delete();

       return response()->json([
        'success' => 'Product removed from wishlist'
       ]);
    }
}
