<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Review;
class Product extends Model
{
    protected $fillable = [
        'name', 'detail', 'category_id', 'sub_category_id', 'unit_id', 'user_id','brand_id', 'picture1', 'picture2', 'picture3', 'picture4', 'default_picture'
    ];
    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
