<?php

namespace App\Filament\Resources\CompanyResource\RelationManagers;

use App\Filament\Resources\ExpertResource;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Table;

class ExpertsRelationManager extends RelationManager
{
    protected static string $relationship = 'experts';

    public function form(Form $form): Form
    {
        return ExpertResource::form($form);
    }

    public function table(Table $table): Table
    {
        return ExpertResource::table($table)
            ->headerActions([
                CreateAction::make(),
            ])->heading('Installateurs')
            ->modelLabel('Installateur')
            ->pluralModelLabel('Installateurs');
    }
}
