<?php

namespace Database\Seeders;

use App\Models\CidadeComarca;
use Illuminate\Database\Seeder;

class CidadesComarcasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cidades = [
            'Capela',
            'Aracaju',
        ];

        foreach ($cidades as $nome) {
            CidadeComarca::updateOrCreate(
                ['nome' => $nome],
                ['ativo' => true]
            );
        }
    }
}
