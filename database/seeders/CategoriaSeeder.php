<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            'tipo' => 'Tesis',
        ]);
        DB::table('categorias')->insert([
            'tipo' => 'Seminario',
        ]);
        DB::table('categorias')->insert([
            'tipo' => 'Investigación',
        ]);
        DB::table('categorias')->insert([
            'tipo' => 'Revista',
        ]);
        DB::table('categorias')->insert([
            'tipo' => 'Proyecto',
        ]);
    }
}
