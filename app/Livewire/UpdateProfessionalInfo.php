<?php

namespace App\Livewire;

use App\Enums\LabelType;
use App\Enums\ProfessionalStatus;
use App\Enums\UserType;
use App\Models\ActivityArea;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Jeffgreco13\FilamentBreezy\Livewire\MyProfileComponent;

class UpdateProfessionalInfo extends MyProfileComponent
{
    protected $view = 'livewire.update-professional-info';

    public mixed $userData;

    public mixed $type;

    public array $data;

    public function mount()
    {
        $user = Auth::user();
        $this->type = $user->type;
        $this->userData = match ($user->type) {
            UserType::Expert => $user->expert,
            UserType::Company => $user->company,
            UserType::Provider => $user->provider,
            default => null
        };
        $this->form->fill($this->userData?->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema(fn () => match ($this->type) {
                UserType::Expert => [
                    TextInput::make('diploma')
                        ->label('Diplôme')
                        ->placeholder('Diplôme'),
                    TextInput::make('years_of_experience')
                        ->label('Années d\'éxperiences')
                        ->numeric()
                        ->minValue(0)
                        ->placeholder('0'),
                    TextInput::make('number_of_projects')
                        ->label('Nombre de projets')
                        ->numeric()
                        ->minValue(0)
                        ->placeholder('0'),
                    TextInput::make('number_of_metric')
                        ->label(fn ($record) => $record->type == LabelType::PV ? 'Nombre de kWc installées' : 'Nombre de projets d\'EP solaire')
                        ->numeric()
                        ->minValue(0)
                        ->placeholder('0'),
                    Select::make('professional_status')
                        ->label('Statut professionnel')
                        ->options(ProfessionalStatus::class),
                    Grid::make(1)
                        ->relationship('file', condition: fn (?array $state): bool => filled($state['path']))
                        ->schema([
                            FileUpload::make('path')
                                ->storeFileNamesIn('name')
                                ->label('CV')
                                ->disk('private')
                                ->directory('experts/resumees')
                                ->downloadable()
                                ->previewable(false)
                                ->acceptedFileTypes(['application/pdf', 'image/*'])
                                ->maxSize(1024 * 12), // 12mb
                        ]),
                ],
                UserType::Company => [
                    TextInput::make('name')
                        ->label('Nom')
                        ->placeholder('Nom')
                        ->required(),
                    Select::make('activity_area_id')
                        ->label('Secteur d\'activité')
                        ->options(ActivityArea::all()->pluck('name', 'id')),
                    TextInput::make('website')
                        ->label('Site web')
                        ->url()
                        ->placeholder('https://example.com'),
                    Grid::make(1)
                        ->relationship('file', condition: fn (?array $state): bool => filled($state['path']))
                        ->schema([
                            FileUpload::make('path')
                                ->storeFileNamesIn('name')
                                ->label('Registre de commerce')
                                ->disk('private')
                                ->directory('companies/registers')
                                ->downloadable()
                                ->previewable(false)
                                ->acceptedFileTypes(['application/pdf', 'image/*'])
                                ->maxSize(1024 * 12), // 12mb
                        ]),
                ],
                UserType::Provider => [
                    TextInput::make('name')
                        ->label('Nom')
                        ->placeholder('Nom')
                        ->required(),
                    Select::make('activity_area_id')
                        ->label('Secteur d\'activité')
                        ->options(ActivityArea::all()->pluck('name', 'id')),
                    TextInput::make('website')
                        ->label('Site web')
                        ->url()
                        ->placeholder('https://example.com'),
                    Grid::make(1)
                        ->relationship('file', condition: fn (?array $state): bool => filled($state['path']))
                        ->schema([
                            FileUpload::make('path')
                                ->storeFileNamesIn('name')
                                ->label('Registre de commerce')
                                ->disk('private')
                                ->directory('providers/registers')
                                ->downloadable()
                                ->previewable(false)
                                ->acceptedFileTypes(['application/pdf', 'image/*'])
                                ->maxSize(1024 * 12), // 12mb
                        ]),
                ],
                default => []
            })
            ->statePath('data')
            ->model($this->userData);
    }

    protected function getCreateFormAction(): Action
    {
        return Action::make('submit')
            ->label('Sauvegarder')
            ->submit('submit');
    }

    public function submit(): void
    {
        $data = $this->form->getState();
        $this->userData->update($data);
        Notification::make()
            ->success()
            ->title('Profil mis à jour')
            ->send();
    }
}
