<?php declare(strict_types=1);
namespace example\framework\database;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\Attributes\DependsExternal;
use PHPUnit\Framework\Attributes\Medium;

#[CoversClass(MysqliReadingDatabaseConnection::class)]
#[CoversTrait(MysqliReadingDatabaseConnectionTrait::class)]
#[Medium]
final class MysqliReadingDatabaseConnectionTest extends DatabaseTestCase
{
    #[DependsExternal(MysqliWritingDatabaseConnectionTest::class, 'testCanInsertIntoTableUsingConnectionThatIsAllowedToInsertIntoTable')]
    public function testCanSelectFromTableUsingConnectionThatIsAllowedToSelectFromTable(): void
    {
        $connection = $this->connectionForTesting();

        $this->assertSame(
            [['id' => 1]],
            $connection->query('SELECT id FROM test;'),
        );
    }
}
