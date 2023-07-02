<?php declare(strict_types=1);
namespace example\caledonia\event;

final readonly class DummyEvent extends Event
{
    /**
     * @psalm-return non-empty-string
     */
    public function type(): string
    {
        return 'dummy';
    }

    /**
     * @psalm-return non-empty-array<string, mixed>
     */
    public function asArray(): array
    {
        return ['key' => 'value'];
    }
}
