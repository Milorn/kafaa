<?php

namespace App\Filament\Resources\CompanyResource\RelationManagers;

use App\Filament\Resources\ExpertResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                CreateAction::make()
            ])->heading('Installateurs')
            ->modelLabel('Installateur')
            ->pluralModelLabel('Installateurs');
    }
}
