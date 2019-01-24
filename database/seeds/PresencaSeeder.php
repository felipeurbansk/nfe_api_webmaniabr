<?php

use Illuminate\Database\Seeder;

class PresencaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('presencas')->insert([
            'id' => '0',
            'descricao' => 'Não se aplica (por exemplo, Nota Fiscal complementar ou de ajuste)'
        ]);
        DB::table('presencas')->insert([
            'id' => '1',
            'descricao' => 'Operação presencial'
        ]);
        DB::table('presencas')->insert([
            'id' => '2',
            'descricao' => 'Operação não presencial, pela Internet'
        ]);
        DB::table('presencas')->insert([
            'id' => '3',
            'descricao' => 'Operação não presencial, Teleatendimento'
        ]);
        DB::table('presencas')->insert([
            'id' => '4',
            'descricao' => 'NFC-e em operação com entrega a domicílio'
        ]);
        DB::table('presencas')->insert([
            'id' => '5',
            'descricao' => 'Operação presencial, fora do estabelecimento'
        ]);
        DB::table('presencas')->insert([
            'id' => '6',
            'descricao' => 'Operação não presencial, outros'
        ]);
    }
}
