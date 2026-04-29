<?php

namespace Database\Seeders;

use App\Models\Setor;
use Illuminate\Database\Seeder;

class SetoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setores = [
            'Secretaria',
            'Assessoria',
            'Gabinete',
            'Sala de instruções',
            'Atendimento geral',
            'Arquivo',
            'Recepção',
            'Outro',
        ];

        foreach ($setores as $nome) {
            Setor::updateOrCreate(
                ['nome' => $nome],
                ['ativo' => true]
            );
        }
    }
}
