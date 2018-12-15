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

Route::get('/visitors/create', 'VisitorController@create');
Route::group(['middleware' => 'auth'], function () {
// Route for main home page - view your reservation or create one
    Route::get('/', 'VisitorController@index');
    Route::get('/visitors', 'VisitorController@index');

// Route to show routes for a user
    Route::get('/visitors/{id}', 'VisitorController@show');

// edit routes
    # Edit a reservation
    Route::get('/visitors/{id}/edit', 'VisitorController@edit');  // get the data to edit
    Route::put('/visitors/{id}', 'VisitorController@update');  // update function

    # Delete a reservation
    Route::get('/visitors/{id}/delete', 'VisitorController@delete');
    Route::delete('/visitors/{id}', 'VisitorController@destroy');

# create reservation

    Route::post('/visitors', 'VisitorController@store');

#




// about route
    Route::get('eichome', function () {
        return Redirect::to('http://www.eagleisland.org');
    });


});
Auth::routes();