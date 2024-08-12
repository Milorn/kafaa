<?php

namespace App\Models;

use App\Enums\LabelType;
use App\Enums\ProfessionalStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'professional_status' => ProfessionalStatus::class,
        'type' => LabelType::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }
}
