<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Review\ReviewProducts;

class ReviewController extends Controller
{
    /*
    rate
    */

    public function StoreProductReview(Request $request)
    {
        $validated = $request->validate([
            'comment' => 'required|max:255',
        ]);
        $insert = ReviewProducts::insert([
            'product_id' => $request->input('Rproduct'),
            'user_id' => Auth::user()->id,
            'comment' => $request->comment,
            'rating' => $request->rate,
            'vendor_id' => $request->input('Rvendor'),
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Review added succesfully. after admin approval,review will be published',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function ActiveReviewProduct()
    {
        $activeReviewProducts = ReviewProducts::where('status', '1')->with('products', 'user', 'vendor')->latest()->get();
        return view('backend.review.active_review_product', compact('activeReviewProducts'));
    }
    public function InactiveReviewProduct()
    {
        $inactiveReviewProducts = ReviewProducts::where('status', '0')->with('products', 'user', 'vendor')->latest()->get();
        return view('backend.review.inactive_review_product', compact('inactiveReviewProducts'));
    }

    public function ActiveProduct($id)
    {
        ReviewProducts::findOrFail($id)->update([
            'status' => 1
        ]);
        $notification = array(
            'message' => 'Review active successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('active.review.products')->with($notification);
    }
    public function InactiveProduct($id)
    {
        ReviewProducts::findOrFail($id)->update([
            'status' => 0
        ]);
        $notification = array(
            'message' => 'Review inactive successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('inactive.review.products')->with($notification);
    }

    public function ProductReviewVendor()
    {
        $id = Auth::user()->id;
        $allProductReview = ReviewProducts::where('status', '1')->where('vendor_id', $id)->with('products', 'user', 'vendor')->latest()->get();
        return view('vendor.all_review_product', compact('allProductReview'));
    }
}
