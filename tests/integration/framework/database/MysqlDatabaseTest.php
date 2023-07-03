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
        $this->emptyTable('test');

        $connection = $this->connectionForTesting();

        $this->assertTrue($connection->query('INSERT INTO test () VALUES();'));
    }

    #[Depends('testCanInsertIntoTableUsingConnectionThatIsAllowedToInsertIntoTable')]
    public function testCanSelectFromTableUsingConnectionThatIsAllowedToSelectFromTable(): void
    {
        $connection = $this->connectionForTesting();

        $this->assertSame(
            [['id' => 1]],
            $connection->query('SELECT id FROM test;'),
        );
    }

    public function testCannotInsertIntoTableUsingConnectionThatIsNotAllowedToInsertIntoTable(): void
    {
        $connection = $this->connectionForReadingEvents();

        $this->expectException(DatabaseException::class);

        $connection->query('INSERT INTO test () VALUES();');
    }

    public function testCannotSelectFromTableUsingConnectionThatIsNotAllowedToSelectFromTable(): void
    {
        $connection = $this->connectionForWritingEvents();

        $this->expectException(DatabaseException::class);

        $connection->query('SELECT id FROM test;');
    }
}
