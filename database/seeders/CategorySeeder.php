<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Điện thoại', 'description' => 'Điện thoại thông minh các loại'],
            ['name' => 'Laptop', 'description' => 'Máy tính xách tay đa dạng'],
            ['name' => 'Phụ kiện', 'description' => 'Tai nghe, sạc, ốp lưng'],
            ['name' => 'Máy tính bảng', 'description' => 'Tablet tiện lợi'],
            ['name' => 'Đồng hồ thông minh', 'description' => 'Smartwatch hiện đại'],
            ['name' => 'Tai nghe', 'description' => 'Tai nghe có dây và không dây'],
            ['name' => 'Loa', 'description' => 'Loa Bluetooth và loa mini'],
            ['name' => 'Pin sạc dự phòng', 'description' => 'Pin sạc tiện ích'],
            ['name' => 'Máy ảnh', 'description' => 'Máy ảnh kỹ thuật số và phụ kiện'],
            ['name' => 'Thiết bị mạng', 'description' => 'Router, switch, modem'],
            ['name' => 'Phần mềm', 'description' => 'Phần mềm và ứng dụng'],
            ['name' => 'Thiết bị gia dụng', 'description' => 'Thiết bị điện tử gia đình'],
            ['name' => 'Đồ chơi công nghệ', 'description' => 'Đồ chơi thông minh cho trẻ em'],
            ['name' => 'Thiết bị văn phòng', 'description' => 'Máy in, máy photocopy'],
            ['name' => 'Phụ kiện máy tính', 'description' => 'Chuột, bàn phím'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
            ]);
        }
    }
}
