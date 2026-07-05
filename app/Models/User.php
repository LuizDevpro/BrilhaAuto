<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticable;

class User extends Authenticable
{
    protected $table = 'users';

    use HasFactory;
    use SoftDeletes;

    public function appointments()
    {

        return $this->hasMany(Appointment::class);

    }

    public function homeRoute(): string
    {
        return match ($this->role) {
            'sys-admin' => route('sysadmin.home'),
            'admin' => route('admin.home'),
            default => route('home'),
        };
    }
}
