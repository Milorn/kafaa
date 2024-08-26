<?php

namespace App\Filament\Resources;

use App\Enums\UserType;
use App\Filament\Resources\CompanyResource\Pages;
use App\Filament\Resources\CompanyResource\RelationManagers\ExpertsRelationManager;
use App\Models\ActivityArea;
use App\Models\Company;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
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

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $navigationGroup = 'Utilisateurs';

    protected static ?int $navigationSort = 2;

    protected static ?string $modelLabel = 'Entreprise';

    protected static ?string $pluralModelLabel = 'Entreprises';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informations personnelles')
                    ->relationship('user')
                    ->mutateRelationshipDataBeforeCreateUsing(function ($data) {
                        $data['type'] = UserType::Company;

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
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('activityArea.name')
                    ->label('Secteur d\'activité')
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
                SelectFilter::make('activity_area_id')
                    ->label('Secteur d\'activité')
                    ->relationship('activityArea', 'name')
                    ->searchable()
                    ->preload()
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
            ExpertsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),
        ];
    }
}
