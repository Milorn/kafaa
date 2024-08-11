<?php

namespace App\Livewire;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Jeffgreco13\FilamentBreezy\Livewire\MyProfileComponent;
use Jeffgreco13\FilamentBreezy\Livewire\PersonalInfo;
use Livewire\Component;

class ProfileInfoComponent extends PersonalInfo
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('fname')
                    ->label('Prénom')
                    ->placeholder('Prénom')
                    ->required(),
                TextInput::make('lname')
                    ->label('Nom')
                    ->placeholder('Nom')
                    ->required(),
            ])
            ->columns(1)
            ->statePath('data');
    }
}
