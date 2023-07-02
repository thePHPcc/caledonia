<?php declare(strict_types=1);
namespace example\caledonia\event;

use example\caledonia\uuid\Uuid;

abstract readonly class Event
{
    private Uuid $id;
    private Uuid $correlationId;

    public function __construct(Uuid $id, Uuid $correlationId)
    {
        $this->id            = $id;
        $this->correlationId = $correlationId;
    }

    public function id(): Uuid
    {
        return $this->id;
    }

    public function correlationId(): Uuid
    {
        return $this->correlationId;
    }

    /**
     * @psalm-return non-empty-string
     */
    abstract public function type(): string;

    /**
     * @psalm-return non-empty-array<string, mixed>
     */
    abstract public function asArray(): array;
}
