<?php

namespace Database\Seeders;

use App\Models\PostCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['sport', 'action', 'drama', 'library', 'framework', 'tool', 'for advanced', 'to student', 'to old man'];

        foreach ($categories as $category) {
            PostCategory::create([
                'name' => $category,
                'description' => Str::random(20),
                'user_id' => rand(0, 150)
            ]);
        }
    } //-- end of function
}//-- end of class PostCategorySeeder
