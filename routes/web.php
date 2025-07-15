<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role_or_permission:Administrator|Operator'])->group(function () {
    Route::get('/kecamatan', [ConfigController::class, 'index'])->name('kecamatan.index');
    Route::put('/kecamatan/{kecamatan}', [ConfigController::class, 'update'])->name('kecamatan.update');
});

Route::middleware(['auth', 'role:Administrator'])->group(function () {
    // Settings -> Users
    Route::get('/settings/applications', [ApplicationController::class, 'index'])->name('application.index');
    Route::put('/settings/applications/{application}', [ApplicationController::class, 'update'])->name('application.update');
    // // Settings -> Menus
    Route::post('/settings/menus/update-status/{id}', [MenuController::class, 'updateStatus'])->name('settings.menus.update-status')->middleware('can:menus status');
    Route::post('/settings/menus/{id}/update-urutan/{direction}', [MenuController::class, 'updateUrutan'])->name('menus.update-urutan');
    Route::resource('/settings/menus', MenuController::class);
    // Settings -> Roles
    Route::resource('/settings/roles', RoleController::class);
    // // Settings -> Permission
    Route::resource('/settings/permission', PermissionController::class);
    // // Settings -> Users
    Route::resource('/settings/users', UserController::class);
});

require __DIR__ . '/auth.php';
