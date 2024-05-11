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

    public function isBread(): true
    {
        return true;
    }
}
