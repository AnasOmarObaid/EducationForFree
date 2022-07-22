<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 50; $i++) {
            Question::create([
                'name'  => Str::random(7),
                'email' =>  Str::random(5) . '@gmail.com',
                'question'  => Str::random(30)
            ]);
        }
    } //-- end run function
}//-- end question seeder
