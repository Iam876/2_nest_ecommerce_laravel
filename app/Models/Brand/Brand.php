<?php

namespace App\Models\Brand;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    // Make all field is must be fillabal
    protected $guarded = [];
}
