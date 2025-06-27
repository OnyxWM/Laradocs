<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProcedureController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::view('/', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('home');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
    Volt::route('settings/user-management', 'settings.user-management')->name('settings.user-management');
});

require __DIR__.'/auth.php';

Route::middleware('auth')->resource('posts', PostController::class);
Route::middleware('auth')->resource('posts.comments', CommentController::class);
Route::middleware('auth')->resource('procedures', ProcedureController::class);
Route::middleware('auth')->get('/procedures/department/{department:slug}', [ProcedureController::class, 'byDepartment'])
    ->name('procedures.by_department');

