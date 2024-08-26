<?php

namespace App\Filament\Resources;

use App\Enums\EquipmentStatus;
use App\Enums\UserType;
use App\Filament\Resources\EquipmentResource\Pages;
use App\Models\Equipment;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class EquipmentResource extends Resource
{
    protected static ?string $model = Equipment::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    protected static ?int $navigationSort = 2;

    protected static ?string $modelLabel = 'Equipement';

    protected static ?string $pluralModelLabel = 'Equipements';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nom')
                            ->placeholder('Nom')
                            ->required(),
                        Select::make('status')
                            ->label('Statut')
                            ->options(EquipmentStatus::class)
                            ->visible(fn ($context) => $context == 'edit')
                            ->disabled(Auth::user()->type != UserType::Admin),
                        Textarea::make('description')
                            ->label('Description')
                            ->placeholder('description')
                            ->columnSpanFull()
                            ->required(),
                        /* FileUpload::make('path')
                            ->storeFileNamesIn('name')
                            ->multiple()
                            ->label('Fiches')
                            ->disk('private')
                            ->directory('equipments/files')
                            ->downloadable()
                            ->previewable(false)
                            ->acceptedFileTypes(['application/pdf', 'image/*'])
                            ->maxFiles(10)
                            ->maxSize(1024 * 12)
                            ->required() // 12mb */
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
                TextColumn::make('status')
                    ->label('Statut')
                    ->badge(),
                TextColumn::make('created_at')
                    ->label('Ajouté le ')
                    ->datetime()
                    ->badge()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListEquipment::route('/'),
            'create' => Pages\CreateEquipment::route('/create'),
            'edit' => Pages\EditEquipment::route('/{record}/edit'),
        ];
    }
}