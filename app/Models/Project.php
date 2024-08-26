<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Project extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'started_on' => 'date',
        'finished_on' => 'date',
    ];

    public function expert()
    {
        return $this->belongsTo(Expert::class);
    }
}
