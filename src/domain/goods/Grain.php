<?php declare(strict_types=1);
namespace example\caledonia\domain;

/**
 * @immutable
 */
final readonly class Grain extends Good
{
    /**
     * @return 'grain'
     */
    public function asString(): string
    {
        return 'grain';
    }

    public function isGrain(): true
    {
        return true;
    }
}
