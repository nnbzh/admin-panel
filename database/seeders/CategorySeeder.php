<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'slug' => 'work',
                'name' => 'Work'
            ],
            [
                'slug' => 'education',
                'name' => 'Education'
            ]
        ];

        foreach ($categories as $category) {
            Category::query()->updateOrCreate($category);
        }
    }
}
