<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ProfessionalStatus: string implements HasColor, HasLabel
{
    case Employed = 'employed';
    case Unemployed = 'unemployed';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Employed => 'Employé',
            self::Unemployed => 'Chômeur',
        };
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::Employed => 'info',
            self::Unemployed => 'gray'
        };
    }
}
