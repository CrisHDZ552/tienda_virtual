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

        // 2. Luego buscamos o creamos a tu usuario personal
        $user = User::firstOrCreate(
            ['email' => 'crishdzcruz99@gmail.com'],
            [
                'name' => 'Cristian',
                'password' => Hash::make('Pass0119'),
                'codigo_postal' => '12345',
            ]
        );

        // 3. Le asignamos el rol de administrador a tu cuenta
        $user->assignRole('admin');
    }
}
