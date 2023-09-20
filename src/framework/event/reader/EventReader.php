<?php declare(strict_types=1);
namespace example\framework\event;

interface EventReader
{
    /**
     * @psalm-param non-empty-string $topic
     */
    public function topic(string $topic): EventCollection;
}
