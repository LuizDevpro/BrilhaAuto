<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MainController extends Controller
{
    public function index(){

        $data = [
            'subtitle' => 'Início',
        ];

        return view('main.home', $data);

    }

    public function contactUs(){

        $data = [
            'subtitle' => 'Nos contate',
        ];

        return view('main.contact_us', $data);
    }

    public function aboutUs(){

        $data = [
            'subtitle' => 'Sobre nós',
        ];

        return view('main.contact_us', $data);
    }

    public function profile(){

        $future_appointments = Appointment::
                        where('user_id', auth()->user()->id)
                        ->where(function($query){
                            $query->where('status', 'agendado')
                            ->orWhere('status', 'em_lavagem');
                        })
                        ->with(['service'])
                        ->orderBy('appointment_datetime', 'asc')
                        ->get();
        $past_appointments = Appointment::
                        where('user_id', auth()->user()->id)
                        ->whereNotIn('status', ['agendado', 'em_lavagem'])
                        ->with(['service'])
                        ->orderBy('appointment_datetime', 'desc')
                        ->get();

        $data = [
            'subtitle' => 'Perfil',
            'future_appointments' => $future_appointments,
            'past_appointments' => $past_appointments,
        ];

        return view('profile.profile', $data);
    }

    public function appointmentDetails($appointment_id){

        try {
            $id = Crypt::decrypt($appointment_id);
        } catch (\Throwable $th) {
            return redirect()->route('profile');
        }

        $appointment = Appointment::
                        with(['service', 'additionalServices', 'address'])
                        ->find($id);

        $data = [
            'subtitle' => 'Detalhes do Agendamento',
            'appointment' => $appointment
        ];


        return view('appointments.client_appointment_details', $data);
    }
}
