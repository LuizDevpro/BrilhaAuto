<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use SoftDeletes;

    protected $table = 'appointments';

    protected $casts = [
        'appointment_datetime' => 'datetime',
        'finished_at' => 'datetime',
        'delivered_at' => 'datetime',
        'canceled_at' => 'datetime',
        'started_at' => 'datetime',
    ];

    protected $fillable = [
        'status',
        'finished_at',
        'delivered_at',
        'canceled_at',
        'started_at',
    ];

    public function user()
    {

        return $this->belongsTo(User::class);

    }

    public function service()
    {

        return $this->belongsTo(Service::class);

    }

    public function additionalServices()
    {

        return $this->hasMany(AppointmentAdditionalService::class);

    }

    public function address()
    {

        return $this->hasOne(Address::class);

    }
}
