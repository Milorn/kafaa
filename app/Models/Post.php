<?php

namespace App\Models;

use App\Enums\PostType;
use Cesargb\Database\Support\CascadeDelete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Post extends Model implements HasMedia
{
    use CascadeDelete, HasFactory, HasTranslations, InteractsWithMedia;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'type' => PostType::class,
    ];

    public $translatable = ['title', 'subtitle', 'content'];

    protected static function booted(): void
    {
        static::deleted(function ($model) {
            $model->deleteMorphResidual();
        });
    }
}
