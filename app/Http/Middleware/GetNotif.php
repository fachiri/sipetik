<?php

namespace App\Http\Middleware;

use App\Models\Assignment;
use App\Models\Report;
use App\Models\Teknisi;
use Carbon\Carbon;
use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class GetNotif
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role == 'KABID') {
            $notifications = [];

            if (auth()->user()->role == 'KABID') {
                $category = auth()->user()->kabid->category;
                $reports = Report::where('kategori', $category->name)->with('history')->get();
                
                foreach ($reports as $report) {
                    if ($report->history[count($report->history)-1]->status == 'Tulis Laporan') {
                        $notifications[] = (object)[
                            'message' => 'Pengaduan Baru Telah Masuk',
                            'time' => $report->created_at->diffForHumans(),
                            'type' => 'alert',
                            'link' => route(strtolower($report->jenis) . '.edit', $report->report_id)
                        ];
                    }
                }
            }

            // if (auth()->user()->role == 'TEKNISI') {
            //     $assignments = Assignment::where('teknisi_id', auth()->user()->teknisi->id)
            //         ->where('status', 'NOT_WORKING')
            //         ->orWhere('status', 'WORKING')
            //         ->get();

            //     foreach ($assignments as $assignment) {
            //         $diffInHours = $assignment->updated_at->diffInHours($now);

            //         // Jika selisih waktu >= 12 jam, tambahkan notifikasi
            //         if ($diffInHours >= 12) {
            //             $notifications[] = (object)[
            //                 'message' => 'Pekerjaan belum diselesaikan dalam 12 jam.',
            //                 'time' => $assignment->updated_at->diffForHumans(),
            //                 'type' => 'alert',
            //                 'link' => route(strtolower($assignment->report->jenis) . '.edit', $assignment->report->report_id)
            //             ];
            //         }
            //     }
            // }

            session(['notifications' => $notifications]);
        }


        return $next($request);
    }
}
