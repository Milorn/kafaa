<?php

namespace App\Models;

use App\Enums\UserType;
use App\Traits\HasUserTypes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, HasUserTypes, Notifiable;

    protected $guarded = [
        'id',
        'created_at',
        'updated',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'type' => UserType::class,
        ];
    }
}
