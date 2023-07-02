<?php declare(strict_types=1);
namespace example\caledonia\domain;

/**
 * @psalm-immutable
 */
final readonly class Whisky extends Good
{
    /**
     * @psalm-assert-if-true Whisky $this
     */
    public function isWhisky(): true
    {
        return true;
    }
}
