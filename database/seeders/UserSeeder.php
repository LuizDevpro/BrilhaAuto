<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name_surname' => 'Administrador do Sistema',
            'email' => 'sysadmin@admin.com',
            'password' => bcrypt('Aa123456'),
            'role' => 'sys-admin',
            'active' => true,
        ]);

        User::create([
            'name_surname' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => bcrypt('Aa123456'),
            'role' => 'admin',
            'active' => true,
        ]);

        User::create([
            'name_surname' => 'Luiz Rodrigues',
            'email' => 'teste@gmail.com',
            'password' => bcrypt('Aa123456'),
            'role' => 'client',
            'active' => true,
        ]);

        User::factory()->count(10)->create([
            'role' => 'client',
        ]);
    }
}
