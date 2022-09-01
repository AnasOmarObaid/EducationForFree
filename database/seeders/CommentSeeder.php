<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 100; $i++) {
            Comment::create([
                'body' => Str::random(20),
                'parent_id' => rand(50, 100),
                'model' => get_class(new Post),
                'user_id' => rand(50, 100),
            ]);
        }
    }
}
