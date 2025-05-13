<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = ['code', 'discount', 'type', 'min_order_amount', 'expires_at', 'is_active'];

    protected $dates = ['expires_at'];
}
