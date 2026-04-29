<?php

use App\Http\Controllers\CidadeComarcaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EquipamentoController;
use App\Http\Controllers\EquipamentoLevantamentoController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\SetorController;
use App\Http\Controllers\TipoEquipamentoController;
use App\Http\Controllers\VaraController;
use Illuminate\Support\Facades\Route;

Route::get('/', DashboardController::class)->name('dashboard');

Route::resource('equipamentos', EquipamentoController::class);

Route::get('equipamentos-levantamento', [EquipamentoLevantamentoController::class, 'index'])
    ->name('equipamentos.levantamento');
Route::post('equipamentos-levantamento', [EquipamentoLevantamentoController::class, 'store'])
    ->name('equipamentos.levantamento.store');
Route::get('equipamentos-levantamento/verificar-codigo/{codigo}', [EquipamentoLevantamentoController::class, 'verificarCodigo'])
    ->name('equipamentos.levantamento.verificar-codigo');

Route::resource('tipos-equipamento', TipoEquipamentoController::class);
Route::resource('marcas', MarcaController::class);
Route::resource('cidades-comarcas', CidadeComarcaController::class);
Route::resource('varas', VaraController::class);
Route::resource('setores', SetorController::class);
