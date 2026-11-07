<?php

namespace App\Services\Checkout;

use RuntimeException;

class InsufficientStockException extends RuntimeException
{
    public function __construct(public readonly string $productName)
    {
        parent::__construct("Insufficient stock for {$productName}.");
    }
}
