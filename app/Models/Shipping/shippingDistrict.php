<?php

namespace App\Models\Shipping;

use App\Models\Shipping\shippingDivision;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shippingDistrict extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function division(){
        return $this->belongsTo(shippingDivision::class,'division_id','id');
    }
}
