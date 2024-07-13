<?php declare(strict_types=1);
namespace example\framework\database;

final readonly class MysqliDatabaseConnection extends AbstractMysqliDatabaseConnection implements ReadingDatabaseConnection, WritingDatabaseConnection
{
    use MysqliReadingDatabaseConnectionTrait;
    use MysqliWritingDatabaseConnectionTrait;
}
