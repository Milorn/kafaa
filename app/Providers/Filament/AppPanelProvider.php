<?php

namespace App\Providers\Filament;

use App\Livewire\UpdateProfile;
use DutchCodingCompany\FilamentDeveloperLogins\FilamentDeveloperLoginsPlugin;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Notifications\Notification;
use Filament\Pages;
use Filament\Pages\Auth\EditProfile;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;
use SolutionForest\FilamentTranslateField\FilamentTranslateFieldPlugin;

class AppPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('app')
            ->path('app')
            ->login()
            ->profile(EditProfile::class)
            ->colors([
                'primary' => '#066938',
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->navigationGroups($this->getNavigationGroups())
            ->plugins($this->getPlugins())
            ->viteTheme('resources/css/filament/app/theme.css')
            ->brandLogo(asset('images/cerefe_logo.png'))
            ->brandLogoHeight('3rem');
    }

    public function boot(): void
    {
        // Page::$reportValidationErrorUsing = function () {
        //     Notification::make()
        //         ->title('Erreur')
        //         ->body('Veuillez vérifier vos données')
        //         ->danger()
        //         ->send();
        // };

        TextInput::configureUsing(function (TextInput $input) {
            $input->maxLength(200);
        });

        Select::configureUsing(function (Select $select) {
            $select->native(false);
        });

        DatePicker::configureUsing(function (DatePicker $datePicker) {
            $datePicker->native(false)
                ->closeOnDateSelection()
                ->placeholder('01/01/1970')
                ->format('Y-m-d')
                ->displayFormat('d/m/Y')
                ->weekStartsOnSunday()
                ->prefixIcon('heroicon-o-calendar-days');
        });

        TextColumn::configureUsing(function (TextColumn $column) {
            $column->limit(50)
                ->placeholder('Vide');
        });

        RichEditor::configureUsing(function (RichEditor $editor) {
            $editor->disableToolbarButtons(['attachFiles', 'codeBlock']);
        });
    }

    private function getNavigationGroups(): array
    {
        return [
            NavigationGroup::make('users')
                ->label('Utilisateurs'),
        ];
    }

    private function getPlugins(): array
    {
        return [
            FilamentEditProfilePlugin::make()
                ->shouldRegisterNavigation(false)
                ->shouldShowDeleteAccountForm(false),
            FilamentTranslateFieldPlugin::make()
                ->defaultLocales(['fr', 'ar']),
            BreezyCore::make()
                ->myProfile()
                ->enableTwoFactorAuthentication()
                ->myProfileComponents([
                    'personal_info' => UpdateProfile::class,
                ]),
        ];
    }
}
