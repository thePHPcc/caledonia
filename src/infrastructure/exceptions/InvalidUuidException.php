<?php declare(strict_types=1);
namespace example\caledonia\uuid;

use example\caledonia\Exception;
use InvalidArgumentException;

final class InvalidUuidException extends InvalidArgumentException implements Exception
{
}
