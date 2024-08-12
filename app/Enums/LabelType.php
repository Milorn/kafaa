<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum LabelType: string implements HasLabel
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
}
