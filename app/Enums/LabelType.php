<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum LabelType: string implements HasColor, HasLabel
{
    case PV = 'pv';
    case EPE = 'epe';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PV => 'PV',
            self::EPE => 'EPE'
        };
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::PV => 'primary',
            self::EPE => 'warning'
        };
    }
}
