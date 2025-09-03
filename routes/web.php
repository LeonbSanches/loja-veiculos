<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VeiculoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RelatorioController;
use Illuminate\Support\Facades\Route;

// Página inicial - veículos disponíveis (público)
Route::get('/', [VeiculoController::class, 'disponiveis'])->name('home');

// Dashboard principal
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Rotas autenticadas
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Veículos
    Route::resource('veiculos', VeiculoController::class);
    Route::post('veiculos/{veiculo}/alterar-status', [VeiculoController::class, 'alterarStatus'])->name('veiculos.alterar-status');
    Route::post('veiculos/{veiculo}/adicionar-foto', [VeiculoController::class, 'adicionarFoto'])->name('veiculos.adicionar-foto');
    Route::delete('veiculos/{veiculo}/fotos/{foto}', [VeiculoController::class, 'removerFoto'])->name('veiculos.remover-foto');
    Route::post('veiculos/{veiculo}/fotos/{foto}/principal', [VeiculoController::class, 'definirFotoPrincipal'])->name('veiculos.foto-principal');
    Route::get('veiculos-dashboard', [VeiculoController::class, 'dashboard'])->name('veiculos.dashboard');
    Route::get('api/veiculos/buscar', [VeiculoController::class, 'buscar'])->name('api.veiculos.buscar');

    // Clientes
    Route::resource('clientes', ClienteController::class);
    Route::get('clientes-dashboard', [ClienteController::class, 'dashboard'])->name('clientes.dashboard');
    Route::get('api/clientes/buscar', [ClienteController::class, 'buscar'])->name('api.clientes.buscar');
    Route::get('api/clientes/buscar-cpf', [ClienteController::class, 'buscarPorCpf'])->name('api.clientes.buscar-cpf');

    // Vendas
    Route::resource('vendas', VendaController::class);
    Route::get('vendas-dashboard', [VendaController::class, 'dashboard'])->name('vendas.dashboard');
    Route::get('vendas-relatorio', [VendaController::class, 'relatorio'])->name('vendas.relatorio');
    Route::get('vendas-exportar', [VendaController::class, 'exportarRelatorio'])->name('vendas.exportar');
    Route::get('api/vendas/buscar', [VendaController::class, 'buscar'])->name('api.vendas.buscar');

    // Relatórios
    Route::get('relatorios', [RelatorioController::class, 'index'])->name('relatorios.index');
    Route::get('relatorios/veiculos', [RelatorioController::class, 'veiculos'])->name('relatorios.veiculos');
    Route::get('relatorios/clientes', [RelatorioController::class, 'clientes'])->name('relatorios.clientes');
    Route::get('relatorios/vendas', [RelatorioController::class, 'vendas'])->name('relatorios.vendas');
});

require __DIR__.'/auth.php';
