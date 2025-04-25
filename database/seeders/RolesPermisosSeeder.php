<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermisosSeeder extends Seeder
{
    public function run(): void
    {
        $superadmin = Role::create(['name' => 'superadmin']);
        $admin = Role::create(['name' => 'admin']);

        // Rol de Ventas
        Role::create(['name' => 'ventas']);

        Permission::create(['name' => 'Usuario Listar', 'guard_name' => 'web'])->syncRoles([$superadmin, $admin]);
        Permission::create(['name' => 'Usuario Crear', 'guard_name' => 'web'])->syncRoles([$superadmin, $admin]);
        Permission::create(['name' => 'Usuario Editar', 'guard_name' => 'web'])->syncRoles([$superadmin, $admin]);
        Permission::create(['name' => 'Usuario Eliminar', 'guard_name' => 'web'])->syncRoles([$superadmin, $admin]);

        Permission::create(['name' => 'Rol Listar', 'guard_name' => 'web'])->syncRoles([$superadmin, $admin]);
        Permission::create(['name' => 'Rol Crear', 'guard_name' => 'web'])->syncRoles([$superadmin, $admin]);
        Permission::create(['name' => 'Rol Editar', 'guard_name' => 'web'])->syncRoles([$superadmin, $admin]);
        Permission::create(['name' => 'Rol Eliminar', 'guard_name' => 'web'])->syncRoles([$superadmin, $admin]);

        Permission::create(['name' => 'Bitacora Listar', 'guard_name' => 'web'])->syncRoles([$superadmin, $admin]);
        Permission::create(['name' => 'Bitacora Crear', 'guard_name' => 'web'])->syncRoles([$superadmin, $admin]);
    }
}
