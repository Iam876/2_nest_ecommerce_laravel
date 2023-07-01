<?php

namespace App\Models\Order;

use App\Models\Order\OrderItem;
use App\Models\Shipping\shippingDistrict;
use App\Models\Shipping\shippingDivision;
use App\Models\Shipping\shippingState;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function OrderItem()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function division()
    {
        return $this->belongsTo(shippingDivision::class, 'division_id', 'id');
    }
    public function district()
    {
        return $this->belongsTo(shippingDistrict::class, 'district_id', 'id');
    }
    public function state()
    {
        return $this->belongsTo(shippingState::class, 'state_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
