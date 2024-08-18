<?php

namespace App\Filament\Resources;

use App\Enums\UserType;
use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms\Components\Actions\Action;
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
use STS\FilamentImpersonate\Tables\Actions\Impersonate;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Utilisateurs';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Compte';

    protected static ?string $pluralModelLabel = 'Comptes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informations personnelles')
                    ->columns(2)
                    ->schema([
                        Group::make([
                            Select::make('type')
                                ->label('Type')
                                ->options(UserType::class)
                                ->required(),
                        ])->columns(2)
                            ->columnSpanFull(),
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nom')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Créé le')
                    ->datetime()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Modifié le')
                    ->datetime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('Type')
                    ->options(UserType::class)
                    ->multiple(),
            ])
            ->actions([
                Impersonate::make()
                    ->link()
                    ->label('Imiter')
                    ->color('info')
                    ->redirectTo(route('filament.app.pages.my-profile')),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
