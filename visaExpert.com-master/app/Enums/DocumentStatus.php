<?php

namespace App\Enums;

use Illuminate\Support\Collection;

enum DocumentStatus
{
    case ACCEPTED;
    case REJECTED;
    case REVIEW;

    public function toString(): string
    {
        return match ($this) {
            self::ACCEPTED => 'Accepted',
            self::REJECTED => 'Rejected',
            self::REVIEW => 'In review...',
        };
    }

    public static function collection(): Collection
    {
        return collect(self::cases())->map(fn ($i) => $i->toString());
    }
}
