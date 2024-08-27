<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Filament\Pages\SimplePage;

class RegisterPage extends SimplePage
{
    use InteractsWithFormActions;

    protected static string $view = 'filament.pages.register-page';

    public function register()
    {

    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
            ])->columns(2);
    }

    protected function hasFullWidthFormActions(): bool
    {
        return true;
    }
}
