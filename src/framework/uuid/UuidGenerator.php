<?php declare(strict_types=1);
namespace example\framework\library;

/**
 * @no-named-arguments
 */
interface UuidGenerator
{
    public function generate(): Uuid;
}
