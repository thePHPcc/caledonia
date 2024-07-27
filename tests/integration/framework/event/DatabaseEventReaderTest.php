<?php declare(strict_types=1);
namespace example\framework\event;

use function assert;
use example\framework\library\Uuid;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;
use PHPUnit\Framework\TestCase;
use SebastianBergmann\MysqliWrapper\MysqliReadingDatabaseConnection;
use SebastianBergmann\MysqliWrapper\MysqliWritingDatabaseConnection;
use SebastianBergmann\MysqliWrapper\Testing\Testing;
use Throwable;

#[CoversClass(DatabaseEventReader::class)]
#[Medium]
final class DatabaseEventReaderTest extends TestCase
{
    use Testing;

    public function testReadsEventsByTopic(): void
    {
        $this->prepareEvent();

        $events = $this->reader()->topic('the-topic');

        $this->assertCount(1, $events);

        $event = $events->asArray()[0];

        assert($event instanceof DummyEvent);

        $this->assertSame('the-topic', $event->topic());
        $this->assertSame('b5578a2a-3188-470c-a2b7-3a249faed6fb', $event->id()->asString());
        $this->assertSame('value', $event->key());
    }

    protected function connectionForReadingEvents(): MysqliReadingDatabaseConnection
    {
        try {
            return MysqliReadingDatabaseConnection::connect(
                'localhost',
                'event_reader',
                'event_reader_password',
                'caledonia',
            );
        } catch (Throwable) {
            $this->markTestSkipped('Could not connect to test database');
        }
    }

    protected function connectionForWritingEvents(): MysqliWritingDatabaseConnection
    {
        try {
            return MysqliWritingDatabaseConnection::connect(
                'localhost',
                'event_writer',
                'event_writer_password',
                'caledonia',
            );
        } catch (Throwable) {
            $this->markTestSkipped('Could not connect to test database');
        }
    }

    /**
     * @return array{host: non-empty-string, username: non-empty-string, password: non-empty-string, database: non-empty-string}
     */
    protected function configurationForTesting(): array
    {
        return [
            'host'     => 'localhost',
            'username' => 'test_fixture_manager',
            'password' => 'test_fixture_manager_password',
            'database' => 'caledonia',
        ];
    }

    private function prepareEvent(): void
    {
        $this->emptyTable('event');

        $this->writer()->write($this->event());
    }

    private function reader(): DatabaseEventReader
    {
        return new DatabaseEventReader($this->connectionForReadingEvents(), $this->mapper());
    }

    private function writer(): DatabaseEventWriter
    {
        return new DatabaseEventWriter($this->connectionForWritingEvents(), $this->mapper());
    }

    private function mapper(): EventJsonMapper
    {
        return new EventJsonMapper(['the-topic' => new DummyEventMapper]);
    }

    private function event(): Event
    {
        return new DummyEvent(
            Uuid::from('b5578a2a-3188-470c-a2b7-3a249faed6fb'),
            'value',
        );
    }
}
