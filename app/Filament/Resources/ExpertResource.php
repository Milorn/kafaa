<?php

namespace App\Filament\Resources;

use App\Enums\LabelType;
use App\Enums\ProfessionalStatus;
use App\Enums\UserType;
use App\Filament\Resources\ExpertResource\Pages;
use App\Models\Expert;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
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
                Section::make('Informations personnelles')
                    ->relationship('user')
                    ->mutateRelationshipDataBeforeCreateUsing(function ($data) {
                        $data['type'] = UserType::Expert;

                        return $data;
                    })
                    ->columns(2)
                    ->schema([
                        TextInput::make('lname')
                            ->label('Nom')
                            ->placeholder('Nom')
                            ->required(),
                        TextInput::make('fname')
                            ->label('Prénom')
                            ->placeholder('Prénom')
                            ->required(),
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
                            ->required(fn ($context) => $context == 'create'),
                        TextInput::make('phone')
                            ->label('Téléphone')
                            ->placeholder('+213 555 555 555')
                            ->tel(),
                        TextInput::make('job')
                            ->label('Poste')
                            ->placeholder('Poste'),
                        TextInput::make('address')
                            ->label('Adresse')
                            ->placeholder('Adresse')
                            ->columnSpanFull(),
                    ]),
                Section::make('Informations professionnelles')
                    ->columns(2)
                    ->schema([
                        Select::make('type')
                            ->label('Type du label')
                            ->options(LabelType::class)
                            ->required()
                            ->live()
                            ->disabledOn('edit'),
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
                            ->placeholder('0')
                            ->visible(fn ($get) => $get('type')),
                        TextInput::make('number_of_metric')
                            ->label(fn ($get) => $get('type') == LabelType::PV->value ? 'Nombre de kWc installées' : 'Nombre de projets d\'EP solaire')
                            ->numeric()
                            ->minValue(0)
                            ->placeholder('0')
                            ->visible(fn ($get) => $get('type')),
                        Select::make('professional_status')
                            ->label('Statut professionnel')
                            ->options(ProfessionalStatus::class),
                        Group::make()
                            ->columnSpanFull()
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
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('type')
                    ->label('Type')
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
                SelectFilter::make('type')
                    ->label('Type')
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
            ]);
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
