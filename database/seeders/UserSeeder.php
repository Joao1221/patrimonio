<?php

namespace Database\Seeders;

use App\Enums\PapelUsuario;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        if (User::where('papel', PapelUsuario::Master)->doesntExist()) {
            User::create([
                'name'     => 'Administrador Master',
                'email'    => 'rapwara@gmail.com',
                'password' => Hash::make('Jo@o1221'),
                'papel'    => PapelUsuario::Master,
                'ativo'    => true,
            ]);
        }
    }
}
