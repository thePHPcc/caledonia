<?php declare(strict_types=1);
namespace example\caledonia\domain;

/**
 * @no-named-arguments
 */
final readonly class Bread extends Good
{
    /**
     * @return 'bread'
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
