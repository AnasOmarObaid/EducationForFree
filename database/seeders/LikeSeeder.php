<?php

namespace Database\Seeders;

use App\Models\Like;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 100; $i++) {
            Like::create([
                'user_id' => rand(1, 300),
                'comment_id' => rand(1, 100)
            ]);
        }
    } //-- end of run function
}//-- end of class
