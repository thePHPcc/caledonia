<?php declare(strict_types=1);
namespace example\framework\library;

interface UuidGenerator
{
    public function generate(): Uuid;
}
