<?php declare(strict_types=1);
namespace example\caledonia\domain;

use function max;
use function min;

final class Market
{
    private readonly PriceTable $prices;

    /**
     * @psalm-var int<0, 9>
     */
    private int $bread;

    /**
     * @psalm-var int<0, 9>
     */
    private int $cheese;

    /**
     * @psalm-var int<0, 9>
     */
    private int $grain;

    /**
     * @psalm-var int<0, 9>
     */
    private int $milk;

    /**
     * @psalm-var int<0, 9>
     */
    private int $whisky;

    /**
     * @psalm-var int<0, 9>
     */
    private int $wool;

    public static function create(): self
    {
        return self::from(
            3,
            3,
            3,
            3,
            3,
            3,
        );
    }

    /**
     * @psalm-param int<0, 9> $bread
     * @psalm-param int<0, 9> $cheese
     * @psalm-param int<0, 9> $grain
     * @psalm-param int<0, 9> $milk
     * @psalm-param int<0, 9> $whisky
     * @psalm-param int<0, 9> $wool
     */
    public static function from(int $bread, int $cheese, int $grain, int $milk, int $whisky, int $wool): self
    {
        return new self(
            new PriceTable,
            $bread,
            $cheese,
            $grain,
            $milk,
            $whisky,
            $wool,
        );
    }

    /**
     * @psalm-param int<0, 9> $bread
     * @psalm-param int<0, 9> $cheese
     * @psalm-param int<0, 9> $grain
     * @psalm-param int<0, 9> $milk
     * @psalm-param int<0, 9> $whisky
     * @psalm-param int<0, 9> $wool
     */
    private function __construct(PriceTable $prices, int $bread, int $cheese, int $grain, int $milk, int $whisky, int $wool)
    {
        $this->prices = $prices;
        $this->bread  = $bread;
        $this->cheese = $cheese;
        $this->grain  = $grain;
        $this->milk   = $milk;
        $this->whisky = $whisky;
        $this->wool   = $wool;
    }

    public function priceFor(Good $good): Price
    {
        $prices = $this->prices->for($good);

        return match ($good::class) {
            Bread::class  => $prices[$this->bread],
            Cheese::class => $prices[$this->cheese],
            Grain::class  => $prices[$this->grain],
            Milk::class   => $prices[$this->milk],
            Whisky::class => $prices[$this->whisky],
            Wool::class   => $prices[$this->wool],
        };
    }

    public function purchase(Good $good, int $amount): void
    {
        if ($good->isBread()) {
            $this->bread = min(9, $this->bread + $amount);

            return;
        }

        if ($good->isCheese()) {
            $this->cheese = min(9, $this->cheese + $amount);

            return;
        }

        if ($good->isGrain()) {
            $this->grain = min(9, $this->grain + $amount);

            return;
        }

        if ($good->isMilk()) {
            $this->milk = min(9, $this->milk + $amount);

            return;
        }

        if ($good->isWhisky()) {
            $this->whisky = min(9, $this->whisky + $amount);

            return;
        }

        if ($good->isWool()) {
            $this->wool = min(9, $this->wool + $amount);
        }
    }

    public function sell(Good $good, int $amount): void
    {
        if ($good->isBread()) {
            $this->bread = max(0, $this->bread - $amount);

            return;
        }

        if ($good->isCheese()) {
            $this->cheese = max(0, $this->cheese - $amount);

            return;
        }

        if ($good->isGrain()) {
            $this->grain = max(0, $this->grain - $amount);

            return;
        }

        if ($good->isMilk()) {
            $this->milk = max(0, $this->milk - $amount);

            return;
        }

        if ($good->isWhisky()) {
            $this->whisky = max(0, $this->whisky - $amount);

            return;
        }

        if ($good->isWool()) {
            $this->wool = max(0, $this->wool - $amount);
        }
    }
}
