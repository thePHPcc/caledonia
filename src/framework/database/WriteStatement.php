<?php declare(strict_types=1);
namespace example\framework\database;

interface WriteStatement
{
    public function execute(WritingDatabaseConnection $database): void;
}
