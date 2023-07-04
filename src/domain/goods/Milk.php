<?php declare(strict_types=1);
namespace example\caledonia\domain;

/**
 * @psalm-immutable
 */
final readonly class Milk extends Good
{
    /**
     * @psalm-return 'milk'
     */
    public function asString(): string
    {
        return 'milk';
    }

    /**
     * @psalm-assert-if-true Milk $this
     */
    public function isMilk(): true
    {
        return true;
    }
}
