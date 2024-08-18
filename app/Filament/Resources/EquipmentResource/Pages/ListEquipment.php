<?php

namespace App\Filament\Resources\EquipmentResource\Pages;

use App\Enums\EquipmentStatus;
use App\Filament\Resources\EquipmentResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListEquipment extends ListRecords
{
    protected static string $resource = EquipmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'compliant' => Tab::make()
                ->label('Conforme')
                ->modifyQueryUsing(fn ($query) => $query->where('status', EquipmentStatus::Compliant)),
            'pending' => Tab::make()
                ->label('En attente')
                ->modifyQueryUsing(fn ($query) => $query->where('status', EquipmentStatus::Pending)),
            'non_compliant' => Tab::make()
                ->label('Non conforme')
                ->modifyQueryUsing(fn ($query) => $query->where('status', EquipmentStatus::NonCompliant)),
        ];
    }
}
