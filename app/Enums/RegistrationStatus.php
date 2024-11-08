<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum RegistrationStatus: string implements HasColor, HasLabel
{
    case Pending = 'pending';
    case Accepted = 'accepted';
    case Rejected = 'rejected';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Pending => 'En attente',
            self::Accepted => 'Accepté',
            self::Rejected => 'Rejeté',
        };
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::Accepted => 'success',
            self::Pending => 'warning',
            self::Rejected => 'danger'
        };
    }
}
