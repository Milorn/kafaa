<?php

namespace App\Models;

use App\Enums\LabelType;
use App\Enums\ProfessionalStatus;
use Cesargb\Database\Support\CascadeDelete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Expert extends Model implements HasMedia
{
    use CascadeDelete, HasFactory, InteractsWithMedia;

    protected $cascadeDeleteMorph = ['user'];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'professional_status' => ProfessionalStatus::class,
        'label' => LabelType::class,
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

    public function label()
    {
        return $this->hasOne(Label::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
