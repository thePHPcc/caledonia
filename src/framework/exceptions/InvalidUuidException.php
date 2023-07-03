<?php declare(strict_types=1);
namespace example\framework\library;

use example\framework\Exception;
use InvalidArgumentException;

final class InvalidUuidException extends InvalidArgumentException implements Exception
{
}
