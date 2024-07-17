<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CheckExamStatus
{
    public function handle($request, Closure $next)
    {
        $exam = $request->route()->parameter('exam');

        // Calculate end time
        $endTime = Carbon::parse($exam->start_time)->addMinutes($exam->duration);

        // Check if exam status is not published or time is over
        if ($exam->status !== 'published' || Carbon::now()->gt($endTime)) {
            return redirect()->route('students.exams.index')->with('error', 'You cannot access this exam.');
        }

        return $next($request);
    }
}

