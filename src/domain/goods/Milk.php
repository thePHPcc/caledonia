<?php declare(strict_types=1);
namespace example\caledonia\domain;

/**
 * @immutable
 */
final readonly class Milk extends Good
{
    /**
     * @return 'milk'
     */
    public function asString(): string
    {
        return 'milk';
    }

    public function isMilk(): true
    {
        return true;
    }
}
