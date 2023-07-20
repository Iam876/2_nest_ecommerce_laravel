<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use App\Models\Coupon\Coupon;
use App\Models\Shipping\shippingDivision;
use App\Models\User;
use Carbon\Carbon;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;


class CartController extends Controller
{
    //
    public function AddToCart(Request $request,$id){
         
        try {
            $product = Product::findOrFail($id);
            
            if(Session::has('coupon')){
                Session::forget('coupon');
            }

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
                    'vendor' =>$request->vendor
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
                    'vendor' =>$request->vendor
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

        if(Session::has('coupon')){
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();

           Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name, 
                'coupon_discount' => $coupon->coupon_discount, 
                'discount_amount' => round(Cart::getTotal() * $coupon->coupon_discount/100), 
                'total_amount' => round(Cart::getTotal() - Cart::getTotal() * $coupon->coupon_discount/100 )
            ]); 
        }
        return response()->json([ 'success' => 'Product Remove From Cart' ]);
    }


    public function IndexCartPage(){
        return view('frontend.mainCartPage');
    }
    public function QuantityIncrement($id){

        $row = Cart::get($id);
            $newQuantity = $row->qty + 1;
            $cart = Cart::update($id,['quantity'=>$newQuantity]);

            if(Session::has('coupon')){
                $coupon_name = Session::get('coupon')['coupon_name'];
                $coupon = Coupon::where('coupon_name',$coupon_name)->first();
    
               Session::put('coupon',[
                    'coupon_name' => $coupon->coupon_name, 
                    'coupon_discount' => $coupon->coupon_discount, 
                    'discount_amount' => round(Cart::getTotal() * $coupon->coupon_discount/100), 
                    'total_amount' => round(Cart::getTotal() - Cart::getTotal() * $coupon->coupon_discount/100 )
                ]); 
            }
        
        return response()->json(['cart'=>$cart]);
    }
    public function QuantityDecrement($id){

        $row = Cart::get($id);
            $newQuantity = $row->qty - 1;
            $cart = Cart::update($id,['quantity'=>$newQuantity]);

            if(Session::has('coupon')){
                $coupon_name = Session::get('coupon')['coupon_name'];
                $coupon = Coupon::where('coupon_name',$coupon_name)->first();
    
               Session::put('coupon',[
                    'coupon_name' => $coupon->coupon_name, 
                    'coupon_discount' => $coupon->coupon_discount, 
                    'discount_amount' => round(Cart::getTotal() * $coupon->coupon_discount/100), 
                    'total_amount' => round(Cart::getTotal() - Cart::getTotal() * $coupon->coupon_discount/100 )
                ]); 
            }
        
        return response()->json(['cart'=>$cart]);
    }

    public function AddToCartMainPage($id){

        if(Session::has('coupon')){
            Session::forget('coupon');
        }

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
    public function CouponApply(Request $request){
        $coupon = Coupon::where('coupon_name',$request->coupon_name)->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();
        if($coupon){
            Session::put('coupon',[
                'coupon_name'=>$coupon->coupon_name,
                'coupon_discount'=>$coupon->coupon_discount,
                'discount_amount'=>round(Cart::getTotal() * $coupon->coupon_discount/100),
                'total_amount' => round(Cart::getTotal() - Cart::getTotal() * $coupon->coupon_discount/100 )
            ]);
            return response()->json([
                'validity' => true,                
                'success' => 'Coupon Applied Successfully'
            ]);
        } else{
            return response()->json(['error' => 'Invalid Coupon']);
        }
        
    }

    public function CouponCalculation(){
        if(Session::has('coupon')){
            return response()->json([
                'subtotal' =>Cart::getTotal(),
                'coupon_name' =>session()->get('coupon')['coupon_name'],
                'coupon_discount' =>session()->get('coupon')['coupon_discount'],
                'discount_amount' =>session()->get('coupon')['discount_amount'],
                'total_amount' =>session()->get('coupon')['total_amount'],
            ]);
        }else{
            return response()->json(array(
                'total' => Cart::getTotal(),
            ));
        } 
    }

    
    public function CouponRemove(){
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Remove Successfully']);
    }


    // Checkout page
    public function CheckoutPageCreate(){
        if(Auth::check()){

        if(Cart::getTotal() > 0){

            $carts = Cart::getContent();
            $cartQty = Cart::getTotalQuantity();
            $cartTotal =  Cart::getTotal();

            $id = auth()->user()->id;
            $data = User::select('username','email','phone','address')->where('id',$id)->first();
            $divisions = shippingDivision::all();

            return view('frontend.checkoutPage',compact('carts','cartQty','cartTotal','data','divisions'));
        }
        else{
            $notification = array(
                'message' => 'Your cart is empty. Please choose at-least one product',
                'alert-type' => 'warning'
            );
            return redirect()->to('/')->with($notification);
        }
    }
        else{
            $notification = array(
                'message' => 'Login first before checkout',
                'alert-type' => 'danger'
            );
            return redirect()->route('login')->with($notification);
        }
    }
}
