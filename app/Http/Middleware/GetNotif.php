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
        $now = Carbon::now();

        if (auth()->user()->role == 'KABID' || auth()->user()->role == 'TEKNISI') {
            $notifications = [];

            if (auth()->user()->role == 'KABID') {
                $category = auth()->user()->kabid->category;
                $teknisis = Teknisi::where('category_id', $category->id)->get();
                $assignments = [];

                foreach ($teknisis as $teknisi) {
                    // dump($teknisi->user_id);
                    $assignments[] = Assignment::where('teknisi_id', $teknisi->id)
                        ->where('status', 'NOT_WORKING')
                        ->get();
                }

                $mergedAssignments = new Collection();
                foreach ($assignments as $array) {
                    $mergedAssignments = $mergedAssignments->merge($array);
                }

                foreach ($mergedAssignments as $assignment) {
                    $diffInHours = $assignment->updated_at->diffInHours($now);

                    // Jika selisih waktu >= 12 jam, tambahkan notifikasi
                    if ($diffInHours >= 12) {
                        $notifications[] = (object)[
                            'message' => 'Pekerjaan belum diselesaikan dalam 12 jam.',
                            'time' => $assignment->updated_at->diffForHumans(),
                            'type' => 'alert',
                            'link' => route(strtolower($assignment->report->jenis) . '.edit', $assignment->report->report_id)
                        ];
                    }
                }
            }

            if (auth()->user()->role == 'TEKNISI') {
                $assignments = Assignment::where('teknisi_id', auth()->user()->teknisi->id)
                    ->where('status', 'NOT_WORKING')
                    ->get();

                foreach ($assignments as $assignment) {
                    $diffInHours = $assignment->updated_at->diffInHours($now);

                    // Jika selisih waktu >= 12 jam, tambahkan notifikasi
                    if ($diffInHours >= 12) {
                        $notifications[] = (object)[
                            'message' => 'Pekerjaan belum diselesaikan dalam 12 jam.',
                            'time' => $assignment->updated_at->diffForHumans(),
                            'type' => 'alert',
                            'link' => route(strtolower($assignment->report->jenis) . '.edit', $assignment->report->report_id)
                        ];
                    }
                }
            }

            session(['notifications' => $notifications]);
        }


        return $next($request);
    }
}
