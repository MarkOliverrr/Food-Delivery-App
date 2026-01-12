<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dish;
use App\Models\Restaurant;

class DishSeeder extends Seeder
{
    public function run(): void
    {
        $rs = fn($title) => Restaurant::where('title', $title)->value('rs_id');

        $data = [
            [
                'rs_id' => $rs('North Street Tavern'),
                'title' => 'Yorkshire Lamb Patties',
                'slogan' => 'Lamb patties which melt in your mouth, quick and easy to make.',
                'price' => 14.00,
                'img' => '62908867a48e4.jpg',
            ],
            [
                'rs_id' => $rs('North Street Tavern'),
                'title' => 'Lobster Thermidor',
                'slogan' => 'French dish of lobster meat cooked in a rich wine sauce.',
                'price' => 36.00,
                'img' => '629089fee52b9.jpg',
            ],
            [
                'rs_id' => $rs('Eataly'),
                'title' => 'Pink Spaghetti Gamberoni',
                'slogan' => 'Spaghetti with prawns in a fresh tomato sauce.',
                'price' => 21.00,
                'img' => '606d7491a9d13.jpg',
            ],
            [
                'rs_id' => $rs('Eataly'),
                'title' => 'Cheesy Mashed Potato',
                'slogan' => 'Fluffy, cheesy mashed potatoes everyone will love.',
                'price' => 5.00,
                'img' => '606d74c416da5.jpg',
            ],
            [
                'rs_id' => $rs('Eataly'),
                'title' => 'Crispy Chicken Strips',
                'slogan' => 'Fried chicken strips with honey mustard sauce.',
                'price' => 8.00,
                'img' => '606d74f6ecbbb.jpg',
            ],
            [
                'rs_id' => $rs('Eataly'),
                'title' => 'Lemon Grilled Chicken And Pasta',
                'slogan' => 'Grilled chicken with mashed potatoes and your choice of pasta.',
                'price' => 11.00,
                'img' => '606d752a209c3.jpg',
            ],
        ];

        foreach ($data as $row) {
            if (!empty($row['rs_id'])) {
                Dish::firstOrCreate([
                    'title' => $row['title'],
                    'rs_id' => $row['rs_id'],
                ], $row);
            }
        }
    }
}


