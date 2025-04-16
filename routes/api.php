<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModerateurController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CentreInteretController;

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

// Admin routes
Route::group(['prefix' => 'admin', 'middleware' => ['api']], function () {
    Route::get('/moderateurs', [AdminController::class, 'indexModerateurs'])->name('admin.moderateurs.index');

    Route::put('/moderateurs/{id}', [AdminController::class, 'update']);
    Route::delete('/moderateurs/{id}', [AdminController::class, 'destroy']);
    Route::post('/moderateurs/{id}/centres', [AdminController::class, 'attribuerCentres']);

});

// Moderateur routes
Route::group(['prefix' => 'moderateur', 'middleware' => ['api']], function () {
    Route::get('/profile', [ModerateurController::class, 'show'])->name('moderateur.profile');
    Route::apiResource('centres', CentreInteretController::class);
});
