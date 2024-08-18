<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum EquipmentStatus: string implements HasColor, HasLabel
{
    case Compliant = 'compliant';
    case Pending = 'pending';
    case NonCompliant = 'non_compliant';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Compliant => 'Conforme',
            self::Pending => 'En attente',
            self::NonCompliant => 'Non conforme'
        };
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::Compliant => 'primary',
            self::Pending => 'warning',
            self::NonCompliant => 'danger'
        };
    }
}
