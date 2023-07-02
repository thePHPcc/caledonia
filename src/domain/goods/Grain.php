<?php declare(strict_types=1);
namespace example\caledonia\domain;

/**
 * @psalm-immutable
 */
final readonly class Grain extends Good
{
    /**
     * @psalm-assert-if-true Grain $this
     */
    public function isGrain(): true
    {
        return true;
    }
}
