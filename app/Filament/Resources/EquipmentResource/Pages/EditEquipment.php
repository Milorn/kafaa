<?php

namespace App\Filament\Resources\EquipmentResource\Pages;

use App\Filament\Resources\EquipmentResource;
use App\Models\Equipment;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;

class EditEquipment extends EditRecord
{
    protected static string $resource = EquipmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function mutateFormDataBeforeSave(array $data): array
    {
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
