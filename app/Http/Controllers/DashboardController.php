<?php

namespace App\Http\Controllers;

use App\Models\CidadeComarca;
use App\Models\Equipamento;
use App\Models\TipoEquipamento;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $totalEquipamentos = Equipamento::count();
        $totaisPorTipo = TipoEquipamento::withCount('equipamentos')->orderBy('nome')->get();
        $totaisPorCidade = CidadeComarca::withCount('equipamentos')->orderBy('nome')->get();
        $ultimosEquipamentos = Equipamento::with(['tipoEquipamento', 'cidadeComarca', 'setor'])
            ->latest()
            ->limit(10)
            ->get();

        return view('dashboard', compact(
            'totalEquipamentos',
            'totaisPorTipo',
            'totaisPorCidade',
            'ultimosEquipamentos'
        ));
    }
}
