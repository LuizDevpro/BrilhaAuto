<?php

namespace App\Http\Controllers;

use App\Models\AdditionalService;
use App\Models\Address;
use App\Models\Appointment;
use App\Models\AppointmentAdditionalService;
use App\Models\Service;
use App\Models\ServicePrice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AppointmentsController extends Controller
{
    public function newAppointment($service_id)
    {

        try {
            $id = Crypt::decrypt($service_id);
        } catch (\Throwable $th) {
            return redirect()->route('services');
        }

        $service = Service::with([
            'prices',
            'additionalServices' => function ($q) {
                $q->where('active', true)->with('prices');
            },
        ])->findOrFail($id);

        $data = [
            'subtitle' => 'Criar Angendamento - '.$service->name,
            'service' => $service,
        ];

        return view('appointments.new_appointment_frm', $data);
    }

    public function occupiedTimes(Request $request)
    {
        $date = Carbon::createFromFormat('Y-m-d', $request->date)->startOfDay();
        $now = Carbon::now();

        $query = Appointment::whereDate('appointment_datetime', $date)
            ->whereNotIn('status', ['cancelado']);

        if ($date->isToday()) {
            $query->whereTime('appointment_datetime', '>', $now->format('H:i'));
        }

        $occupied = $query
            ->pluck('appointment_datetime')
            ->map(fn ($dt) => Carbon::parse($dt)->format('H:i'))
            ->values();

        return response()->json($occupied);
    }

    public function newAppointmentSubmit($service_id, Request $request)
    {

        try {
            $service_id = Crypt::decrypt($service_id);
        } catch (\Throwable $th) {
            return redirect()->route('services');
        }

        $service = Service::with([
            'additionalServices' => function ($q) {
                $q->where('active', true);
            },
        ])->findOrFail($service_id);

        $request->validate(
            [
                'phone' => 'required|string|min:8|max:20',
                'datetime' => [
                    'required',
                    function ($attr, $value, $fail) {
                        $dt = \DateTime::createFromFormat('d/m/Y H:i', $value);
                        if (! $dt) {
                            $fail('Selecione uma data e um horário válidos.');
                        }
                    },
                ],
                'vehicle_type' => 'required|in:Carro,Moto,Caminhonete,SUV',
                'brand' => 'required|string|max:50',
                'model' => 'required|string|max:50',
                'year' => 'nullable|integer|between:1995,'.date('Y'),
                'color' => 'required|string|max:30',
                'plate' => 'nullable|string|max:10',
                'extras' => 'nullable|array',
                'extras.*' => 'integer|exists:additional_services,id',
                'observations' => 'nullable|string|max:500',
                'payment' => 'required|in:Pix,Débito,Crédito,Dinheiro',
                'pickup' => 'required|boolean',
                'street' => 'nullable|required_if:pickup,1|string|max:100',
                'number' => 'nullable|required_if:pickup,1|integer|min:1|max:999999',
                'neighborhood' => 'nullable|required_if:pickup,1|string|max:100',
                'complement' => 'nullable|string|max:150',
                'pickup_time' => 'nullable|required_if:pickup,1|date_format:H:i',
            ],
            [
                'phone.required' => 'O telefone/whatsapp para contato é obrigatório.',
                'phone.string' => 'Insira um valor válido.',
                'phone.min' => 'O telefone/whatsapp deve ter no mínimo :min dígitos.',
                'phone.max' => 'O telefone/whatsapp deve ter no máximo :max dígitos.',
                'datetime.required' => 'A data e a hora são obrigatórias.',
                'datetime.date_format' => 'Selecione uma data válida',
                'vehicle_type.required' => 'O tipo do veículo é obrigatório.',
                'vehicle_type.in' => 'Selecione um tipo válido.',
                'brand.required' => 'A marca do veículo é obrigatória.',
                'brand.string' => 'Insira um valor válido.',
                'brand.max' => 'A marca do veículo deve ter no máximo :max caracteres.',
                'model.required' => 'O modelo do veículo é obrigatório.',
                'model.string' => 'Insira um valor válido.',
                'model.max' => 'O do veículo deve ter no máximo :max caracteres.',
                'year.integer' => 'Insira um valor válido.',
                'year.between' => 'Insira um valor válido.',
                'color.required' => 'A cor do veículo é obrigatória.',
                'color.string' => 'Insira um valor válido.',
                'color.max' => 'A cor do veículo deve ter no máximo :max caracteres.',
                'plate.string' => 'Insira um valor válido.',
                'plate.max' => 'A placa do veículo deve ter no máximo :max carateres.',
                'extras.array' => 'Selecione um valor válido.',
                'extras.*.exists' => 'Selecione um valor válido.',
                'observations.string' => 'Insira um valor válido.',
                'observations.max' => 'As observações devem ter no máximo :max caracteres.',
                'payment.required' => 'A forma de pagamento é obrigatória.',
                'payment.in' => 'Selecione um valor válido.',
                'pickup.required' => 'A escolha é obrigatória.',
                'pickup.boolean' => 'Escolha um valor válido.',
                'street.required_if' => 'A rua é obrigatória.',
                'street.string' => 'Insira um valor válido.',
                'street.max' => 'A rua deve ter no máximo :max caracteres.',
                'number.required_if' => 'O número é obrigatório.',
                'number.integer' => 'Insira um número válido.',
                'number.min' => 'O número deve ser maior que zero.',
                'number.max' => 'O número deve ter no máximo 6 dígitos.',
                'neighborhood.required_if' => 'O bairro é obrigatório.',
                'neighborhood.string' => 'Insira um valor válido.',
                'neighborhood.max' => 'O bairro deve ter no máximo :max caracteres.',
                'complement.string' => 'Insira um valor válido.',
                'complement.max' => 'O complemento deve ter no máximo :max caracteres',
                'pickup_time.required_if' => 'A hora para a busca é obrigatória.',
                'pickup_time.date_format' => 'Insira um valor válido.',
            ]
        );

        $appointment = new Appointment;

        $appointmentDate = Carbon::createFromFormat('d/m/Y H:i', $request->datetime);

        if ($appointmentDate->isPast()) {
            return back()
                ->withErrors(['datetime' => 'Não é possível agendar para uma data ou horário passado.'])
                ->withInput();
        }

        $allowedHours = ['07:00', '09:00', '13:00', '15:00', '17:00'];

        if (! in_array($appointmentDate->format('H:i'), $allowedHours)) {
            return back()
                ->withErrors(['datetime' => 'Horário inválido para agendamento.'])
                ->withInput();
        }

        $alreadyExists = Appointment::where('appointment_datetime', $appointmentDate)
            ->whereNotIn('status', ['cancelado'])
            ->exists();

        if ($alreadyExists) {
            return back()
                ->withErrors(['datetime' => 'Este horário já foi reservado.'])
                ->withInput();
        }

        if ($request->filled('extras')) {
            $validExtrasCount = $service->additionalServices()
                ->where('active', true)
                ->whereIn('additional_services.id', $request->extras)
                ->count();

            if ($validExtrasCount !== count($request->extras)) {
                return back()
                    ->withErrors(['extras' => 'Serviço adicional inválido.'])
                    ->withInput();
            }
        }

        $servicePrice = ServicePrice::where('service_id', $service_id)
            ->where('vehicle_type', $request->vehicle_type)
            ->firstOrFail();

        $basePrice = $servicePrice->price;

        $extras = AdditionalService::whereIn('id', $request->extras ?? [])
            ->with(['prices' => function ($q) use ($request) {
                $q->where('vehicle_type', $request->vehicle_type);
            }])
            ->get();

        $extrasTotal = 0;

        foreach ($extras as $extra) {
            $extrasTotal += $extra->prices->first()?->price ?? 0;
        }

        $totalPrice = $basePrice + $extrasTotal;

        $appointment->user_id = auth()->id();
        $appointment->service_id = $service_id;
        $appointment->phone = $request->phone;
        $appointment->vehicle_type = $request->vehicle_type;
        $appointment->vehicle_brand = $request->brand;
        $appointment->vehicle_model = $request->model;
        $appointment->vehicle_year = $request->year ?? null;
        $appointment->vehicle_color = $request->color;
        $appointment->vehicle_plate = $request->plate ?? null;
        $appointment->appointment_datetime = Carbon::createFromFormat(
            'd/m/Y H:i',
            $request->datetime
        );
        $paymentMap = [
            'Pix' => 'pix',
            'Débito' => 'debito',
            'Crédito' => 'credito',
            'Dinheiro' => 'dinheiro',
        ];

        $appointment->payment_method = $paymentMap[$request->payment];

        $appointment->total_price = $totalPrice;
        $appointment->status = 'agendado';
        $appointment->observations = $request->observations ?? null;
        $appointment->created_at = now();
        $appointment->updated_at = now();
        $appointment->save();

        if ($request->pickup) {
            $address = new Address;
            $address->appointment_id = $appointment->id;
            $address->street = $request->street;
            $address->number = $request->number;
            $address->neighborhood = $request->neighborhood;
            $address->complement = $request->complement ?? null;
            $address->preferred_time = $request->pickup_time;
            $address->created_at = now();
            $address->updated_at = now();
            $address->save();
        }

        foreach ($extras as $extra) {
            $price = $extra->prices->first()?->price ?? 0;

            $appointmentExtra = new AppointmentAdditionalService;
            $appointmentExtra->appointment_id = $appointment->id;
            $appointmentExtra->name = $extra->name;
            $appointmentExtra->price = $price;
            $appointmentExtra->created_at = now();
            $appointmentExtra->updated_at = now();
            $appointmentExtra->save();
        }

        return redirect()->back()->with('appointment_success', 'Sucesso.');
    }
}
