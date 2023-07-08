<?php declare(strict_types=1);
namespace example\framework\event;

use example\framework\library\Uuid;

interface EventReader
{
    public function correlation(Uuid $correlationId): EventCollection;

    public function topic(string $topic): EventCollection;
}
