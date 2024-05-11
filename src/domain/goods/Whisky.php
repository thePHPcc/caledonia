<?php declare(strict_types=1);
namespace example\caledonia\domain;

/**
 * @immutable
 */
final readonly class Whisky extends Good
{
    /**
     * @return 'whisky'
     */
    public function asString(): string
    {
        return 'whisky';
    }

    public function isWhisky(): true
    {
        return true;
    }
}
