<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    public function index()
    {

        $today_appointments = Appointment::with(['service', 'user'])
            ->whereDate('appointment_datetime', now())
            ->orderBy('appointment_datetime', 'asc')
            ->get();

        $appointments = Appointment::with(['service', 'user'])
            ->orderBy('appointment_datetime', 'asc')
            ->get();

        $data = [
            'subtitle' => 'Administração',
            'today_appointments' => $today_appointments,
            'appointments' => $appointments,
        ];

        return view('admin.admin_home', $data);
    }

    public function appointmentDetails($appointment_id)
    {

        try {
            $id = Crypt::decrypt($appointment_id);
        } catch (\Throwable $th) {
            return redirect()->route('admin.home');
        }

        $appointment = Appointment::with(['user', 'service', 'additionalServices', 'address'])
            ->find($id);

        $data = [
            'subtitle' => 'Detalhes do Agendamento',
            'appointment' => $appointment,
        ];

        return view('admin.admin_appointment_details', $data);
    }

    public function finishAppointment($appointment_id)
    {
        return $this->changeStatus($appointment_id, 'finalizado');
    }

    public function startAppointment($appointment_id)
    {
        return $this->changeStatus($appointment_id, 'em_lavagem');
    }

    public function cancelAppointment($appointment_id)
    {
        return $this->changeStatus($appointment_id, 'cancelado');
    }

    public function deliveredAppointment($appointment_id)
    {
        return $this->changeStatus($appointment_id, 'entregue');
    }

    public function reactivateAppointment($appointment_id)
    {
        try {
            $id = Crypt::decrypt($appointment_id);
        } catch (\Throwable $th) {
            return redirect()->route('admin.home');
        }

        $appointment = Appointment::findOrFail($id);

        $appointment->update([
            'status' => 'agendado',
            'started_at' => null
        ]);

        return back();
    }

    private function changeStatus($encryptedId, $newStatus)
    {
        try {
            $id = Crypt::decrypt($encryptedId);
        } catch (\Throwable $th) {
            return redirect()->route('admin.home');
        }

        $appointment = Appointment::findOrFail($id);

        $data = [
            'status' => $newStatus,
        ];

        if ($newStatus === 'em_lavagem' && is_null($appointment->started_at)) {
            $data['started_at'] = now();
        }

        if ($newStatus === 'finalizado' && is_null($appointment->finished_at)) {
            $data['finished_at'] = now();
        }

        if ($newStatus === 'entregue' && is_null($appointment->delivered_at)) {
            $data['delivered_at'] = now();
        }

        if ($newStatus === 'cancelado' && is_null($appointment->canceled_at)) {
            $data['canceled_at'] = now();
        }

        $appointment->update($data);

        return back();
    }

    public function assignResponsible(Request $request, $appointment_id){

        try {
            $id = Crypt::decrypt($appointment_id);
        } catch (\Throwable $th) {
            return redirect()->route('admin.home');
        }

        $appointment = Appointment::findOrFail($id);

        $request->validate(
            [
                'responsible_name' => 'required|min:3|max:100'
            ],
            [
                'responsible.required' => 'O nome do(a) responsável é obrigatório.',
                'responsible.min' => 'O nome do(a) responsável deve ter no mínimo :min caracteres.',
                'responsible.max' => 'O nome do(a) responsável deve ter no máximo :max caracteres.',
            ]
        );

        $appointment->responsible = $request->responsible_name;
        $appointment->save();

        return back();
    }
}
