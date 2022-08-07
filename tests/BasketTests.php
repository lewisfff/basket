<?php

use App\Models\Basket\Basket;
use App\Models\Offer\Offer;
use App\Models\Offer\OfferType;
use App\Models\Product\Product;
use App\Models\Product\ProductCollection;
use PHPUnit\Framework\TestCase;

class BasketTests extends TestCase
{
    private ProductCollection $portfolio;
    private Offer $offer;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        $this->portfolio = new ProductCollection();
        $this->portfolio->add(new Product('P001', 'Photography', 20000));
        $this->portfolio->add(new Product('P002', 'Floorplan', 10000));
        $this->portfolio->add(new Product('P003', 'Gas Certificate', 8350));
        $this->portfolio->add(new Product('P004', 'EICR Certificate', 5100));

        $this->offer = new Offer(10, OfferType::PERCENT);

        parent::__construct($name, $data, $dataName);
    }

    // test adding a product that is in the portfolio
    public function testAddProduct(): void
    {
        $basket = new Basket($this->portfolio, $this->offer);
        $basket->addProduct(new Product('P001', 'Photography', 20000));
        $this->assertCount(1, $basket->getProducts());
    }

    // test adding a product that is not in the portfolio
    public function testAddProductNotInPortfolio(): void
    {
        $basket = new Basket($this->portfolio, $this->offer);
        $this->expectException(InvalidArgumentException::class);
        $basket->addProduct(new Product('P005', 'Unknown Product', 10300));
    }

    // test adding a product that is in the portfolio multiple times
    public function testAddProductMultipleTimes(): void
    {
        $basket = new Basket($this->portfolio, $this->offer);
        $this->expectException(InvalidArgumentException::class);
        $basket->addProduct(new Product('P001', 'Photography', 20000));
        $basket->addProduct(new Product('P001', 'Photography', 20000));
    }

    // test adding all the products in the portfolio
    public function testAddAllProducts(): void
    {
        $basket = new Basket($this->portfolio, $this->offer);
        $basket->addProduct(new Product('P001', 'Photography', 20000));
        $basket->addProduct(new Product('P002', 'Floorplan', 10000));
        $basket->addProduct(new Product('P003', 'Gas Certificate', 8350));
        $basket->addProduct(new Product('P004', 'EICR Certificate', 5100));
        $this->assertCount(4, $basket->getProducts());
    }

    // test getting the total with an offer
    public function testGetTotal(): void
    {
        $basket = new Basket($this->portfolio, $this->offer);
        $basket->addProduct(new Product('P001', 'Photography', 20000));
        $this->assertEquals(18000, $basket->getTotal());
    }

    // test getting the total with an empty basket
    public function testGetTotalEmptyBasket(): void
    {
        $basket = new Basket($this->portfolio, $this->offer);
        $this->assertEquals(0, $basket->getTotal());
    }

    // test getting the total with no offer
    public function testGetTotalNoOffer(): void
    {
        $basket = new Basket($this->portfolio);
        $basket->addProduct(new Product('P001', 'Photography', 20000));
        $this->assertEquals(20000, $basket->getTotal());
    }

}