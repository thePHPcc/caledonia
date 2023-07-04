<?php declare(strict_types=1);
namespace example\caledonia\domain;

/**
 * @psalm-immutable
 */
final readonly class Bread extends Good
{
    /**
     * @psalm-return 'bread'
     */
    public function asString(): string
    {
        return 'bread';
    }

    /**
     * @psalm-assert-if-true Bread $this
     */
    public function isBread(): true
    {
        return true;
    }
}
