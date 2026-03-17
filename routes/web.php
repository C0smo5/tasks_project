<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\RoomRequestController;


Route::get('/aguardando', function () {
    return view('auth.aguardando');
    })->middleware('auth')->name('aguardando');

Route::get('/room-requests/status', function () {
    $aprovado = \App\Models\RoomRequest::where('user_id', auth()->id())
        ->where('status', 'aprovado')
        ->exists();

    return response()->json(['aprovado' => $aprovado]);
})->middleware('auth')->name('room-requests.status');

Route::get('/room-requests/pendentes', function () {
    $pendentes = \App\Models\RoomRequest::with('user')
        ->whereHas('room', function($q) {
            $q->whereHas('users', function($q2) {
                $q2->where('users.id', auth()->id());
            });
        })
        ->where('status', 'pendente')
        ->get();

    return response()->json($pendentes);
})->middleware('auth')->name('room-requests.pendentes');

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
