<?php

use App\Http\Controllers\ReceitaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('receitas.index');
});

// Rotas de Receitas
Route::get('/receitas', [ReceitaController::class, 'index'])->name('receitas.index');
Route::get('/receitas/criar', [ReceitaController::class, 'create'])->name('receitas.create');
Route::post('/receitas', [ReceitaController::class, 'store'])->name('receitas.store');
Route::get('/receitas/{id}', [ReceitaController::class, 'show'])->name('receitas.show');
Route::get('/receitas/{id}/editar', [ReceitaController::class, 'edit'])->name('receitas.edit');
Route::put('/receitas/{id}', [ReceitaController::class, 'update'])->name('receitas.update');
Route::delete('/receitas/{id}', [ReceitaController::class, 'destroy'])->name('receitas.destroy');
Route::get('/buscar', [ReceitaController::class, 'search'])->name('receitas.search');
