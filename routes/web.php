<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\RoomRequestController;


Route::get('/aguardando', function () {
    return view('auth.aguardando');
    })->middleware('auth')->name('aguardando');

Route::get('/dashboard', [TaskController::class, 'ListTasksDashboard'])
    ->middleware(['auth', 'verified', 'room.aprovado'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/tasks', [TaskController::class, 'store'])
    ->middleware(['auth','verified'])
    ->name('tasks.store');

Route::get('/chat', [ChatController::class, 'index'])
    ->middleware(['auth', 'verified', 'room.aprovado'])
    ->name('chat');


Route::middleware('auth')->group(function () {
    Route::post('/room-requests/{id}/aprovar', [RoomRequestController::class, 'aprovar'])->name('room-requests.aprovar');
    Route::post('/room-requests/{id}/recusar', [RoomRequestController::class, 'recusar'])->name('room-requests.recusar');
});

require __DIR__.'/auth.php';
