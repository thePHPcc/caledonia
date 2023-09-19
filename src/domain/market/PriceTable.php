<?php declare(strict_types=1);
namespace example\caledonia\domain;

/**
 * @psalm-immutable
 */
final readonly class PriceTable
{
    /**
     * @psalm-var list<Price>
     */
    private array $prices;

    /**
     * @psalm-var int<0, 9>
     */
    private int $position;

    /**
     * @psalm-param int<0, 9> $position
     *
     * @throws PriceMustBePositiveException
     */
    public static function bread(int $position): self
    {
        return new self(
            [
                Price::from(7),
                Price::from(8),
                Price::from(9),
                Price::from(10),
                Price::from(11),
                Price::from(11),
                Price::from(12),
                Price::from(13),
                Price::from(14),
                Price::from(15),
            ],
            $position,
        );
    }

    /**
     * @psalm-param int<0, 9> $position
     *
     * @throws PriceMustBePositiveException
     */
    public static function cheese(int $position): self
    {
        return new self(
            [
                Price::from(7),
                Price::from(8),
                Price::from(9),
                Price::from(10),
                Price::from(11),
                Price::from(12),
                Price::from(13),
                Price::from(14),
                Price::from(14),
                Price::from(15),
            ],
            $position,
        );
    }

    /**
     * @psalm-param int<0, 9> $position
     *
     * @throws PriceMustBePositiveException
     */
    public static function grain(int $position): self
    {
        return new self(
            [
                Price::from(3),
                Price::from(3),
                Price::from(4),
                Price::from(5),
                Price::from(6),
                Price::from(6),
                Price::from(7),
                Price::from(7),
                Price::from(8),
                Price::from(8),
            ],
            $position,
        );
    }

    /**
     * @psalm-param int<0, 9> $position
     *
     * @throws PriceMustBePositiveException
     */
    public static function milk(int $position): self
    {
        return new self(
            [
                Price::from(3),
                Price::from(4),
                Price::from(5),
                Price::from(5),
                Price::from(6),
                Price::from(6),
                Price::from(7),
                Price::from(7),
                Price::from(8),
                Price::from(8),
            ],
            $position,
        );
    }

    /**
     * @psalm-param int<0, 9> $position
     *
     * @throws PriceMustBePositiveException
     */
    public static function whisky(int $position): self
    {
        return new self(
            [
                Price::from(8),
                Price::from(9),
                Price::from(10),
                Price::from(11),
                Price::from(12),
                Price::from(13),
                Price::from(13),
                Price::from(14),
                Price::from(15),
                Price::from(16),
            ],
            $position,
        );
    }

    /**
     * @psalm-param int<0, 9> $position
     *
     * @throws PriceMustBePositiveException
     */
    public static function wool(int $position): self
    {
        return new self(
            [
                Price::from(3),
                Price::from(3),
                Price::from(4),
                Price::from(4),
                Price::from(5),
                Price::from(5),
                Price::from(6),
                Price::from(6),
                Price::from(7),
                Price::from(8),
            ],
            $position,
        );
    }

    /**
     * @psalm-param list<Price> $prices
     * @psalm-param int<0, 9> $position
     */
    private function __construct(array $prices, int $position)
    {
        $this->prices   = $prices;
        $this->position = $position;
    }

    public function current(): Price
    {
        return $this->prices[$this->position];
    }

    public function increase(): self
    {
        $position = $this->position;

        if ($position < 9) {
            $position++;
        }

        return new self($this->prices, $position);
    }

    public function decrease(): self
    {
        $position = $this->position;

        if ($position > 0) {
            $position--;
        }

        return new self($this->prices, $position);
    }
}
