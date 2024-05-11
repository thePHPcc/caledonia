<?php declare(strict_types=1);
namespace example\caledonia\domain;

/**
 * @immutable
 */
final readonly class Cheese extends Good
{
    /**
     * @return 'cheese'
     */
    public function asString(): string
    {
        return 'cheese';
    }

    public function isCheese(): true
    {
        return true;
    }
}
