<?php

namespace App\Models;

use App\Enums\UserType;
use App\Traits\HasUserTypes;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Jeffgreco13\FilamentBreezy\Traits\TwoFactorAuthenticatable;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, HasUserTypes, Notifiable, TwoFactorAuthenticatable;

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

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
        'userable',
    ];

    protected $casts = [
        'password' => 'hashed',
        'type' => UserType::class,
    ];

    public function userable()
    {
        return $this->morphTo();
    }

    public function canImpersonate()
    {
        return $this->type == UserType::Admin;
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['fname'].' '.$attributes['lname']
        );
    }
}
