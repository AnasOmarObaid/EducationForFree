<?php

namespace Database\Seeders;

use App\Models\Replay;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ReplaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 50; $i++) {
            Replay::create([
                'body' => Str::random(20),
                'comment_id' => rand(1,30),
                'user_id' => rand(1,50),
            ]);
        }
    }//-- end run
}//-- end ReplaySeeder
