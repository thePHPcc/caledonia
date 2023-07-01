<?php declare(strict_types=1);
namespace example\caledonia;

/**
 * @psalm-immutable
 */
final readonly class Cheese extends Good
{
    /**
     * @psalm-assert-if-true Cheese $this
     */
    public function isCheese(): true
    {
        return true;
    }
}
