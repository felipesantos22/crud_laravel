<?php

use App\Http\Controllers\ClienteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/usuario', [ClienteController::class, 'createUser']);
Route::get('/usuario/{id}', [ClienteController::class, 'show']);
Route::get('/usuario', [ClienteController::class, 'findAll']);
Route::put('/usuario/{id}', [ClienteController::class, 'updateController']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
