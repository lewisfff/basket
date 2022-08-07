<?php

namespace App\Models\Product;

class ProductCollection
{
    private ?array $products;

    public function __construct()
    {
        $this->products = [];
    }

    public function get(): array
    {
        return $this->products;
    }

    public function add(Product $product): void
    {
        $this->products[$product->getCode()] = $product;
    }

    public function hasProduct(Product $product): bool
    {
        return isset($this->products[$product->getCode()]);
    }
}