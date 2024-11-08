<?php

namespace App\Filament\Resources\TrainingResource\RelationManagers;

use App\Enums\RegistrationStatus;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RegistrationsRelationManager extends RelationManager
{
    protected static string $relationship = 'registrations';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('expert_id')
                    ->label('Expert')
                    ->relationship('expert')
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->fullname)
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('status')
                    ->label('Statut')
                    ->options(RegistrationStatus::class)
                    ->default(RegistrationStatus::Pending)
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('expert.fullname')
                    ->label('Expert')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Date d\'inscription')
                    ->date()
                    ->sortable()
                    ->badge(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->modalHeading('Nouvelle inscription')
                    ->createAnother(false),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->heading('Inscriptions')
            ->modelLabel('Inscription')
            ->pluralModelLabel('Inscriptions');
    }
}
