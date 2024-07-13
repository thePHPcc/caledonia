<?php declare(strict_types=1);
namespace example\framework\database;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\Attributes\Medium;

#[CoversClass(MysqliWritingDatabaseConnection::class)]
#[CoversTrait(MysqliWritingDatabaseConnectionTrait::class)]
#[Medium]
final class MysqliWritingDatabaseConnectionTest extends DatabaseTestCase
{
    public function testCanInsertIntoTableUsingConnectionThatIsAllowedToInsertIntoTable(): void
    {
        $this->emptyTable('test');

        $connection = $this->connectionForTesting();

        $this->assertTrue($connection->execute('INSERT INTO test () VALUES();'));
    }
}
