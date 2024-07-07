<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum UserType: string implements HasColor, HasLabel
{
    case Admin = 'admin';
    case Company = 'company';
    case Expert = 'expert';
    case Provider = 'provider';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Admin => 'Administrateur',
            self::Company => 'Entreprise',
            self::Expert => 'Installateur',
            self::Provider => 'Fournisseur',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Admin => 'success',
            self::Company => 'info',
            self::Expert => 'primary',
            self::Provider => 'warning'
        };
    }
}
