<?php declare(strict_types=1);
namespace example\framework\database;

interface WritingDatabaseConnection
{
    /**
     * @param non-empty-string $sql
     *
     * @throws DatabaseException
     */
    public function execute(string $sql, string ...$parameters): true;
}
