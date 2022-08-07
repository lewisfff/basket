<?php

namespace App\Models\Basket;

use App\Models\Offer\Offer;
use App\Models\Product\Product;
use App\Models\Product\ProductCollection;
use InvalidArgumentException;

class Basket
{
    private ?Offer $offer;
    private ProductCollection $portfolio;
    private ProductCollection $basketProducts;

    public function __construct(ProductCollection $portfolio, Offer $offer = null)
    {
        $this->offer = $offer;
        $this->portfolio = $portfolio;
        $this->basketProducts = new ProductCollection();
    }

    public function addProduct(Product $product): void
    {
        if (!$this->portfolio->hasProduct($product)) {
            throw new InvalidArgumentException('Product not in portfolio');
        }

        if ($this->basketProducts->hasProduct($product)) {
            throw new InvalidArgumentException('Product already in basket');
        }

        $this->basketProducts->add($product);
    }

    public function getProducts(): array
    {
        return $this->basketProducts->get();
    }

    public function getTotal(): int
    {
        // if the basket is empty, return 0
        if (count($this->basketProducts->get()) === 0) {
            return 0;
        }

        // add up the price of all products in the basket
        $total = array_reduce($this->basketProducts->get(), static function (int $total, Product $product) {
            return $total + $product->getPrice();
        }, 0);

        // if there is an offer, apply it
        if ($this->offer !== null && $this->offer->hasOffer()) {
            $total = $this->offer->calculate($total);
        }

        return $total;
    }
}