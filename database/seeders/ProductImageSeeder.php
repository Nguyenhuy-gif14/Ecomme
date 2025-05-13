<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductImage;

class ProductImageSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 27; $i++) { // Chỉ tạo ảnh cho 27 sản phẩm
            ProductImage::create([
                'product_id' => $i,
                'image_path' => "products/product-$i-image.jpg",
                'is_primary' => true,
            ]);
        }
    }
}
