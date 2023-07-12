<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kabid;
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
            'user_id' => '196207161990031004',
            'level' => 'DOSEN',
            'email' => 'admin@gmail.com',
            'role' => 'ADMIN',
            'password' => Hash::make('pass1234')
        ]);
        User::create([
            'name' => 'Direktur UPT TIK',
            'user_id' => '195312261982031003',
            'level' => 'DOSEN',
            'email' => 'dirut.upt.tik@gmail.com',
            'role' => 'ADMIN',
            'password' => Hash::make('pass1234')
        ]);
        User::create([
            'name' => 'Muh. Fachry J.K. Luid',
            'user_id' => '531420003',
            'level' => 'MAHASISWA',
            'email' => 'fachrycooles@gmail.com',
            'role' => 'PENGGUNA',
            'password' => Hash::make('pass1234')
        ]);
        $kabid1 = User::create([
            'name' => 'Kabid Infrastruktur Jaringan',
            'user_id' => '195904241986021002',
            'level' => 'DOSEN',
            'email' => 'kabid.infraja@gmail.com',
            'role' => 'KABID',
            'password' => Hash::make('pass1234')
        ]);
        $kabid2 = User::create([
            'name' => 'Kabid Sistem Informasi',
            'user_id' => '198101122005011002',
            'level' => 'DOSEN',
            'email' => 'kabid.sisfo@gmail.com',
            'role' => 'KABID',
            'password' => Hash::make('pass1234')
        ]);
        $kabid3 = User::create([
            'name' => 'Kabid Diklat, Wirausaha dan Multimedia',
            'user_id' => '197812072005012001',
            'level' => 'DOSEN',
            'email' => 'kabid.dwm@gmail.com',
            'role' => 'KABID',
            'password' => Hash::make('pass1234')
        ]);
        Kabid::create([
            'user_id' => $kabid1->id,
            'category_id' => 1
        ]);
        Kabid::create([
            'user_id' => $kabid2->id,
            'category_id' => 2
        ]);
        Kabid::create([
            'user_id' => $kabid3->id,
            'category_id' => 3
        ]);
    }
}
