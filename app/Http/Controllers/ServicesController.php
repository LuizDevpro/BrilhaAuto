<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Support\Facades\Crypt;

class ServicesController extends Controller
{
    public function index()
    {

        $services = Service::with('prices')->get();

        $data = [
            'subtitle' => 'Serviços',
            'services' => $services,
        ];

        return view('services.services', $data);
    }

    public function serviceDescription($service_id)
    {

        try {
            $id = Crypt::decrypt($service_id);
        } catch (\Throwable $th) {
            return redirect()->route('services');
        }       

        $service = Service::with('prices')->findOrFail($id);

        $data = [
            'subtitle' => 'Serviços',
            'service' => $service
        ];

        return view('services.service_description', $data);
    }
}
