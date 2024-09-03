<?php

namespace App\Filament\Resources;

use App\Enums\UserType;
use App\Filament\Resources\ProviderResource\Pages;
use App\Models\ActivityArea;
use App\Models\Provider;
use Filament\Forms\Components\Actions\Action;
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

class ProviderResource extends Resource
{
    protected static ?string $model = Provider::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    protected static ?string $navigationGroup = 'Utilisateurs';

    protected static ?int $navigationSort = 3;

    protected static ?string $modelLabel = 'Fournisseur';

    protected static ?string $pluralModelLabel = 'Fournisseurs';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informations de connexion')
                    ->relationship('user')
                    ->mutateRelationshipDataBeforeCreateUsing(function ($data) {
                        $data['type'] = UserType::Provider;

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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProviders::route('/'),
            'create' => Pages\CreateProvider::route('/create'),
            'edit' => Pages\EditProvider::route('/{record}/edit'),
        ];
    }
}
