<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Điện thoại (category_id: 1) - 10 sản phẩm
            ['name' => 'Samsung Galaxy S23 Ultra', 'category_id' => 1, 'brand_id' => 1, 'price' => 26990000, 'discount_price' => 23990000, 'stock' => 50],
            ['name' => 'iPhone 14 Pro Max', 'category_id' => 1, 'brand_id' => 2, 'price' => 32990000, 'discount_price' => 29990000, 'stock' => 30],
            ['name' => 'Xiaomi 13 Pro', 'category_id' => 1, 'brand_id' => 3, 'price' => 24990000, 'discount_price' => 22990000, 'stock' => 40],
            ['name' => 'Samsung Galaxy A54', 'category_id' => 1, 'brand_id' => 1, 'price' => 9990000, 'discount_price' => 8990000, 'stock' => 60],
            ['name' => 'iPhone 13', 'category_id' => 1, 'brand_id' => 2, 'price' => 18990000, 'discount_price' => 16990000, 'stock' => 35],
            ['name' => 'Xiaomi Redmi Note 12', 'category_id' => 1, 'brand_id' => 3, 'price' => 6990000, 'discount_price' => 6490000, 'stock' => 70],
            ['name' => 'Samsung Galaxy Z Fold 5', 'category_id' => 1, 'brand_id' => 1, 'price' => 40990000, 'discount_price' => 37990000, 'stock' => 20],
            ['name' => 'iPhone 15', 'category_id' => 1, 'brand_id' => 2, 'price' => 22990000, 'discount_price' => 20990000, 'stock' => 25],
            ['name' => 'Xiaomi 14', 'category_id' => 1, 'brand_id' => 3, 'price' => 19990000, 'discount_price' => 17990000, 'stock' => 45],
            ['name' => 'Asus ROG Phone 7', 'category_id' => 1, 'brand_id' => 4, 'price' => 23990000, 'discount_price' => 21990000, 'stock' => 30],

            // Laptop (category_id: 2) - 7 sản phẩm
            ['name' => 'Asus ROG Strix G15', 'category_id' => 2, 'brand_id' => 4, 'price' => 28990000, 'discount_price' => 26990000, 'stock' => 20],
            ['name' => 'MacBook Air M2', 'category_id' => 2, 'brand_id' => 2, 'price' => 31990000, 'discount_price' => 29990000, 'stock' => 15],
            ['name' => 'Asus ZenBook 14', 'category_id' => 2, 'brand_id' => 4, 'price' => 22990000, 'discount_price' => 20990000, 'stock' => 25],
            ['name' => 'MacBook Pro M1', 'category_id' => 2, 'brand_id' => 2, 'price' => 34990000, 'discount_price' => 32990000, 'stock' => 10],
            ['name' => 'Samsung Galaxy Book 3', 'category_id' => 2, 'brand_id' => 1, 'price' => 25990000, 'discount_price' => 23990000, 'stock' => 15],
            ['name' => 'Asus TUF Gaming A15', 'category_id' => 2, 'brand_id' => 4, 'price' => 19990000, 'discount_price' => 17990000, 'stock' => 30],
            ['name' => 'MacBook Air M1', 'category_id' => 2, 'brand_id' => 2, 'price' => 24990000, 'discount_price' => 22990000, 'stock' => 20],

            // Phụ kiện (category_id: 3) - 3 sản phẩm
            ['name' => 'Tai nghe Sony WH-1000XM5', 'category_id' => 3, 'brand_id' => 5, 'price' => 8490000, 'discount_price' => 7990000, 'stock' => 100],
            ['name' => 'Sạc nhanh Samsung 25W', 'category_id' => 3, 'brand_id' => 1, 'price' => 490000, 'discount_price' => 390000, 'stock' => 200],
            ['name' => 'Ốp lưng iPhone 14', 'category_id' => 3, 'brand_id' => 2, 'price' => 290000, 'discount_price' => 250000, 'stock' => 150],

            // Máy tính bảng (category_id: 4) - 3 sản phẩm
            ['name' => 'iPad Air 5', 'category_id' => 4, 'brand_id' => 2, 'price' => 16990000, 'discount_price' => 14990000, 'stock' => 25],
            ['name' => 'Samsung Galaxy Tab S9', 'category_id' => 4, 'brand_id' => 1, 'price' => 19990000, 'discount_price' => 17990000, 'stock' => 20],
            ['name' => 'Xiaomi Pad 6', 'category_id' => 4, 'brand_id' => 3, 'price' => 8990000, 'discount_price' => 7990000, 'stock' => 30],

            // Đồng hồ thông minh (category_id: 5) - 2 sản phẩm
            ['name' => 'Apple Watch Series 8', 'category_id' => 5, 'brand_id' => 2, 'price' => 10990000, 'discount_price' => 9990000, 'stock' => 40],
            ['name' => 'Samsung Galaxy Watch 6', 'category_id' => 5, 'brand_id' => 1, 'price' => 7990000, 'discount_price' => 6990000, 'stock' => 50],

            // Tai nghe (category_id: 6) - 1 sản phẩm
            ['name' => 'Sony WF-1000XM4', 'category_id' => 6, 'brand_id' => 5, 'price' => 6490000, 'discount_price' => 5990000, 'stock' => 80],

            // Loa (category_id: 7) - 1 sản phẩm
            ['name' => 'Sony SRS-XB23', 'category_id' => 7, 'brand_id' => 5, 'price' => 2490000, 'discount_price' => 2290000, 'stock' => 60],
            // Pin sạc dự phòng (category_id: 8) - 1 sản phẩm
            ['name' => 'Anker PowerCore 10000', 'category_id' => 8, 'brand_id' => 6, 'price' => 490000, 'discount_price' => 390000, 'stock' => 150],
        ];

        foreach ($products as $product) {
            Product::create([
                'category_id' => $product['category_id'],
                'brand_id' => $product['brand_id'],
                'name' => $product['name'],
                'slug' => Str::slug($product['name']),
                'description' => 'Sản phẩm chất lượng cao từ ' . $product['name'],
                'price' => $product['price'],
                'discount_price' => $product['discount_price'],
                'stock' => $product['stock'],
                'is_active' => true,
            ]);
        }
    }
}
