<?php declare(strict_types=1);
namespace example\caledonia\event;

final readonly class DummyEvent extends Event
{
    public function asArray(): array
    {
        return ['key' => 'value'];
    }
}
