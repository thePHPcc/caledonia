<?php declare(strict_types=1);
namespace example\framework\database;

interface Database
{
    /**
     * @param non-empty-string $sql
     *
     * @throws DatabaseException
     */
    public function query(string $sql, string ...$parameters): array|true;
}
