<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ModalidadeFreteSeeder::class);
        $this->call(OperacaoSeeder::class);
        $this->call(OrigemSeeder::class);
        $this->call(PresencaSeeder::class);
        $this->call(UnidadeSeeder::class);
    }
}
