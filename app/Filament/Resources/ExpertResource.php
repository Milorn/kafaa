<?php

namespace App\Filament\Resources;

use App\Enums\LabelType;
use App\Enums\ProfessionalStatus;
use App\Enums\UserType;
use App\Filament\Resources\ExpertResource\Pages;
use App\Models\Expert;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Rawilk\FilamentPasswordInput\Password;

class ExpertResource extends Resource
{
    protected static ?string $model = Expert::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationGroup = 'Utilisateurs';

    protected static ?int $navigationSort = 4;

    protected static ?string $modelLabel = 'Installateur';

    protected static ?string $pluralModelLabel = 'Installateurs';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informations de connexion')
                    ->relationship('user')
                    ->visible(fn ($record) => $record && $record->user)
                    ->mutateRelationshipDataBeforeCreateUsing(function ($data) {
                        $data['type'] = UserType::Expert;

                        return $data;
                    })
                    ->columns(2)
                    ->schema([
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->placeholder('example@email.com')
                            ->unique(ignorable: fn ($record) => $record)
                            ->required(),
                        Password::make('password')
                            ->label('Mot de passe')
                            ->placeholder('*******')
                            ->copyable()
                            ->hintAction(fn ($set) => Action::make('generate')
                                ->label('Genérer')
                                ->action(fn () => $set('password', Str::password(12))))
                            ->required(fn ($context) => $context == 'create')
                            ->dehydrated(fn ($state): bool => filled($state))
                            ->dehydrateStateUsing(fn ($state): string => Hash::make($state)),
                    ]),
                Section::make('Informations professionnelles')
                    ->columns(2)
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('image')
                            ->label('Image')
                            ->disk('public')
                            ->collection('experts_avatars')
                            ->image()
                            ->imageEditor()
                            ->avatar()
                            ->columnSpanFull(),
                        Grid::make()
                            ->columns(2)
                            ->columnSpanFull()
                            ->schema([
                                Select::make('company_id')
                                    ->label('Entreprise')
                                    ->relationship('company', 'name')
                                    ->searchable()
                                    ->preload(),
                            ]),
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
                            ->placeholder('email@example.com')
                            ->email(),
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
                            ->disk('private')
                            ->collection('experts_resumees')
                            ->downloadable()
                            ->previewable(false)
                            ->acceptedFileTypes(['application/pdf', 'image/*'])
                            ->maxSize(1024 * 12)
                            ->columnSpanFull(), // 12mb

                    ]),
                Section::make('Experience professionnelles')
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('lname')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('fname')
                    ->label('Prénom')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('label')
                    ->label('Label')
                    ->sortable()
                    ->badge(),
                TextColumn::make('professional_status')
                    ->label('Status professionnel')
                    ->sortable()
                    ->badge(),
                TextColumn::make('created_at')
                    ->label('Créé le')
                    ->datetime()
                    ->badge()
                    ->color('gray')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Modifié le')
                    ->datetime()
                    ->badge()
                    ->color('gray')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('label')
                    ->label('Label')
                    ->options(LabelType::class)
                    ->native(false),
                SelectFilter::make('professional_status')
                    ->label('Statut professionnel')
                    ->options(ProfessionalStatus::class)
                    ->multiple(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->modifyQueryUsing(function ($query) {
                if (auth()->user()->isCompany()) {
                    $query->where('company_id', auth()->user()->userable_id);
                }
            });
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExperts::route('/'),
            'create' => Pages\CreateExpert::route('/create'),
            'edit' => Pages\EditExpert::route('/{record}/edit'),
        ];
    }
}
