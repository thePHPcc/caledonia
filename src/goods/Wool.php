<?php declare(strict_types=1);
namespace example\caledonia;

/**
 * @psalm-immutable
 */
final readonly class Wool extends Good
{
    /**
     * @psalm-assert-if-true Wool $this
     */
    public function isWool(): true
    {
        return true;
    }
}
