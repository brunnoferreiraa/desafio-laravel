<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarefaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/tarefas', TarefaController::class);

    Route::post('/tarefas', [TarefaController::class, 'addTarefa'])->name('tarefas.store');

    Route::post('/tarefas/{tarefa}/toggle', [TarefaController::class, 'toggleStatus'])->name('tarefas.toggleStatus');
    
});

Route::middleware(['auth'])->group(function () {
    Route::resource('tarefas', TarefaController::class);
});


require __DIR__.'/auth.php';
