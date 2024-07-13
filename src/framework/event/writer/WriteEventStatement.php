<?php declare(strict_types=1);
namespace example\framework\event;

use example\framework\database\Database;
use example\framework\database\WriteStatement;

final readonly class WriteEventStatement implements WriteStatement
{
    /**
     * @var non-empty-string
     */
    private string $id;

    /**
     * @var non-empty-string
     */
    private string $topic;

    /**
     * @var non-empty-string
     */
    private string $payload;

    /**
     * @param non-empty-string $id
     * @param non-empty-string $topic
     * @param non-empty-string $payload
     */
    public function __construct(string $id, string $topic, string $payload)
    {
        $this->id      = $id;
        $this->topic   = $topic;
        $this->payload = $payload;
    }

    public function execute(Database $database): void
    {
        $database->execute(
            'INSERT INTO event
                         (event_id, topic, payload)
                  VALUES (?, ?, ?);',
            $this->id,
            $this->topic,
            $this->payload,
        );
    }
}
