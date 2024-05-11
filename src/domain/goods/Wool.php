<?php declare(strict_types=1);
namespace example\caledonia\domain;

/**
 * @psalm-immutable
 */
final readonly class Wool extends Good
{
    /**
     * @psalm-return 'wool'
     */
    public function asString(): string
    {
        return 'wool';
    }

    public function isWool(): true
    {
        return true;
    }
}
