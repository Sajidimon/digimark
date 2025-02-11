<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'regular',
        'discount',
        'category_id',
        'description',
        'demo_link',
        'image',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
