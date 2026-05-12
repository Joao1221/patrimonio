<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CidadeComarcaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EquipamentoController;
use App\Http\Controllers\EquipamentoLevantamentoController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SetorController;
use App\Http\Controllers\TipoEquipamentoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VaraController;
use Illuminate\Support\Facades\Route;

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Rotas protegidas
Route::middleware('auth')->group(function () {
    Route::pattern('equipamento', '[0-9]+');
    Route::pattern('tipos_equipamento', '[0-9]+');
    Route::pattern('marca', '[0-9]+');
    Route::pattern('cidades_comarca', '[0-9]+');
    Route::pattern('vara', '[0-9]+');
    Route::pattern('setore', '[0-9]+');
    Route::pattern('usuario', '[0-9]+');

    Route::get('/', DashboardController::class)->name('dashboard');

    // Perfil do usuário logado — acessível a todos os perfis
    Route::get('/perfil', [ProfileController::class, 'edit'])->name('perfil.edit');
    Route::put('/perfil', [ProfileController::class, 'update'])->name('perfil.update');

    // Leitura — todos os perfis autenticados
    Route::resource('equipamentos', EquipamentoController::class)->only(['index', 'show']);
    Route::resource('tipos-equipamento', TipoEquipamentoController::class)->only(['index', 'show']);
    Route::resource('marcas', MarcaController::class)->only(['index', 'show']);
    Route::resource('cidades-comarcas', CidadeComarcaController::class)->only(['index', 'show']);
    Route::resource('varas', VaraController::class)->only(['index', 'show']);
    Route::resource('setores', SetorController::class)->only(['index', 'show']);

    Route::get('equipamentos-levantamento', [EquipamentoLevantamentoController::class, 'index'])
        ->name('equipamentos.levantamento');
    Route::get('equipamentos-levantamento/verificar-codigo/{codigo}', [EquipamentoLevantamentoController::class, 'verificarCodigo'])
        ->name('equipamentos.levantamento.verificar-codigo');

    // Escrita — admin e master
    Route::middleware('papel:admin')->group(function () {
        Route::resource('equipamentos', EquipamentoController::class)->except(['index', 'show']);
        Route::post('equipamentos-levantamento', [EquipamentoLevantamentoController::class, 'store'])
            ->name('equipamentos.levantamento.store');
        Route::resource('tipos-equipamento', TipoEquipamentoController::class)->except(['index', 'show']);
        Route::resource('marcas', MarcaController::class)->except(['index', 'show']);
        Route::resource('cidades-comarcas', CidadeComarcaController::class)->except(['index', 'show']);
        Route::resource('varas', VaraController::class)->except(['index', 'show']);
        Route::resource('setores', SetorController::class)->except(['index', 'show']);
    });

    // Gestão de usuários — somente master
    Route::middleware('papel:master')->group(function () {
        Route::resource('usuarios', UserController::class)->except(['show']);
    });
});
