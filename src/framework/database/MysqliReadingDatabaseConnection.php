<?php declare(strict_types=1);
namespace example\framework\database;

final readonly class MysqliReadingDatabaseConnection extends AbstractMysqliDatabaseConnection implements ReadingDatabaseConnection
{
    use MysqliReadingDatabaseConnectionTrait;
}
