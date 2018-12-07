<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visitor;
class VisitorController extends Controller
{
    //function to list all visitors
    public function index()
    {

        $visitors = VISITOR::all();

        return view('visitors.index') -> with([
            'visitors' => $visitors
        ]);
    }

    // function to display the form to create a boat
    public function create()
    {
        return view('visitors.create');
    }

//function to takek the form data and put it in the db. return to list of baots
    public function store(Request $request)
    {
    $visitor = new Visitor();
    $visitor->group_leader_name = $request->group_leader_name;
    $visitor->group_size = $request->group_size;
    $visitor->email = $request->email;
    $visitor->save();


        return redirect('/visitors');
    }
}
