<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departamentos')->insert([
            'nombre' => 'Matematica',
        ]);
        DB::table('departamentos')->insert([
            'nombre' => 'Informatica',
        ]);
        DB::table('departamentos')->insert([
            'nombre' => 'Quimica',
        ]);
        DB::table('departamentos')->insert([
            'nombre' => 'Fisica',
        ]);
    }
}
