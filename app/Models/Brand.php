<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';
    protected $fillable = ['name', 'slug', 'logo'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
