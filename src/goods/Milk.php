<?php declare(strict_types=1);
namespace example\caledonia;

/**
 * @psalm-immutable
 */
final readonly class Milk extends Good
{
    /**
     * @psalm-assert-if-true Milk $this
     */
    public function isMilk(): true
    {
        return true;
    }
}
