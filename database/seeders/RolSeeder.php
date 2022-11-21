<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
//solo se usa para crear un usuario colaborador
use App\Models\User;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rol_admin= Role::create(['name' => 'Admin']);
        $rol_colaborador = Role::create(['name' => 'Colaborador']);
        $rol_invitado = Role::create(['name' => 'Invitado']);

        $permiso1 = Permission::create(['name' => 'Manejo de Documentos']);
        $permiso2 = Permission::create(['name' => 'Manejo de Categorias']);
        $permiso3 = Permission::create(['name' => 'Manejo de Departamentos']);
        $permiso4 = Permission::create(['name' => 'Solo invitado']);
        $permiso1->assignRole($rol_admin);
        $permiso2->assignRole($rol_admin);
        $permiso3->assignRole($rol_admin);
        $permiso1->assignRole($rol_colaborador);
        $permiso4->assignRole($rol_invitado);

        $adminUser = User::factory()->create([
            'email' => 'davideq555@gmail.com',
            'password' => bcrypt('pass1234'),
        ]);
        //Usuario colaborador
        $colaUser = User::factory()->create([
            'email' => 'colaborador@gmail.com',
            'password' => bcrypt('pass1234'),
        ]);
        //Usuario invitado
        $inviUser = User::factory()->create([
            'email' => 'invitado@gmail.com',
            'password' => bcrypt('pass1234'),
        ]);
        $adminUser->assignRole($rol_admin);
        $colaUser->assignRole($rol_colaborador);
        $inviUser->assignRole($rol_invitado);
    }
}
