<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\BienvenueController;
use App\Http\Controllers\CollectionController;

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

Route::get('/bienvenue/{name}', function (Request $request, $name) {
    return 'Bienvenue '.$name;
});

Route::get('/', [BienvenueController::class, 'index']);

Route::resource('jeux', JeuController::class);

Route::resource('collection', CollectionController::class);
