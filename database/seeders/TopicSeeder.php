<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $topics = ['github', 'vscode', 'laravel', 'php', 'java', 'python', 'docker', 'mysql', 'oracle'];

        foreach ($topics as $topic) {
            Topic::create([
                'name' => $topic,
                'user_id' => rand(1, 150),
                'image_id' => 2,
                'playlist_category_id' => rand(1, 4),
            ]);
        }
    }//-- end class TopicSeeder
}//-- end Seeder
