<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayerController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('players', [PlayerController::class, 'apiindex']);
Route::post('players', [PlayerController::class, 'apistore']);
Route::get('players/{id}', [PlayerController::class, 'show']);
Route::get('players/{id}/edit', [PlayerController::class, 'editapi']);
Route::put('players/{id}/edit', [PlayerController::class, 'updateapi']);
Route::delete('players/{id}/delete', [PlayerController::class, 'destroy']);
Route::patch('players/{id}/edit', [PlayerController::class, 'updateapi1']);