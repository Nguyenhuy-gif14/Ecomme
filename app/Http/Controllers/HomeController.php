<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('is_active', true)->orderBy('order')->get();
        $products = Product::where('is_active', true)->limit(10)->get();
        $categories = Category::all();

        return view('home', compact('sliders', 'products', 'categories'));
    }
}
