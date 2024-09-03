<?php

namespace App\Filament\Resources;

use App\Enums\UserType;
use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
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
                Select::make('type')
                    ->label('Type')
                    ->options(UserType::class)
                    ->required(),
                Grid::make(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nom')
                            ->placeholder('Nom'),
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->placeholder('example@email.com')
                            ->unique(ignorable: fn ($record) => $record)
                            ->required(),
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
                    ->searchable()
                    ->extraAttributes(['class' => 'underline'])
                    ->url(fn ($record) => match ($record->type) {
                        UserType::Expert => ExpertResource::getUrl('edit', ['record' => $record->userable_id]),
                        UserType::Company => CompanyResource::getUrl('edit', ['record' => $record->userable_id]),
                        UserType::Provider => ProviderResource::getUrl('edit', ['record' => $record->userable_id]),
                        default => ''
                    }),
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
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->modifyQueryUsing(fn ($query) => $query->where('type', '!=', UserType::Admin));
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
        ];
    }
}
