<?php

use App\Http\Controllers\CidadeComarcaController;
use App\Http\Controllers\EquipamentoController;
use Illuminate\Support\Facades\Route;

Route::get('/cidades-comarcas/{id}/varas', [CidadeComarcaController::class, 'varas']);
Route::get('/equipamentos/stats', [EquipamentoController::class, 'stats']);
Route::get('/equipamentos/buscar-por-codigo/{codigo}', [EquipamentoController::class, 'buscarPorCodigo']);
Route::get('/equipamentos/verificar-codigo/{codigo}', [EquipamentoController::class, 'verificarCodigo']);
