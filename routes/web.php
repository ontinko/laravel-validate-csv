<?php

use App\Http\Controllers\GamesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/upload');
});
Route::get('/upload', [GamesController::class, 'create']);
Route::post('/upload', [GamesController::class, 'store']);
Route::get('/validate', [GamesController::class, 'view_games']);
Route::post('/validate', [GamesController::class, 'validate_games']);
