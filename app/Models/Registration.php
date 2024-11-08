<?php

namespace App\Models;

use App\Enums\RegistrationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'status' => RegistrationStatus::class,
    ];

    public function expert()
    {
        return $this->belongsTo(Expert::class);
    }

    public function training()
    {
        return $this->belongsTo(Training::class);
    }
}
