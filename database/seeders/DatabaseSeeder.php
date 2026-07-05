<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            ServiceSeeder::class,
            ServicePriceSeeder::class,
            AppointmentSeeder::class,
            AppointmentAdditionalServiceSeeder::class,
            AddressSeeder::class,
            AdditionalServiceSeeder::class,
            AdditionalServicePriceSeeder::class,
            AdditionalServiceServiceSeeder::class,
        ]);
    }
}
