<?php

namespace App\Traits;

use App\Models\AttrCriteria;
use Carbon\Carbon;

trait WithDataTable
{

    public function get_atribut_kriteria($kode, $kriteria)
    {
        if ($kode == 'C2') {
            $kriteria = min($kriteria, 8);
            $kriteria = $kriteria . ' HARI';
        }
        $atribut_kriteria = AttrCriteria::where(['kode' => $kode, 'kriteria' => $kriteria])->value('bobot');
        return $atribut_kriteria;
    }

    public function get_prioritas_dengan_spk($reports)
    {
        $kriteria = collect([
            'C1' => [
                'nama' => 'Asal Aduan',
                'bobot' => 4,
            ],
            'C2' => [
                'nama' => 'Deadline',
                'bobot' => 5,
            ],
        ]);
        $jumlah_bobot = $kriteria['C1']['bobot'] + $kriteria['C2']['bobot'];
        $bobot_kepentingan = collect([
            'C1' => $kriteria['C1']['bobot'] / $jumlah_bobot,
            'C2' => $kriteria['C2']['bobot'] / $jumlah_bobot,
        ]);
        $matriks = collect([]);
        $today = Carbon::now();
        for ($i = 0; $i < $reports->count(); $i++) {
            $deadline = Carbon::parse($reports[$i]->tanggal);
            $matriks['A' . $i + 1] = [
                'ID' => $reports[$i]->id,
                'C1' => $this->get_atribut_kriteria('C1', $reports[$i]->user->level),
                'C2' => $this->get_atribut_kriteria('C2', $deadline->diff($today)->days + 1)
            ];
        }

        $c1Max = $matriks->pluck('C1')->max();
        $c1Min = $matriks->pluck('C1')->min();
        if ($c1Max - $c1Min == 0) {
            $c1Min = 0;
        }
        $c2Max = $matriks->pluck('C2')->max();
        $c2Min = $matriks->pluck('C2')->min();
        if ($c2Max - $c2Min == 0) {
            $c2Min = 0;
        }

        $normalisasi = collect([]);
        foreach ($matriks as $key => $value) {
            $normalisasi[$key] = [
                'C1' => ($matriks[$key]['C1'] - $c1Min) / ($c1Max - $c1Min),
                'C2' => ($matriks[$key]['C2'] - $c2Min) / ($c2Max - $c2Min)
            ];
        }

        $prefensi = collect([]);
        foreach ($normalisasi as $key => $value) {
            $nilai = ($bobot_kepentingan['C1'] * $normalisasi[$key]['C1']) + ($bobot_kepentingan['C2'] * $normalisasi[$key]['C2']);
            if ($nilai >= 0.8) {
                $kategori = 'Sangat Urgen';
            } elseif ($nilai >= 0.6) {
                $kategori = 'Urgen';
            } elseif ($nilai >= 0.4) {
                $kategori = 'Cukup Urgen';
            } elseif ($nilai >= 0.2) {
                $kategori = 'Kurang Urgen';
            } else {
                $kategori = 'Tidak Urgen';
            }
            $prefensi[$key] = [
                'nilai' => $nilai,
                'kategori' => $kategori
            ];
        }

        $reports->getCollection()->transform(function ($item, $key) use ($prefensi) {
            $item->urutan = $key + 1;
            $item->prioritas = $prefensi['A' . ($key + 1)]['kategori'];
            $item->prefensi = $prefensi['A' . ($key + 1)]['nilai'];

            return $item;
        });

        $reports->setCollection($reports->getCollection()->sortByDesc(function ($item) use ($prefensi) {
            return $prefensi['A' . $item->urutan]['nilai'];
        }));

        $reports->setCollection($reports->getCollection());

        return $reports;
    }

    public function get_pagination_data()
    {
        switch ($this->name) {
            case 'user':
                $users = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.user',
                    "users" => $users,
                    "data" => array_to_object([
                        'actions' => [
                            [
                                'route' => route('user.new'),
                                'text' => 'Buat User Baru',
                                'btn_color' => 'primary',
                                'icon' => 'fas fa-plus',
                                'is_used' => true
                            ],
                            [
                                'route' => route('export.user'),
                                'text' => 'Export',
                                'btn_color' => 'success',
                                'icon' => 'fas fa-file-export',
                                'is_used' => true
                            ]
                        ]
                    ])
                ];

            case 'pengaduan':
                $reports = $this->get_prioritas_dengan_spk(
                    $this->model::search($this->search)
                        ->where('jenis', 'Pengaduan')
                        ->when($this->selectedCategory, function ($query) {
                            return $query->where('kategori', $this->selectedCategory);
                        })
                        ->with('user', 'history', 'chat')
                        ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                        ->paginate($this->perPage)
                );

                return [
                    "view" => 'livewire.table.pengaduan',
                    "reports" => $reports,
                    "data" => array_to_object([
                        'actions' => []
                    ])
                ];

            case 'permintaan':
                $reports = $this->get_prioritas_dengan_spk(
                    $this->model::search($this->search)
                        ->where('jenis', 'Permintaan')
                        ->when($this->selectedCategory, function ($query) {
                            return $query->where('kategori', $this->selectedCategory);
                        })
                        ->with('user', 'history', 'chat')
                        ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                        ->paginate($this->perPage)
                );

                return [
                    "view" => 'livewire.table.permintaan',
                    "reports" => $reports,
                    "data" => array_to_object([
                        'actions' => []
                    ])
                ];

            case 'saran':
                $reports = $this->model::search($this->search)
                    ->where('jenis', 'Saran')
                    ->when($this->selectedCategory, function ($query) {
                        return $query->where('kategori', $this->selectedCategory);
                    })
                    ->with('user', 'history', 'chat')
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.saran',
                    "reports" => $reports,
                    "data" => array_to_object([
                        'actions' => []
                    ])
                ];

            case 'laporan':
                $reports = $this->model::search($this->search)
                    ->with('history')
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.laporan',
                    "reports" => $reports,
                    "data" => array_to_object([
                        'actions' => [
                            [
                                'route' => route('export.laporan'),
                                'text' => 'Export',
                                'btn_color' => 'success',
                                'icon' => 'fas fa-file-export',
                                'is_used' => true
                            ]
                        ]
                    ])
                ];

            case 'dashboard':
                $reports = $this->get_prioritas_dengan_spk(
                    $this->model::search($this->search)
                        ->when($this->selectedCategory, function ($query) {
                            return $query->where('kategori', $this->selectedCategory);
                        })
                        ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                        ->paginate($this->perPage)
                );

                return [
                    "view" => 'livewire.table.dashboard',
                    "reports" => $reports,
                    "data" => array_to_object([
                        'actions' => []
                    ])
                ];
                break;

            case 'feedback':
                $feedbacks = $this->model::search($this->search)
                    ->with('user', 'report')
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.feedback',
                    "feedbacks" => $feedbacks,
                    "data" => array_to_object([
                        'actions' => [
                            // [
                            //     'route' => route('export.feedback'),
                            //     'text' => 'Export',
                            //     'btn_color' => 'success',
                            //     'icon' => 'fas fa-file-export',
                            //     'is_used' => true
                            // ]
                        ]
                    ])
                ];

            default:
                # code...
                break;
        }
    }
}
