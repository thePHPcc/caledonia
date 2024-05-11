<?php declare(strict_types=1);
namespace example\caledonia\domain;

/**
 * @immutable
 */
final readonly class Wool extends Good
{
    /**
     * @return 'wool'
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
