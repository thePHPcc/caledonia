<?php declare(strict_types=1);
namespace example\caledonia\domain;

/**
 * @psalm-immutable
 */
abstract readonly class Good
{
    public static function fromString(string $good): self
    {
        return match ($good) {
            'bread'  => self::bread(),
            'cheese' => self::cheese(),
            'grain'  => self::grain(),
            'milk'   => self::milk(),
            'whisky' => self::whisky(),
            'wool'   => self::wool(),
        };
    }

    public static function bread(): Bread
    {
        return new Bread;
    }

    public static function cheese(): Cheese
    {
        return new Cheese;
    }

    public static function grain(): Grain
    {
        return new Grain;
    }

    public static function milk(): Milk
    {
        return new Milk;
    }

    public static function whisky(): Whisky
    {
        return new Whisky;
    }

    public static function wool(): Wool
    {
        return new Wool;
    }

    final protected function __construct()
    {
    }

    public function equals(self $other): bool
    {
        return $this::class === $other::class;
    }

    /**
     * @psalm-assert-if-true Bread $this
     */
    public function isBread(): bool
    {
        return false;
    }

    /**
     * @psalm-assert-if-true Cheese $this
     */
    public function isCheese(): bool
    {
        return false;
    }

    /**
     * @psalm-assert-if-true Grain $this
     */
    public function isGrain(): bool
    {
        return false;
    }

    /**
     * @psalm-assert-if-true Milk $this
     */
    public function isMilk(): bool
    {
        return false;
    }

    /**
     * @psalm-assert-if-true Whisky $this
     */
    public function isWhisky(): bool
    {
        return false;
    }

    /**
     * @psalm-assert-if-true Wool $this
     */
    public function isWool(): bool
    {
        return false;
    }

    /**
     * @psalm-return 'bread'|'cheese'|'grain'|'milk'|'whisky'|'wool'
     */
    abstract public function asString(): string;
}
