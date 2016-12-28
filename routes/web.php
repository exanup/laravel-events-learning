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


Route::get('/', function () {
    return view('welcome');
});


Route::get('/slack', function () {

    if ( ! ($user = auth()->user()) ) {
        auth()->loginUsingId(6);
    }

    auth()->user()->notify(new \App\Notifications\SlackNotification);

    if( ! $user) {
        auth()->logout();
    }

    session()->flash('level', 'success');
    session()->flash('msg', 'slack message sending job has been queued');

    return redirect('/');
});


Auth::routes();


Route::get('/home', 'HomeController@index');
