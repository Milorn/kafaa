<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrainingResource\Pages;
use App\Filament\Resources\TrainingResource\RelationManagers;
use App\Models\Training;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TrainingResource extends Resource
{
    protected static ?string $model = Training::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?int $navigationSort = 5;

    protected static ?string $modelLabel = 'Formation';

    protected static ?string $pluralModelLabel = 'Formations';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        DatePicker::make('starts_on')
                            ->label('Date de début')
                            ->required(),
                        DatePicker::make('ends_on')
                            ->label('Date de fin')
                            ->required(),
                        TextInput::make('objective')
                            ->label('Objectif')
                            ->placeholder('Objectif')
                            ->required(),
                        TextInput::make('level')
                            ->label('Niveau requis')
                            ->placeholder('Niveau requis'),
                        TextInput::make('duration')
                            ->label('Durée')
                            ->placeholder('Durée'),
                        TextInput::make('trainer')
                            ->label('Formateur')
                            ->placeholder('Formateur'),
                        TextInput::make('location')
                            ->label('Lieu')
                            ->placeholder('Lieu')
                            ->columnSpanFull(),
                        SpatieMediaLibraryFileUpload::make('file')
                            ->label('Fiche technique')
                            ->disk('public')
                            ->collection('trainings_documents')
                            ->downloadable()
                            ->previewable(false)
                            ->maxSize(1024 * 12)
                            ->columnSpanFull(), // 12mb
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('starts_on')
                    ->label('Date de début')
                    ->date()
                    ->badge()
                    ->sortable(),
                TextColumn::make('ends_on')
                    ->label('Date de fin')
                    ->date()
                    ->badge()
                    ->sortable(),
                TextColumn::make('objective')
                    ->label('Objectif')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Créé le')
                    ->datetime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Modifié le')
                    ->datetime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
            ])
            ->filters([
                //
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
            'index' => Pages\ListTrainings::route('/'),
            'create' => Pages\CreateTraining::route('/create'),
            'edit' => Pages\EditTraining::route('/{record}/edit'),
        ];
    }
}
