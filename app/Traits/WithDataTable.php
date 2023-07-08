<?php

namespace App\Traits;


trait WithDataTable {
    
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
                                'route' => '#',
                                'text' => 'Export',
                                'btn_color' => 'success',
                                'icon' => 'fas fa-file-export',
                                'is_used' => true
                            ]
                        ]
                    ])
                ];
                break;

            case 'pengaduan':
                $reports = $this->model::search($this->search)
                    ->where('jenis', 'Pengaduan')
                    ->when($this->selectedCategory, function ($query) {
                        return $query->where('kategori', $this->selectedCategory);
                        })
                    ->with('user', 'history')
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.pengaduan',
                    "reports" => $reports,
                    "data" => array_to_object([
                        'actions' => []
                    ])
                ];
                break;

            case 'permintaan':
                $reports = $this->model::search($this->search)
                    ->where('jenis', 'Permintaan')
                    ->when($this->selectedCategory, function ($query) {
                        return $query->where('kategori', $this->selectedCategory);
                        })
                    ->with('user', 'history')
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.permintaan',
                    "reports" => $reports,
                    "data" => array_to_object([
                        'actions' => []
                    ])
                ];
                break;

            case 'saran':
                $reports = $this->model::search($this->search)
                    ->where('jenis', 'Saran')
                    ->when($this->selectedCategory, function ($query) {
                        return $query->where('kategori', $this->selectedCategory);
                        })
                    ->with('user', 'history')
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.saran',
                    "reports" => $reports,
                    "data" => array_to_object([
                        'actions' => []
                    ])
                ];
                break;

            default:
                # code...
                break;
        }
    }
}