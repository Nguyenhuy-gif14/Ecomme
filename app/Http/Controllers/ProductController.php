<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Tìm kiếm theo từ khóa
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }

        // Lọc theo giá
        if ($request->has('price_min') && $request->has('price_max')) {
            $priceMin = $request->input('price_min');
            $priceMax = $request->input('price_max');
            $query->whereBetween('price', [$priceMin, $priceMax]);
        }

        // Lọc theo thương hiệu (giả sử bạn có trường `brand` trong bảng `products`)
        if ($request->has('brand')) {
            $brand = $request->input('brand');
            $query->where('brand', $brand);
        }

        $products = $query->paginate(12);
        return view('products.index', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->with('images')->firstOrFail();
        return view('products.show', compact('product'));
    }


    public function searchSuggestions(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name', 'like', "%{$query}%")
            ->take(5)
            ->get(['name', 'slug']);
        return response()->json($products);
    }
}
