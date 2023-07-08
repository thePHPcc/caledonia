<?php declare(strict_types=1);
namespace example\framework\event;

interface EventReader
{
    public function topic(string $topic): EventCollection;
}
