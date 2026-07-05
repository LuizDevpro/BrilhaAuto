<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServicePrice extends Model
{
    
    protected $table = 'service_prices';
    use SoftDeletes;

    public function service(){

        return $this->belongsTo(Service::class);

    }

    

}
