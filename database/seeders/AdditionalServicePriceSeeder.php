<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdditionalService;
use App\Models\AdditionalServicePrice;

class AdditionalServicePriceSeeder extends Seeder
{
    public function run(): void
    {
        $prices = [
            'Cera' => [
                'carro' => 3000,
                'moto' => 2000,
                'suv' => 4000,
                'caminhonete' => 5000,
            ],
            'Limpeza de motor' => [
                'carro' => 4000,
                'moto' => 3000,
                'suv' => 5000,
                'caminhonete' => 6000,
            ],
            'Higienização interna' => [
                'carro' => 8000,
                'moto' => 000,
                'suv' => 10000,
                'caminhonete' => 12000,
            ],
            'Polimento de faróis' => [
                'carro' => 2000,
                'moto' => 1000,
                'suv' => 5000,
                'caminhonete' => 4000,
            ],
        ];

        foreach ($prices as $serviceName => $vehiclePrices) {
            $service = AdditionalService::where('name', $serviceName)->first();

            if (! $service) {
                continue;
            }

            foreach ($vehiclePrices as $vehicleType => $price) {
                AdditionalServicePrice::create([
                    'additional_service_id' => $service->id,
                    'vehicle_type' => $vehicleType,
                    'price' => $price,
                ]);
            }
        }
    }
}
