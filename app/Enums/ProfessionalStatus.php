<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum ProfessionalStatus: string implements HasLabel
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
}
