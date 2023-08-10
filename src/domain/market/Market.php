<?php declare(strict_types=1);
namespace example\caledonia\domain;

use function range;

final class Market
{
    /**
     * @psalm-var array<'bread'|'cheese'|'grain'|'milk'|'whisky'|'wool', PriceTable>
     */
    private array $priceTables;

    /**
     * @throws PriceMustBePositiveException
     */
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
     *
     * @throws PriceMustBePositiveException
     */
    public static function from(int $bread, int $cheese, int $grain, int $milk, int $whisky, int $wool): self
    {
        return new self(
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
     *
     * @throws PriceMustBePositiveException
     */
    private function __construct(int $bread, int $cheese, int $grain, int $milk, int $whisky, int $wool)
    {
        $this->priceTables = [
            'bread'  => PriceTable::bread($bread),
            'cheese' => PriceTable::cheese($cheese),
            'grain'  => PriceTable::grain($grain),
            'milk'   => PriceTable::milk($milk),
            'whisky' => PriceTable::whisky($whisky),
            'wool'   => PriceTable::wool($wool),
        ];
    }

    public function priceFor(Good $good): Price
    {
        return $this->priceTables[$good->asString()]->current();
    }

    /**
     * @psalm-param positive-int $amount
     */
    public function purchase(Good $good, int $amount): void
    {
        foreach (range(1, $amount) as $i) {
            $this->priceTables[$good->asString()]->increase();
        }
    }

    /**
     * @psalm-param positive-int $amount
     */
    public function sell(Good $good, int $amount): void
    {
        foreach (range(1, $amount) as $i) {
            $this->priceTables[$good->asString()]->decrease();
        }
    }
}
