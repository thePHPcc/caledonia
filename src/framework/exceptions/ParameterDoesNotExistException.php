<?php declare(strict_types=1);
namespace example\framework\http;

use example\framework\Exception;
use RuntimeException;

/**
 * @no-named-arguments
 */
final class ParameterDoesNotExistException extends RuntimeException implements Exception
{
}
