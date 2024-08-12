<?php

namespace App\Filament\Resources;

use App\Enums\LabelType;
use App\Enums\ProfessionalStatus;
use App\Filament\Resources\ExpertResource\Pages;
use App\Models\Expert;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

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
                //
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
