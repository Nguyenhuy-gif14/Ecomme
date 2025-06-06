<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $table = 'blog_categories';
    protected $fillable = ['name', 'slug'];

    public function posts()
    {
        return $this->hasMany(BlogPost::class);
    }
}
