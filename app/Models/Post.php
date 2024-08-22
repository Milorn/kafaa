<?php

namespace App\Models;

use App\Enums\PostType;
use Cesargb\Database\Support\CascadeDelete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use CascadeDelete, HasFactory, HasTranslations;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'type' => PostType::class,
    ];

    public $translatable = ['title', 'subtitle', 'content'];

    protected $cascadeDeleteMorph = ['files'];

    protected static function booted(): void
    {
        static::deleted(function ($model) {
            $model->deleteMorphResidual();
        });
    }

    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }
}
