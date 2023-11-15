<?php

use App\Http\Controllers\GetLastImportUserController;
use App\Http\Controllers\GetStatusImportUserController;
use App\Http\Controllers\ImportUserController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('import')->group(function () {
    Route::get('/{importId}/status', GetStatusImportUserController::class);
    Route::post('/run', ImportUserController::class);
    Route::get('/last/info', GetLastImportUserController::class);
});
