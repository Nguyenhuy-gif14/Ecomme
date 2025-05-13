<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSpecification extends Model
{
    protected $table = 'product_specifications';
    protected $fillable = ['product_id', 'key', 'value'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
