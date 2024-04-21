<?php

use App\Enums\PaymentStatus;
use App\Enums\VisaStatus;

function displayVisaStatusBadge($status): string
{
    return match ($status) {
        VisaStatus::PENDING->toString() => '<span class="badge bg-warning text-uppercase">'.$status.'</span>',
        VisaStatus::PROCESSING->toString() => '<span class="badge bg-primary text-uppercase">'.$status.'</span>',
        VisaStatus::CHECKING->toString() => '<span class="badge bg-info text-uppercase">'.$status.'</span>',
        VisaStatus::READY->toString() => '<span class="badge bg-secondary text-uppercase">'.$status.'</span>',
        VisaStatus::DELIVERED->toString() => '<span class="badge bg-success text-uppercase">'.$status.'</span>',
        default => '',
    };
}

function displayPaymentStatusBadge($status): string
{
    return match ($status) {
        PaymentStatus::PAID->toString() => '<span class="badge bg-success text-uppercase">'.$status.'</span>',
        PaymentStatus::DUE->toString() => '<span class="badge bg-danger text-uppercase">'.$status.'</span>',
        default => '',
    };
}
