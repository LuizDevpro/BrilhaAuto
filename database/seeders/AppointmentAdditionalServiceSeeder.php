<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\AppointmentAdditionalService;
use Illuminate\Database\Seeder;

class AppointmentAdditionalServiceSeeder extends Seeder
{
    public function run()
    {
        $appointments = Appointment::all();

        foreach ($appointments as $appointment) {
            AppointmentAdditionalService::create([
                'appointment_id' => $appointment->id,
                'name' => 'Higienização Interna',
                'price' => 3000,
            ]);
        }
    }
}

