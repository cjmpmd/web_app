<?php

use App\Http\Controllers\ATSController;
use Illuminate\Routing\Controllers\Middleware;
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


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
Route::group(['prefix' => 'ATS'], function () {
    Route::get('/', [ATSController::class, 'index'])->name('ats_index');
    Route::post('/evaluate', [ATSController::class, 'evaluate'])->name('ats_evaluate');
    Route::post('/show', [ATSController::class, 'show'])->name('ats_show');
    Route::patch('/update', [ATSController::class, 'update'])->name('ats_update');
    Route::post('/destroy', [ATSController::class, 'destroy'])->name('ats_destroy');
});
