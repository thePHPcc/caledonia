<?php declare(strict_types=1);
namespace example\caledonia\domain;

use function range;

/**
 * @psalm-immutable
 */
final readonly class Market
{
    /**
     * @psalm-var array{bread: PriceTable, cheese: PriceTable, grain: PriceTable, milk: PriceTable, whisky: PriceTable, wool: PriceTable}
     */
    private array $priceTables;

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
    public function purchase(Good $good, int $amount): self
    {
        $priceTables = $this->priceTables;

        foreach (range(1, $amount) as $i) {
            $priceTables[$good->asString()] = $priceTables[$good->asString()]->increase();
        }

        return $this->newFromPriceTables($priceTables);
    }

    /**
     * @psalm-param positive-int $amount
     */
    public function sell(Good $good, int $amount): self
    {
        $priceTables = $this->priceTables;

        foreach (range(1, $amount) as $i) {
            $priceTables[$good->asString()] = $priceTables[$good->asString()]->decrease();
        }

        return $this->newFromPriceTables($priceTables);
    }

    /**
     * @psalm-return array{bread: PriceTable, cheese: PriceTable, grain: PriceTable, milk: PriceTable, whisky: PriceTable, wool: PriceTable}
     */
    public function priceTables(): array
    {
        return $this->priceTables;
    }

    /**
     * @psalm-param array{bread: PriceTable, cheese: PriceTable, grain: PriceTable, milk: PriceTable, whisky: PriceTable, wool: PriceTable} $priceTables
     */
    private function newFromPriceTables(array $priceTables): self
    {
        return new self(
            $priceTables['bread']->currentPosition(),
            $priceTables['cheese']->currentPosition(),
            $priceTables['grain']->currentPosition(),
            $priceTables['milk']->currentPosition(),
            $priceTables['whisky']->currentPosition(),
            $priceTables['wool']->currentPosition(),
        );
    }
}
