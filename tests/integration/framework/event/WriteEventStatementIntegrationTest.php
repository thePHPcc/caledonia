<?php declare(strict_types=1);
namespace example\framework\event;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;

#[CoversClass(WriteEventStatement::class)]
#[Medium]
final class WriteEventStatementIntegrationTest extends DatabaseTestCase
{
    public function testWritesEventToDatabase(): void
    {
        $this->emptyTable('event');

        $statement = new WriteEventStatement(
            'b5578a2a-3188-470c-a2b7-3a249faed6fb',
            'the-topic',
            'payload',
        );

        $statement->execute($this->connectionForWritingEvents());

        $this->assertTableEqualsCsvFile(
            __DIR__ . '/../../../expectation/write_event.csv',
            'event',
            $this->eventSchema(),
        );
    }
}
