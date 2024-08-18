<?php

namespace App\Filament\Resources\EquipmentResource\Pages;

use App\Enums\EquipmentStatus;
use App\Filament\Resources\EquipmentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEquipment extends CreateRecord
{
    protected static string $resource = EquipmentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['status'] = EquipmentStatus::Pending;

        return $data;
    }
}
