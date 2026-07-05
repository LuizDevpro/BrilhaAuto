<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdditionalService;

class AdditionalServiceSeeder extends Seeder
{
    public function run(): void
    {
        AdditionalService::insert([
            [
                'name' => 'Cera',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Limpeza de motor',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Higienização interna',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Polimento de faróis',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
