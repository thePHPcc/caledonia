<?php declare(strict_types=1);
namespace example\framework\database;

interface ReadStatement
{
    /**
     * @return list<array<non-empty-string, float|int|string>>
     */
    public function execute(Database $database): array;
}
