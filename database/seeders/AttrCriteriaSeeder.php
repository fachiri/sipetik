<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AttrCriteria;

class AttrCriteriaSeeder extends Seeder
{
    public function run()
    {
        AttrCriteria::create([
            'kode' => 'C1',
            'kriteria' => 'REKTORAT',
            'bobot' => 9,
        ]);
        AttrCriteria::create([
            'kode' => 'C1',
            'kriteria' => 'UPT',
            'bobot' => 8,
        ]);
        AttrCriteria::create([
            'kode' => 'C1',
            'kriteria' => 'FAKULTAS',
            'bobot' => 6,
        ]);
        AttrCriteria::create([
            'kode' => 'C1',
            'kriteria' => 'JURUSAN',
            'bobot' => 5,
        ]);
        AttrCriteria::create([
            'kode' => 'C1',
            'kriteria' => 'PRODI',
            'bobot' => 5,
        ]);
        AttrCriteria::create([
            'kode' => 'C1',
            'kriteria' => 'ORMAWA',
            'bobot' => 5,
        ]);
        AttrCriteria::create([
            'kode' => 'C1',
            'kriteria' => 'DOSEN',
            'bobot' => 4,
        ]);
        AttrCriteria::create([
            'kode' => 'C1',
            'kriteria' => 'MAHASISWA',
            'bobot' => 2,
        ]);
        AttrCriteria::create([
            'kode' => 'C2',
            'kriteria' => '1 HARI',
            'bobot' => 10,
        ]);
        AttrCriteria::create([
            'kode' => 'C2',
            'kriteria' => '2 HARI',
            'bobot' => 8,
        ]);
        AttrCriteria::create([
            'kode' => 'C2',
            'kriteria' => '3 HARI',
            'bobot' => 7,
        ]);
        AttrCriteria::create([
            'kode' => 'C2',
            'kriteria' => '4 HARI',
            'bobot' => 6,
        ]);
        AttrCriteria::create([
            'kode' => 'C2',
            'kriteria' => '5 HARI',
            'bobot' => 5,
        ]);
        AttrCriteria::create([
            'kode' => 'C2',
            'kriteria' => '6 HARI',
            'bobot' => 4,
        ]);
        AttrCriteria::create([
            'kode' => 'C2',
            'kriteria' => '7 HARI',
            'bobot' => 3,
        ]);
        AttrCriteria::create([
            'kode' => 'C2',
            'kriteria' => '8 HARI',
            'bobot' => 2,
        ]);
    }
}
