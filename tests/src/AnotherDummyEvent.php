<?php declare(strict_types=1);
namespace example\framework\event;

use example\framework\library\Uuid;

final readonly class AnotherDummyEvent extends Event
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

    public function key(): string
    {
        return $this->key;
    }
}
