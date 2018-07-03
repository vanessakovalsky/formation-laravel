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

Route::get('/welcome', 'WelcomeController@welcome');

Route::get('/welcome/{id}', 'WelcomeController@show')->where('id','[0-9]+')->middleware('auth');

Route::resources([
  'pronostic' => 'PronosticController',
  'game' => 'GameController'
]);

Route::resource('pronostic', 'PronosticController')->only([
    'create', 'edit'
])->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
