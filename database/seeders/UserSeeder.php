<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        $user = User::create([
            'name'  => 'Anas Omar',
            'email' => 'super_admin@educationforfree.com',
            'password'  => Hash::make('ao(123456)')
        ]);

        $user->attachRole('super_admin');

    } //-- end of run()
}//-- end class UserSeeder
