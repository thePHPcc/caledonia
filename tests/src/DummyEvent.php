<?php declare(strict_types=1);
namespace example\framework\event;

use example\framework\library\Uuid;

final readonly class DummyEvent extends Event
{
    private string $key;

    public function __construct(Uuid $id, string $key)
    {
        parent::__construct($id);

        $this->key = $key;
    }

    /**
     * @psalm-return non-empty-string
     */
    public function topic(): string
    {
        return 'the-topic';
    }

    /**
     * @psalm-return non-empty-string
     */
    public function asString(): string
    {
        return 'another dummy event';
    }

    public function key(): string
    {
        return $this->key;
    }
}
