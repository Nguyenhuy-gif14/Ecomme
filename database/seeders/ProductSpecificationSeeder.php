<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductSpecification;

class ProductSpecificationSeeder extends Seeder
{
    public function run(): void
    {
        $specs = [
            ['product_id' => 1, 'key' => 'Màn hình', 'value' => '6.1 inch AMOLED'],
            ['product_id' => 1, 'key' => 'RAM', 'value' => '8GB'],
            ['product_id' => 2, 'key' => 'Màn hình', 'value' => '6.7 inch OLED'],
            ['product_id' => 2, 'key' => 'RAM', 'value' => '6GB'],
            // Thêm thông số cho các sản phẩm khác...
        ];

        foreach ($specs as $spec) {
            ProductSpecification::create($spec);
        }
    }
}
