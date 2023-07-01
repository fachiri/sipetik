<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
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
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'ADMIN',
            'password' => Hash::make('pass1234')
        ]);
        User::create([
            'name' => 'Direktur UPT TIK',
            'email' => 'dirut.upt.tik@gmail.com',
            'role' => 'ADMIN',
            'password' => Hash::make('pass1234')
        ]);
    }
}
