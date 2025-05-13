<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            ['name' => 'Samsung', 'logo' => 'samsung-logo.png'],
            ['name' => 'Apple', 'logo' => 'apple-logo.png'],
            ['name' => 'Xiaomi', 'logo' => 'xiaomi-logo.png'],
            ['name' => 'Asus', 'logo' => 'asus-logo.png'],
            ['name' => 'Sony', 'logo' => 'sony-logo.png'],
        ];

        foreach ($brands as $brand) {
            Brand::create([
                'name' => $brand['name'],
                'slug' => Str::slug($brand['name']),
                'logo' => $brand['logo'],
            ]);
        }
    }
}
