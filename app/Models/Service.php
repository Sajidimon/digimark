<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'price',
        'category_id',
        'description',
        'delivery_time',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
