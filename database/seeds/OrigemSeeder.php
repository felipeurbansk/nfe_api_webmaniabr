<?php

use Illuminate\Database\Seeder;

class OrigemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('origens')->insert([
            'id' => '0',
            'descricao' => 'Nacional, exceto as indicadas nos códigos 3, 4, 5 e 8'
        ]);
        DB::table('origens')->insert([
            'id' => '1',
            'descricao' => 'Estrangeira - Importação direta, exceto a indicada no código 6'
        ]);
        DB::table('origens')->insert([
            'id' => '2',
            'descricao' => 'Estrangeira - Adquirida no mercado interno, exceto a indicada no código 7'
        ]);
        DB::table('origens')->insert([
            'id' => '3',
            'descricao' => 'Nacional, mercadoria ou bem com Conteúdo de Importação superior a 40% e inferior ou igual a 70%'
        ]);
        DB::table('origens')->insert([
            'id' => '4',
            'descricao' => 'Nacional, cuja produção tenha sido feita em conformidade com os processos produtivos básicos de que tratam as legislações citadas nos Ajustes'
        ]);
        DB::table('origens')->insert([
            'id' => '5',
            'descricao' => 'Nacional, mercadoria ou bem com Conteúdo de Importação inferior ou igual a 40%'
        ]);
        DB::table('origens')->insert([
            'id' => '6',
            'descricao' => 'Estrangeira - Importação direta, sem similar nacional, constante em lista da CAMEX e gás natura'
        ]);
        DB::table('origens')->insert([
            'id' => '7',
            'descricao' => 'Estrangeira - Adquirida no mercado interno, sem similar nacional, constante lista CAMEX e gás natural'
        ]);
        DB::table('origens')->insert([
            'id' => '8',
            'descricao' => 'Nacional, mercadoria ou bem com Conteúdo de Importação superior a 70%'
        ]);
    }
}
