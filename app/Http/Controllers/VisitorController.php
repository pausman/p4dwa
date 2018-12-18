<?php

namespace App\Http\Controllers;

use App\Schedule;
use App\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitorController extends Controller
{
    //function to list data for a particular user
    public function index(Request $request)
    {
        /*
         * show all the reservations for a user
         */

        // Get the user object
        $user = $request->user();
        $visitors = $user->visitors()->with('schedules')->get();

        return view('visitors.index')->with([
            'visitors' => $visitors
        ]);
    }

    public function show(Request $request, $id)
    {
        /*
         *   show a particular reservation($id) for a particular user
         */
        #  ** Get the user object
        $user = $request->user();
        $visitor = $user->visitors()->with('schedules')->find($id);
        return view('visitors.show')->with([
            'visitor' => $visitor
        ]);
    }


    public function edit(Request $request, $id)
    {
        /*
         *  get the data to put in the edit form
         */
        $user = $request->user();
        $visitor = $user->visitors()->with('schedules')->find($id);

        // get all schedules then use collection methods to get subsets
        $allschedules = Schedule::orderBy('departure_time')->get();

        // for drop down
        $groupsize = $visitor->group_size;
        $toschedules = $allschedules->where('departure_location', 'Mainland')
            ->filter(function ($value, $key) use ($groupsize) {
                return $value->remaining_capacity > $groupsize;
            });
        $fromschedules = $allschedules->where('departure_location', 'Service Dock')
            ->filter(function ($value, $key) use ($groupsize) {
                return $value->remaining_capacity > $groupsize;
            });

        // do a check to make sure the reservation exists
        if (!$visitor) {
            return redirect('/visitors')->with([
                'alert' => 'Reservation not found.'
            ]);
        }

        // put up the edit form
        return view('visitors.edit')->with([
            'visitor' => $visitor,
            'toschedules' => $toschedules,
            'fromschedules' => $fromschedules,
            'allschedules' => $allschedules,
        ]);
    }


    public function update(Request $request, $id)
    {
        /*
         *  Validates and saves the data from the edit form
         */

        // do easiest validation
        $this->validate($request, [
            'groupname' => 'required',
            'groupsize' => 'required|integer|min:1|max:15',
            'toschedule_id' => 'required',
            'fromschedule_id' => 'required',

        ]);

        /*
         *  Do additional validation.
         *  Some could be eliminated with client side javascript REST
         */
        $myErrors = [];
        $visitor = Visitor::with('schedules')->find($id);

        // Confirm this book belongs to this user
        if ($visitor->user->id != $request->user()->id) {
            return redirect('/')->with([
                'alert' => 'Access denied.'
            ]);
        }

        // you cant leave before you arrive
        $toSchedule = Schedule::find($request->toschedule_id);
        $fromSchedule = Schedule::find($request->fromschedule_id);
        if ($toSchedule->departure_time > $fromSchedule->departure_time) {
            $myErrors["boattimes"] = "You are leaving before you arrive";

            return redirect('/visitors/' . $id . '/edit')->withErrors($myErrors)->withInput();
        }

        /*
         *  Validate new groupsize
         *  Code could be cleaner but using Javascript is the best solution so leaving it
         */
        $badGroupSize = false;
        $changedToSchedule = !($toSchedule->id === $visitor->schedules[0]->id);
        $changedFromSchedule = !($fromSchedule->id === $visitor->schedules[1]->id);

        // they changed the groupsize
        if ($visitor->group_size != $request->groupsize) {

            // did they NOT change the boat toschedule selection as well as the group size
            if (!$changedToSchedule) {

                // add back there old groupsize and see if there is room for the new group
                if ($toSchedule->remaining_capacity < $request->groupsize - $visitor->group_size) {
                    $badGroupSize = true;
                }

                // boat inschedule and group size were both changed
            } else {

                // is there rooml on their new inschedule selection
                if ($visitor->schedules[0]->remaining_capacity >
                    $toSchedule->remaining_capacity) {
                    $badGroupSize = true;
                }
            }

            // repeat for fromschedule
            // did they NOT change the boat toschedule selection as well as the group size
            if (!$changedFromSchedule) {
                // add back there old groupsize and see if there is room for the new group
                if ($fromSchedule->remaining_capacity < $request->groupsize - $visitor->group_size) {
                    $badGroupSize = true;
                }
                // boat fromschedule and group size were both changed
            } else {
                // is there room on their new fromschedule selection
                if ($visitor->schedules[1]->remaining_capacity >
                    $fromSchedule->remaining_capacity) {
                    $badGroupSize = true;
                }
            }
        }

        if ($badGroupSize) {
            $myErrors["groupsize"] = "Your group is too big for that boat run";

            return redirect('/visitors/' . $id . '/edit')->withErrors($myErrors)->withInput();
        }

        // okay groupsize works with everything so lets update that
        // add back to group size to the previous schedules

// find the schedule for this visiotrs 0 record
        $tempSchedule = Schedule::find($visitor->schedules[0]->id);

        $tempSchedule->remaining_capacity = $tempSchedule->remaining_capacity + $visitor->group_size;
        $tempSchedule->save();

        // subtract the new groupsize from the new schedules
        $tempSchedule = Schedule::find($toSchedule->id);

        $tempSchedule->remaining_capacity = $tempSchedule->remaining_capacity - $request->groupsize;
        $tempSchedule->save();

        // remove all group size from old (or same) schedule
        $tempSchedule = Schedule::find($visitor->schedules[1]->id);

        $tempSchedule->remaining_capacity = $tempSchedule->remaining_capacity + $visitor->group_size;
        $tempSchedule->save();

        // add the new groupsize to the new (or same) schedule
        // subtract the new groupsize from the new schedules
        $tempSchedule = Schedule::find($fromSchedule->id);

        $tempSchedule->remaining_capacity = $tempSchedule->remaining_capacity - $request->groupsize;
        $tempSchedule->save();

        $newschedules = [$request->toschedule_id, $request->fromschedule_id];
//  sync is random about the order  so I attach and detach by hand.
        $visitor->schedules()->detach();
        $visitor->schedules()->attach($newschedules);
        $visitor->group_name = $request->groupname;
        $visitor->group_size = $request->groupsize;
        $visitor->save();

        return redirect('/visitors/' . $id)->with([
            'alert' => 'Your reservation was updated',
        ]);;
    }

    /*
   * Asks user to confirm they actually want to delete the book
   * GET /visitors/{id}/delete
   */
    public function delete(Request $request, $id)
        /*
         * Asks user to confirm they actually want to delete the reservation
         */
    {
        $user = $request->user();
        $visitor = $user->visitors()->with('schedules')->find($id);

        // check to see it exists just in case
        if (!$visitor) {
            return redirect('/visitor')->with('alert', 'Visitor not found');
        }

        // call function to delete it
        return view('visitors.delete')->with([
            'visitor' => $visitor,
        ]);
    }

    public function destroy($id)
    {
        /*
         * Delete the reservation
         */
        $visitor = Visitor::find($id);

        // add the groupsize back to make it available
        $tempSchedule = Schedule::find($visitor->schedules[0]->id);
        $tempSchedule->remaining_capacity = $tempSchedule->remaining_capacity + $visitor->group_size;
        $tempSchedule->save();
        $tempSchedule = Schedule::find($visitor->schedules[1]->id);
        $tempSchedule->remaining_capacity = $tempSchedule->remaining_capacity + $visitor->group_size;
        $tempSchedule->save();

        // delete everything now
        $visitor->schedules()->detach();
        $visitor->delete();

        // show a list of remaining reservations with a confirmation message
        return redirect('/visitors')->with([
            'alert' => 'Your reservation was deleted',
        ]);
    }

    public function create(Request $request)
    {
        /*
         * Get the data needed for the create form
         */

        // route auth was having problems so I am going to check here
        if (Auth::guest()) {
            return redirect('/');
        }
        // get all schedules then use collection methods to get subsets
        $allschedules = Schedule::orderBy('departure_time')->get();

        // for dropdowns
        $toschedules = $allschedules->where('departure_location', 'Mainland');
        $fromschedules = $allschedules->where('departure_location', 'Service Dock');

        // call the create form
        return view('visitors.create')->with([
            'toschedules' => $toschedules,
            'fromschedules' => $fromschedules,
            'allschedules' => $allschedules,
        ]);
    }

    public function store(Request $request)
    {
        /*
         * Process the form for adding a new reservation
         */

        /*
        * Validates and saves the data from the edit form
        */

        // do easiest validation
        $request->validate([
            'groupname' => 'required',
            'groupsize' => 'required|integer|min:1|max:15',
            'toschedule_id' => 'required',
            'fromschedule_id' => 'required',

        ]);

        //; you cant leave before you arrive
        $toSchedule = Schedule::find($request->toschedule_id);
        $fromSchedule = Schedule::find($request->fromschedule_id);
        if ($toSchedule->departure_time > $fromSchedule->departure_time) {
            $myErrors["boattimes"] = "You are leaving before you arrive";

            return redirect('/visitors/create')->withErrors($myErrors)->withInput();
        }
        /*
         *  Validate groupsize
         *  Code could be cleaner but using Javascript is the best solution so leaving it
         */

        // check to see if there is room on the schedules they picked
        $badGroupSize = false;
        // is there room on the toschedule
        if ($toSchedule->remaining_capacity < $request->groupsize) {
            $badGroupSize = true;
        }

        // repeat for fromschedule
        if ($fromSchedule->remaining_capacity < $request->groupsize) {
            $badGroupSize = true;
        }

        if ($badGroupSize) {
            $myErrors["groupsize"] = "Your group is too big for that boat run";

            return redirect('/visitors/create')->withErrors($myErrors)->withInput();
        }

        // add the groupsize back to make it available
        $tempSchedule = Schedule::find($toSchedule->id);
        $tempSchedule->remaining_capacity = $tempSchedule->remaining_capacity - $request->groupsize;
        $tempSchedule->save();
        $tempSchedule = Schedule::find($fromSchedule->id);
        $tempSchedule->remaining_capacity = $tempSchedule->remaining_capacity - $request->groupsize;
        $tempSchedule->save();

        // save the reservation
        $visitor = new Visitor();
        $user = $request->user();
        $visitor->user_id = $request->user()->id;
        $visitor->group_name = $request->groupname;
        $visitor->group_size = $request->groupsize;
        $visitor->save();
        // save it so the id exists for the pivot table
        $newschedules = [$request->toschedule_id, $request->fromschedule_id];
           //  sync is random about the order  so I attach and detach by hand.
        $visitor->schedules()->attach($newschedules);
        $visitor->save();
        $id = $visitor->id;

        return redirect('/visitors')->with([
            'alert' => 'Your reservation has been created',
        ]);
    }
}
