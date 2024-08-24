<?php

namespace App\Enums;

use Illuminate\Support\Collection;

enum UserType
{
    case ADMIN;
    case STAFF;
    case AGENT;

    public function toString(): string
    {
        return match ($this) {
            self::ADMIN => 'admin',
            self::STAFF => 'staff',
            self::AGENT => 'agent',
        };
    }

    public static function collection(): Collection
    {
        return collect(self::cases())->map(fn ($i) => $i->toString());
    }
}
