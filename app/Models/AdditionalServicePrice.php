<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdditionalServicePrice extends Model
{
    use SoftDeletes;

    protected $table = 'additional_service_prices';

    public function additionalService()
    {
        return $this->belongsTo(AdditionalService::class);
    }
}
