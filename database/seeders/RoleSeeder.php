<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Limpiar la caché de Spatie (Muy importante para evitar errores al hacer seed)
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. Crear permisos (Ejemplos básicos para un e-commerce)
        Permission::firstOrCreate(['name' => 'ver productos']);
        Permission::firstOrCreate(['name' => 'crear productos']);
        Permission::firstOrCreate(['name' => 'editar productos']);
        Permission::firstOrCreate(['name' => 'eliminar productos']);
        Permission::firstOrCreate(['name' => 'gestionar usuarios']);

        // 3. Crear roles y asignar permisos
        
        // Rol Cliente: Solo puede ver productos
        $roleCustomer = Role::firstOrCreate(['name' => 'customer']);
        $roleCustomer->givePermissionTo(['ver productos']);

        // Rol Vendedor: Puede ver, crear y editar productos
        $roleSeller = Role::firstOrCreate(['name' => 'seller']);
        $roleSeller->givePermissionTo(['ver productos', 'crear productos', 'editar productos']);

        // Rol Vendedor (en español)
        $roleVendedor = Role::firstOrCreate(['name' => 'vendedor']);
        $roleVendedor->givePermissionTo(['ver productos', 'crear productos', 'editar productos']);

        // Rol Verificado
        $roleVerificado = Role::firstOrCreate(['name' => 'verificado']);
        $roleVerificado->givePermissionTo(['ver productos']);

        // Rol Administrador: Tiene todos los permisos
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
        $roleAdmin->givePermissionTo(Permission::all());

        // 4. Crear un usuario Administrador por defecto
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@temu.com'], // Busca si ya existe este correo
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password123') // Contraseña por defecto
            ]
        );
        
        // Asignarle el rol de admin al usuario recién creado
        $adminUser->assignRole('admin');
    }
}