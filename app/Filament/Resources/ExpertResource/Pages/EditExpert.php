<?php

namespace App\Filament\Resources\ExpertResource\Pages;

use App\Enums\LabelStatus;
use App\Filament\Resources\ExpertResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditExpert extends EditRecord
{
    protected static string $view = 'filament.resources.experts.edit';

    protected static string $resource = ExpertResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function renew()
    {
        $this->record->certificate->update(['status' => LabelStatus::Renewal]);

        return Notification::make()
            ->success()
            ->title('Demande de renouvellement')
            ->body('Votre demande de renouvellement a bien été envoyé, la liste des projets sera pris en compte.')
            ->send();
    }
}
