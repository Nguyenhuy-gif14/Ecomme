<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Slider;

class SliderSeeder extends Seeder
{
    public function run(): void
    {
        $sliders = [
            ['title' => 'Khuyến mãi lớn Samsung', 'image_path' => 'sliders/samsung-promo.jpg', 'link' => '/products/samsung', 'order' => 1],
            ['title' => 'iPhone mới nhất', 'image_path' => 'sliders/iphone-promo.jpg', 'link' => '/products/iphone', 'order' => 2],
        ];

        foreach ($sliders as $slider) {
            Slider::create(array_merge($slider, ['is_active' => true]));
        }
    }
}
