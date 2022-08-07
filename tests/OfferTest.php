<?php

use App\Models\Offer\Offer;
use App\Models\Offer\OfferType;
use PHPUnit\Framework\TestCase;

class OfferTest extends TestCase
{
    public function testHasOffer(): void
    {
        $offer = new Offer(10, OfferType::PERCENT);
        $this->assertTrue($offer->hasOffer());
    }

    public function testCalculate(): void
    {
        $offer = new Offer(10, OfferType::PERCENT);
        $this->assertEquals(90, $offer->calculate(100));
    }

    public function testCalculateFixed(): void
    {
        $offer = new Offer(10, OfferType::FIXED);
        $this->assertEquals(90, $offer->calculate(100));
    }

    public function testCalculateNone(): void
    {
        $offer = new Offer(10, OfferType::NONE);
        $this->assertEquals(100, $offer->calculate(100));
    }

    public function testCalculateNoneWithZero(): void
    {
        $offer = new Offer(10, OfferType::NONE);
        $this->assertEquals(0, $offer->calculate(0));
    }

    public function testCalculateNoneWithNegative(): void
    {
        $offer = new Offer(10, OfferType::NONE);
        $this->assertEquals(-10, $offer->calculate(-10));
    }
}
