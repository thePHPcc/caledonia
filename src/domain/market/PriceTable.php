<?php declare(strict_types=1);
namespace example\caledonia\domain;

final readonly class PriceTable
{
    /**
     * @psalm-return non-empty-list<Price>
     */
    public function for(Good $good): array
    {
        return match ($good::class) {
            Bread::class  => [Price::from(7), Price::from(8), Price::from(9), Price::from(10), Price::from(11), Price::from(11), Price::from(12), Price::from(13), Price::from(14), Price::from(15)],
            Cheese::class => [Price::from(7), Price::from(8), Price::from(9), Price::from(10), Price::from(11), Price::from(12), Price::from(13), Price::from(14), Price::from(14), Price::from(15)],
            Grain::class  => [Price::from(3), Price::from(3), Price::from(4), Price::from(5), Price::from(6), Price::from(6), Price::from(7), Price::from(7), Price::from(8), Price::from(8)],
            Milk::class   => [Price::from(3), Price::from(4), Price::from(5), Price::from(5), Price::from(6), Price::from(6), Price::from(7), Price::from(7), Price::from(8), Price::from(8)],
            Whisky::class => [Price::from(8), Price::from(9), Price::from(10), Price::from(11), Price::from(12), Price::from(13), Price::from(13), Price::from(14), Price::from(15), Price::from(16)],
            Wool::class   => [Price::from(3), Price::from(3), Price::from(4), Price::from(4), Price::from(5), Price::from(5), Price::from(6), Price::from(6), Price::from(7), Price::from(8)],
        };
    }
}
