<?php

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

Auth::routes(['register' => false]);

// Route::get('/home',                         [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard',                    [App\Http\Controllers\AdviserController::class, 'dashboard'])->name('adviser.dashboard');
Route::get('/clients',                      [App\Http\Controllers\AdviserController::class, 'index'])->name('adviser.index');
Route::get('/client/create',                [App\Http\Controllers\AdviserController::class, 'create'])->name('adviser.create');
Route::post('/client/',                     [App\Http\Controllers\AdviserController::class, 'store'])->name('adviser.store');
Route::get('/client/{client}/edit',         [App\Http\Controllers\AdviserController::class, 'edit'])->name('adviser.edit');
Route::patch('/client/{client}',            [App\Http\Controllers\AdviserController::class, 'update'])->name('adviser.update');
Route::delete('/client/{client}',           [App\Http\Controllers\AdviserController::class, 'destroy'])->name('adviser.destroy');

Route::patch('/cashloan/{client}',          [App\Http\Controllers\AdviserController::class, 'cashLoan'])->name('adviser.cashloan');
Route::patch('/homeloan/{client}',          [App\Http\Controllers\AdviserController::class, 'homeLoan'])->name('adviser.homeloan');

Route::get('/reports',                      [App\Http\Controllers\AdviserController::class, 'reports'])->name('adviser.reports');