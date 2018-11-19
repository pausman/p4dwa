<?php

namespace App\Http\Controllers;

use App\Boat;

class PracticeController extends Controller
{
    //
    public function practice4()
    {
        # First get a boat to delete
        $boat = Boat::where('capacity', '=', 19)->first();

        if (!$boat) {
            dump('Did not delete- Boat not found.');
        } else {
            $boat->delete();
            dump('Deletion complete; check the database to see if it worked...');
        }
    }

    public function practice3()
    {
        # First get a boat to update
        $boat = Boat::where('id', '=', 3)->first();

        if (!$boat) {
            dump("Boat not found, can't update.");
        } else {
            # Change some properties
            $boat->capacity = 19;

            # Save the changes
            $boat->save();

            dump('Update complete; check the database to confirm the update worked.');
        }
    }
    public function practice2()
    {
        $boat = new Boat();
        $boats = $boat->where('name', 'LIKE', '%Ark%')->get();

        if ($boats->isEmpty()) {
            dump('No matches found');
        } else {
            foreach ($boats as $boat) {
                dump($boat->toArray());
            }
        }
    }
    public function practice1()
    {
        # Instantiate a new Boat Model
        $boat = new Boat();

        # Set the values for a recrod
        $boat->name = 'Ark';
        $boat->capacity = 15;

        # save the record in the boat table
        $boat->save();

        dump('Added: ' . $boat);
    }


    public function index($n = null)
    {
        $methods = [];

        # If no specific practice is specified, show index of all available methods
        if (is_null($n)) {
            # Build an array of all methods in this class that start with `practice`
            foreach (get_class_methods($this) as $method) {
                if (strstr($method, 'practice')) {
                    $methods[] = $method;
                }
            }

            # Load the view and pass it the array of methods
            return view('practice')->with(['methods' => $methods]);
        } # Otherwise, load the requested method
        else {
            $method = 'practice' . $n;

            # Invoke the requested method if it exists; if not, throw a 404 error
            return (method_exists($this, $method)) ? $this->$method() : abort(404);
        }
    }


}
