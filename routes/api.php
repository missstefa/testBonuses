<?php

use App\Http\Controllers\BonusAccountController;
use App\Http\Controllers\BonusController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('bonus')->group(function () {
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::post('/{account}/store', [BonusController::class, 'store']);
    });

    Route::get('/{account}', [BonusController::class, 'index']);
    Route::get('/account/{account}', [BonusAccountController::class, 'show']);
});

