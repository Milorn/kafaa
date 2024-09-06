<?php

namespace App\Models;

use App\Enums\LabelStatus;
use App\Enums\LabelType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'type' => LabelType::class,
        'status' => LabelStatus::class,
        'starts_on' => 'date',
        'expires_on' => 'date',
    ];

    public function expert()
    {
        return $this->belongsTo(Expert::class);
    }
}
