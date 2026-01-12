<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['c_name' => 'Continental'],
            ['c_name' => 'Italian'],
            ['c_name' => 'Chinese'],
            ['c_name' => 'American'],
        ];

        foreach ($data as $row) {
            Category::firstOrCreate(['c_name' => $row['c_name']], $row);
        }
    }
}


