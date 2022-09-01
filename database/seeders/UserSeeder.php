<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // super admin
        $user = User::create([
            'name'  => 'Anas Omar',
            'email' => 'super_admin@educationforfree.com',
            'username' => '@' . 'super_admin' . Str::random(5),
            'password'  => Hash::make('ao(123456)'),
            'address'   => Str::random(7)
        ]);

        $user->attachRole('super_admin');

        // admin
        for ($i = 0; $i < 100; $i++) {
            $user1 = User::create([
                'name' => Str::random(10),
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('ao(123456)'),
                'username' => '@' . 'username_' . $i + 1 . '_' . Str::random(3),
                'remember_token' => Str::random(10),
                'email_verified_at' => now(),
                'address'   => Str::random(7)
            ]);

            $user1->attachRole('admin');
        }

        // for teacher
        for ($i = 0; $i < 100; $i++) {
            $user3 = User::create([
                'name' => Str::random(10),
                'email' => Str::random(10) . '@gmail.com',
                'username' => '@' . 'username_' . $i + 1 . '_' . Str::random(3),
                'password' => Hash::make('ao(123456)'),
                'remember_token' => Str::random(10),
                'request_teacher' => 1,
                'email_verified_at' => now(),
                'address'   => Str::random(7)
            ]);

            $user3->attachRole('teacher');

            $user3->attachPermissions([
                'comments_create',
                'comments_read',
                'comments_update',
                'comments_delete',
                'posts_create',
                'posts_read',
                'posts_update',
                'posts_delete',
                'profiles_update',
                'profiles_delete'
            ]);
        }
        // for student
        for ($i = 0; $i < 100; $i++) {
            $user2 = User::create([
                'name' => Str::random(10),
                'email' => Str::random(10) . '@gmail.com',
                'username' => '@' . 'username_' . $i + 1 . '_' . Str::random(3),
                'password' => Hash::make('ao(123456)'),
                'remember_token' => Str::random(10),
                'email_verified_at' => now(),
                'address'   => Str::random(7)
            ]);

            $user2->attachRole('student');

            $user2->attachPermissions([
                'comments_create',
                'comments_read',
                'comments_update',
                'comments_delete',
                'profiles_update',
                'profiles_delete'
            ]);
        }
    } //-- end of run()
}//-- end class UserSeeder
