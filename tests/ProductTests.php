<?php

use App\Models\Product\Product;
use PHPUnit\Framework\TestCase;

class ProductTests extends TestCase
{
    public function testGetCode(): void
    {
        $product = new Product('code', 'name', 10);
        $this->assertEquals('code', $product->getCode());
    }

    public function testGetName(): void
    {
        $product = new Product('code', 'name', 10);
        $this->assertEquals('name', $product->getName());
    }

    public function testGetPrice(): void
    {
        $product = new Product('code', 'name', 10);
        $this->assertEquals(10, $product->getPrice());
    }

    public function testGetPriceWithZero(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Product('code', 'name', 0);
    }

    public function testGetPriceWithNegative(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Product('code', 'name', -10);
    }
}