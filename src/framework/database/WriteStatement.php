<?php declare(strict_types=1);
namespace example\framework\database;

interface WriteStatement
{
    public function execute(Database $database): void;
}
