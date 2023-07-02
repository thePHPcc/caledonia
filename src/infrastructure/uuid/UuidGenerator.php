<?php declare(strict_types=1);
namespace example\caledonia\uuid;

interface UuidGenerator
{
    public function generate(): Uuid;
}
