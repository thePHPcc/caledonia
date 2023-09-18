<?php declare(strict_types=1);
namespace example\framework\http;

use example\framework\Exception;
use RuntimeException;

final class RequestCannotBeRoutedException extends RuntimeException implements Exception
{
}
