<?php declare(strict_types=1);
namespace example\framework\event;

interface EventReader
{
    /**
     * @psalm-param list<non-empty-string>|non-empty-string $topics
     */
    public function topic(array|string $topics): EventCollection;
}
