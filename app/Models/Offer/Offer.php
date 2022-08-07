<?php

namespace App\Models\Offer;

class Offer
{
    private int $amount;
    private OfferType $type;

    public function __construct(
        int $amount,
        OfferType $type = OfferType::NONE
    ) {
        $this->amount = $amount;
        $this->type = $type;
    }

    public function calculate(int $total): int
    {
        return match ($this->type) {
            OfferType::PERCENT => $total - ($total * $this->amount / 100),
            OfferType::FIXED => $total - $this->amount,
            default => $total,
        };
    }

    public function hasOffer(): bool
    {
        return $this->type !== OfferType::NONE;
    }
}
