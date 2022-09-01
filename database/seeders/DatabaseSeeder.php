<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
            $this->call([
                ImageSeeder::class,
                LaratrustSeeder::class,
                UserSeeder::class,
                QuestionSeeder::class,
                PostCategorySeeder::class,
                PostSeeder::class,
                CommentSeeder::class,
                LikeSeeder::class,
                ReplaySeeder::class,
                PlaylistCategorySeeder::class,
            ]);

    }
}
