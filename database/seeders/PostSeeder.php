<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 100; $i++) {
            Post::create([
                'title' => Str::random(15),
                'body' => Str::random(200),
                'user_id' => rand(1, 150),
                'post_category_id' => rand(1, 9),
                'image_id' => 1
            ]);
        }
    } //-- end of run()
}//-- end post seeder class
