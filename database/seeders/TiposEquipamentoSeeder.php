<?php

namespace Database\Seeders;

use App\Models\TipoEquipamento;
use Illuminate\Database\Seeder;

class TiposEquipamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos = [
            'Computador',
            'Monitor',
            'Nobreak',
            'Scanner',
            'Impressora',
            'Outro',
        ];

        foreach ($tipos as $nome) {
            TipoEquipamento::updateOrCreate(
                ['nome' => $nome],
                ['ativo' => true]
            );
        }
    }
}
