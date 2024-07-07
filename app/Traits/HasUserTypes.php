<?php

namespace App\Traits;

use App\Enums\UserType;

trait HasUserTypes
{
    public function isAdmin(): bool
    {
        return $this->isType(UserType::Admin);
    }

    public function isCompany(): bool
    {
        return $this->isType(UserType::Company);
    }

    public function isExpert(): bool
    {
        return $this->isType(UserType::Expert);
    }

    public function isProvider(): bool
    {
        return $this->isType(UserType::Provider);
    }

    public function isType(UserType $type): bool
    {
        return $this->type == $type;
    }

    public function isTypeOf(array $types): bool
    {
        return collect($types)->contains($this->type);
    }
}
