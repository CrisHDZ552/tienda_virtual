<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // 1. Primero creamos los roles llamando a tu RoleSeeder
        $this->call(
            RoleSeeder::class,
        );

        // 2. Actualizamos o creamos a tu usuario personal (Administrador)
        $admin = User::updateOrCreate(
            ['email' => 'crishdzcruz99@gmail.com'],
            [
                'name' => 'Cristian',
                'password' => Hash::make('Pass0119'),
                'codigo_postal' => '12345',
                'avatar' => '1776714964_png', // Opcional: Nombre de tu imagen de avatar
            ]
        );
        // Le asignamos el rol de administrador a tu cuenta
        $admin->assignRole('admin');

        // 3. Actualizamos o creamos un usuario de prueba para el rol Vendedor
        $vendedor = User::updateOrCreate(
            ['email' => 'sreten@oficial.gov.mx'],
            [
                'name' => 'Sreten',
                'password' => Hash::make('Pass0119'),
                'codigo_postal' => '54321',
                'avatar' => '1776785365_png', // Opcional: Nombre de tu imagen de avatar
            ]
        );
        // Le asignamos el rol de vendedor
        $vendedor->assignRole('vendedor');
    }
}
