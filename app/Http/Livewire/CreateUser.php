<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Teknisi;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateUser extends Component
{
    public $user;
    public $userId;
    public $action;
    public $button;
    public $categories;

    protected function getRules()
    {
        $rules = ($this->action == "updateUser") ? [
            'user.email' => 'required|email|unique:users,email,' . $this->userId
        ] : [
            'user.password' => 'required|min:8|confirmed',
            'user.password_confirmation' => 'required',
            'user.role' => 'required',
            'user.level' => ($this->user && $this->user['role'] == 'TEKNISI') ? '' : 'required',
            'user.user_id' => ($this->user && $this->user['role'] == 'TEKNISI') ? '' : 'required',
        ];
        return array_merge([
            'user.name' => 'required|min:3',
            'user.email' => 'required|email|unique:users,email',
        ], $rules);
    }

    public function createUser ()
    {
        $this->resetErrorBag();
        $this->validate();

        $password = $this->user['password'];

        if ( !empty($password) ) {
            $this->user['password'] = Hash::make($password);
        }

        $createdUser = User::create([
            'user_id' => $this->user['user_id'] ?? null,
            'name' => $this->user['name'],
            'email' => $this->user['email'],
            'role' => $this->user['role'],
            'level' => $this->user['level'] ?? null,
            'password' => $this->user['password'],
        ]);

        if ($this->user['role'] == 'TEKNISI') {
            $category = null;
            if (isset($this->user['category']) && $this->user['category']) {
                $category = $this->user['category'];
            } else {
                if (auth()->user()->role == 'KABID') {
                    if (auth()->user()->kabid && auth()->user()->kabid->category) {
                        $category = auth()->user()->kabid->category->id;
                    }
                } else {
                    $category = 1;
                }
            }
            Teknisi::create([
                'category_id' => $category,
                'user_id' => $createdUser->id,
            ]);
        }

        $this->emit('saved');
        $this->reset('user');
    }

    public function updateUser ()
    {
        $this->resetErrorBag();
        $this->validate();

        User::query()
            ->where('id', $this->userId)
            ->update([
                "name" => $this->user->name,
                "email" => $this->user->email,
            ]);

        $this->emit('saved');
    }

    public function mount ()
    {
        if (!$this->user && $this->userId) {
            $this->user = User::find($this->userId);
        }

        $this->button = create_button($this->action, "User");
        $this->categories = Category::all();
    }

    public function render()
    {
        return view('livewire.create-user');
    }
}
