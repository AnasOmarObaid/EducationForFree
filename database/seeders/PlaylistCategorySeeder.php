<?php

namespace Database\Seeders;

use App\Models\PlaylistCategory;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class PlaylistCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Frameworks', 'Languages', 'Techniques', 'Testing', 'Tooling'];

        foreach($categories as $category){
            PlaylistCategory::create([
                'name' => $category,
                'image'=> 'playlist-categories/' . Str::lower($category) . '.svg',
                'description' => Str::random(20),
                'user_id' => rand(1, 99)
            ]);
        }//-- end foreach
    }//-- end of run
}//-- end class PlaylistCategorySeed
