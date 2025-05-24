<?php declare(strict_types=1);
namespace example\caledonia\domain;

/**
 * @no-named-arguments
 */
abstract readonly class Command
{
    /**
     * @return non-empty-string
     */
    abstract public function asString(): string;
}
