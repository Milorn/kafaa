<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum PostType: string implements HasLabel
{
    case Article = 'article';
    case Guide = 'guide';
    case Documents = 'documents';
    case BestPractices = 'best_practices';
    case StandardsPV = 'standards_pv';
    case StandardsEpe = 'standards_epe';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Article => 'Article',
            self::Guide => 'Guide',
            self::Documents => 'Documents',
            self::BestPractices => 'Bonne pratique',
            self::StandardsPV => 'Standard PV',
            self::StandardsEpe => 'Standard EPE',
        };
    }
}
