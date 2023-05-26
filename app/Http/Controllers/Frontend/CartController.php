<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    //
    public function AddToCart(Request $request,$id){
         
        try {
            $product = Product::findOrFail($id);
        // $rowId = Str::uuid()->toString();
        if ($product->discount_price == NULL) {
            cart::add([
                'id' => $id,
                'name' => $request->name,
                'quantity' => $request->quantity,
                'price' => $product->price,
                'attributes'=> array(
                    'image' =>$product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ),
            ]);
            return response()->json(['success'=>'Successfully added to cart']);
        } else {
            cart::add([
                'id' => $id,
                'name' => $request->name,
                'quantity' => $request->quantity,
                'price' => $product->discount_price,
                'attributes'=> array(
                    'image' =>$product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                    'slug' => $product->product_slug,
                ),
                
            ]);
            return response()->json(['success'=>'Successfully added to cart','data'=>$id]);
        }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle the case when the product is not found
            return response()->json(['error' => 'Product not found'], 404);
        }
    }

    public function AddToCartWish($id){

            $product = Product::findOrFail($id);
        if ($product->discount_price == NULL) {
            cart::add([
                'id' => $id,
                'name' => $product->product_name,
                'quantity' => 1,
                'price' => $product->selling_price,
                'attributes'=> array(
                    'image' =>$product->product_thumbnail,
                ),
            ]);
            return response()->json(['success'=>'Successfully added to cart']);
        } else {
            cart::add([
                'id' => $id,
                'name' => $product->product_name,
                'quantity' => 1,
                'price' => $product->discount_price,
                'attributes'=> array(
                    'image' =>$product->product_thumbnail
                ),
            ]);
            return response()->json(['success'=>'Successfully added to cart','data'=>$id]);
        }
    }
    public function AddToCartCompare($id){

            $product = Product::findOrFail($id);
        if ($product->discount_price == NULL) {
            cart::add([
                'id' => $id,
                'name' => $product->product_name,
                'quantity' => 1,
                'price' => $product->selling_price,
                'attributes'=> array(
                    'image' =>$product->product_thumbnail,
                ),
            ]);
            return response()->json(['success'=>'Successfully added to cart']);
        } else {
            cart::add([
                'id' => $id,
                'name' => $product->product_name,
                'quantity' => 1,
                'price' => $product->discount_price,
                'attributes'=> array(
                    'image' =>$product->product_thumbnail
                ),
            ]);
            return response()->json(['success'=>'Successfully added to cart','data'=>$id]);
        }
    }

    public function AddToMiniCart(){

        $carts = Cart::getContent();
        $cartQty = Cart::getTotalQuantity();
        $cartTotal =  Cart::getTotal();
        return response()->json([
            'carts' => $carts,
            'cartQty' => $cartQty,  
            'cartTotal' => $cartTotal
        ]);
    }

    public function CartProductRemove($id){
        Cart::remove($id);
        return response()->json([ 'success' => 'Product Remove From Cart' ]);
    }


    public function IndexCartPage(){
        return view('frontend.mainCartPage');
    }
    public function QuantityIncrement($id){

        $row = Cart::get($id);
            $newQuantity = $row->qty + 1;
            $cart = Cart::update($id,['quantity'=>$newQuantity]);
        
        return response()->json(['cart'=>$cart]);
    }
    public function QuantityDecrement($id){

        $row = Cart::get($id);
            $newQuantity = $row->qty - 1;
            $cart = Cart::update($id,['quantity'=>$newQuantity]);
        
        return response()->json(['cart'=>$cart]);
    }

    public function AddToCartMainPage($id){

        $product = Product::findOrFail($id);
    if ($product->discount_price == NULL) {
        cart::add([
            'id' => $id,
            'name' => $product->product_name,
            'quantity' => 1,
            'price' => $product->selling_price,
            'attributes'=> array(
                'image' =>$product->product_thumbnail,
            ),
        ]);
        return response()->json(['success'=>'Successfully added to cart']);
    } else {
        cart::add([
            'id' => $id,
            'name' => $product->product_name,
            'quantity' => 1,
            'price' => $product->discount_price,
            'attributes'=> array(
                'image' =>$product->product_thumbnail
            ),
        ]);
        return response()->json(['success'=>'Successfully added to cart','data'=>$id]);
    }
}

}
