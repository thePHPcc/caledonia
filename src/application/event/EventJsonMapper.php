<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\framework\event\EventJsonMapper as FrameworkEventJsonMapper;

trait EventJsonMapper
{
    private function createEventJsonMapper(): FrameworkEventJsonMapper
    {
        return new FrameworkEventJsonMapper(
            [
            ],
        );
    }
}
