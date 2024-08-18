<?php

namespace App\Models;

use App\Enums\EquipmentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'status' => EquipmentStatus::class,
    ];

    public function file()
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
