<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $table = 'services';

    public function appointments()
    {

        return $this->hasMany(Appointment::class);

    }

    public function prices()
    {

        return $this->hasMany(ServicePrice::class);

    }

    public function additionalServices()
    {
        return $this->belongsToMany(
            AdditionalService::class,
            'additional_service_services'
        );
    }
}
