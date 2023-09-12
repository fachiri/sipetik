<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index_view ()
    {
        return view('pages.user.user-data', [
            'categories' => false,
            'user' => User::class,
        ]);
    }

    public function user_edit ($userId)
    {
        $user = User::where('id', $userId)->first();
        return view("pages.user.user-edit", compact('user'));
    }

    public function user_update (Request $request, $userId)
    {
        try {
            $user = User::where('id', $userId)->first();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->save();
            return redirect(route('user.edit', $userId))
                ->with('success', 'Data berhasil diedit!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }
}
