<?php

use App\Http\Controllers\Api\DataDesaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/test', [DataDesaController::class, 'index'])->name('test.index');
Route::middleware(['filter.null'])->group(function () {
    Route::post('/data-desa', [DataDesaController::class, 'store'])->name('data-desa.store');
});
