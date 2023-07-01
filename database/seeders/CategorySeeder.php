<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Infrastruktur Jaringan',
            'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur ipsam accusantium ratione assumenda laborum! Dignissimos voluptatum id maiores, quaerat dolorum facere nesciunt quos minus explicabo, inventore debitis vitae earum voluptas!',
        ]);
        Category::create([
            'name' => 'Sistem Informasi',
            'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur ipsam accusantium ratione assumenda laborum! Dignissimos voluptatum id maiores, quaerat dolorum facere nesciunt quos minus explicabo, inventore debitis vitae earum voluptas!',
        ]);
        Category::create([
            'name' => 'Diklat, Wirausaha dan Multimedia',
            'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur ipsam accusantium ratione assumenda laborum! Dignissimos voluptatum id maiores, quaerat dolorum facere nesciunt quos minus explicabo, inventore debitis vitae earum voluptas!',
        ]);
    }
}
