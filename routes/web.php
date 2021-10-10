<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;

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
Route::resource('inventory', InventoryController::class);
Route::get('inventory/{id}/edit/delete', [InventoryController::class, 'destroy_detail']);
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
