<?php

namespace App\Models\Product;

use InvalidArgumentException;

class Product
{
    public function __construct(
        private string $code,
        private string $name,
        private int    $price
    )
    {
        // if the price is negative or zero, throw an exception
        if ($price <= 0) {
            throw new InvalidArgumentException('Price must be positive');
        }
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }
}