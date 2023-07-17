<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Category;
use Exception;

class LaporanController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('pages.laporan.laporan-data')->with([
            'categories' => $categories,
            'reports' => Report::class
        ]);
    }
}
