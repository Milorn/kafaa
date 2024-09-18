<?php

namespace App\Models;

use Cesargb\Database\Support\CascadeDelete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Provider extends Model implements HasMedia
{
    use CascadeDelete, HasFactory, InteractsWithMedia;

    protected $cascadeDeleteMorph = ['user'];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
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

    public function activityArea()
    {
        return $this->belongsTo(ActivityArea::class);
    }

    public function equipments()
    {
        return $this->hasMany(Equipment::class);
    }
}
