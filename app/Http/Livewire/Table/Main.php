<?php

namespace App\Http\Livewire\Table;

use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithDataTable;

class Main extends Component
{
    use WithPagination, WithDataTable;

    public $model;
    public $name;
    public $categories;

    public $perPage = 10;
    public $sortField = "id";
    public $sortAsc = false;
    public $search = '';
    public $selectedCategory = null;

    protected $listeners = [ "deleteItem" => "delete_item" ];

    public function mount($categories)
    {
        $this->categories = $categories;
    }

    public function filterByCategory($category)
    {
        $this->selectedCategory = $category;
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = ! $this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function delete_item ($id)
    {
        $data = $this->model::find($id);

        if (!$data) {
            $this->emit("deleteResult", [
                "status" => false,
                "message" => "Gagal menghapus data " . $this->name
            ]);
            return;
        }

        $data->delete();
        $this->emit("deleteResult", [
            "status" => true,
            "message" => "Data " . $this->name . " berhasil dihapus!"
        ]);
    }

    public function render()
    {
        if (auth()->user()->role == 'KABID') {
            $this->selectedCategory = auth()->user()->kabid->category->name;
        }
        if (auth()->user()->role == 'TEKNISI') {
            $this->selectedCategory = auth()->user()->teknisi->category->name;
        }
        $data = $this->get_pagination_data();
        return view($data['view'], $data);
    }
}
