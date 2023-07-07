<?php declare(strict_types=1);
namespace example\framework\event;

use example\framework\Exception;
use RuntimeException;

final class CannotMapEventException extends RuntimeException implements Exception
{
}
