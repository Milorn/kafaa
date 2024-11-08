<?php

namespace App\Filament\Pages;

use App\Enums\LabelStatus;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class MyLabelPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.my-label-page';

    protected static ?string $title = 'Mon label';

    protected static ?string $navigationLabel = 'Mon label';

    protected ?string $heading = 'Mon label';

    protected static ?string $slug = 'my-label';

    public mixed $record;

    public static function canAccess(): bool
    {
        return auth()->user()->isExpert();
    }

    public function mount()
    {
        $this->record = auth()->user()->userable;
    }

    public function download()
    {
        return $this->record->certificate->getFirstMedia('labels_certificates');
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
