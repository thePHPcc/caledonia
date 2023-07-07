<?php declare(strict_types=1);
namespace example\framework\event;

use example\framework\library\Uuid;

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
    abstract public function topic(): string;
}
