<?php

use Illuminate\Database\Seeder;

class ModalidadeFreteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modalidade_fretes')->insert([
            'id' => '0',
            'descricao' => 'Contratação do Frete por conta do Remetente (CIF)'
        ]);
        DB::table('modalidade_fretes')->insert([
            'id' => '1',
            'descricao' => 'Contratação do Frete por conta do Destinatário (FOB)'
        ]);
        DB::table('modalidade_fretes')->insert([
            'id' => '2',
            'descricao' => 'Contratação do Frete por conta de Terceiros'
        ]);
        DB::table('modalidade_fretes')->insert([
            'id' => '3',
            'descricao' => 'Transporte Próprio por conta do Remetente'
        ]);
        DB::table('modalidade_fretes')->insert([
            'id' => '4',
            'descricao' => 'Transporte Próprio por conta do Destinatário    '
        ]);
        DB::table('modalidade_fretes')->insert([
            'id' => '9',
            'descricao' => 'Sem Ocorrência de Transporte'
        ]);
    }
}
