<?php

namespace App\Livewire;

use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Jeffgreco13\FilamentBreezy\Livewire\MyProfileComponent;

class UpdatePersonalInfo extends MyProfileComponent
{
    protected $view = 'livewire.update-personal-info';

    public array $data;

    public mixed $user;

    public function mount()
    {
        $this->user = Auth::user();
        $this->form->fill($this->user->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('lname')
                    ->label('Nom')
                    ->placeholder('Nom')
                    ->required(),
                TextInput::make('fname')
                    ->label('Prénom')
                    ->placeholder('Prénom')
                    ->required(),
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->placeholder('example@email.com')
                    ->unique(ignorable: auth()->user())
                    ->required(),
                TextInput::make('job')
                    ->label('Poste')
                    ->placeholder('Poste'),
                TextInput::make('phone')
                    ->label('Téléphone')
                    ->placeholder('+213 555 555 555')
                    ->tel(),
                TextInput::make('address')
                    ->label('Adresse')
                    ->placeholder('Adresse'),

            ])
            ->statePath('data')
            ->model($this->user);
    }

    protected function getCreateFormAction(): Action
    {
        return Action::make('submit')
            ->label('Sauvegarder')
            ->submit('submit');
    }

    public function submit(): void
    {
        $data = $this->form->getState();
        $this->user->update($data);
        Notification::make()
            ->success()
            ->title('Profil mis à jour')
            ->send();
    }
}
