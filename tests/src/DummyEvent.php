<?php declare(strict_types=1);
namespace example\framework\event;

final readonly class DummyEvent extends Event
{
    /**
     * @psalm-return non-empty-string
     */
    public function topic(): string
    {
        return 'the-topic';
    }
}
