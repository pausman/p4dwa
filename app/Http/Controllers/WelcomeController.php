<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visitor;

class WelcomeController extends Controller
{
// show the welcome screen
    public function __invoke()
    {
        return view('welcome');
    }
}
