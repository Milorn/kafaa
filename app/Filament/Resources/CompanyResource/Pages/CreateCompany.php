<?php

namespace App\Filament\Resources\CompanyResource\Pages;

use App\Enums\UserType;
use App\Filament\Resources\CompanyResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCompany extends CreateRecord
{
    protected static string $resource = CompanyResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user']['type'] = UserType::Company;

        return $data;
    }
}
