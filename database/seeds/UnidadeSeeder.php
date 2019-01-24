<?php

use Illuminate\Database\Seeder;

class UnidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('unidades')->insert([
            'id' => '0',
            'descricao' => 'UN'
        ]);
        DB::table('unidades')->insert([
            'id' => '1',
            'descricao' => 'KG'
        ]);
    }
}
