<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\AdditionalService;
use Illuminate\Support\Facades\DB;

class AdditionalServiceServiceSeeder extends Seeder
{
    public function run(): void
    {
        $extras = AdditionalService::all();

        $servicesAllExtras = [1, 2, 3];

        foreach ($servicesAllExtras as $serviceId) {
            foreach ($extras as $extra) {
                DB::table('additional_service_services')->insert([
                    'service_id' => $serviceId,
                    'additional_service_id' => $extra->id,
                ]);
            }
        }

        $service4Extras = $extras->where('id', '!=', 3);

        foreach ($service4Extras as $extra) {
            DB::table('additional_service_services')->insert([
                'service_id' => 4,
                'additional_service_id' => $extra->id,
            ]);
        }

        $service5Extras = $extras->where('id', '!=', 4);

        foreach ($service5Extras as $extra) {
            DB::table('additional_service_services')->insert([
                'service_id' => 5,
                'additional_service_id' => $extra->id,
            ]);
        }
    }
}

