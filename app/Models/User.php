<?php

namespace App\Models;

use App\Enums\UserType;
use App\Traits\HasUserTypes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Jeffgreco13\FilamentBreezy\Traits\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    use HasFactory, HasUserTypes, Notifiable, TwoFactorAuthenticatable;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $with = [
        'expert',
        'company',
        'provider',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'type' => UserType::class,
        ];
    }

    public function userData()
    {

    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['fname'].' '.$attributes['lname']
        );
    }

    public function expert()
    {
        return $this->hasOne(Expert::class);
    }

    public function company()
    {
        return $this->hasOne(Company::class);
    }

    public function provider()
    {
        return $this->hasOne(Provider::class);
    }
}
