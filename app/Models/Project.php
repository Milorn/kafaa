<?php

namespace App\Models;

use Cesargb\Database\Support\CascadeDelete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory, CascadeDelete;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $cascadeDeleteMorph = ['attachments'];

    protected $casts = [
        'started_on' => 'date',
        'finished_on' => 'date'
    ];

    protected static function booted(): void
    {
        static::deleted(function ($model) {
            $model->deleteMorphResidual();
        });
    }

    public function expert()
    {
        return $this->belongsTo(Expert::class);
    }

    public function attachments()
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
