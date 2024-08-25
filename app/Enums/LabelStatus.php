<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum LabelStatus: string implements HasColor, HasLabel
{
    case Accepted = 'accepted';
    case Pending = 'pending';
    case Rejected = 'rejected';
    case Renewal = 'renewal';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Accepted => 'Accepté',
            self::Pending => 'En attente',
            self::Rejected => 'Rejeté',
            self::Renewal => 'Renouvellement'
        };
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::Accepted => 'success',
            self::Pending => 'warning',
            self::Rejected => 'danger',
            self::Renewal => 'info'
        };
    }
}
