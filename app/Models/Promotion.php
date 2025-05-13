<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $table = 'promotions';
    protected $fillable = ['title', 'description', 'discount_percentage', 'start_date', 'end_date', 'is_active'];
}
