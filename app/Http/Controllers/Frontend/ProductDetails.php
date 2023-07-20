<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category\Category;
use App\Models\Subcategory\Subcategory;
use App\Models\Multiimage\MultiImage;
use App\Models\Brand\Brand;
use App\Models\Product\Product;
use App\Models\Review\ReviewProducts;
use Illuminate\Support\Facades\Cache;

class ProductDetails extends Controller
{
    //

    public function index()
    {
        $skip_category_3 = Category::skip(3)->first();
        $skip_product_3 = Product::where('status', 1)->where('category_id', $skip_category_3->id)->orderBy('id', 'DESC')->limit(10)->get();
        $skip_category_10 = Category::skip(10)->first();
        $skip_product_10 = Product::where('status', 1)->where('category_id', $skip_category_10->id)->orderBy('id', 'DESC')->limit(10)->get();
        $skip_category_1 = Category::skip(1)->first();
        $skip_product_1 = Product::where('status', 1)->where('category_id', $skip_category_1->id)->orderBy('id', 'DESC')->limit(10)->get();

        $hot_deals = Product::where('status', 1)->where('hot_deals', 1)->orderBy('product_name', 'DESC')->limit(3)->get();
        $special_offer = Product::where('status', 1)->where('special_offer', 1)->orderBy('product_name', 'DESC')->limit(3)->get();
        $featured = Product::where('status', 1)->where('featured', 1)->orderBy('product_name', 'DESC')->limit(3)->get();
        $special_deals = Product::where('status', 1)->where('special_deals', 1)->orderBy('product_name', 'DESC')->limit(3)->get();

        $vendor = User::where('role', 'vendor')->where('status', 'active')->with('products')->limit(4)->get();
        // dd($vendor);

        return view('frontend.index', compact('skip_product_3', 'skip_category_3', 'skip_product_10', 'skip_category_10', 'skip_product_1', 'skip_category_1', 'hot_deals', 'special_offer', 'special_deals', 'featured', 'vendor'));
    }
    public function ProductDetails($id, $slug)
    {
        $products = product::findOrFail($id);
        $product_multiimage = MultiImage::where('product_id', $id)->get();

        $cat_id = $products->category_id;
        $related_products = Product::where('category_id', $cat_id)->where('id', '!=', $id)->orderBy('id', 'DESC')->limit(4)->get();

        $size = $products->product_size;
        $product_size = explode(',', $size);

        $tags = $products->product_tags;
        $product_tags = explode(',', $tags);

        $color = $products->product_color;
        $product_color = explode(',', $color);

        $reviews = ReviewProducts::where('status', 1)->with('products', 'user', 'vendor')->latest()->get();

        $ratingsCount = $reviews->groupBy('rating')
            ->map(function ($group) {
                return $group->count();
            });

        $totalRatings = $reviews->count();
        $ratingsPercentage = $ratingsCount->map(function ($count) use ($totalRatings) {
            return ceil(($count / $totalRatings) * 100);
        });

        $averageRating = ceil($reviews->avg('rating'));

        return view('frontend.productDetailsPage', compact('products', 'product_size', 'product_tags', 'product_color', 'product_multiimage', 'related_products', 'reviews', 'averageRating', 'ratingsCount', 'ratingsPercentage'));
    }

    public function CategoryProduct($id, $slug)
    {
        $categories = Category::findOrFail($id);
        $category = Category::where('status', 'active')->orderBy('category_name', 'DESC')->withCount('products')->limit(5)->get();
        $products = Product::where('category_id', $id)->where('status', 1)->orderBy('category_id', 'ASC')->paginate(16);
        $NewProduct = Product::where('status', 1)->limit(3)->orderBy('id', 'DESC')->get();
        return view('frontend.CategorywiseProduct', compact('products', 'categories', 'category', 'NewProduct'));
    }
    public function SubCategoryProduct($id, $slug)
    {
        $subcategories = Subcategory::findOrFail($id);
        $category = Category::where('status', 'active')->orderBy('category_name', 'DESC')->withCount('products')->limit(5)->get();
        $subcategory = Subcategory::where('category_id', $id)->withCount('products')->limit(5)->get();
        $products = Product::where('subcategory_id', $id)->where('status', 1)->orderBy('subcategory_id', 'ASC')->paginate(16);
        $NewProduct = Product::where('status', 1)->limit(3)->orderBy('id', 'DESC')->get();
        return view('frontend.SubCategorywiseProduct', compact('products', 'subcategories', 'subcategory', 'NewProduct', 'category'));
    }

    public function ProductModalView($id)
    {
        $products = Product::with('category', 'brand', 'subcategory', 'vendor')->findOrFail($id);
        $product_multiImage = MultiImage::where('product_id', $id)->get();

        $tags = $products->product_tags;
        $product_tags = explode(',', $tags);

        $color = $products->product_color;
        $product_color = explode(',', $color);

        $size = $products->product_size;
        $product_size = explode(',', $size);

        return response()->json([
            'status' => 200,
            'product' => $products,
            'tags' => $product_tags,
            'colors' => $product_color,
            'sizes' => $product_size,
            'multiImage' => $product_multiImage
        ]);
    }

    public function searchProduct(Request $request)
    {
        $request->validate(['search' => 'required']);

        $item = $request->search;
        $categories = Category::orderBy('category_name', 'ASC')->get();

        $products = Cache::remember('search_results_' . $item, 60, function () use ($item) {
            return Product::where('product_name', 'LIKE', "%$item%")->get();
        });

        return redirect()->route('show.results', compact('item', 'categories'));
    }

    public function showResults(Request $request)
    {
        $item = $request->item;
        $categories = $request->categories;

        $products = Cache::get('search_results_' . $item);

        return view('frontend.product_search', compact('products', 'item', 'categories'));
    }
    public function SearchProductAjax(Request $request)
    {
        try {
            $request->validate(['search' => "required"]);

            $item = $request->search;
            $products = Product::where('product_name', 'LIKE', "%$item%")->select('product_name', 'product_slug', 'product_thumbnail', 'selling_price', 'id')->limit(6)->get();

            return response()->json([
                'status' => 200,
                'products' => $products,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }
}