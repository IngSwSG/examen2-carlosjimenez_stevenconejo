<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaterialController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('materiales')->group(function () {
    Route::post('/', [MaterialController::class, 'store'])->name('materiales.store');
    Route::get('/', [MaterialController::class, 'index'])->name('materiales.index');
    Route::get('/{codigo}', [MaterialController::class, 'show'])->name('materiales.show');
}); 