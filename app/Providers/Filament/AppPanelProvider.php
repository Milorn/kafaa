<?php

namespace App\Providers\Filament;

use DutchCodingCompany\FilamentDeveloperLogins\FilamentDeveloperLoginsPlugin;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;
use Joaopaulolndev\FilamentEditProfile\Pages\EditProfilePage;
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
            ->registration()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
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
            ])->plugins([
                FilamentEditProfilePlugin::make()
                    ->shouldRegisterNavigation(false)
                    ->shouldShowDeleteAccountForm(false),
                FilamentDeveloperLoginsPlugin::make()
                    ->enabled()
                    ->switchable(false)
                    ->users([
                        'Admin' => 'admin@kafaa.com',
                    ]),
                FilamentTranslateFieldPlugin::make()
                    ->defaultLocales(['fr', 'ar']),
            ])->userMenuItems([
                'profile' => MenuItem::make()
                    ->label(fn () => auth()->user()->name)
                    ->url(fn (): string => EditProfilePage::getUrl())
                    ->icon('heroicon-m-user-circle'),
            ]);
    }

    public function boot(): void
    {
        // Page::$reportValidationErrorUsing = function () {
        //     Notification::make()
        //         ->title(__('general.error'))
        //         ->body(__('general.error.check'))
        //         ->danger()
        //         ->send();
        // };

        TextInput::configureUsing(function (TextInput $input) {
            $input->maxLength(200);
        });

        Textarea::configureUsing(function (Textarea $textArea) {
            $textArea->maxLength(1000);
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
            $column->limit(50);
        });

        RichEditor::configureUsing(function (RichEditor $editor) {
            $editor->disableToolbarButtons(['attachFiles', 'codeBlock']);
        });
    }
}
