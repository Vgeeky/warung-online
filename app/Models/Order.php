<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [

        'user_id',

        'customer_name',

        'table_number',

        'total_price',

        'status',

        'shipping_address',

        'city',

        'postal_code',

    ];

    protected $casts = [

        'total_price' => 'integer',

    ];
}