<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppointmentAdditionalService extends Model
{
    use SoftDeletes;

    protected $table = 'appointment_additional_services';

    public function appointment()
    {

        return $this->belongsTo(Appointment::class);

    }
}
