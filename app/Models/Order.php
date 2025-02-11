<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'product_name',
        'grand_total',
        'payment_status',
        'payment_method',
        'name',
        'email',
        'address',
        'mobile',
        
    ];
}
