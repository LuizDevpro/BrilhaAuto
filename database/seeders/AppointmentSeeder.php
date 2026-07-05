<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    public function run()
    {
        $clients = User::where('role', 'client')->get();
        $services = Service::all();

        foreach ($clients as $client) {
            Appointment::create([
                'user_id' => $client->id,
                'service_id' => $services->random()->id,
                'phone' => '11999999999',
                'vehicle_type' => 'carro',
                'vehicle_brand' => 'Toyota',
                'vehicle_model' => 'Corolla',
                'vehicle_year' => 2020,
                'vehicle_color' => 'Preto',
                'vehicle_plate' => 'ABC1D23',
                'appointment_datetime' => now()->addDays(rand(1, 10)),
                'payment_method' => 'pix',
                'total_price' => 7000,
                'status' => 'agendado',
            ]);
        }
    }
}

