<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class ImageSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Image::create([
            'path' => 'posts/default.png'
        ]);

        Image::create([
            'path' => 'topics/default.png'
        ]);
    } // -- end of run()
}//-- end of class ImageSeeder
