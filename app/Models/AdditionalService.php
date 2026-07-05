<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdditionalService extends Model
{
    use SoftDeletes;

    protected $table = 'additional_services';


    public function services()
    {
        return $this->belongsToMany(
            Service::class,
            'additional_service_services'
        );
    }

    public function prices()
    {
        return $this->hasMany(AdditionalServicePrice::class);
    }
}
