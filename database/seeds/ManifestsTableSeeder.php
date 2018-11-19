<?php

use App\Manifest;
use App\Schedule;
use App\Visitor;
use Illuminate\Database\Seeder;

class ManifestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        // get visitors that need a ride. Do the largest groups first.
        $visitors = Visitor::where('need_a_boat_ride', '=', 1)->
        orderBy('group_size','desc')->get();
        // get a visitor
        foreach ($visitors as $visitor) {
            // $visitor->group_size is the capacity needed
            // find a trip from the Mainland that has the capacity
            // once a visitor has a schedule no need to look for more
            $found_schedule = false;

            // find the boat runs from the mainland that has capacity. use the ones with less room to save room
            // for big groups
            $from_schedules = Schedule::
            where('departure_location', '=', 'Mainland')->
            where('remaining_capacity', '>=', $visitor->group_size)->
            orderBy('remaining_capacity')->get();

            // are there any boats with room. If not I am just going to skip the record with a message
            if ($from_schedules->count() == 0) {
                echo('Could not find room from Mainland for ' . $visitor->group_leader_name . ' group of size ' . $visitor->group_size . PHP_EOL);
            } else {

                // find room from the return trip- must be later than the arrival
                foreach ($from_schedules as $from_schedule) {
                    if (!$found_schedule) {
                        // get the first record and use it. order by smallest capacity that works
                        $to_schedule = Schedule::
                        where('departure_location', '=', 'Service Dock')->
                        where('remaining_capacity', '>=', $visitor->group_size)->
                        where('departure_time', '>', $from_schedule->departure_time)->
                        orderBy('remaining_capacity')->first();
                        $found_return = false;
                        // as long as there is one boat run available schedule it.
                        if ($to_schedule) {
                            $found_return = true;

                            // add the record to manifest
                            $manifest = new Manifest;
                            $manifest->visitor_id = $visitor->id;
                            $manifest->from_boat_id = $from_schedule->id;
                            $manifest->to_boat_id = $to_schedule->id;

                            $manifest->save();
                            // update capacity on to and from schedule
                            $from_schedule->remaining_capacity = $from_schedule->remaining_capacity - $visitor->group_size;
                            $from_schedule->save();
                            $to_schedule->remaining_capacity = $to_schedule->remaining_capacity - $visitor->group_size;
                            $to_schedule->save();
                            break;
                        }
                    }
                }
                // no room on the return trip
                if (!$found_return) {
                    echo('Could not find room for ' . $visitor->group_leader_name . ' group of size ' . $visitor->group_size . PHP_EOL);
                }
            }
        }
    }
}

