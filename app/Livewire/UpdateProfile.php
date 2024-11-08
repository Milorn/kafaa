<?php

namespace App\Livewire;

use App\Enums\LabelType;
use App\Enums\ProfessionalStatus;
use App\Enums\UserType;
use App\Models\ActivityArea;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Jeffgreco13\FilamentBreezy\Livewire\MyProfileComponent;

class UpdateProfile extends MyProfileComponent
{
    protected $view = 'livewire.update-personal-info';

    public array $data;

    public mixed $user;

    public function mount()
    {
        $this->user = Auth::user();
        $this->form->fill($this->user->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informations de connexion')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nom')
                            ->placeholder('Nom')
                            ->visible(fn ($record) => $record->type == UserType::Admin)
                            ->required(),
                        TextInput::make('email')
                            ->label('Email')
                            ->placeholder('email@example.com')
                            ->required()
                            ->unique(ignorable: fn ($record) => $record),
                    ]),
                Section::make('Informations Professionnelles')
                    ->relationship('userable')
                    ->visible(fn ($record) => $record->type != UserType::Admin)
                    ->columns(2)
                    ->schema(fn ($record) => match ($record->type) {
                        UserType::Expert => [
                            SpatieMediaLibraryFileUpload::make('image')
                                ->label('Image')
                                ->disk('public')
                                ->collection('experts_avatars')
                                ->image()
                                ->imageEditor()
                                ->avatar()
                                ->columnSpanFull(),
                            TextInput::make('lname')
                                ->label('Nom')
                                ->placeholder('Nom')
                                ->required(),
                            TextInput::make('fname')
                                ->label('Prénom')
                                ->placeholder('Prénom')
                                ->required(),
                            TextInput::make('phone')
                                ->label('Téléphone')
                                ->placeholder('Téléphone')
                                ->tel(),
                            TextInput::make('email')
                                ->label('Email secondaire')
                                ->placeholder('email@example.com'),
                            TextInput::make('diploma')
                                ->label('Diplôme')
                                ->placeholder('Diplôme'),
                            Select::make('wilaya_id')
                                ->label('Wilaya')
                                ->getOptionLabelFromRecordUsing(fn ($record) => $record->id.'-'.$record->name)
                                ->relationship('wilaya', 'name'),
                            TextInput::make('address')
                                ->label('Adresse')
                                ->placeholder('Adresse')
                                ->columnSpanFull(),
                            Select::make('professional_status')
                                ->label('Statut professionnel')
                                ->options(ProfessionalStatus::class),
                            Select::make('label')
                                ->label('Label')
                                ->options(LabelType::class)
                                ->default(LabelType::PV)
                                ->live(true)
                                ->required(),
                            SpatieMediaLibraryFileUpload::make('file')
                                ->label('CV')
                                ->disk('public')
                                ->collection('experts_resumees')
                                ->downloadable()
                                ->previewable(false)
                                ->acceptedFileTypes(['application/pdf', 'image/*'])
                                ->maxSize(1024 * 12)
                                ->columnSpanFull(), // 12mb
                            Fieldset::make('Experience professionnelles')
                                ->columns(2)
                                ->schema([
                                    TextInput::make('years_of_experience')
                                        ->label('Nombre d\'années')
                                        ->numeric()
                                        ->integer()
                                        ->placeholder(0)
                                        ->minValue(0),
                                    TextInput::make('number_of_projects')
                                        ->label(fn ($get) => match ($get('label')) {
                                            LabelType::PV->value => 'Nombre de projets solaires photovoltaïques',
                                            LabelType::PV => 'Nombre de projets solaires photovoltaïques',
                                            LabelType::EPE->value => "Nombre de projets d'EP conventionnel",
                                            LabelType::EPE => "Nombre de projets d'EP conventionnel"
                                        })
                                        ->numeric()
                                        ->integer()
                                        ->placeholder(0)
                                        ->minValue(0),
                                    TextInput::make('number_of_metric')
                                        ->label(fn ($get) => match ($get('label')) {
                                            LabelType::PV->value => 'Nombre de kWc installées',
                                            LabelType::PV => 'Nombre de kWc installées',
                                            LabelType::EPE->value => "Nombre de projets d'EP solaire",
                                            LabelType::EPE => "Nombre de projets d'EP solaire",
                                        })
                                        ->numeric()
                                        ->integer()
                                        ->placeholder(0)
                                        ->minValue(0),
                                ]),
                        ],
                        UserType::Company => [
                            TextInput::make('name')
                                ->label('Nom de l\'entreprise')
                                ->placeholder('Nom de l\'entreprise')
                                ->required(),
                            Select::make('activity_area_id')
                                ->label('Secteur d\'activité')
                                ->options(ActivityArea::all()->pluck('name', 'id')),
                            TextInput::make('responsible_name')
                                ->label('Nom du responsable')
                                ->placeholder('Nom du responsable')
                                ->required(),
                            TextInput::make('responsible_job')
                                ->label('Fonction du responsable')
                                ->placeholder('Fonction du responsable'),
                            TextInput::make('phone')
                                ->label('Téléphone')
                                ->tel()
                                ->placeholder('+213 555 555 555'),
                            TextInput::make('website')
                                ->label('Site web')
                                ->url()
                                ->placeholder('https://example.com'),
                            TextInput::make('address')
                                ->label('Adresse')
                                ->placeholder('Adresse')
                                ->columnSpanFull(),
                            SpatieMediaLibraryFileUpload::make('file')
                                ->label('Registre de commerce')
                                ->disk('private')
                                ->collection('companies_registries')
                                ->downloadable()
                                ->previewable(false)
                                ->acceptedFileTypes(['application/pdf', 'image/*'])
                                ->maxSize(1024 * 12)
                                ->columnSpanFull(), // 12mb
                        ],
                        UserType::Provider => [

                            TextInput::make('name')
                                ->label('Nom de l\'entreprise')
                                ->placeholder('Nom de l\'entreprise')
                                ->required(),
                            Select::make('activity_area_id')
                                ->label('Secteur d\'activité')
                                ->options(ActivityArea::all()->pluck('name', 'id')),
                            TextInput::make('responsible_name')
                                ->label('Nom du responsable')
                                ->placeholder('Nom du responsable')
                                ->required(),
                            TextInput::make('responsible_job')
                                ->label('Fonction du responsable')
                                ->placeholder('Fonction du responsable'),
                            TextInput::make('phone')
                                ->label('Téléphone')
                                ->tel()
                                ->placeholder('+213 555 555 555'),
                            TextInput::make('website')
                                ->label('Site web')
                                ->url()
                                ->placeholder('https://example.com'),
                            TextInput::make('address')
                                ->label('Adresse')
                                ->placeholder('Adresse')
                                ->columnSpanFull(),
                            SpatieMediaLibraryFileUpload::make('file')
                                ->label('Registre de commerce')
                                ->disk('private')
                                ->collection('providers_registries')
                                ->downloadable()
                                ->previewable(false)
                                ->acceptedFileTypes(['application/pdf', 'image/*'])
                                ->maxSize(1024 * 12)
                                ->columnSpanFull(), // 12mb
                        ],
                        default => []
                    }),
            ])->statePath('data')
            ->model($this->user);
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
        $this->user->update($data);
        Notification::make()
            ->success()
            ->title('Profil mis à jour')
            ->send();
    }
}
