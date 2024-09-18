<?php

namespace App\Filament\Resources\EquipmentResource\Pages;

use App\Enums\EquipmentStatus;
use App\Filament\Resources\EquipmentResource;
use App\Models\Equipment;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateEquipment extends CreateRecord
{
    protected static string $resource = EquipmentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['status'] = EquipmentStatus::Pending;

        $count = 0;
        do {
            $data['slug'] = Str::slug($data['name']);
            if ($count > 0) {
                $data['slug'] .= '-'.$count;
            }
            $count++;
        } while (Equipment::where('slug', $data['slug'])->count() > 0);

        return $data;
    }
}
