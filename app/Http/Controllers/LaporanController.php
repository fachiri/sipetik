<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use App\Models\Category;
use Dompdf\Dompdf;
use Dompdf\Options;
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

    public function export_laporan()
    {
        $reports = Report::with('history')->get();
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->setPaper('Legal', 'portrait');
        $html = view('pdf.laporan')
            ->with('reports', $reports)
            ->render();
        $dompdf->loadHtml($html);
        $dompdf->render();
        $filename = 'Reports_'.date('dmY_His').'.pdf';
        return $dompdf->stream($filename);
    }

    public function export_user()
    {
        $users = User::all();
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->setPaper('A4', 'portrait');
        $html = view('pdf.user')
            ->with('users', $users)
            ->render();
        $dompdf->loadHtml($html);
        $dompdf->render();
        $filename = 'Users_'.date('dmY_His').'.pdf';
        return $dompdf->stream($filename);
    }
}
