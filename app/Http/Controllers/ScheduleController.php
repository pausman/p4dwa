<?php

namespace App\Http\Controllers;

use App\Boat;
use App\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    //function to list all schedules
    public function index()
    {
        $schedules = SCHEDULE::all();

        return view('schedules.index') -> with([
            'schedules' => $schedules
        ]);
    }

    // function to display the form to create a boat
    public function create()
    {
        $boats = BOAT::all();

        return view('schedules.create', compact('boats'));
    }

//function to takek the form data and put it in the db. return to list of baots. Validate goes here
    public function store(Request $request)
    {
        $schedule = new Schedule();
        $schedule->departure_location = $request->departure_location;
        $schedule->departure_time = $request->departure_time;
        $boat = BOAT::where('name', '=', $request->boat)->first();
        $schedule->boat_id = $boat->id;
        $schedule->remaining_capacity = $boat->capacity;
        $schedule->save();

        return redirect('/schedules');
    }//
}
