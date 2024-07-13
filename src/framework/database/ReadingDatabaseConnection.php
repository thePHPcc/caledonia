<?php declare(strict_types=1);
namespace example\framework\database;

interface ReadingDatabaseConnection
{
    /**
     * @param non-empty-string $sql
     *
     * @throws DatabaseException
     *
     * @return list<array<non-empty-string, mixed>>
     */
    public function query(string $sql, string ...$parameters): array;
}
