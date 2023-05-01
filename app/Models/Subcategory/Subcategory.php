<?php

namespace App\Models\Subcategory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category\Category;

class Subcategory extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
