<?php declare(strict_types=1);
namespace example\caledonia\domain;

/**
 * @psalm-immutable
 */
final readonly class Grain extends Good
{
    /**
     * @psalm-return 'grain'
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
