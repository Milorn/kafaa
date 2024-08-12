<?php

namespace App\Models;

use Cesargb\Database\Support\CascadeDelete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use CascadeDelete, HasFactory;

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

    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }
}
