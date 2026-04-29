<?php

namespace Database\Seeders;

use App\Models\CidadeComarca;
use App\Models\Vara;
use Illuminate\Database\Seeder;

class VarasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $capela = CidadeComarca::where('nome', 'Capela')->first();
        $aracaju = CidadeComarca::where('nome', 'Aracaju')->first();

        if ($capela) {
            Vara::updateOrCreate(
                ['cidade_comarca_id' => $capela->id, 'nome' => 'Única'],
                ['ativo' => true]
            );
        }

        if ($aracaju) {
            foreach (['1ª Vara', '2ª Vara'] as $nome) {
                Vara::updateOrCreate(
                    ['cidade_comarca_id' => $aracaju->id, 'nome' => $nome],
                    ['ativo' => true]
                );
            }
        }
    }
}
