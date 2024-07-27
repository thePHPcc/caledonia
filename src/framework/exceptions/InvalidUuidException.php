<?php declare(strict_types=1);
namespace example\framework\library;

use example\framework\Exception;
use InvalidArgumentException;

/**
 * @no-named-arguments
 */
final class InvalidUuidException extends InvalidArgumentException implements Exception
{
}
