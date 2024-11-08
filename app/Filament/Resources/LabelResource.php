<?php

namespace App\Filament\Resources;

use App\Enums\LabelStatus;
use App\Enums\LabelType;
use App\Filament\Resources\LabelResource\Pages;
use App\Models\Label;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LabelResource extends Resource
{
    protected static ?string $model = Label::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-check';

    protected static ?int $navigationSort = 3;

    protected static ?string $modelLabel = 'Label';

    protected static ?string $pluralModelLabel = 'Labels';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->columns(2)
                    ->schema([
                        Select::make('expert_id')
                            ->label('Installateur')
                            ->relationship('expert')
                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->user->name)
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('type')
                            ->label('Type')
                            ->options(LabelType::class)
                            ->required(),
                        DatePicker::make('starts_on')
                            ->label('Date de début')
                            ->default(today())
                            ->required(),
                        DatePicker::make('expires_on')
                            ->label('Date d\'expiration')
                            ->required(),
                        Select::make('status')
                            ->label('Etat du label')
                            ->options(LabelStatus::class)
                            ->default(LabelStatus::Accepted)
                            ->required(),
                        SpatieMediaLibraryFileUpload::make('file')
                            ->label('Document')
                            ->disk('public')
                            ->collection('labels_certificates')
                            ->downloadable()
                            ->acceptedFileTypes(['application/pdf', 'image/*'])
                            ->maxSize(1024 * 12)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('expert.user.name')
                    ->label('Nom')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Etat')
                    ->badge()
                    ->sortable(),
                TextColumn::make('starts_on')
                    ->label('Date de début')
                    ->date()
                    ->badge()
                    ->sortable(),
                TextColumn::make('expires_on')
                    ->label('Date d\'éxpiration')
                    ->date()
                    ->badge()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Créé le')
                    ->datetime()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label('Modifié le')
                    ->datetime()
                    ->toggleable(isToggledHiddenByDefault: true)
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
            'index' => Pages\ListLabels::route('/'),
            'create' => Pages\CreateLabel::route('/create'),
            'edit' => Pages\EditLabel::route('/{record}/edit'),
        ];
    }
}
