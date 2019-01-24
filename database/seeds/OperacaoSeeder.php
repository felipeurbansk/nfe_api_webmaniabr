<?php

use Illuminate\Database\Seeder;

class OperacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('operacoes')->insert([
            'id' => '0',
            'descricao' => 'Entrada'
        ]);
        DB::table('operacoes')->insert([
            'id' => '1',
            'descricao' => 'Saída'
        ]);
    }
}
