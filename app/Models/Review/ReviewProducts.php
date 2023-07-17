<?php

namespace App\Models\Review;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product\Product;
use App\Models\User;

class ReviewProducts extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id', 'id');
    }
}