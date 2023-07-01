<?php declare(strict_types=1);
namespace example\caledonia;

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
}
