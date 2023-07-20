<?php

namespace App\Models\Shipping;

use App\Models\Shipping\shippingDistrict;
use App\Models\Shipping\shippingDivision;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shippingState extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function district(){
        return $this->belongsTo(shippingDistrict::class,'district_id','id');
    }
    public function division(){
        return $this->belongsTo(shippingDivision::class,'division_id','id');
    }
}
