<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cliente::create([
            'cnpj' => '00000000000',
            'nome' => 'Felipe Santos',
            'razao_social' => 'razao social',
            'endereco' => 'São Paulo'
        ]);
    }
}
