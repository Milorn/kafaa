<?php

namespace App\Models;

use App\Enums\LabelType;
use App\Enums\ProfessionalStatus;
use Cesargb\Database\Support\CascadeDelete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    use CascadeDelete, HasFactory;

    protected $cascadeDeleteMorph = ['user'];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'professional_status' => ProfessionalStatus::class,
        'type' => LabelType::class,
    ];

    protected static function booted(): void
    {
        static::deleted(function ($model) {
            $model->deleteMorphResidual();
        });
    }

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }
}
