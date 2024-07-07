<?php

namespace App\Enums;

enum PostType: string
{
    case Article = 'article';
    case Guide = 'guide';
    case Resource = 'resource';
    case BestPractices = 'best_practices';
    case StandardsPV = 'standards_pv';
    case StandardsEpe = 'standards_epe';
}
