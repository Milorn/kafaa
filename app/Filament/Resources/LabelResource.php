<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LabelResource\Pages;
use App\Models\Label;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
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
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
