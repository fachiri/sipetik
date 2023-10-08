<?php

namespace App\Http\Middleware;

use App\Models\Report;
use Closure;
use Illuminate\Http\Request;

class GetFeedback
{
    public function handle(Request $request, Closure $next)
    {
        $reports = Report::where('user_id', auth()->user()->id)->with('history')->get();

        foreach ($reports as $report) {
            if ($report->history->last()->status == 'Selesai' && $report->feedback_status == 'PENDING') {
                session(['showFeedback' => $report]);
                return $next($request);
            }
        }
        
        session(['showFeedback' => null]);
        return $next($request);
    }
}
