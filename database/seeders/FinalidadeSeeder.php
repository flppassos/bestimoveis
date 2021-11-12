<?php

namespace Database\Seeders;

use App\Models\Finalidade;
use Illuminate\Database\Seeder;

class FinalidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Finalidade::create(['nome' => 'Aluguel']);
        Finalidade::create(['nome' => 'Venda']);
    }
}
