<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RiderController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\PublicController;

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
})->name('home');

Route::get('/about', function () {
    return view('about');
});

Route::get('/riders', [PublicController::class, 'riders'])->name('public.riders');
Route::get('/stages', [PublicController::class, 'stages'])->name('public.stages');

Route::get('/directory', [PublicController::class, 'directory'])->name('public.directory');


require __DIR__.'/auth.php';
Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    // Dashboard - accessible to all authenticated users
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/riders', [ReportController::class, 'riders'])->name('reports.riders');
    Route::get('/reports/stages', [ReportController::class, 'stages'])->name('reports.stages');
    Route::get('/reports/statistics', [ReportController::class, 'statistics'])->name('reports.statistics');

    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::get('/settings/profile', [SettingsController::class, 'profile'])->name('settings.profile');
    Route::put('/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile.update');
    Route::get('/settings/security', [SettingsController::class, 'security'])->name('settings.security');
    Route::put('/settings/security', [SettingsController::class, 'updatePassword'])->name('settings.security.update');
    Route::get('/settings/system', [SettingsController::class, 'system'])->name('settings.system');
    Route::put('/settings/system', [SettingsController::class, 'updateSystem'])->name('settings.system.update');

    // Riders (viewers)
    Route::get('/riders', [RiderController::class, 'index'])->name('riders.index');

    // Create/edit riders (operators/admins)
    Route::get('/riders/create', [RiderController::class, 'create'])->name('riders.create');
    Route::post('/riders', [RiderController::class, 'store'])->name('riders.store');
    Route::get('/riders/{rider}/edit', [RiderController::class, 'edit'])->name('riders.edit');
    Route::put('/riders/{rider}', [RiderController::class, 'update'])->name('riders.update');

    Route::get('/riders/{rider}', [RiderController::class, 'show'])->name('riders.show');

    // Operators can manage stages (except destroy)
    Route::middleware(['operator'])->group(function () {
        Route::resource('stages', StageController::class)->except(['destroy']);
    });

    // Admin only routes
    Route::middleware(['admin'])->group(function () {
        Route::delete('/riders/{rider}', [RiderController::class, 'destroy'])->name('riders.destroy');
        Route::patch('/riders/{rider}/approve', [RiderController::class, 'approve'])->name('riders.approve');
        Route::patch('/riders/{rider}/suspend', [RiderController::class, 'suspend'])->name('riders.suspend');
        Route::delete('/stages/{stage}', [StageController::class, 'destroy'])->name('stages.destroy');

        // User management
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});
