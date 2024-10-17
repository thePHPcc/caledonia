<?php declare(strict_types=1);
namespace example\framework\event;

/**
 * @no-named-arguments
 */
interface EventReader
{
    /**
     * @param non-empty-string ...$topics
     */
    public function topic(string ...$topics): EventCollection;
}
