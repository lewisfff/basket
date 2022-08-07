<?php

namespace App\Models\Offer;

enum OfferType: int
{
    case NONE = 0;
    case PERCENT = 1;
    case FIXED = 2;
}