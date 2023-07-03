<?php declare(strict_types=1);
namespace example\framework\database;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\Medium;

#[CoversClass(MysqlDatabase::class)]
#[Medium]
final class MysqlDatabaseTest extends DatabaseTestCase
{
    public function testCanInsertIntoTableUsingConnectionThatIsAllowedToInsertIntoTable(): void
    {
        $connection = $this->connectionForWritingEvents();

        $this->assertTrue($connection->query($this->insertQuery()));
    }

    #[Depends('testCanInsertIntoTableUsingConnectionThatIsAllowedToInsertIntoTable')]
    public function testCanSelectFromTableUsingConnectionThatIsAllowedToSelectFromTable(): void
    {
        $connection = $this->connectionForReadingEvents();

        $this->assertSame(
            [
                [
                    'event_id'       => 'the-event-id',
                    'correlation_id' => 'the-correlation-id',
                    'payload'        => 'the-payload',
                ],
            ],
            $connection->query($this->selectQuery()),
        );
    }

    public function testCannotInsertIntoTableUsingConnectionThatIsNotAllowedToInsertIntoTable(): void
    {
        $connection = $this->connectionForReadingEvents();

        $this->expectException(DatabaseException::class);

        $connection->query($this->insertQuery());
    }

    public function testCannotSelectFromTableUsingConnectionThatIsNotAllowedToSelectFromTable(): void
    {
        $connection = $this->connectionForWritingEvents();

        $this->expectException(DatabaseException::class);

        $connection->query($this->selectQuery());
    }

    private function insertQuery(): string
    {
        return 'INSERT INTO event (event_id, correlation_id, payload) VALUES("the-event-id", "the-correlation-id", "the-payload");';
    }

    private function selectQuery(): string
    {
        return 'SELECT event_id, correlation_id, payload FROM event;';
    }
}
