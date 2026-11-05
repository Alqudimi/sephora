<?php

namespace App\Services\Payments;

final class PaymentResult
{
    public function __construct(
        public readonly bool $paid,
        public readonly ?string $redirectUrl = null,
        public readonly ?string $reference = null,
        public readonly ?string $gateway = null,
        public readonly array $payload = [],
    ) {}
}
