<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rocket-launch';

    protected static ?int $navigationSort = 5;

    protected static ?string $modelLabel = 'Projet';

    protected static ?string $pluralModelLabel = 'Projets';

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
                            ->required()
                            ->visible(auth()->user()->isAdmin()),
                        TextInput::make('name')
                            ->label('Nom du projet')
                            ->placeholder('Nom')
                            ->required(),
                        DatePicker::make('started_on')
                            ->label('Date de début'),
                        DatePicker::make('finished_on')
                            ->label('Date de fin'),
                        RichEditor::make('description')
                            ->label('Description')
                            ->columnSpanFull(),
                        SpatieMediaLibraryFileUpload::make('attachments')
                            ->label('Piéces jointes')
                            ->collection('projects_attachments')
                            ->multiple()
                            ->disk('public')
                            ->columnSpanFull()
                            ->downloadable()
                            ->previewable(false)
                            ->reorderable()
                            ->appendFiles(),
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
                TextColumn::make('started_on')
                    ->label('Date de début')
                    ->date()
                    ->badge()
                    ->placeholder('Vide')
                    ->sortable(),
                TextColumn::make('finished_on')
                    ->label('Date de fin')
                    ->date()
                    ->badge()
                    ->placeholder('Vide')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime()
                    ->badge()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Modifié le')
                    ->dateTime()
                    ->badge()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            ])->modifyQueryUsing(function($query) {
                if(auth()->user()->isExpert()) {
                    $query->where('expert_id', auth()->user()->userable_id);
                }
            });
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
