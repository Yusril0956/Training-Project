<?php

namespace App\Http\Controllers;

use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function events()
    {
        $events = Schedule::all()->map(function ($schedule) {
            return [
                'id'    => $schedule->id,
                'title' => $schedule->title,
                'start' => $schedule->date . 'T' . $schedule->start_time,
                'end'   => $schedule->date . 'T' . $schedule->end_time,
            ];
        });

        return response()->json($events);
    }
}
