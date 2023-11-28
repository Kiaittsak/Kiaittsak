<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\EmployeeController;
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
Route::get('add', [PlayerController::class, 'add']);
Route::get('/', [PlayerController::class, 'index']);
Route::get('tableplayer', [PlayerController::class, 'Showplayer']);
Route::post('/store', [PlayerController::class, 'store'])->name('store');
Route::get('/edit{id}', [PlayerController::class, 'edit'])->name('edit');
Route::post('/update{id}', [PlayerController::class, 'update'])->name('update');
Route::get('/player{id}', [PlayerController::class, 'delete'])->name('player.delete');
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
