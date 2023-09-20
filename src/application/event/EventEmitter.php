<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\caledonia\domain\Good;
use example\caledonia\domain\Price;

interface EventEmitter
{
    /**
     * @psalm-param positive-int $amount
     */
    public function goodPurchased(Good $good, Price $price, int $amount): void;

    /**
     * @psalm-param positive-int $amount
     */
    public function goodSold(Good $good, Price $price, int $amount): void;

    public function priceChanged(Good $good, Price $old, Price $new): void;
}
