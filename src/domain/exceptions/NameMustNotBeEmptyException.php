<?php declare(strict_types=1);
namespace example\caledonia\domain;

use InvalidArgumentException;

/**
 * @no-named-arguments
 */
final class NameMustNotBeEmptyException extends InvalidArgumentException implements Exception
{
}
