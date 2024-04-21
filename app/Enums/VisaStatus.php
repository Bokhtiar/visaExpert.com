<?php

namespace App\Enums;

use Illuminate\Support\Collection;

enum VisaStatus
{
    case PENDING;

    case PROCESSING;

    case CHECKING;

    case READY;

    case DELIVERED;

    public function toString(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::PROCESSING => 'Processing',
            self::CHECKING => 'Checking Completed almost Ready',
            self::READY => 'Ready to Delivery',
            self::DELIVERED => 'Delivered'
        };
    }

    public static function collection(): Collection
    {
        return collect(self::cases())->map(fn ($i) => $i->toString());
    }
}
