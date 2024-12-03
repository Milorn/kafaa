<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class MembershipPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?int $navigationSort = 6;

    protected static ?string $modelLabel = 'Abonnement';

    protected ?string $heading = 'Abonnements';

    protected static ?string $title = 'Abonnements';

    protected static ?string $pluralModelLabel = 'Abonnements';

    protected static ?string $navigationLabel = "Abonnements";

    protected static string $view = 'filament.pages.membership-page';
}
