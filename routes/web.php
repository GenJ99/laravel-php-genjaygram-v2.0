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

use App\Mail\NewUserWelcomeMail;

Auth::routes();

// Temporary route to see email user template:
Route::get('email', function () {
    return new NewUserWelcomeMail();
});

// Route for the Follow/Unfollow button
Route::post('/follow/{user}', 'FollowsController@store');

// Root route
Route::get('/', 'PostsController@index');

// IMPORTANT NOTE: Variable routes should come after static routes. For instance if
// the /p/create route comes after the /p/{post} route, the create route will throw
// a 404 error and never be accessed. 
Route::get('/p/create', 'PostsController@create');
Route::post('/p', 'PostsController@store');
Route::get('/p/{post}', 'PostsController@show');


Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
// Route shows edit form
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
// Route does the edit processing
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');
