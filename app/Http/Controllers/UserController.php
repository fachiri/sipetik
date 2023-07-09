<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;

class UserController extends Controller
{
    public function index_view ()
    {
        return view('pages.user.user-data', [
            'categories' => false,  
            'user' => User::class,
        ]);
    }
}
