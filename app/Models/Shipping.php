<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $table = 'shippings';
    protected $fillable = ['order_id', 'address', 'phone', 'status', 'shipping_fee'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
