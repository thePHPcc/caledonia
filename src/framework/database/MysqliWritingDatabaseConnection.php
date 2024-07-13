<?php declare(strict_types=1);
namespace example\framework\database;

final readonly class MysqliWritingDatabaseConnection extends AbstractMysqliDatabaseConnection implements WritingDatabaseConnection
{
    use MysqliWritingDatabaseConnectionTrait;
}
