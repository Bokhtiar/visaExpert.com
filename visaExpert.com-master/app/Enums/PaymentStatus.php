<?php

namespace App\Enums;

use Illuminate\Support\Collection;

enum PaymentStatus
{
    case DUE;
    case PAID;

    public function toString(): string
    {
        return match ($this) {
            self::DUE => 'Due',
            self::PAID => 'Paid'
        };
    }

    public static function collection(): Collection
    {
        return collect(self::cases())->map(fn ($i) => $i->toString());
    }
}
