<?php

namespace App\Filament\Resources\ExpertResource\Pages;

use App\Filament\Resources\ExpertResource;
use Filament\Resources\Pages\CreateRecord;

class CreateExpert extends CreateRecord
{
    protected static string $resource = ExpertResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if(auth()->user()->isCompany()) {
            $data['company_id'] = auth()->user()->userable_id;
        }
        
        return $data;
    }
}
