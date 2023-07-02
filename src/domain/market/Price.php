<?php declare(strict_types=1);
namespace example\caledonia\domain;

/**
 * @psalm-immutable
 */
final readonly class Price
{
    /**
     * @psalm-var positive-int
     */
    private int $price;

    /**
     * @psalm-param positive-int $price
     *
     * @throws PriceMustBePositiveException
     */
    public static function from(int $price): self
    {
        return new self($price);
    }

    /**
     * @psalm-param positive-int $price
     *
     * @throws PriceMustBePositiveException
     */
    private function __construct(int $price)
    {
        $this->ensurePriceIsPositive($price);

        $this->price = $price;
    }

    /**
     * @psalm-return positive-int
     */
    public function asInt(): int
    {
        return $this->price;
    }

    public function equals(self $other): bool
    {
        return $this->asInt() === $other->asInt();
    }

    /**
     * @throws PriceMustBePositiveException
     */
    private function ensurePriceIsPositive(int $price): void
    {
        if ($price < 1) {
            throw new PriceMustBePositiveException;
        }
    }
}
