<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ["local", "international", "sports", "food", "breaking"];
        $arr = [];
        foreach ($categories as $category) {
            $arr[] = [
                "title" => $category,
                "slug" => $category,
                "user_id" => 11,
                "created_at" => now(),
                "updated_at" => now(),
            ];
        }
        Category::insert($arr);
    }
}
