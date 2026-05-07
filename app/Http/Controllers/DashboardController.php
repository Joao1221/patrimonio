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
        $cidadeId = auth()->user()->cidade_comarca_id;

        $totalEquipamentos = Equipamento::when($cidadeId, fn($q) => $q->where('cidade_comarca_id', $cidadeId))
            ->count();

        $totaisPorTipo = TipoEquipamento::withCount(['equipamentos' => fn($q) =>
            $q->when($cidadeId, fn($q) => $q->where('cidade_comarca_id', $cidadeId))
        ])->orderBy('nome')->get();

        $totaisPorCidade = CidadeComarca::withCount(['equipamentos' => fn($q) =>
            $q->when($cidadeId, fn($q) => $q->where('cidade_comarca_id', $cidadeId))
        ])->when($cidadeId, fn($q) => $q->where('id', $cidadeId))
          ->orderBy('nome')->get();

        $ultimosEquipamentos = Equipamento::with(['tipoEquipamento', 'cidadeComarca', 'setor'])
            ->when($cidadeId, fn($q) => $q->where('cidade_comarca_id', $cidadeId))
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
