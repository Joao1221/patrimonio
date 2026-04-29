<?php

namespace Database\Seeders;

use App\Models\Marca;
use Illuminate\Database\Seeder;

class MarcasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $marcas = [
            'Dell',
            'HP',
            'Lenovo',
            'SMS',
            'Epson',
            'Canon',
            'Brother',
            'Outro',
        ];

        foreach ($marcas as $nome) {
            Marca::updateOrCreate(
                ['nome' => $nome],
                ['ativo' => true]
            );
        }
    }
}
