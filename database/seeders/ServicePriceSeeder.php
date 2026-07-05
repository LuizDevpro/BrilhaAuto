<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\ServicePrice;

class ServicePriceSeeder extends Seeder
{
    public function run(): void
    {
        $vehicleTypes = [
            'moto' => 3000,        
            'carro' => 5000,       
            'suv' => 7000,         
            'caminhonete' => 9000, 
        ];

        $services = Service::all();

        foreach ($services as $service) {
            foreach ($vehicleTypes as $vehicleType => $basePrice) {

                $price = $basePrice + ($service->id * 500);

                ServicePrice::create([
                    'service_id' => $service->id,
                    'vehicle_type' => $vehicleType,
                    'price' => $price,
                ]);
            }
        }
    }
}
