<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use App\Models\Category;

class RestaurantSeeder extends Seeder
{
    public function run(): void
    {
        $cat = fn($name) => Category::where('c_name', $name)->value('c_id');

        $data = [
            [
                'c_id' => $cat('Continental'),
                'title' => 'North Street Tavern',
                'email' => 'nthavern@mail.com',
                'phone' => '3547854700',
                'url' => 'http://www.northstreettavern.com',
                'o_hr' => '8am',
                'c_hr' => '8pm',
                'o_days' => 'mon-sat',
                'address' => '1128 North St, White Plains',
                'image' => '6290877b473ce.jpg',
            ],
            [
                'c_id' => $cat('Italian'),
                'title' => 'Eataly',
                'email' => 'eataly@gmail.com',
                'phone' => '0557426406',
                'url' => 'http://www.eataly.com',
                'o_hr' => '11am',
                'c_hr' => '9pm',
                'o_days' => 'Mon-Sat',
                'address' => '800 Boylston St, Boston',
                'image' => '606d720b5fc71.jpg',
            ],
        ];

        foreach ($data as $row) {
            Restaurant::firstOrCreate([
                'title' => $row['title'],
            ], $row);
        }
    }
}


