<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Appointment;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    public function run()
    {
        $appointments = Appointment::all();

        foreach ($appointments as $appointment) {
            Address::create([
                'appointment_id' => $appointment->id,
                'street' => 'Rua Exemplo',
                'number' => '123',
                'neighborhood' => 'Centro',
                'complement' => 'Casa',
                'preferred_time' => '14:00 - 18:00',
            ]);
        }
    }
}
