<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => 'auth'], function () {
// Route for main home page
    Route::get('/', 'VisitorController@index');

// Route to show routes for a user
    Route::get('/visitors/{id}', 'VisitorController@show');

// edit routes
    # Edit a book
    Route::get('/visitors/{id}/edit', 'VisitorController@edit');  // get the data to edit
    Route::put('/visitors/{id}', 'VisitorController@update');  // update function

// schedule routes if we ever build admin
#Route::get('/schedules','ScheduleController@index');
#Route::post('/schedules','ScheduleController@store');
#Route::get('/schedules/create','ScheduleController@create');

// Visitor routes
// get a particular reservation  /visitors/id -> visitors.show

Route::get('/visitors','VisitorController@index');
Route::post('/visitors','VisitorController@store');
Route::get('/visitors/create','VisitorController@create');


// about route
Route::get('eichome', function () {
    return Redirect::to('http://www.eagleisland.org');
});



Route::any('/practice/{n?}', 'PracticeController@index');
});
Auth::routes();