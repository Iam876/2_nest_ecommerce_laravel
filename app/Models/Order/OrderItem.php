<?php

namespace App\Models\Order;

use App\Models\Product\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function orderItem()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id', 'id');
    }
}