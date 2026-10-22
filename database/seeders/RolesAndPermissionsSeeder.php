<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Permisos clave
        $permissions = [
            'clientes.ver', 'clientes.crear', 'clientes.editar',
            'catalogo.ver', 'catalogo.editar',
            'cotizaciones.crear', 'cotizaciones.aprobar',
            'reservas.coordinar', 'reservas.asignar_items',
            'terreno.acceso_pwa', 'terreno.escaneo_qr',
            'api.agente_consulta', 'api.agente_cotizar',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 2. Crear Roles
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $admin->givePermissionTo(Permission::all());

        Role::firstOrCreate(['name' => 'Vendedor'])->givePermissionTo([
            'clientes.ver', 'clientes.crear', 'clientes.editar',
            'catalogo.ver', 'cotizaciones.crear',
        ]);

        Role::firstOrCreate(['name' => 'Coordinador'])->givePermissionTo([
            'catalogo.ver', 'reservas.coordinar', 'reservas.asignar_items',
        ]);

        Role::firstOrCreate(['name' => 'Técnico'])->givePermissionTo([
            'terreno.acceso_pwa', 'terreno.escaneo_qr',
        ]);

        Role::firstOrCreate(['name' => 'Meta_Agent'])->givePermissionTo([
            'api.agente_consulta', 'api.agente_cotizar',
        ]);

        // 3. Crear Usuario Administrador Base
        $userAdmin = User::firstOrCreate(
            ['email' => 'admin@visualrent.cl'],
            [
                'name' => 'Administrador VisualRent',
                'password' => bcrypt('password'),
            ]
        );
        $userAdmin->assignRole($admin);
    }
}

       