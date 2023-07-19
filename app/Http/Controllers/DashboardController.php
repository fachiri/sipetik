<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Teknisi;
use App\Models\Category;
use Exception;

class DashboardController extends Controller
{
    public function index()
    {
        $total_pengaduan = Report::where('jenis', 'pengaduan')->count();
        $total_permintaan = Report::where('jenis', 'permintaan')->count();
        $total_saran = Report::where('jenis', 'saran')->count();
        $total_teknisi = Teknisi::count();
        $categories = Category::all();
        return view('dashboard')->with([
            'total_pengaduan' => $total_pengaduan,
            'total_permintaan' => $total_permintaan,
            'total_saran' => $total_saran,
            'total_teknisi' => $total_teknisi,
            'categories' => $categories,
            'reports' => Report::class
        ]);
    }

    public function public_dashboard()
    {
        $total_pengaduan = Report::where('jenis', 'pengaduan')->count();
        $total_permintaan = Report::where('jenis', 'permintaan')->count();
        $total_saran = Report::where('jenis', 'saran')->count();
        $total_teknisi = Teknisi::count();
        $categories = Category::all();
        return view('public.dashboard')->with([
            'total_pengaduan' => $total_pengaduan,
            'total_permintaan' => $total_permintaan,
            'total_saran' => $total_saran,
            'total_teknisi' => $total_teknisi,
            'categories' => $categories,
            'reports' => Report::class
        ]);
    }
}
