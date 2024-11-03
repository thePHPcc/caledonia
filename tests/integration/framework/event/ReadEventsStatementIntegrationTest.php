<?php declare(strict_types=1);
namespace example\framework\event;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;

#[CoversClass(ReadEventsStatement::class)]
#[Medium]
final class ReadEventsStatementIntegrationTest extends DatabaseTestCase
{
    public function testReadsEventsFromDatabase(): void
    {
        $this->prepareEvent();

        $statement = new ReadEventsStatement(['the-topic']);

        $result = $statement->execute($this->connectionForReadingEvents());

        $this->assertSame(
            [
                0 => [
                    'payload' => '{"topic":"the-topic","event_id":"b5578a2a-3188-470c-a2b7-3a249faed6fb","key":"value"}',
                ],
            ],
            $result,
        );
    }
}
